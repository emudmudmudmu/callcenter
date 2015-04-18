@extends('layouts.home', [
	'page_title' => '会員情報の変更'
])

@section('content')

    <section class="l-contents cf">
        <section class="l-main">
            <div class="registration">
                @if(FormStrap::hasAlert(['success']))
                <div class="loginregister">
                    <br>
                    <a href="{{ route('home') }}">{{ HTML::image('home/assets/img/form/tourokuhenkou.png', '登録情報の変更完了', ['width' => '750', 'height' => '140']) }}</a>
                </div>
                @else
                <h2 class="h">{{ HTML::image('home/assets/img/form/h_registration_change.png', '登録情報の変更', ['width' => '750', 'height' => '95']) }}</h2>
                <p class="btn-r"><a href="{{ route('applicant.withdraw') }}">{{ HTML::image('home/assets/img/form/btn_to_withdraw.png', '退会はこちらから', ['width' => '145', 'height' => '24']) }}</a></p>
                <div class="formbox">
                    {{ Form::open(['route' => 'applicant.settings_confirm']) }}
                        <h3>基本情報</h3>
                        <table class="apply-table">
                            <tr>
                                <th>名前　<span class="required">[必須]</span></th>
                                <td>{{ Form::text('name', $applicant->last_name) }}</td>
                            </tr>
                            <tr>
                                <th>ふりがな　<span class="required">[必須]</span></th>
                                <td>{{ Form::text('kana', $applicant->applicant_meta->last_name_kana) }}</td>
                            </tr>
                            <tr>
                                <th class="va-top">住所　<span class="required">[必須]</span></th>
                                <td>
                                    <dl>
                                        <dt>郵便番号</dt>
                                        <dd>
                                            〒{{ Form::text('zip_code', $applicant->applicant_meta->zip_code, ['class' => 'zip2']) }}
                                            <div class="text-danger">{{ $errors->first('zip_code') }}</div>
                                        </dd>
                                        <dt>都道府県</dt>
                                        <dd>
                                            {{ Form::select('prefecture_id', ['' => '都道府県を選択してください'] + JapanesePrefectures::prefectures(), $applicant->applicant_meta->prefecture_id) }}
                                            <div class="text-danger">{{ $errors->first('prefecture_id') }}</div>
                                        </dd>
                                        <dt>市区町村</dt>
                                        <dd>
                                            {{ Form::text('city', $applicant->applicant_meta->city) }}
                                            <div class="text-danger">{{ $errors->first('city') }}</div>
                                        </dd>
                                        <dt>以降住所</dt>
                                        <dd>
                                            {{ Form::text('other_address_1', $applicant->applicant_meta->other_address_1) }}
                                            <div class="text-danger">{{ $errors->first('other_address_1') }}</div>
                                        </dd>
                                        <dt>マンション等</dt>
                                        <dd>{{ Form::text('other_address_2', $applicant->applicant_meta->other_address_2) }}</dd>
                                    </dl>
                                </td>
                            </tr>
                            <tr>
                                <th>生年月日　<span class="required">[必須]</span></th>
                                <td>
                                    {{ Form::select('birth_year', Year::birth_year_numeric_data(), $applicant->applicant_meta->birth_year) }}
                                    年　
                                    {{ Form::select('birth_month', Month::month_numeric_data(), $applicant->applicant_meta->birth_month) }}
                                    月　
                                    {{ Form::select('birth_day', Day::day_numeric_data(), $applicant->applicant_meta->birth_day) }}
                                    日
                                    <div class="text-danger">{{ $errors->first('birth_year') }}</div>
                                    <div class="text-danger">{{ $errors->first('birth_month') }}</div>
                                    <div class="text-danger">{{ $errors->first('birth_day') }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th>性別　<span class="required">[必須]</span></th>
                                <td>
                                    {{ Form::radio('gender', '1', ($applicant->applicant_meta->gender == 1)) }}{{Gender::gender_name(1)}}　{{ Form::radio('gender', '2', ($applicant->applicant_meta->gender == 2)) }}{{ Gender::gender_name(2) }}
                                    <div class="text-danger">{{ $errors->first('gender') }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th>電話番号　<span class="required">[必須]</span></th>
                                <td>
                                    {{ Form::text('tel', $applicant->applicant_meta->tel) }}
                                    <div class="text-danger">{{ $errors->first('tel') }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th>メールアドレス　<span class="required">[必須]</span></th>
                                <td>
                                    {{ Form::text('email', $applicant->email) }}
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                </td>
                            </tr>
                        </table>
                        <h3>経歴情報</h3>
                        <table class="apply-table">
                            <tr>
                                <th>現在の職業</th>
                                <td>
                                    {{ Form::text('current_job', $applicant->applicant_meta->current_job) }}
                                    <div class="text-danger">{{ $errors->first('current_job') }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th>最終学歴</th>
                                <td>
                                    {{ Form::text('education', $applicant->applicant_meta->education) }}
                                    <div class="text-danger">{{ $errors->first('education') }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th class="va-top">保有資格</th>
                                <td>
                                    {{ Form::textarea('qualification', $applicant->applicant_meta->qualification, ['cols' => '40', 'rows' => '5']) }}
                                    <div class="text-danger">{{ $errors->first('qualification') }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th class="va-top">職務経歴</th>
                                <td>
                                    {{ Form::textarea('career', $applicant->applicant_meta->career, ['cols' => '40', 'rows' => '5']) }}
                                    <div class="text-danger">{{ $errors->first('career') }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th class="va-top">自己PR</th>
                                <td>
                                    {{ Form::textarea('introduction', $applicant->applicant_meta->introduction, ['cols' => '40', 'rows' => '5']) }}
                                    <div class="text-danger">{{ $errors->first('introduction') }}</div>
                                </td>
                            </tr>
                        </table>
                        <h3>パスワードの設定</h3>
                        <table class="apply-table mb0">
                            <tr>
                                <th>パスワード <span class="required">[必須]</span></th>
                                <td>{{ Form::password('password') }} ご希望の半角英数字6文字以上</td>
                            </tr>
                            <tr>
                                <th>パスワード（確認用） <span class="required">[必須]</span></th>
                                <td>{{ Form::password('confirm_password') }} 上記と同じものを確認のために入力して下さい。</td>
                            </tr>
                        </table>
                        <p class="btn"><input type="image" src="{{ url('home/assets/img/form/btn_confirm.png') }}" alt="確認"></p>
                    {{ Form::close() }}
                </div>
                @endif

            </div>
        </section><!-- /.l-main -->
	
@stop