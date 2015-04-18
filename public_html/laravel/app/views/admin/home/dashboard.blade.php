@extends('layouts.admin', [
	'page_title' => '管理者トップ',
	'bakery_params' => [
		'*' => 'ホーム'
	]
])

@section('content')
	
	<div class="clearfix" style="margin-top:10px;margin-bottom:0;color:#999;">
		<div class="col-md-4 padding-xs">
			<!-- Primary box -->
			<div class="box box-solid box-primary match-height" style="margin-bottom:15px;">
				<div class="box-header">
					<h3 class="box-title">{{ Camon::GL('briefcase') }}求人情報</h3>
				</div>
				<div class="box-body">
                    └ {{ HTML::linkRoute('admin.job.index', '求人の一覧') }}<br>
                    └ {{ HTML::linkRoute('admin.recommendation', 'おすすめの設定') }}<br>
                    └ {{ HTML::linkRoute('admin.application.index', '応募の一覧') }}

				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
		<div class="col-md-4 padding-xs">
			<!-- Primary box -->
			<div class="box box-solid box-primary match-height" style="margin-bottom:15px;">
				<div class="box-header">
					<h3 class="box-title">{{ Camon::GL('user') }}ユーザー</h3>
				</div>
				<div class="box-body">
					└ {{ HTML::linkRoute('admin.employer.index', '企業の一覧') }}&nbsp;（{{ HTML::linkRoute('admin.employer.create', '追加') }}）<br>
					└ {{ HTML::linkRoute('admin.applicant.index', '求職者の一覧') }}
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
		<div class="col-md-4 padding-xs">
			<!-- Primary box -->
			<div class="box box-solid box-primary match-height" style="margin-bottom:15px;">
				<div class="box-header">
					<h3 class="box-title">{{ Camon::GL('bullhorn') }}告知</h3>
				</div>
				<div class="box-body">
					└ {{ HTML::linkRoute('admin.all.announcement.index', 'サイト告知の一覧') }}&nbsp;（{{ HTML::linkRoute('admin.all.announcement.create', '追加') }}）<br>
					└ {{ HTML::linkRoute('admin.employer.announcement.index', '企業告知の一覧') }}（{{ HTML::linkRoute('admin.employer.announcement.create', '追加') }}）
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
		<div class="col-md-4 padding-xs">
			<!-- Primary box -->
			<div class="box box-solid box-primary match-height" style="margin-bottom:15px;">
				<div class="box-header">
					<h3 class="box-title">{{ Camon::FA('gift') }}お祝い金</h3>
				</div>
				<div class="box-body">
					└ {{ HTML::linkRoute('admin.gift.index', '申請の一覧') }}（{{ HTML::linkRoute('admin.gift.index', '未チェックのみ', ['check_flag' => '0']) }}）
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div>
	<div class="padding-xs">
		<table class="table table-hover table-bordered table-striped bg-white footable font-size-sm" style="margin-top:5px;">
			<tbody>
				<tr>
					<td colspan="2" class="bold bg-gray text-white">ユーザー情報</td>
				</tr>
				<tr>
					<td><nobr>企業ユーザー</nobr></td>
					<td style="width:73%;">{{ HTML::linkRoute('admin.employer.index', (isset($user_counts[2])) ? $user_counts[2] : 0 .'人') }}</td>
				</tr>
				<tr>
					<td><nobr>求職者ユーザー</nobr></td>
					<td>{{ HTML::linkRoute('admin.applicant.index', (isset($user_counts[3]) ? $user_counts[3] : 0) .'人') }}</td>
				</tr>
			</tbody>
		</table>
		
		<table class="table table-hover table-bordered table-striped bg-white footable font-size-sm" style="margin-top:5px;">
			<tbody>
				<tr>
					<td colspan="2" class="bold bg-gray text-white">求人情報</td>
				</tr>
				<tr>
					<td><nobr>審査待ち</nobr></td>
					<td style="width:73%;">
						@if(isset($job_counts[0]))
							<a href="{{ route('admin.job.index', ['activated=0']) }}">{{ (isset($job_counts[0]) ? $job_counts[0] : 0) }}件</a>
						@else
							0件
						@endif
					</td>
				</tr>
				<tr>
					<td><nobr>承認済み</nobr></td>
					<td>
						@if(isset($job_counts[1]))
							<a href="{{ route('admin.job.index', ['activated=1']) }}">{{ (isset($job_counts[1])) ? $job_counts[1] : 0 }}件</a>
						@else
							0件
						@endif
					</td>
				</tr>
			</tbody>
		</table>
		
		<table class="table table-hover table-bordered table-striped bg-white footable font-size-sm" style="margin-top:5px;">
			<tbody>
				<tr>
					<td colspan="2" class="bold bg-gray text-white">応募情報</td>
				</tr>
				<tr>
					<td><nobr>応募総数</nobr></td>
					<td style="width:73%;">
						<a href="{{ route('admin.application.index') }}">{{ (isset($applications)) ? $applications->count() : 0 }}件</a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	
@stop

@section('script')

	<script type="text/javascript">
	$(document).ready(function(){
	
		@include('js/match_height')
		
	});
	</script>

@stop