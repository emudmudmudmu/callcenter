<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\HTML;
class Applicant {
	
	protected $guarded = ['id'];
	public $activationCode = '';
	
	public static function validator($id = '', $admin_flag = false) {

        $prefectures = JapanesePrefectures::prefectures();
        $data = Input::only([
            'name',
            'kana',
            'zip_code',
            'prefecture_id',
            'city',
            'other_address_1',
            'birth_year',
            'birth_month',
            'birth_day',
            'tel',
            'email',
            'password',
            'confirm_password'
        ]);
        $rules = [
            'name' => 'required',
            'kana' => 'required',
            'zip_code' => 'required',
            'prefecture_id' => 'required|in:'. implode(',', array_keys($prefectures)),
            'city' => 'required',
            'other_address_1' => 'required',
            'birth_year' => 'required',
            'birth_month' => 'required|between:1,12',
            'birth_day' => 'required|between:1,31',
            'tel' => 'required',
            'email' => 'required|email|unique:users,email,'. $id,
            'password' => 'required|min:'. Config::get('app.password.min') .'|max:'. Config::get('app.password.max'),
            'confirm_password' => 'required|same:password'
        ];

        if($admin_flag) {

            unset(
                $data['password'],
                $data['confirm_password'],
                $rules['password'],
                $rules['confirm_password']
            );

        }

        $validator = Validator::make($data, $rules);
        $validator->setAttributeNames([
            'name' => '名前',
            'kana' => 'ふりがな',
            'zip_code' => '郵便番号',
            'prefecture_id' => '都道府県',
            'city' => '市区町村',
            'other_address_1' => '以降住所',
            'birth_year' => '誕生年',
            'birth_month' => '誕生月',
            'birth_day' => '誕生日',
            'tel' => '電話番号',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
            'confirm_password' => 'パスワード'
        ]);
		return $validator;
		
	}
	
	public static function saveData($user_id = '', $admin_flag = false) {
		
		DB::beginTransaction();
		
		try {

            if(!empty($user_id)) {

                $user = Sentry::findUserById($user_id);echo '<pre>'. print_r($user->toArray(), true) .'</pre>';
                $user->email = Input::get('email');
                $user->last_name = Input::get('name');

                if(!$admin_flag) {

                    $user->password = Input::get('password');

                }

                $user->save();

            } else {

                $new_account_id = User::newAccountId('applicant');
                $group = Sentry::findGroupById(3);
                $user = Sentry::createUser([
                    'email' => Input::get('email'),
                    'password' => Input::get('password'),
                    'permissions' => ['applicant' => 1],
                    'last_name' => Input::get('name'),
                    'account_id' => $new_account_id,
                    'activated' => true
                ]);
                $user->addGroup($group);
                $user_id = $user->id;

            }

            $applicant_meta = ApplicantMeta::firstOrNew(['user_id' => $user_id]);
            $applicant_meta->user_id = $user_id;
            $applicant_meta->last_name_kana = Input::get('kana');
            $applicant_meta->zip_code = Input::get('zip_code');
            $applicant_meta->prefecture_id = Input::get('prefecture_id');
            $applicant_meta->city = Input::get('city');
            $applicant_meta->other_address_1 = Input::get('other_address_1');
            $applicant_meta->other_address_2 = Input::get('other_address_2');
            $applicant_meta->birth_year = Input::get('birth_year');
            $applicant_meta->birth_month = Input::get('birth_month');
            $applicant_meta->birth_day = Input::get('birth_day');
            $applicant_meta->gender = Input::get('gender');
            $applicant_meta->tel = Input::get('tel');
            $applicant_meta->current_job = Input::get('current_job');
            $applicant_meta->education = Input::get('education');
            $applicant_meta->qualification = Input::get('qualification');
            $applicant_meta->career = Input::get('career');
            $applicant_meta->introduction = Input::get('introduction');
            $applicant_meta->save();
			DB::commit();
            return true;
			
		} catch (Exception $e) {

			DB::rollback();

		}
		
		return false;
		
	}
	
	public static function activation_url($id, $activation_code) {
		
		return route('home.activation', [$id, $activation_code]);
		
	}
	
}