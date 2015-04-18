<?php

use Sukohi\JapanesePrefectures\JapanesePrefectures;
use Carbon\Carbon;
class HomeController extends BaseController {


	public function getPreIndex() {
		
		echo View::make('home.index_pre')->render();
		die();
		
	}
	
	public function getIndex() {
/*
		$recommendations = Job::select()
								->filterValid()
								->filterRecommended(true)
								->orderBy('sort', 'ASC')
								->take(Config::get('app.recommendation_count'))
								->get();


		return View::make('home.index', [
				'recommendations' => $recommendations
		]);
*/
        $job_ids = [];
        $meta_keys = ['type_ids', 'category_ids', 'condition_ids'];
        
        if(Input::has($meta_keys[0]) 
                || Input::has($meta_keys[1])
                || Input::has($meta_keys[2])) {
            
            $job_metas = JobMeta::select('job_id');
                    
            foreach ($meta_keys as $meta_key) {
                
                if(Input::has($meta_key)) {
                    
                    $meta_values = Input::get($meta_key);

                    foreach ($meta_values as $meta_value) {

                        $job_metas->orWhere(function($query) use($meta_key, $meta_value) {
                        
                            $query->where('meta_key', str_singular($meta_key))
                                ->where('meta_value', $meta_value);
                        
                        });
                        
                    }
                    
                }
                
            }

            $job_ids = [-1] + $job_metas->lists('job_id');
            
        }
        
        $jobs = Job::select(
                        'jobs.id',
                        'jobs.title',
                        'jobs.description',
                        'jobs.user_id',
                        'jobs.catch_phrase',
                        'jobs.catch_text',
                        'jobs.job_pattern',
                        'jobs.transportation',
                        'jobs.salary',
                        'jobs.prefecture_id',
                        'jobs.other_address',
                        'jobs.updated_at'
                    )
                    ->filterValid()
                    ->with('metas', 'user')
                    ->filterRecommended(true)
                    ->joinEmployer()
                    ->orderBy('jobs.id', 'DESC');

        if(!empty($job_ids)) {
            
            $jobs->filterIds($job_ids);
            
        }
        
        if(Input::has('prefecture_id')) {
            
            $jobs->filterPrefectureId(Input::get('prefecture_id'));
            
        }

        if(Input::has('q')) {
            
            $keywords = explode(' ', mb_convert_kana(Input::get('q'), 's'));
            
            foreach ($keywords as $keyword) {
                
                if(!empty($keyword)) {
                    
                    $jobs->where(function($query) use($keyword) {
                        
                        $query->where('jobs.catch_phrase', 'LIKE', '%'. $keyword .'%')
                                ->orWhere('jobs.catch_text', 'LIKE', '%'. $keyword .'%')
                                ->orWhere('jobs.description', 'LIKE', '%'. $keyword .'%')
                                ->orWhere('jobs.capacity', 'LIKE', '%'. $keyword .'%')
                                ->orWhere('jobs.transportation', 'LIKE', '%'. $keyword .'%')
                                ->orWhere('users.last_name', 'LIKE', '%'. $keyword .'%');
                        
                    });
                    
                }
                
            }
            
        }
        
        $jobs = $jobs->paginate(Config::get('app.job_per_page'));
        $main_image_ids = [];

        if($jobs->count() > 0) {

            foreach ($jobs as $index => $job) {

                $meta_values = JobMeta::metaAssign($job->metas);
                $job->meta_values = $meta_values;

                if(!empty($meta_values['main_company_image_file_ids'])) {

                    foreach ($meta_values['main_company_image_file_ids'] as $main_image_id) {

                        $main_image_ids[] = $main_image_id;

                    }

                }

            }

        }

        $image_urls = ImageFile::urls($main_image_ids);

        $jobs2 = Job::select(
                        'jobs.id',
                        'jobs.title',
                        'jobs.description',
                        'jobs.user_id',
                        'jobs.catch_phrase',
                        'jobs.catch_text',
                        'jobs.job_pattern',
                        'jobs.transportation',
                        'jobs.salary',
                        'jobs.prefecture_id',
                        'jobs.other_address',
                        'jobs.updated_at'
                    )
                    ->filterValid()
                    ->with('metas', 'user')
                    ->joinEmployer()
                    ->orderBy('jobs.id', 'DESC');

        return View::make('home.index', [
                'recommendations' => $jobs,
                'image_urls' => $image_urls,
                'jobs' => $jobs2
        ]);
		
	}
	
