@extends('layouts.home', [
	'page_title' => 'お仕事を探す'
])

@section('content')

    <section class="l-contents cf">
        <section class="l-main">
            <h2>{{ HTML::image('home/assets/img/top/jobsearch.png', 'お仕事を探す', ['width' => '750', 'height' => '95']) }}</h2>
            <br>
            @include('partials.html.search_box')<!-- /.search-box -->
            <section class="pagenav">
                <p>全<strong>{{ $jobs->getTotal() }}</strong>件（{{ $jobs->getFrom() }}～{{ $jobs->getTo() }}件を表示）</p>
                @include('partials.html.job_paging', [
                    'appends' => ['prefecture_id']
                ])
            </section>

            @if(!empty($jobs))
                @foreach($jobs as $index => $job)
                    <div class="keeplist">
                        <div class="listbox">
                            <h3 class="txt-small">
                                @if(Job::isNew($job->updated_at))
                                    <img src="{{ url('home/assets/img/search/ic_new.png') }}" width="60" height="24" alt="NEW" class="new-ic">
                                @endif{{ $job->title }}
                            </h3>
                            <div class="company-name">
                                <table class="work-num">
                                    <tr>
                                        <th>{{ HTML::image('home/assets/img/search/ic_apply_company.png', '応募先', ['width' => '72', 'height' => '24']) }}</th>
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
                            @include('partials/html/job_conditions', [
                                'condition_ids' => $job->meta_values['condition_ids']
                            ])
                            <dl class="intro">
<!--
                                <dt>{{ $job->catch_phrase }}</dt>
                                <dd>{{ $job->catch_text }}</dd>
-->
                            </dl>
                            <div class="details">
                                <p class="photo">
                                    @if(!empty($job->meta_values['main_company_image_file_ids']))
                                        {{ HTML::image($image_urls['main_companies'][$job->meta_values['main_company_image_file_ids'][0]], $job->title, ['style' => 'width:278px;height:185px;']) }}
                                    @endif
                                </p>
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
                                        <td>{{ $job->description }}</td>
                                    </tr>
                                    <tr>
                                        <th>勤務地</th>
                                        <td>{{ JapanesePrefectures::prefectureName($job->prefecture_id) }}{{ \Address::filterCityId($job->other_address)->first()->city_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>アクセス</th>
                                        <td>{{ $job->transportation }}</td>
                                    </tr>
                                    <tr>
                                        <th>給与</th>
                                        <td>{{ $job->salary }}</td>
                                    </tr>
                                </table>
                            </div>
                            <ul class="btns">
                                <li class="detail"><a href="{{ route('home.job_detail', [$job->id]) }}">{{ HTML::image('home/assets/img/search/btn_more.png', '求人詳細を見る', ['width' => '224', 'height' => '60']) }}</a></li>
                                <li class="apply"><a href="{{ route('home.application', [$job->id]) }}">{{ HTML::image('home/assets/img/search/btn_apply.png', '今すぐ応募する', ['width' => '224', 'height' => '60']) }}</a></li>
                                <li class="add">
                                    {{ Menco::get([
                                        'method' => 'POST',
                                        'label' => '<img src="'. url('home/assets/img/search/btn_addlist.png') .'" width="153" height="40">',
                                        'url' => route('applicant.consideration.post'),
                                        'class' => '',
                                        'message' => 'リストに追加しますか？'
                                    ], [
                                        'job_id' => $job->id,
                                        'flag' => 1
                                    ]) }}
                                </li>
                            </ul>

                        </div><!-- /.listbox -->
                    </div>
                @endforeach
            @endif
        </section><!-- /.l-main -->

@stop