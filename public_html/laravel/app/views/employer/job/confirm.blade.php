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

          @if(Input::exists('id'))
          	{{ Form::open(['route' => ['employer.job.update', Input::get('id')], 'method' => 'PUT']) }}
          @else
          	{{ Form::open(['route' => 'employer.job.store']) }}
          @endif
          
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
                        	{{ Input::get('title') }}
                        	{{ Form::hidden('title', Input::get('title')) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact2" class="control-label">キャッチコピー</label><span class="required">[必須]</span>
                        </th>
                        <td>
                        	{{ Input::get('catch_phrase') }}
                        	{{ Form::hidden('catch_phrase', Input::get('catch_phrase')) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact2" class="control-label">キャッチテキスト</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            {{ nl2br(Input::get('catch_text')) }}
                            {{ Form::hidden('catch_text', Input::get('catch_text')) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact3" class="control-label">仕事内容</label><span class="required">[必須]</span>
                        </th>
                        <td>
                        	{{ nl2br(Input::get('description')) }}
                        	{{ Form::hidden('description', Input::get('description')) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label class="control-label">雇用形態(検索用)</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            {{ implode('、&nbsp;', JobType::job_type_names(Input::get('job_type_ids'))) }}　
                            @foreach(Input::get('job_type_ids') as $job_type_id)
                        		{{ Form::hidden('job_type_ids[]', $job_type_id) }}
                        	@endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label class="control-label">該当業種(検索用)</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            {{ implode('、&nbsp;', JobCategory::job_category_names(Input::get('job_category_ids'))) }}　
                        	@foreach(Input::get('job_category_ids') as $job_category_id)
                        		{{ Form::hidden('job_category_ids[]', $job_category_id) }}
                        	@endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label class="control-label">該当条件(検索用)</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            {{ implode('、&nbsp;', JobCondition::job_condition_name(Input::get('job_condition_ids'))) }}
                            @foreach(Input::get('job_condition_ids') as $job_condition_id)
                        		{{ Form::hidden('job_condition_ids[]', $job_condition_id) }}
                        	@endforeach
                        </td>
                    </tr>
                    
<!--
                    <tr>
                        <th>
                            <label for="inputContact4" class="control-label">募集職種</label><span class="required">[必須]</span>
                        </th>
                        <td>
                        	{{ nl2br(Input::get('job_pattern')) }}
                        	{{ Form::hidden('job_pattern', Input::get('job_pattern')) }}
                        </td>
                    </tr>
-->
                    <tr>
                        <th>
                            <label class="control-label">勤務地(都道府県)</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            {{ JapanesePrefectures::prefectureName(Input::get('prefecture_id'))  }}
                        	{{ Form::hidden('prefecture_id', Input::get('prefecture_id')) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact6" class="control-label">勤務地(市区町村)</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            {{ $address->city_name }}
                        	{{ Form::hidden('other_address', Input::get('other_address')) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact6" class="control-label">勤務地(それ以降の住所)</label>
                        </th>
                        <td>
                            {{ Input::get('other_address2') }}
                            {{ Form::hidden('other_address2', Input::get('other_address2')) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact7" class="control-label">アクセス</label><span class="required">[必須]</span>
                        </th>
                        <td>
                        	{{ nl2br(Input::get('transportation')) }}
                        	{{ Form::hidden('transportation', Input::get('transportation')) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact8" class="control-label">勤務時間帯</label><span class="required">[必須]</span>
                        </th>
                        <td>
                        	{{ nl2br(Input::get('duty_hours')) }}
                        	{{ Form::hidden('duty_hours', Input::get('duty_hours')) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact9" class="control-label">給与体系</label><span class="required">[必須]</span>
                        </th>
                        <td>
                        	{{ nl2br(Input::get('salary')) }}
                        	{{ Form::hidden('salary', Input::get('salary')) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact10" class="control-label">休日休暇</label><span class="required">[必須]</span>
                        </th>
                        <td>
                        	{{ nl2br(Input::get('holiday')) }}
                        	{{ Form::hidden('holiday', Input::get('holiday')) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact5" class="control-label">応募資格</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            {{ nl2br(Input::get('capacity')) }}
                            {{ Form::hidden('capacity', Input::get('capacity')) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact11" class="control-label">福利厚生</label><span class="required">[必須]</span>
                        </th>
                        <td>
                        	{{ nl2br(Input::get('benefit')) }}
                        	{{ Form::hidden('benefit', Input::get('benefit')) }}
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
                        	{{ nl2br(Input::get('choice_process')) }}
                        	{{ Form::hidden('choice_process', Input::get('choice_process')) }}
                        </td>
                    </tr>
                      <tr>
                        <th>
                            <label for="inputContact13" class="control-label">所在地・面接会場</label><span class="required">[必須]</span>
                        </th>
                        <td>
                        	{{ nl2br(Input::get('interview_address')) }}
                        	{{ Form::hidden('interview_address', Input::get('interview_address')) }}
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
                           @if($images['main_company'])
	                           @foreach($images['main_company'] as $image)
	                           	 {{ HTML::image(Config::get('app.pathes.upload') .'/'. $image->dir .'/'. $image->filename, '', ['style' => 'max-width:200px;']) }}
	                           @endforeach
	                           @foreach(Input::get('surpass_ids_main_companies') as $image_file_id)
	                             {{ Form::hidden('surpass_ids_main_companies[]', $image_file_id) }}
	                           @endforeach
                           @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label class="control-label">サブ画像(2枚)</label><span class="required">[必須]</span>
                        </th>
                        <td>
                           @if($images['sub_company'])
	                           @foreach($images['sub_company'] as $image)
	                           	 {{ HTML::image(Config::get('app.pathes.upload') .'/'. $image->dir .'/'. $image->filename, '', ['style' => 'max-width:200px;']) }}
	                           @endforeach
	                           @foreach(Input::get('surpass_ids_sub_companies') as $image_file_id)
	                             {{ Form::hidden('surpass_ids_sub_companies[]', $image_file_id) }}
	                           @endforeach
                           @endif
                        </td>
                    </tr>
                     <tr>
                        <th>
                            <label class="control-label">企業/担当者紹介画像</label>
                        </th>
                        <td>
                           @if($images['pic'])
	                           @foreach($images['pic'] as $image)
	                           	 {{ HTML::image(Config::get('app.pathes.upload') .'/'. $image->dir .'/'. $image->filename, '', ['style' => 'max-width:200px;']) }}
	                           @endforeach
	                           @foreach(Input::get('surpass_ids_pics') as $image_file_id)
	                             {{ Form::hidden('surpass_ids_pics[]', $image_file_id) }}
	                           @endforeach
                           @endif
                        </td>
                    </tr>                   
                    <tr>
                        <th>
                            <label for="inputContact14" class="control-label">採用担当者部署名</label>
                        </th>
                        <td>
                        	{{ Input::get('pic_department') }}
                        	{{ Form::hidden('pic_department', Input::get('pic_department')) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact15" class="control-label">採用担当者名</label>
                        </th>
                        <td>
                        	{{ Input::get('pic_name') }}
                        	{{ Form::hidden('pic_name', Input::get('pic_name')) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact16" class="control-label">採用担当者コメント欄</label>
                        </th>
                        <td>
                        	{{ nl2br(Input::get('pic_comment')) }}
                        	{{ Form::hidden('pic_comment', Input::get('pic_comment')) }}
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
                        	<p>
                        	@if(Input::get('notification_type') == 2)
	                        	{{ Input::get('notification_email') }}
                        	@else
                        		{{ $user->email }}
                        	@endif
                        	</p>
                        	{{ Form::hidden('notification_email', Input::get('notification_email')) }}
                        	{{ Form::hidden('notification_type', Input::get('notification_type')) }}
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
                           @if(Input::get('displayed') == 1)
                           	掲載
                           @else
                           	非掲載
                           @endif
                           {{ Form::hidden('displayed', Input::get('displayed')) }}
                        </td>
                    </tr>
                    <tr>
                          <th>
                            <label class="control-label">応募上限</label><span class="required">[必須]</span>
                        </th>
                        <td>
                           @if(Input::get('application_ceiling_type_id') == 1)
                           	<p>制限有り</p>
                          	<p>{{ Input::get('application_amount') }}人まで</p>
                           @else
                           	<p>制限なし</p>
                           @endif
                           {{ Form::hidden('application_ceiling_type_id', Input::get('application_ceiling_type_id')) }}
                           {{ Form::hidden('application_amount', Input::get('application_amount')) }}
                        </td>
                    </tr>
                    <tr>
                          <th>
                            <label class="control-label">掲載期限</label><span class="required">[必須]</span>
                        </th>
                        <td>
                           @if(Input::get('release_type_id') == 1)
                           	<p>制限有り</p>
                          	<p>{{ Input::get('release_year') }}年 {{ Input::get('release_month') }}月 {{ Input::get('release_day') }}日</p>
                           @else
                           	<p>制限なし</p>
                           @endif
                           {{ Form::hidden('release_type_id', Input::get('release_type_id')) }}
                           {{ Form::hidden('release_year', Input::get('release_year')) }}
                           {{ Form::hidden('release_month', Input::get('release_month')) }}
                           {{ Form::hidden('release_day', Input::get('release_day')) }}
                        </td>
                    </tr>                  
                </table>
                  
                <div class="text-center">
                <!--
                    <button name="submit_revert" type="submit" class="btn btn-default send-btn">修正する</button>　
                --> 
                    <button name="submit_post" type="submit" class="btn btn-primary send-btn">送信する</button>
                </div>
              </div><!--/row-->

 
            </div><!--/.col-xs-12.col-sm-9-->

          @if(Input::exists('id'))
          	{{ Form::hidden('id', Input::get('id')) }}
          @endif
          {{ Form::hidden('recommended', Input::get('recommended')) }}

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