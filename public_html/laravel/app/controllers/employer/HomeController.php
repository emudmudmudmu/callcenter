<?php namespace employer;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
class HomeController extends \BaseController {
	
	protected $mode = 'employer';
	
	public function dashboard() {

		$job_counts = [];
		$job_activated_counts = \Job::select(
									'activated', 
									\DB::raw('COUNT(id) AS COUNT')
								)
								->groupBy('activated')
								->lists('COUNT', 'activated');
		
		$job_counts['count'] = \Job::count();
		$job_counts['activated'] = (isset($job_activated_counts[1])) ? $job_activated_counts[1] : 0;
		$job_counts['unactivated'] = (isset($job_activated_counts[0])) ? $job_activated_counts[0] : 0;
		$job_counts['expired'] = \Job::filterExpired()->count();
		$job_counts['fulfilled'] = \Job::filterHasApplicationCeiling()
										->whereRaw('application_ceiling <= application_count')
										->count();
		
		$applications = \Application::select(
								'applications.status', 
								\DB::raw('COUNT('. \DB::getTablePrefix() .'applications.id) AS COUNT')
							)
							->groupBy('status')
							->joinJob()
							->filterEmployerId($this->user->id)
							->lists('COUNT', 'status');
		$application_counts = [
				'count' => (!empty($applications)) ? array_sum($applications) : 0, 
				'0' => (isset($applications[0])) ? $applications[0] : 0, 
				'1' => (isset($applications[1])) ? $applications[1] : 0, 
				'2' => (isset($applications[2])) ? $applications[2] : 0, 
				'3' => (isset($applications[3])) ? $applications[3] : 0
		];
		
		$billing_counts = [
			'0' => 0, 
			'1' => 0, 
			'2' => 0
		];
		
		$all_billing = \Application::select(
									\DB::raw('COUNT('. \DB::getTablePrefix() .'applications.id) AS COUNT')
								)
								->joinJob()
								->filterEmployerId($this->user->id)
								->first();
		$billing_counts[0] = $all_billing->fee;
		$dt = Carbon::now()->subMonth()->firstOfMonth();
		$billings = \Application::select(
								'applications.applied_year', 
								'applications.applied_month', 
								\DB::raw('COUNT('. \DB::getTablePrefix() .'applications.id) AS COUNT')
							)
							->joinJob()
							->filterEmployerId($this->user->id)
							->where('applications.created_at', '>=', $dt)
							->groupBy('applications.applied_year', 'applications.applied_month')
							->get();
		
		if($billings->count() > 0) {
			
			foreach ($billings as $billing) {
			
				if($billing->applied_month == date('n')) {
					
					$billing_counts[1] = $billing->fee;
					
				} else {
					
					$billing_counts[2] = $billing->fee;
					
				}
				
			}
			
		}
		
		return View::make('employer.home.dashboard', [
				'job_activated_counts' => $job_activated_counts, 
				'job_counts' => $job_counts, 
				'application_counts' => $application_counts, 
				'billing_counts' => $billing_counts, 
				'dt' => $dt
		]);
	
	}
	
	public function getSettings() {
	
		$employer = \User::with('employer_meta')
						->find($this->user->id);
		
// 		$surpass = $this->surpass('employer_logos', 1);
// 		$surpass->load($employer->employer_meta->image_file_id);
		$prefectures = ['' => '-'] + \JapanesePrefectures::prefectures();
		$prefecture_id = (Input::old('prefecture_id')) ? Input::old('prefecture_id') : $employer->employer_meta->prefecture_id;
		
		return View::make('employer.home.settings', [
// 				'surpass' => $surpass,
				'employer' => $employer,
				'prefectures' => $prefectures,
				'cities' => \Address::city_data($prefecture_id)
		]);
	
	}
	
	public function postSettingsConfirm() {
		
		$validator = \Employer::validator($this->user->id);
		
		if($validator->fails()) {
		
			return Redirect::back()
						->withInput()
						->withErrors($validator)
						->with('danger', trans('versatile.danger'));
		
		}
		
		$address = \Address::filterCityId(Input::get('city_id'))->first();
		
		return View::make('employer.home.settings_confirm', ['address' => $address]);
		
	}
	
	public function postSettingsComplete() {
		
		if(Input::exists('submit_revert')) {
			
			return Redirect::route('employer.settings')->withInput();
			
		}
		
		$validator = \Employer::validator($this->user->id);
		
		if($validator->fails()) {
		
			return Redirect::route('employer.settings')
						->withInput()
						->withErrors($validator)
						->with('danger', trans('versatile.danger'));
		
		}
		
		\Employer::saveData($this->user->id);
		return View::make('employer.home.settings_complete');
		
	}
	
// 	public function postSettings() {
		
// 		$id = $this->user->id;
// 		$validator = \Employer::validator($id);
		
// 		if($validator->fails()) {
		
// 			return Redirect::back()
// 					->withInput()
// 					->withErrors($validator)
// 					->with('danger', trans('versatile.danger'));
		
// 		}

// 		\Employer::saveData($id);
// 		return Redirect::route('employer.settings')->with('success', trans('versatile.success_edit'));
	
// 	}
	
	public function getContact() {
		
		$contact_types = \EmployerContactType::types();
		
		return View::make('employer.home.contact', [
				'contact_types' => $contact_types
		]);
		
	}
	
