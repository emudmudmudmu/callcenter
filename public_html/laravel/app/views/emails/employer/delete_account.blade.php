<!DOCTYPE html>
<html lang="ja-JP">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>企業様より退会申請がありました。</h2>

		<div>
			■企業名<br>
			{{ $user->last_name }}
			<br>
			<br>
			■アカウントID<br>
			{{ $user->account_id }}
			<br>
			<br>
			■メールアドレス<br>
			{{ $user->email }}
			<br>
			<br>
			@if(!empty($employer->employer_meta->tel))
			■電話番号<br>
			{{ $employer->employer_meta->tel }}
			<br>
			<br>
			@endif
			@if(!empty($employer->employer_meta->fax))
			■電話番号<br>
			{{ $employer->employer_meta->fax }}
			<br>
			<br>
			@endif
			■住所<br>
			〒{{ $employer->employer_meta->zip_code_1 }}-{{ $employer->employer_meta->zip_code_2 }}<br>
			{{ $employer->employer_meta->address->prefecture_name }}{{ $employer->employer_meta->address->city_name }}{{ $employer->employer_meta->other_address }}
			<br>
			<br>
			■担当部署<br>
			{{ $pic_department }}
			<br>
			<br>
			■担当者名<br>
			{{ $pic_name }}
			<br>
			<br>
			■解約・退会理由<br>
			{{ nl2br($reason) }}
			<br>
			<br>
			@include('emails.footer')
		</div>
	</body>
</html>
