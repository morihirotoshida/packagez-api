<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->string('serial_code', 19)->unique(); // 例: ABCD-1234-EFGH-5678
            $table->boolean('is_used')->default(false);  // 使用済みフラグ
            
            // 以下はアクティベーション時に記録される情報
            $table->string('email')->nullable();         // 紐付けられたメールアドレス
            $table->string('pin_code', 6)->nullable();   // 一時的な6桁のPINコード
            $table->timestamp('pin_expires_at')->nullable(); // PINの有効期限（10分など）
            $table->timestamp('activated_at')->nullable();   // アクティベーション完了日時
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('licenses');
    }
};
