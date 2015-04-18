<!DOCTYPE html>
<html lang="ja-JP">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>メールマガジンの申し込みがありました。</h2>
		<div>
			■氏名<br>
			{{ $name }}<br><br>
			■メールアドレス<br>
			{{ $email }}<br><br>
			■配信希望地域<br>
			{{ $prefecture_name }}<br><br>
			■配信希望職種<br>
			{{ $job_type }}<br>
			@include('emails.footer')
		</div>
	</body>
</html>
