<?php

class ApplicantJobLocation extends Eloquent {

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

	public function scopeFilterUserIds($query, $user_ids) {
	
		return $query->whereIn('user_id', $user_ids);
	
	}
	
	// Others
	
	public static function listsByUserIds($ids) {
		
		$lists = [];
		$applicant_job_locations = ApplicantJobLocation::filterUserIds($ids)->with('address')->get();

		if($applicant_job_locations->count() > 0) {
			
			foreach ($applicant_job_locations as $applicant_job_location) {
				
				$lists[$applicant_job_location->user_id]['addresses']['prefecture_ids'][] = $applicant_job_location->prefecture_id;
				$lists[$applicant_job_location->user_id]['addresses']['city_ids'][] = $applicant_job_location->city_id;
				$lists[$applicant_job_location->user_id]['addresses']['prefecture_names'][] = $applicant_job_location->address->prefecture_name;
				$lists[$applicant_job_location->user_id]['addresses']['city_names'][] = $applicant_job_location->address->prefecture_name;
				
			}
			
		}
		
		return $lists;
		
	}
	
}