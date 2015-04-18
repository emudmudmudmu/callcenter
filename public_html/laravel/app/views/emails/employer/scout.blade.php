<!DOCTYPE html>
<html lang="ja-JP">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<div>
			{{ $applicant->last_name }}{{ $applicant->first_name }}様<br>
			{{ Config::get('app.site_title') }}をご利用いただきましてありがとうございます。<br>
			{{ Config::get('app.site_title') }}運営事務局でございます。<br>
			{{ $employer->last_name }}さんからメッセージが届いています。<br>
			※このメールは送信専用です。直接返信できませんのでご注意ください。<br><br>
			
			{{ $employer->last_name }}さんから、下記のお仕事についてスカウトメールが届いています。<br>
			ぜひご興味がございましたら応募してみてください。<br><br>
			
			――――――――――――――――――――――――――――――――――<br>
			■{{ $job->title }}<br>
			■{{ $job->catch_phrase }}<br>
			――――――――――――――――――――――――――――――――――<br><br>
			
			詳細は以下からからご確認ください。<br>
			{{ HTML::link($url, $url) }}<br><br>
			
			よろしくお願いいたします。<br><br>
			
			@include('emails.footer')
		</div>
	</body>
</html>


