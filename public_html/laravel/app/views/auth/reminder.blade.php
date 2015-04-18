@extends('layouts.home', [
	'page_title' => 'パスワードの再発行'
])

@section('content')

    <div class="container">
        <div style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info" >
					<div class="panel-heading">
                        <div class="panel-title">{{ Camon::FA('key') }}パスワード再発行</div>
                        <div style="position: relative; top:-5px" class="pull-right font-size-sm">
                        	{{ HTML::linkRoute('auth.login', 'ログインページへ戻る') }}
                        </div>
                    </div>
					<div class="padding-lg text-muted">登録されたメールアドレス入力してください。<br>再発行URLの記載されたメールを送信致します。
						<hr class="hr-md">
                        {{ Form::open(['route' => 'auth.reminder.post', 'class' => 'form-horizontal']) }}
						<div class="padding-lg">
							{{ FormStrap::text('email')->label('メールアドレス') }}
							{{ FormStrap::view('captcha', 'partials.form.captcha')->label('画像認証') }}
						</div>
						{{ FormStrap::attributeNames() }}
						<div style="margin-top:10px;margin-bottom:15px;" class="form-group">
							<div class="col-sm-12 controls text-right">
							<button type="submit" class="btn btn-success">送信する {{ Camon::GL('circle-arrow-right', [], false) }}</button>
						</div>
						{{ Form::close() }}
					</div>
				</div>                     
			</div>  
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
@stop