	public function postContactConfirm() {

		$validator = Validator::make(
				Input::only('pic_department', 'pic_name', 'pic_email', 'comment'),
				[
					'pic_department' => 'required',
					'pic_name' => 'required',
					'pic_email' => 'required|email',
					'comment' => 'required'
				]
		);
		$validator->setAttributeNames([
				'pic_department' => '担当部署',
				'pic_name' => '担当者名',
				'pic_email' => '担当者メールアドレス',
				'comment' => 'お問い合わせ内容'
		]);
		
		if($validator->fails()) {
		
			return Redirect::back()
						->withInput()
						->withErrors($validator)
						->with('danger', 'エラーが発生しました。');
		
		}
		
		return View::make('employer.home.contact_confirm');
		
	}
	
	public function postContactComplete() {
		
		if(Input::exists('submit_revert')) {
			
			return Redirect::route('employer.contact')->withInput();
			
		}
		
		$email_params = [
			'pic_department' => Input::get('pic_department'),
			'pic_name' => Input::get('pic_name'),
			'pic_email' => Input::get('pic_email'),
			'comment' => Input::get('comment')
		];
		
		\Mail::send('emails.employer.contact', $email_params, function($e) use ($email_params)
		{
			$e->to(Config::get('app.emails.admin'))
				->from($email_params['pic_email'], $email_params['pic_name'])
				->subject('【問い合わせ】企業様よりお問い合わせがありました。');
		});

        $email_params = [
            'name' => Input::get('pic_name'),
            'mail_body' => Input::get('comment')
        ];

        \Mail::send('emails.home.contact_user', $email_params, function($e)   // For users
        {
            $e->to(Input::get('pic_email'))
                ->from(Config::get('app.emails.contact'), Config::get('app.site_title') .'事務局')
                ->subject('お問い合わせ受付のご案内');
        });
		return View::make('employer.home.contact_complete');
		
	}
	
	public function getDeleteAccount() {
		
		return View::make('employer.home.delete_account');
		
	}
	
	public function postDeleteAccountConfirm() {
		
		$validator = Validator::make(
				Input::only('pic_department', 'pic_name', 'reason'),
				[
						'pic_department' => 'required',
						'pic_name' => 'required',
						'reason' => 'required'
				]
		);
		$validator->setAttributeNames([
				'pic_department' => '担当部署',
				'pic_name' => '担当者名',
				'reason' => '解約・退会理由'
		]);
		
		if($validator->fails()) {
		
			return Redirect::back()
						->withInput()
						->withErrors($validator)
						->with('danger', 'エラーが発生しました。');
		
		}
		
		return View::make('employer.home.delete_account_confirm');
		
	}
	
	public function postDeleteAccountComplete() {
		
		if(Input::exists('submit_revert')) {
				
			return Redirect::route('employer.delete_account')->withInput();
				
		}
		
		$employer = \User::with('employer_meta.address')->find($this->user->id);
		
		$email_params = [
				'pic_department' => Input::get('pic_department'),
				'pic_name' => Input::get('pic_name'),
				'reason' => Input::get('reason'), 
				'employer' => $employer
		];
		
// 		echo View::make('emails.employer.delete_account', $email_params)->render();die();
		
		\Mail::send('emails.employer.delete_account', $email_params, function($e) use ($email_params)
		{
			$e->to(Config::get('app.emails.admin'))
				->from($this->user->email, $email_params['pic_name'])
				->subject('【退会申請】企業様より退会の申請がありました。');
		});
		
		return View::make('employer.home.delete_account_complete');
		
	}
	
	public function billing() {
		
		$applied_years = ['' => '-'] + \Application::select()
							->joinJob()
							->filterEmployerId($this->user->id)
							->groupBy('applications.applied_year')
							->orderBy('applications.applied_year', 'DESC')
							->lists('applied_year', 'applied_year');
		
		$applications = \Application::select(
								'applications.applied_year', 
								'applications.applied_month', 
								\DB::raw('COUNT('. \DB::getTablePrefix() .'applications.id) AS COUNT')
							)
							->joinJob()
							->filterEmployerId($this->user->id)
							->groupBy('applications.applied_year', 'applications.applied_month')
							->orderBy('applications.created_at', 'DESC');
		
		if(Input::has('billing_year')) {
			
			$applications->filterAppliedYear(Input::get('billing_year'));
			
		}
		
		if(Input::has('billing_month')) {
			
			$applications->filterAppliedMonth(Input::get('billing_month'));
			
		}
		
		if(Input::has('billing_start_year')) {

			if(Input::has('billing_start_month')) {
				
				$dt = Carbon::createFromDate(Input::get('billing_start_year'), Input::get('billing_start_month'), 1);
					
			} else {

				$dt = Carbon::createFromDate(Input::get('billing_start_year'), 1, 1);
				
			}
			
			$applications->filterCreatedAtFuture($dt);
			
		}
		
		if(Input::has('billing_end_year')) {

			if(Input::has('billing_end_month')) {
				
				$dt = Carbon::createFromDate(Input::get('billing_end_year'), Input::get('billing_end_month')+1, 1);
					
			} else {

				$dt = Carbon::createFromDate(Input::get('billing_end_year'), 12, 31);
				
			}
			
			$applications->filterCreatedAtPast($dt);
			
		}
		
		$applications = $applications->paginate(5);
		
		return View::make('employer.home.billing', [
				'applications' => $applications, 
				'applied_years' => $applied_years
		]);
		
	}
	
}