<?php

use Carbon\Carbon;
class JobTableSeeder extends Seeder {

	public function run()
	{
		DB::table('jobs')->delete();
		
		for ($i = 1; $i <= 25; $i++) {
			
			$activated = rand(0, 1);
			
			$job = new Job;
			$job->user_id = rand(2, 3);
			$job->title = '求人のタイトル'. $i;
			$job->description = '仕事内容仕事内容仕事内容仕事内容仕事内容'. "\n" .'仕事内容仕事内容仕事内容仕事内容仕事内容仕事内容'. $i;
			$job->catch_phrase = 'キャッチコピー'. $i;
            $job->catch_text = '未経験の方でも安心して働ける職場です！駅近で通勤に便利。車での通勤もOKなので、子供の送り迎えもしやすい未経験の方でも安心して働ける職場です！駅近で通勤に便利。車での通勤もOKなので、子供の送り迎えもしやすい未経験の方でも安心して働ける職場です！駅近で通勤に便利。車での通勤もOKなので、子供の送り迎えもしやすい'. $i;
			$job->capacity = '応募資格'. $i ."#\n". '応募資格'. $i;
			$job->job_pattern = '雇用形態'. $i;
			$job->prefecture_id = rand(1, 47);
			$job->other_address = 'それ以降の住所'. $i;
			$job->transportation = 'JR○○駅から徒歩15分' ."\n". 'JR○○駅から徒歩15分';
			$job->duty_hours = '7:00〜19:00'."\n7:00〜19:00";
			$job->salary = '300,000円／月 '."\n3,500,000円／年";
			$job->holiday = '土日祝日'."\n土日祝日";
			$job->benefit = '厚生年金'."\n厚生年金";
			$job->choice_process = '一週間以内に検討'."\n一週間以内に検討";
			$job->interview_address = '東京都○○○○○○'."\n東京都○○○○○○";
			$job->pic_department = '担当部署';
			$job->pic_name = '担当者名';
			$job->pic_comment = '担当者のコメント担当者のコメント担当者のコメント'. "\n" .'担当者のコメント担当者のコメント';
			$job->notification_type = '2';
			$job->notification_email = 'test@example.com';
			$job->application_ceiling = rand(0, 10);
			$job->application_count = rand(0, 10);
			$job->recommended = rand(0, 1);
			$job->displayed = $activated;
			$job->activated = $activated;
			$job->released = Carbon::now()->addDays(5);
			$job->created_at = new Carbon();
			$job->updated_at = new Carbon();
			$job->save();
			
			foreach (['type', 'category', 'condition'] as $key) {
				
				$job_meta = new JobMeta;
				$job_meta->job_id = $job->id;
				$job_meta->meta_key = $key .'_id';
				$job_meta->meta_value = rand(1, 3);
				$job_meta->save();
				
			}
			
			foreach (['main_company', 'sub_company', 'sub_company', 'pic'] as $surpass_key) {
				
				$insert_id = Surpass::path(Config::get('app.pathes.upload'))
								->dir(str_plural($surpass_key))
								->insert(public_path('img/company.jpg'));

				$job_meta = new JobMeta;
				$job_meta->job_id = $job->id;
				$job_meta->meta_key = $surpass_key .'_image_file_id';
				$job_meta->meta_value = $insert_id;
				$job_meta->save();
				
			}
			
		}
		
	}

}