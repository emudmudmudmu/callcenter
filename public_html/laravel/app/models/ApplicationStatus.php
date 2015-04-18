<?php

class ApplicationStatus {
	
	public static function application_statuses() {
		
		return [
				'0' => '応募受信', 
				'1' => '面接日決定', 
				'2' => '採用決定', 
				'3' => '不採用',
		];
	}
	
	public static function  application_status_name($status_id) {
		
		$statuses = ApplicationStatus::application_statuses();
		return $statuses[$status_id];
		
	}
	
}