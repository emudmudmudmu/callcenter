@extends('layouts.admin', [
	'page_title' => trans('versatile.title.index', ['name' => $data_name]),
	'bakery_params' => [
		'employer.dashboard' => 'ホーム', 
		'*' => trans('versatile.title.index', ['name' => $data_name])
	]
])

@section('content')

	<div class="clearfix">
		<div class="col-md-offset-6 col-lg-offset-6 col-md-6 col-lg-6 no-padding">
		{{ $search_strap->filters([
			'account_id' => 'アカウントID', 
			'name' => '名前', 
			'prefecture_id' => '都道府県', 
		])
		->dropdown('prefecture_id', JapanesePrefectures::prefectures()) }}
		</div>
		（※検索はHTML適用時に作成）
	</div>
		
	@if($applicants->count() > 0)
	<table class="table table-hover table-bordered bg-white footable font-size-sm" style="margin-top:15px;">
		<thead>
			<tr class="bg-info">
				<th>
					<nobr>アカウントID&nbsp;@include('partials.html.sort_link', ['name' => 'id'])</nobr>
				</th>
				<th data-hide="phone,tablet">
					<nobr>性別</nobr>
				</th>
				<th data-hide="phone,tablet">
					<nobr>年齢</nobr>
				</th>
				<th data-hide="phone,tablet">
					<nobr>現住所</nobr>
				</th>
				<th data-hide="phone,tablet">
					<nobr>希望職種</nobr>
				</th>
				<th data-hide="phone,tablet">
					<nobr>希望雇用形態</nobr>
				</th>
				<th>操作</th>
			</tr>
		</thead>
		@foreach($applicants as $index => $applicant)
		<tbody>
			<tr>
				<td>{{ $applicant->account_id }}</td>
				<td data-hide="phone,tablet">{{ $applicant->applicant_meta->gender_text }}</td>
				<td data-hide="phone,tablet">{{ $applicant->applicant_meta->age_text }}</td>
				<td data-hide="phone,tablet">{{ $applicant->applicant_meta->address->prefecture_name }}</td>
				<td data-hide="phone,tablet">
					{{ (isset($applicant_job_categories[$applicant->id])) ? implode('、', $applicant_job_categories[$applicant->id]['category_names']) : '' }}
				</td>
				<td data-hide="phone,tablet">
					{{ (isset($applicant_job_types[$applicant->id])) ? implode('、', $applicant_job_types[$applicant->id]['type_names']) : '' }}
				</td>
				<td class="text-right">
					<nobr>
					{{ Kuku::linkRoute('employer.applicant.scout', Camon::FA('envelope-o'), [$applicant->id], ['class' => 'btn btn-default btn-sm']) }}
					{{ Kuku::linkRoute('employer.applicant.show', Camon::GL('search'), [$applicant->id], ['class' => 'btn btn-default btn-sm']) }}
					</nobr>
				</td>
			</tr>
		</tbody>
		@endforeach
	</table>
	<div class="text-right">
		{{ $applicants->appends([
			'orderby' => Input::get('orderby'), 
			'direction' => Input::get('direction')
		])->links() }}
	</div>
	@endif
	
@stop

@section('script')

<script type="text/javascript">
<!--

	$(document).ready(function(e){

		@include('js/footable')
		@include('js/sortable')
		@include('js/icheck')
		@include('js/all_checked')
		@include('js/multi_delete')
		{{ SearchStrap::js() }}
		
	});

//-->
</script>

@stop