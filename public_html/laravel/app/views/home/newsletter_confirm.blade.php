@extends('layouts.home', [
	'page_title' => 'メールマガジン'
])

@section('content')

    <section class="l-contents cf">
        <section class="l-main">
            <div class="mailmagazine">
                <h2>{{ HTML::image('home/assets/img/mailmagazine/h_mailmagazine.png', 'コールセンターの窓口のメールマガジン', ['width' => '750', 'height' => '250']) }}</h2>
                <div class="arw">{{ HTML::image('home/assets/img/mailmagazine/img_arrow_down.png', 'ご希望エリアの最新のコールセンター求人を随時配信！&#10;お気軽にご利用ください。', ['width' => '400', 'height' => '66']) }}</div>
                <h3>{{ HTML::image('home/assets/img/mailmagazine/headline_form.png', 'メールマガジン登録フォーム', ['width' => '750', 'height' => '40']) }}</h3>
                <div class="formbox">
                    <p class="confirm-txt">内容をご確認の上、ご送信ください。</p>
                    {{ Form::open(['route' => 'home.newsletter_complete']) }}
                        <table class="apply-table">
                            <tr>
                                <th>氏名<span class="required">[必須]</span></th>
                                <td width="70%">{{ Input::get('name') }}{{ Form::hidden('name', Input::get('name')) }}</td>
                            </tr>
                            <tr>
                                <th>メールアドレス<span class="required">[必須]</span></th>
                                <td>{{ Input::get('email') }}{{ Form::hidden('email', Input::get('email')) }}</td>
                            </tr>
                            <tr>
                                <th>メールアドレス（確認）<span class="required">[必須]</span></th>
                                <td>{{ Input::get('confirm_email') }}{{ Form::hidden('confirm_email', Input::get('confirm_email')) }}</td>
                            </tr>
                            <tr>
                                <th>配信希望地域<span class="required">[必須]</span></th>
                                <td>{{ JapanesePrefectures::prefectureName(Input::get('prefecture_id')) }}{{ Form::hidden('prefecture_id', Input::get('prefecture_id')) }}</td>
                            </tr>
                            <tr>
                                <th>配信希望職種（複数選択可）<span class="required">[必須]</span></th>
                                <td>
                                    {{ implode('、', NewsletterJobType::job_type_names(Input::get('job_types'))) }}
                                    @foreach(Input::get('job_types') as $job_type_id)
                                        {{ Form::hidden('job_types[]', $job_type_id) }}
                                    @endforeach
                                </td>
                            </tr>
                        </table>
                        <p class="btn"><input type="image" src="home/assets/img/form/btn_submit.png" alt="送信する"></p>
                    {{ Form::close() }}
                </div>
            </div>
        </section><!-- /.l-main -->

@stop