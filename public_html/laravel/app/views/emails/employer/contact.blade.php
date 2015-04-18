<!DOCTYPE html>
<html lang="ja-JP">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>企業様よりお問い合わせがありました。</h2>

		<div>
			■担当部署<br>
			{{ $pic_department }}
			<br>
			<br>
			■担当者名<br>
			{{ $pic_name }}
			<br>
			<br>
			■担当者メールアドレス<br>
			{{ $pic_email }}
			<br>
			<br>
			■お問い合わせ内容<br>
			{{ nl2br($comment) }}
			<br>
			<br>
			@include('emails.footer')
		</div>
	</body>
</html>
