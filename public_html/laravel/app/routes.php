<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Home

if(Config::get('app.opened') == 1) {

    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@getIndex']);

} else {

    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@getPreIndex']);
    Route::get('/top', ['as' => 'home', 'uses' => 'HomeController@getIndex']);

}

Route::get('contact', ['as' => 'home.contact', 'uses' => 'HomeController@contact']);
Route::post('contact_confirm', ['as' => 'home.contact_confirm', 'uses' => 'HomeController@contact_confirm']);
Route::post('contact_complete', ['as' => 'home.contact_complete', 'uses' => 'HomeController@contact_complete']);
Route::post('city_data', ['as' => 'home.city_data', 'uses' => 'HomeController@postCityData']);
Route::get('job', ['as' => 'home.job', 'uses' => 'HomeController@job']);
Route::get('job/{id}', ['as' => 'home.job_detail', 'uses' => 'HomeController@job_detail']);
Route::get('job_preview/{id}', ['as' => 'home.job_preview', 'uses' => 'HomeController@job_preview']);
Route::get('new_job', ['as' => 'home.new_job', 'uses' => 'HomeController@new_job']);
Route::get('company/{id}', ['as' => 'home.company', 'uses' => 'HomeController@company']);
Route::get('application/{id}', ['as' => 'home.application', 'uses' => 'HomeController@application']);
Route::post('application_confirm', ['as' => 'home.application_confirm', 'uses' => 'HomeController@application_confirm']);
Route::post('application_complete', ['as' => 'home.application_complete', 'uses' => 'HomeController@application_complete']);
Route::get('signup', ['as' => 'home.signup', 'uses' => 'HomeController@getSignup']);
Route::post('signup', ['as' => 'home.signup.post', 'uses' => 'HomeController@postSignup']);
Route::get('gift', ['as' => 'home.gift', 'uses' => 'HomeController@gift']);
Route::post('gift_confirm', ['as' => 'home.gift_confirm', 'uses' => 'HomeController@giftConfirm']);
Route::post('gift_complete', ['as' => 'home.gift_complete', 'uses' => 'HomeController@giftComplete']);
//Route::get('activation/{id}/{activation_code}', ['as' => 'home.activation', 'uses' => 'HomeController@activation']);
//Route::get('announcements/', ['as' => 'home.announcements', 'uses' => 'HomeController@announcements']);
Route::get('announcement/{id}', ['as' => 'home.announcement_detail', 'uses' => 'HomeController@announcement_detail']);
Route::get('quo', ['as' => 'home.quo', 'uses' => 'HomeController@quo']);
Route::get('newsletter', ['as' => 'home.newsletter', 'uses' => 'HomeController@newsletter']);
Route::post('newsletter_confirm', ['as' => 'home.newsletter_confirm', 'uses' => 'HomeController@newsletter_confirm']);
Route::post('newsletter_complete', ['as' => 'home.newsletter_complete', 'uses' => 'HomeController@newsletter_complete']);
Route::get('first', ['as' => 'home.first', 'uses' => 'HomeController@first']);
Route::get('about_us', ['as' => 'home.about_us', 'uses' => 'HomeController@about_us']);
Route::get('privacy_policy', ['as' => 'home.privacy_policy', 'uses' => 'HomeController@privacy_policy']);
Route::get('rules', ['as' => 'home.rules', 'uses' => 'HomeController@rules']);
Route::get('for_offer', ['as' => 'home.for_offer', 'uses' => 'HomeController@for_offer']);
Route::get('about_us', ['as' => 'home.about_us', 'uses' => 'HomeController@about_us']);
Route::get('login', ['as' => 'home.login', 'uses' => 'HomeController@login']);
Route::get('reminder', ['as' => 'home.reminder', 'uses' => 'HomeController@reminder']);
Route::post('reminder_confirm', ['as' => 'home.reminder_confirm', 'uses' => 'HomeController@reminder_confirm']);
Route::post('reminder_complete', ['as' => 'home.reminder_complete', 'uses' => 'HomeController@reminder_complete']);

// Auth

