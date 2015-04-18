@extends('layouts.home', [
	'page_title' => '登録済み求人情報の一覧',
	'bakery_params' => [
		'admin.dashboard' => 'ホーム', 
		'*' => '登録済み求人情報の一覧'
	]
])

@section('content')

	@if($applications->count() > 0)

	<table class="table table-hover table-bordered bg-white footable font-size-sm" style="margin-top:15px;">
		<thead>
			<tr class="bg-info">
				<th>
					<nobr>応募日時</nobr>
				</th>
				<th data-hide="phone,tablet">
					<nobr>求人企業</nobr>
				</th>
				<th data-hide="phone,tablet">
					<nobr>求人情報</nobr>
				</th>
				<th data-hide="phone,tablet">
					<nobr>応募内容</nobr>
				</th>
			</tr>
		</thead>
		@foreach($applications as $application)
		<tbody>
			<tr>
				<td>{{ $application->created_at }}</td>
				<td>{{ $application->job->user->last_name }}（{{ AccountId::text('employer', $application->job->user->id) }}）</td>
				<td>{{ $application->job->title }}（{{ AccountId::text('job', $application->job->id) }}）</td>
				<td class="text-right">
					<nobr>
					{{ Kuku::linkRoute('applicant.application.show', Camon::GL('search'), [$application->id], ['class' => 'btn btn-default btn-sm']) }}
					</nobr>
				</td>
			</tr>
		</tbody>
		@endforeach
	</table>
	<div class="text-right">
		{{ $applications->appends([
			'orderby' => Input::get('orderby'), 
			'direction' => Input::get('direction')
		])->links() }}
	</div>
	@endif
	
@stop