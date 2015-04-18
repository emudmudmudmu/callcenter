<!DOCTYPE html>
<html lang="ja-JP">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>お問い合わせがありました。</h2>

		<div>
			■名前<br>
			{{ $name }}<br><br>
			■メールアドレス<br>
			{{ $email }}<br><br>
			■お問い合わせの種類<br>
			{{ $subject }}<br><br>
			■メッセージ<br>
			{{ nl2br($mail_body) }}<br>
			@include('emails.footer')
		</div>
	</body>
</html>
