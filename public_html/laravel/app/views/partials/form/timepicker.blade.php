<?php 

	if(!isset($value)) {
		
		$value = '';
		
	}

	if(Input::old($name)) {
		
		$value = Input::old($name);
		
	}

?>
<div class="input-group">
	<input type="text" name="{{ $name }}" value="{{ (isset($value) ? $value : '') }}" class="form-control timepicker"/>
	<div class="input-group-addon">
		<i class="fa fa-clock-o"></i>
	</div>
</div>