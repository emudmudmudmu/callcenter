@extends('layouts.home', [
	'page_title' => 'お祝い金申請'
])

@section('content')

    <section class="l-contents cf">
        <section class="l-main">
            <div class="gift-request">
                <h2 class="h">{{ HTML::image('home/assets/img/gift_request/h_gift_request.png', 'お祝い金申請', ['width' => '750', 'height' => '95']) }}</h2>
                <div class="formbox">
                    {{ Form::open(['route' => 'home.gift_complete']) }}
                        <p class="confirm-txt">内容をご確認の上、ご送信ください。</p>
                        <h3>応募した求人情報</h3>
                        <table>
                            <tr>
                                <th>申請する求人情報　<span class="required">[必須]</span></th>
                                <td>{{ Input::get('job_id') }}{{ Form::hidden('job_id', Input::get('job_id')) }}</td>
                            </tr>
                            <tr>
                                <th>面接日　<span class="required">[必須]</span></th>
                                <td>
                                    {{ Input::get('interview_year') }}年{{ Input::get('interview_month') }}月{{ Input::get('interview_day') }}日
                                    {{ Form::hidden('interview_year', Input::get('interview_year')) }}
                                    {{ Form::hidden('interview_month', Input::get('interview_month')) }}
                                    {{ Form::hidden('interview_day', Input::get('interview_day')) }}
                                </td>
                            </tr>
                            <tr>
                                <th>応募者氏名　<span class="required">[必須]</span></th>
                                <td>{{ Input::get('shipping_name') }}{{ Form::hidden('shipping_name', Input::get('shipping_name')) }}</td>
                            </tr>
                            <tr>
                                <th>メールアドレス　<span class="required">[必須]</span></th>
                                <td>{{ Input::get('email') }}{{ Form::hidden('email', Input::get('email')) }}</td>
                            </tr>
                        </table>
                        <h3>お祝いQUOカード発送先情報</h3>
                        <table class="mb0">
                            <tr>
                                <th>発送先住所　<span class="required">[必須]</span></th>
                                <td>〒{{ Input::get('zip_code') }}{{ Form::hidden('zip_code', Input::get('zip_code')) }}<br>
                                    {{ Input::get('shipping_address') }}{{ Form::hidden('shipping_address', Input::get('shipping_address')) }}
                                </td>
                            </tr>
                        </table>
                        <p class="btn"><input type="image" src="home/assets/img/form/btn_submit.png" alt="送信する"></p>
                    {{ Form::close() }}
                </div><!-- /.formbox -->
            </div>
        </section><!-- /.l-main -->

@stop