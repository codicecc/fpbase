<?php

class Controller_Admin extends Controller_Base
{
	public $template = 'admin/template';

	public function before(){
		
		// gnucms Francesco Dattolo - 1703151147 - Set Language
		// The language value will loaded from user setting value. Now the italian langanguage is loaded manually
		// It's important it get loaded before of parent::before(). As It helped here: https://fuelphp.com/forums/discussion/11844/help-change-language-in-before-method
		Lang::set_lang('it', true);
		Lang::load('admin-locale','admin');
		
		parent::before();
	
		if (Request::active()->controller !== 'Controller_Admin' or ! in_array(Request::active()->action, array('login', 'logout')))
		{
			if (Auth::check())
			{
				if(!Auth::has_access(Request::active()->controller.'.'.Request::active()->action)) /** correct logical syntax - gnucms - francescodattolo - 1610100838 **/
				{
					Session::set_flash('error', e('You don\'t have access to the admin panel'));
					Response::redirect('/');
				}
			}
			else
			{
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

			if ($val->run())
			{
				if ( ! Auth::check())
				{
					if (Auth::login(Input::post('email'), Input::post('password')))
					{
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
		$this->template->content = View::forge($admin_view);
	}

}

/* End of file admin.php */
