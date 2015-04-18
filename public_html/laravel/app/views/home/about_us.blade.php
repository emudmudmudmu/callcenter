@extends('layouts.home', [
	'page_title' => '会社概要'
])

@section('content')

    <section class="l-contents cf">
        <section class="l-main">
            <div class="company">
                <h2 class="h">{{ HTML::image('home/assets/img/company/h_company.png', '会社概要', ['width' => '750', 'height' => '95']) }}</h2>
                <div class="companybox">
                   <table>
                        <tr>
                            <th>会社名</th>
                            <td>スターメディア株式会社　(STARMEDIA INC.)</td>
                        </tr>
                        <tr>
                            <th>代表</th><td>代表取締役社長　大庭　洋理</td>
                        </tr>
                        <tr>
                            <th>設立日</th><td>2015年1月20日</td>
                        </tr>
      					<tr>
                            <th>資本金</th><td>3,000,000円</td>
                        </tr>
                        <tr>
                            <th>本社</th><td>〒812-0011<br>福岡県福岡市博多区博多駅前</td>
                        </tr>
                              					<tr>
                            <th>企業サイト</th><td>URL :<img class="url" src="home/assets/img/top/aera_kanto_icon.png"  alt="→" align="top"> <a href="http://starmedia.co.jp">http://starmedia.co.jp</a></td>
                        </tr>
                              					<tr>
                            <th>取引銀行</th><td>楽天銀行</td>
                        </tr>
                        <tr>
                            <th>事業内容</th><td>メディアコンテンツ事業<br>映像メディア事業</td>
                        </tr>
                    </table>
                </div><!-- /.companybox -->
            </div><!-- /.company -->
        </section><!-- /.l-main -->

@stop