	public function job() {

		$job_ids = [];
		$meta_keys = ['type_ids', 'category_ids', 'condition_ids'];
		
		if(Input::has($meta_keys[0]) 
				|| Input::has($meta_keys[1])
				|| Input::has($meta_keys[2])) {
			
			$job_metas = JobMeta::select('job_id');
					
			foreach ($meta_keys as $meta_key) {
				
				if(Input::has($meta_key)) {
					
					$meta_values = Input::get($meta_key);

					foreach ($meta_values as $meta_value) {

						$job_metas->orWhere(function($query) use($meta_key, $meta_value) {
						
							$query->where('meta_key', str_singular($meta_key))
								->where('meta_value', $meta_value);
						
						});
						
					}
					
				}
				
			}

			$job_ids = [-1] + $job_metas->lists('job_id');
			
		}
		
		$jobs = Job::select(
                        'jobs.id',
                        'jobs.title',
                        'jobs.description',
                        'jobs.user_id',
                        'jobs.catch_phrase',
                        'jobs.catch_text',
                        'jobs.job_pattern',
                        'jobs.transportation',
                        'jobs.salary',
                        'jobs.prefecture_id',
                        'jobs.other_address',
                        'jobs.updated_at'
                    )
                    ->filterValid()
					->with('metas', 'user')
                    ->joinEmployer()
                    ->orderBy('jobs.id', 'DESC');

		if(!empty($job_ids)) {
			
			$jobs->filterIds($job_ids);
			
		}
		
		if(Input::has('prefecture_id')) {
			
			$jobs->filterPrefectureId(Input::get('prefecture_id'));
			
		}

		if(Input::has('q')) {
			
			$keywords = explode(' ', mb_convert_kana(Input::get('q'), 's'));
			
			foreach ($keywords as $keyword) {
				
				if(!empty($keyword)) {
					
					$jobs->where(function($query) use($keyword) {
						
						$query->where('jobs.catch_phrase', 'LIKE', '%'. $keyword .'%')
								->orWhere('jobs.catch_text', 'LIKE', '%'. $keyword .'%')
								->orWhere('jobs.description', 'LIKE', '%'. $keyword .'%')
								->orWhere('jobs.capacity', 'LIKE', '%'. $keyword .'%')
								->orWhere('jobs.transportation', 'LIKE', '%'. $keyword .'%')
								->orWhere('users.last_name', 'LIKE', '%'. $keyword .'%');
						
					});
					
				}
				
			}
			
		}
		
		$jobs = $jobs->paginate(Config::get('app.job_per_page'));
        $main_image_ids = [];

        if($jobs->count() > 0) {

            foreach ($jobs as $index => $job) {

                $meta_values = JobMeta::metaAssign($job->metas);
                $job->meta_values = $meta_values;

                if(!empty($meta_values['main_company_image_file_ids'])) {

                    foreach ($meta_values['main_company_image_file_ids'] as $main_image_id) {

                        $main_image_ids[] = $main_image_id;

                    }

                }

            }

        }

        $image_urls = ImageFile::urls($main_image_ids);

		return View::make('home.job', [
				'jobs' => $jobs,
                'image_urls' => $image_urls
		]);
		
	}
	
