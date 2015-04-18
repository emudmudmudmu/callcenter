<?php

class AccountId {
	
	public static function text($type, $id) {
		
		$type_symbol = '';
		
		switch($type) {
		
			case 'employer':
				$type_symbol = 'C';
				break;
		
			case 'applicant':
				$type_symbol = 'A';
				break;
		
			case 'job':
				$type_symbol = 'J';
				break;
		
			default:
				return '';
					
		}
		
		return $type_symbol . str_pad($id, 7, '0', STR_PAD_LEFT);
		
	}
	
	public static function numeric($id_text) {
		
		if(preg_match('!^[C|A|J]{1}([0-9]{7})$!', $id_text, $matches)) {

			return intval($matches[1]);
			
		}
		
		return -1;
		
	}
	
}