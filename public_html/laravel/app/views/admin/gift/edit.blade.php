@extends('layouts.admin', [
	'page_title' => 'お祝い金申請の処理',
	'bakery_params' => [
		'admin.dashboard' => 'ホーム', 
		'admin.gift.index' => 'お祝い金の申請一覧', 
		'*' => 'お祝い金申請の処理'
	]
])

@section('content')

	{{ Form::open(['route' => ['admin.gift.update', $gift->id], 'method' => 'PUT']) }}
	<div class="headline" style="margin-top:10px;margin-bottom:15px;">お祝い金申請の詳細</div>
	<table class="table table-bordered table-striped bg-white footable font-size-sm" style="margin-top:15px;">
		<tbody>
			<tr>
				<td>求人ID</td>
				<td>{{ $gift->job_id }}</td>
			</tr>
			<tr>
				<td>面接日</td>
				<td>{{ $gift->interview_date->format('Y-m-d') }}</td>
			</tr>
			<tr>
				<td>名前</td>
				<td>{{ $gift->shipping_name }}</td>
			</tr>
			<tr>
				<td>住所</td>
				<td>{{ $gift->shipping_address }}</td>
			</tr>
			<tr>
				<td>メールアドレス</td>
				<td>{{ $gift->email }}</td>
			</tr>
			<tr>
				<td style="vertical-align:middle;">チェック</td>
				<td style="padding-top:15px;">
				{{ FormStrap::radio('check_flag', [
					'0' => '未チェック', 
					'1' => 'チェック済'
				], $gift->check_flag, [], '　')->css('group', 'none') }}
				</td>
			</tr>
			<tr>
				<td>備考</td>
				<td>
				{{ FormStrap::textarea('remarks', $gift->remarks, ['rows' => 3]) }}
			</tr>
		</tbody>
	</table>
	<div class="clearfix">
		<div class="col-md-12 col-lg-12 text-right no-padding">
			{{ FormStrap::submit('変更する '. Camon::GL('circle-arrow-right'), ['class' => 'btn btn-success btn-sm'])
				->cancel(route('admin.gift.index'), 'キャンセル', ['class' => 'btn btn-default btn-sm']) }}
		</div>
	</div>
	{{ Form::hidden('redirect_check_flag', (!Input::has('redirect_check_flag')) ? -1 : intval(Input::get('redirect_check_flag'))) }}
	{{ Form::close() }}
	
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