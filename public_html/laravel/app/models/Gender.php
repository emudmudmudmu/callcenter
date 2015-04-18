<?php

class Gender {
	
	public static function gender_data() {
		
		return ['1' => '男性', '2' => '女性'];
		
	}
	
	public static function gender_name($gender_id) {
		
		$genders = Gender::gender_data();
		return $genders[$gender_id];
		
	}
	
}