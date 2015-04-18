<?php

use Carbon\Carbon;
class Gift extends Eloquent {
	
	protected $guarded = ['id'];
	
	// Scopes
	
	public function scopeFilterShippingName($query, $name) {
		
		return $query->where('shipping_name', 'LIKE', '%'. $name .'%');
		
	}
	
	public function scopeFilterShippingAddress($query, $address) {
		
		return $query->where('shipping_address', 'LIKE', '%'. $address .'%');
		
	}
	
	public function scopeFilterCheckFlag($query, $boolean) {
		
		return $query->where('check_flag', $boolean);
		
	}
	
	public function scopeFilterJobId($query, $job_id) {
		
		return $query->where('job_id', $job_id);
		
	}
	
	public function scopeFilterUserId($query, $user_id) {
		
		return $query->where('user_id', $user_id);
		
	}
	
	// Accessors
	
	public function getCheckFlagTextAttribute() {
		
		return ($this->attributes['check_flag']) ? '済' : '未';
		
	}
	
	public function getJobIdTextAttribute() {
		
		return AccountId::text('job', $this->attributes['job_id']);
		
	}
	
	public function getInterviewDateAttribute() {
		
		return new Carbon($this->attributes['interview_date']);
		
	}
	
	// Others
	
	public static function validator() {

        $job_encoded_id = AccountId::numeric(Input::get('job_id'));
        Input::merge(['job_encoded_id' => $job_encoded_id]);

		$validator = Validator::make(
				Input::only([
					'job_encoded_id',
					'interview_year', 
					'interview_month', 
					'interview_day',
                    'email',
                    'shipping_name',
                    'shipping_address',
                    'zip_code',
                    'remarks'
				]),
				[
                    'job_encoded_id' => 'required|exists:jobs,id',
					'interview_year' => 'required|numeric', 
					'interview_month' => 'required|numeric',
                    'interview_day' => 'required|numeric',
                    'email' => 'required|email',
                    'shipping_name' => 'required',
                    'shipping_address' => 'required',
                    'zip_code' => 'required',
				],
                [
                    'exists' => '求人番号が有効ではありません。'
                ]
		);

        $validator->setAttributeNames([
            'job_id' => '求人ID',
            'interview_year' => '面接年',
            'interview_month' => '面接月',
            'interview_day' => '面接日',
            'email' => 'メールアドレス',
            'shipping_name' => '応募者氏名',
            'shipping_address' => '発送先住所',
            'zip_code' => '郵便番号',
            'remarks' => '備考'
        ]);
	
		return $validator;
	
	}
	
	public static function saveData($id = null) {
	
		$gift = Gift::firstOrNew(['id' => $id]);
		DB::beginTransaction();
	
		try {
	
			$user_id = 0;
			$user = Sentry::getUser();
				
			if($user != null && $user->hasPermission('applicant')) {
	
				$user_id = $user->id;
	
			}

            $encoded_job_id = AccountId::numeric(Input::get('job_id'));
            $gift->user_id = $user_id;
			$gift->job_id = $encoded_job_id;
			$gift->shipping_name = Input::get('shipping_name');
			$gift->shipping_address = Input::get('shipping_address');
			$gift->email = Input::get('email');
			$gift->interview_date = Carbon::createFromDate(
					Input::get('interview_year'), 
					Input::get('interview_month'), 
					Input::get('interview_day')
			);
            $gift->remarks = Input::get('remarks');

            if(!empty($id)) {

                $gift->memo = Input::get('memo');
                $gift->check_flag = false;

            }

			$gift->save();
			DB::commit();
				
		} catch (Exception $e) {

			DB::rollback();

		}
	
		return $gift;
	
	}
	
}