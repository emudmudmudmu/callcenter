<?php

use Carbon\Carbon;
class ApplicantMeta extends Eloquent {

	protected $guarded = ['id'];
	public $timestamps = false;
	
	// Loadings
	
	public function address() {
		
		return $this->hasOne('Address', 'city_id', 'city_id');
		
	}
	
	// Scopes
	
	public function scopeFilterUserId($query, $user_id) {
		
		return $query->where('user_id', $user_id);
		
	}
	
	// Accessors
	
	public function getGenderTextAttribute() {
		
		return Gender::gender_name($this->attributes['gender']);
		
	}
	
	public function getAgeAttribute() {

		$birth_year = $this->attributes['birth_year'];
		$birth_month = $this->attributes['birth_month'];
		$birth_day = $this->attributes['birth_day'];
		return Carbon::createFromDate($birth_year, $birth_month, $birth_day)->age;
		
	}
	
	public function getAgeTextAttribute() {

		return $this->age .'歳';
		
	}
	
}