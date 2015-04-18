<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Application Debug Mode
	|--------------------------------------------------------------------------
	|
	| When your application is in debug mode, detailed error messages with
	| stack traces will be shown on every error that occurs within your
	| application. If disabled, a simple generic error page is shown.
	|
	*/

	'debug' => false,

	/*
	|--------------------------------------------------------------------------
	| Application URL
	|--------------------------------------------------------------------------
	|
	| This URL is used by the console to properly generate URLs when using
	| the Artisan command line tool. You should set this to the root of
	| your application so that it is used when running Artisan tasks.
	|
	*/

	'url' => 'http://callcenter-job.net',

	/*
	|--------------------------------------------------------------------------
	| Application Timezone
	|--------------------------------------------------------------------------
	|
	| Here you may specify the default timezone for your application, which
	| will be used by the PHP date and date-time functions. We have gone
	| ahead and set this to a sensible default for you out of the box.
	|
	*/

	'timezone' => 'Asia/Tokyo',

	/*
	|--------------------------------------------------------------------------
	| Application Locale Configuration
	|--------------------------------------------------------------------------
	|
	| The application locale determines the default locale that will be used
	| by the translation service provider. You are free to set this value
	| to any of the locales which will be supported by the application.
	|
	*/

	'locale' => 'ja',

	/*
	|--------------------------------------------------------------------------
	| Application Fallback Locale
	|--------------------------------------------------------------------------
	|
	| The fallback locale determines the locale to use when the current one
	| is not available. You may change the value to correspond to any of
	| the language folders that are provided through your application.
	|
	*/

	'fallback_locale' => 'ja',

	/*
	|--------------------------------------------------------------------------
	| Encryption Key
	|--------------------------------------------------------------------------
	|
	| This key is used by the Illuminate encrypter service and should be set
	| to a random, 32 character string, otherwise these encrypted strings
	| will not be safe. Please do this before deploying an application!
	|
	*/

	'key' => 'TkbhJxraN6nzt4dk2fcUxj71Bedf4Gg1',

	'cipher' => MCRYPT_RIJNDAEL_128,

	/*
	|--------------------------------------------------------------------------
	| Autoloaded Service Providers
	|--------------------------------------------------------------------------
	|
	| The service providers listed here will be automatically loaded on the
	| request to your application. Feel free to add your own services to
	| this array to grant expanded functionality to your applications.
	|
	*/

	'providers' => array(

		'Illuminate\Foundation\Providers\ArtisanServiceProvider',
		'Illuminate\Auth\AuthServiceProvider',
		'Illuminate\Cache\CacheServiceProvider',
		'Illuminate\Session\CommandsServiceProvider',
		'Illuminate\Foundation\Providers\ConsoleSupportServiceProvider',
		'Illuminate\Routing\ControllerServiceProvider',
		'Illuminate\Cookie\CookieServiceProvider',
		'Illuminate\Database\DatabaseServiceProvider',
		'Illuminate\Encryption\EncryptionServiceProvider',
		'Illuminate\Filesystem\FilesystemServiceProvider',
		'Illuminate\Hashing\HashServiceProvider',
		'Illuminate\Html\HtmlServiceProvider',
		'Illuminate\Log\LogServiceProvider',
		'Illuminate\Mail\MailServiceProvider',
		'Illuminate\Database\MigrationServiceProvider',
		'Illuminate\Pagination\PaginationServiceProvider',
		'Illuminate\Queue\QueueServiceProvider',
		'Illuminate\Redis\RedisServiceProvider',
		'Illuminate\Remote\RemoteServiceProvider',
		'Illuminate\Auth\Reminders\ReminderServiceProvider',
		'Illuminate\Database\SeedServiceProvider',
		'Illuminate\Session\SessionServiceProvider',
		'Illuminate\Translation\TranslationServiceProvider',
		'Illuminate\Validation\ValidationServiceProvider',
		'Illuminate\View\ViewServiceProvider',
		'Illuminate\Workbench\WorkbenchServiceProvider',
		'Sukohi\Bakery\BakeryServiceProvider',
		'Sukohi\Cahen\CahenServiceProvider',
		'Sukohi\Camon\CamonServiceProvider',
		'Sukohi\Caruta\CarutaServiceProvider',
		'Sukohi\FormStrap\FormStrapServiceProvider',
		'Sukohi\Menco\MencoServiceProvider',
		'Cartalyst\Sentry\SentryServiceProvider',
		'Intervention\Image\ImageServiceProvider',
		'Barryvdh\Debugbar\ServiceProvider',
		'Way\Generators\GeneratorsServiceProvider',
		'Sukohi\Surpass\SurpassServiceProvider', 
		'mnshankar\CSV\CSVServiceProvider',
		'Johntaa\Captcha\CaptchaServiceProvider',
		'Sukohi\Brick\BrickServiceProvider',
		'Sukohi\Kuku\KukuServiceProvider',
		'Sukohi\SearchStrap\SearchStrapServiceProvider',
		'Sukohi\JapanesePrefectures\JapanesePrefecturesServiceProvider',
		'Sukohi\Paver\PaverServiceProvider',
	),

	/*
	|--------------------------------------------------------------------------
	| Service Provider Manifest
	|--------------------------------------------------------------------------
	|
	| The service provider manifest is used by Laravel to lazy load service
	| providers which are not needed for each request, as well to keep a
	| list of all of the services. Here, you may set its storage spot.
	|
	*/

	'manifest' => storage_path().'/meta',

	/*
	|--------------------------------------------------------------------------
	| Class Aliases
	|--------------------------------------------------------------------------
	|
	| This array of class aliases will be registered when this application
	| is started. However, feel free to register as many as you wish as
	| the aliases are "lazy" loaded so they don't hinder performance.
	|
	*/

	'aliases' => array(

		'App'               => 'Illuminate\Support\Facades\App',
		'Artisan'           => 'Illuminate\Support\Facades\Artisan',
		'Auth'              => 'Illuminate\Support\Facades\Auth',
		'Blade'             => 'Illuminate\Support\Facades\Blade',
		'Cache'             => 'Illuminate\Support\Facades\Cache',
		'ClassLoader'       => 'Illuminate\Support\ClassLoader',
		'Config'            => 'Illuminate\Support\Facades\Config',
		'Controller'        => 'Illuminate\Routing\Controller',
		'Cookie'            => 'Illuminate\Support\Facades\Cookie',
		'Crypt'             => 'Illuminate\Support\Facades\Crypt',
		'DB'                => 'Illuminate\Support\Facades\DB',
		'Eloquent'          => 'Illuminate\Database\Eloquent\Model',
		'Event'             => 'Illuminate\Support\Facades\Event',
		'File'              => 'Illuminate\Support\Facades\File',
		'Form'              => 'Illuminate\Support\Facades\Form',
		'Hash'              => 'Illuminate\Support\Facades\Hash',
		'HTML'              => 'Illuminate\Support\Facades\HTML',
		'Input'             => 'Illuminate\Support\Facades\Input',
		'Lang'              => 'Illuminate\Support\Facades\Lang',
		'Log'               => 'Illuminate\Support\Facades\Log',
		'Mail'              => 'Illuminate\Support\Facades\Mail',
		'Paginator'         => 'Illuminate\Support\Facades\Paginator',
		'Password'          => 'Illuminate\Support\Facades\Password',
		'Queue'             => 'Illuminate\Support\Facades\Queue',
		'Redirect'          => 'Illuminate\Support\Facades\Redirect',
		'Redis'             => 'Illuminate\Support\Facades\Redis',
		'Request'           => 'Illuminate\Support\Facades\Request',
		'Response'          => 'Illuminate\Support\Facades\Response',
		'Route'             => 'Illuminate\Support\Facades\Route',
		'Schema'            => 'Illuminate\Support\Facades\Schema',
		'Seeder'            => 'Illuminate\Database\Seeder',
		'Session'           => 'Illuminate\Support\Facades\Session',
		'SoftDeletingTrait' => 'Illuminate\Database\Eloquent\SoftDeletingTrait',
		'SSH'               => 'Illuminate\Support\Facades\SSH',
		'Str'               => 'Illuminate\Support\Str',
		'URL'               => 'Illuminate\Support\Facades\URL',
		'Validator'         => 'Illuminate\Support\Facades\Validator',
		'View'              => 'Illuminate\Support\Facades\View',
		'Bakery' =>'Sukohi\Bakery\Facades\Bakery',
		'Cahen' => 'Sukohi\Cahen\Facades\Cahen',
		'Camon' => 'Sukohi\Camon\Facades\Camon',
		'Caruta' => 'Sukohi\Caruta\Facades\Caruta',
		'FormStrap' => 'Sukohi\FormStrap\Facades\FormStrap',
		'Menco' => 'Sukohi\Menco\Facades\Menco',
		'Sentry' => 'Cartalyst\Sentry\Facades\Laravel\Sentry',
		'Image' => 'Intervention\Image\Facades\Image',
		'Debugbar' => 'Barryvdh\Debugbar\Facade',
		'Surpass' =>'Sukohi\Surpass\Facades\Surpass',
		'CSV' =>'mnshankar\CSV\CSVFacade',
		'Captcha' => 'Johntaa\Captcha\Facades\Captcha',
		'Brick' =>'Sukohi\Brick\Facades\Brick',
		'Kuku' => 'Sukohi\Kuku\Facades\Kuku',
		'SearchStrap' =>'Sukohi\SearchStrap\Facades\SearchStrap',
		'JapanesePrefectures' =>'Sukohi\JapanesePrefectures\Facades\JapanesePrefectures',
		'Paver' =>'Sukohi\Paver\Facades\Paver',
	),

	'domains' => [                                          // サイトドメイン
		'main' => 'callcenter-job.net'
	],
	'emails' => [                                           // メール送信先
		'main' => 'mail@callcenter-job.net',
		'contact' => 'mail@callcenter-job.net',
		'admin' => 'mail@callcenter-job.net'
	], 
	'site_title' => 'コールセンターの窓口',                     // サイト名
	'password' => ['min' => 6, 'max' => 25],                // ログインパスワードの必須文字数（最小／最大）
	'pathes' => [                                           // 画像が保存される場所
		'upload' => 'dist/img/uploads'
	], 
	'application_fee' => 3800,                              // 手数料の金額は？
    'new_mark_days' => 10,                                   // 「New」のマークがつくのは登録後何日？
    'job_per_page' => 10,                                   // 求人状は１ページに何件まで表示する？
    'recommendation_count' => 6,                            // おすすめ求人情報は何件まで有効？
    'last_upgraded' => 1425497362,                          // サイト更新時のタイムスタンプ（CSSやJS更新時に変更）
    'opened' => 0                                           // サイトはオープンしているかどうか？
		
);