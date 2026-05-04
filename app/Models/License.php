<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    // ★ セキュリティ対策（Mass Assignment防止）
    // コントローラーから自動で上書き・保存して良いカラムを指定します
    protected $fillable = [
        'serial_code',
        'is_used',
        'email',
        'pin_code',
        'pin_expires_at',
        'activated_at',
    ];

    // ★ 日付や真偽値を正しくLaravelに認識させる設定
    protected $casts = [
        'is_used' => 'boolean',
        'pin_expires_at' => 'datetime',
        'activated_at' => 'datetime',
    ];
}