Route::get('auth/login', ['as' => 'auth.login', 'uses' => 'AuthController@getLogin']);
Route::post('auth/login', ['as' => 'auth.login.post', 'uses' => 'AuthController@postLogin']);
Route::get('auth/signup', ['as' => 'auth.signup', 'uses' => 'AuthController@signup']);
Route::post('auth/signup_confirm', ['as' => 'auth.signup_confirm', 'uses' => 'AuthController@signup_confirm']);
Route::post('auth/signup_complete', ['as' => 'auth.signup_complete', 'uses' => 'AuthController@signup_complete']);
Route::get('auth/logout', ['as' => 'auth.logout', 'uses' => 'AuthController@getLogout']);
Route::get('auth/reminder', ['as' => 'auth.reminder', 'uses' => 'AuthController@getReminder']);
Route::post('auth/reminder', ['as' => 'auth.reminder.post', 'uses' => 'AuthController@postReminder']);
Route::get('auth/password_reset/{id}/{reset_code}', ['as' => 'auth.password_reset', 'uses' => 'AuthController@getPasswordReset']);
Route::post('auth/password_reset/{id}/{reset_code}', ['as' => 'auth.password_reset.post', 'uses' => 'AuthController@postPasswordReset']);

// Admin

Route::group(['before' => 'auth.admin'], function() {
	
	// Home
	
	Route::get('admin/dashboard', ['as' => 'admin.dashboard', 'uses' => 'admin\HomeController@dashboard']);
	Route::get('admin/settings', ['as' => 'admin.settings', 'uses' => 'admin\HomeController@getSettings']);
	Route::post('admin/settings', ['as' => 'admin.settings.post', 'uses' => 'admin\HomeController@postSettings']);
	Route::get('admin/recommendation', ['as' => 'admin.recommendation', 'uses' => 'admin\HomeController@getRecommendation']);
	Route::post('admin/recommendation/{id}', ['as' => 'admin.recommendation.post', 'uses' => 'admin\HomeController@postRecommendation']);
	Route::get('admin/recommendation/sort/{id}/{to}', ['as' => 'admin.recommendation.sort', 'uses' => 'admin\HomeController@getRecommendationSort']);
	
	// Employer

	Route::get('admin/employer/', ['as' => 'admin.employer.index', 'uses' => 'admin\EmployerController@index']);
	Route::get('admin/employer/create', ['as' => 'admin.employer.create', 'uses' => 'admin\EmployerController@create']);
	Route::post('admin/employer/', ['as' => 'admin.employer.store', 'uses' => 'admin\EmployerController@store']);
// 	Route::get('admin/employer/{id}', ['as' => 'admin.employer.show', 'uses' => 'admin\EmployerController@show']);
	Route::get('admin/employer/{id}/edit', ['as' => 'admin.employer.edit', 'uses' => 'admin\EmployerController@edit']);
	Route::put('admin/employer/{id}', ['as' => 'admin.employer.update', 'uses' => 'admin\EmployerController@update']);
	Route::delete('admin/employer/{id}', ['as' => 'admin.employer.destroy', 'uses' => 'admin\EmployerController@destroy']);
	Route::post('admin/employer/multi_delete', ['as' => 'admin.employer.multi_delete', 'uses' => 'admin\EmployerController@multi_delete']);
	Route::get('admin/employer/signin/{id}', ['as' => 'admin.employer.signin', 'uses' => 'admin\EmployerController@signin']);

	// Applicant
	
	Route::get('admin/applicant', ['as' => 'admin.applicant.index', 'uses' => 'admin\ApplicantController@index']);
// 	Route::get('admin/applicant/create', ['as' => 'admin.applicant.create', 'uses' => 'admin\ApplicantController@create']);
	Route::post('admin/applicant', ['as' => 'admin.applicant.store', 'uses' => 'admin\ApplicantController@store']);
	Route::get('admin/applicant/{id}', ['as' => 'admin.applicant.show', 'uses' => 'admin\ApplicantController@show']);
	Route::get('admin/applicant/{id}/edit', ['as' => 'admin.applicant.edit', 'uses' => 'admin\ApplicantController@edit']);
	Route::put('admin/applicant/{id}', ['as' => 'admin.applicant.update', 'uses' => 'admin\ApplicantController@update']);
	Route::delete('admin/applicant/{id}', ['as' => 'admin.applicant.destroy', 'uses' => 'admin\ApplicantController@destroy']);
	Route::post('admin/applicant/multi_delete', ['as' => 'admin.applicant.multi_delete', 'uses' => 'admin\ApplicantController@multi_delete']);
	Route::get('admin/applicant/signin/{id}', ['as' => 'admin.applicant.signin', 'uses' => 'admin\ApplicantController@signin']);
	
	// Announcement
	
	Route::get('admin/announcement/all', ['as' => 'admin.all.announcement.index', 'uses' => 'admin\announcement\AllAnnouncementController@index']);
	Route::get('admin/announcement/all/create', ['as' => 'admin.all.announcement.create', 'uses' => 'admin\announcement\AllAnnouncementController@create']);
	Route::post('admin/announcement/all', ['as' => 'admin.all.announcement.store', 'uses' => 'admin\announcement\AllAnnouncementController@store']);
	Route::get('admin/announcement/all/{id}', ['as' => 'admin.all.announcement.show', 'uses' => 'admin\announcement\AllAnnouncementController@show']);
	Route::get('admin/announcement/all/{id}/edit', ['as' => 'admin.all.announcement.edit', 'uses' => 'admin\announcement\AllAnnouncementController@edit']);
	Route::put('admin/announcement/all/{id}', ['as' => 'admin.all.announcement.update', 'uses' => 'admin\announcement\AllAnnouncementController@update']);
	Route::delete('admin/announcement/all/{id}', ['as' => 'admin.all.announcement.destroy', 'uses' => 'admin\announcement\AllAnnouncementController@destroy']);
	Route::post('admin/announcement/all/multi_delete', ['as' => 'admin.all.announcement.multi_delete', 'uses' => 'admin\announcement\AllAnnouncementController@multi_delete']);

	Route::get('admin/announcement/employer', ['as' => 'admin.employer.announcement.index', 'uses' => 'admin\announcement\EmployerAnnouncementController@index']);
	Route::get('admin/announcement/employer/create', ['as' => 'admin.employer.announcement.create', 'uses' => 'admin\announcement\EmployerAnnouncementController@create']);
	Route::post('admin/announcement/employer', ['as' => 'admin.employer.announcement.store', 'uses' => 'admin\announcement\EmployerAnnouncementController@store']);
	Route::get('admin/announcement/employer/{id}', ['as' => 'admin.employer.announcement.show', 'uses' => 'admin\announcement\EmployerAnnouncementController@show']);
	Route::get('admin/announcement/employer/{id}/edit', ['as' => 'admin.employer.announcement.edit', 'uses' => 'admin\announcement\EmployerAnnouncementController@edit']);
	Route::put('admin/announcement/employer/{id}', ['as' => 'admin.employer.announcement.update', 'uses' => 'admin\announcement\EmployerAnnouncementController@update']);
	Route::delete('admin/announcement/employer/{id}', ['as' => 'admin.employer.announcement.destroy', 'uses' => 'admin\announcement\EmployerAnnouncementController@destroy']);
	Route::post('admin/announcement/employer/multi_delete', ['as' => 'admin.employer.announcement.multi_delete', 'uses' => 'admin\announcement\EmployerAnnouncementController@multi_delete']);
	
	// Job
	
	Route::get('admin/job', ['as' => 'admin.job.index', 'uses' => 'admin\JobController@index']);
	Route::get('admin/job/create', ['as' => 'admin.job.create', 'uses' => 'admin\JobController@create']);
	Route::post('admin/job', ['as' => 'admin.job.store', 'uses' => 'admin\JobController@store']);
	Route::get('admin/job/{id}', ['as' => 'admin.job.show', 'uses' => 'admin\JobController@show']);
	Route::get('admin/job/{id}/edit', ['as' => 'admin.job.edit', 'uses' => 'admin\JobController@edit']);
	Route::put('admin/job/{id}', ['as' => 'admin.job.update', 'uses' => 'admin\JobController@update']);
	Route::delete('admin/job/{id}', ['as' => 'admin.job.destroy', 'uses' => 'admin\JobController@destroy']);
	Route::post('admin/job/multi_delete', ['as' => 'admin.job.multi_delete', 'uses' => 'admin\JobController@multi_delete']);
	Route::get('admin/job/sort/{id}/{to}', ['as' => 'admin.job.sort', 'uses' => 'admin\JobController@sort']);

    // Application

    Route::get('admin/application', ['as' => 'admin.application.index', 'uses' => 'admin\ApplicationController@index']);
    Route::delete('admin/application/{id}', ['as' => 'admin.application.destroy', 'uses' => 'admin\ApplicationController@destroy']);
    Route::post('admin/application/multi_delete', ['as' => 'admin.application.multi_delete', 'uses' => 'admin\ApplicationController@multi_delete']);

	// Gift
	
	Route::get('admin/gift', ['as' => 'admin.gift.index', 'uses' => 'admin\GiftController@index']);
	Route::get('admin/gift/{id}/edit', ['as' => 'admin.gift.edit', 'uses' => 'admin\GiftController@edit']);
	Route::PUT('admin/gift/{id}', ['as' => 'admin.gift.update', 'uses' => 'admin\GiftController@update']);
	
	// Image
	
	Route::post('admin/image/upload', ['as' => 'admin.image.upload', 'uses' => 'ImageController@upload']);
	Route::post('admin/image/remove', ['as' => 'admin.image.remove', 'uses' => 'ImageController@remove']);
	
});

