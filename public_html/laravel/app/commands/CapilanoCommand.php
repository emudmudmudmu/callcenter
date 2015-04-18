<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CapilanoCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'capilano';
	private $_questions = [

		'data_key' => 'Data key? (e.g.) item or admin.store_item',
		'data_name' => 'Data name? (e.g.) エリア', 
		'columns' => 'DB columns? (e.g.) id,title,description', 
		'surpass' => 'Need surpass? [Y|n]', 
		'searchbox' => 'Need searchbox? [Y|n]'
		
	];
	private $_generation_data = [];

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'To generate contoller, model, views, migrate and seeeding.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$mold_path = $this->argument('mold_dir');
		
		if(!File::exists($mold_path)) {
			
			die("\n*** ERROR ***\nThe mold dir doesn't exist.\n");
			
		}
		
		foreach ($this->_questions as $key => $question) {

			while(1 == 1) {
					
				$answer = $this->ask($question);
				
				if(in_array($key, ['surpass', 'searchbox']) && $answer != 'n') {
					
					$answer = 'Y';
					
				}
				
				if(!empty($answer)) {
					
					$this->_generation_data[$key] = $answer;
					break;
					
				}
					
			}
			
		}

		while(1 == 1) {
		
			$last_message = "\n* If data is correct, press Enter key. \nOtherwise enter value like the following.\nkey:value\n\n\n";
			$last_message .= print_r($this->_generation_data, true) ."\n";
			$answer = $this->ask($last_message);
			
			if(empty($answer)) {
				
				break;
				
			} else {
				
				if (strpos($answer, ':') !== false) {
					
					list($new_key, $new_value) = explode(':', $answer);
					
					if(!isset($this->_generation_data[$new_key])) {
						
						echo "\n*** ERROR ***\nThe key doesn't exist.\n";
						
					} else {

						$this->_generation_data[$new_key] = $new_value;
						
					}
					
				} else {
					
					echo "\n*** ERROR ***\nKey and Value are required.\n";
					
				}
				
			}
		
		}
		$this->_generation_data['view_dir'] = '';
		$data_key = $this->_generation_data['data_key'];

		if(strpos($this->_generation_data['data_key'], '.') !== false) {
			
			list($namespace, $data_key) = explode('.', $this->_generation_data['data_key']);
			$this->_generation_data['namespace'] = $namespace;
			$this->_generation_data['view_dir'] = $namespace .'.';
			
		}
		$this->_generation_data['view_dir_slash'] = str_replace('.', '/', $this->_generation_data['view_dir']);
		$this->_generation_data['controller_path'] = (!empty($namespace)) ? $namespace .'\\' : '';
		
		Blade::setContentTags('[{', '}]');
		View::addNamespace('mold', $mold_path);
		
		$file_names = [
				'controller', 
				'model', 
				'index', 
				'create', 
				'edit', 
				'migrate', 
				'seeds', 
				'route'
		];
		
		foreach ($file_names as $file_name) {
			
			$data_keys = $this->dataKeyValues($data_key);
			$source = View::make('mold::'. $file_name, [
						
					'data' => $this->_generation_data,
					'data_keys' => $data_keys,
					'quoted_ids' => $this->quatedColumns(),
					'columns' => explode(',', $this->_generation_data['columns']),
					'surpass' => ($this->_generation_data['surpass'] == 'Y'), 
					'searchbox' => ($this->_generation_data['searchbox'] == 'Y')
			
			])->render();
			
			$path = '';
			
			switch ($file_name) {
				
				case 'controller':
					$path = 'controllers/';
					
					if(!empty($namespace)) {
						
						$path .= $namespace .'/';
						
					}
					
					$path .= studly_case($data_keys['snake'] .'_controller' .'.php');
					break;
					
				case 'model':
					$path = 'models/'. $data_keys['studly'] .'.php';
					break;
					
				case 'migrate':
					$filename = date('Y_m_d_His_') .'create_'. $data_keys['plural'] .'_table';
					$path = 'database/migrations/'. $filename .'.php';
					break;
					
				case 'seeds':
					$path = 'database/seeds/'. $data_keys['studly'] .'Seeder.php';
					break;
					
				case 'index':
					$path = 'views/';
						
					if(!empty($namespace)) {
							
						$path .= $namespace .'/';
							
					}
				
					$path .= $data_keys['snake'] .'/index.blade.php';
					break;
						
				case 'create':
					$path = 'views/';
						
					if(!empty($namespace)) {
							
						$path .= $namespace .'/';
							
					}
				
					$path .= $data_keys['snake'] .'/create.blade.php';
					break;
				
				case 'edit':
					$path = 'views/';
				
					if(!empty($namespace)) {
							
						$path .= $namespace .'/';
							
					}
				
					$path .= $data_keys['snake'] .'/edit.blade.php';
					break;
				
				case 'route':
					$path = '';
					break 2;
				
			}
			
			$save_path = app_path($path);
			
// 			if(file_exists($save_path)) {
				
// 				die('The target "'. $file_name .'" already exists.' ."\n");
				
// 			}
			
			file_put_contents(app_path($path), $source);
			
		}
		
		echo "---  ROUTE START  ---\n\n". $source ."\n\n---  ROUTE END  ---";
		system('composer dumpautoload');
		echo "done.\n";
		
	}
	
	private function dataKeyValues($data_key) {
		
		return [
			'default' => $data_key, 
			'snake' => snake_case($data_key), 
			'studly' => studly_case($data_key), 
			'camel' => camel_case($data_key), 
			'plural' => str_plural($data_key)
		];
		
	}
	
	private function quatedColumns() {
		
		$columns = explode(',', $this->_generation_data['columns']);
		$quoted_columns = [];
		
		foreach ($columns as $column) {
			
			$quoted_columns[] = "'". trim($column) ."'";
			
		}
		
		return implode(', ', $quoted_columns);
		
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('mold_dir', InputArgument::REQUIRED, 'The directory that contains mold files.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array();
	}

}
