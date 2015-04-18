<?php namespace admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Sukohi\Caruta\Facades\Caruta;
use Sukohi\SearchStrap\Facades\SearchStrap;
use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Carbon\Carbon;

class HomeController extends \BaseController {
	
	protected $mode = 'admin';
	
	public function dashboard() {

		$user_counts = \User::select(
						'users_groups.group_id', 
						\DB::raw('COUNT('. \DB::getTablePrefix() .'users.id) AS COUNT')
					)
					->joinGroup()
					->groupBy('users_groups.group_id')
					->lists('COUNT', 'group_id');
		
		$job_counts = \Job::select(
						'jobs.activated', 
						\DB::raw('COUNT('. \DB::getTablePrefix() .'jobs.id) AS COUNT')
					)
					->groupBy('jobs.activated')
					->lists('COUNT', 'activated');
		
        $applications = \Application::joinJob()
                            ->orderBy('applications.id', 'DESC');
	
		return View::make('admin.home.dashboard', [
				'user_counts' => $user_counts, 
				'user_counts' => $user_counts, 
				'job_counts' => $job_counts, 
				'applications' => $applications,
		]);
	
	}
	
	public function getSettings() {
		
		return View::make('admin.home.settings');
		
	}
	
	public function postSettings() {
		
		$validator = Validator::make(
			Input::only(['email', 'confirm_email', 'password', 'confirm_password', 'captcha']),
			[
				'email' => 'required|email|same:confirm_email|unique:users,email,'. $this->user->id, 
				'confirm_email' => 'required|email', 
				'password' => 'required|same:confirm_password|min:'. Config::get('app.password.min') .'|max:'. Config::get('app.password.max'), 
				'confirm_password' => 'required|min:'. Config::get('app.password.min') .'|max:'. Config::get('app.password.max')
			]
		);
		$validator->setAttributeNames(Input::get('attribute_names'));
		
		if($validator->fails()) {
		
			return Redirect::back()
					->withInput(Input::except(['captcha']))
					->withErrors($validator)
					->with('danger', 'エラーが発生しました。');
		
		}
		
		try {
			
			$this->user->email = Input::get('email');
			$this->user->password = Input::get('password');
		
			if($this->user->save()) {
			
				return Redirect::back()->with('success', 'ログイン情報の変更が完了しました。');
				
			}
			
		} catch (\Exception $e) {}
		
		return Redirect::back()->with('danger', '予期せぬエラーにより失敗しました。');
		
	}
	
	public function getRecommendation() {
		
		$recommendations = \Job::select('id', 'title', 'sort')
								->filterRecommended(true)
								->filterValid()
								->orderBy('sort', 'ASC')
								->get();
		
		return View::make('admin.home.recommendation', [
				'recommendations' => $recommendations
		]);
		
	}
	
	public function postRecommendation($id) {
		
		$job = \Job::find($id);
		$job->recommended = false;
		$job->save();
		return Redirect::back()->with('success', 'おすすめ設定を解除しました。');
		
	}
	
	public function getRecommendationSort($id, $to) {

        $jobs = \Job::select('id', 'sort')->filterRecommended(true)
                    ->filterValid()
                    ->where('id', '<>', $id)
                    ->orderBy('sort', 'ASC')
                    ->get();

		\Job::filterInvalid()->update(['sort' => 0]);

		$job = \Job::find($id);
		\Cahen::move($job)
			->data($jobs)
			->to('sort', $to);
		return Redirect::back()->with('success', trans('versatile.success_sort'));
		
	}
	
	private function groupId() {
		
		$group = \Sentry::findGroupByName('employer');
		return $group->id;
		
	}
}