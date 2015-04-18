@extends('layouts.employer', [
	'page_title' => $data_name .'の詳細',
	'bakery_params' => [
		'employer.dashboard' => 'ホーム', 
		'employer.announcement.index' => trans('versatile.title.index', ['name' => $data_name]), 
		'*' => $data_name .'の詳細'
	]
])

@section('content')

    <div id="main">
        <div class="container">
          <div class="row row-offcanvas row-offcanvas-right">

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-title"><span class="glyphicon glyphicon-bullhorn"></span>{{ HTML::image('employer/images/h2_news.png', 'お知らせ') }}</h2>
                        <div class="news-detail-head clearfix">
                            <p class="news-detail-title">{{ $announcement->title }}</p>
                            <p class="news-detail-date">({{ $announcement->created_at->format('Y/m/d') }})</p>                               </div>
                    </div>
                </div><!--/row-->

                <div class="row">
                    <div class="col-md-12">
                        <div class="news-detail-content">
                            {{ nl2br($announcement->description) }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center">
                            <a href="{{ route('employer.announcement.index') }}" class="btn btn-default send-btn"><span class="glyphicon glyphicon-chevron-left"></span>お知らせの一覧に戻る</a></p>
                    </div>
                </div>


            </div><!--/.col-xs-12.col-sm-9-->

          </div><!--/row-->
        </div>
    </div>
    <div class="pagetop">
        <div class="container">
            <p class="text-right"><a href="#header"><span class="glyphicon glyphicon-chevron-up"></span>ページの先頭へ</a></p>      
        </div>
    </div>
	
@stop