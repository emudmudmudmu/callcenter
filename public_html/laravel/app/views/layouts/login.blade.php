<!DOCTYPE html>
<html lang="jp">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>コールセンターの窓口 求人掲載管理システム</title>

    <!-- Bootstrap core CSS -->
    {{ HTML::style('employer/css/bootstrap.min.css') }}

    <!-- Custom styles for this template -->
    {{ HTML::style('employer/css/dashboard.css') }}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body class="body_login">
   <div id="login-header"></div>
	@if(FormStrap::hasAlert())
		<div style="padding:10px 15px;">
		{{ FormStrap::alert()->icons([
			'danger' => clone Camon::GL('warning-sign'), 
			'success' => clone Camon::GL('info-sign')
		]) }}
		</div>
	@endif
    <div id="login-main" class="center-block">
          <div class="clearfix">
              <div class="login-logo">
              <a href="{{ route('home') }}">{{ HTML::image('employer/images/login_logo.png', 'コールセンターの窓口 求人掲載管理システム') }}</a>
            </div><!--/.col-xs-12.col-sm-9-->
            <div class="login-form">
               {{ Form::open(['route' => 'auth.login.post']) }}
               <div class="form-inner">
                   <label for="inputLogin2" class="control-label"><img src="{{ url('employer/images/login_userid.png') }}" alt="ユーザーID" width="108" height="19" /></label>
                   <input name="email" type="text" class="form-control userid" id="inputLogin1" />
                   <label for="inputLogin2" class="control-label "><img src="{{ url('employer/images/login_passwd.png') }}" alt="パスワード" width="105" height="19" /></label>
                   <input name="password" type="password" class="form-control passwd" id="inputLogin2" />
                   <label class="checkbox-inline check">
                    <input name="remember" type="checkbox" id="inlineCheckbox1" value="1" checked="checked"> ログイン状態を保存する</label>
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><img src="{{ url('employer/images/login_btn_login.png') }}" alt="ログイン" /></button>
                </div>
                {{ Form::close() }}
                <!--<p class="text-right"><a href="{{ route('auth.reminder') }}"><span class="glyphicon glyphicon-play-circle"></span>パスワードをお忘れの方はこちら</a></p>-->
            </div>
          </div><!--/row-->
    </div>

    <footer class="login-footer">
        @if(App::isLocal())
            <a href="#" onclick="document.getElementById('inputLogin1').value='{{ Config::get('app.emails.main') }}';document.getElementById('inputLogin2').value='admin';document.forms[0].submit();">管理者ログイン</a>｜
            <a href="#" onclick="document.getElementById('inputLogin1').value='employer@example.com';document.getElementById('inputLogin2').value='test';document.forms[0].submit();">企業ログイン</a>
        @endif
        <p><img src="{{ url('employer/images/copyright.png') }}" alt="Copyright(c) 2015 STARMEDIA, Inc. All Rights Reserved." /></p>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->

	@if(App::isLocal())
		<script src="http://{{ Config::get('app.domains.main') }}:35729/livereload.js"></script>
	    {{ Brick::render() }}
	@endif
    
  </body>
</html>
