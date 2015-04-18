@extends('layouts.admin', [
	'page_title' => trans('versatile.title.create', ['name' => $data_name]), 
	'bakery_params' => [
		'admin.dashboard' => 'ホーム', 
		'admin.applicant.index' => trans('versatile.title.index', ['name' => $data_name]), 
		'*' => trans('versatile.title.create', ['name' => $data_name])
	]
])

@section('content')

	{{ Form::open(['route' => 'admin.applicant.store']) }}
	
		<div class="clearfix">
			<div class="col-md-6 col-lg-6">
				{{ FormStrap::text('input_1')
					->label('input_1', ['class' => 'text-success']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::textarea('input_2', '', ['cols' => '5'])
					->label('input_2', ['class' => 'text-success']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::radio('input_3', [
			        'value_1' => 'label_1', 
			        'value_2' => 'label_2', 
			        'value_3' => 'label_3'
			    ], 'value_1', [], '　')
			    ->label('input_3', ['class' => 'text-success']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::checkbox('input_4', [
				    'value_1' => 'label_1', 
				    'value_2' => 'label_2', 
				    'value_3' => 'label_3'
				], [
				    'value_1', 
				    'value_2'
				], [], '　')
				->label('input_4', ['class' => 'text-success']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-6 col-lg-6">
				{{ FormStrap::select('input_5', [
				    '' => '▼以下から選択', 
				    'value_1' => 'label_1', 
				    'value_2' => 'label_2', 
				    'value_3' => 'label_3'
				], 'value_1')
				->label('input_5', ['class' => 'text-success']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-3 col-lg-3">
			{{ FormStrap::view('input_6', 'partials.form.datepicker', [
					'name' => 'input_6'
				])
				->label('input_6', ['class' => 'text-success']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-3 col-lg-3">
				<div class="bootstrap-timepicker">
					{{ FormStrap::view('input_7', 'partials.form.timepicker', [
							'name' => 'input_7'
						])
						->label('input_7', ['class' => 'text-success']) }}
				</div>
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-6 col-lg-6">
				{{ FormStrap::text('input_8', '', ['class' => 'tagsinput'])
					->label('input_8', ['class' => 'text-success']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12">
				{{ FormStrap::view('image_upload', 'partials.form.file', [
						'name' => 'image_upload',
						'attributes' => [
							'title' => '画像を選択（１枚）..',
							'class' => 'btn-flat',
							'data-url' => route('admin.image.upload'),
							'data-remove-url' => route('admin.image.remove'), 
							'accept' => 'image/*',
							'multiple' => false
						]
					])
					->label('画像', ['class' => 'text-success']) }}
				{{ $surpass->html('preview') }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12 padding-sm">
			{{ FormStrap::view('captcha', 'partials.form.captcha')
				->label('画像認証', ['class' => 'text-warning']) }}
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-12 col-lg-12 text-right">
				{{ FormStrap::submit('追加する '. Camon::GL('circle-arrow-right'), ['class' => 'btn btn-success btn-flat btn-sm'])
					->cancel(route('admin.applicant.index'), 'キャンセル', ['class' => 'btn btn-default btn-flat btn-sm']) }}
			</div>
		</div>
			
		{{ FormStrap::attributeNames() }}
	{{ Form::close() }}
	
@stop

@section('script')

	{{ $surpass->html('js') }}

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