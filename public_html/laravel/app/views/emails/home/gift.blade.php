<!DOCTYPE html>
<html lang="ja-JP">
<head>
    <meta charset="utf-8">
</head>
<body>
<div>
    {{ $shipping_name }}様<br><br>

    （このメールは自動送信にてお送りさせていただいております）<br><br>

    この度は『コールセンターの窓口』にてお祝い金申請ください<br>
    まして、まことにありがとうございます。<br><br>

    申請内容<br>
    --------------------------------------------------<br>
    申請求人情報:{{ $job_title }}（{{ $job_account_id }}）<br>
    面接日:{{ $interview_date }}<br>
    応募者氏名:{{ $shipping_name }}<br>
    メールアドレス:{{ $email }}<br>
    発送先住所:{{ $shipping_address }}<br>
    --------------------------------------------------<br>
    ★ご注意：<br>
    申請内容確認後、発送先住所へQUOカードを送らせていただきます。<br>
    このEメールは配信専用となっております。<br>
    このメールアドレスにご返信いただいてもご返事ができません。<br>
    @include('emails.footer')
</div>
</body>
</html>
