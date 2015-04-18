<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	
// 	public static function boot() {
	
// 		parent::boot();
	
// 		static::deleted(function($user) {
// 		});
		  
// 	}
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	// Loadings
	
	public function applicant_meta() {
		
		return $this->hasOne('ApplicantMeta', 'user_id', 'id');
		
	}
	
	public function applicant_job_categories() {
		
		return $this->hasMany('ApplicantJobCategory', 'user_id', 'id');
		
	}
	
	public function applicant_job_types() {
		
		return $this->hasMany('ApplicantJobType', 'user_id', 'id');
		
	}
	
	public function employer_meta() {
		
		return $this->hasOne('EmployerMeta', 'user_id', 'id');
		
	}
	
	public function employer_jobs() {
		
		return $this->hasMany('Job', 'user_id', 'id');
		
	}
	
	public function group() {
		
		return $this->hasOne('UsersGroup', 'user_id', 'id');
		
	}
	
	// Scopes
	
	public function scopeFilterId($query, $id) {
		
		return $query->where('users.id', $id);
		
	}
	
	public function scopeFilterEmail($query, $email) {
		
		return $query->where('users.email', 'LIKE', '%'. $email .'%');
		
	}

	public function scopeFilterAccountId($query, $account_id) {

		return $query->where('users.account_id', $account_id);

	}
	
	public function scopeFilterLastName($query, $name) {
		
		return $query->where('users.last_name', 'LIKE', '%'. $name .'%');
		
	}
	
	public function scopeFilterFirstName($query, $name) {
		
		return $query->where('users.first_name', 'LIKE', '%'. $name .'%');
		
	}
	
	public function scopeFilterName($query, $name) {
		
		$db_prefix = DB::getTablePrefix();
		$table = $db_prefix .'users';
		return $query->where(DB::raw('CONCAT('. $table .'.last_name, '. $table .'.first_name)'), 'LIKE', '%'. $name .'%');
		
	}
	
	public function scopeFilterPrefectureId($query, $prefecture_id) {
		
		return $query->where('applicant_metas.prefecture_id', $prefecture_id);
		
	}
	
	public function scopeFilterGroupId($query, $group_id) {
		
		return $query->where('users_groups.group_id', '=', $group_id);
		
	}

	public function scopeFilterTel($query, $tel) {

		return $query->where('tel', 'LIKE', '%'. $tel .'%');

	}
	
	public function scopeJoinGroup($query) {
		
		return $query->join('users_groups', 'users.id', '=', 'users_groups.user_id');
		
	}
	
	public function scopeJoinEmployerMeta($query) {
		
		return $query->join('employer_metas', 'users.id', '=', 'employer_metas.user_id');
		
	}
	
	public function scopeJoinEmployerPrefecture($query) {
		
		return $query->join('addresses', 'employer_metas.city_id', '=', 'addresses.city_id');
		
	}
	
	public function scopeJoinApplicantMeta($query) {
		
		return $query->join('applicant_metas', 'users.id', '=', 'applicant_metas.user_id');
		
	}
	
	public function scopeJoinApplicantPrefecture($query) {
		
		return $query->join('addresses', 'applicant_metas.city_id', '=', 'addresses.city_id');
		
	}
	
	// Accessors
	
	public function getNameAttribute() {
		
		return $this->attributes['last_name'] .' '. $this->attributes['first_name'];
		
	}
	
	public function getFoundationDateAttribute() {
		
		return new Carbon($this->attributes['foundation_date']);
		
	}
	
	public function getGenderTextAttribute() {
		
		$gender_data = Gender::gender_data();
		return $gender_data[$this->attributes['gender']];
		
	}
	
	public function getAgeAttribute() {

		$birth_year = $this->attributes['birth_year'];
		$birth_month = $this->attributes['birth_month'];
		$birth_day = $this->attributes['birth_day'];
		return Carbon::createFromDate($birth_year, $birth_month, $birth_day)->age;
		
	}
	
	public function getAgeTextAttribute() {

		return $this->age .'歳';
		
	}
	
	// Others
	
// 	public static function accountId($user_type, $id) {
		
// 		$type_symbol = '';
		
// 		switch($user_type) {

// 			case 'employer':
// 				$type_symbol = 'C';
// 				break;
				
// 			case 'applicant':
// 				$type_symbol = 'N';
// 				break;
				
// 			default:
// 				return '';
			
// 		}
		
// 		return $type_symbol . str_pad($id, 11, '0', STR_PAD_LEFT);
		
// 	}
	
	public static function newAccountId($user_type) {
		
		$group = Sentry::findGroupByName($user_type);
		$count = \User::joinGroup()
					->filterGroupId($group->id)
					->count();
		$new_id = $count + 1;
		return AccountId::text($user_type, $new_id);
		
	}

}
