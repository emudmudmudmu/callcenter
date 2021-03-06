@extends('layouts.login', [
	'page_title' => 'ログイン'
])

@section('content')

    <div class="container">
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">{{ Camon::FA('key') }}ログイン</div>
                        <div style="position: relative; top:-5px" class="pull-right font-size-sm">
                        	{{ HTML::linkRoute('auth.reminder', 'パスワードを忘れましたか？') }}
                        </div>
                    </div>     

                    <div style="padding-top:30px" class="padding-lg" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                        
                        {{ Form::open(['route' => 'auth.login.post', 'class' => 'form-horizontal', 'role' => 'form']) }}
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        {{ Form::text('email', '', ['placeholder' => 'メールアドレス', 'class' => 'form-control']) }}                                       
                                    </div>
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        {{ Form::password('password', ['placeholder' => 'パスワード', 'class' => 'form-control']) }}      
                                    </div>
                                    

                                
                            <div class="input-group">
                                      <div class="checkbox">
                                        <label>
                                          <input id="login-remember" type="checkbox" name="remember" value="1">次回から省略
                                        </label>
                                      </div>
                                    </div>


                                <div style="margin-top:10px;margin-bottom:15px;" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls text-right">
                                      <button id="btn-login" href="#" class="btn btn-success">ログインする {{ Camon::GL('circle-arrow-right', [], false) }}</button>
                                    </div>
                                </div>

								<hr class="hr-md">
                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div class="font-size-sm text-muted">
                                            アカウントをお持ちではありませんか？
                                        {{ HTML::linkRoute('auth.signup', '新規会員登録（未開発）') }}
                                        </div>
                                    </div>
                                </div>    
                            {{ Form::close() }}
                        </div>                     
                    </div>  
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>

@stop