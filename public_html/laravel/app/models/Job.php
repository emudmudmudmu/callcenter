<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\HTML;
class Job extends Eloquent {
	
	protected $guarded = ['id'];
	private $global_scope = false;
	
	// Event
	
	public static function boot() {
		
		parent::boot();
	
		static::deleted(function($job) {

	    	$image_file_ids = JobMeta::filterJobId($job->id)
	    						->filterMetaKey('image_file_id')
	    						->lists('meta_value');
	    	
	    	if(!empty($image_file_ids)) {
	    		
	    		foreach ($image_file_ids as $image_file_id) {

	    			Surpass::path(Config::get('app.pathes.upload'))->removeById($image_file_id);
	    			
	    		}
	    		 
	    	}
	    	
	    	JobMeta::filterJobId($job->id)->delete();
	    	
	    });
	    
	}
	
	// Loadings
	
	public function metas()
	{
		return $this->hasMany('JobMeta');
	}
	
	public function applications()
	{
		return $this->hasMany('Application', 'job_id', 'id');
	}
	
	public function user()
	{
		return $this->hasOne('User', 'id', 'user_id');
	}
	
	public function prefecture()
	{
		return $this->hasOne('Address', 'prefecture_id', 'prefecture_id');
	}
	
	// Global scope
	
	public function newQuery() {

        if($this->checkRoute('employer')) {

            $user = Sentry::getUser();

            if(!$this->global_scope && $user != null && $user->hasPermission('employer')) {

                $this->global_scope = true;
                return parent::newQuery()->where('user_id', $user->id);

            }

        }
	
		return parent::newQuery();
	
	}

    private $check_routes = [
        'applicant' => false,
        'employer' => false,
        'admin' => false
    ];

    private function checkRoute($place) {

        if(isset($this->check_routes[$place]) && !$this->check_routes[$place]) {

            if(strpos(Route::currentRouteName(), $place .'.') === 0) {

                $this->check_routes[$place] = true;

            }

        } else {

            return false;

        }

        return $this->check_routes[$place];

    }
	
	// Scopes
	
	public function scopeFilterId($query, $id) {
		
		return $query->where('jobs.id', $id);
		
	}
	
	public function scopeFilterIds($query, $ids) {

        if(empty($ids)) {

            $ids = [-1];

        }

		return $query->whereIn('jobs.id', $ids);
		
	}
	
	public function scopeFilterUserId($query, $user_id) {
		
		return $query->where('jobs.user_id', $user_id);
		
	}
	
	public function scopeFilterTitle($query, $title) {
		
		return $query->where('jobs.title', 'LIKE', '%'. $title .'%');
		
	}
	
	public function scopeFilterDescription($query, $description) {
		
		return $query->where('jobs.description', 'LIKE', '%'. $description .'%');
		
	}
	
	public function scopeFilterActivated($query, $boolean) {
		
		return $query->where('jobs.activated', $boolean);
		
	}

	public function scopeFilterAccountId($query, $account_id) {

        $id = AccountId::numeric($account_id);
		return $query->where('jobs.id', $id);

	}
	
	public function scopeFilterExpired($query) {
		
		return $query->where('jobs.released', '<', Carbon::now());
		
	}
	
	public function scopeFilterUnexpired($query) {
		
		return $query->where(function($query) {
	
		    $query->where('jobs.released', '>=', Carbon::now())
		          ->orWhere('jobs.released', null);
		    
		});
		
	}
	
	public function scopeFilterHasApplicationCeiling($query) {
		
		return $query->where('jobs.application_ceiling', '>', '0');
		
	}
	
	public function scopeFilterDisplayed($query, $boolean) {
		
		return $query->where('jobs.displayed', $boolean);
		
	}
	
	public function scopeFilterValid($query) {

		return $query->where('jobs.activated', 1)
					->where('jobs.displayed', 1)
                    ->whereRaw('(application_ceiling = 0 OR (application_ceiling > 0 AND application_ceiling > application_count))')
                    ->where(function($query){

                        $query->where('released', '>=', Carbon::now())
                            ->orWhere('released', null);

                    });

	}

	public function scopeFilterInvalid($query) {

		return $query->orWhere('jobs.activated', 0)
					->orWhere('jobs.displayed', 0)
					->orWhere('jobs.released', '<', Carbon::now());

	}

	public function scopeFilterRecommended($query, $flag) {

		return $query->where('jobs.recommended', (int)$flag);

	}

	public function scopeFilterCreatedAt($query, $operator, $dt) {

		return $query->where('jobs.created_at', $operator, $dt);

	}

	public function scopeFilterSearch($query, $keyword) {

		return $query->where('jobs.title', 'LIKE', '%'. $keyword .'%')
					->orWhere('jobs.description', 'LIKE', '%'. $keyword .'%')
					->orWhere('jobs.catch_phrase', 'LIKE', '%'. $keyword .'%');

	}

