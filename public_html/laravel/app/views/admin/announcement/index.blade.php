@extends('layouts.admin', [
	'page_title' => trans('versatile.title.index', ['name' => $data_name]),
	'bakery_params' => [
		'admin.dashboard' => 'ホーム', 
		'*' => trans('versatile.title.index', ['name' => $data_name])
	]
])

@section('content')

	<div style="margin-top:10px;" class="text-right">
	{{ Kuku::linkRoute('admin.'. $announcement_mode .'.announcement.create', 
		$data_name .'を追加 '. Camon::GL('plus', [], false), 
		[], 
		['class' => 'btn btn-success btn-sm']) }}
	</div>
	
	@if($announcements->count() > 0)
	<table class="table table-hover table-bordered table-striped bg-white footable font-size-sm" style="margin-top:15px;">
		<thead>
			<tr class="bg-gray text-white font-size-sm">
				<th>
					<nobr>タイトル</nobr>
				</th>
				<th data-hide="phone,tablet">登録日</th>
				<th data-hide="phone,tablet">
					<nobr>内容</nobr>
				</th>
				<th>操作</th>
				<th class="text-center">
					@include('partials.form.all_checked', ['selector' => '.delete_ids'])
				</th>
			</tr>
		</thead>
		<tbody>
		@foreach($announcements as $index => $announcement)
			<tr>
				<td data-hide="phone,tablet">{{ $announcement->title }}</td>
				<td data-hide="phone,tablet">{{ $announcement->created_at->format('Y-m-d') }}</td>
				<td data-hide="phone,tablet">{{ mb_strimwidth($announcement->description, 0, 50, '..') }}</td>
				<td class="text-right">
					<nobr>
						{{ Kuku::linkRoute('admin.'. $announcement_mode .'.announcement.edit', Camon::FA('pencil'), [$announcement->id], [
							'class' => 'btn btn-default btn-flat btn-sm bubbletip', 
							'title' => '編集'
						]) }}
						{{ Menco::get([
							'method' => 'DELETE',
							'_method' => 'DELETE',
							'label' => Camon::GL('remove'), 
							'url' => route('admin.'. $announcement_mode .'.announcement.destroy', [$announcement->id]), 
							'class' => 'btn btn-default btn-flat btn-sm bubbletip', 
							'title' => '削除',
							'message' => trans('versatile.destroy_confirm')
						]) }}
					</nobr>
					
				</td>
				<td class="text-center vertical-middle">
					{{ Form::checkbox('delete_ids[]', $announcement->id, false, ['class' => 'delete_ids']) }}
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	<div class="text-right">
		{{ Form::open(['route' => 'admin.'. $announcement_mode .'.announcement.multi_delete', 'class' => 'multi_delete', 'data-selector' => '.delete_ids']) }}
			{{ FormStrap::submit('一括削除', ['class' => 'btn btn-danger btn-xs']) }}
			{{ FormStrap::hidden(['joined_delete_ids' => '']) }}
		{{ Form::close() }}
	</div>
	<div class="text-right">
		{{ $announcements->appends([
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