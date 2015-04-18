@extends('layouts.home', [
	'page_title' => '新規会員登録'
])

@section('content')

	<div class="text-right font-size-sm text-muted">（ *は必須入力）</div>
	<div class="input-form">
	
	<div class="headline">基本情報</div>
	
	{{ Form::open(['route' => 'home.signup.post', 'method' => 'POST']) }}
	
		<div class="clearfix">
			<div class="col-md-3 col-lg-3">
				{{ FormStrap::text('last_name')
					->label('性 *', ['class' => 'text-base']) }}
			</div>
			<div class="col-md-3 col-lg-3">
				{{ FormStrap::text('first_name')
					->label('名 *', ['class' => 'text-base']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-3 col-lg-3">
				{{ FormStrap::text('last_name_kana')
					->label('性カナ *', ['class' => 'text-base']) }}
			</div>
			<div class="col-md-3 col-lg-3">
				{{ FormStrap::text('first_name_kana')
					->label('名カナ *', ['class' => 'text-base']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::view('address', 'partials.form.address', [
						'zip_code_1' => '', 
						'zip_code_2' => '', 
						'other_address' => '', 
						'prefectures' => $prefectures, 
						'cities' => $cities
					])
					->label('住所 *', ['class' => 'text-base']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="form-group">
				<div class="col-md-3 col-lg-3">
					<label class="text-base">生年月日 *</label>
				</div>
			</div>
		</div>
		<div class="clearfix">
			@include('partials.form.date', [
				'name' => 'birth',
				'years' => Year::birth_year_numeric_data(), 
				'year' => '', 
				'month' => '', 
				'day' => ''
			])
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::radio('gender', Gender::gender_data(), 1, [], '&nbsp;&nbsp;&nbsp;')
					->label('性別 *', ['class' => 'text-base']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-6 col-lg-6">
				{{ FormStrap::text('tel')
					->label('電話番号 *', ['class' => 'text-base']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-6 col-lg-6">
				{{ FormStrap::text('email')
					->label('メールアドレス *', ['class' => 'text-base']) }}
			</div>
		</div>
		
		<br>
		<div class="headline">経歴情報</div>
		
		<div class="clearfix">
			<div class="col-md-6 col-lg-6">
				{{ FormStrap::text('current_job')
					->label('現在の職業', ['class' => 'text-base']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::text('education')
					->label('最終学歴', ['class' => 'text-base']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::textarea('qualification', '', ['rows' => 3])
					->label('保有資格', ['class' => 'text-base']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::textarea('career', '', ['rows' => 5])
					->label('職務経歴', ['class' => 'text-base']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::textarea('introduction', '', ['rows' => 6])
					->label('自己PR', ['class' => 'text-base']) }}
			</div>
		</div>
		<br>
		<div class="headline">希望条件</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::checkbox('job_category_ids', JobCategory::job_categories(), [], ['class' => 'padding-xs'], '<br>')
					->label('希望職種', ['class' => 'text-base']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::checkbox('job_type_ids', JobType::job_types(), [], ['class' => 'padding-xs'], '<br>')
					->label('希望雇用形態', ['class' => 'text-base']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="form-group">
				<div class="col-md-3 col-lg-3">
					<label class="text-base">希望勤務地 *</label>
				</div>
			</div>
		</div>
		<div class="clearfix">
			@for($i = 0; $i < 2; $i++)
			<div class="col-md-12 col-lg-12">
				@include('partials.form.prefecture_city', [
					'prefecture_name' => 'job_location_prefecture_id_'. ($i+1), 
					'city_name' => 'job_location_city_id_'. ($i+1)
				])
			</div>
			@endfor
		</div>
		<div class="clearfix">
			<div class="col-md-3 col-lg-3">
				{{ FormStrap::text('salary')
					->label('希望給与', ['class' => 'text-base']) }}
			</div>
		</div>		
		<div class="clearfix">
			<div class="col-md-6 col-lg-6">
				{{ FormStrap::password('password')
					->label('パスワード*', ['class' => 'text-base']) }}
			</div>
			<div class="col-md-6 col-lg-6">
				{{ FormStrap::password('confirm_password')
					->label('パスワード（確認）*', ['class' => 'text-base']) }}
			</div>
		</div>
		<br>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12 text-right">
				{{ FormStrap::submit('変更する '. Camon::GL('circle-arrow-right'), ['class' => 'btn btn-success btn-sm'])
					->cancel(route('admin.applicant.index'), 'キャンセル', ['class' => 'btn btn-default btn-sm']) }}
			</div>
		</div>
		
		{{ FormStrap::attributeNames('attribute_names', [
			'last_name' => '性', 
			'first_name' => '名', 
			'last_name_kana' => '性カナ', 
			'first_name_kana' => '名カナ', 
			'zip_code_1' => '郵便番号１', 
			'zip_code_2' => '郵便番号２', 
			'prefecture_id' => '都道府県',
			'city_id' => '市町村', 
			'other_address' => '以降の住所', 
			'birth_year' => '誕生年', 
			'birth_month' => '誕生月', 
			'birth_day' => '誕生日', 
			'gender' => '性別', 
			'tel' => '電話番号', 
			'email' => 'メールアドレス'
		]) }}
	{{ Form::close() }}
	
	</div>
	</div>
	
@stop

@section('script')

	<script type="text/javascript">

		$(document).ready(function(){

			@include('js/city_data')
			
		});
		
	</script>

@stop