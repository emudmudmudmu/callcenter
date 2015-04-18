<?php

class JobMeta extends Eloquent {
	
	protected $guarded = ['id'];
	public $timestamps = false;
	
	// Loadings
	
	public function image_file() {
		
		return $this->hasOne('ImageFile', 'id', 'meta_value');
		
	}
	
	// Scopes 
	
	public function scopeFilterJobId($query, $job_id) {
		
		return $query->where('job_id', $job_id);
		
	}
	
	public function scopeFilterMetaKey($query, $meta_key) {
		
		return $query->where('meta_key', $meta_key);
		
	}
	
	// Others
	
	public static function metaArray($job_id) {
		
		$job_metas = JobMeta::select('meta_key', 'meta_value')->filterJobId($job_id)->get();
		$values = [];
		
		foreach ($job_metas as $job_meta) {
			
			$values[str_plural($job_meta->meta_key)][] = $job_meta->meta_value;
			
		}
		
		return $values;
		
	}
	
	public static function metaAssign($job_meta) {
		
		$meta_values = [
            'type_ids' => [],
            'category_ids' => [],
            'condition_ids' => [],
            'main_company_image_file_ids' => [],
            'sub_company_image_file_ids' => [],
            'pic_image_file_ids' => []
        ];
		
		foreach ($job_meta as $mata) {
			
			$meta_values[str_plural($mata->meta_key)][] = $mata->meta_value;
			
		}

        return $meta_values;
		
	}
	
}