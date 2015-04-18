@extends('layouts.home', [
	'page_title' => Config::get('app.site_title')
])

@section('meta')
    <meta name="keywords" content="" />
    <meta name="description" content="" />
@stop

@section('content')

<section class="top-mainvisual">
    <div class="mainvisual-box">
        <div class="slide-area">
            <div class="slider">
                <ul class="slide-img">
                    <li><img src="home/assets/img/top/slider_01.jpg" width="750" height="250" alt=""></li>
                    <li><a href="{{ route('home.quo') }}"><img src="home/assets/img/top/slider_02.jpg" width="750" height="250" alt=""></a></li>
                    <li><a href="{{ route('auth.signup') }}"><img src="home/assets/img/top/slider_03.jpg" width="750" height="250" alt=""></a></li>
                    <li><a href="{{ route('home.first') }}"><img src="home/assets/img/top/slider_04.jpg" width="750" height="250" alt=""></a></li>
                </ul>
            </div>
            <p class="banner"><img src="home/assets/img/top/bnr_sample.png" width="230" height="250" alt=""></p>
        </div>
        <div class="ticker">
            <dl>
                <dt>{{ HTML::image('home/assets/img/top/headline_news.png', 'News', ['width' => '99', 'height' => '28']) }}</dt>
                <dd>
                    <ul class="news-ticker">
                        <li>コールセンターの窓口は、コールセンター・コンタクトセンターに特化した求人情報サイトです。</li>
                        <li>コールセンターの窓口では国内初の面接実施でお祝い金（QUOカード）最大5,000円を全員にプレゼント実施中です。</li>
                    </ul>
                </dd>
            </dl>
        </div><!-- /.ticker -->
    </div>
</section><!-- /.top-mainvisual -->
<section class="l-contents cf">
    <section class="l-main">

        @include('partials.html.search_box2')<!-- /.search-box -->
        <div class="callcenter">
            <p>{{ HTML::image('home/assets/img/top/callcenter_main.png', 'はじめてのコールセンター&#10;徹底した研修！やりがいのある仕事内容！充実した職場環境！目指せスキルアップ！', ['width' => '750', 'height' => '196']) }}</p>
            <ul>
                <li><a href="{{ route('home.first') }}#about">{{ HTML::image('home/assets/img/top/callcenter_bnr_01.png', '実際の仕事内容は！？', ['width' => '375', 'height' => '69']) }}</a></li>
                <li><a href="{{ route('home.first') }}#dress">{{ HTML::image('home/assets/img/top/callcenter_bnr_02.png', 'ドレスコードってあるの！？服装や髪形は？', ['width' => '375', 'height' => '69']) }}</a></li>
                <li><a href="{{ route('home.first') }}#training">{{ HTML::image('home/assets/img/top/callcenter_bnr_03.png', '不安を解消！？しっかり研修！？研修体制は？', ['width' => '375', 'height' => '69']) }}</a></li>
                <li><a href="{{ route('home.first') }}#environment">{{ HTML::image('home/assets/img/top/callcenter_bnr_04.png', '実際の仕事内容は！？職場環境は？', ['width' => '375', 'height' => '69']) }}</a></li>
                <li><a href="{{ route('home.first') }}#payment">{{ HTML::image('home/assets/img/top/callcenter_bnr_05.png', '他業種と比べてどうなの！？お給料体系は？', ['width' => '375', 'height' => '69']) }}</a></li>
                <li><a href="{{ route('home.first') }}#day">{{ HTML::image('home/assets/img/top/callcenter_bnr_06.png', '実際の仕事内容は！？一日の仕事は？', ['width' => '375', 'height' => '69']) }}</a></li>
            </ul>
        </div><!-- /.callcenter -->
        <div class="recommend">
            <h3>{{ HTML::image('home/assets/img/top/subhead_recommend.png', 'オススメ求人情報', ['width' => '750', 'height' => '40']) }}</h3>
            <div class="top-inner-box">
                @if($recommendations->count() > 0)
                    @foreach($recommendations as $recommendation)
                        <dl>
                            <dt>{{ HTML::linkRoute('home.job_detail', $recommendation->title, [$recommendation->id]) }}</dt>
                            <dd>
                                <p><a href="{{ route('home.job_detail', [$recommendation->id]) }}">{{ HTML::image($image_urls['main_companies'][$recommendation->meta_values['main_company_image_file_ids'][0]], $recommendation->title, ['style' => 'width:132px;height:92px;']) }}</a></p>
                                <ul class="details">
                                <table class="top_table">
                                    <tr><td><img src="home/assets/img/top/recommend_area.png" width="50" height="18" alt="勤務地"></td><td>&nbsp;{{ $recommendation->prefecture->prefecture_name }}{{ mb_strimwidth(\Address::filterCityId($recommendation->other_address)->first()->city_name, 0, 14, '..') }}</td></tr>
                                    <tr><td><img src="home/assets/img/top/recommend_type.png" width="50" height="18" alt="業種"></td><td class="job_category">
                                            @foreach($recommendation->meta_values['category_ids'] as $category_id)
                                                {{ JobCategory::job_category_name($category_id) }}　
                                            @endforeach
                                    </li></td></tr>
                                    <tr><td><img src="home/assets/img/top/recommend_access.png" width="50" height="18" alt="アクセス"></td><td>&nbsp;{{ mb_strimwidth($recommendation->transportation, 0, 22, '..') }}</td></tr>
                                    <tr><td><img src="home/assets/img/top/recommend_salary.png" width="50" height="18" alt="給与"></td><td>&nbsp;{{ mb_strimwidth($recommendation->salary, 0, 22, '..') }}</td></tr>
                                </table>
                            </dd>
                                <p class="recommend-txt">{{ $recommendation->catch_phrase }}</p>
                        </dl>
                    @endforeach
                @endif
            </div>
        </div><!-- /.recommend -->
        <div class="news">
            <h3>{{ HTML::image('home/assets/img/top/subhead_news.png', '最新コールセンター情報', ['width' => '750', 'height' => '40']) }}</h3>
            <div class="top-inner-box">
                <dl>
                    <dt>2014/00/00</dt>
                    <dd><a href="callcenter_info.html">あああああああああああああああああああああああああああああああああああああああ</a></dd>
                    <dt>2014/00/00</dt>
                    <dd><a href="callcenter_info.html">あああああああああああああああああああああああああああああああああああああああ</a></dd>
                    <dt>2014/00/00</dt>
                    <dd><a href="callcenter_info.html">あああああああああああああああああああああああああああああああああああああああ</a></dd>
                    <dt>2014/00/00</dt>
                    <dd><a href="callcenter_info.html">あああああああああああああああああああああああああああああああああああああああ</a></dd>
                </dl><!-- /. -->
            </div>
        </div><!-- /.news -->
        <div class="fb">
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) {return;}
                    js = d.createElement(s); js.id = id;
                    js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
            </script>
            <div class="fb-like-box" data-href="https://www.facebook.com/callcentermado" data-width="750" data-height="250" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
        </div><!-- /.fb -->
    </section><!-- /.l-main -->

@stop