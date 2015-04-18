<?php

class ApplicantJobCategory extends Eloquent {

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
		$category_names = JobCategory::job_categories();
		$categories = ApplicantJobCategory::filterUserIds($ids)->get();

		if($categories->count() > 0) {
			
			foreach ($categories as $category) {

				$lists[$category->user_id]['category_ids'][] = $category->category_id;
				$lists[$category->user_id]['category_names'][] = $category_names[$category->category_id];
				
			}
			
		}
		
		return $lists;
		
	}
	
}