<?php namespace employer;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
class AnnouncementController extends \BaseController {
	
	protected $mode = 'employer';
	
	public function __construct() {
	
		View::share('data_name', 'お知らせ');
	
	}
	
	public function index() {

		$announcements = \Announcement::filterMode('employer')
							->orderBy('id', 'DESC')
							->paginate(10);
		
		return View::make('employer.announcement.index', [
				'announcements' => $announcements
		]);
	
	}
	
	public function detail($id) {

		$announcement = \Announcement::filterId($id)->first();
		
		return View::make('employer.announcement.detail', [
				'announcement' => $announcement
		]);
	
	}
	
}