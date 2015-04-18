@extends('layouts.employer', [
	'page_title' => '課金情報の一覧'
])

@section('content')

    <div id="main">
        <div class="container">
          <div class="row row-offcanvas row-offcanvas-right">

          
            <div class="col-md-12">
              {{ Form::open(['route' => 'employer.billing', 'method' => 'GET']) }}
              <div class="row">
                    <h2 class="page-title"><span class="glyphicon glyphicon-yen"></span><img src="./images/h2_billing.png" alt="課金情報の一覧" /></h2>
                    <table class="search-table">
                        <tr>
                            <th>課金集計月</th>
                            <td>
                            	{{ Form::select('billing_year', $applied_years, Input::get('billing_year'), ['class' => 'form-control form-year']) }} 年
                                {{ Form::select('billing_month', Month::month_numeric_data(), Input::get('billing_month'), ['class' => 'form-control form-month']) }} 月

                            </td>
                        </tr>
                        <tr>
                            <th>期間課金集計</th>
                            <td >
                                {{ Form::select('billing_start_year', $applied_years, Input::get('billing_start_year'), ['class' => 'form-control form-year']) }} 年
                                {{ Form::select('billing_start_month', Month::month_numeric_data(), Input::get('billing_start_month'), ['class' => 'form-control form-month']) }} 月　〜　
                                {{ Form::select('billing_end_year', $applied_years, Input::get('billing_end_year'), ['class' => 'form-control form-year']) }} 年
                                {{ Form::select('billing_end_month', Month::month_numeric_data(), Input::get('billing_end_month'), ['class' => 'form-control form-month']) }} 月
                            </td>
                        </tr>
                    </table>

                    <button type="submit" class="btn btn-primary btn-lg btn-block search-btn"><span class="glyphicon glyphicon-search"></span><img src="./images/btn_search.png" alt="この条件で検索する" /></button>
              </div><!--/row-->
              
              {{  Form::close() }}

            <div class="row search-nav">
                <div class="col-md-12">
                    <p class="text-center">{{ $applications->getTotal() }}件中 {{ $applications->getFrom() }}-{{ $applications->getTo() }}件</p>
                    <nav class="text-center">
							{{ $applications->appends([
								'billing_year' => Input::get('billing_year'), 
                      			'billing_month' => Input::get('billing_month'), 
                      			'billing_start_year' => Input::get('billing_start_year'), 
                      			'billing_start_month' => Input::get('billing_start_month'), 
                      			'billing_end_year' => Input::get('billing_end_year'), 
                      			'billing_end_month' => Input::get('billing_end_month')
                      		])
                      		->links() }}
                    </nav>

                </div>
            </div>
            <div class="row search-result">
                <div class="col-md-12">
                    
					@if($applications->count() > 0)
						@foreach($applications as $application)
		                    <table class="search-result-table billing-table">
		                        <tr>
		                            <th>応募課金</th>
		                            <th>対象年月</th>
		                            <th>応募件数</th>
		                            <th>課金合計金額(税別)</th>
		                        </tr>
		                        <tr>
		                            <td>応募課金</td>
		                            <td>{{ $application->applied_year }}/{{ $application->applied_month }}月</td>
		                            <td>{{ $application->COUNT }}件</td>
		                            <td>{{ number_format($application->fee) }}円</td>
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
							{{ $applications->appends([
								'billing_year' => Input::get('billing_year'), 
                      			'billing_month' => Input::get('billing_month'), 
                      			'billing_start_year' => Input::get('billing_start_year'), 
                      			'billing_start_month' => Input::get('billing_start_month'), 
                      			'billing_end_year' => Input::get('billing_end_year'), 
                      			'billing_end_month' => Input::get('billing_end_month')
                      		])
                      		->links() }}
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