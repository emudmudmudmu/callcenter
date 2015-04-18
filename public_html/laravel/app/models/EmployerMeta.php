<?php

use Carbon\Carbon;
class EmployerMeta extends Eloquent {

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
	
	public function getFoundationDateAttribute() {
		
		return new Carbon($this->attributes['foundation_date']);
		
	}
	
}