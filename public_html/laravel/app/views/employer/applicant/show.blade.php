@extends('layouts.admin', [
	'page_title' => $applicant->account_id .' | '. $applicant->prefecture_name .'の求職者',
	'bakery_params' => [
		'employer.dashboard' => 'ホーム', 
		'employer.applicant.index' => '求職者の一覧', 
		'*' => '求職者の詳細'
	]
])

@section('content')

	<div class="text-right" style="margin-top:5px;">
		{{ HTML::linkRoute('employer.applicant.index', '&lt; 求職者の一覧', [], ['class' => 'btn btn-default btn-sm']) }}
		{{ HTML::linkRoute('employer.applicant.scout', 'スカウト', [$applicant->id], ['class' => 'btn btn-default btn-sm']) }}
		{{ Menco::get([
			'method' => 'POST', 
			'label' => ($employer_consideration_flag) ? '検討中リストから解除する' : '検討中リストに追加する', 
			'url' => route('employer.applicant.consideration.post', []), 
			'class' => ($employer_consideration_flag) ? 'btn btn-sm btn-info' : 'btn btn-sm btn-primary', 
			'message' => ($employer_consideration_flag) ? 'リストから外しますか？' : 'リストに追加しますか？'
		], [
			'applicant_id' => $applicant->id,
			'flag' => ($employer_consideration_flag) ? 0 : 1
		]) }}
	
	</div>
	<div class="headline" style="margin-top:15px;">求職者の詳細</div>
	<table class="table table-hover table-striped bg-white footable font-size-sm" style="margin-top:10px;border:1px solid #ddd;">
		<tbody>
			<tr>
				<th>年齢</th>
				<td style="width:80%;">{{ $applicant->applicant_meta->age_text }}</td>
			</tr>
			<tr>
				<th>性別</th>
				<td>{{ $applicant->applicant_meta->gender_text }}</td>
			</tr>
				<th>現住の職業</th>
				<td>{{ $applicant->applicant_meta->current_job }}</td>
			</tr>
				<th>保有資格</th>
				<td>{{ $applicant->applicant_meta->qualification }}</td>
			</tr>
				<th>職務経歴</th>
				<td>{{ $applicant->applicant_meta->career }}</td>
			</tr>
				<th>希望職種</th>
				<td>{{ implode('、', $job_category_names) }}</td>
			</tr>
			</tr>
				<th>希望雇用形態</th>
				<td>{{ implode('、', $job_type_names) }}</td>
			</tr>
			</tr>
				<th>希望勤務地</th>
				<td>
					@if($applicant_job_locations->count() > 0)
						@foreach($applicant_job_locations as $applicant_job_location)
							{{ $applicant_job_location->address->prefecture_name }}{{ $applicant_job_location->address->city_name }}
							<br>
						@endforeach
					@endif
				</td>
			</tr>
			</tr>
				<th>希望給与</th>
				<td>{{ $applicant->applicant_meta->salary }}</td>
			</tr>
		</tbody>
	</table>
	
@stop