	public function scopeFilterPrefectureId($query, $prefecture_id) {
		
		return $query->where('prefecture_id', $prefecture_id);
		
	}
	
	public function scopeJoinEmployer($query) {
		
		return $query->join('users', 'jobs.user_id', '=', 'users.id');
		
	}
	
	// Accesessors
	
	public function getAccountIdAttribute() {
		
		return AccountId::text('job', $this->attributes['id']);
		
	}
	
	public function getActivatedTextAttribute($value) {
		
		return ($this->attributes['activated']) ? '公開中' : '審査待ち';
		
	}
	
	public function getTagsAttribute($value) {
		
		return json_decode($value, true);
		
	}
	
	public function getReleasedAttribute($value) {
		
		if($this->attributes['released'] == null) {
			
			return null;
			
		}
		
		return new Carbon($this->attributes['released']);
		
	}
	
	public function getReleasedYearAttribute($value) {
		
		return ($this->attributes['released'] != null) ? with(new Carbon($this->attributes['released']))->format('Y') : '';
		
	}
	
	public function getReleasedMonthAttribute($value) {
		
		return ($this->attributes['released'] != null) ? with(new Carbon($this->attributes['released']))->format('m') : '';
		
	}
	
	public function getReleasedDayAttribute($value) {
		
		return ($this->attributes['released'] != null) ? with(new Carbon($this->attributes['released']))->format('d') : '';
		
	}

    public function getEmployerEmailAttribute() {

        if($this->relations) {

            $user_email = $this->getRelation('user')->email;
            return ($this->attributes['notification_type'] == 2) ? $this->attributes['notification_email'] : $user_email;

        }

        return '';

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

		$release_dt = Carbon::createFromDate(
							intval(Input::get('release_year')), 
							intval(Input::get('release_month')),
							intval(Input::get('release_day'))
						);

		$validator = Validator::make(
			Input::only([
				'title',
                'catch_phrase',
                'catch_text',
                'description',
                'capacity',
//				'job_pattern', 
				'prefecture_id', 
				'other_address', 
				'other_address2', 
				'transportation', 
				'duty_hours', 
				'salary', 
				'holiday', 
				'benefit', 
				'choice_process', 
				'interview_address', 
				'job_type_ids', 
				'job_category_ids', 
				'job_condition_ids', 
				'notification_email', 
				'notification_type', 
				'surpass_ids_main_companies', 
				'surpass_ids_sub_companies', 
				'application_ceiling_type_id', 
				'application_amount'
			]) + [
					'released_past' => $release_dt
			],
			[
				'title' => 'required', 
				'catch_phrase' => 'required',
                'catch_text' => 'required',
				'description' => 'required', 
				'capacity' => 'required',
//				'job_pattern' => 'required', 
				'prefecture_id' => 'required', 
				'other_address' => 'required', 
				'transportation' => 'required', 
				'duty_hours' => 'required', 
				'salary' => 'required', 
				'holiday' => 'required', 
				'benefit' => 'required', 
				'choice_process' => 'required', 
				'interview_address' => 'required', 
				'job_type_ids' => 'required', 
				'job_category_ids' => 'required', 
				'job_condition_ids' => 'required', 
				'notification_email' => 'required_if:notification_type,2|email', 
				'released_past' => 'today_and_future', 
				'surpass_ids_main_companies' => 'required', 
				'surpass_ids_sub_companies' => 'required|sub_company_images',
				'application_amount' => 'required_if:application_ceiling_type_id,1|numeric|between:1,100'
			], 
			[
				'required_if' => 'この項目は必須となります。', 
				'today_and_future' => '適切な未来の日付を指定してください。',
                'sub_company_images' => 'サブ画像は２枚必須となります。'
			]
		);
		
		$validator->setAttributeNames([
			'title' => '求人情報のタイトル', 
			'catch_phrase' => 'キャッチコピー',
            'catch_text' => 'キャッチテキスト',
			'description' => '仕事内容', 
			'capacity' => '応募資格',
//			'job_pattern' => '募集職種', 
			'prefecture_id' => '都道府県', 
			'other_address' => '勤務地', 
			'other_address2' => '勤務地(それ以降の住所)', 
			'transportation' => 'アクセス', 
			'duty_hours' => '勤務時間帯', 
			'salary' => '給与体系', 
			'holiday' => '休日休暇', 
			'benefit' => '福利厚生', 
			'choice_process' => '入社までの流れ', 
			'interview_address' => '所在地・面接会場', 
			'job_type_ids' => '雇用形態(検索用)', 
			'job_category_ids' => '該当職種(検索用)', 
			'job_condition_ids' => '該当条件(検索用)', 
			'surpass_ids_main_companies' => 'メイン画像', 
			'surpass_ids_sub_companies' => 'サブ画像', 
			'notification_email' => '通知用メールアドレス'
		]);
		
		return $validator;
		
	}
	
