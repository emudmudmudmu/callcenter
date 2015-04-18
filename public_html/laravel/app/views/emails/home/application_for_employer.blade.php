<!DOCTYPE html>
<html lang="ja-JP">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<div>

            {{ $job->user->last_name }}様<br><br>

            （このメールは自動送信にてお送りさせていただいております）<br><br>

            {{ $job->title }}の求人応募がありました。<br><br>

            --------------------------------------------------<br>
            求人タイトル：{{ $job->title }}<br>
            応募者名：{{ $application->name }}<br>
            応募者連絡先：{{ $application->tel }}<br>
            応募者メールアドレス：{{ $application->email }}<br>
            --------------------------------------------------<br>
            求人応募者へ数日以内に今後のやりとりの連絡をお願いいたし<br>
            ます。なお、応募詳細は管理画面でも確認できます。<br>
            ★ご注意：<br>
            このEメールは配信専用となっております。<br>
            このメールアドレスにご返信いただいてもご返事ができません。<br>
			@include('emails.footer')
		</div>
	</body>
</html>