<?php namespace applicant;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\HTML;
use Sukohi\Surpass\Facades\Surpass;
use Sukohi\Caruta\Facades\Caruta;
use Sukohi\Cahen\Facades\Cahen;
use Sukohi\SearchStrap\Facades\SearchStrap;
use Sukohi\JapanesePrefectures\JapanesePrefectures;

class ApplicationController extends \BaseController {

	protected $mode = 'applicant';
	
	public function __construct() {
	
		View::share('data_name', '応募情報');
	
	}
	
	public function index() {
		
		$applications = \Application::select(
							'applications.id', 
							'applications.job_id', 
							'applications.created_at' 
						)
						->filterUserId($this->user->id)
						->with('job', 'job.user')
						->paginate(15);

		return View::make('applicant.application.index', [
				'applications' => $applications
		]);
		
	}
	
	public function show($id) {
		
		$application = \Application::filterUserId($this->user->id)
							->with('address')
							->find($id);
// 		echo '<pre>'. print_r($application->toArray(), true) .'</pre>';
		return View::make('applicant.application.show', [
				'application' => $application
		]);
		
	}
	
}