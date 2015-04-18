@extends('layouts.home', [
	'page_title' => '求人応募'
])

@section('content')

    <section class="l-contents cf">
        <section class="l-main">
            @if(!Input::has('done'))
            <div class="gift-request">
                @if(FormStrap::hasAlert(['danger']))
                @endif
                <h2 class="h">{{ HTML::image('home/assets/img/form/h_apply.png', '求人応募', ['width' => '750', 'height' => '95']) }}</h2>
                <div class="formbox">
                    {{ Form::open(['route' => 'home.application_confirm']) }}
                        <h3>{{ $job->title }}への応募</h3>
                        <table class="apply-table">
                            <tr>
                                <th>名前　<span class="required">[必須]</span></th>
                                <td>
                                    {{ Form::text('name', ($applicant != null) ? $applicant->last_name . $applicant->first_name : '') }}
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th>ふりがな　<span class="required">[必須]</span></th>
                                <td>
                                    {{ Form::text('kana', ($applicant_meta != null) ? $applicant_meta->last_name_kana . $applicant_meta->first_name_kana : '') }}
                                    <div class="text-danger">{{ $errors->first('kana') }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th class="va-top">住所　<span class="required">[必須]</span></th>
                                <td>
                                    <dl>
                                        <dt>郵便番号</dt>
                                        <dd>
                                            〒{{ Form::text('zip_code', ($applicant_meta != null) ? $applicant_meta->zip_code : '', ['class' => 'zip2']) }}
                                            <div class="text-danger">{{ $errors->first('zip_code') }}</div>
                                        </dd>
                                        <dt>都道府県</dt>
                                        <dd>
                                            {{ Form::select('prefecture_id', ['' => '都道府県を選択してください'] + JapanesePrefectures::prefectures(), ($applicant_meta != null) ? $applicant_meta->prefecture_id : '') }}
                                            <div class="text-danger">{{ $errors->first('prefecture_id') }}</div>
                                        </dd>
                                        <dt>市区町村</dt>
                                        <dd>
                                            {{ Form::text('city', ($applicant_meta != null) ? $applicant_meta->city : '') }}
                                            <div class="text-danger">{{ $errors->first('city') }}</div>
                                        </dd>
                                        <dt>以降住所</dt>
                                        <dd>
                                            {{ Form::text('other_address_1', ($applicant_meta != null) ? $applicant_meta->other_address_1 : '') }}
                                            <div class="text-danger">{{ $errors->first('other_address_1') }}</div>
                                        </dd>
                                        <dt>マンション等</dt>
                                        <dd>{{ Form::text('other_address_2', ($applicant_meta != null) ? $applicant_meta->other_address_2 : '') }}</dd>
                                    </dl>
                                </td>
                            </tr>
                            <tr>
                                <th>生年月日　<span class="required">[必須]</span></th>
                                <td>
                                    {{ Form::select('birth_year', Year::birth_year_numeric_data(), ($applicant_meta != null) ? $applicant_meta->birth_year : '') }}
                                    年　
                                    {{ Form::select('birth_month', Month::month_numeric_data(), ($applicant_meta != null) ? $applicant_meta->birth_month : '') }}
                                    月　
                                    {{ Form::select('birth_day', Day::day_numeric_data(), ($applicant_meta != null) ? $applicant_meta->birth_day : '') }}
                                    日
                                    <div class="text-danger">{{ $errors->first('birth_year') }}</div>
                                    <div class="text-danger">{{ $errors->first('birth_month') }}</div>
                                    <div class="text-danger">{{ $errors->first('birth_day') }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th>性別　<span class="required">[必須]</span></th>
                                <td>
                                    {{ Form::radio('gender', '1', ($applicant_meta == null || $applicant_meta->gender == 1)) }}{{Gender::gender_name(1)}}　{{ Form::radio('gender', '2', ($applicant_meta != null && $applicant_meta->gender == 2)) }}{{ Gender::gender_name(2) }}
                                    <div class="text-danger">{{ $errors->first('gender') }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th>電話番号　<span class="required">[必須]</span></th>
                                <td>
                                    {{ Form::text('tel', ($applicant_meta != null) ? $applicant_meta->tel : '') }}
                                    <div class="text-danger">{{ $errors->first('tel') }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th>メールアドレス　<span class="required">[必須]</span></th>
                                <td>
                                    {{ Form::text('email', ($applicant != null) ? $applicant->email : '') }}
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th>現在の職業</th>
                                <td>
                                    {{ Form::text('current_job', ($applicant_meta != null) ? $applicant_meta->current_job : '') }}
                                    <div class="text-danger">{{ $errors->first('current_job') }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th>最終学歴</th>
                                <td>
                                    {{ Form::text('education', ($applicant_meta != null) ? $applicant_meta->education : '') }}
                                    <div class="text-danger">{{ $errors->first('education') }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th class="va-top">保有資格</th>
                                <td>
                                    {{ Form::textarea('qualification', ($applicant_meta != null) ? $applicant_meta->qualification : '', ['cols' => '40', 'rows' => '5']) }}
                                    <div class="text-danger">{{ $errors->first('qualification') }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th class="va-top">職務経歴</th>
                                <td>
                                    {{ Form::textarea('career', ($applicant_meta != null) ? $applicant_meta->career : '', ['cols' => '40', 'rows' => '5']) }}
                                    <div class="text-danger">{{ $errors->first('career') }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th class="va-top">自己PR</th>
                                <td>
                                    {{ Form::textarea('introduction', ($applicant_meta != null) ? $applicant_meta->introduction : '', ['cols' => '40', 'rows' => '5']) }}
                                    <div class="text-danger">{{ $errors->first('introduction') }}</div>
                                </td>
                            </tr>
                        </table>
                        <h3>応募情報の確認</h3>
                        <table class="mb0">
                            <tr>
                                <th>応募雇用形態　<span class="required">[必須]</span></th>
                                <td>
                                    {{ Form::select('job_type_id', ['' => '選択してください'] + JobType::job_type_names($job->meta_values['type_ids'], true)) }}
                                    　ご希望の雇用形態をお選びください。
                                    <div class="text-danger">{{ $errors->first('job_type_id') }}</div>
                                </td>
                            </tr>
                        </table>
                        <p class="btn"><input type="image" src="{{ url('home/assets/img/form/btn_confirm.png') }}" alt="確認する"></p>
                        {{ Form::hidden('job_id', $job->id) }}
                    {{ Form::close() }}
                </div><!-- /.formbox -->
            </div>
            @else
                <br>
                <br>
                {{ HTML::image('home/assets/img/form/kyuujin.png', '求人応募', ['width' => '750', 'height' => '120']) }}
            @endif
        </section><!-- /.l-main -->

@stop