	public function job_detail($id) {
		
		$job = Job::with('user.employer_meta', 'metas')->find($id);
        $meta_values = JobMeta::metaAssign($job->metas);
        $job->meta_values = $meta_values;
        $image_ids = [];

        foreach ($meta_values as $key => $image_file_ids) {

            if(in_array($key, ['main_company_image_file_ids', 'sub_company_image_file_ids', 'pic_image_file_ids'])) {

                foreach ($image_file_ids as $image_file_id) {

                    $image_ids[] = $image_file_id;

                }

            }


        }

        $image_urls = ImageFile::urls($image_ids);
		$consideration_flag = false;
		
		if($this->user != null) {
			
			$consideration_flag = \ApplicantConsideration::filterApplicantId($this->user->id)
										->filterJobId($id)
										->exists();

		}

        $job->meta_values = JobMeta::metaAssign($job->metas);

		return View::make('home.job_detail', [
				'job' => $job,
				'user' => $this->user,
                'image_urls' => $image_urls,
				'consideration_flag' => $consideration_flag
		]);
		
	}

    public function job_preview($id) {

        $job = \Job::with('user')->find($id);

        if(empty($this->user)
            || !$this->user->hasPermission('employer')
            || $this->user->id != $job->user->id) {

            return Redirect::route('home.job_detail', [$id]);

        }

        $view = $this->job_detail($id);
        $view->with('preview_flag', true);
        return $view;

    }
	
	public function new_job() {

        $jobs = Job::select(
            'jobs.id',
            'jobs.title',
            'jobs.description',
            'jobs.user_id',
            'jobs.catch_phrase',
            'jobs.catch_text',
            'jobs.job_pattern',
            'jobs.transportation',
            'jobs.salary',
            'jobs.prefecture_id',
            'jobs.other_address',
            'jobs.updated_at'
        )
        ->filterValid()
        ->with('metas', 'user')
        ->joinEmployer()
        ->orderBy('jobs.id', 'DESC')
        ->take(15)
        ->get();

        $main_image_ids = [];

        if($jobs->count() > 0) {

            foreach ($jobs as $index => $job) {

                $meta_values = JobMeta::metaAssign($job->metas);
                $job->meta_values = $meta_values;

                if(!empty($meta_values['main_company_image_file_ids'])) {

                    foreach ($meta_values['main_company_image_file_ids'] as $main_image_id) {

                        $main_image_ids[] = $main_image_id;

                    }

                }

            }

        }

        $image_urls = ImageFile::urls($main_image_ids);

		return View::make('home.new_job', [
				'jobs' => $jobs,
                'image_urls' => $image_urls,
		]);
		
	}
	
	public function company($id) {
		
		$employer = \User::with('employer_meta')->find($id);
		echo '<pre>'. print_r($employer, true) .'</pre>';
		return View::make('home.company', [
				'employer' => $employer
		]);
		
	}
	
	public function application($id) {
		
		$job = Job::with('metas')->find($id);
        $job->meta_values = JobMeta::metaAssign($job->metas);

		$prefectures = ['' => '▼以下から選択'] + \JapanesePrefectures::prefectures();
        $applicant = null;
		$applicant_meta = null;
		
		if($this->user != null && $this->user->hasPermission('applicant')) {

            $applicant = $this->user;
			$applicant_meta = ApplicantMeta::filterUserId($this->user->id)->first();
			
		}

		$prefecture_id = -1;
		
		if(Input::old('prefecture_id')) {
			
			$prefecture_id = Input::old('prefecture_id');
			
		} else if($applicant_meta != null) {
			
			$prefecture_id = $applicant_meta->prefecture_id;
			
		}

		$cities = ['' => '▼以下から選択'] + \Address::city_data($prefecture_id);

		return View::make('home.application', [
				'job' => $job, 
				'prefecture_id' => $prefecture_id, 
				'prefectures' => $prefectures, 
				'cities' => $cities, 
				'applicant' => $applicant,
				'applicant_meta' => $applicant_meta
		]);
		
	}

    public function application_confirm() {

        $validator = \Application::validator();

        if($validator->fails()) {

            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', trans('versatile.danger'));

        }

        $job = Job::with('metas')->find(Input::get('job_id'));

        return View::make('home.application_confirm', [
            'job' => $job
        ]);

    }
	
