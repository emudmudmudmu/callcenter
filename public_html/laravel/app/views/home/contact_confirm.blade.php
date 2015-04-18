@extends('layouts.home', [
	'page_title' => 'お問い合わせ'
])

@section('content')

    <section class="l-contents cf">
        <section class="l-main">
            <div class="contact">
                <h2 class="h"><img src="{{ url('/home/assets/img/contact/h_contact.png') }}" width="750" height="95" alt="お問い合わせ"></h2>
                <div class="formbox">
                    {{ Form::open(['route' => 'home.contact_complete']) }}
                        <p class="confirm-txt">内容をご確認の上、ご送信ください。</p>
                        <table class="apply-table">
                            <tr>
                                <th>お問合わせ内容<span class="required">[必須]</span></th>
                                <td width="73%">
                                    {{ $subjects[Input::get('subject')] }}
                                    {{ Form::hidden('subject', Input::get('subject')) }}
                                </td>
                            </tr>
                            <tr>
                                <th>会社名</th>
                                <td>
                                    {{ Input::get('company') }}
                                    {{ Form::hidden('company', Input::get('company')) }}
                                </td>
                            </tr>
                            <tr>
                                <th>お名前<span class="required">[必須]</span></th>
                                <td>
                                    {{ Input::get('name') }}
                                    {{ Form::hidden('name', Input::get('name')) }}
                                </td>
                            </tr>
                            <tr>
                                <th>メールアドレス<span class="required">[必須]</span></th>
                                <td>
                                    {{ Input::get('email') }}
                                    {{ Form::hidden('email', Input::get('email')) }}
                                </td>
                            </tr>
                            <tr>
                                <th>確認のためもう一度<span class="required">[必須]</span></th>
                                <td>
                                    {{ Input::get('confirm_email') }}
                                    {{ Form::hidden('confirm_email', Input::get('confirm_email')) }}
                                </td>
                            </tr>
                            <tr>
                                <th>ご用件<span class="required">[必須]</span></th>
                                <td>
                                    {{ Input::get('comment') }}
                                    {{ Form::hidden('comment', Input::get('comment')) }}
                                </td>
                            </tr>
                        </table>
                        <p class="btn"><input type="image" src="{{ url('/home/assets/img/form/btn_submit.png') }}" alt="送信する"></p>
                    {{ Form::close() }}
                </div>
            </div>
        </section><!-- /.l-main -->

@stop