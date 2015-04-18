@extends('layouts.employer', [
	'page_title' => '企業様ホーム',
	'bakery_params' => [
		'*' => 'ホーム'
	]
])

@section('content')
    
    <div id="main">
        <div class="container">
          <div class="row row-offcanvas row-offcanvas-right">

            <div class="col-xs-12 col-sm-9">
              <div class="index-head">
                <div class="row">
                    <div class="col-md-4">
                        <ul class="list-unstyled">
                        <li class="title"><span class="glyphicon glyphicon-user"></span><img src="./images/title_top01.png" alt="求人情報" /></li>
                        <li class="menu"><a href="{{ route('employer.job.create') }}">求人情報の登録</a></li>
                        <li class="menu_last"><a href="{{ route('employer.job.index') }}">登録済み求人情報の一覧</a></li>
                    </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-unstyled">
                            <li class="title"><span class="glyphicon glyphicon-pencil"></span><img src="./images/title_top02.png" alt="応募情報" /></li>
                            <li class="menu_last"><a href="{{ route('employer.application.index') }}">応募情報の一覧</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-unstyled">
                        <li class="title"><span class="glyphicon glyphicon-home"></span><img src="./images/title_top03.png" alt="登録情報" /></li>
                        <li class="menu"><a href="{{ route('employer.settings') }}">企業情報の変更</a></li>
                        <li class="menu_last"><a href="{{ route('employer.delete_account') }}">サービスの解約・退会</a></li>
                    </ul>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title"><span class="glyphicon glyphicon-user"></span><img src="./images/h2_top01.png" alt="求人情報" /></h2>
                    <table class="table table-list">
                        <tr>
                            <th>総登録数</th>
                            <th>掲載中</th>
                            <th>管理者承認待ち</th>
                            <th>応募上限済</th>
                            <th>掲載期限切れ</th>
                        </tr>
                        <tr>
                            <td>{{ HTML::linkRoute('employer.job.index', $job_counts['count'] .'件') }}</td>
                            <td>{{ HTML::linkRoute('employer.job.index', $job_counts['activated'] .'件', ['activated' => 1]) }}</td>
                            <td>{{ HTML::linkRoute('employer.job.index', $job_counts['unactivated'] .'件', ['unactivated' => 1]) }}</td>
                            <td>{{ HTML::linkRoute('employer.job.index', $job_counts['fulfilled'] .'件', ['invalid' => 1]) }}</td>
                            <td>{{ HTML::linkRoute('employer.job.index', $job_counts['expired'] .'件', ['expired' => 1]) }}</td>
                        </tr>
                    </table>
                    <p class="more-list-link col-xs-12"><a href="{{ route('employer.job.create') }}"><span class="glyphicon glyphicon-play-circle"></span>求人情報の登録</a> / <a href="{{ route('employer.job.index') }}"><span class="glyphicon glyphicon-play-circle"></span>登録済み求人情報の一覧</a></p>
                  </div>
              </div><!--/row-->

              <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title"><span class="glyphicon glyphicon-pencil"></span><img src="./images/h2_top02.png" alt="応募情報" /></h2>
                    <table class="table table-list">
                        <tr>
                            <th>総応募数</th>
                            @foreach(ApplicationStatus::application_statuses() as $status)
                            <th>{{ $status }}</th>
                            @endforeach
                        </tr>
                        <tr>
                            <td>{{ HTML::linkRoute('employer.application.index', $application_counts['count'] .'件') }}</td>
                            @foreach(ApplicationStatus::application_statuses() as $status_id => $status)
                            <td>{{ HTML::linkRoute('employer.application.index', $application_counts[$status_id] .'件', ['status_ids%5B%5D='. $status_id]) }}</td>
                            @endforeach
                        </tr>
                    </table>
                    <p class="more-list-link col-xs-12"><a href="{{ route('employer.application.index') }}"><span class="glyphicon glyphicon-play-circle"></span>応募情報の一覧</a></p>
                  </div>
              </div><!--/row-->
              <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title"><span class="glyphicon glyphicon-list-alt"></span><img src="./images/h2_top03.png" alt="応募課金集計表" /></h2>
                    <table class="table table-list">
                        <tr>
                            <th>課金内容</th>
                            <th>今月</th>
                            <th>先月</th>
                            <th>累計</th>
                        </tr>
                        <tr>
                            <td>応募課金</td>
                            <td>{{ HTML::linkRoute('employer.billing', number_format($billing_counts[1]) .'円', ['billing_year='. date('Y') .'&billing_month='. date('n')]) }}</td>
                            <td>{{ HTML::linkRoute('employer.billing', number_format($billing_counts[2]) .'円', ['billing_year='. $dt->format('Y') .'&billing_month='. $dt->format('n')]) }}</td>
                            <td>{{ HTML::linkRoute('employer.billing', number_format($billing_counts[0]) .'円') }}</td>
                        </tr>
                    </table>
                    <p class="more-list-link col-xs-12"><a href="{{ route('employer.billing') }}"><span class="glyphicon glyphicon-play-circle"></span>課金情報の一覧</a></p>
                  </div>
              </div><!--/row-->          
            </div><!--/.col-xs-12.col-sm-9-->

            <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
                <div class="side-banner">
                <a href="{{ route('employer.contact') }}" class="btn btn-primary btn-side-contact"><span class="glyphicon glyphicon-envelope"></span><img src="./images/btn_contact.png" alt="管理会社へのお問い合わせ" /></a>
                </div>
                <div class="list-group side-news">
                  <p class="side-news-title list-group-item"><img src="./images/title_top04.png" alt="コールセンターの窓口からのお知らせ" /></p>
                  @if($new_announcements->count() > 0)
              	    @foreach($new_announcements as $new_announcement)
              	      <p class="list-group-item"><span>{{ $new_announcement->created_at->format('Y/m/d') }}</span>{{ HTML::linkRoute('employer.announcement.detail', $new_announcement->title, [$new_announcement->id]) }}</p>
              	    @endforeach
                  @endif
                  <p class="text-right more-list-link"><a href="{{ route('employer.announcement.index') }}"><span class="glyphicon glyphicon-play-circle"></span>お知らせ一覧</a></p>
                </div>
            </div><!--/.sidebar-offcanvas-->
          </div><!--/row-->
        </div>
    </div>
    
@stop