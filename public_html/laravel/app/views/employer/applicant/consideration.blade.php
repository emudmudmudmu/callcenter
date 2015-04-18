@extends('layouts.admin', [
	'page_title' => '検討中リスト',
	'bakery_params' => [
		'employer.dashboard' => 'ホーム', 
		'*' => '検討中リスト'
	]
])

@section('content')

	<table border="1">
	@foreach($considerations as $consideration)
		<tr>
			<td>
				{{ HTML::linkRoute('employer.applicant.show', $consideration->applicant->account_id, [$consideration->applicant->id]) }}
			</td>
			<td>{{ $consideration->applicant->applicant_meta->gender_text }}</td>
			<td>{{ $consideration->applicant->applicant_meta->age_text }}</td>
			<td>
				@if($consideration->applicant->applicant_job_categories->count() > 0)
					@foreach($consideration->applicant->applicant_job_categories as $job_category)
						{{ JobCategory::job_category_name($job_category->category_id) }}
					@endforeach
				@endif
			</td>
			<td>
				@if($consideration->applicant->applicant_job_types->count() > 0)
					@foreach($consideration->applicant->applicant_job_types as $job_type)
						{{ JobType::job_type_name($job_type->type_id) }}
					@endforeach
				@endif
			</td>
			<td>
				{{ Kuku::linkRoute('employer.applicant.show', Camon::GL('search'), [$consideration->applicant->id], ['class' => 'btn btn-default btn-sm']) }}
			</td>
		</tr>
	@endforeach
	</table>
	<div class="text-right">
		{{ $considerations->appends([
			'orderby' => Input::get('orderby'), 
			'direction' => Input::get('direction')
		])->links() }}
	</div>
	
@stop