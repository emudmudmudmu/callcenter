@extends('layouts.employer', [
	'page_title' => '求人情報の登録', 
	'bakery_params' => [
		'employer.dashboard' => 'ホーム', 
		'employer.job.index' => '登録済み求人情報の一覧', 
		'*' => '求人情報の登録'
	]
])

@section('content')

    <div id="main">
        <div class="container">
          <div class="row row-offcanvas row-offcanvas-right">

            <div class="col-md-12">
              <div class="row">
                <h2 class="page-title"><span class="glyphicon glyphicon-user"></span>{{ HTML::image('employer/images/h2_job_entry.png', '求人情報の登録') }}</h2>
                <table class="job-entry-table">
                    <tr>
                        <td class="job-entry-title"><span class="glyphicon glyphicon-file"></span>基本情報<br />
                        <span class="glyphicon glyphicon-pencil"></span>応募・選考について<br />
                            <span class="glyphicon glyphicon-picture"></span>画像登録<br />
                        
                            
                            <span class="glyphicon glyphicon-envelope"></span>応募通知<br />
                            
                            <span class="glyphicon glyphicon-ok"></span>応募通知</td>
                    </tr>
                    <tr>
                        <td>
                         <p class="text-center">求人情報を登録いたしました。</p>
                        </td>
                    </tr>
                    </table>
                  
                  
                  
                  
                  
                <div class="text-center">
                    <a href="{{ route('employer.dashboard') }}" class="btn btn-default send-btn"><span class="glyphicon glyphicon-chevron-left"></span>TOPに戻る</a>
                </div>
              </div><!--/row-->

 
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