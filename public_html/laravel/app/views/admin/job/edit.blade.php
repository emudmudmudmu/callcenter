@extends('layouts.admin', [
	'page_title' => '求人情報の登録', 
	'bakery_params' => [
		'admin.dashboard' => 'ホーム', 
		'admin.job.index' => '登録済み求人情報の一覧', 
		'*' => '求人情報の登録'
	]
])

@section('content')

	{{ Form::open(['route' => ['admin.job.update', $job->id], 'method' => 'PUT']) }}
	
	<div class="headline">基本情報</div>
	
		<div class="clearfix">
			<div class="col-md-6 col-lg-6">
				{{ FormStrap::text('title', $job->title)
					->label('募集タイトル （※必須）', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::text('catch_phrase', $job->catch_phrase)
					->label('キャッチコピー （※必須）', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::textarea('catch_text', $job->catch_text, ['rows' => '5'])
					->label('キャッチテキスト （※必須）', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::textarea('description', $job->description, ['rows' => '5'])
					->label('仕事内容 （※必須）', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::checkbox('job_type_ids', JobType::job_types(), (isset($job_metas['type_ids'])) ? $job_metas['type_ids'] : [], ['class' => 'padding-xs'], '<br>')
					->label('雇用形態(検索用) （※必須）', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::checkbox('job_category_ids', JobCategory::job_categories(), isset($job_metas['category_ids']) ? $job_metas['category_ids'] : [], ['class' => 'padding-xs'], '<br>')
					->label('該当職種(検索用) （※必須）', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::checkbox('job_condition_ids', JobCondition::job_conditions(), isset($job_metas['condition_ids']) ? $job_metas['condition_ids'] : [], ['class' => 'padding-xs'], '<br>')
					->label('該当条件(検索用) （※必須）', ['class' => 'text-warning']) }}
			</div>
		</div>
<!--
		<div class="clearfix">
			<div class="col-md-6 col-lg-6">
				{{ FormStrap::text('job_pattern', $job->job_pattern)
					->label('募集職種 （※必須）', ['class' => 'text-warning']) }}
			</div>
		</div>
-->
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::textarea('capacity', $job->capacity, ['rows' => '5'])
					->label('応募資格（※必須）', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-4 col-lg-4">
				{{ FormStrap::select('prefecture_id', $prefectures, $job->prefecture_id)
				->label('勤務地（都道府県） （※必須）', ['class' => 'text-warning']) }}
			</div>
			<div class="col-md-8 col-lg-8">
                {{ FormStrap::select('other_address', 
                        $cities, 
                        $job->other_address, 
                        [
                            'class' => 'form-control input-select-m', 
                            'id' => 'other_address'
                        ])->label('市区町村 （※必須）', ['class' => 'text-warning'])
                }}
			</div>
			<div class="col-md-8 col-lg-8">
				{{ FormStrap::text('other_address2', $job->other_address2)
					->label('勤務地（それ以降の住所） （※必須）', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::textarea('transportation', $job->transportation, ['rows' => '3'])
					->label('アクセス （※必須）', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::textarea('duty_hours', $job->duty_hours, ['rows' => '3'])
					->label('勤務時間帯 （※必須）', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::textarea('salary', $job->salary, ['rows' => '3'])
					->label('給与体系 （※必須）', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::textarea('holiday', $job->holiday, ['rows' => '3'])
					->label('休日休暇 （※必須）', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::textarea('benefit', $job->benefit, ['rows' => '3'])
					->label('福利厚生 （※必須）', ['class' => 'text-warning']) }}
			</div>
		</div>
		<br>
		<div class="headline">選考について</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::textarea('choice_process', $job->choice_process, ['rows' => '5'])
					->label('入社までの流れ （※必須）', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::textarea('interview_address', $job->interview_address, ['rows' => '5'])
					->label('所在地・面接会場 （※必須）', ['class' => 'text-warning']) }}
			</div>
		</div>

		<br>
		<div class="headline">画像登録</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::view('image_upload', 'partials.form.file', [
						'name' => 'image_upload_main_company',
						'attributes' => [
							'title' => '画像を選択（1枚）..',
							'class' => 'btn-flat',
							'data-url' => route('admin.image.upload'),
							'data-remove-url' => route('admin.image.remove'), 
							'accept' => 'image/*',
							'multiple' => false,
							'id' => 'image_upload_main_company' 
						]
					])
					->label('メイン画像 （※必須）', ['class' => 'text-warning']) }}
					<div class="text-danger">{{ $errors->first('surpass_ids_main_companies') }}</div>
				{{ $surpasses['main_company']->html('preview') }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::view('image_upload', 'partials.form.file', [
						'name' => 'image_upload_sub_company',
						'attributes' => [
							'title' => '画像を選択（2枚）..',
							'class' => 'btn-flat',
							'data-url' => route('admin.image.upload'),
							'data-remove-url' => route('admin.image.remove'), 
							'accept' => 'image/*',
							'multiple' => true,
							'id' => 'image_upload_sub_company' 
						]
					])
					->label('サブ画像 （※必須）', ['class' => 'text-warning']) }}
					<div class="text-danger">{{ $errors->first('surpass_ids_sub_companies') }}</div>
				{{ $surpasses['sub_company']->html('preview') }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::view('image_upload', 'partials.form.file', [
						'name' => 'image_upload_pic',
						'attributes' => [
							'title' => '画像を選択（1枚）..',
							'class' => 'btn-flat',
							'data-url' => route('admin.image.upload'),
							'data-remove-url' => route('admin.image.remove'), 
							'accept' => 'image/*',
							'multiple' => false,
							'id' => 'image_upload_pic'
						]
					])
					->label('企業/担当者紹介画像', ['class' => 'text-warning']) }}
				{{ $surpasses['pic']->html('preview') }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-6 col-lg-6">
				{{ FormStrap::text('pic_department', $job->pic_department)
					->label('採用担当者部署名', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-6 col-lg-6">
				{{ FormStrap::text('pic_name', $job->pic_name)
					->label('採用担当者名', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::textarea('pic_comment', $job->pic_comment, ['rows' => '5'])
					->label('採用担当者コメント欄', ['class' => 'text-warning']) }}
			</div>
		</div>

		<br>
		<div class="headline">応募通知</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::radio('notification_type', NotificationType::notification_types(), $job->notification_type, [], '　')
				    ->label('応募通知設定', ['class' => 'text-warning']) }}
			</div>
			<div class="col-md-6 col-lg-6">
				{{ FormStrap::text('notification_email', $job->notification_email) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::radio('displayed', JobRelease::job_releases(), $job->displayed, [], '　')
				    ->label('求人公開 （※必須）', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-3 col-lg-3">
				{{ FormStrap::radio('application_ceiling_type_id', ApplicationCeiling::application_ceiling_types(), ($job->application_ceiling > 0), [], '　')
				    ->label('応募上限 （※必須）', ['class' => 'text-warning']) }}
			</div>
			<div class="col-md-2 col-lg-2" style="margin-top:20px;">
				{{ FormStrap::select('application_amount', ApplicationCeiling::application_amounts(), $job->application_ceiling, []) }}
			</div>
			<div style="margin-top:22px;">人まで</div>
		</div>
		<div class="clearfix">
			<div class="col-md-3 col-lg-3">
				{{ FormStrap::radio('release_type_id', ApplicationCeiling::application_ceiling_types(), ($job->released != null), [], '　')
				    ->label('掲載期限 （※必須）', ['class' => 'text-warning']) }}
			</div>
			<div style="margin-top:20px;">
			@include('partials.form.date', [
				'name' => 'release', 
				'years' => Year::release_year_numeric_data(), 
				'year' => $job->released_year,
				'month' => $job->released_month, 
				'day' => $job->released_day
			])
			</div>
		</div>
		<div class="col-md-12">
			<div class="text-danger">{{ $errors->first('released_past') }}</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::checkbox('recommended', ['1' => 'おすすめ求人に設定する'], [$job->recommended])
					->label('おすすめ', ['class' => 'text-warning']) }}
			</div>
		</div>
		<br>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12 no-padding">
				<div class="background" style="padding:15px 10px 3px 10px; border-radius:5px;">
				{{ FormStrap::radio('activated', [
					'0' => '審査待ち', 
					'1' => '公開する'
				], $job->activated, ['class' => 'text-danger font-size-md'], '　') }}
				</div>
			</div>
		</div>
		<br>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12 text-right">
				{{ FormStrap::submit('変更する '. Camon::GL('circle-arrow-right'), ['class' => 'btn btn-success btn-flat btn-sm'])
					->cancel(route('admin.job.index'), 'キャンセル', ['class' => 'btn btn-default btn-flat btn-sm']) }}
			</div>
		</div>
		{{ FormStrap::attributeNames('attribute_names', [
            'title' => '募集タイトル', 
            'catch_phrase' => 'キャッチコピー', 
            'image_upload' => '御社の写真', 
            'job_type_ids' => '雇用形態', 
            'job_category_ids' => '募集職種', 
            'job_condition_ids' => '条件', 
            'description' => '仕事内容', 
            'capacity' => '応募資格', 
            'job_pattern' => '雇用形態', 
            'prefectures' => '勤務地（都道府県）', 
            'transportation' => 'アクセス', 
            'duty_hours' => '勤務時間帯', 
            'salary' => '給与', 
            'holiday' => '休日休暇', 
            'benefit' => '福利厚生', 
            'pic_comment' => '担当者のコメント', 
            'choice_process' => '入社までの流れ', 
            'interview_address' => '所在地・面接会場', 
            'notification_email' => '通知メールアドレス'
		]) }}
	{{ Form::close() }}
	
@stop

@section('script')

	{{ $surpasses['main_company']->html('js') }}
	{{ $surpasses['sub_company']->html('js') }}
	{{ $surpasses['pic']->html('js') }}

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