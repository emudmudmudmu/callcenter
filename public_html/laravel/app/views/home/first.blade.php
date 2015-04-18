@extends('layouts.home', [
	'page_title' => Config::get('app.site_title')
])

@section('content')

    <section class="l-contents cf">
        <section class="l-main">
            <div class="first">
                <h2 class="h">{{ HTML::image('home/assets/img/first/h_first.jpg', 'はじめてのコールセンター&#10;安心のサポート体制&&#10;コールセンターでは経験者でないと務まらないと思っていられる方。&#10;緊張して、電話でのお客様対応ができないと思っていられる方。&#10;何も心配いりません。経験者よりも未経験者の方のが多いのです。', ['width' => '750', 'height' => '249']) }}</h2>
                <div class="firstbox-com">
                    <h3>{{ HTML::image('home/assets/img/first/communication_headline.png', 'コールセンターは、人とのコミュニケーションが大事なお仕事です！', ['width' => '750', 'height' => '40']) }}</h3>
                    <p>コールセンターでは、各企業の窓口として対応するため「企業の顔」とも言われております。それだけお客様対応については、どの企業も徹底しています。様々な理由でお電話をいただくお客様に対して誠意をもって正確に案内しなければなりませんのでお客様とのコミュニケーション能力が求められるお仕事です。</p>
                </div>
                <div class="firstbox" id="about">
                    <h3>{{ HTML::image('home/assets/img/first/about_headline.png', 'コールセンターのお仕事内容は？', ['width' => '750', 'height' => '40']) }}</h3>
                    <div class="txt">
                        <h4>{{ HTML::image('home/assets/img/first/about_subhead.png', '未経験者歓迎！数週間後にデビュー', ['width' => '336', 'height' => '15']) }}</h4>
                        <p>コールセンターの業務は大きく受信と発信に分かれます。受信はカスタマーサポート・通販受注・テクニカルサポートなどで求人の80%を占めます。発信は電話調査やテレアポなどが代表的な業務です。入社後は、必ず研修がありますので未経験者の方でも全く問題なく数週間後にはデビューされてます。</p>
                    </div>
                    <p class="ph"><img src="home/assets/img/first/about_ph.jpg" width="270" height="180" alt=""></p>
                </div>
                <div class="firstbox" id="training">
                    <h3>{{ HTML::image('home/assets/img/first/training_headline.png', '研修体制はどんな感じなの？', ['width' => '750', 'height' => '40']) }}</h3>
                    <div class="txt">
                        <h4>{{ HTML::image('home/assets/img/first/training_subhead.png', '研修期間は数週間～２ヶ月', ['width' => '336', 'height' => '15']) }}</h4>
                        <p>コールセンターでは就業が決まると、必ず研修が行われます。<br>オペレーターとしての基礎知識、電話対応、商品知識、個人情報などを期間中に学びます。期間は企業によって異なりますが約数週間～２ヶ月程度で研修中もお給料は支払われます。<br>その後、ＯＪＴといい実際にお客様と対応します。その際には横に先輩がついてサポートしてもらえます。</p>
                    </div>
                    <p class="ph">{{ HTML::image('home/assets/img/first/training_img.png', '研修プログラム', ['width' => '340', 'height' => '135']) }}</p>
                </div>
                <div class="firstbox" id="payment">
                    <h3>{{ HTML::image('home/assets/img/first/payment_headline.png', 'コールセンターのお給料体系とは？', ['width' => '750', 'height' => '40']) }}</h3>
                    <div class="txt">
                        <h4>{{ HTML::image('home/assets/img/first/payment_subhead.png', 'コールセンターは未経験でも高収入！', ['width' => '336', 'height' => '15']) }}</h4>
                        <p>一般的な事務職では未経験で時給1500円の求人はほとんどありません。ですから、コールセンターは未経験でもいきなり高時給でスタートできる魅力的な仕事といえます。なお、コールセンターのお仕事は職場環境と給与がいいので近年とても人気のある職種でもあります。</p>
                    </div>
                    <p class="ph">{{ HTML::image('home/assets/img/first/payment_img.png', 'コールセンター全国平均時給のグラフ', ['width' => '266', 'height' => '159']) }}</p>
                </div>
                <div class="firstbox" id="dress">
                    <h3>{{ HTML::image('home/assets/img/first/dressscode_headline.png', '職場での服装や髪型のルールはあるの？', ['width' => '750', 'height' => '40']) }}</h3>
                    <div class="txt">
                        <h4>{{ HTML::image('home/assets/img/first/dressscode_subhead.png', '各社の就業ルールに従いましょう！', ['width' => '336', 'height' => '15']) }}</h4>
                        <p>最近の会社ではビジネスカジュアルであれば何の問題も無いでしょう。しかし会社によってはビジネスカジュアルの基準が異なりますので採用担当者へ確認しましょう。髪型に関しましてはやはり清潔感があり、髪の色も明る過ぎない程度であれば問題ないですが会社によっては髪の明るさに基準を設けている企業もございますので、こちらに関しても採用担当者へ確認しましょう。</p>
                    </div>
                    <p class="ph"><img src="home/assets/img/first/dressscode_ph.jpg" width="270" height="180" alt=""></p>
                </div>
                <div class="firstbox" id="environment">
                    <h3>{{ HTML::image('home/assets/img/first/environment_headline.png', '職場の環境はどんな感じなの？', ['width' => '750', 'height' => '40']) }}</h3>
                    <div class="txt">
                        <h4>{{ HTML::image('home/assets/img/first/environment_subhead.png', '充実した環境！快適な職場環境', ['width' => '336', 'height' => '15']) }}</h4>
                        <p>コールセンターの多くは、大きなオフィスビルのワンフロアーを丸ごと借りていたり、なかにはビル丸ごとがコールセンター
                            というところもあります。女性が多いことから、女性には嬉しい空気清浄機や加湿器を備えているコールセンターがたくさんあります。そのほか、個人用ロッカーや電子レンジ、喫煙場所を備えたリフレッシュルームも完備されています。</p>
                    </div>
                    <p class="ph"><img src="home/assets/img/first/environment_ph.jpg" width="270" height="180" alt=""></p>
                </div>
                <div class="firstbox" id="day">
                    <h3>{{ HTML::image('home/assets/img/first/day_headline.png', '１日の仕事内容は？', ['width' => '750', 'height' => '40']) }}</h3>
                    <div class="txt">
                        <h4>{{ HTML::image('home/assets/img/first/day_subhead.png', '快適オフィスでのお客様対応！', ['width' => '336', 'height' => '15']) }}</h4>
                        <p>一般的には出勤後に朝礼を行い、受付開始時刻に合わせて受信の準備をして待機します。その後、受信もしくは発信を開始します。午前、午後に数回リフレッシュ休憩（小休憩）があり、昼食を取り午後の就業がはじまります。コールセンターの多くはいくつかのシスト時間が設定されておりますので、個々のシストによって変わってきます。</p>
                    </div>
                    <p class="ph"><img src="home/assets/img/first/day_ph.jpg" width="270" height="180" alt=""></p>
                </div>
            </div>
        </section><!-- /.l-main -->

@stop