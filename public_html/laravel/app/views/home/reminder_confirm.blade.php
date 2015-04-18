@extends('layouts.home', [
	'page_title' => 'パスワードの再発行'
])

@section('content')

    <section class="l-contents cf">
        <section class="l-main">
            <div class="login">
                <h2 class="h">{{ HTML::image('home/assets/img/form/h_login.png', 'ログイン', ['width' => '750', 'height' => '95']) }}</h2>
                <div class="formbox">
                    <p class="confirm-txt">内容をご確認の上、ご送信ください。</p>
                    <h3>パスワードの再発行フォーム</h3>
                    {{ Form::open(['route' => 'home.reminder_complete']) }}
                        <dl>
                            <dt>メールアドレス　<span class="required">[必須]</span></dt>
                            <dd>{{ Input::get('email') }}{{ Form::hidden('email', Input::get('email')) }}</dd>
                        </dl>
                        <p class="btn"><input type="image" src="{{ url('home/assets/img/form/btn_submit.png') }}" alt="送信する"></p>
                    {{ Form::close() }}
                </div>
            </div><!-- /.login -->
        </section><!-- /.l-main -->

@stop