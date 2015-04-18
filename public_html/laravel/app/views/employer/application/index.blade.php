@extends('layouts.employer', [
	'page_title' => '応募情報の一覧', 
	'bakery_params' => [
		'employer.dashboard' => 'ホーム', 
		'*' => '応募情報の一覧'
	]
])

@section('content')

    <div id="main">
        <div class="container">
          <div class="row row-offcanvas row-offcanvas-right">
            <div class="col-md-12">
            
              {{ Form::open(['route' => 'employer.application.index', 'method' => 'GET']) }}
              
              <div class="row">
                    <h2 class="page-title"><span class="glyphicon glyphicon-pencil"></span><img src="./images/h2_application.png" alt="応募情報の一覧" /></h2>
                    <table class="search-table">
                        <tr>
                            <th>求職者ID</th><td>{{ Form::text('applicant_id', Input::get('applicant_id'), ['class' => 'form-control']) }}</td>
                            <th>求職者名</th><td>{{ Form::text('applicant_name', Input::get('applicant_name'), ['class' => 'form-control']) }}</td>
                        </tr>
                        <tr>
                            <th>求人ID</th><td>{{ Form::text('job_id', Input::get('job_id'), ['class' => 'form-control']) }}</td>
                            <th>求人タイトル</th><td>{{ Form::text('job_title', Input::get('job_title'), ['class' => 'form-control']) }}</td>
                        </tr>
                        <tr>
                            <th>進捗状況</th>
                            <td colspan="3">
                                @foreach(ApplicationStatus::application_statuses() as $status_id => $status_name)
	                                <label class="checkbox-inline">
	                                  {{ Form::checkbox('status_ids[]', $status_id, (Input::exists('status_ids') && in_array($status_id, Input::get('status_ids')))) }} {{ $status_name }}
	                                </label>
                                @endforeach  
                            </td>
                        </tr>
                        <tr>
                            <th>応募日</th>
                            <td colspan="3">
                                {{ Form::select('application_start_year', Year::release_year_numeric_data(), Input::get('application_start_year'), ['class' => 'form-control form-year']) }} 年
                                {{ Form::select('application_start_month', Month::month_numeric_data(),  Input::get('application_start_month'), ['class' => 'form-control form-month']) }} 月
                                {{ Form::select('application_start_day', Day::day_numeric_data(),  Input::get('application_start_day'), ['class' => 'form-control form-day']) }} 日　〜　
                                {{ Form::select('application_end_year', Year::release_year_numeric_data(),  Input::get('application_end_year'), ['class' => 'form-control form-year']) }} 年
                                {{ Form::select('application_end_month', Month::month_numeric_data(),  Input::get('application_end_month'), ['class' => 'form-control form-month']) }} 月
                                {{ Form::select('application_end_day', Day::day_numeric_data(),  Input::get('application_end_day'), ['class' => 'form-control form-day']) }} 日
                            </td>
                        </tr>
                        <tr>
                            <th>採用日</th>
                            <td colspan="3">
                                {{ Form::select('employment_start_year', Year::release_year_numeric_data(), Input::get('employment_start_year'), ['class' => 'form-control form-year']) }} 年
                                {{ Form::select('employment_start_month', Month::month_numeric_data(),  Input::get('employment_start_month'), ['class' => 'form-control form-month']) }} 月
                                {{ Form::select('employment_start_day', Day::day_numeric_data(),  Input::get('employment_start_day'), ['class' => 'form-control form-day']) }} 日　〜　
                                {{ Form::select('employment_end_year', Year::release_year_numeric_data(),  Input::get('employment_end_year'), ['class' => 'form-control form-year']) }} 年
                                {{ Form::select('employment_end_month', Month::month_numeric_data(),  Input::get('employment_end_month'), ['class' => 'form-control form-month']) }} 月
                                {{ Form::select('employment_end_day', Day::day_numeric_data(),  Input::get('employment_end_day'), ['class' => 'form-control form-day']) }} 日
                            </td>
                        </tr>
                    </table>

                    <button type="submit" class="btn btn-primary btn-lg btn-block search-btn"><span class="glyphicon glyphicon-search"></span><img src="./images/btn_search.png" alt="この条件で検索する" /></button>
              </div><!--/row-->

              {{ Form::close() }}
              
            <div class="row search-nav">
                <div class="col-md-12">
                    <p class="text-center">{{ $applications->getTotal() }}件中 {{ $applications->getFrom() }}-{{ $applications->getTo() }}件</p>
                    <nav class="text-center">
                      {{ $applications->appends([
                      		'applicant_id' => Input::get('applicant_id'), 
                      		'applicant_name' => Input::get('applicant_name'), 
                      		'job_id' => Input::get('job_id'), 
                      		'job_title' => Input::get('job_title'), 
                      		'status_ids' => Input::get('status_ids'), 
                      		'application_start_year' => Input::get('application_start_year'), 
                      		'application_start_month' => Input::get('application_start_month'), 
                      		'application_start_day' => Input::get('application_start_day'), 
                      		'application_end_year' => Input::get('application_end_year'), 
                      		'application_end_month' => Input::get('application_end_month'), 
                      		'application_end_day' => Input::get('application_end_day'), 
                      		'employment_start_year' => Input::get('employment_start_year'), 
                      		'employment_start_month' => Input::get('employment_start_month'), 
                      		'employment_start_day' => Input::get('employment_start_day'), 
                      		'employment_end_year' => Input::get('employment_end_year'), 
                      		'employment_end_month' => Input::get('employment_end_month'), 
                      		'employment_end_day' => Input::get('employment_end_day')
                      ])->links() }}
                    </nav>

                </div>
            </div>
            <div class="row search-result">
                <div class="col-md-12">
                    <p>応募情報の詳細ページから、各応募情報にメモを付ける事ができます。</p>

                    @if($applications->count() > 0)
                    
                    	@foreach($applications as $index => $application)
                    
		                    <table class="search-result-table">
		                        <tr>
		                            <th class="result-ws">応募日時</th>
		                            <th class="result-ws">名前</th>
		                            <th class="result-wm">求職者ID</th>
		                            <th class="result-title">求人タイトル</th>
		                            <th class="result-wm">メモ</th>
		                            <th class="result-wm">進捗</th>
		                            <th class="result-icon">詳細</th>
		                        </tr>
		                        <tr>
		                            <td>{{ $application->created_at->format('Y/m/d H:i') }}</td>
		                            <td>{{ $application->name }}</td>
		                            <td class="text-center">{{ $application->applicant_account_id }}</td>
		                            <td>{{ $application->title }}</td>
		                            <td>{{ $application->memo }}</td>
		                            <td class="text-center">{{ $application->status_text }}</td>
		                            <td class="text-center">
                                        <!-- 削除ボタン START -->
                                        <!--
                                        {{ Menco::get([
                                            'method' => 'DELETE',
                                            '_method' => 'DELETE',
                                            'label' => '削除',
                                            'url' => route('employer.application.destroy', [$application->id]),
                                            'class' => 'btn btn-default btn-block',
                                            'message' => '応募情報を削除します。よろしいですか？'
                                        ]) }}
                                        -->
                                        <!-- 削除ボタン END -->
                                        {{ Kuku::linkRoute('employer.application.show', Camon::GL('search'), [$application->id], ['class' => 'btn btn-default btn-block']) }}
                                    </td>
		                        </tr>
		                    </table>
                    	
                    	@endforeach
                    	
                    @endif
                    
                </div>
            </div>

            <div class="row search-nav">
                <div class="col-md-12">
                    <p class="text-center">{{ $applications->getTotal() }}件中 {{ $applications->getFrom() }}-{{ $applications->getTo() }}件</p>
                    <nav class="text-center">
                      {{ $applications->links() }}
                    </nav>

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