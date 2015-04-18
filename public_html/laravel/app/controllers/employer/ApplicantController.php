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

class ApplicantController extends \BaseController {

	protected $mode = 'employer';
	
	public function __construct() {
	
		View::share('data_name', '求職者');
	
	}
	
	public function index() {
		
		$applicants = \User::with('applicant_meta.address')
						->joinGroup()
						->filterGroupId(\Group::groupIdByName('applicant'));
		
		$applicant_ids = [];
		$applicants = SearchStrap::modelFilter($applicants, ['account_id', 'name', 'prefecture_id']);
		$applicants = Caruta::sort($applicants,
				['id', 'title', 'description'],
				['id', 'DESC']
		);
		
		$search_key = $applicants->search_key;
		$applicants = $applicants->paginate(15);
		$applicant_job_categories = [];
		$applicant_job_types = [];

		if($applicants->count() > 0) {
				
			foreach ($applicants as $applicant) {
		
				$applicant_ids[] = $applicant->id;
		
			}
		
			$applicant_job_categories = \ApplicantJobCategory::listsByUserIds($applicant_ids);
			$applicant_job_types = \ApplicantJobType::listsByUserIds($applicant_ids);
				
		}
		
		return View::make('employer.applicant.index', [
				'applicants' => $applicants,
				'search_key' => $search_key,
				'sort_flag' => (empty(Input::except(['page']))),
				'search_strap' => $this->search_strap(), 
				'applicant_job_categories' => $applicant_job_categories, 
				'applicant_job_types' => $applicant_job_types
		]);
		
	}
	
	public function show($id) {

		$applicant = \User::with('applicant_meta.address')
						->find($id);
		
		$applicant_job_category_ids = \ApplicantJobCategory::filterUserId($applicant->id)->lists('category_id');
		$applicant_job_type_ids = \ApplicantJobType::filterUserId($applicant->id)->lists('type_id');
		$applicant_job_locations = \ApplicantJobLocation::select()
										->filterUserId($applicant->id)
										->get();

		$job_category_names = \JobCategory::job_category_names($applicant_job_category_ids);
		$job_type_names = \JobType::job_type_names($applicant_job_type_ids);
		$employer_consideration_flag = \EmployerConsideration::exists($this->user->id, $id);
		
		return View::make('employer.applicant.show', [
				'applicant' => $applicant,
				'applicant_job_category_ids' => $applicant_job_category_ids,
				'applicant_job_type_ids' => $applicant_job_type_ids,
				'applicant_job_locations' => $applicant_job_locations, 
				'job_category_names' => $job_category_names, 
				'job_type_names' => $job_type_names, 
				'employer_consideration_flag' => (int)$employer_consideration_flag
		]);
		
	}
	
	public function getConsideration() {
		
		$considerations = \EmployerConsideration::filterEmployerId($this->user->id)
							->with(
								'applicant.applicant_meta', 
								'applicant.applicant_job_categories', 
								'applicant.applicant_job_types'
							)
							->orderBy('created_at', 'DESC')
							->paginate(15);
		
		return View::make('employer.applicant.consideration', [
				'considerations' => $considerations
		]);
		
	}
	
	public function postConsideration() {
		
		$applicant_id = Input::get('applicant_id');
		$employer_id = $this->user->id;
		$flag = intval(Input::get('flag'));
		
		if($flag == 1) {
			
			$employer_consideration = \EmployerConsideration::firstOrNew([
					'employer_id' => $employer_id,
					'applicant_id' => $applicant_id
			]);
			$employer_consideration->applicant_id = $applicant_id;
			$employer_consideration->employer_id = $employer_id;
			$employer_consideration->save();
			
		} else {
			
			\EmployerConsideration::filterEmployerId($employer_id)
					->filterApplicantId($applicant_id)
					->delete();
			
		}
		
		return Redirect::back()->with('success', '完了しました。');
		
	}
	
	public function getScout($id) {
		
		$applicant = \Sentry::findUserById($id);
		
		if(!$applicant->hasPermission('applicant')) {
			
			return Redirect::back()->with('danger', 'アクセス権限がありません。');
			
		}
		
		$scout_job_ids = \Scout::filterEmployerId($this->user->id)
								->filterApplicantId($applicant->id)
								->lists('job_id');
		
		if(empty($scout_job_ids)) {
			
			$scout_job_ids = [-1];
			
		}
		
		$jobs = \Job::filterUserId($this->user->id)
					->orderBy('id', 'DESC')
					->whereNotIn('id', $scout_job_ids)
					->lists('title', 'id');
		
		return View::make('employer.applicant.scout', [
				'applicant' => $applicant, 
				'jobs' => $jobs
		]);
		
	}
	
	public function postScout($id) {
		
		$applicant = \Sentry::findUserById($id);
		
		if(!$applicant->hasPermission('applicant')) {
				
			return Redirect::back()->with('danger', 'アクセス権限がありません。');
				
		}

		$job_id = Input::get('job_id');
		$job = \Job::filterId($job_id)->filterUserId($this->user->id)->first();
		
		$scout = \Scout::firstOrNew([
				'job_id' => $job_id, 
				'employer_id' => $this->user->id, 
				'applicant_id' => $applicant->id
		]);
		$scout->job_id = $job_id;
		$scout->employer_id = $this->user->id;
		$scout->applicant_id = $applicant->id;
		$scout->save();
		
		$email_params = [
				'applicant' => $applicant, 
				'employer' => $this->user, 
				'job' => $job, 
				'url' => route('home.job_detail', $job_id)
		];
		
// 		echo View::make('emails.employer.scout', $email_params)->render();
		
		\Mail::send('emails.employer.scout', $email_params, function($e) use($applicant)
		{
			$to_email = (\App::isLocal()) ? \Config::get('app.emails.main') : $applicant->email;
			
			$e->to($to_email, $applicant->last_name . $applicant->first_name .'様')
				->from(\Config::get('app.emails.main'), \Config::get('app.site_title'))
				->subject('【'. \Config::get('app.site_title') .'】'. $this->user->last_name .'さんからメッセージが届いています');
		});
		
		return Redirect::back()->with('success', 'スカウトメールの送信が完了しました。');
		
	}
	
}