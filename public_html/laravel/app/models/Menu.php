<?php

class Menu {
	
	public static function items($view_mode) {
		
		$items = [
			
			'admin' => [

				'GL:home' => 'admin.dashboard:ホーム',
				'GL:briefcase|求人情報' => [
					'admin.job.index:求人の一覧',
                    'admin.recommendation:おすすめ設定'
				],
				'GL:user|ユーザー' => [
					'admin.employer.create:企業の追加', 
					'admin.employer.index:企業の一覧', 
					'admin.applicant.index:求職者の一覧'
				],
				'GL:bullhorn|告知' => [
					'admin.all.announcement.index:サイト告知の一覧', 
					'admin.all.announcement.create:サイト告知を追加する', 
					'admin.employer.announcement.index:企業告知の一覧' , 
					'admin.employer.announcement.create:企業告知を追加する' 
				],
				'FA:gift|お祝い金' => [
					'admin.gift.index:申請の一覧'
				]
			
			], 
				
			'employer' => [

				'GL:home' => 'employer.dashboard:ホーム',
				'GL:briefcase|求人情報' => [
					'employer.job.create:求人情報の登録', 
					'employer.job.index:登録済み求人情報の一覧'
				], 
				'GL:user|求職者' => [
					'employer.applicant.index:求職者の一覧'
				], 
				'GL:file' => 'employer.application.index:応募情報',
				'GL:bullhorn' => 'employer.announcement.index:お知らせ',
				'FA:building-o' => 'employer.settings:企業情報の変更',
				'FA:envelope' => 'employer.contact:管理会社へのお問い合せ',
					
			]
			
		];
		
		$menu_items = $items[$view_mode];
		
		return $items[$view_mode];
		
	}
	
	public static function title($title_value) {

		$title_values = explode('|', $title_value);
		return Menu::icon($title_values[0]) .'<span>'. $title_values[1] .'</span>';
		
	}
	
	public static function link($item_value, $icon='') {
		
		$item_values = explode(':', $item_value);
		$icon = Menu::icon($icon);
		return Kuku::linkRoute($item_values[0], $icon . $item_values[1]);
		
	}
	
	public static function icon($icon_value) {
		
		if(empty($icon_value)) {
			
			return Camon::FA('angle-double-right');
			
		}
		$icon_values = explode(':', $icon_value);
		return Camon::$icon_values[0]($icon_values[1]);
		
	}
	
	public static function hasCurrent($item_values) {
		
		if(!is_array($item_values)) {
			
			$item_values = [$item_values];
			
		}
		
		foreach ($item_values as $key => $item_value) {
			
			list($route) = explode(':', $item_value);
			
			if(route($route) == URL::current()) {
				
				return true;
				
			}
		
		}
		
		return false;
		
	}
	
}