	public static function saveData($id = null, $extra_values = []) {

		$user = Sentry::getUser();
		$job = Job::firstOrNew(['id' => $id]);
		DB::beginTransaction();

		try {

			if($user->hasPermission('employer')) {
				
				$job->user_id = $user->id;
				
			}
			
			$application_ceiling_type_id = Input::get('application_ceiling_type_id');
			$application_ceiling = Input::get('application_amount');
			
			if($application_ceiling_type_id == 0) {
				
				$application_ceiling = 0;
				
			}
			
			$released = null;
			
			if(Input::get('release_type_id') == 1) {
				
				$released = Carbon::createFromDate(
								Input::get('release_year'),
								Input::get('release_month'),
								Input::get('release_day')
							);
				
			}

            if($user->hasPermission('admin')) {

                $job->activated = Input::get('activated');

            }

			$job->title = Input::get('title');
			$job->catch_phrase = Input::get('catch_phrase');
			$job->catch_text = Input::get('catch_text');
			$job->description = Input::get('description');
			$job->capacity = Input::get('capacity');
//			$job->job_pattern = Input::get('job_pattern');
			$job->prefecture_id = Input::get('prefecture_id');
			$job->other_address = Input::get('other_address');
			$job->other_address2 = Input::get('other_address2');
			$job->transportation = Input::get('transportation');
			$job->duty_hours = Input::get('duty_hours');
			$job->salary = Input::get('salary');
			$job->holiday = Input::get('holiday');
			$job->benefit = Input::get('benefit');
			$job->pic_department = Input::get('pic_department');
			$job->pic_name = Input::get('pic_name');
			$job->pic_comment = Input::get('pic_comment');
			$job->choice_process = Input::get('choice_process');
			$job->interview_address = Input::get('interview_address');
            $job->notification_type = Input::get('notification_type');
            $job->notification_email = Input::get('notification_email');
            $job->displayed = Input::get('displayed');
            $job->recommended = Input::get('recommended');
            $job->application_ceiling = $application_ceiling;
            $job->released = $released;

            if(!empty($id)) {

                $job->application_count = Application::filterJobId($id)->count();

            }

			$job->save();

			// Job Meta

			JobMeta::filterJobId($job->id)->delete();
			$keys = ['type', 'category', 'condition'];
			
			foreach ($keys as $key) {
				
				$meta_key = $key .'_id';
				$input_key = 'job_'. $key .'_ids';
							
				if(Input::has($input_key)) {
					
					$target_ids = Input::get($input_key);
					
					foreach ($target_ids as $target_id) {
					
						$job_meta = new JobMeta;
						$job_meta->job_id = $job->id;
						$job_meta->meta_key = $meta_key;
						$job_meta->meta_value = $target_id;
						$job_meta->save();
					
					}
					
				}
				
			}
			
			$surpass_keys = ['main_company', 'sub_company', 'pic'];
			
			foreach ($surpass_keys as $surpass_key) {
			
				$image_file_ids = Surpass::imageFileIds(str_plural($surpass_key));
			
				foreach ($image_file_ids as $image_file_id) {
				
					$job_meta = new JobMeta;
					$job_meta->job_id = $job->id;
					$job_meta->meta_key = $surpass_key .'_image_file_id';
					$job_meta->meta_value = $image_file_id;
					$job_meta->save();
				
				}
				
			}

            \Job::filterInvalid()->update(['sort' => 0]);
            $job_sort = \Job::select('id', 'sort')->filterRecommended(true)
                ->filterValid()
                ->orderBy('sort', 'ASC')
                ->get();
            \Cahen::align($job_sort, 'sort');

			DB::commit();
			
		} catch (Exception $e) {

			DB::rollback();
			
		}

		return $job;
		
	}
	
	public static function surpasses($surpass) {
		
		$surpasses = [];
		$surpass_keys = [
				'main_company' => 1,
				'sub_company' => 2,
				'pic' => 1
		];
		
		foreach ($surpass_keys as $surpass_key => $max_files) {

            $overwrite_flag = true;
            $button_label = '上書き';

            if($surpass_key == 'pic') {

                $overwrite_flag = false;
                $button_label = '削除';

            }

			$clone_surpass = clone $surpass;
			$clone_surpass->dir(str_plural($surpass_key))
                ->ids([
                        'input' => 'image_upload_'. $surpass_key,
                        'preview' => 'preview_images_'. $surpass_key
                ])
                ->overwrite($overwrite_flag)
                ->maxFiles($max_files)
                ->button($button_label);
			$clone_surpass->load();
			$surpasses[$surpass_key] = $clone_surpass;
				
		}
		
		return $surpasses;
		
	}

    public static function isNew($dt) {

        $new_mark_days = Config::get('app.new_mark_days');
        $base_dt = Carbon::now()->subDays($new_mark_days);
        return ($base_dt->lt($dt));

    }
	
}