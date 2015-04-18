@extends('layouts.admin', [
	'page_title' => 'スカウト', 
	'bakery_params' => [
		'employer.dashboard' => 'ホーム', 
		'*' => 'スカウト'
	]
])

@section('content')

	<div class="headline" style="margin-top:15px;">スカウト</div>
	
	{{ Form::open(['route' => ['employer.applicant.scout.post', $applicant->id]]) }}
	
	<table class="table table-hover table-striped bg-white footable font-size-sm" style="margin-top:10px;border:1px solid #ddd;">
		<tbody>
			<tr>
				<th>求職者</th>
				<td style="width:80%;">{{ $applicant->account_id }}</td>
			</tr>
			<tr>
				<th>求人情報</th>
				<td>
					@if(count($jobs) == 0)
						まだ登録されていません。
					@else
						<div class="col-md-6">
							{{ FormStrap::select('job_id', $jobs, '') }}
						</div>
					@endif
				</td>
			</tr>
			<tr>
				<td colspan="2">
					{{ FormStrap::submit('送信') }}
				</td>
			</tr>
		</tbody>
	</table>
	
	{{ Form::close() }}
	
@stop