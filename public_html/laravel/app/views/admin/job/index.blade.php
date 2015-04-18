@extends('layouts.admin', [
	'page_title' => '登録済み求人情報の一覧',
	'bakery_params' => [
		'admin.dashboard' => 'ホーム', 
		'*' => '登録済み求人情報の一覧'
	]
])

@section('content')

	<div class="clearfix">
		<div class="col-md-6 col-lg-6 no-padding">
		{{ $search_strap->filters([
			'account_id' => '求職ID',
			'title' => 'タイトル',
			'activated' => '状態'
		])
		->dropdown('activated', ['1' => '公開中', '0' => '承認済み']) }}
		</div>
	</div>
		
	@if($jobs->count() > 0)
	<table class="table table-hover table-bordered table-striped bg-white footable font-size-sm" style="margin-top:15px;">
		<thead>
			<tr class="bg-gray text-white font-size-sm">
				<th>
					<nobr>タイトル&nbsp;@include('partials.html.sort_link', ['name' => 'title'])</nobr>
				</th>
				<th data-hide="phone,tablet">
					<nobr>登録日&nbsp;@include('partials.html.sort_link', ['name' => 'created_at'])</nobr>
				</th>
				<th data-hide="phone,tablet">
					<nobr>状態</nobr>
				</th>
                <th data-hide="phone,tablet">
                    <nobr>掲載</nobr>
                </th>
				<th>操作</th>
				<th class="text-center">
					@include('partials.form.all_checked', ['selector' => '.delete_ids'])
				</th>
			</tr>
		</thead>
		<tbody>
		@foreach($jobs as $index => $job)
			<tr>
				<td>
                    {{ $job->title }}
                    <br>
                    <span class="text-muted">（{{ AccountId::text('job', $job->id) }}）</span>
                </td>
				<td data-hide="phone,tablet">{{ $job->created_at->format('Y-m-d') }}</td>
				<td data-hide="phone,tablet">
					@if(!$job->activated)
						<span class="text-danger bold">
					@endif
					{{ $job->activated_text }}
					@if(!$job->activated)
						</span>
					@endif
				</td>
				<td>
                    @if($job->displayed == 0)
                        非掲載
                    @else
                        掲載中
                    @endif
                 </td>
				<td class="text-right">
					<nobr>
					{{ Kuku::linkRoute('home.job_detail', Camon::FA('search'), [$job->id], [
						'class' => 'btn btn-default btn-flat btn-sm bubbletip', 
						'title' => 'プレビュー',
						'target' => '_blank'
					]) }}
					{{ Kuku::linkRoute('admin.job.edit', Camon::FA('pencil'), [$job->id], [
						'class' => 'btn btn-default btn-flat btn-sm bubbletip',
						'title' => '編集'
					]) }}
					{{ Menco::get([
						'method' => 'DELETE',
						'_method' => 'DELETE',
						'label' => Camon::GL('remove'), 
						'url' => route('admin.job.destroy', [$job->id]), 
						'class' => 'btn btn-default btn-flat btn-sm bubbletip', 
						'message' => trans('versatile.destroy_confirm'), 
						'title' => '削除'
					]) }}
					</nobr>
				</td>
				<td class="text-center vertical-middle">
					{{ Form::checkbox('delete_ids[]', $job->id, false, ['class' => 'delete_ids']) }}
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	<div class="text-right">
		{{ Form::open(['route' => 'admin.job.multi_delete', 'class' => 'multi_delete', 'data-selector' => '.delete_ids']) }}
			{{ FormStrap::submit('一括削除', ['class' => 'btn btn-danger btn-xs']) }}
			{{ FormStrap::hidden(['joined_delete_ids' => '']) }}
		{{ Form::close() }}
	</div>
	<div class="text-right">
		{{ $jobs->appends([
			'orderby' => Input::get('orderby'), 
			'direction' => Input::get('direction')
		])->links() }}
	</div>
	@else
		<hr>
		まだ求人情報は登録されていません。
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