	public function application_complete() {

		$application = \Application::saveData();
		$job = Job::with('user')->find(Input::get('job_id'));

		$address = \Address::select('prefecture_name', 'city_name')
						->filterPrefectureId($application->prefecture_id)
						->first();

		$email_params = [
			'job' => $job,
			'application' => $application,
			'address' => $address
		];

        Mail::send('emails.home.application_for_applicant', $email_params, function($e) use($application)
        {
            $e->to($application->email)
                ->from(Config::get('app.emails.main'), Config::get('app.site_title') .'事務局')
                ->subject('求人応募完了のご案内');
        });

        Mail::send('emails.home.application_for_employer', $email_params, function($e) use($job)
        {
            $e->to($job->employer_email)
                ->bcc('oubo@callcenter-job.net')
                ->from(Config::get('app.emails.main'), Config::get('app.site_title'))
                ->subject('求人応募完了のご案内');
        });
		
		return Redirect::route('home.application', [
            Input::get('job_id'), 'done=true'
        ])->with('success', '求人応募は完了しました。記載いただいたメールアドレスに応募情報をお送りいたしますので<br>ご確認ください。応募先の企業から連絡が来るまでしばらくお待ち下さい。');

	}
	
//	public function getSignup() {
//
//		$prefectures = ['' => '▼以下から選択'] + \JapanesePrefectures::prefectures();
//		$prefecture_id = (Input::old('prefecture_id')) ? Input::old('prefecture_id') : '';
//		$cities = ['' => '▼以下から選択'] + \Address::city_data($prefecture_id);
//
//		return View::make('home.signup', [
//				'prefectures' => $prefectures,
//				'cities' => $cities
//		]);
//
//	}
//
//	public function postSignup() {
//
//		$validator = \Applicant::validator();
//
//		if($validator->fails()) {
//
//			return Redirect::back()
//						->withInput()
//						->withErrors($validator)
//						->with('danger', trans('versatile.danger'));
//
//		}
//
//		$activation_url = \Applicant::saveData();
//
//		if(!empty($activation_url)) {
//
//			Mail::send('emails.home.signup', ['activation_url' => $activation_url], function($e)
//			{
//				$e->to(Input::get('email'), Input::get('last_name') . Input::get('first_name') .'様')
//					->from(Config::get('app.emails.main'), Config::get('app.site_title'))
//					->subject('【'. \Config::get('app.site_title') .'】仮登録が完了しました。');
//			});
//
//			return Redirect::back()->with('success', '仮登録が完了しました。メールアドレスへ本登録するためのURLを送信しましたので、登録を完了させてください。');
//
//		}
//
//		return Redirect::back()
//					->withInput()
//					->withErrors($validator)
//					->with('danger', '予期せぬエラーが発生しました。');
//
//
//	}
	
	public function gift() {
		
		$application_values = [];
        $applicant = null;
        $applicant_meta = null;
		
		if($this->user != null && $this->user->hasPermission('applicant')) {

            $applicant = $this->user;
            $applicant_meta = ApplicantMeta::filterUserId($this->user->id)->first();
			$applications = \Application::select('applications.job_id')
								->filterUserId($this->user->id)
								->with('job')
								->get();
			
			if($applications->count() > 0) {
				
				foreach ($applications as $application) {
					
					if(!empty($application->job)) {
						
						$application_values[AccountId::text('job', $application->job_id)] = $application->job->title .'（'. $application->job_account_id .'）';
						
					}
					
				}
				
			}
			
		}
		
		return View::make('home.gift', [
				'application_values' => $application_values,
                'applicant' => $applicant,
                'applicant_meta' => $applicant_meta
		]);
		
	}

