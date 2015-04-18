<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\HTML;
class Announcement extends Eloquent {
	
	protected $guarded = ['id'];

	// Scopes
	
	public function scopeFilterId($query, $id) {
		
		return $query->where('id', $id);
		
	}
	
	public function scopeFilterIds($query, $ids) {
		
		return $query->whereIn('id', $ids);
		
	}
	
	public function scopeFilterTitle($query, $title) {
		
		return $query->where('title', $title);
		
	}
	
	public function scopeFilterDescription($query, $description) {
		
		return $query->where('description', $description);
		
	}
	
	public function scopeFilterMode($query, $mode) {
		
		return $query->where('mode', $mode);
		
	}
	
	// Accesessors
	
	public function getTagsAttribute($value) {
		
		return json_decode($value, true);
		
	}
	
	// Mutators
	
	public function setTagsAttribute($values) {
		
		if(!is_array($values)) {
		
			$values = [$values];
		
		}
		
		$this->attributes['tags'] = json_encode($values);
		
	}
	
	// Others
	
	public static function validator() {
		
		$validator = Validator::make(
			Input::only([
				'title', 
				'description', 
				'mode'
			]),
			[
				'title' => 'required', 
				'description' => 'required', 
				'mode' => 'required'
			]
		);
		
		if(Input::has('attribute_names')) {
				
			$validator->setAttributeNames(Input::get('attribute_names'));
				
		}
		
		return $validator;
		
	}
	
	public static function saveData($id = null, $extra_values = []) {
		
		$announcement = Announcement::firstOrNew(['id' => $id]);
		$announcement->id = $id;
		$announcement->title = Input::get('title');
		$announcement->description = Input::get('description');
		$announcement->mode = Input::get('mode');
		$announcement->save();
		return $announcement;
		
	}
	
}