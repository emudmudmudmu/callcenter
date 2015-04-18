<?php

class Year {
	
	public static function birth_year_data($unit_flag = true) {
		
		$year_data = ['' => '選択'];
		$max_year = date('Y') - 15;
		$ago_year = $max_year - 100;
		
		for ($i = $max_year; $i >= $ago_year; $i--) {
			
			$year_data[$i] = ($unit_flag) ? $i .'年' : $i;
			
		}
		
		return $year_data;
		
	}
	
	public static function birth_year_numeric_data() {
		
		return Year::birth_year_data(false);
		
	}
	
	public static function release_year_data($unit_flag = true) {
		
		$year_data = ['' => '-'];
		$max_year = date('Y');
		
		for ($i = 0; $i <= 5; $i++) {
			
			$year_data[($max_year+$i)] = ($unit_flag) ? ($max_year+$i) .'年' : ($max_year+$i);
			
		}
		
		return $year_data;
		
	}
	
	public static function release_year_numeric_data() {
		
		return Year::release_year_data(false);
		
	}
	
	public static function interview_year_data($unit_flag = true) {

        $year_data = [];
        $base_year = 2015;
        $current_year = date('Y');

        for($i = $base_year ; $i <= $current_year ; $i++) {

            $year_data[$i] = ($unit_flag) ? $i .'年' : $i;

        }

        return $year_data;
	
	}
	
}