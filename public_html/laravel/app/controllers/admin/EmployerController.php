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
use Carbon\Carbon;

class EmployerController extends \BaseController {

	protected $mode = 'admin';
	
	public function __construct() {
		
		View::share('data_name', '企業');
		
	}
	
	/**
	 * Display a listing of the resource.
	 * GET /employer
	 *
	 * @return  Responsed
	 */
	public function index()
	{
		$employers = \User::select(
                            'users.id',
                            'users.account_id',
                            'users.last_name',
                            'users.email',
                            'employer_metas.prefecture_id',
                            'employer_metas.city_id',
                            'employer_metas.other_address',
                            'employer_metas.tel',
                            'employer_metas.pic_department',
                            'employer_metas.pic_name'
                        )
                        ->with('employer_meta.address', 'employer_jobs')
						->joinGroup()
                        ->joinEmployerMeta()
						->filterGroupId($this->groupId());

		$employers = SearchStrap::modelFilter($employers, ['account_id', 'last_name', 'tel', 'email']);
		$employers = Caruta::sort($employers,
				['employer_metas.tel', 'users.last_name', 'users.email'],
				['users.id', 'DESC']
		);

		return View::make('admin.employer.index', [
				'employers' => $employers->paginate(15),
				'search_key' => $employers->search_key,
				'sort_flag' => (empty(Input::except(['page']))),
				'search_strap' => $this->search_strap()
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /employer/create
	 *
	 * @return  Response
	 */
	public function create()
	{
		$prefectures = ['' => '▼以下から選択'] + \JapanesePrefectures::prefectures();
		$password = str_random(7);
		
		return View::make('admin.employer.create', [
				'prefectures' => $prefectures,
				'cities' => \Address::city_data(Input::old('prefecture_id')), 
				'password' => $password
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /employer
	 *
	 * @return  Response
	 */
	public function store()
	{
		$validator = \Employer::validator();
		
		if($validator->fails()) {
		
			return Redirect::back()
					->withInput()
					->withErrors($validator)
					->with('danger', trans('versatile.danger'));
		
		}
		
		$employer = \Employer::saveData();
		return Redirect::back()->with('success', trans('versatile.success_create') .'（'. HTML::linkRoute('admin.employer.index', trans('versatile.return')) .'）');
	}

	/**
	 * Display the specified resource.
	 * GET /employer/{id}
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
	 * GET /employer/{id}/edit
	 *
	 * @param    int  $id
	 * @return  Response
	 */
	public function edit($id)
	{
		$employer = \User::with('employer_meta.address')
						->find($id);
		$prefectures = \JapanesePrefectures::prefectures();
		$prefecture_id = (Input::old('prefecture_id')) ? Input::old('prefecture_id') : $employer->employer_meta->prefecture_id;

		return View::make('admin.employer.edit', [
			'employer' => $employer,
			'prefectures' => $prefectures,
			'cities' => \Address::city_data($prefecture_id)
		]);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /employer/{id}
	 *
	 * @param    int  $id
	 * @return  Response
	 */
	public function update($id)
	{
		$validator = \Employer::validator($id);
		
		if($validator->fails()) {
		
			return Redirect::back()
					->withInput()
					->withErrors($validator)
					->with('danger', trans('versatile.danger'));
		
		}

		\Employer::saveData($id);
		return Redirect::route('admin.employer.index')->with('success', trans('versatile.success_edit'));
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /employer/{id}
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
	 * POST /employer/multi_delete
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
		return Redirect::route('employer.dashboard');
		
	}
	
	private function delete($id) {
		
		\DB::beginTransaction();
		
		try {
				
			$user = Sentry::findUserById($id);
			$user->delete();
			\EmployerMeta::filterUserId($id)->delete();
			\DB::commit();
			return true;
				
		} catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
				
			\DB::rollback();
				
		}
		
		return false;
		
	}
	
	/**
	 * Update the specified resource position in storage.
	 * GET /employer/sort/{id}/{to}
	 *
	 * @param    int  $id
	 * @return  Response
	 */
// 	public function sort($id, $to)
// 	{
// 		$employer = \Employer::find($id);
// 		Cahen::move($employer)->to('sort', $to);
// 		return Redirect::back()->with('success', trans('versatile.success_sort'));
// 	}
	
	private function groupId() {
		
		$group = \Sentry::findGroupByName('employer');
		return $group->id;
		
	}
	
}