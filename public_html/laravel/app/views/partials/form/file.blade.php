<?php 

if(!isset($attributes)) {
	
	$attributes = [];
	
}

?>
{{ Form::file($name, $attributes) }}