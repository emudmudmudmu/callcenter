<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
		$this->call('AnnouncementTableSeeder');
		$this->call('GiftTableSeeder');
		$this->call('JobTableSeeder');
		$this->call('ApplicationTableSeeder');
		
		// Prefectures and Cities data
		
		if(!Schema::hasTable('addresses')) {

			$db_default = \Config::get('database.default');
			$username = Config::get('database.connections.'. $db_default .'.username');
			$password = Config::get('database.connections.'. $db_default .'.password');
			$database = Config::get('database.connections.'. $db_default .'.database');
			system('mysql -u '. $username .' -p'. $password .' '. $database .' < '. base_path('data/prefecture_city_addresses.sql'));
			
		}
		
	}

}
