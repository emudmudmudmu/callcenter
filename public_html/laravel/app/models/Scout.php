<?php

class Scout extends Eloquent {
	
	protected $guarded = ['id'];
	
	// Scopes
	
	public function scopeFilterEmployerId($query, $employer_id) {
		
		return $query->where('employer_id', $employer_id);
		
	}
	
	public function scopeFilterApplicantId($query, $applicant_id) {
		
		return $query->where('applicant_id', $applicant_id);
		
	}
	
}