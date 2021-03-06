<?php 

	$zip_code_1 = (!isset($zip_code_1)) ? '' : $zip_code_1;
	$zip_code_2 = (!isset($zip_code_2)) ? '' : $zip_code_2;
	$other_address = (!isset($other_address)) ? '' : $other_address;
	$building = (!isset($building)) ? '' : $building;
	$prefecture_id = (!isset($prefecture_id)) ? '' : $prefecture_id;
	$city_id = (!isset($city_id)) ? '' : $city_id;

?>

<div style="padding:5px 3px">
	<div class="clearfix" style="margin-bottom:10px;">
		<div class="text-muted font-size-md" style="padding-left:5px;padding-bottom:2px;">郵便番号</div>
		<div class="col-md-12 col-lg-12" style="padding:4px 0 0 2px;">
			<div class="pull-left padding-xs">〒</div>
			<div class="col-md-2 col-lg-2 col-sm-4 col-xs-4{{ ($errors->first('zip_code_1')) ? ' has-error' : ''}}" style="padding-left:3px;">
				{{ Form::text('zip_code_1', $zip_code_1, ['class' => 'form-control']) }}
				<div class="text-danger">{{ $errors->first('zip_code_1') }}</div>
			</div>
			<div class="pull-left">-</div>
			<div class="col-md-2 col-lg-2 col-sm-4 col-xs-4{{ ($errors->first('zip_code_2')) ? ' has-error' : ''}}">
				{{ Form::text('zip_code_2', $zip_code_2, ['class' => 'form-control']) }}
				<div class="text-danger">{{ $errors->first('zip_code_2') }}</div>
			</div>
		</div>
	</div>
	<div class="text-muted font-size-md" style="padding-left:5px;padding-bottom:2px;">都道府県・市町村</div>
	@include('partials.form.prefecture_city', [
		'prefecture_id' => $prefecture_id, 
		'city_id' => $city_id, 
		'prefecture_name' => 'prefecture_id', 
		'city_name' => 'city_id', 
		'prefectures' => $prefectures, 
		'cities' => $cities
	])
	<div class="clearfix">
		<div class="text-muted font-size-md" style="padding-left:5px;padding-bottom:2px;">番地</div>
		<div class="col-md-12 col-lg-12{{ ($errors->first('other_address')) ? ' has-error' : ''}}" style="padding-left:3px;">
			{{ Form::text('other_address', $other_address, ['class' => 'form-control']) }}
			<div class="text-danger">{{ $errors->first('other_address') }}</div>
		</div>
	</div>
	<br>
	<div class="clearfix">
		<div class="text-muted font-size-md" style="padding-left:5px;padding-bottom:2px;">マンション・ビル名等</div>
		<div class="col-md-12 col-lg-12{{ ($errors->first('building')) ? ' has-error' : ''}}" style="padding-left:3px;">
			{{ Form::text('building', $building, ['class' => 'form-control']) }}
			<div class="text-danger">{{ $errors->first('building') }}</div>
		</div>
	</div>
</div>