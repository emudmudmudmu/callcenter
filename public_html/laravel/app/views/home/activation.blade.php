@extends('layouts.home', [
	'page_title' => '会員の本登録'
])

@section('content')

	@if($result)
		<div class="alert alert-success">
			本登録が完了しました。<br>
			<div class="text-center">{{ HTML::linkRoute('auth.login', 'ログインする') }}</div>
		</div>
	@else
		<div class="alert alert-danger">
			URLが間違っています。もう一度お確かめの上アクセスしてください。
		</div>
	@endif

@stop