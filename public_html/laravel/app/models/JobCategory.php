<?php

class JobCategory {
	
	public static function job_categories() {
		
		return [
			'1' => 'IT/ 通信',
			'2' => 'テクニカルサポート',
			'3' => 'メーカー',
			'4' => '金融/銀行/カード/証券',
			'5' => 'サービス事業者',
			'6' => '通信販売受注',
			'7' => 'テレフォンアポインター',
			'8' => 'その他の業種'
		];
		
	}
	
	public static function job_category_name($id) {
		
		$job_categories = JobCategory::job_categories();
		return $job_categories[$id];
		
	}
	
	public static function job_category_names($ids) {
		
		$names = [];
		
		$job_categories = JobCategory::job_categories();
		
		if(count($ids) > 0) {
			
			foreach ($ids as $id) {
				
				if(isset($job_categories[$id])) {
					
					$names[] = $job_categories[$id];
					
				}
				
			}
			
		}
		
		return $names;
		
	}
	
}