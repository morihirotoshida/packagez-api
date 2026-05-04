<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Helvetica Neue', Arial, 'Hiragino Kaku Gothic ProN', 'Hiragino Sans', Meiryo, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eaeaea; border-radius: 8px; background-color: #ffffff; }
        .header { text-align: center; margin-bottom: 24px; }
        .pin-box { background-color: #f8f9fa; border-left: 4px solid #0056b3; padding: 16px; margin: 24px 0; text-align: center; }
        .pin-code { font-size: 32px; font-weight: bold; letter-spacing: 4px; color: #0056b3; }
        .footer { margin-top: 32px; padding-top: 16px; border-top: 1px solid #eaeaea; font-size: 12px; color: #666; text-align: center; }
        .warning { color: #dc3545; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>dispatcherZ ライセンス認証</h2>
        </div>

        <p>dispatcherZ 製品版をご利用いただき、誠にありがとうございます。</p>
        <p>ライセンス認証を完了するための「PINコード（6桁）」を発行いたしました。以下のコードをインストーラーの画面に入力して、インストールを開始してください。</p>

        <div class="pin-box">
            <div class="pin-code">{{ $pinCode }}</div>
        </div>

        <p class="warning">※このPINコードの有効期限は発行から15分間です。</p>
        <p>※本メールに心当たりがない場合は、第三者が誤ってメールアドレスを入力した可能性があります。その場合は本メールを破棄していただきますようお願いいたします。</p>

        <div class="footer">
            <p><strong>Webflame (ウェブフレイム)</strong></p>
            <p>〒577-xxxx 大阪府東大阪市xxxxxxxx</p>
            <p>Web: https://webflame.jp</p>
            <p>※このメールは送信専用アドレスから自動送信されています。</p>
        </div>
    </div>
</body>
</html>