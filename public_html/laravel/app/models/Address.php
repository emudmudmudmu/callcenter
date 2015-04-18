<?php

class Address extends Eloquent {
	
	// Scopes
	
	public function scopeFilterPrefectureId($query, $prefecture_id) {
		
		return $query->where('prefecture_id', $prefecture_id);
		
	}
	
	public function scopeFilterCityId($query, $city_id) {
		
		return $query->where('city_id', $city_id);
		
	}
	
	// Others
	
	public static function city_data($prefecture_id) {
	
		if(empty($prefecture_id)) {
				
			return [];
				
		}
	
		return Address::filterPrefectureId($prefecture_id)->lists('city_name', 'city_id');
	
	}
	
}