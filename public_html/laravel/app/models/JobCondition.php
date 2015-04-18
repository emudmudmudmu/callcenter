<?php

class JobCondition {
	
	public static function job_conditions() {
		
		return [
			'1' => '交通費支給', 
			'2' => '時給1200円以上',
			'3' => '月給25万円以上',
            '4' => '長期勤務可能',
            '5' => '土日だけＯＫ',
            '6' => '主婦・夫歓迎',
            '7' => '週2･3 日～ＯＫ',
            '8' => '平日のみＯＫ',
            '9' => '未経験OK',
            '10' => '夜勤あり',
            '11' => '短期勤務可能',
            '12' => '正社員登用あり',
            '13' => '駅チカ',
            '14' => '副業・ＷワークＯＫ',
            '15' => '土日祝休み',
            '16' => '日・週払いあり',
			'17' => '扶養内勤務ＯＫ',
            '18' => '車・バイク通勤可',
            '19' => 'シフト相談可能',
			'20' => '髪型自由・服装自由'
		];
		
	}
	
	public static function job_condition_name($ids) {
        $names = [];
        
        $job_conditions = JobCondition::job_conditions();
        
        if(count($ids) > 0) {
            
            foreach ($ids as $id) {
                
                if(isset($job_conditions[$id])) {
                    
                    $names[] = $job_conditions[$id];
                    
                }
                
            }
            
        }
        
        return $names;
        
	}
	
}