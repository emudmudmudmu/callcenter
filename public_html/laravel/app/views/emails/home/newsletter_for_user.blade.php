<!DOCTYPE html>
<html lang="ja-JP">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<div>
            {{ $name }}様<br><br>

            （このメールは自動送信にてお送りさせていただいております）<br><br>

            メールマガジン登録が完了致しました。<br><br>

            メルマガ登録内容<br>
            --------------------------------------------------<br>
            氏名：{{ $name }}<br>
            メールアドレス：{{ $email }}<br>
            配信希望地域：{{ $prefecture_name }}<br>
            配信希望職種：{{ $job_type }}<br>
            --------------------------------------------------<br>
            今後、リクエストに近い求人情報を送らせていただきます。<br>
            ★ご注意：<br>
            このEメールは配信専用となっております。<br>
            このメールアドレスにご返信いただいてもご返事ができません。<br>
			@include('emails.footer')
		</div>
	</body>
</html>