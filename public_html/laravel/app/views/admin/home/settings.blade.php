@extends('layouts.admin', [
	'page_title' => 'ログイン情報の変更', 
	'bakery_params' => [
		'admin.dashboard' => 'ホーム', 
		'*' => 'ログイン情報'
	]
])

@section('content')

	{{ Form::open(['route' => 'admin.settings.post']) }}
	<div class="clearfix">
		<div class="col-md-6 col-lg-6 padding-sm">
		{{ FormStrap::text('email', $user->email)
			->label('メールアドレス', ['class' => 'text-danger'])
			->icon(Camon::FA('angle-double-right'), 'left') }}
		</div>
		<div class="col-md-6 col-lg-6 padding-sm">
		{{ FormStrap::text('confirm_email')
			->label('メールアドレス（確認）', ['class' => 'text-danger'])
			->icon(Camon::FA('angle-double-right'), 'left') }}
		</div>
	</div>
	<div class="clearfix">
		<div class="col-md-6 col-lg-6 padding-sm">
		{{ FormStrap::password('password')
			->label('パスワード', ['class' => 'text-danger'])
			->icon(Camon::FA('angle-double-right'), 'left') }}
		</div>
		<div class="col-md-6 col-lg-6 padding-sm">
		{{ FormStrap::password('confirm_password')
			->label('パスワード（確認）', ['class' => 'text-danger'])
			->icon(Camon::FA('angle-double-right'), 'left') }}
		</div>
	</div>
	<div class="text-right padding-lg">
		{{ FormStrap::submit('送信する '.Camon::GL('circle-arrow-right', [], false), ['class' => 'btn btn-success btn-flat']) }}
	</div>
	{{ FormStrap::attributeNames() }}
	{{ Form::close() }}

@stop