@extends('layouts.home', [
	'page_title' => 'パスワードの再発行'
])

@section('content')

    <section class="l-contents cf">
        <section class="l-main">
            <div class="login">
                <h2 class="h">{{ HTML::image('home/assets/img/form/h_login.png', 'ログイン', ['width' => '750', 'height' => '95']) }}</h2>
                @if(FormStrap::hasAlert(['danger']))
                @elseif(FormStrap::hasAlert(['success']))
                    {{ HTML::image('home/assets/img/form/password.png', 'パスワード発行', ['width' => '750', 'height' => '120']) }}
                @else
                <div class="formbox">
                    <h3>パスワードの再発行フォーム</h3>
                    {{ Form::open(['route' => 'home.reminder_confirm']) }}
                        <dl>
                            <dt>メールアドレス　<span class="required">[必須]</span></dt>
                            <dd>{{ Form::text('email') }}<br>
                                ご登録時のメールアドレスを入力して下さい。</dd>
                        </dl>
                        <p class="btn"><input type="image" src="{{ url('home/assets/img/form/btn_confirm_l.png') }}" alt="個人情報の取り扱いに同意し、内容を確認する"></p>
                    {{ Form::close() }}
                </div>
                @endif
            </div><!-- /.login -->
        </section><!-- /.l-main -->

@stop