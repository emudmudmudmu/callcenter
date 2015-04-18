<!DOCTYPE html>
<html lang="ja-JP">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>仮登録が完了しました。</h2>

		<div>
			この度は、{{ Config::get('app.site_title') }}に仮登録いただきましてありがとうございます。<br><br>
			
			本登録用は下記のURLから行うことができます。<br><br>
			
			-------------------------------------------<br><br>
			{{ HTML::link($activation_url, $activation_url) }}<br><br>
			-------------------------------------------<br><br>
			
			※このメールは送信専用です。直接返信できませんのでご注意ください。<br>
			
			@include('emails.footer')
		</div>
	</body>
</html>
