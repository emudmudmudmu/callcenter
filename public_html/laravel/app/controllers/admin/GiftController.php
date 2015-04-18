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

class GiftController extends \BaseController {

	protected $mode = 'admin';
	
	public function __construct() {
		
		View::share('data_name', 'お祝い金');
		
	}
	
	/**
	 * Display a listing of the resource.
	 * GET /gift
	 *
	 * @return  Response
	 */
	public function index()
	{
		$gifts = \Gift::orderBy('id', 'DESC');
		$gifts = SearchStrap::modelFilter($gifts, ['shipping_name', 'shipping_address', 'check_flag']);
		$gifts = Caruta::sort($gifts, 
		    ['created_at', 'DESC']
		);

		return View::make('admin.gift.index', [
			'gifts' => $gifts->paginate(15), 
			'search_key' => $gifts->search_key, 
			'sort_flag' => (empty(Input::except(['page']))),
			'search_strap' => $this->search_strap() 
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /gift/create
	 *
	 * @return  Response
	 */
// 	public function create()
// 	{
// 		$surpass = $this->surpass('companies', 4);
// 		$surpass->load();
// 		$prefectures = ['' => '▼以下から選択'] + \JapanesePrefectures::prefectures();
		
// 		return View::make('admin.gift.create', [
// 				'surpass' => $surpass, 
// 				'prefectures' => $prefectures
// 		]);
// 	}

	/**
	 * Store a newly created resource in storage.
	 * POST /gift
	 *
	 * @return  Response
	 */
// 	public function store()
// 	{
// 		$validator = \Gift::validator();
		
// 		if($validator->fails()) {
		
// 			return Redirect::back()
// 					->withInput()
// 					->withErrors($validator)
// 					->with('danger', trans('versatile.danger'));
		
// 		}
		
// 		$gift = \Gift::saveData();
// 		return Redirect::back()->with('success', trans('versatile.success_create') .'（'. HTML::linkRoute('admin.gift.index', trans('versatile.return')) .'）');
// 	}

	/**
	 * Display the specified resource.
	 * GET /gift/{id}
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
	 * GET /gift/{id}/edit
	 *
	 * @param    int  $id
	 * @return  Response
	 */
	public function edit($id)
	{
		$gift = \Gift::find($id);
		
		return View::make('admin.gift.edit', [
			'gift' => $gift
		]);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /gift/{id}
	 *
	 * @param    int  $id
	 * @return  Response
	 */
	public function update($id)
	{
		$gift = \Gift::find($id);
		$gift->check_flag = Input::get('check_flag');
		$gift->remarks = Input::get('remarks');
		$gift->save();

        $params = (Input::get('redirect_check_flag') != -1) ? 'check_flag='. Input::get('redirect_check_flag') : '';
		return Redirect::route('admin.gift.index', $params)
                    ->with('success', trans('versatile.success_edit'));
		
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /gift/{id}
	 *
	 * @param    int  $id
	 * @return  Response
	 */
// 	public function destroy($id)
// 	{
// 		$gift = \Gift::find($id)->delete();
// 		return Redirect::back()->with('success', trans('versatile.success_destroy'));
// 	}
	
	/**
	 * Remove the specified resource multiply from storage.
	 * POST /gift/multi_delete
	 *
	 * @return  Response
	 */
// 	public function multi_delete()
// 	{
// 		$delete_ids = explode(',', Input::get('joined_delete_ids'));
		
// 		if(empty($delete_ids)) {

// 			return Redirect::back()->with('danger', trans('versatile.no_selected'));
			
// 		}
		
// 		$gift = \Gift::filterIds($delete_ids)->delete();
// 		return Redirect::back()->with('success', trans('versatile.success_destroy'));
// 	}
	
	/**
	 * Update the specified resource position in storage.
	 * GET /gift/sort/{id}/{to}
	 *
	 * @param    int  $id
	 * @return  Response
	 */
	public function sort($id, $to)
	{
		$gift = \Gift::find($id);
		Cahen::move($gift)->to('sort', $to);
		return Redirect::back()->with('success', trans('versatile.success_sort'));
	}
	
}