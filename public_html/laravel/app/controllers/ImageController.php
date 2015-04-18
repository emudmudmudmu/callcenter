<?php

class ImageController extends BaseController {
	
	public function upload() {
		
		$surpass = Surpass::path(Config::get('app.pathes.upload'));
		
		if($surpass->save()) {

			
			
		}

		return $surpass->result();
		
	}
	
	public function remove() {
		
		$surpass = Surpass::path(Config::get('app.pathes.upload'));
		
		if($surpass->remove()) {}
		
		return $surpass->result();
		
	}
	
}