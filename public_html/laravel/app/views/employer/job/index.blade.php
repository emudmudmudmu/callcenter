@extends('layouts.employer', [
	'page_title' => '登録済み求人情報の一覧',
	'bakery_params' => [
		'employer.dashboard' => 'ホーム', 
		'*' => '登録済み求人情報の一覧'
	]
])

@section('content')

    <div id="main">
        <div class="container">
          <div class="row row-offcanvas row-offcanvas-right">

            <div class="col-md-12">
              <div class="row">
                    <h2 class="page-title"><span class="glyphicon glyphicon-user"></span><img src="./images/h2_job.png" alt="登録済み求人情報の一覧" /></h2>
                    {{ Form::open(['route' => 'employer.job.index', 'method' => 'GET']) }}
                    <table class="search-table job-search-table">
                        <tr>
                            <th>公開状況(企業設定)</th><td>
                                <label class="checkbox-inline">
                                  {{ Form::checkbox('displayed', '1', Input::get('displayed')) }} 掲載
                                </label>
                                <label class="checkbox-inline">
                                  {{ Form::checkbox('undisplayed', '1', Input::get('undisplayed')) }} 非掲載
                                </label>                            
                            </td>
                            <th>公開状況(管理者設定)</th><td>
                                <label class="checkbox-inline">
                                  {{ Form::checkbox('activated', '1', Input::get('activated')) }} 掲載
                                </label>
                                <label class="checkbox-inline">
                                  {{ Form::checkbox('unactivated', '1', Input::get('unactivated')) }} 非掲載
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th>掲載期限</th><td>
                                <label class="checkbox-inline">
                                  {{ Form::checkbox('unexpired', '1', Input::get('unexpired')) }} 期限内
                                </label>
                                <label class="checkbox-inline">
                                  {{ Form::checkbox('expired', '1', Input::get('expired')) }} 期限切れ
                                </label> 
                            </td>
                            <th>応募条件</th><td>
                                <label class="checkbox-inline">
                                  {{ Form::checkbox('valid', '1', Input::get('valid')) }} 応募可能
                                </label>
                                <label class="checkbox-inline">
                                  {{ Form::checkbox('invalid', '1', Input::get('invalid')) }} 応募不可能
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th>フリーワード</th>
                            <td colspan="3">
                                <input name="q" type="text" class="form-control form-freeword" value="{{ Input::get('q') }}" />
                            </td>
                        </tr>
                    </table>

                    <button type="submit" class="btn btn-primary btn-lg btn-block search-btn"><span class="glyphicon glyphicon-search"></span><img src="./images/btn_search.png" alt="この条件で検索する" /></button>
              		{{ Form::close() }}
              </div><!--/row-->

            @if($jobs->getLastPage() > 1)
            <div class="row search-nav">
                <div class="col-md-12">
                    <p class="text-center">{{ $jobs->getTotal() }}件中 {{ $jobs->getFrom() }}-{{ $jobs->getTo() }}件</p>
                    <nav class="text-center">
                      {{ $jobs->appends([
								'displayed' => intval(Input::get('displayed')), 
                      			'undisplayed' => intval(Input::get('undisplayed')),
                      			'activated' => intval(Input::get('activated')),
                      			'unactivated' => intval(Input::get('unactivated')),
                      			'released=1' => intval(Input::get('released')),
                      			'unreleased' => intval(Input::get('unreleased')),
                      			'available' => intval(Input::get('available')),
                      			'unavailable' => intval(Input::get('unavailable')), 
                      			'q' => urlencode(Input::get('q'))
                      		])
                      		->links() }}
                    </nav>
                </div>
            </div>
            @endif
            <div class="row search-result">
                <div class="col-md-12">
                	@if($jobs->count() > 0)
                		@foreach($jobs as $job)
		                    <div class="job-result">
		                        <div class="job-result-head clearfix">
		                            <table>
		                                <tr>
		                                    <th>求人タイトル</th><td colspan="3">{{ $job->title }}</td>
		                                </tr>
		                                <tr>
		                                    <th>掲載日</th><td>{{ $job->created_at->format('Y/m/d') }}</td>
		                                    <th>求人番号</th><td>{{ $job->account_id }}</td>
		                                </tr>
		                            </table>
		                            
		                            <ul class="list-inline">
		                                <li>
											{{ Menco::get([
												'method' => 'GET',
												'label' => '複製', 
												'url' => route('employer.job.copy', [$job->id]), 
												'class' => 'btn btn-default btn-block', 
												'message' => '求人情報を複製します。よろしいですか？'
											]) }}
		                                </li>
										<li>{{ Kuku::linkRoute('employer.job.edit', '編集', [$job->id], ['class' => 'btn btn-default btn-block']) }}</li>
<!--
		                                <li>
											{{ Menco::get([
												'method' => 'DELETE',
												'_method' => 'DELETE',
												'label' => '削除', 
												'url' => route('employer.job.destroy', [$job->id]), 
												'class' => 'btn btn-default btn-block', 
												'message' => trans('versatile.destroy_confirm')
											]) }}
		                                </li>
-->
		                                <li>{{ HTML::linkRoute('home.job_preview', 'プレビュー', [$job->id], ['class' => 'btn btn-default btn-block', 'target' => '_blank']) }}</li>
		                            </ul>
		                        
		                        </div>
		
		                        <table class="search-result-table">
		                            <tr>
		                                <th>公開状況</th>
		                                <th>応募上限</th>
		                                <th>掲載期限</th>
		                            </tr>
		                            <tr>
		                                <td>{{ $job->activated_text }}</td>
		                                <td>{{ ($job->application_ceiling == 0) ? '上限なし' : $job->application_count .'/'. $job->application_ceiling }}</td>
		                                <td>{{ ($job->released == null) ? '制限なし' : $job->released->format('Y/m/d') }}</td>
		                            </tr>
		                        </table>
		                    </div>
                		@endforeach
					@else
						<hr>
						求人情報は見つかりませんでした。
					@endif
                </div>
            </div>

            @if($jobs->getLastPage() > 1)
            <div class="row search-nav">
                <div class="col-md-12">
                    <p class="text-center">{{ $jobs->getTotal() }}件中 {{ $jobs->getFrom() }}-{{ $jobs->getTo() }}件</p>
                    <nav class="text-center">
                      {{ $jobs->appends([
								'displayed' => intval(Input::get('displayed')), 
                      			'undisplayed' => intval(Input::get('undisplayed')),
                      			'activated' => intval(Input::get('activated')),
                      			'unactivated' => intval(Input::get('unactivated')),
                      			'released=1' => intval(Input::get('released')),
                      			'unreleased' => intval(Input::get('unreleased')),
                      			'available' => intval(Input::get('available')),
                      			'unavailable' => intval(Input::get('unavailable')), 
                      			'q' => urlencode(Input::get('q'))
                      		])
                      		->links() }}
                    </nav>

                </div>
            </div>
            @endif

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