<!DOCTYPE html>
<html lang="ja-JP">
<head>
    <meta charset="utf-8">
</head>
<body>
<div>
    {{ $name }}様<br><br>

    （このメールは自動送信にてお送りさせていただいております）<br><br>

    この度は『コールセンターの窓口』へお問い合わせいただき<br>
    まことにありがとうございます。内容を確認後、当社担当者<br>
    よりご連絡させていただきます。<br><br>

    お問い合わせ内容<br>
    --------------------------------------------------<br>
    {{ nl2br($mail_body) }}<br>
    --------------------------------------------------<br>
    ★ご注意：<br>
    このEメールは配信専用となっております。<br>
    このメールアドレスにご返信いただいてもご返事ができません。<br>
    @include('emails.footer')
</div>
</body>
</html>