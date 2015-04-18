@extends('layouts.employer', [
	'page_title' => trans('versatile.title.index', ['name' => $data_name]),
	'bakery_params' => [
		'employer.dashboard' => 'ホーム', 
		'*' => trans('versatile.title.index', ['name' => $data_name])
	]
])

@section('content')

    <div id="main">
        <div class="container">
          <div class="row row-offcanvas row-offcanvas-right">

            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title"><span class="glyphicon glyphicon-bullhorn"></span><img src="./images/h2_news.png" alt="お知らせ" /></h2>

                    <ul class="news-list list-unstyled">
                    	@if($announcements->count() > 0)
                    		@foreach($announcements as $index => $announcement)
	                        <li><span class="glyphicon glyphicon-play-circle"></span><span class="news-date">{{ $announcement->created_at->format('Y/m/d') }}</span> {{ HTML::linkRoute('employer.announcement.detail', $announcement->title, [$announcement->id]) }}</li>
	                       @endforeach
                    	@endif
                    </ul>

                  </div>
              </div><!--/row-->


            </div><!--/.col-xs-12.col-sm-9-->

          </div><!--/row-->
          <div class="text-right">
              {{ $announcements->links() }}
          </div>
        </div>
    </div>
	
@stop