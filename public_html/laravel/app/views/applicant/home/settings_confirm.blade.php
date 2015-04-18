@extends('layouts.home', [
	'page_title' => '会員情報の変更'
])

@section('content')

    <section class="l-contents cf">
        <section class="l-main">
            <div class="registration">
                <h2 class="h">{{ HTML::image('home/assets/img/form/h_registration_change.png', '登録情報の変更', ['width' => '750', 'height' => '95']) }}</h2>
                <p class="btn-r"><a href="withdraw.html">{{ HTML::image('home/assets/img/form/btn_to_withdraw.png', '退会はこちらから', ['width' => '145', 'height' => '24']) }}</a></p>
                <div class="formbox">
                    {{ Form::open(['route' => 'applicant.settings_complete']) }}
                        <p class="confirm-txt">内容をご確認の上、ご送信ください。</p>
                        <h3>基本情報</h3>
                        <table class="apply-table">
                            <tr>
                                <th>名前　<span class="required">[必須]</span></th>
                                <td>{{ Input::get('name') }}{{ Form::hidden('name', Input::get('name')) }}</td>
                            </tr>
                            <tr>
                                <th>ふりがな　<span class="required">[必須]</span></th>
                                <td>{{ Input::get('kana') }}{{ Form::hidden('kana', Input::get('kana')) }}</td>
                            </tr>
                            <tr>
                                <th class="va-top">住所　<span class="required">[必須]</span></th>
                                <td>〒{{ Input::get('zip_code') }}{{ Form::hidden('zip_code', Input::get('zip_code')) }}<br>
                                    {{ JapanesePrefectures::prefectureName(Input::get('prefecture_id')) }}{{ Input::get('city') }}{{ Input::get('other_address_1') }}{{ Input::get('other_address_2') }}
                                    {{ Form::hidden('prefecture_id', Input::get('prefecture_id')) }}
                                    {{ Form::hidden('city', Input::get('city')) }}
                                    {{ Form::hidden('other_address_1', Input::get('other_address_1')) }}
                                    {{ Form::hidden('other_address_2', Input::get('other_address_2')) }}
                                </td>
                            </tr>
                            <tr>
                                <th>生年月日　<span class="required">[必須]</span></th>
                                <td>
                                    {{ Input::get('birth_year') }}年{{ Input::get('birth_month') }}月{{ Input::get('birth_day') }}日
                                    {{ Form::hidden('birth_year', Input::get('birth_year')) }}
                                    {{ Form::hidden('birth_month', Input::get('birth_month')) }}
                                    {{ Form::hidden('birth_day', Input::get('birth_day')) }}
                                </td>
                            </tr>
                            <tr>
                                <th>性別　<span class="required">[必須]</span></th>
                                <td>{{ Gender::gender_name(Input::get('gender')) }}{{ Form::hidden('gender', Input::get('gender')) }}</td>
                            </tr>
                            <tr>
                                <th>電話番号　<span class="required">[必須]</span></th>
                                <td>{{ Input::get('tel') }}{{ Form::hidden('tel', Input::get('tel')) }}</td>
                            </tr>
                            <tr>
                                <th>メールアドレス　<span class="required">[必須]</span></th>
                                <td>{{ Input::get('email') }}{{ Form::hidden('email', Input::get('email')) }}</td>
                            </tr>
                        </table>
                        <h3>経歴情報</h3>
                        <table class="apply-table">
                            <tr>
                                <th>現在の職業</th>
                                <td>{{ Input::get('current_job') }}{{ Form::hidden('current_job', Input::get('current_job')) }}</td>
                            </tr>
                            <tr>
                                <th>最終学歴</th>
                                <td>{{ Input::get('education') }}{{ Form::hidden('education', Input::get('education')) }}</td>
                            </tr>
                            <tr>
                                <th class="va-top">保有資格</th>
                                <td>{{ nl2br(Input::get('qualification')) }}{{ Form::hidden('qualification', Input::get('qualification')) }}</td>
                            </tr>
                            <tr>
                                <th class="va-top">職務経歴</th>
                                <td>{{ nl2br(Input::get('career')) }}{{ Form::hidden('career', Input::get('career')) }}</td>
                            </tr>
                            <tr>
                                <th class="va-top">自己PR</th>
                                <td>{{ nl2br(Input::get('introduction')) }}{{ Form::hidden('introduction', Input::get('introduction')) }}</td>
                            </tr>
                        </table>
                        <h3>パスワードの設定</h3>
                        <table class="apply-table mb0">
                            <tr>
                                <th>パスワード <span class="required">[必須]</span></th>
                                <td>{{ Input::get('password') }}{{ Form::hidden('password', Input::get('password')) }}</td>
                            </tr>
                            <tr>
                                <th>パスワード（確認用） <span class="required">[必須]</span></th>
                                <td>{{ Input::get('confirm_password') }}{{ Form::hidden('confirm_password', Input::get('confirm_password')) }}</td>
                            </tr>
                        </table>
                        <p class="btn"><input type="image" src="{{ url('home/assets/img/form/btn_submit.png') }}" alt="送信する"></p>
                    {{ Form::close() }}
                </div>
            </div>
        </section><!-- /.l-main -->
	
@stop