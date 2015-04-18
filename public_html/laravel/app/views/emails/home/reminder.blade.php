<!DOCTYPE html>
<html lang="ja-JP">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>新パスワードのご送付</h2>

<div>
    新しい会員パスワードが発行されました。<br><br>

    ■新パスワード： {{ $password }}<br><br>

    -------------------------------------------<br>
    ログインURL： {{ route('home.login') }}<br>
    -------------------------------------------<br><br>

    ※このメールは送信専用です。直接返信できませんのでご注意ください。<br>

    @include('emails.footer')
</div>
</body>
</html>