// Employer

Route::group(['before' => 'auth.employer'], function() {

	// Home

	Route::get('employer/dashboard', ['as' => 'employer.dashboard', 'uses' => 'employer\HomeController@dashboard']);
	Route::get('employer/settings', ['as' => 'employer.settings', 'uses' => 'employer\HomeController@getSettings']);
	Route::post('employer/settings_confirm', ['as' => 'employer.settings.confirm', 'uses' => 'employer\HomeController@postSettingsConfirm']);
	Route::post('employer/settings_complete', ['as' => 'employer.settings.complete', 'uses' => 'employer\HomeController@postSettingsComplete']);
	Route::get('employer/contact', ['as' => 'employer.contact', 'uses' => 'employer\HomeController@getContact']);
	Route::post('employer/contact_confirm', ['as' => 'employer.contact.confirm', 'uses' => 'employer\HomeController@postContactConfirm']);
	Route::post('employer/contact_complete', ['as' => 'employer.contact.complete', 'uses' => 'employer\HomeController@postContactComplete']);
	Route::get('employer/delete_account', ['as' => 'employer.delete_account', 'uses' => 'employer\HomeController@getDeleteAccount']);
	Route::post('employer/delete_account_confirm', ['as' => 'employer.delete_account.confirm', 'uses' => 'employer\HomeController@postDeleteAccountConfirm']);
	Route::post('employer/delete_account_complete', ['as' => 'employer.delete_account.complete', 'uses' => 'employer\HomeController@postDeleteAccountComplete']);
	Route::get('employer/billing', ['as' => 'employer.billing', 'uses' => 'employer\HomeController@billing']);
	
	// Job
	
	Route::get('employer/job', ['as' => 'employer.job.index', 'uses' => 'employer\JobController@index']);
	Route::get('employer/job/create', ['as' => 'employer.job.create', 'uses' => 'employer\JobController@create']);
	Route::post('employer/job', ['as' => 'employer.job.store', 'uses' => 'employer\JobController@store']);
	Route::get('employer/job/{id}', ['as' => 'employer.job.show', 'uses' => 'employer\JobController@show']);
	Route::get('employer/job/{id}/edit', ['as' => 'employer.job.edit', 'uses' => 'employer\JobController@edit']);
	Route::put('employer/job/{id}', ['as' => 'employer.job.update', 'uses' => 'employer\JobController@update']);
	Route::delete('employer/job/{id}', ['as' => 'employer.job.destroy', 'uses' => 'employer\JobController@destroy']);
	Route::post('employer/job/multi_delete', ['as' => 'employer.job.multi_delete', 'uses' => 'employer\JobController@multi_delete']);
// 	Route::get('employer/job/sort/{id}/{to}', ['as' => 'employer.job.sort', 'uses' => 'employer\JobController@sort']);
	Route::get('employer/job/copy/{id}', ['as' => 'employer.job.copy', 'uses' => 'employer\JobController@copy']);
	Route::post('employer/job/confirm', ['as' => 'employer.job.confirm', 'uses' => 'employer\JobController@confirm']);

	// Announcement

	Route::get('employer/announcement', ['as' => 'employer.announcement.index', 'uses' => 'employer\AnnouncementController@index']);
	Route::get('employer/announcement/detail/{id}', ['as' => 'employer.announcement.detail', 'uses' => 'employer\AnnouncementController@detail']);

	// Applicant
	
	Route::get('employer/applicant', ['as' => 'employer.applicant.index', 'uses' => 'employer\ApplicantController@index']);
	Route::get('employer/applicant/consideration', ['as' => 'employer.applicant.consideration', 'uses' => 'employer\ApplicantController@getConsideration']);
	Route::post('employer/applicant/consideration', ['as' => 'employer.applicant.consideration.post', 'uses' => 'employer\ApplicantController@postConsideration']);
	Route::get('employer/applicant/{id}', ['as' => 'employer.applicant.show', 'uses' => 'employer\ApplicantController@show']);
	Route::get('employer/applicant/scout/{id}', ['as' => 'employer.applicant.scout', 'uses' => 'employer\ApplicantController@getScout']);
	Route::post('employer/applicant/scout/{id}', ['as' => 'employer.applicant.scout.post', 'uses' => 'employer\ApplicantController@postScout']);
	
	// Application
	
	Route::get('employer/application', ['as' => 'employer.application.index', 'uses' => 'employer\ApplicationController@index']);
	Route::get('employer/application/show/{id}', ['as' => 'employer.application.show', 'uses' => 'employer\ApplicationController@getShow']);
	Route::post('employer/application/{id}/update', ['as' => 'employer.application.show.post', 'uses' => 'employer\ApplicationController@postShow']);
    Route::delete('employer/application/{id}', ['as' => 'employer.application.destroy', 'uses' => 'employer\ApplicationController@destroy']);

    // Image
	
	Route::post('employer/image/upload', ['as' => 'employer.image.upload', 'uses' => 'ImageController@upload']);
	Route::post('employer/image/remove', ['as' => 'employer.image.remove', 'uses' => 'ImageController@remove']);
	
});

