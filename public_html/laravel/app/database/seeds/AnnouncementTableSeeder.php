<?php

class AnnouncementTableSeeder extends Seeder {

	public function run()
	{
		DB::table('announcements')->delete();
		$modes = ['all', 'employer'];
		
		for ($i = 0; $i < 50; $i++) {
			
			$announcement = new Announcement;
			$announcement->title = 'テストのお知らせタイトル'. $i;
			$announcement->description = "テストのお知らせ内容テストのお知らせ内容テストのお知らせ\n内容テストのお知らせ内容テストのお知らせ\n\n内容テストのお知らせ内容テストのお知らせ内容テストのお知らせ内容\n\n<a href=\"\">リンクテスト</a>　". $i;
			$announcement->mode = $modes[rand(0, 1)];
			$announcement->save();
			
		}
		
	}

}