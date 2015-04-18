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
use Cartalyst\Sentry\Facades\Laravel\Sentry;

class ApplicantController extends \BaseController {

	protected $mode = 'admin';
	
	public function __construct() {
		
		View::share('data_name', '求職者');
		
	}
	
	/**
	 * Display a listing of the resource.
	 * GET /applicant
	 *
	 * @return  Response
	 */
	public function index()
	{
		$applicants = \User::select(
                                'users.id',
                                'users.last_name',
                                'users.account_id',
                                'users.email',
                                'applicant_metas.tel'
                            )
							->with('applicant_meta', 'applicant_meta.address')
							->joinGroup()
                            ->joinApplicantMeta()
							->filterGroupId(\Group::groupIdByName('applicant'));
		$applicants = SearchStrap::modelFilter($applicants, ['account_id', 'last_name', 'tel', 'email']);
		$applicants = Caruta::sort($applicants,
            ['applicant_metas.tel', 'users.last_name', 'users.email'],
		    ['id', 'DESC']
		);

		return View::make('admin.applicant.index', [
			'applicants' => $applicants->paginate(15), 
			'search_key' => $applicants->search_key, 
			'sort_flag' => (empty(Input::except(['page']))),
			'search_strap' => $this->search_strap() 
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /applicant/create
	 *
	 * @return  Response
	 */
// 	public function create()
// 	{
// 		return View::make('admin.applicant.create');
// 	}

	/**
	 * Store a newly created resource in storage.
	 * POST /applicant
	 *
	 * @return  Response
	 */
// 	public function store()
// 	{
// 		$validator = \Applicant::validator();
		
// 		if($validator->fails()) {
		
// 			return Redirect::back()
// 					->withInput()
// 					->withErrors($validator)
// 					->with('danger', trans('versatile.danger'));
		
// 		}
		
// 		$applicant = \Applicant::saveData();
// 		Cahen::move($applicant)->first('sort');
// 		return Redirect::back()->with('success', trans('versatile.success_create') .'（'. HTML::linkRoute('admin.applicant.index', trans('versatile.return')) .'）');
// 	}

	/**
	 * Display the specified resource.
	 * GET /applicant/{id}
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
	 * GET /applicant/{id}/edit
	 *
	 * @param    int  $id
	 * @return  Response
	 */
	public function edit($id)
	{
		$applicant = \User::with('applicant_meta.address')
						->find($id);
		$prefectures = ['' => '▼以下から選択'] + \JapanesePrefectures::prefectures();
		$prefecture_id = (Input::old('prefecture_id')) ? Input::old('prefecture_id') : $applicant->applicant_meta->prefecture_id;
		$cities = ['' => '▼以下から選択'] + \Address::city_data($prefecture_id);

		$applicant_job_category_ids = \ApplicantJobCategory::filterUserId($applicant->id)->lists('category_id');
		$applicant_job_type_ids = \ApplicantJobType::filterUserId($applicant->id)->lists('type_id');
		$applicant_job_locations = \ApplicantJobLocation::select('prefecture_id', 'city_id')
										->filterUserId($applicant->id)
										->get();
		
		return View::make('admin.applicant.edit', [
				'applicant' => $applicant,
				'prefectures' => $prefectures,
				'cities' => $cities, 
				'applicant_job_category_ids' => $applicant_job_category_ids, 
				'applicant_job_type_ids' => $applicant_job_type_ids, 
				'applicant_job_locations' => $applicant_job_locations
		]);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /applicant/{id}
	 *
	 * @param    int  $id
	 * @return  Response
	 */
	public function update($id)
	{
		$validator = \Applicant::validator($id, true);
		
		if($validator->fails()) {
		
			return Redirect::back()
					->withInput()
					->withErrors($validator)
					->with('danger', trans('versatile.danger'));
		
		}

		\Applicant::saveData($id, true);
		return Redirect::route('admin.applicant.index')->with('success', trans('versatile.success_edit'));
		
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /applicant/{id}
	 *
	 * @param    int  $id
	 * @return  Response
	 */
	public function destroy($id)
	{
		$this->delete($id);
		return Redirect::back()->with('success', trans('versatile.success_destroy'));
	}
	
	/**
	 * Remove the specified resource multiply from storage.
	 * POST /applicant/multi_delete
	 *
	 * @return  Response
	 */
	public function multi_delete()
	{
		$delete_ids = explode(',', Input::get('joined_delete_ids'));
		
		if(empty($delete_ids)) {

			return Redirect::back()->with('danger', trans('versatile.no_selected'));
			
		}
		
		foreach ($delete_ids as $delete_id) {
			
			$this->delete($delete_id);
			
		}
		
		return Redirect::back()->with('success', trans('versatile.success_destroy'));
	}
	
	public function signin($id) {
	
		$user = Sentry::findUserById($id);
		Sentry::login($user, false);
		return Redirect::route('home');
	
	}
	
	/**
	 * Update the specified resource position in storage.
	 * GET /applicant/sort/{id}/{to}
	 *
	 * @param    int  $id
	 * @return  Response
	 */
// 	public function sort($id, $to)
// 	{
// 		$applicant = \Applicant::find($id);
// 		Cahen::move($applicant)->to('sort', $to);
// 		return Redirect::back()->with('success', trans('versatile.success_sort'));
// 	}

	private function delete($id) {
	
		\DB::beginTransaction();
	
		try {
	
			$user = Sentry::findUserById($id);
			$user->delete();
			\ApplicantMeta::filterUserId($id)->delete();
			\ApplicantJobCategory::filterUserId($id)->delete();
			\ApplicantJobType::filterUserId($id)->delete();
			\ApplicantJobLocation::filterUserId($id)->delete();
			\DB::commit();
			return true;
	
		} catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
	
			\DB::rollback();
	
		}
	
		return false;
	
	}
	
}