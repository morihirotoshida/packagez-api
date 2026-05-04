<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\License; // 事前に php artisan make:model License を作成してください

class LicenseController extends Controller
{
    // =========================================================
    // 1. PINコードの要求（シリアルコードの確認とメール送信）
    // =========================================================
    public function requestPin(Request $request)
    {
        $request->validate([
            'serial_code' => 'required|string',
            'email' => 'required|email',
        ]);

        // シリアルコードが存在し、まだ使われていないかチェック
        $license = License::where('serial_code', $request->serial_code)->first();

        if (!$license) {
            return response()->json(['message' => '無効なシリアルコードです。'], 404);
        }
        if ($license->is_used) {
            return response()->json(['message' => 'このシリアルコードは既に使用されています。'], 400);
        }

        // 6桁のランダムなPINコードを生成
        $pinCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // データベースにPINと有効期限（15分間）、仮のメールアドレスを保存
        $license->update([
            'email' => $request->email,
            'pin_code' => $pinCode,
            'pin_expires_at' => Carbon::now()->addMinutes(15),
        ]);

        // ★ここで実際のメール送信処理を行います（例）
        Mail::to($request->email)->send(new \App\Mail\SendPinCodeMail($pinCode));

        return response()->json([
            'message' => 'メールアドレスにPINコードを送信しました。'
        ], 200);
    }

    // =========================================================
    // 2. アクティベーション（PINの確認とライセンスキーの発行）
    // =========================================================
    public function activate(Request $request)
    {
        $request->validate([
            'serial_code' => 'required|string',
            'email' => 'required|email',
            'pin' => 'required|string|size:6',
        ]);

        $license = License::where('serial_code', $request->serial_code)
                          ->where('email', $request->email)
                          ->first();

        // エラーハンドリング
        if (!$license) {
            return response()->json(['message' => 'ライセンス情報が見つかりません。'], 404);
        }
        if ($license->is_used) {
            return response()->json(['message' => 'このシリアルコードは既にアクティベートされています。'], 400);
        }
        if ($license->pin_code !== $request->pin) {
            return response()->json(['message' => 'PINコードが間違っています。'], 400);
        }
        if (Carbon::now()->isAfter($license->pin_expires_at)) {
            return response()->json(['message' => 'PINコードの有効期限が切れています。もう一度最初からお試しください。'], 400);
        }

        // -----------------------------------------------------
        // 認証成功！ 使用済みにマークし、電子署名付きキーを生成
        // -----------------------------------------------------
        $license->update([
            'is_used' => true,
            'activated_at' => Carbon::now(),
            'pin_code' => null, // PINは不要になるので消去
            'pin_expires_at' => null,
        ]);

        // 解除用のライセンスキー（トークン）を生成
        // （例：シリアルとメールとシステム固有の秘密鍵を混ぜて暗号化した絶対に偽造できない文字列）
        $secretKey = env('APP_KEY'); 
        $unlockToken = hash_hmac('sha256', $license->serial_code . $license->email . $license->activated_at, $secretKey);

        return response()->json([
            'message' => 'アクティベーションに成功しました。',
            'license_token' => $unlockToken,
        ], 200);
    }
}