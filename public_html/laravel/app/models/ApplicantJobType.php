<?php

class ApplicantJobType extends Eloquent {

	protected $guarded = ['id'];
	public $timestamps = false;

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
		$type_names = JobType::job_types();
		$types = ApplicantJobType::filterUserIds($ids)->get();

		if($types->count() > 0) {
			
			foreach ($types as $type) {

				$lists[$type->user_id]['type_ids'][] = $type->type_id;
				$lists[$type->user_id]['type_names'][] = $type_names[$type->type_id];
				
			}
			
		}
		
		return $lists;
		
	}
	
}