    public function giftConfirm() {

//        if($this->user != null) {
//
//            $count = \Gift::filterUserId($this->user->id)
//                        ->filterJobId(Input::get('job_id'))
//                        ->count();
//
//            if($count > 0) {
//
//                return Redirect::back()
//                    ->with('danger', 'この求人への申請はすでに完了しています。');
//
//            }
//
//        }

        $validator = \Gift::validator();

        if($validator->fails()) {

            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', trans('versatile.danger'));

        }

        return View::make('home.gift_confirm');

    }
	
	public function giftComplete() {

		\Gift::saveData();
        $job = \Job::find(AccountId::numeric(Input::get('job_id')));

        $email_params = [
            'job_title' => $job->title,
            'job_account_id' => Input::get('job_id'),
            'email' => Input::get('email'),
            'interview_date' => Input::get('interview_year') .'/'.Input::get('interview_month') .'/'.Input::get('interview_day'),
            'shipping_name' => Input::get('shipping_name'),
            'shipping_address' => Input::get('shipping_address')
        ];

        Mail::send('emails.home.gift', $email_params, function($e)   // For users
        {
            $e->to(Input::get('email'))
                ->from(Config::get('app.emails.contact'), Config::get('app.site_title') .'事務局')
                ->subject('お祝い金申請受付のご案内');
        });

		return Redirect::route('home.gift')
            ->with('success', 'お祝い金の申請が完了しました。');

	}
	
	public function contact() {
	
		return View::make('home.contact');
	
	}
	
	public function contact_confirm() {

        $subjects = ContactSubject::subjects();
		$validator = Validator::make(
				Input::only(['name', 'email', 'confirm_email', 'comment', 'subject']),
				[
                    'name' => 'required',
                    'email' => 'required|email',
                    'confirm_email' => 'required|email|same:email',
					'comment' => 'required',
					'subject' => 'required|in:'. implode(',', array_keys($subjects))
				]
		);
		$validator->setAttributeNames([
            'name' => 'お名前',
            'email' => 'メールアドレス',
            'confirm_email' => 'メールアドレス（確認）',
            'comment' => 'ご用件',
            'subject' => 'お問合わせ内容'
        ]);
	
		if($validator->fails()) {
	
			return Redirect::back()
					->withInput()
					->withErrors($validator)
					->with('danger', 'エラーが発生しました。');
	
		}

        return View::make('home.contact_confirm', [
            'subjects' => $subjects
        ]);
	
	}

    public function contact_complete() {

        $subjects = ContactSubject::subjects();
        $params = [
            'name' => Input::get('name'),
            'email' => Input::get('email'),
            'subject' => $subjects[Input::get('subject')],
            'mail_body' => Input::get('comment')
        ];

        Mail::send('emails.home.contact', $params, function($e)
        {
            $e->to(Config::get('app.emails.contact'))
                ->from(Input::get('email'), Config::get('app.site_title'))
                ->subject('お問い合わせがありました。');
        });

        Mail::send('emails.home.contact_user', $params, function($e)   // For users
        {
            $e->to(Input::get('email'))
                ->from(Config::get('app.emails.contact'), Config::get('app.site_title') .'事務局')
                ->subject('お問い合わせ受付のご案内');
        });

        return Redirect::route('home.contact', ['done=true'])
                    ->with('success', 'メッセージを送信しました。');

    }
	
	public function activation($id, $activation_code) {
		
		$result = false;
		
		try {
			
			$user = Sentry::findUserById($id);
			
			if ($user->attemptActivation($activation_code)) {
				
				$result = true;
				
			}
			
		} catch (Exception $e) {}
		
		return View::make('home.activation', ['result' => $result]);
		
	}
	
	public function postCityData() {
	
		$prefecture_id = Input::get('prefecture_id');
		$cities = [];
	
		if($prefecture_id > 0) {
				
			$cities = Address::select('city_id', 'city_name')
						->filterPrefectureId($prefecture_id)
						->lists('city_name', 'city_id');
				
		}
		
		echo json_encode($cities);
	
	}

    public function login() {

        return View::make('home.login');

    }

