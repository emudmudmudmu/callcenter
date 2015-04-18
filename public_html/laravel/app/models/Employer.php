<?php

use Carbon\Carbon;
class Employer {

	protected $guarded = ['id'];
	
	public static function validator($id = '') {
	
		$data = Input::only([
			
			'last_name', 
			'foundation_year', 
			'foundation_month', 
			'representative', 
			'capital_stock', 
			'employees',
			'business_content',
			'zip_code_1',
			'zip_code_2', 
			'prefecture_id', 
			'city_id', 
			'other_address', 
			'email', 
			'password', 
			'confirm_password'
				
		]);
		$rules = [
			
			'last_name' => 'required',
			'foundation_year' => 'required|numeric', 
			'foundation_month' => 'required|numeric', 
			'representative' => 'required', 
			'capital_stock' => 'required|numeric', 
			'employees' => 'required|numeric', 
			'business_content' => 'required',
			'zip_code_1' => 'required|numeric',
			'zip_code_2' => 'required|numeric', 
			'prefecture_id' => 'required|between:1,47', 
			'city_id' => 'required|numeric', 
			'other_address' => 'required', 
			'email' => 'required|email|unique:users,email,'. $id, 
			'password' => 'sometimes|required|min:'. Config::get('app.password.min') .'|max:'. Config::get('app.password.max'),
			'confirm_password' => 'sometimes|required|same:password'
				
		];
		$user = Sentry::getUser();
		
// 		if($user->hasPermission('admin')) {
		
// 			if(empty($id) || !empty(Input::get('password')) && !empty(Input::get('confirm_password'))) {
		
// 				$data += Input::only(['password', 'confirm_password']);
// 				$rules += [
// 						'password' => 'sometimes|required|min:'. Config::get('app.password.min') .'|max:'. Config::get('app.password.max'),
// 						'confirm_password' => 'sometimes|required|same:password'
// 				];
		
// 			}
				
// 		}
		$data['capital_stock'] = str_replace(',', '', $data['capital_stock']);
		$data['employees'] = str_replace(',', '', $data['employees']);

		$validator = Validator::make($data, $rules);
		$validator->setAttributeNames([
				'last_name' => '企業名',
				'foundation_year' => '設立年',
				'foundation_month' => '設立月',
				'representative' => '代表者',
				'capital_stock' => '資本金',
				'employees' => '従業員数',
				'business_content' => '事業内容',
				'zip_code_1' => '郵便番号1',
				'zip_code_2' => '郵便番号2',
				'prefecture_id' => '都道府県',
				'city_id' => '市町村',
				'other_address' => '番地',
				'email' => 'メールアドレス',
				'password' => 'パスワード',
				'confirm_password' => 'パスワード(確認用)'
		]);
	
		return $validator;
	
	}
	
	public static function saveData($id = '') {
		
		DB::beginTransaction();
		
		try {
		
			$user_id = 0;
			
			if(!empty($id)) {
				
				$employer = Sentry::findUserById($id);
				$employer->last_name = Input::get('last_name');
				
// 				if(Sentry::getUser()->hasPermission('admin')) {
					
					foreach (['email', 'password'] as $key) {
						
						if(Input::has($key)) {
								
							$employer->$key = Input::get($key);
								
						}
						
					}
					
// 				}
				
				$employer->save();
				
			} else {
				
				$group = Sentry::findGroupByName('employer');
				$employer = Sentry::createUser([
						'email' => Input::get('email'),
						'password' => Input::get('password'),
						'permissions' => ['employer' => 1],
						'last_name' => Input::get('last_name'),
						'account_id' => User::newAccountId('employer'),
						'activated' => true,
				]);
				$employer->addGroup($group);
				
			}

			$employer_meta = EmployerMeta::firstOrNew(['user_id' => $employer->id]);
			$employer_meta->user_id = $employer->id;
			$employer_meta->foundation_date = Carbon::createFromDate(Input::get('foundation_year'), Input::get('foundation_month'));
			$employer_meta->representative = Input::get('representative');
			$employer_meta->capital_stock = str_replace(',', '', Input::get('capital_stock'));
			$employer_meta->employees = str_replace(',', '', Input::get('employees'));
			$employer_meta->business_content = Input::get('business_content');
			$employer_meta->zip_code_1 = Input::get('zip_code_1');
			$employer_meta->zip_code_2 = Input::get('zip_code_2');
			$employer_meta->prefecture_id = Input::get('prefecture_id');
			$employer_meta->city_id = Input::get('city_id');
			$employer_meta->other_address = Input::get('other_address');
			$employer_meta->building = Input::get('building');
			$employer_meta->pic_department = Input::get('pic_department');
			$employer_meta->pic_name = Input::get('pic_name');
			$employer_meta->tel = Input::get('tel');
			$employer_meta->fax = Input::get('fax');
			$employer_meta->image_file_id = Surpass::imageFileId('employer_logos');
            $employer_meta->raw_password = Input::get('password');  // Added because the client requested.
			$employer_meta->save();
			DB::commit();
			return true;
			
		} catch (Exception $e) {
			
			DB::rollback();
			
		}
		
		return false;
		
	}
	
}