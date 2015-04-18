<?php namespace applicant;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
class HomeController extends \BaseController {
	
	protected $mode = 'applicant';

    public function settings() {

        $applicant = \User::with('applicant_meta', 'applicant_meta.address')
            ->find($this->user->id);
        $prefectures = \JapanesePrefectures::prefectures();
        $prefecture_id = (Input::old('prefecture_id')) ? Input::old('prefecture_id') : $applicant->applicant_meta->prefecture_id;
        $cities = \Address::city_data($prefecture_id);

        $applicant_job_category_ids = \ApplicantJobCategory::filterUserId($applicant->id)->lists('category_id');
        $applicant_job_type_ids = \ApplicantJobType::filterUserId($applicant->id)->lists('type_id');
        $applicant_job_locations = \ApplicantJobLocation::select('prefecture_id', 'city_id')
            ->filterUserId($applicant->id)
            ->get();

        return View::make('applicant.home.settings', [
            'applicant' => $applicant,
            'prefectures' => $prefectures,
            'cities' => $cities,
            'applicant_job_category_ids' => $applicant_job_category_ids,
            'applicant_job_type_ids' => $applicant_job_type_ids,
            'applicant_job_locations' => $applicant_job_locations
        ]);

    }

    public function settings_confirm() {

        $validator = \Applicant::validator($this->user->id);

        if($validator->fails()) {

            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', trans('versatile.danger'));

        }

        return View::make('applicant.home.settings_confirm');

    }

    public function settings_complete() {

        \Applicant::saveData($this->user->id);
        return Redirect::route('applicant.settings')->with('success', trans('versatile.success_edit'));

    }
	
	public function getConsideration() {

        if (null == $this->user) {
            $jobs = array();
            $image_urls = array();
            return View::make('applicant.home.consideration', [
                    'jobs' => $jobs,
                    'image_urls' => $image_urls
            ]);
        }
        $job_ids = \ApplicantConsideration::filterApplicantId($this->user->id)->lists('job_id');
        $jobs = \Job::select(
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
        ->filterIds($job_ids)
        ->filterValid()
        ->with('metas', 'user')
        ->joinEmployer()
        ->orderBy('jobs.id', 'DESC')
        ->paginate(Config::get('app.job_per_page'));

        $main_image_ids = [];

        if($jobs->count() > 0) {

            foreach ($jobs as $index => $job) {

                $meta_values = \JobMeta::metaAssign($job->metas);
                $job->meta_values = $meta_values;

                if(!empty($meta_values['main_company_image_file_ids'])) {

                    foreach ($meta_values['main_company_image_file_ids'] as $main_image_id) {

                        $main_image_ids[] = $main_image_id;

                    }

                }

            }

        }

        $image_urls = \ImageFile::urls($main_image_ids);

		return View::make('applicant.home.consideration', [
				'jobs' => $jobs,
                'image_urls' => $image_urls
		]);
		
	}
	
	public function postConsideration() {
        if (null == $this->user) {
            $jobs = array();
            $image_urls = array();
            return View::make('applicant.home.consideration', [
                    'jobs' => $jobs,
                    'image_urls' => $image_urls
            ]);
        }
        		
		$job_id = Input::get('job_id');
		$applicant_id = $this->user->id;
		$flag = intval(Input::get('flag'));
		
		if($flag == 1) {
			
			$applicant_consideration = \ApplicantConsideration::firstOrNew([
					'job_id' => $job_id,
					'applicant_id' => $applicant_id
			]);
			$applicant_consideration->job_id = $job_id;
			$applicant_consideration->applicant_id = $applicant_id;
			$applicant_consideration->save();
			
		} else {
			
			\ApplicantConsideration::filterJobId($job_id)
					->filterApplicantId($applicant_id)
					->delete();
			
		}
		
		return Redirect::back()->with('success', 'リストへの追加が完了しました。');
		
	}

    public function getWithdraw() {

        $applicant = \User::with('applicant_meta', 'applicant_meta.address')
            ->find($this->user->id);

        return View::make('applicant.home.withdraw', [
            'applicant' => $applicant
        ]);

    }

    public function postWithdraw() {

        \DB::beginTransaction();

        try {

            $user_id = $this->user->id;
            $tables = ['applicant_metas', 'applications', 'gifts'];

            foreach ($tables as $table) {

                \DB::table($table)->where('user_id', $user_id)->delete();

            }


            $email_params = Input::only(['email', 'name']);

            \Mail::send('emails.auth.taikai', $email_params, function($e)
            {
                $e->to(Input::get('email'))
                    ->bcc(Config::get('app.emails.main'))
                    ->from(Config::get('app.emails.main'), Config::get('app.site_title') .'事務局')
                    ->subject('退会完了のご案内');
            });

            $this->user->delete();
            \DB::commit();

        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e){

            \DB::rollback();
            return Redirect::route('home')
                ->with('danger', '削除に失敗しました。管理者へ問い合わせてください。');

        }

        \Sentry::logout();

        return \Redirect::route('home.contact')
            ->with('danger', '退会が完了しました。これまで'. Config::get('app.site_title') .'をご利用いただきましてありがとうございました。');

    }
	
}