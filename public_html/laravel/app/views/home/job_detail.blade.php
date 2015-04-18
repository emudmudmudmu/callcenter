@extends('layouts.home', [
	'page_title' => $job->title
])

@section('content')

    <section class="l-contents cf">
        <section class="l-main">
            <div class="company-details">
                <!--
                <p class="pankuz">TOP&nbsp;&gt;&nbsp;<a href="#">○○○</a>&nbsp;&gt;&nbsp;<a href="#">○○○</a>&nbsp;&gt;&nbsp;<a href="#">○○○</a></p>
                -->
                <div class="listbox">
                    @if($job->displayed == 0 && !isset($preview_flag))
                        <div class="text-danger" style="padding: 0 15px;">この求人は非掲載に設定されています。</div>
                    @elseif($job->application_ceiling > 0 && $job->application_ceiling <= $job->application_count && !isset($preview_flag))
                        <div class="text-danger" style="padding: 0 15px;">この求人は応募上限に達しています。</div>
                    @elseif(!empty($job->released) && $job->released->isPast() && !isset($preview_flag))
                        <div class="text-danger" style="padding: 0 15px;">この求人は有効期限が切れています。</div>
                    @else
                        <div class="namearea">
                            <h2>{{ $job->title }}</h2>
                            <div class="company-name">
                                <table class="work-num">
                                    <tr>
                                        <th>
                                            {{ HTML::image('home/assets/img/search/ic_apply_company.png', '応募先', ['width' => '72', 'height' => '24']) }}
                                        </th>
                                        <td class="companyname">{{ $job->user->last_name }}</td>
                                        <th>{{ HTML::image('home/assets/img/search/ic_number.png', '仕事番号', ['width' => '72', 'height' => '24']) }}</th>
                                        <td class="number">{{ AccountId::text('job', $job->id) }}</td>
                                    </tr>
                                </table>
                                @include('partials/html/job_types', [
                                    'type_ids' => $job->meta_values['type_ids']
                                ])
                                <p class="quo-bnr"><a href="{{ route('home.quo') }}">{{ HTML::image('home/assets/img/search/bnr_quocard.png', '面接で全員QUOカード', ['width' => '165', 'height' => '35']) }}</a></p>
                            </div><!-- /.company-name -->
                        </div>
                        @include('partials/html/job_conditions', [
                            'condition_ids' => $job->meta_values['condition_ids']
                        ])
                        <div class="details">
                            <div class="details-head">
                                <div class="photos">
                                    <div id="photo" class="photo"><img src="{{ $image_urls['main_companies'][$job->meta_values['main_company_image_file_ids'][0]] }}" alt="{{ $job->title }}" style="width:341px;height:226px;"></div>
                                    <div id="thum-navi">
                                        <ul>
                                            <li><a href="{{ $image_urls['main_companies'][$job->meta_values['main_company_image_file_ids'][0]] }}"><img src="{{ $image_urls['main_companies'][$job->meta_values['main_company_image_file_ids'][0]] }}" style="width:98px;height:65px;" alt=""></a></li>
                                            @foreach($image_urls['sub_companies'] as $image_url)
                                                <li><a href="{{ $image_url }}"><img src="{{ $image_url }}" style="width:98px;height:65px;" alt=""></a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div><!-- /.photos -->
                                <dl class="intro">
                                    <dt>{{ $job->catch_phrase }}</dt>
                                    <dd>{{ nl2br($job->catch_text) }}</dd>
                                </dl>
                            </div><!-- /.details-head -->
                            <div class="details-inner">
                                <h4>{{ HTML::image('home/assets/img/search/subhead_requirements.png', '募集要項', ['width' => '101', 'height' => '19']) }}</h4>
                                <table class="data-table">
<!--
                                    <tr>
                                        <th>募集職種</th>
                                        <td>
                                            @include('partials/html/job_categories', [
                                                'category_ids' => $job->meta_values['category_ids']
                                            ])
                                        </td>
                                    </tr>
-->
                                    <tr>
                                        <th>仕事内容</th>
                                        <td>{{ nl2br($job->description) }}</td>
                                    </tr>
<!--
                                    <tr>
                                        <th>雇用形態</th>
                                        <td>{{ $job->job_pattern }}</td>
                                    </tr>
