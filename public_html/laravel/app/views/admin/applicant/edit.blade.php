@extends('layouts.admin', [
	'page_title' => trans('versatile.title.edit', ['name' => $data_name]), 
	'bakery_params' => [
		'admin.dashboard' => 'ホーム', 
		'admin.applicant.index' => trans('versatile.title.index', ['name' => $data_name]), 
		'*' => trans('versatile.title.edit', ['name' => $data_name])
	]
])

@section('content')

	<div class="headline">基本情報</div>
	
	{{ Form::open(['route' => ['admin.applicant.update', $applicant->id], 'method' => 'PUT']) }}
	
		<div class="clearfix">
			<div class="col-md-6 col-lg-6">
				{{ FormStrap::text('name', $applicant->last_name)
					->label('名前 *', ['class' => 'text-warning']) }}
			</div>
            <div class="col-md-6 col-lg-6">
				{{ FormStrap::text('kana', $applicant->applicant_meta->last_name_kana)
					->label('ふりがな *', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
            <div class="col-md-3 col-lg-3">
				{{ FormStrap::text('zip_code', $applicant->applicant_meta->zip_code)
					->label('郵便番号 *', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
            <div class="col-md-3 col-lg-3">
				{{ FormStrap::select('prefecture_id', ['' => '▼以下より選択'] + JapanesePrefectures::prefectures(), $applicant->applicant_meta->prefecture_id)
					->label('都道府県 *', ['class' => 'text-warning']) }}
			</div>
            <div class="col-md-3 col-lg-3">
				{{ FormStrap::text('city', $applicant->applicant_meta->city)
					->label('市区町村 *', ['class' => 'text-warning']) }}
			</div>
		</div>
        <div class="clearfix">
            <div class="col-md-12 col-lg-12">
                {{ FormStrap::text('other_address_1', $applicant->applicant_meta->other_address_1)
                    ->label('以降住所 *', ['class' => 'text-warning']) }}
            </div>
        </div>
        <div class="clearfix">
            <div class="col-md-12 col-lg-12">
                {{ FormStrap::text('other_address_2', $applicant->applicant_meta->other_address_2)
                    ->label('マンション等', ['class' => 'text-warning']) }}
            </div>
        </div>
		<div class="clearfix">
			<div class="form-group">
				<div class="col-md-3 col-lg-3">
					<label class="text-warning">生年月日 *</label>
				</div>
			</div>
		</div>
		<div class="clearfix">
			@include('partials.form.date', [
				'name' => 'birth',
				'years' => Year::birth_year_numeric_data(), 
				'year' => $applicant->applicant_meta->birth_year, 
				'month' => $applicant->applicant_meta->birth_month, 
				'day' => $applicant->applicant_meta->birth_day
			])
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::radio('gender', Gender::gender_data(), $applicant->applicant_meta->gender, [], '&nbsp;&nbsp;&nbsp;')
					->label('性別 *', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-6 col-lg-6">
				{{ FormStrap::text('tel', $applicant->applicant_meta->tel)
					->label('電話番号 *', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-6 col-lg-6">
				{{ FormStrap::text('email', $applicant->email)
					->label('メールアドレス *', ['class' => 'text-warning']) }}
			</div>
		</div>
		
		<br>
		<div class="headline">経歴情報</div>
		
		<div class="clearfix">
			<div class="col-md-6 col-lg-6">
				{{ FormStrap::text('current_job', $applicant->applicant_meta->current_job)
					->label('現在の職業', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::text('education', $applicant->applicant_meta->education)
					->label('最終学歴', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::textarea('qualification', $applicant->applicant_meta->qualification, ['rows' => 3])
					->label('保有資格', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::textarea('career', $applicant->applicant_meta->career, ['rows' => 3])
					->label('職務経歴', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::textarea('introduction', $applicant->applicant_meta->introduction, ['rows' => 3])
					->label('自己PR', ['class' => 'text-warning']) }}
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