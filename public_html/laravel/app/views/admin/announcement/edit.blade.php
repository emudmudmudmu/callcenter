@extends('layouts.admin', [
	'page_title' => trans('versatile.title.create', ['name' => $data_name]), 
	'bakery_params' => [
		'admin.dashboard' => 'ホーム', 
		'admin.'. $announcement_mode .'.announcement.index' => trans('versatile.title.index', ['name' => $data_name]), 
		'*' => trans('versatile.title.create', ['name' => $data_name])
	]
])

@section('content')

	{{ Form::open(['route' => ['admin.'. $announcement_mode .'.announcement.update', $announcement->id], 'method' => 'PUT']) }}
	
		<div class="clearfix">
			<div class="col-md-6 col-lg-6">
				{{ FormStrap::text('title', $announcement->title)
					->label('タイトル', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::textarea('description', $announcement->description, ['cols' => '5'])
					->label('告知内容', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12 text-right">
				{{ FormStrap::submit('変更する '. Camon::GL('circle-arrow-right'), ['class' => 'btn btn-success btn-flat btn-sm'])
					->cancel(route('admin.'. $announcement_mode .'.announcement.index'), 'キャンセル', ['class' => 'btn btn-default btn-flat btn-sm']) }}
			</div>
		</div>
		
		{{ FormStrap::hidden(['mode' => $announcement_mode]) }}
		
		{{ FormStrap::attributeNames() }}
	{{ Form::close() }}
	
@stop

@section('script')

	<script type="text/javascript">

		$(document).ready(function(){
			
			@include('js/autosize')
			@include('js/file_input')
			@include('js/datepicker')
			@include('js/timepicker')
			@include('js/tagsinput')
			@include('js/icheck')
			
		});
		
	</script>

@stop