@extends('layouts.home', [
	'page_title' => 'お仕事を探す'
])

@section('content')

    <section class="l-contents cf">
        <section class="l-main">
            <div class="quocard">
                <h2 class="h">{{ HTML::image('home/assets/img/quocard/h_quocard.jpg', '【求人サイト初！】応募だけでお祝い金がもらえるのはコールセンターの窓口だけ。&#10;コールセンターの窓口にて応募面接された方全員！応募だけでもれなくQUOカード最大5千円', ['width' => '750', 'height' => '250']) }}</h2>
                <h3>{{ HTML::image('home/assets/img/quocard/headline_quocard.png', 'お祝いQUOカードを受け取るには　※お祝いQUOカードは登録住所に発送いたします。', ['width' => '750', 'height' => '40']) }}</h3>
                <p>{{ HTML::image('home/assets/img/quocard/step.png', 'STEP1 求人を検索&#10;STEP2 面接日を決める&#10;STEP3 面接を受ける&#10;STEP4 お祝い申請をする&#10;STEP5 おめでとうございます！お祝いQUOカードGET!!&#10;応募・面接された方全員にプレゼント中！&#10;お祝いQUOカード申請後に企業様に確認し、ご登録住所へ発送させて頂きます。&#10;お祝いQUOカードは500円～5,000円を用意しており、カード金額は発送をもってかえさせて頂きます。', ['width' => '750', 'height' => '410']) }}</p>
                <div class="notice">
                    <h4>お祝いQUOカード申請について、以下の項目をご確認下さい。</h4>
                    <ul>
                        <li>応募先の面接を受けていない場合は申請を受付できません。</li>
                        <li>お祝いQUOカードの申請期限は応募後60日以内です。</li>
                        <li>お祝いQUOカードの金額は、500円～5,000円をプレゼントしており、金額の発表は発送をもってかえさせて頂きます。</li>
                        <li>お祝いQUOカードは、ご登録いただいてある住所の方へ申請後30日以内に発送させていただきます。</li>
                    </ul>
                </div>
                <ul class="btn">
                    <li><a href="{{ route('auth.signup') }}">{{ HTML::image('home/assets/img/quocard/btn_registration.png', '会員登録はこちら', ['width' => '242', 'height' => '45']) }}</a></li>
                    <li><a href="{{ route('home.gift') }}">{{ HTML::image('home/assets/img/quocard/btn_celebrate.png', 'お祝いQUOカードを申請する', ['width' => '242', 'height' => '45']) }}</a></li>
                </ul>
            </div>
        </section><!-- /.l-main -->

@stop