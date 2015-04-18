@extends('layouts.employer', [
	'page_title' => '応募情報の詳細',
	'bakery_params' => [
		'employer.dashboard' => 'ホーム', 
		'employer.application.index' => '応募情報', 
		'*' => '応募情報の詳細'
	]
])

@section('content')

    <div id="main">
        <div class="container">
          <div class="row row-offcanvas row-offcanvas-right">

            <div class="col-md-12">
              <div class="row">
                <h2 class="page-title">{{ $application->job->title }}</h2>
                  <div class="text-right">
                      <a href="{{ route('employer.application.index') }}" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left"></span> 応募情報の一覧</a>
                      </div>
                <table class="application-detail-table">
                    <tr>
                        <td colspan="2" class="application-detail-title"><span class="glyphicon glyphicon-user"></span>{{ $application->job->title }}</td>
                    </tr>
                    <tr>
                        <th>
                            名前
                        </th>
                        <td>
                           {{ $application->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            ふりがな
                        </th>
                        <td>
                            {{ $application->kana }}
                        </td>
                    </tr>                  
                    <tr>
                        <th>
                          住所
                        </th>
                        <td>
                            〒{{ $application->zip_code }}<br>
                            {{ JapanesePrefectures::prefectureName($application->prefecture_id) }}{{ $application->city }}{{ $application->other_address_1 }}{{ $application->other_address_2 }}
                        </td>
                    </tr>               
                    <tr>
                        <th>
                            生年月日
                        </th>
                        <td>
                            {{ $application->birth_year }}年{{ $application->birth_month }}月{{ $application->birth_month }}日
                        </td>
                    </tr>               
                    <tr>
                        <th>
                            性別
                        </th>
                        <td>
                           {{ $application->gender_text }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            電話番号
                        </th>
                        <td>
                            {{ $application->tel }}
                        </td>
                    </tr>                  
                    <tr>
                        <th>
                            メールアドレス
                        </th>
                        <td>
                            {{ $application->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            現在の職業
                        </th>
                        <td>
                            {{ $application->current_job }}
                        </td>
                    </tr>                  
                    <tr>
                        <th>
                          最終学歴
                        </th>
                        <td>
                            {{ $application->education }}
                        </td>
                    </tr>               
                    <tr>
                        <th>
                            保有資格
                        </th>
                        <td>
                            {{ $application->qualification }}
                        </td>
                    </tr>  
                    <tr>
                        <th>
                            職務経歴
                        </th>
                        <td>
                            {{ $application->career }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            雇用形態
                        </th>
                        <td>
                            {{ JobType::job_type_name($application->job_type_id) }}
                        </td>
                    </tr>
                </table>
                
                {{ Form::open(['route' => ['employer.application.show.post', $application->id]]) }}
                
                <table class="application-detail-table">
                    <tr>
                        <th>
                            進捗状況
                        </th>
                        <td>
                        	{{ Form::select('status', ApplicationStatus::application_statuses(), $application->status, ['class' => 'form-control']) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            企業メモ
                        </th>
                        <td>
                        	{{ Form::textarea('memo', $application->memo, ['class' => 'form-control', 'rows' => '2']) }}
                        </td>
                    </tr>

                </table>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary send-btn">修正</button>
                </div>
                
                {{ Form::close() }}
                
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

@section('script')

<script type="text/javascript">
<!--

	$(document).ready(function(e){

		@include('js/footable')
		@include('js/sortable')
		@include('js/icheck')
		@include('js/all_checked')
		@include('js/multi_delete')
		{{ SearchStrap::js() }}
		
	});

//-->
</script>

@stop