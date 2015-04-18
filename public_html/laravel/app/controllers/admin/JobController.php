<?php namespace admin;

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

class JobController extends \BaseController {

	protected $mode = 'admin';
	
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
		$jobs = \Job::select();
		$jobs = SearchStrap::modelFilter($jobs, ['account_id', 'title', 'activated']);
		$jobs = Caruta::sort($jobs, 
		    ['title'], 
		    ['created_at', 'DESC']
		);
		
		return View::make('admin.job.index', [
			'jobs' => $jobs->paginate(15), 
			'search_key' => $jobs->search_key, 
			'sort_flag' => (empty(Input::except(['page']))),
			'search_strap' => $this->search_strap() 
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
		$surpass = $this->surpass('companies', 4);
		$surpass->load();
		$prefectures = ['' => '▼以下から選択'] + \JapanesePrefectures::prefectures();
		
		return View::make('admin.job.create', [
				'surpass' => $surpass, 
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
		$validator = \Job::validator();
		
		if($validator->fails()) {
		
			return Redirect::back()
					->withInput()
					->withErrors($validator)
					->with('danger', trans('versatile.danger'));
		
		}
		
		$job = \Job::saveData();
		return Redirect::back()->with('success', trans('versatile.success_create') .'（'. HTML::linkRoute('admin.job.index', trans('versatile.return')) .'）');
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
		$job = \Job::find($id);
		$job_metas = \JobMeta::metaArray($job->id);

		foreach ($surpasses as $key => $surpass) {
			
			$meta_key = str_singular($key) .'_image_file_ids';
			
			if(!empty($job_metas[$meta_key])) {
			
				$surpass->load($job_metas[$meta_key]);
					
			}
			
		}
		
		$prefectures = \JapanesePrefectures::prefectures();
		
		return View::make('admin.job.edit', [
			'job' => $job,
			'job_metas' => $job_metas, 
			'surpasses' => $surpasses, 
			'prefectures' => $prefectures,
			'cities' => \Address::city_data($job->prefecture_id)
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
		$validator = \Job::validator();
		
		if($validator->fails()) {
			
			return Redirect::back()
					->withInput()
					->withErrors($validator)
					->with('danger', trans('versatile.danger'));
		
		}

		\Job::saveData($id);
		return Redirect::route('admin.job.index')->with('success', trans('versatile.success_edit'));
		
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
		$job = \Job::find($id)->delete();
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
	
}