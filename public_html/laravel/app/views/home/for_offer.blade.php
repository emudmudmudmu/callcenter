@extends('layouts.home', [
	'page_title' => '求人費を根本的に見直し'
])

@section('content')

    <section class="l-contents cf">
        <section class="l-main">
            <div class="for">
                <h2 class="h">{{ HTML::image('home/assets/img/for_offer/h_for.png', '求人費を根本的に見直しませんか？&#10;掲載費用無料&#10;応募課金型1応募3800円&#10;コールセンターの窓口&#10;応募型成果報酬の採用単価が一番安いんです！', ['width' => '750', 'height' => '371']) }}</h2>
                <ul class="contact-bnr">
                    <li><img src="home/assets/img/for_offer/bnr_tel.png" width="370" height="185" alt="お電話でのお問い合わせはこちら&#10;求人広告に関する / ご質問・お問い合わせ&#10;03-5543-1771&#10;9:30～18:00 土日・祝日及び弊社所定の休業日を除く" class="tel"></li>
                    <li><a href="{{ route('home.contact') }}"><img src="home/assets/img/for_offer/bnr_form.png" width="370" height="185" alt="WEBからのお問い合わせ　お問い合わせフォームへ" class="webform"></a></li>
                </ul>
                <section class="about">
                    <h3>{{ HTML::image('home/assets/img/for_offer/about_headline.png', 'コールセンターの窓口とは？', ['width' => '750', 'height' => '45']) }}</h3>
                    <p>{{ HTML::image('home/assets/img/for_offer/about_txt.png', 'コールセンターの窓口は、国内初コールセンターに特化した求人サイトです。セグメントされた求人サイトなので求職者の目的もはっきりしており、通常の求人サイトよりも高い採用率を誇っております。同時に、応募課金型ですので採用コストを徹底的に削減できる求人サイトとなっております。', ['width' => '750', 'height' => '70']) }}</p>
                </section>
                <section class="point">
                    <h3>{{ HTML::image('home/assets/img/for_offer/point_headline.png', 'コールセンターの窓口の特徴・ユーザー層！', ['width' => '750', 'height' => '45']) }}</h3>
                    <p>{{ HTML::image('home/assets/img/for_offer/point1.png', 'POINT1&#10;求人広告掲載料・初期費用は一切不要&#10;通常、求人広告の掲載には応募・採用の有無に関わらず、一定の広告掲載料がかかります。 しかし掲載をしても応募が無い、または採用にいたらなかった場合、そのコストは無駄になってしまいます。そういった問題をすべて解決するのが「コールセンターの窓口」。 応募課金型求人では、採用するまで費用が一切かかりません。', ['width' => '750', 'height' => '175']) }}</p>
                    <p>{{ HTML::image('home/assets/img/for_offer/point2.png', 'POINT2&#10;応募課金単価は、1名応募3,800円&#10;企業様の求人募集の一番の目的は、いかに多くの良い人材を少しでも安価なコストで採用することです。近年の求人サイトでは様々なパターンの掲載広告費が設定されていますが、費用対効果が最も高い広告パターンが「応募課金型」と言われております。実際に採用課金型とは約1/4 程度の広告費用で同じ人数を採用することができます。しかしながら多くの企業様は、応募課金型だと面接にも来ない無駄な応募にも課金される心配をされている傾向がありますが応募数の約25% が採用されますので圧倒的に「応募課金型」がお得になっております。', ['width' => '750', 'height' => '234']) }}</p>
                    <p>{{ HTML::image('home/assets/img/for_offer/point3.png', 'POINT3&#10;国内初！求人応募者全員に「ＱＵＯカード」贈呈！&#10;近年の求人サイトでは、採用者に対して「お祝い金」を支払うサイトが増えておりますが、当社のサイトでは、国内初応募の段階で全員に当社オリジナルＱＵＯカードを贈呈しております。金額は500 円～最大5,000 円のＱＵＯカードを送付致します。そのため、他の求人サイトよりも応募する魅力を求職者へ与えることにより、より多くの求職者を企業様へご案内させていただいております。', ['width' => '750', 'height' => '195']) }}</p>
                    <p>{{ HTML::image('home/assets/img/for_offer/point4.png', 'POINT4&#10;国内有数の大手ＳＮＳサイトとの連携！&#10;コールセンターの窓口は、複数の大手ＳＮＳサイトとの連携により効果的に求人情報を配信しております。コールセンターに最適な求人層に合わせたプロモーションを行っておるので非常に高い角度でアプローチをさせていただいております。', ['width' => '750', 'height' => '157']) }}</p>
                    <p>{{ HTML::image('home/assets/img/for_offer/user_graph.png', 'ユーザー層グラフ', ['width' => '750', 'height' => '309']) }}</p>
                </section>
                <ul class="contact-bnr">
                    <li><img src="home/assets/img/for_offer/bnr_tel.png" width="370" height="185" alt="お電話でのお問い合わせはこちら&#10;求人広告に関する / ご質問・お問い合わせ&#10;03-5543-1771&#10;9:30～18:00 土日・祝日及び弊社所定の休業日を除く" class="tel"></li>
                    <li><a href="{{ route('home.contact') }}"><img src="home/assets/img/for_offer/bnr_form.png" width="370" height="185" alt="WEBからのお問い合わせ　お問い合わせフォームへ" class="webform"></a></li>
                </ul>
                <section class="simulation">
                    <h3>{{ HTML::image('home/assets/img/for_offer/simulation_headline.png', '他社との比較・費用シュミレーション', ['width' => '750', 'height' => '45']) }}</h3>
                    <p>{{ HTML::image('home/assets/img/for_offer/simulation_table.png', '応募がない限り一切費用が掛からないのでリスクが無い&#10;応募数に応じて費用が発生。採用時の費用は一切掛からない&#10;応募成果報酬単価は１人3 , 8 0 0 円と業界最安値! それ以外一切発生しません', ['width' => '750', 'height' => '350']) }}</p>
                    <p>{{ HTML::image('home/assets/img/for_offer/simulation_sample.png', '「オペレーター５名を採用する場合のシミュレーション&#10;&#10;成果報酬型の中でも「応募型成果報酬」が圧倒的に費用対効果が高いんです!&#10;（3,800円（応募単価）×100人（応募人数）＝380,000 円で最終的に25人採用しております。）&#10;（平均採用実績）100人応募→70人面接→25人採用（採用率約25%）', ['width' => '750', 'height' => '544']) }}</p>
                </section>
                <section class="flow">
                    <h3>{{ HTML::image('home/assets/img/for_offer/flow_headline.png', 'お問い合わせから課金までの流れ', ['width' => '750', 'height' => '45']) }}</h3>
                    <p>{{ HTML::image('home/assets/img/for_offer/flow_step_subhead.png', 'ご掲載までの簡単3ステップ　お問い合わせから最短で3日後には掲載可能！', ['width' => '750', 'height' => '45']) }}</p>
                    <div class="flowbox">
                        <p><img src="home/assets/img/for_offer/flow_step123.png" width="139" height="344" alt=""></p>
                        <div>
                            <h4>{{ HTML::image('home/assets/img/for_offer/flow_seubhead_step01.png', 'お問い合わせ・担当よりご連絡', ['width' => '585', 'height' => '45']) }}</h4>
                            <p>電話でもWEBフォームからでもすぐにお問い合わせください！<br>求人広告に関するご相談だけでもOK！おりかえり担当よりご連絡いたします。</p>
                            <h4>{{ HTML::image('home/assets/img/for_offer/flow_seubhead_step02.png', 'ご契約・原稿作成', ['width' => '585', 'height' => '45']) }}</h4>
                            <p>お申込書ご記入後、管理画面をお渡しします。管理画面上で求人原稿を作成。</p>
                            <h4>{{ HTML::image('home/assets/img/for_offer/flow_seubhead_step03.png', '掲載スタート・レポート報告', ['width' => '585', 'height' => '45']) }}</h4>
                            <p>掲載内容を確認後即、掲載がスタートします。<br>ご請求の際に、求人毎に応募レポートを提出しますので次回掲載時の参考にどうぞ！</p>
                        </div>
                    </div>
                </section>
                <section class="faq">
                    <h3>{{ HTML::image('home/assets/img/for_offer/faq_headline.png', 'よくある質問', ['width' => '750', 'height' => '44']) }}</h3>
                    <dl>
                        <dt>{{ HTML::image('home/assets/img/for_offer/faq_01.png', '申し込みから掲載を開始するまでどのくらい掛かりますか？', ['width' => '750', 'height' => '33']) }}</dt>
                        <dd>お申し込み書に記入後すぐにクライアント用管理画面を発行いたします。管理画面内で御社が求人内容を登録して頂き、当社で確認完了後すぐに掲載可能となります。通常は最短３～５日で掲載可能です。</dd>
                        <dt>{{ HTML::image('home/assets/img/for_offer/faq_02.png', '掲載期間や追加料金などの制限はありますか？', ['width' => '750', 'height' => '33']) }}</dt>
                        <dd>掲載期間は無期限です。御社で必要な応募数に達した時点で一時停止や削除が可能ですし、掲載再開も御社のタイミングで行っていただけます。もちろん、掲載のON・OFF や掲載数による追加料金等は一切ございません。</dd>
                        <dt>{{ HTML::image('home/assets/img/for_offer/faq_03.png', '掲載途中で、掲載内容等を変更することは可能ですか？', ['width' => '750', 'height' => '33']) }}</dt>
                        <dd>可能です。<br>クライアント用管理画面上で24 時間変更・修正が可能です。</dd>
                        <dt>{{ HTML::image('home/assets/img/for_offer/faq_04.png', '不正応募が発生した場合も課金対象になるんですか？', ['width' => '750', 'height' => '33']) }}</dt>
                        <dd>御社へ課金請求する前に当社でも不正応募のチェックは行っておりますが、請求後にあきらかな不正な応募情報が発覚した場合は訂正請求させていただきます。</dd>
                        <dt>{{ HTML::image('home/assets/img/for_offer/faq_05.png', '採用後に何か請求されるものはありますか？', ['width' => '750', 'height' => '33']) }}</dt>
                        <dd>当社の課金システムは「応募課金型」ですので、採用時での課金等は一切ございません。</dd>
                        <dt>{{ HTML::image('home/assets/img/for_offer/faq_06.png', '応募者にお祝い金のようなものをプレゼントされてますが、企業側の負担はあるんですか？', ['width' => '750', 'height' => '33']) }}</dt>
                        <dd>当社の請求は応募数に応じてのみとなっておりますので、それ以外の請求は一切ございません。<br>（バナー広告をご利用の場合は別途掛ります）</dd>
                    </dl>
                </section>
                <ul class="contact-bnr">
                    <li><img src="home/assets/img/for_offer/bnr_tel.png" width="370" height="185" alt="お電話でのお問い合わせはこちら&#10;求人広告に関する / ご質問・お問い合わせ&#10;03-5543-1771&#10;9:30～18:00 土日・祝日及び弊社所定の休業日を除く" class="tel"></li>
                    <li><a href="{{ route('home.contact') }}"><img src="home/assets/img/for_offer/bnr_form.png" width="370" height="185" alt="WEBからのお問い合わせ　お問い合わせフォームへ" class="webform"></a></li>
                </ul>
            </div>
        </section><!-- /.l-main -->

@stop