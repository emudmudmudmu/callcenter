@extends('layouts.home', [
	'page_title' => '会員情報の変更'
])

@section('content')

    <section class="l-contents cf">
        <section class="l-main">
            <div class="registration">
                <h2 class="h">{{ HTML::image('home/assets/img/form/h_withdraw.png', '退会の確認', ['width' => '750', 'height' => '95']) }}</h2>
                <div class="formbox">
                    {{ Form::open(['route' => 'applicant.withdraw.post', 'onSubmit' => 'return confirm(\'一度退会すると全ての情報が削除され二度と復活することはできません。本当に退会してよろしいですか？\')']) }}
                        {{ Form::hidden('name', $applicant->last_name) }}
                        {{ Form::hidden('email', $applicant->email) }}
                        <h3>基本情報</h3>
                        <table class="apply-table">
                            <tr>
                                <th>名前</th>
                                <td>{{ $applicant->last_name }}</td>
                            </tr>
                            <tr>
                                <th>ふりがな</th>
                                <td>{{ $applicant->applicant_meta->last_name_kana }}</td>
                            </tr>
                            <tr>
                                <th class="va-top">住所</th>
                                <td>〒{{ $applicant->applicant_meta->zip_code }}<br>
                                    {{ JapanesePrefectures::prefectureName($applicant->applicant_meta->prefecture_id) }}{{ $applicant->applicant_meta->city }}{{ $applicant->applicant_meta->other_address_1 }}{{ $applicant->applicant_meta->other_address_2 }}
                                </td>
                            </tr>
                            <tr>
                                <th>生年月日</th>
                                <td>{{ $applicant->applicant_meta->birth_year }}年{{ $applicant->applicant_meta->birth_month }}月{{ $applicant->applicant_meta->birth_day }}日</td>
                            </tr>
                            <tr>
                                <th>性別</th>
                                <td>{{ Gender::gender_name($applicant->applicant_meta->gender) }}</td>
                            </tr>
                            <tr>
                                <th>電話番号</th>
                                <td>{{ $applicant->applicant_meta->tel }}</td>
                            </tr>
                            <tr>
                                <th>メールアドレス</th>
                                <td>{{ $applicant->email }}</td>
                            </tr>
                        </table>
                        <h3>経歴情報</h3>
                        <table class="apply-table">
                            <tr>
                                <th>現在の職業</th>
                                <td>{{ $applicant->applicant_meta->current_job }}</td>
                            </tr>
                            <tr>
                                <th>最終学歴</th>
                                <td>{{ $applicant->applicant_meta->education }}</td>
                            </tr>
                            <tr>
                                <th class="va-top">保有資格</th>
                                <td>{{ nl2br($applicant->applicant_meta->qualification) }}</td>
                            </tr>
                            <tr>
                                <th class="va-top">職務経歴</th>
                                <td>{{ nl2br($applicant->applicant_meta->career) }}</td>
                            </tr>
                            <tr>
                                <th class="va-top">自己PR</th>
                                <td>{{ nl2br($applicant->applicant_meta->introduction) }}</td>
                            </tr>
                        </table>
                        <p class="btn"><input type="image" src="{{ url('home/assets/img/form/btn_withdraw.png') }}" alt="退会する"></p>
                    {{ Form::close() }}
                </div>
            </div>
        </section><!-- /.l-main -->
	
@stop