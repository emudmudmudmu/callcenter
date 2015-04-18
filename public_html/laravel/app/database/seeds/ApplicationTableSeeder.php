<?php

use Carbon\Carbon;
class ApplicationTableSeeder extends Seeder {

	public function run()
	{
		DB::table('applications')->delete();
		
		for ($i = 1; $i <= 30; $i++) {
			
			$dt = Carbon::now()->subMonths(rand(0, 3));
			
			$application = new Application;
			$application->job_id = rand(3, 5);
			$application->user_id = ($i < 2) ? 0 : rand(3, 5);
			$application->job_type_id = rand(1, 3);
			$application->name = '求職者名'. $i;
			$application->kana = 'きゅうしょくしゃめい'. $i;
			$application->zip_code = '814-000'. rand(0, 9);
			$application->prefecture_id = '40';
			$application->city = '早良区';
			$application->other_address_1 = '百道浜２−３−２６';
			$application->other_address_1 = 'メゾン●●';
			$application->birth_year = rand(1970, 1990);
			$application->birth_month = rand(1, 12);
			$application->birth_day = rand(1, 28);
			$application->gender = rand(1, 2);
			$application->tel = '0801234567'. rand(1, 9);
			$application->email = 'applicant'. $i .'@example.com';
			$application->current_job = '介護士';
			$application->education = '○○大学○○学部';
			$application->qualification = 'FP技能士２級、TOEIC 730点';
			$application->career = '○○株式会社、▲▲商事';
			$application->introduction = '明るく朗らかな性格です。';
			$application->memo = 'メモメモメモメモメモメモメモメモメモメモメモメモメモメモメモ';
			$application->status = array_rand(\ApplicationStatus::application_statuses());
			$application->employed_date = ($application->status == 3) ? Carbon::now()->subDays(rand(1, 5)) : null;
			$application->applied_year = $dt->format('Y');
			$application->applied_month = $dt->format('n');
			$application->created_at = $dt;
			$application->updated_at = $dt;
			$application->save();
			
		}
		
	}

}