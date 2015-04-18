<!DOCTYPE html>
<html lang="ja-JP">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<div>
            {{ $application->name }}様<br><br>

            （このメールは自動送信にてお送りさせていただいております）<br><br>

            {{ $job->title }}の求人情報への応募が完了いたしました。<br><br>

            --------------------------------------------------<br>
            ■求人タイトル<br>
            {{ $job->title }}<br><br>

            ■企業名<br>
            {{ $job->user->last_name }}<br><br>

            ■お仕事番号（お祝い金申請時に必要です）<br>
            {{ AccountId::text('job', $job->id) }}<br><br>

            ■お仕事情報ページ<br>
            {{ route('home.job_detail', [$job->id]) }}<br>
            --------------------------------------------------<br>
            ★ご注意：<br>
            応募後は、企業から面接日程等の連絡をお待ちください。<br>
            連絡がない場合には、下記お問い合わせメールにてご連絡<br>
            ください。また、別途応募先企業からのメールが届いた場<br>
            合はそちらの案内に従ってください。<br><br>

            このEメールは配信専用となっております。<br>
            このメールアドレスにご返信いただいてもご返事ができません。<br>
			@include('emails.footer')
		</div>
	</body>
</html>