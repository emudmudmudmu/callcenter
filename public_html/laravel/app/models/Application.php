<?php

class Application extends Eloquent {
	
	protected $guarded = ['id'];

	// Loadings
	
	public function job() {
		
		return $this->hasOne('Job', 'id', 'job_id');
		
	}
	
	public function address() {
		
		return $this->hasOne('Address', 'city_id', 'city_id');
		
	}
	
	// Scopes

    public function scopeFilterUserId($query, $user_id) {

        return $query->where('applications.user_id', $user_id);

    }

    public function scopeFilterIds($query, $ids) {

        return $query->whereIn('applications.id', $ids);

    }
	
	public function scopeFilterName($query, $name) {
		
		return $query->where('applications.name', 'LIKE', '%'. $name .'%');
		
	}

    public function scopeFilterStatus($query, $status) {

        return $query->where('applications.status', $status);

    }
	
	public function scopeFilterStatusIds($query, $status_ids) {
		
		return $query->whereIn('applications.status', $status_ids);
		
	}
	
	public function scopeFilterCreatedAtFuture($query, $dt) {
		
		return $query->where('applications.created_at', '>=', $dt);
		
	}
	
	public function scopeFilterCreatedAtPast($query, $dt) {
		
		return $query->where('applications.created_at', '<=', $dt);
		
	}
	
	public function scopeFilterEmployedDateFuture($query, $dt) {
		
		return $query->where('applications.employed_date', '>=', $dt);
		
	}
	
	public function scopeFilterEmployedDatePast($query, $dt) {
		
		return $query->where('applications.employed_date', '<=', $dt);
		
	}
	
	public function scopeFilterAppliedYear($query, $year) {
		
		return $query->where('applications.applied_year', $year);
		
	}
	
	public function scopeFilterAppliedMonth($query, $month) {
		
		return $query->where('applications.applied_month', $month);
		
	}
	
	public function scopeFilterJobId($query, $job_id) {
		
		return $query->where('applications.job_id', $job_id);
		
	}
	
	public function scopeFilterJobTitle($query, $job_title) {
		
		return $query->where('jobs.title', 'LIKE', '%'. $job_title .'%');
		
	}

    public function scopeFilterTitle($query, $job_title) {

        return $query->where('jobs.title', 'LIKE', '%'. $job_title .'%');

    }
	
	public function scopeFilterEmployerId($query, $employer_id) {
		
		return $query->where('jobs.user_id', $employer_id);
		
	}
	
	public function scopeJoinJob($query) {
		
		return $query->join('jobs', 'applications.job_id', '=', 'jobs.id');
		
	}
	
	// Accessors
	
	public function getApplicantAccountIdAttribute() {
		
		if($this->attributes['applicant_id'] > 0) {
			
			return AccountId::text('applicant', $this->attributes['applicant_id']);
			
		}
		
		return '';
		
	}
	
	public function getJobAccountIdAttribute() {
		
		if($this->attributes['job_id'] > 0) {
			
			return AccountId::text('job', $this->attributes['job_id']);
			
		}
		
		return '';
		
	}
	
	public function getStatusTextAttribute() {
		
		$statuses = ApplicationStatus::application_statuses();
		return $statuses[$this->attributes['status']];
		
	}
	
	public function getCheckedIconAttribute() {
		
		return ($this->attributes['checked']) ? Camon::FA('check-square-o') : Camon::FA('square-o');
		
	}
	
	public function getBirthdayTextAttribute() {
		
		return $this->attributes['birth_year'] .'年'. $this->attributes['birth_month'] .'月'. $this->attributes['birth_day'] .'日';
		
	}
	
	public function getGenderTextAttribute() {
		
		return Gender::gender_name($this->attributes['gender']);
		
	}
	
	public function getFeeAttribute() {
		
		if(!isset($this->attributes['COUNT'])) {
			
			return 0;
			
		}
		
		return Config::get('app.application_fee') * $this->attributes['COUNT'];
		
	}
	
	// Others
	
	public static function validator() {
		
		$validator = Validator::make(
				Input::only([
					'job_id', 
					'name', 
					'kana', 
					'zip_code',
					'prefecture_id',
					'city',
					'other_address_1',
					'birth_year',
					'birth_month', 
					'birth_day', 
					'gender', 
					'tel', 
					'email',
					'job_type_id'
				]),
				[
					'job_id' => 'required|exists:jobs,id', 
					'name' => 'required', 
					'kana' => 'required', 
					'zip_code' => 'required',
					'prefecture_id' => 'required',
					'city' => 'required',
					'other_address_1' => 'required',
					'birth_year' => 'required',
					'birth_month' => 'required', 
					'birth_day' => 'required', 
					'gender' => 'required|in:1,2', 
					'tel' => 'required', 
					'email' => 'required',
					'job_type_id' => 'required'
				]
		);

        $validator->setAttributeNames([
            'job_id' => '仕事番号',
            'name' => '名前',
            'kana' => 'ふりがな',
            'zip_code' => '郵便番号',
            'prefecture_id' => '都道府県',
            'city' => '市区町村',
            'other_address_1' => '以降住所',
            'birth_year' => '誕生年',
            'birth_month' => '誕生月',
            'birth_day' => '誕生日',
            'gender' => '性別',
            'tel' => '電話番号',
            'email' => 'メールアドレス',
            'job_type_id' => '応募雇用形態'
        ]);
	
		return $validator;
	
	}
	
	public static function saveData($id = null) {

		$application = Application::firstOrNew(['id' => $id]);
		DB::beginTransaction();
	
		try {
	
			$user_id = 0;
			$user = Sentry::getUser();
				
			if($user != null && $user->hasPermission('applicant')) {
	
				$user_id = $user->id;
	
			}

            $job_id = Input::get('job_id');
			$application->user_id = $user_id;
			$application->job_id = $job_id;
			$application->job_type_id = Input::get('job_type_id');
			$application->name = Input::get('name');
			$application->kana = Input::get('kana');
			$application->zip_code = Input::get('zip_code');
			$application->prefecture_id = Input::get('prefecture_id');
			$application->city = Input::get('city');
			$application->other_address_1 = Input::get('other_address_1');
			$application->other_address_2 = Input::get('other_address_2');
			$application->birth_year = Input::get('birth_year');
			$application->birth_month = Input::get('birth_month');
			$application->birth_day = Input::get('birth_day');
			$application->gender = Input::get('gender');
			$application->tel = Input::get('tel');
			$application->email = Input::get('email');
			$application->current_job = Input::get('current_job');
			$application->education = Input::get('education');
			$application->qualification = Input::get('qualification');
			$application->career = Input::get('career');
			$application->introduction = Input::get('introduction');

			if(empty($id)) {

				$application->applied_year = date('Y');
				$application->applied_month = date('n');
				
			}
			
			$application->save();

            $job = Job::with('user')->find($job_id);
            $job->application_count = Application::filterJobId($job_id)->count();
            $job->push();

            if(empty($id)
                && $job->application_ceiling > 0
                && $job->application_ceiling <= $job->application_count) {

                Mail::send('emails.home.full_application', ['job' => $job], function($e) use($job)
                {
                    $e->to($job->employer_email, $job->user->last_name .'様')
                        ->from(Config::get('app.emails.main'), Config::get('app.site_title') .'事務局')
                        ->subject('求人応募上限達成の案内');
                });

                $job->displayed = 0;
                $job->activated = 0;
                $job->push();

            }

			DB::commit();
				
		} catch (Exception $e) {

			DB::rollback();

		}
	
		return $application;
	
	}
	
}