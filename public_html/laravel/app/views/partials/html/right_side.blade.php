    <section class="l-side">
        @if(!empty($user) && $user->hasPermission('applicant'))
            <div class="side-logout">
            <p class="side-logout-user">こんにちは {{ $user->last_name }} さん</p>
            <br>
            <div class="side-logout-btn"><a href="{{ route('applicant.consideration') }}">{{ HTML::image('home/assets/img/layout/side/kentou_btn.png', '検討中リスト', ['width' => '157', 'height' => '18']) }}</a></div>
            <div class="side-logout-btn"><a href="{{ route('home.gift') }}">{{ HTML::image('home/assets/img/layout/side/oiwaikin_btn.png', 'お祝い金', ['width' => '157', 'height' => '18']) }}</a></div>
            <div class="side-logout-btn"><a href="{{ route('home.newsletter') }}">{{ HTML::image('home/assets/img/layout/side/btn_mail.png', 'メールマガジン登録', ['width' => '157', 'height' => '18']) }}</a></div>
            <div class="side-logout-btn"><a href="{{ route('applicant.settings') }}">{{ HTML::image('home/assets/img/layout/side/change_btn.png', '登録情報の変更', ['width' => '157', 'height' => '18']) }}</a></div>
            <p class="side-logout-button"><a href="{{ route('auth.logout') }}">{{ HTML::image('home/assets/img/layout/side/logout_btn.png', 'ログアウト', ['width' => '167', 'height' => '37']) }}</a></p>
            </div>
        @else
            <div class="side-login">
                <p>{{ HTML::image('home/assets/img/layout/side/h_login.png', 'スムーズな仕事探しをサポート', ['width' => '230', 'height' => '98']) }}</p>
                <p><a href="{{ route('auth.signup') }}">{{ HTML::image('home/assets/img/layout/side/btn_registration.png', '無料会員登録', ['width' => '167', 'height' => '51']) }}</a></p>
                <p>{{ HTML::image('home/assets/img/layout/side/login_arrow.png', 'こちら', ['width' => '190', 'height' => '49']) }}</p>
                <p><a href="{{ route('home.login') }}">{{ HTML::image('home/assets/img/layout/side/btn_login.png', 'ログイン', ['width' => '167', 'height' => '35']) }}</a></p>
            </div>
        @endif
        <p class="side-box"><a href="{{ route('home.quo') }}">{{ HTML::image('home/assets/img/layout/side/bnr_quocard.png', 'QUOカードが必ずもらえる！', ['width' => '230', 'height' => '225']) }}</a></p>
        <div class="side-newdata side-box">
            <h4>{{ HTML::image('home/assets/img/layout/side/subhead_recruit.png', '新着求人情報', ['width' => '228', 'height' => '52']) }}</h4>
            <dl>
                @if($new_jobs->count() > 0)
                    @foreach($new_jobs as $new_job)
                        <div class="side-box-left">
                            <a href="{{ route('home.job_detail', [$new_job->id]) }}" class="side-box-font"><img src="{{ $new_job->metas[0]->image_file->url }}" class="new-ph" width="100" height="60" alt=""></a>
                        </div>
                        <div class="side-box-right">
                            <a href="{{ route('home.job_detail', [$new_job->id]) }}" class="side-box-font">{{ $new_job->title }}</a>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                            <p class="side-box-font2">{{ $new_job->catch_phrase }}</p>
                        <dd>
                            <ul>
                                <li class="side-box-li">{{ HTML::image('home/assets/img/layout/side/recommend_area-mini.png', '勤務地', ['width' => '36', 'height' => '11']) }}&nbsp;{{ $new_job->prefecture->prefecture_name }}{{ mb_strimwidth(\Address::filterCityId($new_job->other_address)->first()->city_name, 0, 25, '..') }}</li>
                                <li class="side-box-li">{{ HTML::image('home/assets/img/layout/side/recommend_access_mini.png', 'アクセス', ['width' => '36', 'height' => '11']) }}&nbsp;{{ mb_strimwidth($new_job->transportation, 0, 25, '..') }}</li>
                                <li class="side-box-li">{{ HTML::image('home/assets/img/layout/side/recommend_salary_mini.png', '給与', ['width' => '36', 'height' => '11']) }}&nbsp;{{ mb_strimwidth($new_job->salary, 0, 25, '..') }}</li>
                            </ul>
                            <p><a href="{{ route('home.job_detail', [$new_job->id]) }}">{{ HTML::image('home/assets/img/layout/side/recruit_btn_detail.png', '詳細を見る', ['width' => '210', 'height' => '15']) }}</a></p>
                            <br>
                        </dd>
                    @endforeach
                @endif
            </dl>
            <p class="side-newdate-btn"><a href="{{ route('home.new_job') }}">{{ HTML::image('home/assets/img/layout/side/recruit_btn_more.png', '新着求人を見る', ['width' => '128', 'height' => '14']) }}</a></p>
        </div><!-- /.side-newdata -->
        <div class="side-info side-box">
            <h4>{{ HTML::image('home/assets/img/layout/side/side_info.png', 'お知らせ', ['width' => '228', 'height' => '56']) }}</h4>
            <dl>
                @if($new_announcements->count() > 0)
                    @foreach($new_announcements as $new_announcement)
                        <dt>{{ $new_announcement->created_at->format('Y.m.d') }}</dt>
                        <dd>{{ HTML::linkRoute('home.announcement_detail', $new_announcement->title, [$new_announcement->id]) }}</dd>
                    @endforeach
                @endif
            </dl>
        </div><!-- /.side-info -->
        <ul class="side-bnr-list">
            <li><a href="{{ route('home.for_offer') }}">{{ HTML::image('home/assets/img/layout/side/bnr_for_corp.png', 'コールセンターの窓口　求人情報を掲載されたい企業様　お申込みはこちら', ['width' => '230', 'height' => '150']) }}</a></li>
            <li><a href="{{ route('home.contact') }}">{{ HTML::image('home/assets/img/layout/side/bnr_form.png', 'お問い合わせ', ['width' => '230', 'height' => '193']) }}</a></li>
            <li>{{ HTML::image('home/assets/img/layout/side/bnr_mobile.png', 'コールセンターの窓口 モバイル', ['width' => '230', 'height' => '155']) }}</li>
            <li>{{ HTML::image('home/assets/img/layout/side/bnr_globalsign.png', 'グローバルサイン　クリックして認証', ['width' => '230', 'height' => '120']) }}</li>
        </ul>
    </section><!-- /.l-side -->
</section>