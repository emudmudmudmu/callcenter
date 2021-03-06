<?php

class EmployerConsideration extends Eloquent {
	
	protected $guarded = ['id'];
	
	// Loadings
	
	public function applicant() {
		
		return $this->hasOne('User', 'id', 'applicant_id');
		
	}
	
	// Scopes
	
	public function scopeFilterEmployerId($query, $employer_id) {
		
		return $query->where('employer_id', $employer_id);
		
	}
	
	public function scopeFilterApplicantId($query, $applicant_id) {
		
		return $query->where('applicant_id', $applicant_id);
		
	}
	
	// Others
	
	public static function exists($employer_id, $applicant_id) {
		
		$employer_consideration = \EmployerConsideration::filterEmployerId($employer_id)
										->filterApplicantId($applicant_id)
										->get();
		return ($employer_consideration->count() > 0);
		
	}
	
}