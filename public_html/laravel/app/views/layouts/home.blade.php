<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>{{ $page_title }}</title>
    @if(Config::get('app.opened') == 0)
    <meta name="robots" content="noindex,nofollow"><!-- 公開時に必ず外す -->
    @endif
    @yield('meta')
    {{ HTML::style('home/style.css?'. Config::get('app.last_upgraded')) }}
    {{ HTML::style('home/assets/css/jquery.bxslider.css?'. Config::get('app.last_upgraded')) }}
    {{ HTML::style('home/assets/css/jquery-ui.css?'. Config::get('app.last_upgraded')) }}
    {{ HTML::style('home/assets/css/custom.css?'. Config::get('app.last_upgraded')) }}
    @yield('style')
</head>
<header class="cf" id="header">
    <section class="l-titlebar cf">
        <h1>コールセンター・コンタクトセンターの求人情報検索サイトは「コールセンターの窓口」</h1>
        <ul class="sub-navi">
            <li><a href="{{ route('home.quo') }}">{{ HTML::image('home/assets/img/layout/header/btn_cash.png', '祝い金について', ['width' => '112', 'height' => '20']) }}</a></li>
            <li><a href="{{ route('home.for_offer') }}">{{ HTML::image('home/assets/img/layout/header/btn_about_period.png', '求人広告掲載について', ['width' => '150', 'height' => '20']) }}</a></li>
            @if(!empty($user) && $user->hasPermission('applicant'))
                <li><a href="{{ route('auth.logout') }}">{{ HTML::image('home/assets/img/layout/header/btn_logout.png', 'ログアウト', ['width' => '76', 'height' => '20']) }}</a></li>
            @else
                <li><a href="{{ route('home.login') }}">{{ HTML::image('home/assets/img/layout/header/btn_login.png', 'ログイン', ['width' => '76', 'height' => '20']) }}</a></li>
            @endif
        </ul>
    </section>
    <section class="l-header cf">
        <h2 class="logo"><a href="{{ route('home') }}">{{ HTML::image('home/assets/img/layout/header/logo.png', 'コールセンターの窓口', ['width' => '270', 'height' => '75']) }}</a></h2>
        <p class="tel">{{ HTML::image('home/assets/img/layout/header/header_tel.png', '電話でのお問い合わせ　03-5543-1771　受付時間9：30～18：00', ['width' => '218', 'height' => '56']) }}</p>
    </section>
</header>
@include('partials.html.header_links')

@yield('content')
@include('partials.html.right_side')
<footer>
    <section class="l-pagetop">
        <p><a href="#" class="to_top">{{ HTML::image('home/assets/img/layout/btn_pagetop.png', '▲ページTOPへ', ['width' => '123', 'height' => '34']) }}</a></p>
    </section>
    <section class="l-footer-top">
        <ul>
            <li><a href="{{ route('home.about_us') }}">{{ HTML::image('home/assets/img/layout/footer/fnav_01.png', '会社概要', ['width' => '52', 'height' => '16']) }}</a></li>
            <li><a href="{{ route('home.privacy_policy') }}">{{ HTML::image('home/assets/img/layout/footer/fnav_02.png', '個人情報について', ['width' => '125', 'height' => '16']) }}</a></li>
            <li><a href="{{ route('home.rules') }}">{{ HTML::image('home/assets/img/layout/footer/fnav_03.png', '利用規約', ['width' => '52', 'height' => '16']) }}</a></li>
            <li><a href="{{ route('home.for_offer') }}">{{ HTML::image('home/assets/img/layout/footer/fnav_04.png', '掲載企業様', ['width' => '88', 'height' => '16']) }}</a></li>
            <li><a href="{{ route('home.newsletter') }}">{{ HTML::image('home/assets/img/layout/footer/fnav_05.png', 'メールマガジン登録', ['width' => '113', 'height' => '16']) }}</a></li>
            <li><a href="{{ route('home.contact') }}">{{ HTML::image('home/assets/img/layout/footer/fnav_06.png', 'お問い合わせ', ['width' => '75', 'height' => '16']) }}</a></li>
        </ul>
    </section>
    <section class="l-footer-bottom cf">
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.0";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <p class="foot-logo">{{ HTML::image('home/assets/img/layout/footer/logo.png', 'コールセンターの窓口', ['width' => '215', 'height' => '59']) }}</p>
        <br>
        <div style="padding-left: 5px;">
        <div class="fb-like" data-href="https://www.facebook.com/callcentermado" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>
        <br>    
        <p class="foot-txt">コールセンターの窓口は、国内初コールセンター専門の総合情報求人サイトです。あなたに最適な職場探しをサポートします。なお、業界初の試みとして応募者全員に「お祝い金」を贈呈しております。</p>
        </div>
        <div class="fnav-box">
            <ul>
                <li class="bnr">{{ HTML::image('home/assets/img/layout/footer/fbtn_01.png', '求人情報検索', ['width' => '160', 'height' => '30']) }}</li>
                <li>{{ HTML::linkRoute('home.new_job', '新着求人情報') }}</li>
                <li>{{ HTML::linkRoute('home.job', 'お仕事を探す') }}</li>
                <li>{{ HTML::linkRoute('applicant.consideration', '検討中リスト') }}</li>
            </ul>
            <ul>
                <li class="bnr">{{ HTML::image('home/assets/img/layout/footer/fbtn_02.png', '会員登録', ['width' => '160', 'height' => '30']) }}</li>
                <li>{{ HTML::linkRoute('auth.signup', '新規会員登録') }}</li>
                <li>{{ HTML::linkRoute('home.login', '会員ログイン') }}</li>
            </ul>
            <ul class="clm-r">
                <li class="bnr">{{ HTML::image('home/assets/img/layout/footer/fbtn_03.png', '採用サポート', ['width' => '160', 'height' => '30']) }}</li>
                <li>{{ HTML::linkRoute('home.first', 'はじめてのコールセンター') }}</li>
                <li>{{ HTML::linkRoute('home.quo', 'お祝い金ページ') }}</li>
                <li>{{ HTML::linkRoute('home.gift', 'お祝い金申請ページ') }}</li>
                <li>{{ HTML::linkRoute('home.newsletter', 'メールマガジン登録') }}</li>
                <li>&nbsp;</li>
                <li>&nbsp;</li>
                <li>&nbsp;</li>
            </ul>
        </div>
    </section>
</footer>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
{{ HTML::script('home/assets/js/common.js?'. Config::get('app.last_upgraded')) }}
{{ HTML::script('home/assets/js/jquery.easing.1.3.js?'. Config::get('app.last_upgraded')) }}
{{ HTML::script('home/assets/js/jquery.bxslider.js?'. Config::get('app.last_upgraded')) }}
{{ HTML::script('home/assets/js/jquery-ui.js?'. Config::get('app.last_upgraded')) }}

@yield('script')

<script type="text/javascript">

    $(document).ready(function(){
        $('.slide-img').bxSlider({
            auto: true,
            pause:	7000,
            speed: 2000,
            mode: 'horizontal',
            pager:true
        });

        $('ul.news-ticker').bxSlider({
            easing:'linear',
            controls:false,
            auto: true,
            pager: false,
            speed: 7000,
            pause: 7000
        });
    });

    <!-- tab -->
    $(function() {
        $( "#tabs" ).tabs();
    });

</script>

@if(App::isLocal())
    {{ HTML::linkRoute('auth.login', '管理者ログイン') }}
    <script src="http://{{ Config::get('app.domains.main') }}:35729/livereload.js"></script>
    {{ Brick::render() }}
@endif

</body>
</html>
