<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\License;

class GenerateLicenses extends Command
{
    // ★ ターミナルで実行するときのコマンド名と引数（個数）
    protected $signature = 'license:generate {count=1 : 生成するシリアルコードの数}';

    // コマンドの説明
    protected $description = 'dispatcherZの製品版シリアルコードを自動生成してDBに登録します';

    public function handle()
    {
        $count = $this->argument('count');
        $generated = 0;

        $this->info("{$count} 個のシリアルコードを生成します...");

        for ($i = 0; $i < $count; $i++) {
            $code = $this->generateUniqueCode();
            
            License::create([
                'serial_code' => $code,
                'is_used' => false,
            ]);

            // ターミナルに緑色で出力
            $this->line("<fg=green>生成完了:</> {$code}");
            $generated++;
        }

        $this->info("✅ 合計 {$generated} 個のシリアルコードをデータベースに登録しました！");
    }

    // --- 16桁のランダムな文字列（XXXX-XXXX-XXXX-XXXX）を作る関数 ---
    private function generateUniqueCode()
    {
        $characters = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ'; // 紛らわしい文字(0,O,1,I)を除外した文字群
        
        do {
            $segments = [];
            for ($i = 0; $i < 4; $i++) {
                $segment = '';
                for ($j = 0; $j < 4; $j++) {
                    $segment .= $characters[random_int(0, strlen($characters) - 1)];
                }
                $segments[] = $segment;
            }
            $code = implode('-', $segments);
            
            // 念のため、DBに同じコードが既に存在しないかチェック
        } while (License::where('serial_code', $code)->exists());

        return $code;
    }
}