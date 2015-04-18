<?php namespace admin\announcement;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\HTML;
use Sukohi\Surpass\Facades\Surpass;
use Sukohi\Caruta\Facades\Caruta;
use Sukohi\Cahen\Facades\Cahen;
use Sukohi\SearchStrap\Facades\SearchStrap;

class EmployerAnnouncementController extends \BaseController {

	protected $mode = 'admin';
	private $announcement_mode = 'employer';
	
	public function __construct() {

		View::share('data_name', '企業向け告知');
		View::share('announcement_mode', $this->announcement_mode);
		
	}
	
	/**
	 * Display a listing of the resource.
	 * GET /announcement
	 *
	 * @return  Response
	 */
	public function index()
	{
		$announcements = \Announcement::filterMode($this->announcement_mode)
							->orderBy('id', 'DESC');
		
		return View::make('admin.announcement.index', [
			'announcements' => $announcements->paginate(15)
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /announcement/create
	 *
	 * @return  Response
	 */
	public function create()
	{
		return View::make('admin.announcement.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /announcement
	 *
	 * @return  Response
	 */
	public function store()
	{
		$validator = \Announcement::validator();
		
		if($validator->fails()) {
		
			return Redirect::back()
					->withInput()
					->withErrors($validator)
					->with('danger', trans('versatile.danger'));
		
		}
		
		$announcement = \Announcement::saveData();
		return Redirect::back()->with('success', trans('versatile.success_create') .'（'. HTML::linkRoute('admin.'. Input::get('mode') .'.announcement.index', trans('versatile.return')) .'）');
	}

	/**
	 * Display the specified resource.
	 * GET /announcement/{id}
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
	 * GET /announcement/{id}/edit
	 *
	 * @param    int  $id
	 * @return  Response
	 */
	public function edit($id)
	{
		$announcement = \Announcement::find($id);
		
		return View::make('admin.announcement.edit', [
			'announcement' => $announcement
		]);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /announcement/{id}
	 *
	 * @param    int  $id
	 * @return  Response
	 */
	public function update($id)
	{
		$validator = \Announcement::validator();
		
		if($validator->fails()) {
		
			return Redirect::back()
					->withInput()
					->withErrors($validator)
					->with('danger', trans('versatile.danger'));
		
		}

		\Announcement::saveData($id);
		return Redirect::route('admin.'. Input::get('mode') .'.announcement.index')->with('success', trans('versatile.success_edit'));
		
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /announcement/{id}
	 *
	 * @param    int  $id
	 * @return  Response
	 */
	public function destroy($id)
	{
		$announcement = \Announcement::find($id)->delete();
		return Redirect::back()->with('success', trans('versatile.success_destroy'));
	}
	
	/**
	 * Remove the specified resource multiply from storage.
	 * POST /announcement/multi_delete
	 *
	 * @return  Response
	 */
	public function multi_delete()
	{
		$delete_ids = explode(',', Input::get('joined_delete_ids'));
		
		if(empty($delete_ids)) {

			return Redirect::back()->with('danger', trans('versatile.no_selected'));
			
		}
		
		$announcement = \Announcement::filterIds($delete_ids)->delete();
		return Redirect::back()->with('success', trans('versatile.success_destroy'));
	}
	
	/**
	 * Update the specified resource position in storage.
	 * GET /announcement/sort/{id}/{to}
	 *
	 * @param    int  $id
	 * @return  Response
	 */
	public function sort($id, $to)
	{
		$announcement = \Announcement::find($id);
		Cahen::move($announcement)->to('sort', $to);
		return Redirect::back()->with('success', trans('versatile.success_sort'));
	}
	
}