@extends('layouts.home', [
	'page_title' => 'パスワード再設定'
])

@section('content')

    <div class="container">
        <div style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info" >
					<div class="panel-heading">
                        <div class="panel-title">{{ Camon::FA('key') }}パスワード再設定</div>
                    </div>
					<div class="padding-lg text-muted">新しいパスワードを入力してください。<br>（{{ Config::get('app.password.min') }}〜{{ Config::get('app.password.max') }}文字）
						<hr class="hr-md">
                        {{ Form::open(['route' => ['auth.password_reset.post', $id, $reset_code], 'class' => 'form-horizontal']) }}
                                
						<div class="padding-lg">
							{{ FormStrap::password('password', '')
								->label('パスワード')
								->icon(Camon::FA('angle-right'), 'left') }}
							{{ FormStrap::password('confirm_password', '')
								->label('パスワード（確認）')
								->icon(Camon::FA('angle-right'), 'left') }}
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