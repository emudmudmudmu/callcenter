<?php namespace employer;

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
use Carbon\Carbon;

class ApplicationController extends \BaseController {

	protected $mode = 'employer';
	
	public function __construct() {
	
		View::share('data_name', '求職者');
	
	}
	
	public function index() {
		
		$applications = \Application::select(
								'applications.id', 
								'applications.created_at', 
								'applications.checked', 
								'applications.name', 
								\DB::raw(\DB::getTablePrefix() .'applications.user_id AS applicant_id'), 
								'jobs.title', 
								'applications.status', 
								'applications.job_id', 
								'applications.memo'
							)
							->joinJob()
							->filterEmployerId($this->user->id)
                            ->orderBy('id', 'DESC');
		
		if(!empty(Input::get('applicant_id'))) {
			
			$applicant_id = \AccountId::numeric(Input::get('applicant_id'));
				
			if($applicant_id >= 0) {

				$applications->filterUserId($applicant_id);
			
			}
			
		}
		
		if(!empty(Input::get('applicant_name'))) {
			
			$applications->filterName(Input::get('applicant_name'));
			
		}
		
		if(!empty(Input::get('job_id'))) {
			
			$job_id = \AccountId::numeric(Input::get('applicant_id'));
			
			if($job_id >= 0) {

				$applications->filterJobId($job_id);
				
			}
			
		}
		
		if(!empty(Input::get('job_title'))) {
			
			$applications->filterJobTitle(Input::get('job_title'));
			
		}
		
		if(Input::exists('status_ids')) {

			$applications->filterStatusIds(Input::get('status_ids'));
			
		}
		
		if(!empty(Input::get('application_start_year')) 
				|| !empty(Input::get('application_start_month')) 
				|| !empty(Input::get('application_start_day'))) {

			$year = intval(Input::get('application_start_year'));
			$month = (is_numeric(Input::get('application_start_month'))) ? Input::get('application_start_month') : 1;
			$day = (is_numeric(Input::get('application_start_day'))) ? Input::get('application_start_day') : 1;
			$dt = Carbon::create($year, $month, $day, 0, 0, 0);
			$applications->filterCreatedAtFuture($dt);
			
		}
		
		if(!empty(Input::get('application_end_year')) 
				|| !empty(Input::get('application_end_month')) 
				|| !empty(Input::get('application_end_day'))) {

			$year = intval(Input::get('application_end_year'));
			$month = (is_numeric(Input::get('application_end_month'))) ? Input::get('application_end_month') : 1;
			$day = (is_numeric(Input::get('application_end_day'))) ? Input::get('application_end_day') : 1;
			$dt = Carbon::create($year, $month, $day, 0, 0, 0);
			$applications->filterCreatedAtPast($dt);
			
		}
		
		if(!empty(Input::get('employment_start_year')) 
				|| !empty(Input::get('employment_start_month')) 
				|| !empty(Input::get('employment_start_day'))) {

			$year = intval(Input::get('employment_start_year'));
			$month = (is_numeric(Input::get('employment_start_month'))) ? Input::get('employment_start_month') : 1;
			$day = (is_numeric(Input::get('employment_start_day'))) ? Input::get('employment_start_day') : 1;
			$dt = Carbon::create($year, $month, $day, 0, 0, 0);
			$applications->filterEmployedDateFuture($dt);
			
		}
		
		if(!empty(Input::get('employment_end_year')) 
				|| !empty(Input::get('employment_end_month')) 
				|| !empty(Input::get('employment_end_day'))) {

			$year = intval(Input::get('employment_end_year'));
			$month = (is_numeric(Input::get('employment_end_month'))) ? Input::get('employment_end_month') : 1;
			$day = (is_numeric(Input::get('employment_end_day'))) ? Input::get('employment_end_day') : 1;
			$dt = Carbon::create($year, $month, $day, 0, 0, 0);
			$applications->filterEmployedDatePast($dt);
			
		}
		
		$applications = $applications->paginate(10);
		
		return View::make('employer.application.index', [
				'applications' => $applications
		]);
		
	}
	
	public function getShow($id) {

		$application = \Application::with('job', 'address')
							->find($id);

		if($application->job->user_id != $this->user->id) {
			
			die();
			
		}
		
		if($application->checked == 0) {
			
			$application->checked = 1;
			$application->save();
			
		}

		return View::make('employer.application.show', [
				'application' => $application
		]);
		
	}
	
	public function postShow($id) {
		
		$application = \Application::find($id);
		$job_count = \Job::filterId($application->job_id)
						->filterUserId($this->user->id)
						->count();
		
		if($job_count == 0) {
			
			return Redirect::back()
					->withInput()
					->with('danger', '求人データが見つかりません。');
		
		}

		if(Input::has('status')) {
			
			$application->status = Input::get('status');
			
			if(Input::get('status') == 3) {
				
				$application->employed_date = Carbon::now();
				
			} else {

				$application->employed_date = null;
				
			}
			
		}
		
		$application->memo = Input::get('memo');
		$application->save();
		
		return Redirect::back()->with('success', trans('versatile.success_edit'));
		
	}

//    public function destroy($id) {
//
//        $application = \Application::with('job.user')->find($id);
//
//        if($this->user->id == $application->job->user->id) {
//
//            $application = \Application::find($id);
//            $application->delete();
//            return Redirect::back()->with('success', trans('versatile.success_destroy'));
//
//        }
//
//        return Redirect::back()->with('danger', 'このデータにアクセスする権限がありません。');
//
//    }
	
}