    public function reminder() {

        return View::make('home.reminder');

    }

    public function reminder_confirm() {

        try {

            $user = Sentry::findUserByLogin(Input::get('email'));

        } catch(Exception $e) {

            return Redirect::back()
                ->withInput()
                ->with('danger', 'このメールアドレスは登録されていません。');

        }

        if(!$user->hasPermission('applicant')) {

            return Redirect::back()
                    ->withInput()
                    ->with('danger', 'このメールアドレスは登録されていません。');

        }

        return View::make('home.reminder_confirm');

    }

    public function reminder_complete() {

        $user = Sentry::findUserByLogin(Input::get('email'));

        if(empty($user)) {

            return Redirect::back()
                        ->withInput()
                        ->with('danger', 'このメールアドレスは登録されていません。');

        }

        $new_password = str_random(10);
        $user->password = $new_password;
        $user->save();

        $params = [
            'email' => $user->email,
            'password' => $new_password
        ];

        Mail::send('emails.home.reminder', $params, function($e) use ($user)
        {
            $e->to($user->email)
                ->from(Config::get('app.emails.main'), Config::get('app.site_title') .'事務局')
                ->subject('【'. Config::get('app.site_title') .'事務局' .'】新パスワードのご送付');
        });

        return Redirect::route('home.reminder')
                    ->with('success', 'メールアドレスへ新しいパスワードを送信しました。');

    }
	
	public function announcement() {
		
		
		
	}
	
	public function announcement_detail($id) {

        $announcement = Announcement::filterId($id)
                            ->filterMode('all')
                            ->first();

		return View::make('home.announcement_detail', [
            'announcement' => $announcement
        ]);
		
	}

    public function newsletter() {

        return View::make('home.newsletter');

    }

    public function newsletter_confirm() {

        $validator = Validator::make(
            Input::only(['name', 'email', 'confirm_email', 'prefecture_id', 'job_types']),
            [
                'name' => 'required',
                'email' => 'required|email',
                'confirm_email' => 'required|email|same:email',
                'prefecture_id' => 'required',
                'job_types' => 'required'
            ]
        );
        $validator->setAttributeNames([
            'name' => 'お名前',
            'email' => 'メールアドレス',
            'confirm_email' => 'メールアドレス（確認）',
            'prefecture_id' => '配信希望地域',
            'job_types' => '配信希望職種（複数選択可）'
        ]);

        if($validator->fails()) {

            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', 'エラーが発生しました。');

        }

        return View::make('home.newsletter_confirm');

    }

    public function newsletter_complete() {

        $email_params = [
            'name' => Input::get('name'),
            'email' => Input::get('email'),
            'prefecture_name' => \JapanesePrefectures::prefectureName(Input::get('prefecture_id')),
            'job_type' => implode('、', NewsletterJobType::job_type_names(Input::get('job_types'))),
        ];

        Mail::send('emails.home.newsletter', $email_params, function($e)
        {
            $e->to(Config::get('app.emails.main'))
                ->from(Config::get('app.emails.main'), Config::get('app.site_title'))
                ->subject('【'. Config::get('app.site_title') .'】メールマガジンの申し込みがありました。');
        });

        Mail::send('emails.home.newsletter_for_user', $email_params, function($e)
        {
            $e->to(Input::get('email'))
                ->from(Config::get('app.emails.main'), Config::get('app.site_title') .'事務局')
                ->subject('メルマガ登録完了の案内');
        });

        return Redirect::route('home.newsletter')
                ->with('success', 'メールマガジンの登録が完了しました。');

    }

    public function quo() {

        return View::make('home.quo');

    }

    public function first() {

        return View::make('home.first');

    }

    public function for_offer() {

        return View::make('home.for_offer');

    }

    public function about_us() {

        return View::make('home.about_us');

    }

    public function privacy_policy() {

        return View::make('home.privacy_policy');

    }

    public function rules() {

        return View::make('home.rules');

    }
	
}
