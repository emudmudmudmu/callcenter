@extends('layouts.admin', [
	'page_title' => 'おすすめ求人情報の設定', 
	'bakery_params' => [
		'admin.dashboard' => 'ホーム', 
		'*' => 'おすすめ求人情報の設定'
	]
])

@section('content')

	<table class="table table-hover table-bordered table-striped bg-white footable font-size-sm" style="margin-top:15px;">
		<thead>
			<tr class="bg-gray text-white">
				<th>
					<nobr>求人タイトル</nobr>
				</th>
				<th>
					<nobr>並び</nobr>
				</th>
				<th>
					<nobr>操作</nobr>
				</th>
			</tr>
		</thead>
		<tbody>
		@foreach($recommendations as $index => $recommendation)
			<tr>
				<td>
					{{ $recommendation->title }}
				</td>
				<td>
					{{ Kuku::linkRoute('admin.recommendation.sort', Camon::FA('angle-double-up'), [
							$recommendation->id, 
							($recommendation->sort)
						], [
						'class' => 'btn btn-default btn-flat btn-sm bubbletip', 
						'title' => '並びを上へ'
					]) }}
					{{ Kuku::linkRoute('admin.recommendation.sort', Camon::FA('angle-double-down'), [
							$recommendation->id, 
							($recommendation->sort+2)
						], [
						'class' => 'btn btn-default btn-flat btn-sm bubbletip', 
						'title' => '並びを下へ'
					]) }}
				</td>
				<td class="text-right">
                    <nobr>
                    {{ Kuku::linkRoute('home.job_detail', Camon::FA('search'), [$recommendation->id], [
                        'class' => 'btn btn-default btn-flat btn-sm bubbletip',
                        'title' => 'プレビュー',
                        'target' => '_blank'
                    ]) }}
                    {{ Kuku::linkRoute('admin.job.edit', Camon::FA('pencil'), [$recommendation->id], [
                        'class' => 'btn btn-default btn-flat btn-sm bubbletip',
                        'title' => '編集',
                        'target' => '_blank'
                    ]) }}
					{{ Menco::get([
						'method' => 'POST',
						'label' => Camon::GL('remove'), 
						'url' => route('admin.recommendation.post', [$recommendation->id]), 
						'class' => 'btn btn-default btn-flat btn-sm bubbletip', 
						'title' => 'おすすめを解除', 
						'message' => 'おすすめ設定を解除します。よろしいですか？'
					]) }}
                    </nobr>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	<div class="thumbnail padding-xs font-size-sm text-muted">
        ※おすすめとして表示するには、「表示設定」「公開設定」「有効期限」が有効になっている必要があります。<br>
        ※また、表示される件数は最大{{ Config::get('app.recommendation_count') }}件までです。
    </div>
	
@stop