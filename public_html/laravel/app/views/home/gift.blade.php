@extends('layouts.home', [
	'page_title' => 'お祝い金申請'
])

@section('content')
    <section class="l-contents cf">
        <section class="l-main">
            <div class="gift-request">

                @if(FormStrap::hasAlert(['success']))
                    <br>
                    <div class="oiwaikinregister">
                        {{ HTML::image('home/assets/img/gift_request/oiwaikin.png', 'お祝い金申請完了', ['width' => '750', 'height' => '120']) }}
                    </div>
                @else
                <h2 class="h">{{ HTML::image('home/assets/img/gift_request/h_gift_request.png', 'お祝い金申請', ['width' => '750', 'height' => '95']) }}</h2>
                <div class="formbox">
                    {{ Form::open(['route' => 'home.gift_confirm']) }}
                        <h3>応募した求人情報</h3>
                        <table>
                            <tr>
                                <th>申請する求人情報　<span class="required">[必須]</span></th>
                                <td>
                                    @if(count($application_values) > 0)
                                        <div class="col-md-6">
                                            {{ Form::select('job_id', $application_values) }}
                                        </div>
                                    @else
                                        {{ Form::text('job_id') }}
                                        例）{{ AccountId::text('job', 1) }}
                                    @endif
                                    <div class="text-danger">{{ $errors->first('job_encoded_id') }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th>面接日　<span class="required">[必須]</span></th>
                                <td>
                                    {{ Form::select('interview_year', ['' => '選択'] + Year::interview_year_data(false)) }}
                                    年　
                                    {{ Form::select('interview_month', Month::month_numeric_data()) }}
                                    月　
                                    {{ Form::select('interview_day', Day::day_numeric_data()) }}
                                    日
                                    @if($errors->first('interview_year'))
                                        <div class="text-danger">{{ $errors->first('interview_year') }}</div>
                                    @endif
                                    @if($errors->first('interview_month'))
                                        <div class="text-danger">{{ $errors->first('interview_month') }}</div>
                                    @endif
                                    @if($errors->first('interview_day'))
                                        <div class="text-danger">{{ $errors->first('interview_day') }}</div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>応募者氏名　<span class="required">[必須]</span></th>
                                <td>{{ Form::text('shipping_name', ($applicant != null) ? $applicant->last_name : '') }}<div class="text-danger">{{ $errors->first('shipping_name') }}</div></td>
                            </tr>
                            <tr>
                                <th>メールアドレス　<span class="required">[必須]</span></th>
                                <td>{{ Form::text('email', ($applicant != null) ? $applicant->email : '') }}<div class="text-danger">{{ $errors->first('email') }}</div></td>
                            </tr>
                        </table>
                        <h3>お祝いQUOカード発送先情報</h3>
                        <table class="mb0">
                            <tr>
                                <th>発送先住所　<span class="required">[必須]</span></th>
                                <td>〒{{ Form::text('zip_code', ($applicant_meta != null) ? $applicant_meta->zip_code : '', ['class' => 'zip']) }}<br><div class="text-danger">{{ $errors->first('zip_code') }}</div>
                                    {{ Form::text('shipping_address', ($applicant_meta != null) ? JapanesePrefectures::prefectureName($applicant_meta->prefecture_id) . $applicant_meta->city . $applicant_meta->other_address_1 . $applicant_meta->other_address_2 : '') }}
                                    <div class="text-danger">{{ $errors->first('shipping_address') }}</div>
                                </td>
                            </tr>
                        </table>
                        <p class="btn"><input type="image" src="home/assets/img/form/btn_confirm.png" alt="確認する"></p>
                    {{ Form::close() }}
                </div><!-- /.formbox -->
                @endif
            </div>
        </section><!-- /.l-main -->

@stop