// Applicant

Route::group(['before' => 'auth.applicant'], function() {

	// Home

	Route::get('applicant/settings', ['as' => 'applicant.settings', 'uses' => 'applicant\HomeController@settings']);
	Route::post('applicant/settings_confirm', ['as' => 'applicant.settings_confirm', 'uses' => 'applicant\HomeController@settings_confirm']);
	Route::post('applicant/settings_complete', ['as' => 'applicant.settings_complete', 'uses' => 'applicant\HomeController@settings_complete']);
	Route::get('applicant/application', ['as' => 'applicant.application.index', 'uses' => 'applicant\ApplicationController@index']);
	Route::get('applicant/application/{id}', ['as' => 'applicant.application.show', 'uses' => 'applicant\ApplicationController@show']);
	Route::get('applicant/consideration', ['as' => 'applicant.consideration', 'uses' => 'applicant\HomeController@getConsideration']);
	Route::post('applicant/consideration', ['as' => 'applicant.consideration.post', 'uses' => 'applicant\HomeController@postConsideration']);
    Route::get('applicant/withdraw', ['as' => 'applicant.withdraw', 'uses' => 'applicant\HomeController@getWithdraw']);
    Route::post('applicant/withdraw', ['as' => 'applicant.withdraw.post', 'uses' => 'applicant\HomeController@postWithdraw']);

});