-->
                                    <tr>
                                        <th>勤務地</th>
                                        <td>{{ JapanesePrefectures::prefectureName($job->prefecture_id) }}{{ nl2br(\Address::filterCityId($job->other_address)->first()->city_name) }}</td>
                                    </tr>
                                    <tr>
                                        <th>アクセス</th>
                                        <td>{{ nl2br($job->transportation) }}</td>
                                    </tr>
                                    <tr>
                                        <th>勤務時間帯</th>
                                        <td>{{ nl2br($job->duty_hours) }}</td>
                                    </tr>
                                    <tr>
                                        <th>給与</th>
                                        <td>{{ nl2br($job->salary) }}</td>
                                    </tr>
                                    <tr>
                                        <th>休日休暇</th>
                                        <td>{{ nl2br($job->holiday) }}</td>
                                    </tr>
                                    @if(!empty($job->capacity))
                                    <tr>
                                        <th>応募資格</th>
                                        <td>{{ nl2br($job->capacity) }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th>福利厚生</th>
                                        <td>{{ nl2br($job->benefit) }}</td>
                                    </tr>
                                </table>
                                <div class="applybox">
                                    <h5>{{ HTML::image('home/assets/img/search/subhead_apply.png', '応募はこちらへ', ['width' => '690', 'height' => '60']) }}</h5>
                                    <div class="clm-l">
                                        <table>
                                            <tr>
                                                <th>{{ HTML::image('home/assets/img/search/ic_apply_company.png', '応募先', ['width' => '72', 'height' => '24']) }}</th>
                                                <td class="companyname">{{ $job->user->last_name }}</td>
                                                <th>{{ HTML::image('home/assets/img/search/ic_number.png', '仕事番号', ['width' => '72', 'height' => '24']) }}</th>
                                                <td class="number">{{ AccountId::text('job', $job->id) }}</td>
                                            </tr>
                                        </table>
                                        <p>{{ HTML::image('home/assets/img/search/bnr_apply_tel.png', '応募ダイヤル　050-2222-3333', ['width' => '399', 'height' => '59']) }}</p>
                                        <p class="note">※土日祝はTEL応募を受付しておりません。<br>「コールセンターの窓口を見た」とお伝えください。</p>
                                    </div>
                                    <div class="clm-r">
                                        <p>
                                            @if(!isset($preview_flag))
                                            <a href="{{ route('home.application', [$job->id]) }}">
                                            @endif
                                                {{ HTML::image('home/assets/img/search/btn_apply2.png', '今すぐ応募する', ['width' => '224', 'height' => '60']) }}
                                            @if(!isset($preview_flag))
                                            </a>
                                            @endif
                                        </p>
                                        <p>
                                            @if(!isset($preview_flag))
                                            {{ Menco::get([
                                                'method' => 'POST',
                                                'label' => '<img src="'. url('home/assets/img/search/btn_addlist_s.png') .'" width="130" height="34">',
                                                'url' => route('applicant.consideration.post'),
                                                'class' => '',
                                                'message' => 'リストに追加しますか？'
                                            ], [
                                                'job_id' => $job->id,
                                                'flag' => 1
                                            ]) }}
                                            @else
                                                {{ HTML::image('home/assets/img/search/btn_addlist_s.png') }}
                                            @endif
                                        </p>
                                    </div>
                                </div><!-- /.applybox -->
                                @if(!empty($job->pic_comment))
                                <!-- 採用担当者のコメント -->
                                <h4>{{ HTML::image('home/assets/img/search/subhead_comment.png', '採用担当者のコメント', ['width' => '200', 'height' => '18']) }}</h4>
                                <div class="comment">
                                    <p class="person">
                                            @if(isset($image_urls['pics'][$job->meta_values['pic_image_file_ids'][0]]))
                                            {{ HTML::image($image_urls['pics'][$job->meta_values['pic_image_file_ids'][0]], '担当者写真', ['width' => '186', 'height' => '118']) }}
                                            @else
                                                {{ HTML::image('img/No_image_available.png', '担当者写真', ['width' => '186', 'height' => '118']) }}
                                            @endif
                                        <br>
                                        {{ $job->pic_department }}<br>{{ $job->pic_name }}
                                    </p>
                                    <div class="commentbox">
                                        <p>{{ nl2br($job->pic_comment) }}</p>
                                    </div>
                                </div><!-- /.comment -->
                                @endif
                                <!-- 会社概要 -->
                                <h4>{{ HTML::image('home/assets/img/search/subhead_company_profile.png', '会社概要', ['width' => '103', 'height' => '18']) }}</h4>
                                <table class="data-table">
                                    <tr>
                                        <th>企業名</th>
                                        <td>{{ $job->user->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>代表者</th>
                                        <td>{{ $job->user->employer_meta->representative }}</td>
                                    </tr>
                                    <tr>
                                        <th>資本金</th>
                                        <td>{{ number_format($job->user->employer_meta->capital_stock) }}円</td>
                                    </tr>
                                    <tr>
                                        <th>従業員数</th>
                                        <td>{{ number_format($job->user->employer_meta->employees) }}人</td>
                                    </tr>
                                    <tr>
                                        <th>事業内容</th>
                                        <td>{{ nl2br($job->user->employer_meta->business_content) }}</td>
                                    </tr>
                                </table>
                                <!-- 応募・選考について -->
                                <h4>{{ HTML::image('home/assets/img/search/subhead_about_selection.png', '応募・選考について', ['width' => '181', 'height' => '18']) }}</h4>
                                <table class="data-table">
                                    <tr>
                                        <th>入社までの流れ</th>
                                        <td>{{ nl2br($job->choice_process) }}</td>
                                    </tr>
                                    <tr>
                                        <th>所在地・面接会場</th>
                                        <td>{{ nl2br($job->interview_address) }}</td>
                                    </tr>
                                </table>
                                <div class="applybox">
                                    <h5>{{ HTML::image('home/assets/img/search/subhead_apply.png', '応募はこちらへ', ['width' => '690', 'height' => '60']) }}</h5>
                                    <div class="clm-l">
                                        <table>
                                            <tr>
                                                <th>{{ HTML::image('home/assets/img/search/ic_apply_company.png', '応募先', ['width' => '72', 'height' => '24']) }}</th>
                                                <td class="companyname">{{ $job->user->last_name }}</td>
                                                <th>{{ HTML::image('home/assets/img/search/ic_number.png', '仕事番号', ['width' => '72', 'height' => '24']) }}</th>
                                                <td class="number">{{ AccountId::text('job', $job->id) }}</td>
                                            </tr>
                                        </table>
                                        <p>{{ HTML::image('home/assets/img/search/bnr_apply_tel.png', '応募ダイヤル　050-2222-3333', ['width' => '399', 'height' => '59']) }}</p>
                                        <p class="note">※土日祝はTEL応募を受付しておりません。<br>「コールセンターの窓口を見た」とお伝えください。</p>
                                    </div>
                                    <div class="clm-r">
                                        <p>
                                            @if(!isset($preview_flag))
                                            <a href="{{ route('home.application', [$job->id]) }}">
                                            @endif
                                                {{ HTML::image('home/assets/img/search/btn_apply2.png', '今すぐ応募する', ['width' => '224', 'height' => '60']) }}
                                            @if(!isset($preview_flag))
                                            </a>
                                            @endif
                                        </p>
                                        <p>
                                            @if(!isset($preview_flag))
                                            {{ Menco::get([
                                                'method' => 'POST',
                                                'label' => '<img src="'. url('home/assets/img/search/btn_addlist_s.png') .'" width="130" height="34">',
                                                'url' => route('applicant.consideration.post'),
                                                'class' => '',
                                                'message' => 'リストに追加しますか？'
                                            ], [
                                                'job_id' => $job->id,
                                                'flag' => 1
                                            ]) }}
                                            @else
                                                {{ HTML::image('home/assets/img/search/btn_addlist_s.png') }}
                                            @endif
                                        </p>
                                    </div>
                                </div><!-- /.applybox -->
                            </div>
                            <!-- /.details-inner -->

                        </div>
                        <ul class="btns">
                            <li class="apply"><a href="{{ route('home.application', [$job->id]) }}">{{ HTML::image('home/assets/img/search/btn_apply2.png', '今すぐ応募する', ['width' => '224', 'height' => '60']) }}</a></li>
                            <li class="add">
                                {{ Menco::get([
                                    'method' => 'POST',
                                    'label' => '<img src="'. url('home/assets/img/search/btn_addlist_s.png') .'" width="130" height="34">',
                                    'url' => route('applicant.consideration.post'),
                                    'class' => '',
                                    'message' => 'リストに追加しますか？'
                                ], [
                                    'job_id' => $job->id,
                                    'flag' => 1
                                ]) }}
                            </li>
                        </ul>
                    @endif
                </div><!-- /.listbox -->
            </div>
        </section><!-- /.l-main -->

@stop

@section('script')

    <script src="/home/assets/js/company_gallery.js">

@stop