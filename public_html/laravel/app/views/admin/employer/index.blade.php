@extends('layouts.admin', [
	'page_title' => '企業の一覧',
	'bakery_params' => [
		'admin.dashboard' => 'ホーム', 
		'*' => '企業の一覧'
	]
])

@section('content')

	<div class="clearfix">
		<div class="col-md-6 col-lg-6 no-padding">
		{{ $search_strap->filters([
			'account_id' => 'アカウントID',
			'last_name' => '企業名',
			'email' => 'メールアドレス',
			'tel' => 'TEL'
		]) }}
		</div>
		<div class="text-right" style="margin-top:9px;">
			{{ Kuku::linkRoute('admin.employer.create', 
				'企業を追加 '. Camon::GL('plus', [], false), 
				[], 
				['class' => 'btn btn-success btn-sm']) }}
		</div>
	</div>
		
	@if($employers->count() > 0)
	<table class="table table-hover table-bordered table-striped bg-white footable font-size-sm" style="margin-top:15px;">
		<thead>
			<tr class="bg-gray text-white font-size-sm">
				<th>
					<nobr>企業名&nbsp;@include('partials.html.sort_link', ['name' => 'users.last_name'])</nobr>
				</th>
                <th data-hide="phone,tablet">
                    <nobr>メールアドレス&nbsp;@include('partials.html.sort_link', ['name' => 'users.email'])</nobr>
                </th>
				<th data-hide="phone,tablet">
					<nobr>TEL&nbsp;@include('partials.html.sort_link', ['name' => 'employer_metas.tel'])</nobr>
				</th>
				<th data-hide="phone,tablet">
					<nobr>求人</nobr>
				</th>
				<th>操作</th>
<!--
				<th class="text-center">
					@include('partials.form.all_checked', ['selector' => '.delete_ids'])
				</th>
-->
			</tr>
		</thead>
		<tbody>
		@foreach($employers as $index => $employer)
			<tr>
				<td>
					<span>{{ $employer->last_name }}</span>
                    <br>（{{ $employer->account_id }}）
				</td>
                <td data-hide="phone,tablet">{{ $employer->email }}</td>
				<td data-hide="phone,tablet">{{ $employer->employer_meta->tel }}</td>
				<td data-hide="phone,tablet" class="text-center">{{ $employer->employer_jobs->count() }}件</td>
				<td class="text-right">
					<nobr>
					{{ Kuku::linkRoute('admin.employer.signin', Camon::FA('sign-in'), [$employer->id], [
						'class' => 'btn btn-default btn-flat btn-sm bubbletip',
						'title' => 'ログイン'
					]) }}
					{{ Kuku::linkRoute('admin.employer.edit', Camon::FA('pencil'), [$employer->id], [
						'class' => 'btn btn-default btn-flat btn-sm bubbletip',
						'title' => '編集'
					]) }}
					{{ Menco::get([
						'method' => 'DELETE',
						'_method' => 'DELETE',
						'label' => Camon::GL('remove'),
						'url' => route('admin.employer.destroy', [$employer->id]),
						'class' => 'btn btn-default btn-flat btn-sm bubbletip',
						'title' => '削除',
						'message' => trans('versatile.destroy_confirm')
					]) }}
					</nobr>
				</td>
<!--
				<td class="text-center vertical-middle">
					{{ Form::checkbox('delete_ids[]', $employer->id, false, ['class' => 'delete_ids']) }}
				</td>
-->
			</tr>
		@endforeach
		</tbody>
	</table>
	<div class="text-right">
<!--
		{{ Form::open(['route' => 'admin.employer.multi_delete', 'class' => 'multi_delete', 'data-selector' => '.delete_ids']) }}
			{{ FormStrap::submit('一括削除', ['class' => 'btn btn-danger btn-xs']) }}
			{{ FormStrap::hidden(['joined_delete_ids' => '']) }}
-->
		{{ Form::close() }}
	</div>
	<div class="text-right">
		{{ $employers->appends([
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
		@include('js/icheck')
		@include('js/all_checked')
		@include('js/multi_delete')
		{{ SearchStrap::js() }}
		
	});

//-->
</script>

@stop