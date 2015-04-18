<?php

class AuthController extends BaseController {
	
	public function getLogin() {

		return View::make('auth.login');
	
	}
	
	public function postLogin() {
		
		try {
			
			$user = Sentry::authenticate(Input::only(['email', 'password']), Input::get('remember'));
			
			if($user->hasAccess('admin')) {
				
				return Redirect::route('admin.dashboard');
				
			} else if($user->hasAccess('employer')) {
				
				return Redirect::route('employer.dashboard');
				
			} else if($user->hasAccess('applicant')) {

				return Redirect::route('home');
				
			}
			
		} catch (Exception $e) {}

		return Redirect::back()->with('danger', 'ログイン情報が間違っています。');
	
	}
	
	public function getLogout() {

        $route = (Sentry::getUser()->hasPermission('applicant')) ? 'home.login' : 'auth.login';
		Sentry::logout();
		return Redirect::route($route);
	
	}
	
	public function getReminder() {
		
		return View::make('auth.reminder');
		
	}
	
	public function postReminder() {
		
		$validator = Validator::make(
				Input::only(['email', 'captcha']),
				[
					'email' => 'required|email',
					'captcha' => 'required|captcha'
				]
		);
		$validator->setAttributeNames(Input::get('attribute_names'));
		
		if($validator->fails()) {
		
			return Redirect::back()
						->withInput()
						->withErrors($validator)
						->with('danger', 'エラーが発生しました。');
		
		}
		
		try {
			
			$user = Sentry::findUserByLogin(Input::get('email'));
			$resetCode = $user->getResetPasswordCode();
			
		} catch (Exception $e) {
			
			return Redirect::back()
						->withInput()
						->withErrors($validator)
						->with('danger', 'このメールアドレスは登録されていません。');
			
		}
		
		$url = route('auth.password_reset', [$user->id, $resetCode]);
		
		Mail::send('emails.auth.reminder', ['url' => $url], function($e)
		{
			$e->to(Input::get('email'))
				->from(Config::get('app.emails.main'), Config::get('app.site_title'))
				->subject('パスワード・リセットのURL');
		});
		
		return Redirect::back()->with('success', 'パスワード・リセットに必要となるURLをメールアドレスへ送信しました。そちらから残りの手続きを完了させてください。');
		
	}
	
	public function getPasswordReset($id, $reset_code) {
		
		return View::make('auth.password_reset', [
				'id' => $id, 
				'reset_code' => $reset_code
		]);
		
	}
	
	public function postPasswordReset($id, $reset_code) {
		
		$validator = Validator::make(
				Input::only(['password', 'confirm_password']),
				[
					'password' => 'required|min:'. Config::get('app.password.min') .'|max:'. Config::get('app.password.max'),
					'confirm_password' => 'required|same:password',
				]
		);
		$validator->setAttributeNames(Input::get('attribute_names'));
		
		if($validator->fails()) {
		
			return Redirect::back()
						->withInput()
						->withErrors($validator)
						->with('danger', 'エラーが発生しました。');
		
		}
		
		try {
			
			$user = Sentry::findUserById($id);
		
			if ($user->checkResetPasswordCode($reset_code)) {
		
				if ($user->attemptResetPassword($reset_code, Input::get('password'))) {
					
					return Redirect::route('auth.login')->with('success', 'パスワードの再設定が完了しました。');
					
				} else {}
		
			} else {}
				
		} catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {}
		
		return Redirect::back()->with('danger', 'URLが間違っているか期限が切れています。');
		
	}
	
	public function signup() {

		return View::make('auth.signup');
		
	}

    public function signup_confirm() {

        $validator = Applicant::validator();

        if($validator->fails()) {

            return Redirect::back()
                        ->withInput()
                        ->withErrors($validator)
                        ->with('danger', trans('versatile.danger'));

        }

        return View::make('auth.signup_confirm');

    }

    public function signup_complete() {

        Applicant::saveData();
        $email_params = Input::only(['email', 'password', 'name']);

        Mail::send('emails.auth.complete', $email_params, function($e)
        {
            $e->to(Input::get('email'))
                ->bcc(Config::get('app.emails.main'))
                ->from(Config::get('app.emails.main'), Config::get('app.site_title') .'事務局')
                ->subject('会員登録完了のご案内');
        });

        return Redirect::route('home.login')->with('success', '会員登録が完了しました。なお、登録内容をメールアドレスへ送信しましたので大切に保管してください。');

    }
	
}