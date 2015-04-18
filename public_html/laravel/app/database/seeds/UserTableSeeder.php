<?php

use Carbon\Carbon;
// Composer: "fzaninotto/faker": "v1.3.0"

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();
		DB::table('groups')->delete();
		DB::table('users_groups')->delete();
		
		$groups = [];
		
		foreach (['admin', 'employer', 'applicant'] as $type) {

			$groups[$type] = Sentry::createGroup([
					'name' => $type, 
					'permissions' => [$type => 1],
			]);
			
		}
		
		// Admin
		
		$user = Sentry::createUser([
			'email' => Config::get('app.emails.admin'),
			'password' => 'admin',
			'permissions' => ['admin' => 1],
			'last_name' => '管理者',
			'activated' => true,
		]);
		$user->addGroup($groups['admin']);
		
		// Employer

        $employer_password = 'test';

		for ($i = 0; $i < 2; $i++) {
			
			$user = Sentry::createUser([
				'email' => ($i == 0) ? 'employer@example.com' : 'employer2@example.com',
				'password' => $employer_password,
				'permissions' => ['employer' => 1],
				'last_name' => '株式会社 企業'. $i,
				'account_id' => AccountId::text('employer', ($i+1)), 
				'activated' => true
			]);
			$user->addGroup($groups['employer']);
			
			$employer_meta = new EmployerMeta;
			$employer_meta->user_id = $user->id;
			$employer_meta->foundation_date = Carbon::now();
			$employer_meta->representative = '代表者名'. ($i+1);
			$employer_meta->capital_stock = 1000;
			$employer_meta->employees = rand(8, 50);
			$employer_meta->business_content = "事業内容事業内容事業内容事業内容\n事業内容事業内容事業内容\n\n事業内容";
			$employer_meta->zip_code_1 = '131';
			$employer_meta->zip_code_2 = '0045';
			$employer_meta->prefecture_id = '13';
			$employer_meta->city_id = '13107';
			$employer_meta->other_address = '墨田区押上１丁目１−２';
			$employer_meta->building = '建物名';
			$employer_meta->pic_department = '人事部';
			$employer_meta->pic_name = '担当者名';
			$employer_meta->tel = '012345678900';
			$employer_meta->fax = '112345678900';
			$employer_meta->raw_password = $employer_password;
			$employer_meta->save();
		
		}
		
		// Applicant

		$applicant_data = [
				['last_name' => '山田太郎', 'last_name_kana' => 'やまだたろう', 'email' => 'applicant@example.com'],
				['last_name' => '佐藤二郎', 'last_name_kana' => 'さとうじろう', 'email' => 'applicant2@example.com'],
				['last_name' => '鈴木三郎', 'last_name_kana' => 'すずきさぶろう', 'email' => 'applicant3@example.com']
		];
		
		foreach ($applicant_data as $index =>  $applicant_values) {

			$user = Sentry::createUser([
					'email' => $applicant_values['email'],
					'password' => 'test',
					'permissions' => ['applicant' => 1],
					'last_name' => $applicant_values['last_name'],
					'account_id' => AccountId::text('applicant', ($index+1)),
					'activated' => true,
			]);
			$user->addGroup($groups['applicant']);
			
			$applicant_meta = new ApplicantMeta;
			$applicant_meta->user_id = $user->id;
			$applicant_meta->last_name_kana = $applicant_values['last_name_kana'];
			$applicant_meta->zip_code = '814-0001';
			$applicant_meta->prefecture_id = '40';
			$applicant_meta->city = '早良区';
            $applicant_meta->other_address_1 = '百道浜２−３−２６';
            $applicant_meta->other_address_2 = 'セゾン●●';
			$applicant_meta->birth_year = rand(1977, 1999);
			$applicant_meta->birth_month = rand(1, 12);
			$applicant_meta->birth_day = rand(1, 28);
			$applicant_meta->gender = rand(1, 2);
			$applicant_meta->tel = '0801234567'. rand(0, 9);
			$applicant_meta->current_job = '保育士';
			$applicant_meta->education = '○○大学○○学部';
			$applicant_meta->qualification = 'FP技能士２級、TOEIC 730点';
			$applicant_meta->career = '○○株式会社、▲▲商事';
			$applicant_meta->introduction = "明るく朗らかな性格です。";
			$applicant_meta->save();
			
			for ($i = 1; $i <= 3; $i++) {
			
				$applicant_job_category = new ApplicantJobCategory;
				$applicant_job_category->user_id = $user->id;
				$applicant_job_category->category_id = $i;
				$applicant_job_category->save();
					
			}
			
			foreach (['14' => '14115', '16' => '16343'] as $prefecture_id => $city_id) {
			
				$applicant_job_location = new ApplicantJobLocation;
				$applicant_job_location->user_id = $user->id;
				$applicant_job_location->prefecture_id = $prefecture_id;
				$applicant_job_location->city_id = $city_id;
				$applicant_job_location->save();
					
			}
			
			for ($i = 1; $i <= 3; $i++) {
			
				$applicant_job_type = new ApplicantJobType;
				$applicant_job_type->user_id = $user->id;
				$applicant_job_type->type_id = $i;
				$applicant_job_type->save();
			
			}
			
		}
		
	}

}