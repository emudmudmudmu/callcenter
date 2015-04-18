@extends('layouts.admin', [
	'page_title' => 'お祝い金の申請一覧',
	'bakery_params' => [
		'admin.dashboard' => 'ホーム', 
		'*' => 'お祝い金の申請一覧'
	]
])

@section('content')

	<div class="clearfix">
		<div class="col-md-6 col-lg-6 no-padding">
		{{ $search_strap->filters([
			'shipping_name' => '名前', 
			'shipping_address' => '住所', 
			'check_flag' => 'チェック'
		])
		->dropdown('check_flag', ['0' => '未チェック', '1' => 'チェック済']) }}
		</div>
	</div>
		
	@if($gifts->count() > 0)
	<table class="table table-hover table-bordered table-striped bg-white footable font-size-sm" style="margin-top:15px;">
		<thead>
			<tr class="bg-gray text-white font-size-sm">
				<th>
					<nobr>名前</nobr>
				</th>
				<th data-hide="phone,tablet">
					<nobr>住所</nobr>
				</th>
				<th data-hide="phone,tablet">
					<nobr>求人ID</nobr>
				</th>
				<th data-hide="phone,tablet">
					<nobr>申請日時</nobr>
				</th>
				<th data-hide="phone,tablet">
					<nobr>チェック</nobr>
				</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
		@foreach($gifts as $index => $gift)
			<tr>
				<td>{{ $gift->shipping_name }}</td>
				<td>{{ $gift->shipping_address }}</td>
				<td>{{ $gift->job_id }}</td>
				<td>{{ $gift->created_at }}</td>
				<td class="text-center{{ (!$gift->check_flag) ? ' text-danger bold': '' }}">{{ $gift->check_flag_text }}</td>
				<td class="text-right">
					<nobr>
					{{ Kuku::linkRoute('admin.gift.edit', Camon::FA('pencil'), [$gift->id, 'redirect_check_flag='. Input::get('check_flag')], [
						'class' => 'btn btn-default btn-flat btn-sm bubbletip', 
						'title' => '編集'
					]) }}
					</nobr>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	<div class="text-right">
		{{ $gifts->appends([
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