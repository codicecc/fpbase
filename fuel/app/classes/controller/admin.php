<?php

class Controller_Admin extends Controller_Base
{
	public $template = 'admin/sbadmin2-template';
	//public $template = 'admin/template';
	//public $template = 'admin/template-original';

	public function before(){

		// gnucms Francesco Dattolo - 1703151147 - Set Language
		// The language value will loaded from user setting value. Now the italian langanguage is loaded manually
		// It's important it get loaded before of parent::before(). As It helped here: https://fuelphp.com/forums/discussion/11844/help-change-language-in-before-method
		//Debug::dump(Auth::get_profile_fields('lang'));
		//Debug::dump(Auth::get_profile_fields());
		/** 1703160857 - gnucms - The language value is got from user "profile_fields", and then loaded**/
		Lang::set_lang(Auth::get_profile_fields('lang'), true);
		Lang::load('admin-locale','admin');
		Lang::load('help-locale','help');

		parent::before();

		if (Request::active()->controller !== 'Controller_Admin' or ! in_array(Request::active()->action, array('login', 'lostpassword','logout')))
		{
			if (Auth::check()){
				if(!Auth::has_access(Request::active()->controller.'.'.Request::active()->action)) // correct logical syntax - gnucms - francescodattolo - 1610100838
				{
					Session::set_flash('error', e(__('admin.You-don-t-have-access-to-the-admin-panel')));
					Response::redirect('/');
				}
			}
			else{
				Response::redirect('admin/login');
			}
		}
	}

	public function action_login(){
		// Already logged in
		Auth::check() and Response::redirect('admin');

		$val = Validation::forge();

		if (Input::method() == 'POST')
		{
			$val->add('email', 'Email or Username')
			    ->add_rule('required');
			$val->add('password', 'Password')
			    ->add_rule('required');

			if ($val->run()){
				if ( ! Auth::check())
				{
					if (Auth::login(Input::post('email'), Input::post('password'))){
						if(Auth::get('group')=="-1"){
							Auth::logout();
							$this->template->set_global('login_error', 'User blocked!');
						}
						else{
							// assign the user id that lasted updated this record
							foreach (\Auth::verified() as $driver)
							{
								if (($id = $driver->get_user_id()) !== false)
								{
									// credentials ok, go right in
									$current_user = Model\Auth_User::find($id[1]);
									Session::set_flash('success', e('Welcome, '.$current_user->username));
									Response::redirect('admin');
								}
							}
						}
					}
					else
					{
						$this->template->set_global('login_error', 'Login failed!');
					}
				}
				else
				{
					$this->template->set_global('login_error', 'Already logged in!');
				}
			}
		}

		//Email2::send2("Francesco Dattolo TEST","info@francescodattolo.it","Test Invio da FPBase Locale","It's only a TEST");

		$this->template->title = 'Login';
		$this->template->content = View::forge('admin/login', array('val' => $val), false);
	}

	/**
	 * The logout action.
	 *
	 * @access  public
	 * @return  void
	 */
	public function action_logout()
	{
		Auth::logout();
		Response::redirect('/');
	}

	/**
	 * The index action.
	 *
	 * @access  public
	 * @return  void
	 */
	public function action_index(){
		$this->template->title = 'dashboard';
		$admin_view='admin/dashboard';
		if(Auth::get_groups()[0][1]==20){
				$this->template->title = 'FPBase';
				$admin_view='admin/';
				Response::redirect('/admin');
		}
		$this->template->content = View::forge($admin_view);
	}

	// gnumcs - 1703181018 - https://fuelphp.com/docs/packages/auth/examples/auth.html
	public function action_lostpassword($hash = null){
		$val = Validation::forge();
		// was the lostpassword form posted?
		if (\Input::method() == 'POST'){
			$val->add('email', 'Email')
			->add_rule('required');
			if ($val->run()){
				// do we have a posted email address?
				if ($email = \Input::post('email')){
					// do we know this user?
					if ($user = \Model\Auth_User::find_by_email($email)){
						// generate a recovery hash
						$hash = \Auth::instance()->hash_password(\Str::random()).$user->id;
						// and store it in the user profile
						\Auth::update_user(
							array(
							'lostpassword_hash' => $hash,
							'lostpassword_created' => time()
							),
							$user->username
						);
						$body=_('Reset-Password-for-user').":".$user->username.
						"\n".
						Uri::create('admin/lostpassword/' . base64_encode($hash) . '/');

						Email2::send2(Config::get('project_name'),$email,"[".Config::get('project_name')."] - Reset Password",$body);
						Session::set_flash('success', e(__('admin.You-have-an-email').'!'));
					}
				}
			}
		}
		// no form posted, do we have a hash passed in the URL?
		elseif ($hash !== null){
			// decode the hash
			$hash = base64_decode($hash);
			// get the userid from the hash
			$user = substr($hash, 44);
			// and find the user with this id
			if ($user = \Model\Auth_User::find_by_id($user)){
				// do we have this hash for this user, and hasn't it expired yet (we allow for 24 hours response)?
				if (!empty(Arr::get($user->profile_fields,'lostpassword_hash')) and
							Arr::get($user->profile_fields,'lostpassword_hash') == $hash
							and time() - Arr::get($user->profile_fields,'lostpassword_created') < 86400){
					// invalidate the hash
					\Auth::update_user(
						array(
						'lostpassword_hash' => null,
						'lostpassword_created' => null
						),
						$user->username
					);
					// log the user in and go to the profile to change the password
					if (\Auth::instance()->force_login($user->id)){
						Session::set_flash('success', e(__('admin.login.password-recovery-accepted')));
						Session::set_flash('success', e(__('admin.welcome').', '.$user->username));
						Response::redirect('admin/users/newpassword/'.$user->id);
					}
				}
			}
			else{
				// something wrong with the hash
				Session::set_flash('error', e(__('admin.login.recovery-hash-invalid')));
			}
		}
		// no form posted, and no hash present. no clue what we do here
		$this->template->title = 'Lost Password';
		$this->template->content = View::forge('admin/lostpassword', array('val' => $val), false);
	}
}

/* End of file admin.php */
