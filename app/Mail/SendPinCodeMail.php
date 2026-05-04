<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendPinCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pinCode; // ★ビュー（文面）に渡すための変数

    /**
     * Create a new message instance.
     */
    public function __construct($pinCode)
    {
        $this->pinCode = $pinCode;
    }

    /**
     * メールの件名（タイトル）と送信者の設定
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '【dispatcherZ】ライセンス認証 PINコードのお知らせ',
        );
    }

    /**
     * メールの文面（どのHTML/Textを使うか）の設定
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.pin_code', // ★この後作るBladeファイルを指定します
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}