<?php

use Carbon\Carbon;
class GiftTableSeeder extends Seeder {

	public function run()
	{
		DB::table('gifts')->delete();
		
		$names = ['0' => '山田太郎', '1' => '鈴木花子'];
		
		foreach ($names as $index => $name) {
			
			$gift = new Gift;
			$gift->job_id = 1;
			$gift->user_id = ($index == 0) ? null : 3;
			$gift->interview_date = Carbon::now()->subDays(3+$index);
			$gift->shipping_name = '山田 太郎'. $index;
            $gift->shipping_address = '〒131-0045 東京都墨田区押上１丁目１−２';
            $gift->email = 'test@example.com';
			$gift->memo = "メモのテストです。\nメモのテストです。\n\nメモのテストです。";
			$gift->save();
		}
		
	}

}