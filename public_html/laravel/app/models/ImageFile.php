<?php

class ImageFile extends Eloquent {
	
	protected $guarded = ['id'];
	public $timestamps = false;
	
	// Accessors
	
	public function getUrlAttribute() {
		
		return url(Config::get('app.pathes.upload') .'/'. $this->attributes['dir'] .'/'. $this->attributes['filename']);
		
	}

    // Others

    public static function urls($ids) {

        $image_urls = [];

        if(empty($ids)) {

            return $image_urls;

        }

        $image_files = ImageFile::select('id', 'dir', 'filename')
                        ->whereIn('id', $ids)
                        ->get();

        if(!empty($image_files)) {

            foreach ($image_files as $image_file) {

                $image_file_id = $image_file->id;
                $image_file_dir = $image_file->dir;
                $image_urls[$image_file_dir][$image_file_id] = $image_file->url;

            }

        }

        return $image_urls;

    }

}