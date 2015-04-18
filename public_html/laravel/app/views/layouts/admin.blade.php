<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{{ $page_title }}</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        {{ HTML::style('css/morris/morris.css?'. Config::get('app.last_upgraded')) }}
        <!-- jvectormap -->
        {{ HTML::style('css/jvectormap/jquery-jvectormap-1.2.2.css?'. Config::get('app.last_upgraded')) }}
        <!-- Date Picker -->
        {{ HTML::style('css/datepicker/datepicker3.css?'. Config::get('app.last_upgraded')) }}
        <!-- Daterange picker -->
        {{ HTML::style('css/daterangepicker/daterangepicker-bs3.css?'. Config::get('app.last_upgraded')) }}
        <!-- bootstrap wysihtml5 - text editor -->
        {{ HTML::style('css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css?'. Config::get('app.last_upgraded')) }}
        <!-- Theme style -->
        {{ HTML::style('css/AdminLTE.css?'. Config::get('app.last_upgraded')) }}
        {{ HTML::style('dist/css/vendor.min.css?'. Config::get('app.last_upgraded')) }}
        {{ HTML::style('dist/css/concat.min.css?'. Config::get('app.last_upgraded')) }}
        
        {{ HTML::style('bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css?'. Config::get('app.last_upgraded')) }}
        {{ HTML::style('bower_components/footable/css/footable.core.css?'. Config::get('app.last_upgraded')) }}
        {{ HTML::style('css/timepicker/bootstrap-timepicker.min.css?'. Config::get('app.last_upgraded')) }}
        {{ HTML::style('css/iCheck/flat/grey.css?'. Config::get('app.last_upgraded')) }}
        {{ HTML::style('bower_components/jBox/Source/jBox.css?'. Config::get('app.last_upgraded')) }}
        {{ HTML::style('bower_components/jBox/Source/themes/TooltipDark.css?'. Config::get('app.last_upgraded')) }}
        
        <link rel="shortcut icon" href="{{ url('favicon.ico?'. Config::get('app.last_upgraded')) }}">

        @yield('style')
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="{{ route('admin.dashboard') }}" class="logo" target="_blank">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                {{ HTML::image('img/logo.png') }}
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                    	@if($view_mode == 'admin' && $notification_count > 0)
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-info-circle"></i> 
                                <span class="label label-danger">{{ $notification_count }}</span>
                            </a>
                            <ul class="dropdown-menu">
                            @if($unactivated_job_count > 0)
                                <li class="header"><a href="{{ route('admin.job.index', ['activated=0']) }}">{{ $unactivated_job_count }}件の審査待ち求人があります。</a></li>
                            @endif
                            @if($unchecked_gift_count > 0)
                                <li class="header"><a href="{{ route('admin.gift.index', ['check_flag=0']) }}">{{ $unchecked_gift_count }}件のお祝い金申請があります。</a></li>
                            @endif</ul>
                            
                        </li>
                        @elseif($view_mode == 'employer' && $consideration_count > 0)
                        <li class="dropdown notifications-menu">
                            <a href="{{ route('employer.applicant.consideration') }}">検討中リスト</a>
                        </li>
                    	@endif
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span>{{ $user->email }}<i class="caret"></i></span>
                            </a>
							<ul class="dropdown-menu">
								<!-- Menu Footer-->
								<li class="user-footer">
									@if($view_mode != 'employer')
									<div class="pull-left">
										{{ HTML::linkRoute($view_mode .'.settings', 'ログイン情報の変更', [], ['class' => 'btn btn-default btn-flat']) }}
									</div>
									@else
									<div class="pull-left">
										{{ HTML::linkRoute('employer.settings', '企業情報の変更', [], ['class' => 'btn btn-default btn-flat']) }}
									</div>
									@endif
									<div class="pull-right">
										{{ HTML::linkRoute('auth.logout', 'ログアウト', [], ['class' => 'btn btn-danger btn-flat', 'style' => 'color:white']) }}
									</div>
								</li>
							</ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="text-center info">
                            こんにちは、{{ $user->last_name }}様。
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                    	@foreach(Menu::items($view_mode) as $icon => $item_values)
                    		@if(is_array($item_values))
								<li class="treeview{{ (Menu::hasCurrent($item_values)) ? ' active' : '' }}">
								    <a href="#">
								    	{{ Menu::title($icon) }}
								        <i class="fa fa-angle-left pull-right"></i>
								    </a>
								    <ul class="treeview-menu">
								    	@foreach($item_values as $item_value)
								        	<li>
								        		{{ Menu::link($item_value) }}
							        		</li>
								        @endforeach
								    </ul>
								</li>
							@else
								<li{{ (Menu::hasCurrent($item_values)) ? ' class="active"' : '' }}>
									{{ Menu::link($item_values, $icon) }}
								</li>
	                        @endif
                    	@endforeach
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 style="color:#555;">
                        {{ $page_title }}
                    </h1>
                    <ol class="breadcrumb">
                    
                    	@if(isset($bakery_params))
							@foreach(Bakery::get($bakery_params) as $bakery)
							
							    @if($bakery->isCurrent)
							
							        <li>{{ $bakery->title }}</li>
							
							    @else
							
							        <li>{{ HTML::link($bakery->url, $bakery->title) }}</li>
							
							    @endif
							
							@endforeach
						@endif
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">


                {{ FormStrap::alert()->icons([
					'danger' => clone Camon::GL('warning-sign'), 
					'success' => clone Camon::GL('info-sign')
				]) }}
                @yield('content')

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        {{ HTML::script('js/plugins/morris/morris.min.js?'. Config::get('app.last_upgraded')) }}
        <!-- Sparkline -->
        {{ HTML::script('js/plugins/sparkline/jquery.sparkline.min.js?'. Config::get('app.last_upgraded')) }}
        <!-- jvectormap -->
        {{ HTML::script('js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js?'. Config::get('app.last_upgraded')) }}
        {{ HTML::script('js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js?'. Config::get('app.last_upgraded')) }}
        <!-- jQuery Knob Chart -->
        {{ HTML::script('js/plugins/jqueryKnob/jquery.knob.js?'. Config::get('app.last_upgraded')) }}
        <!-- daterangepicker -->
        {{ HTML::script('js/plugins/daterangepicker/daterangepicker.js?'. Config::get('app.last_upgraded')) }}
        <!-- datepicker -->
        {{ HTML::script('js/plugins/datepicker/bootstrap-datepicker.js?'. Config::get('app.last_upgraded')) }}
        {{ HTML::script('js/plugins/datepicker/locales/bootstrap-datepicker.ja.js?'. Config::get('app.last_upgraded')) }}
        <!-- Bootstrap WYSIHTML5 -->
        {{ HTML::script('js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js?'. Config::get('app.last_upgraded')) }}
        <!-- iCheck -->
        {{ HTML::script('js/plugins/iCheck/icheck.min.js?'. Config::get('app.last_upgraded')) }}

        <!-- AdminLTE App -->
        {{ HTML::script('js/AdminLTE/app.js?'. Config::get('app.last_upgraded')) }}
        
		{{ HTML::script('bower_components/jquery-autosize/jquery.autosize.min.js?'. Config::get('app.last_upgraded')) }}
		{{ HTML::script('bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js?'. Config::get('app.last_upgraded')) }}
		{{ HTML::script('bower_components/bootstrap.file-input/index.js?'. Config::get('app.last_upgraded')) }}
		{{ HTML::script('bower_components/blueimp-file-upload/js/jquery.iframe-transport.js?'. Config::get('app.last_upgraded')) }}
		{{ HTML::script('bower_components/blueimp-file-upload/js/vendor/jquery.ui.widget.js?'. Config::get('app.last_upgraded')) }}
		{{ HTML::script('bower_components/blueimp-file-upload/js/jquery.fileupload.js?'. Config::get('app.last_upgraded')) }}
		{{ HTML::script('bower_components/blueimp-load-image/js/load-image.all.min.js?'. Config::get('app.last_upgraded')) }}
		{{ HTML::script('bower_components/blueimp-tmpl/js/tmpl.min.js?'. Config::get('app.last_upgraded')) }}
		{{ HTML::script('bower_components/matchHeight/jquery.matchHeight.js?'. Config::get('app.last_upgraded')) }}
		{{ HTML::script('bower_components/footable/js/footable.js?'. Config::get('app.last_upgraded')) }}
		{{ HTML::script('js/plugins/timepicker/bootstrap-timepicker.min.js?'. Config::get('app.last_upgraded')) }}
		{{ HTML::script('bower_components/jBox/Source/jBox.min.js?'. Config::get('app.last_upgraded')) }}
		{{ HTML::script('dist/js/concat.min.js?1421747952?'. Config::get('app.last_upgraded')) }}
		
        @yield('script')
        
		@if(App::isLocal())
			<script src="http://{{ Config::get('app.domains.main') }}:35729/livereload.js"></script>
		    {{ Brick::render() }}
		@endif
    </body>
</html>