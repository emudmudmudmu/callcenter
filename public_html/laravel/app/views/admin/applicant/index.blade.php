@extends('layouts.admin', [
	'page_title' => trans('versatile.title.index', ['name' => $data_name]),
	'bakery_params' => [
		'admin.dashboard' => 'ホーム', 
		'*' => trans('versatile.title.index', ['name' => $data_name])
	]
])

@section('content')

	<div class="clearfix">
		<div class="col-md-6 col-lg-6 no-padding">
		{{ $search_strap->filters([
			'account_id' => 'アカウントID',
			'last_name' => '名前',
			'email' => 'メールアドレス',
			'tel' => 'TEL'
		])
		->dropdown('prefecture_id', JapanesePrefectures::prefectures()) }}
		</div>
	</div>
		
	@if($applicants->count() > 0)
	<table class="table table-hover table-bordered table-striped bg-white footable font-size-sm" style="margin-top:15px;">
		<thead>
			<tr class="bg-gray text-white font-size-sm">
				<th>
					<nobr>名前&nbsp;@include('partials.html.sort_link', ['name' => 'users.last_name'])</nobr>
				</th>
				<th data-hide="phone,tablet">
					<nobr>メールアドレス&nbsp;@include('partials.html.sort_link', ['name' => 'users.email'])</nobr>
				</th>
				<th data-hide="phone,tablet">
					<nobr>TEL&nbsp;@include('partials.html.sort_link', ['name' => 'applicant_metas.tel'])</nobr>
				</th>
				<th>操作</th>
				<th class="text-center">
					@include('partials.form.all_checked', ['selector' => '.delete_ids'])
				</th>
			</tr>
		</thead>
		<tbody>
		@foreach($applicants as $index => $applicant)
			<tr>
				<td>
					{{ $applicant->last_name }}<br>
					（{{ $applicant->account_id }}）
				</td>
				<td data-hide="phone,tablet">
					{{ $applicant->email }}
				</td>
				<td data-hide="phone,tablet">
                    {{ $applicant->tel }}
				</td>
				<td class="text-right">
					<nobr>
					{{ Kuku::linkRoute('admin.applicant.signin', Camon::FA('sign-in'), [$applicant->id], [
						'class' => 'btn btn-default btn-flat btn-sm bubbletip', 
						'title' => 'ログイン'
					]) }}
					{{ Kuku::linkRoute('admin.applicant.edit', Camon::FA('pencil'), [$applicant->id], [
						'class' => 'btn btn-default btn-flat btn-sm bubbletip', 
						'title' => '編集'
					]) }}
					{{ Menco::get([
						'method' => 'DELETE',
						'_method' => 'DELETE',
						'label' => Camon::GL('remove'), 
						'url' => route('admin.applicant.destroy', [$applicant->id]), 
						'class' => 'btn btn-default btn-flat btn-sm bubbletip', 
						'title' => '削除', 
						'message' => trans('versatile.destroy_confirm')
					]) }}
					</nobr>
				</td>
				<td class="text-center vertical-middle">
					{{ Form::checkbox('delete_ids[]', $applicant->id, false, ['class' => 'delete_ids']) }}
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	<div class="text-right">
		{{ Form::open(['route' => 'admin.applicant.multi_delete', 'class' => 'multi_delete', 'data-selector' => '.delete_ids']) }}
			{{ FormStrap::submit('一括削除', ['class' => 'btn btn-danger btn-xs']) }}
			{{ FormStrap::hidden(['joined_delete_ids' => '']) }}
		{{ Form::close() }}
	</div>
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