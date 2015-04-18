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

          {{ Form::open(['route' => 'employer.job.confirm']) }}
          
            <div class="col-md-12">
              <div class="row">
                <h2 class="page-title"><span class="glyphicon glyphicon-user"></span>{{ HTML::image('employer/images/h2_job_entry.png', '求人情報の登録') }}</h2>
                <table class="job-entry-table">
                    <tr>
                        <td colspan="2" class="job-entry-title"><span class="glyphicon glyphicon-file"></span>基本情報</td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact1" class="control-label">求人情報のタイトル</label><span class="required">[必須]</span>
                        </th>
                        <td>
                        	{{ Form::text('title', '', ['class' => 'form-control input-text-l']) }}
                        	<div class="text-danger">{{ $errors->first('title') }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact2" class="control-label">キャッチコピー</label><span class="required">[必須]</span>
                        </th>
                        <td>
                        	{{ Form::text('catch_phrase', '', ['class' => 'form-control input-text-l']) }}
                        	<div class="text-danger">{{ $errors->first('catch_phrase') }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact2" class="control-label">キャッチテキスト</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            {{ Form::textarea('catch_text', '', ['class' => 'form-control', 'rows' => '5']) }}
                            <div class="text-danger">{{ $errors->first('catch_text') }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact3" class="control-label">仕事内容</label><span class="required">[必須]</span>
                        </th>
                        <td>
                        	{{ Form::textarea('description', '', ['class' => 'form-control', 'rows' => '5']) }}
                        	<div class="text-danger">{{ $errors->first('description') }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label class="control-label">雇用形態(検索用)</label><span class="required">[必須]</span>
                        </th>
                        <td>
                        	@foreach(JobType::job_types() as $type_id => $type_name)
	                            <label class="checkbox-inline">
	                              {{ Form::checkbox('job_type_ids[]', $type_id) }} {{ $type_name }}
	                            </label>
                        	@endforeach
                        	<div class="text-danger">{{ $errors->first('job_type_ids') }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label class="control-label">該当業種(検索用)</label><p style="color: red">１つのみ選択</p><span class="required">[必須]</span>
                        </th>
                        <td>
                        	@foreach(JobCategory::job_categories() as $category_id => $category_name)
	                            <label class="checkbox-inline">
	                              {{ Form::checkbox('job_category_ids[]', $category_id) }} {{ $category_name }}
	                            </label>
                        	@endforeach
                        	<div class="text-danger">{{ $errors->first('job_category_ids') }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label class="control-label">該当条件(検索用)</label><span class="required">[必須]</span>
                        </th>
                        <td>
                        	@foreach(JobCondition::job_conditions() as $condition_id => $condition_name)
	                            <label class="checkbox-inline">
	                              {{ Form::checkbox('job_condition_ids[]', $condition_id) }} {{ $condition_name }}
	                            </label>
                        	@endforeach
                        	<div class="text-danger">{{ $errors->first('job_condition_ids') }}</div>
                        </td>
                    </tr>
<!--
                    <tr>
                        <th>
                            <label for="inputContact4" class="control-label">募集職種</label><span class="required">[必須]</span>
                        </th>
                        <td>
                        	{{ Form::text('job_pattern', '', ['class' => 'form-control input-text-l']) }}
                        	<div class="text-danger">{{ $errors->first('job_pattern') }}</div>
                        </td>
                    </tr>
-->
                    <tr>
                        <th>
                            <label class="control-label">勤務地(都道府県)</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            {{ Form::select('prefecture_id', 
                                    $prefectures, 
                                    $employer->employer_meta->prefecture_id, 
                                    [
                                        'class' => 'form-control input-select-s city_data', 
                                        'data-target' => '#other_address'
                                    ]) 
                            }}
                            <div class="text-danger">{{ $errors->first('prefecture_id') }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact6" class="control-label">勤務地(市区町村)</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            {{ Form::select('other_address', 
                                    $cities, 
                                    $employer->employer_meta->city_id, 
                                    [
                                        'class' => 'form-control input-select-m', 
                                        'id' => 'other_address'
                                    ]) 
                            }}
                        	<div class="text-danger">{{ $errors->first('other_address') }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact6" class="control-label">勤務地(それ以降の住所)</label>
                        </th>
                        <td>
                            {{ Form::text('other_address2', '', ['class' => 'form-control input-text-l']) }}
                            <div class="text-danger">{{ $errors->first('other_address2') }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact7" class="control-label">アクセス</label><span class="required">[必須]</span>
                        </th>
                        <td>
                        	{{ Form::textarea('transportation', '', ['class' => 'form-control', 'rows' => '3']) }}
                        	<div class="text-danger">{{ $errors->first('transportation') }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact8" class="control-label">勤務時間帯</label><span class="required">[必須]</span>
                        </th>
                        <td>
                        	{{ Form::textarea('duty_hours', '', ['class' => 'form-control', 'rows' => '3']) }}
                        	<div class="text-danger">{{ $errors->first('duty_hours') }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact9" class="control-label">給与体系</label><span class="required">[必須]</span>
                        </th>
                        <td>
                        	{{ Form::textarea('salary', '', ['class' => 'form-control', 'rows' => '3']) }}
                        	<div class="text-danger">{{ $errors->first('salary') }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact10" class="control-label">休日休暇</label><span class="required">[必須]</span>
                        </th>
                        <td>
                        	{{ Form::textarea('holiday', '', ['class' => 'form-control', 'rows' => '3']) }}
                        	<div class="text-danger">{{ $errors->first('holiday') }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact5" class="control-label">応募資格</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            {{ Form::textarea('capacity', '', ['class' => 'form-control', 'rows' => '5']) }}
                            <div class="text-danger">{{ $errors->first('capacity') }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact11" class="control-label">福利厚生</label><span class="required">[必須]</span>
                        </th>
                        <td>
                        	{{ Form::textarea('benefit', '', ['class' => 'form-control', 'rows' => '3']) }}
                        	<div class="text-danger">{{ $errors->first('benefit') }}</div>
                        </td>
                    </tr>
                  </table>

                <table class="job-entry-table">
                    <tr>
                        <td colspan="2" class="job-entry-title"><span class="glyphicon glyphicon-pencil"></span>応募・選考について</td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact12" class="control-label">入社までの流れ</label><span class="required">[必須]</span>
                        </th>
                        <td>
                        	{{ Form::textarea('choice_process', '', ['class' => 'form-control', 'rows' => '5']) }}
                        	<div class="text-danger">{{ $errors->first('choice_process') }}</div>
                        </td>
                    </tr>
                      <tr>
                        <th>
                            <label for="inputContact13" class="control-label">所在地・面接会場</label><span class="required">[必須]</span>
                        </th>
                        <td>
                        	{{ Form::textarea('interview_address', '', ['class' => 'form-control', 'rows' => '3']) }}
                        	<div class="text-danger">{{ $errors->first('interview_address') }}</div>
                        </td>
                    </tr>                  
                </table>                  

                <table class="job-entry-table">
                    <tr>
                        <td colspan="2" class="job-entry-title"><span class="glyphicon glyphicon-picture"></span>画像登録</td>
                    </tr>
                    <tr>
                        <th>
                            <label class="control-label">メイン画像</label><span class="required">[必須]</span>
                        </th>
                        <td>
							{{ FormStrap::view('image_upload', 'partials.form.file', [
									'name' => 'image_upload_main_company',
									'attributes' => [
										'title' => '画像を選択（1枚）..',
										'class' => 'btn-flat',
										'data-url' => route('employer.image.upload'),
										'data-remove-url' => route('employer.image.remove'), 
										'accept' => 'image/*',
										'multiple' => false,
										'id' => 'image_upload_main_company' 
									]
								]) }}
							{{ $surpasses['main_company']->html('preview') }}
							<div class="text-danger">{{ $errors->first('surpass_ids_main_companies') }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label class="control-label">サブ画像(2枚)</label><span class="required">[必須]</span>
                        </th>
                        <td>
							{{ FormStrap::view('image_upload', 'partials.form.file', [
									'name' => 'image_upload_sub_company',
									'attributes' => [
										'title' => '画像を選択（2枚）..',
										'class' => 'btn-flat',
										'data-url' => route('employer.image.upload'),
										'data-remove-url' => route('employer.image.remove'), 
										'accept' => 'image/*',
										'multiple' => true,
										'id' => 'image_upload_sub_company' 
									]
								]) }}
							<div id="sub_company_images">{{ $surpasses['sub_company']->html('preview') }}</div>
							<div class="text-danger">{{ $errors->first('surpass_ids_sub_companies') }}</div>
                        </td>
                    </tr>
                     <tr>
                        <th>
                            <label class="control-label">企業/担当者紹介画像</label>
                        </th>
                        <td>
							{{ FormStrap::view('image_upload', 'partials.form.file', [
									'name' => 'image_upload_pic',
									'attributes' => [
										'title' => '画像を選択（1枚）..',
										'class' => 'btn-flat',
										'data-url' => route('employer.image.upload'),
										'data-remove-url' => route('employer.image.remove'), 
										'accept' => 'image/*',
										'multiple' => false,
										'id' => 'image_upload_pic'
									]
								]) }}
							{{ $surpasses['pic']->html('preview') }}
                        </td>
                    </tr>                   
                    <tr>
                        <th>
                            <label for="inputContact14" class="control-label">採用担当者部署名</label>
                        </th>
                        <td>
                        	{{ Form::text('pic_department', '', ['class' => 'form-control input-text-l']) }}
                        	<div class="text-danger">{{ $errors->first('pic_department') }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact15" class="control-label">採用担当者名</label>
                        </th>
                        <td>
                        	{{ Form::text('pic_name', '', ['class' => 'form-control input-text-l']) }}
                        	<div class="text-danger">{{ $errors->first('pic_name') }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact16" class="control-label">採用担当者コメント欄</label>
                        </th>
                        <td>
                        	{{ Form::textarea('pic_comment', '', ['class' => 'form-control', 'rows' => '5']) }}
                        	<div class="text-danger">{{ $errors->first('pic_comment') }}</div>
                        </td>
                    </tr> 
                </table>
                <table class="job-entry-table">
                    <tr>
                        <td colspan="2" class="job-entry-title"><span class="glyphicon glyphicon-envelope"></span>応募通知</td>
                    </tr>
                    <tr>
                          <th>
                            <label for="inputContact17" class="control-label">応募通知設定</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            <label class="radio-inline">
                              {{ Form::radio('notification_type', '1', true) }} 企業情報で登録したメールアドレスに通知
                            </label>
                            <label class="radio-inline">
                              {{ Form::radio('notification_type', '2') }} 下記に入力したメールアドレスに通知
                            </label><br />
                        	{{ Form::text('notification_email', '', ['class' => 'form-control input-text-l']) }}
                        	<div class="text-danger">{{ $errors->first('notification_email') }}</div>
                            <p class="description">求職者が応募した旨、また下記「応募上限」にて「制限あり」とした場合上限人数に達した旨が通知されます。</p>
                        </td>
                    </tr>
                </table>
                <table class="job-entry-table">
                    <tr>
                        <td colspan="2" class="job-entry-title"><span class="glyphicon glyphicon-ok"></span>応募通知</td>
                    </tr>
                    <tr>
                          <th>
                            <label class="control-label">求人公開</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            <label class="radio-inline">
                              {{ Form::radio('displayed', '1', true) }} 掲載
                            </label>
                            <label class="radio-inline">
                              {{ Form::radio('displayed', '0') }} 非掲載
                            </label>
                            <p class="description">掲載としていても管理者が承認するまでは掲載されません。</p>
                        
                        </td>
                    </tr>
                    <tr>
                          <th>
                            <label class="control-label">応募上限</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            <label class="radio-inline">
                              {{ Form::radio('application_ceiling_type_id', '0', true) }} 制限なし
                            </label>
                            <label class="radio-inline">
                              {{ Form::radio('application_ceiling_type_id', '1') }} 制限有り
                            </label>
                            
                            {{ Form::select('application_amount', ApplicationCeiling::application_amounts(), '', ['class' => 'form-control input-select-s']) }} 人まで
                        	<div class="text-danger">{{ $errors->first('application_amount') }}</div>
                        </td>
                    </tr>
                    <tr>
                          <th>
                            <label class="control-label">掲載期限</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            <label class="radio-inline">
                              {{ Form::radio('release_type_id', '0', true) }} 制限なし
                            </label>
                            <label class="radio-inline">
                              {{ Form::radio('release_type_id', '1') }} 制限有り
                            </label>
                                {{ Form::select('release_year', Year::release_year_numeric_data(), '', ['class' => 'form-control form-year']) }} 年
                                {{ Form::select('release_month', Month::month_numeric_data(), '', ['class' => 'form-control form-month']) }} 月
                                {{ Form::select('release_day', Day::day_numeric_data(), '', ['class' => 'form-control form-day']) }} 日
                        	<div class="text-danger">{{ $errors->first('released_past') }}</div>
                        </td>
                    </tr>                  
                </table>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary send-btn">確認する</button>
                </div>
              </div><!--/row-->
 
            </div><!--/.col-xs-12.col-sm-9-->

            {{ Form::close() }}
            
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

	{{ $surpasses['main_company']->html('js') }}
	{{ $surpasses['sub_company']->html('js') }}
	{{ $surpasses['pic']->html('js') }}
    <script type="text/javascript">
    $(document).ready(function(){

        @include('js/city_data')
        
    });
    </script>

@stop

@section('style')

    <style>

        #sub_company_images img {

            margin-right: 20px;

        }

    </style>

@stop
