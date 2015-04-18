<?php

class EmployerContactType {
	
	public static function types() {
		
		return [
				'1' => '求人に関するお問い合わせ', 
				'2' => 'サイトに関するお問い合わせ', 
				'3' => 'その他のお問い合わせ'
		];
		
	}
	
	public static function type($type_id) {
		
		$types = EmployerContactType::types();
		return $types[$type_id];
		
	}
	
}