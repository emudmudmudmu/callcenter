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
use Illuminate\Filesystem\Filesystem;
use Carbon\Carbon;

class JobController extends \BaseController {

	protected $mode = 'employer';
	
	public function __construct() {
		
		View::share('data_name', '求人');
		
	}
	
	/**
	 * Display a listing of the resource.
	 * GET /job
	 *
	 * @return  Response
	 */
	public function index()
	{
		$jobs = \Job::orderBy('created_at', 'DESC');
		
		$jobs->where(function($query) {
			
			if(Input::exists('displayed')) {
			
				$query->orWhere('displayed', true);
			
			}
				
			if(Input::exists('undisplayed')) {

				$query->orWhere('displayed', false);
			
			}
			
		});

		$jobs->where(function($query) {
				
			if(Input::exists('activated')) {
					
				$query->orWhere('activated', true);
					
			}
		
			if(Input::exists('unactivated')) {
		
				$query->orWhere('activated', false);
					
			}
				
		});

		$jobs->where(function($query) {
				
			if(Input::exists('expired')) {
					
				$query->orWhere('released', '<', Carbon::now());
					
			}
		
			if(Input::exists('unexpired')) {
		
				$query->orWhere(function($query) {
			
				    $query->where('released', '>=', Carbon::now())
				          ->orWhere('released', null);
				    
				});
					
			}
				
		});

		$jobs->where(function($query) {
				
			if(Input::exists('valid')) {
				
				$query->orWhere('application_ceiling', 0)
						->orWhere(function($query) {
						
							$query->whereRaw('application_ceiling > application_count');
						
						});
					
			}
			
			if(Input::exists('invalid')) {
			
				$query->orWhere('application_ceiling', '>', 0)
						->where(function($query) {
					
							$query->whereRaw('application_ceiling <= application_count');
					
						});
						
			}
				
		});
		
		$jobs->where(function($query) {
			
			if(Input::has('q')) {

				$query->filterSearch(Input::get('q'));
				
			}
		
		});
		
		return View::make('employer.job.index', [
			'jobs' => $jobs->paginate(10)
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /job/create
	 *
	 * @return  Response
	 */
	public function create()
	{
		$surpass = $this->surpass('temp', 1);
		$surpasses = \Job::surpasses($surpass);
		$prefectures = ['' => '都道府県を選ぶ'] + \JapanesePrefectures::prefectures();
        $employer = \User::with('employer_meta')
                        ->find($this->user->id);
        $prefecture_id = (Input::old('prefecture_id')) ? Input::old('prefecture_id') : 0;
		$employer->employer_meta->prefecture_id = 0;

		return View::make('employer.job.create', [
                'employer' => $employer,
                'cities' => \Address::city_data($prefecture_id),
				'surpasses' => $surpasses, 
				'prefectures' => $prefectures
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /job
	 *
	 * @return  Response
	 */
	public function store()
	{
		if(Input::exists('submit_revert')) {
			
			return Redirect::route('employer.job.create')->withInput();
				
		}
		
		$validator = \Job::validator();
		
		if($validator->fails()) {
		
			return Redirect::route('employer.job.create')
					->withInput()
					->withErrors($validator)
					->with('danger', trans('versatile.danger'));
		
		}
		
		$job = \Job::saveData();
		return View::make('employer.job.complete');
		
	}

	/**
	 * Display the specified resource.
	 * GET /job/{id}
	 *
	 * @param    int  $id
	 * @return  Response
	 */
	public function show($id)
	{
		//
	}
	
	public function confirm() {

		$validator = \Job::validator();
		
		if($validator->fails()) {
		
			return Redirect::back()
						->withInput()
						->withErrors($validator)
						->with('danger', trans('versatile.danger'));
		
		}
		
		$images = [];
		
		foreach(['main_company', 'sub_company', 'pic'] as $key) {
			
			$ids = Surpass::imageFileIds(str_plural($key));
			$images[$key] = (!empty($ids)) ? \ImageFile::whereIn('id', $ids)->get() : [];
			
		}
        $address = \Address::filterCityId(Input::get('other_address'))->first();
		
		return View::make('employer.job.confirm', [
            'address' => $address, 
            'images' => $images]);
		
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /job/{id}/edit
	 *
	 * @param    int  $id
	 * @return  Response
	 */
	public function edit($id)
	{
		$surpass = $this->surpass('temp', 1);
		$surpasses = \Job::surpasses($surpass);
		$job = \Job::filterUserId($this->user->id)->find($id);
		$job_metas = \JobMeta::metaArray($job->id);

		foreach ($surpasses as $key => $surpass) {
			
			$meta_key = str_singular($key) .'_image_file_ids';
			$image_file_ids = (!empty($job_metas[$meta_key])) ? $job_metas[$meta_key] : [];
			$surpass->load($image_file_ids);
			
		}
		
		$prefectures = \JapanesePrefectures::prefectures();
        $employer = \User::with('employer_meta')
                        ->find($this->user->id);
        $prefecture_id = (Input::old('prefecture_id')) ? Input::old('prefecture_id') : $job->prefecture_id;
		
		return View::make('employer.job.edit', [
            'cities' => \Address::city_data($prefecture_id), 
			'job' => $job,
			'job_metas' => $job_metas, 
			'surpasses' => $surpasses, 
			'prefectures' => $prefectures
		]);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /job/{id}
	 *
	 * @param    int  $id
	 * @return  Response
	 */
	public function update($id)
	{
		if(Input::exists('submit_revert')) {
				
			return Redirect::route('employer.job.edit', [Input::get('id')])->withInput();
		
		}
		
		$validator = \Job::validator();
		
		if($validator->fails()) {
		
			return Redirect::back()
					->withInput()
					->withErrors($validator)
					->with('danger', trans('versatile.danger'));
		
		}

		\Job::saveData($id);
		return View::make('employer.job.complete');
// 		return Redirect::route('employer.job.index')->with('success', trans('versatile.success_edit'));
		
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /job/{id}
	 *
	 * @param    int  $id
	 * @return  Response
	 */
	public function destroy($id)
	{
		$job = \Job::filterUserId($this->user->id)->find($id)->delete();
		return Redirect::back()->with('success', trans('versatile.success_destroy'));
	}
	
	/**
	 * Remove the specified resource multiply from storage.
	 * POST /job/multi_delete
	 *
	 * @return  Response
	 */
	public function multi_delete()
	{
		$delete_ids = explode(',', Input::get('joined_delete_ids'));
		
		if(empty($delete_ids)) {

			return Redirect::back()->with('danger', trans('versatile.no_selected'));
			
		}
		
		$job = \Job::filterIds($delete_ids)->delete();
		return Redirect::back()->with('success', trans('versatile.success_destroy'));
	}
	
	/**
	 * Update the specified resource position in storage.
	 * GET /job/sort/{id}/{to}
	 *
	 * @param    int  $id
	 * @return  Response
	 */
	public function sort($id, $to)
	{
		$job = \Job::find($id);
		Cahen::move($job)->to('sort', $to);
		return Redirect::back()->with('success', trans('versatile.success_sort'));
	}
	
	/**
	 * Update the specified resource position in storage.
	 * GET /job/copy/{id}
	 *
	 * @param    int  $id
	 * @return  Response
	 */
	public function copy($id)
	{
		$job_values = \Job::select(
							'user_id', 
							'title', 
							'description', 
							'catch_phrase', 
							'catch_text',
							'capacity',
							'job_pattern', 
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
							'pic_department', 
							'pic_name', 
							'pic_comment', 
							'notification_type', 
							'notification_email', 
							'application_ceiling', 
							'displayed', 
							'released',
							'recommended'
						)
						->filterUserId($this->user->id)
						->find($id)
						->toArray();
		$copy_job = new \Job;
		
		if(empty($job_values)) {
			
			return Redirect::back()->with('success', 'コピーするデータが見つかりません。');
			
		}
		
		foreach ($job_values as $job_key => $job_value) {
			if($job_values == 'recommended') {
				$copy_job->$job_key = false;	
			}
			$copy_job->$job_key = $job_value;
			
		}
		
		$copy_job->recommended = false;
		$copy_job->activated = false;
		$copy_job->save();
		
		$job_metas = \JobMeta::filterJobId($id)->get();
		
		if($job_metas->count() > 0) {
			
			$image_keys = ['main_company_image_file_id', 'sub_company_image_file_id', 'pic_image_file_id'];
			
			foreach ($job_metas as $job_meta) {
				
				$copy_job_meta = new \JobMeta;
				$copy_job_meta->job_id = $copy_job->id;
				$copy_job_meta->meta_key = $job_meta->meta_key;
				
				if(in_array($job_meta->meta_key, $image_keys)) {
					
					$image_file = \ImageFile::find($job_meta->meta_value);
					$original_dir =  public_path(\Config::get('app.pathes.upload') .'/'. $image_file['dir']);
					$original_path = $original_dir .'/'. $image_file['filename'];
					$copy_filename = str_random(10) .'.'. $image_file['extension'];
					$copy_path = $original_dir .'/'. $copy_filename;
					$fs = new Filesystem();
					
					if($fs->copy($original_path, $copy_path)) {
						
						$copy_image_file = new \ImageFile;
						$copy_image_file->dir = $image_file->dir;
						$copy_image_file->filename = $copy_filename;
						$copy_image_file->extension = $image_file->extension;
						$copy_image_file->size = $image_file->size;
						$copy_image_file->attributes = $image_file->attributes;
						$copy_image_file->save();
						$copy_job_meta->meta_value = $copy_image_file->id;
						
					}
					
				} else {
					
					$copy_job_meta->meta_value = $job_meta->meta_value;
					
				}
				
				$copy_job_meta->save();
				
			}
			
		}

		return Redirect::back()->with('success', '複製が完了しました。');
	}
	
}