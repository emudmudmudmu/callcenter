@extends('layouts.home', [
	'page_title' => 'ログイン'
])

@section('content')

    <section class="l-contents cf">
        <section class="l-main">
            <div class="login">
                @if(FormStrap::hasAlert(['success']))
                <br>
                <div class="loginregister">
                    {{ HTML::image('home/assets/img/login/touroku.png', '新規登録完了', ['width' => '750', 'height' => '120']) }}
                </div>
                @elseif(FormStrap::hasAlert(['danger']))
                <h2 class="h">{{ HTML::image('home/assets/img/form/h_login.png', 'ログイン', ['width' => '750', 'height' => '95']) }}</h2>
                    <div class="loginerror">
                        <p>メールアドレス、又は、パスワードが違います。</p>
                    </div>
                @else
                <h2 class="h">{{ HTML::image('home/assets/img/form/h_login.png', 'ログイン', ['width' => '750', 'height' => '95']) }}</h2>

                @endif
                <div class="formbox">
                    <h3>ログインフォーム</h3>
                    {{ Form::open(['route' => 'auth.login']) }}
                        <dl>
                            <dt>メールアドレス　<span class="required">[必須]</span></dt>
                            <dd>{{ Form::text('email') }}</dd>
                            <dt>パスワード　<span class="required">[必須]</span></dt>
                            <dd>{{ Form::password('password') }}&nbsp;&nbsp;{{ HTML::linkRoute('home.reminder', 'ログインパスワードの再発行') }}</dd>
                        </dl>
                        <p class="btn"><input type="image" src="home/assets/img/form/btn_login.png" alt="ログイン"></p>
                    {{ Form::close() }}
                </div>
            </div><!-- /.login -->
        </section><!-- /.l-main -->

@stop