<!DOCTYPE html>
<html lang="ja-JP">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>パスワード再発行URL</h2>

		<div>
			以下のURLからパスワードの再発行をすることができます。<br><br>
			{{ HTML::link($url, $url) }}<br>
			@include('emails.footer')
		</div>
	</body>
</html>
