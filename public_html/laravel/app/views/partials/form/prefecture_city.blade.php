<?php 

	$prefecture_id = (!isset($prefecture_id)) ? '' : $prefecture_id;
	$city_id = (!isset($city_id)) ? '' : $city_id;

?>
<div class="clearfix" style="margin-bottom:10px;">
	<div class="col-md-3 col-lg-3 col-sm-4 col-xs-4{{ ($errors->first($prefecture_name)) ? ' has-error' : ''}}" style="padding-left:5px;">
		{{ Form::select($prefecture_name, $prefectures, 
				(Input::old($prefecture_name)) ? Input::old($prefecture_name) : $prefecture_id, 
				[
					'class' => 'form-control city_data', 
					'data-target' => '#'. $city_name
				])
		}}
		<div class="text-danger">{{ $errors->first($prefecture_name) }}</div>
	</div>
	<div class="col-md-3 col-lg-3 col-sm-4 col-xs-4{{ ($errors->first($city_name)) ? ' has-error' : ''}}" style="padding-left:0;">
		{{ Form::select($city_name, 
				\Address::city_data((Input::old($prefecture_name)) ? Input::old($prefecture_name) : $prefecture_id), 
				(Input::old($city_name)) ? Input::old($city_name) : $city_id, 
				[
					'id' => $city_name, 
					'class' => 'form-control'
				])
		}}
		<div class="text-danger">{{ $errors->first('city_id') }}</div>
	</div>
</div>