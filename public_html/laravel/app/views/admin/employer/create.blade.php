@extends('layouts.admin', [
	'page_title' => trans('versatile.title.create', ['name' => $data_name]), 
	'bakery_params' => [
		'admin.dashboard' => 'ホーム', 
		'admin.employer.index' => trans('versatile.title.index', ['name' => $data_name]), 
		'*' => trans('versatile.title.create', ['name' => $data_name])
	]
])

@section('content')

	{{ Form::open(['route' => 'admin.employer.store']) }}

		<div class="headline">基本情報</div>

		<div class="clearfix">
			<div class="col-md-6 col-lg-6">
				{{ FormStrap::text('last_name')
					->label('企業名 （※必須）', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-3 col-lg-3">
				{{ FormStrap::text('foundation_year')
					->label('設立年 （※必須）', ['class' => 'text-warning']) }}
			</div>
			<div class="col-md-3 col-lg-3">
				{{ FormStrap::select('foundation_month', Month::month_data(), '')
				->label('設立月 （※必須）', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-6 col-lg-6">
				{{ FormStrap::text('representative')
					->label('代表者 （※必須）', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-6 col-lg-6">
				{{ FormStrap::text('capital_stock')
					->label('資本金 （※必須）', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-3 col-lg-3">
				{{ FormStrap::text('employees')
					->label('従業員数 （※必須）', ['class' => 'text-warning']) }}
			</div>
		</div>
        <div class="clearfix">
            <div class="col-md-12 col-lg-12">
                {{ FormStrap::textarea('business_content', '', ['rows' => '5'])
                    ->label('事業内容 （※必須）', ['class' => 'text-warning']) }}
            </div>
        </div>
		<div class="clearfix">
				<div class="col-md-12 col-lg-12">
					{{ FormStrap::view('address', 'partials.form.address', [
							'prefectures' => $prefectures, 
							'cities' => $cities
						])
						->label('本社所在地 （※必須）', ['class' => 'text-warning']) }}
				</div>
		</div>
		<br>
		<div class="headline">担当者の情報</div>
		
		<div class="clearfix">
			<div class="col-md-6 col-lg-6">
				{{ FormStrap::text('pic_name')
					->label('担当者名', ['class' => 'text-warning']) }}
			</div>
			<div class="col-md-6 col-lg-6">
				{{ FormStrap::text('pic_department')
					->label('担当者部署', ['class' => 'text-warning']) }}
			</div>
		</div>
		
		<div class="clearfix">
			<div class="col-md-6 col-lg-6">
				{{ FormStrap::text('tel')
					->label('電話番号', ['class' => 'text-warning']) }}
			</div>
			<div class="col-md-6 col-lg-6">
				{{ FormStrap::text('fax')
					->label('FAX', ['class' => 'text-warning']) }}
			</div>
		</div>
		
		<div class="clearfix">
			<div class="col-md-6 col-lg-6">
				{{ FormStrap::text('email')
					->label('メールアドレス （※必須）', ['class' => 'text-warning']) }}
			</div>
		</div>
		
		<div class="clearfix">
			<div class="col-md-6 col-lg-6">
				{{ FormStrap::text('password', $password)
					->label('パスワード （※必須）', ['class' => 'text-warning']) }}
			</div>
			<div class="col-md-6 col-lg-6">
				{{ FormStrap::text('confirm_password', $password)
					->label('パスワード（確認） （※必須）', ['class' => 'text-warning']) }}
			</div>
		</div>
		<br>
		
		<div class="clearfix">
			<div class="col-md-12 col-lg-12 text-right">
				{{ FormStrap::submit('追加する '. Camon::GL('circle-arrow-right'), ['class' => 'btn btn-success btn-sm'])
					->cancel(route('admin.employer.index'), 'キャンセル', ['class' => 'btn btn-default btn-sm']) }}
			</div>
		</div>
			
		{{ FormStrap::attributeNames('attribute_names', [
			'last_name' => '企業名', 
			'foundation_year' => '設立年', 
			'foundation_month' => '設立月', 
			'representative' => '代表者', 
			'capital_stock' => '資本金', 
			'employees' => '従業員数', 
			'email' => 'メールアドレス', 
			'password' => 'パスワード', 
			'confirm_password' => 'パスワード（確認）', 
			'zip_code_1' => '郵便番号１', 
			'zip_code_2' => '郵便番号２', 
			'prefecture_id' => '都道府県',
			'city_id' => '市町村', 
			'other_address' => '以降の住所'
		]) }}
	{{ Form::close() }}
	
@stop

@section('script')

	<script type="text/javascript">

		$(document).ready(function(){
			
			@include('js/autosize')
			@include('js/file_input')
			@include('js/datepicker')
			@include('js/timepicker')
			@include('js/tagsinput')
			@include('js/icheck')
			@include('js/city_data')
			
		});
		
	</script>

@stop