<?php

use Carbon\Carbon;
class BaseController extends Controller {

	protected $mode = '*';
	protected $user = null;
	
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if (!is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}

		$this->user = Sentry::getUser();
		View::share('view_mode', $this->mode);
		View::share('user', $this->user);
		
		if($this->mode == 'admin') {

			$this->admin_data();
			
		} else if($this->mode == 'employer') {
			
			$this->employer_data();
			
		} else {
			
			$this->home_data();
			
		}
		
	}
	
	protected function surpass($dir, $max_files=1) {
	
		return Surpass::path(Config::get('app.pathes.upload'))
					->maxFiles($max_files)
					->alert('画像は %d枚までアップロード可能です。')
					->dir($dir)
					->css([
							'div' => 'text-center pull-left padding-md',
							'button' => 'btn btn-default btn-flat btn-md margin-lg',
							'preview' => 'padding-sm clearfix',
							'loading' => 'pull-left text-muted bold padding-lg text-center'
					])
					->progress(HTML::image('img/ajax-loader.gif') .'<br>アップロード中...')
					->button('上書き');
	
	}
	
	protected function search_strap() {
	
		return SearchStrap::button('&nbsp;検索&nbsp;')->placeholder('検索ワードを入力..');
	
	}
	
	private function admin_data() {
		
		$notification_count = 0;
		$unactivated_job_count = Job::filterActivated(false)->count();
		View::share('unactivated_job_count', $unactivated_job_count);
		
		if($unactivated_job_count > 0) {
		
			$notification_count++;
				
		}
		
		$unchecked_gift_count = Gift::filterCheckFlag(false)->count();
		View::share('unchecked_gift_count', $unchecked_gift_count);
		
		if($unchecked_gift_count > 0) {
		
			$notification_count++;
				
		}
		
		View::share('notification_count', $notification_count);
		
	}

	private function employer_data() {
		
		$new_announcements = \Announcement::filterMode('employer')
							->orderBy('id', 'DESC')
							->get()
							->take(7);
		$consideration_count = \EmployerConsideration::filterEmployerId($this->user->id)->count();
		View::share('new_announcements', $new_announcements);
		View::share('consideration_count', $consideration_count);
		
	}
	
	private function home_data() {
		


		$new_announcements = Announcement::select(
								'id',
								'title',
								'description',
								'created_at'
							)
							->filterMode('all')
							->orderBy('id', 'DESC')
							->take(4)
							->get();
		
		$new_jobs = Job::select(
						'id',
						'title',
						'catch_phrase',
						'other_address',
                        'transportation',
						'salary',
						'prefecture_id'
					)
					->with([
						'metas' => function($query){
							$query->where('meta_key', 'main_company_image_file_id');
						},
						'metas.image_file',
						'prefecture'
					])
					->filterValid()
					->orderby('id', 'DESC')
					->take(2)
					->get();
		
		View::share('new_announcements', $new_announcements);
		View::share('new_jobs', $new_jobs);
		
	}
	
}
