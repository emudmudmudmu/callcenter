<!DOCTYPE html>
<html lang="jp">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ $page_title }}</title>

    <!-- Bootstrap core CSS -->
    {{ HTML::style('employer/css/bootstrap.min.css?'. Config::get('app.last_upgraded')) }}

    <!-- Custom styles for this template -->
    {{ HTML::style('employer/css/dashboard.css?'. Config::get('app.last_upgraded')) }}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    @yield('style')
    
  </head>

  <body>
    <!-- Static navbar -->
    <div id="header">
      <div class="container">
        <div class="row">
          <div class="header-logo col-sm-4">
            <a class="header-brand" href="{{ route('employer.dashboard') }}">{{ HTML::image('employer/images/logo.png') }}</a>
          </div>
          <div class="header-message col-sm-4">
            お疲れ様です。{{ $user->last_name }}様
          </div>

          <div class="header-time col-sm-4">
            最終ログイン日時：{{ $user->last_login->format('Y/m/d H:i') }}
          </div>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            @if(starts_with(Route::currentRouteName(), 'employer.dashboard'))
            <li class="active"><a href="{{ route('employer.dashboard') }}">{{ HTML::image('employer/images/gnavi01_on.png') }}</a></li>
            @else
            <li><a href="{{ route('employer.dashboard') }}">{{ HTML::image('employer/images/gnavi01_off.png') }}</a></li>
            @endif
            @if(starts_with(Route::currentRouteName(), 'employer.job'))
            <li class="dropdown active">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ HTML::image('employer/images/gnavi02_on.png', '求人情報') }} <span class="caret"></span></a>
            @else
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ HTML::image('employer/images/gnavi02_off.png', '求人情報') }} <span class="caret"></span></a>
            @endif
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('employer.job.create') }}">求人情報の登録</a></li>
                <li><a href="{{ route('employer.job.index') }}">登録済み求人情報の一覧</a></li>
              </ul>
            </li>
            @if(starts_with(Route::currentRouteName(), 'employer.application'))
            <li class="dropdown active">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ HTML::image('employer/images/gnavi03_on.png', '応募情報') }}  <span class="caret"></span></a>
            @else
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ HTML::image('employer/images/gnavi03_off.png', '応募情報') }}  <span class="caret"></span></a>
            @endif
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('employer.application.index') }}">応募情報の一覧</a></li>
              </ul>
            </li>
            @if(starts_with(Route::currentRouteName(), 'employer.settings') || starts_with(Route::currentRouteName(), 'employer.delete_account'))
            <li class="dropdown active">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ HTML::image('employer/images/gnavi04_on.png', '登録情報') }}  <span class="caret"></span></a>
            @else
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ HTML::image('employer/images/gnavi04_off.png', '登録情報') }}  <span class="caret"></span></a>
            @endif
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('employer.settings') }}">企業情報の変更</a></li>
                <li><a href="{{ route('employer.delete_account') }}">サービスの解約・退会</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ route('auth.logout') }}">{{ HTML::image('employer/images/gnavi_logout.png', 'ログアウト') }} <span class="glyphicon glyphicon-log-out"></span></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div style="padding:0 50px;">
    {{ FormStrap::alert()->icons([
      'danger' => clone Camon::GL('warning-sign'), 
      'success' => clone Camon::GL('info-sign')
    ]) }}
    </div>
    @yield('content')
    <footer class="footer">
      <div class="container">
        <p><img src="{{ url('employer/images/copyright.png') }}" alt="Copyright(c) 2015 STARMEDIA, Inc. All Rights Reserved." /></p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    {{ HTML::script('employer/js/bootstrap.min.js?'. Config::get('app.last_upgraded')) }}
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    
	{{ HTML::script('bower_components/blueimp-file-upload/js/jquery.iframe-transport.js?'. Config::get('app.last_upgraded')) }}
	{{ HTML::script('bower_components/blueimp-file-upload/js/vendor/jquery.ui.widget.js?'. Config::get('app.last_upgraded')) }}
	{{ HTML::script('bower_components/blueimp-file-upload/js/jquery.fileupload.js?'. Config::get('app.last_upgraded')) }}
	{{ HTML::script('bower_components/blueimp-load-image/js/load-image.all.min.js?'. Config::get('app.last_upgraded')) }}
	{{ HTML::script('bower_components/blueimp-tmpl/js/tmpl.min.js?'. Config::get('app.last_upgraded')) }}
    
	@yield('script')
	@if(App::isLocal())
		<script src="http://{{ Config::get('app.domains.main') }}:35729/livereload.js"></script>
	    {{ Brick::render() }}
	@endif
    
  </body>
</html>