<?php

class JobType {
	
	public static function job_types() {
		
		return [
			'1' => '正社員', 
			'2' => '契約社員', 
			'3' => '派遣社員', 
			'4' => '紹介者予定派遣', 
			'5' => 'アルバイト・パート'
		];
		
	}
	
	public static function job_type_name($id) {
	
		$job_types = JobType::job_types();
		return $job_types[$id];
	
	}
	
	public static function job_type_names($ids, $key_flag = false) {
		
		$names = [];
		
		$job_types = JobType::job_types();
		
		if(count($ids) > 0) {
			
			foreach ($ids as $key => $id) {
				
				if(isset($job_types[$id])) {

                    if($key_flag) {

                        $names[$id] = $job_types[$id];

                    } else {

                        $names[] = $job_types[$id];

                    }
					
				}
				
			}
			
		}
		
		return $names;
		
	}
	
}