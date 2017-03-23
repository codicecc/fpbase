<?php
class Controller_Admin_Users extends Controller_Admin{

	public function action_index(){		
		
		is_null(Input::get('orderby'))?$orderby="last_login":$orderby=Input::get('orderby');
		is_null(Input::get('order'))?$order="asc":$order=Input::get('order');
		
		$data['users'] = Model_User::find('all',array('order_by' => array($orderby => $order)));
		$this->template->title = "Users";
		$this->template->content = View::forge('admin/users/index', $data);
	}
	public function action_viewprofile(){
		$data['user'] = Model_User::find(Auth::get_user_id()[1]);
		$this->template->title = "View User Profile";
		$this->template->content = View::forge('admin/users/view', $data);
	}

	public function action_view($id = null){
		$data['user'] = Model_User::find($id);
		$this->template->title = "View User";
		$this->template->content = View::forge('admin/users/view', $data);
	}

	public function action_changeprofile()
	{
		$user = Model_User::find(Auth::get_user_id()[1]);
		
		$val = Model_User::validatechangeprofile('profile');

		if ($val->run())
		{
			$user->username = Input::post('username');
			$user->email = Input::post('email');
			
			if ($user->save())
			{
				Session::set_flash('success', e('Changed data for ' . $user->username));
				Response::redirect('admin/users/viewprofile');
			}
			else
			{
				Session::set_flash('error', e('Could not change data for ' . $user->username));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->set_global('user', $user);
		$this->template->title = "Users";
		$this->template->content = View::forge('admin/users/changeprofile');
	}

	public function action_changeemail()
	{
		$user = Model_User::find(Auth::get_user_id()[1]);
		
		$val = Model_User::validatechangeemail('changeemail');

		if ($val->run())
		{
			$user->email = Input::post('email');
			
			if ($user->save())
			{
				Session::set_flash('success', e('Changed email for ' . $user->username));
				Response::redirect('admin/users/viewprofile');
			}
			else
			{
				Session::set_flash('error', e('Could not change email for ' . $user->username));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->set_global('user', $user);
		$this->template->title = "Users";
		$this->template->content = View::forge('admin/users/changeemail');
	}

	public function action_changepassword()
	{
		list(, $userid) = Auth::get_user_id();
		$user = Model_User::find($userid);
		//Debug::dump(Input::post('password'));
		$val = Model_User::validatechangepassword('changepassword');

		if ($val->run()){
			$user->password = Input::post('password');
			$user->newpassword = Input::post('newpassword');
			$user->repeatnewpassword = Input::post('repeatnewpassword');
			
			if (Auth::change_password($user->password,$user->newpassword,$user->username)){
				Session::set_flash('success', e('Changed password for ' . $user->username));
				Response::redirect('admin/users/viewprofile');
			}
			else{
				Session::set_flash('error', e('Could not change password for ' . $user->username));
			}
		}
		else
		{
			if (Input::method() == 'POST')
			{
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->set_global('user', $user);
		$this->template->title = "Users";
		$this->template->content = View::forge('admin/users/changepassword');
	}
	public function action_newpassword($id = null){
	
		list(, $userid) = Auth::get_user_id();
		if($id===null){
			Session::set_flash('error', __('This-request-is-not-correct').'!');
		}
		elseif($id==$userid){
			$user = Model_User::find($id);
			// reset the password for the current user
			$new_password = Auth::reset_password($user->username);
			Session::set_flash('success', e(__('admin.New-Password-is').': ' . $new_password));
			$this->template->set_global('user', $user);
			$this->template->title = __("admin.Assigned-new-Password");
			$this->template->content = View::forge('admin/users/changepassword');
			Response::redirect('admin/users/changepassword');			
		}
		Response::redirect('admin');
	}

	public function action_create()
	{
		// generate grouplabel and language array
		$grouplabel=utilities::agrouplabel();
		$language=utilities::alanguage();
		
		if (Input::method() == 'POST'){
			$val = Model_User::validate('create');

			if ($val->run())
			{
				$user = Model_User::forge(array(
					'username' => Input::post('username'),
					'password' => Input::post('password'),
					'group' => Input::post('group'),
					'email' => Input::post('email'),
				));

				if (Auth::create_user(
					Input::post('username'),
					Input::post('password'),
					Input::post('email'),
					Input::post('group'))
				)
				{
					Auth::update_user(array('lang'=>Input::post('language'),'lang2'=>null), $user->username);
					Session::set_flash('success', e('Created user #'.$user->username.'.'));
					Response::redirect('admin/users');
				}

				else
				{
					Session::set_flash('error', e('Could not create user.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		
		//$this->template->grouplabel=$grouplabel;
		
		$this->template->set_global('grouplabel', $grouplabel);
		$this->template->set_global('language', $language);
		$this->template->title = "Users";
		$this->template->content = View::forge('admin/users/create');

	}
	public function action_edit($id = null)
	{
		// generate grouplabel and language array
		$grouplabel=utilities::agrouplabel();
		$language=utilities::alanguage();
		
		$user = Model_User::find($id);
		$val = Model_User::validate('edit');
		
		if ($val->run())
		{
			$user->username = Input::post('username');
			$user->group = Input::post('group');
			$user->email = Input::post('email');

			if ($user->save()){
				Auth::update_user(array('lang'=>Input::post('language'),'lang2'=>null), $user->username);				
				Session::set_flash('success', e('Updated User #' . $user->username));
				Response::redirect('admin/users');
			}

			else
			{
				Session::set_flash('error', e('Could not update User #' . $user->username));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				Session::set_flash('error', $val->error());
			}
		}	

		$this->template->set_global('grouplabel', $grouplabel);
		$this->template->set_global('language', $language);
		$this->template->set_global('user', $user);
		$this->template->title = "Users";
		$this->template->content = View::forge('admin/users/edit');
}

	public function action_delete($id = null){
		if (Auth::delete_user(Model_User::find($id)->username)){
			
			Session::set_flash('success', e('Deleted user #'.Model_User::find($id)->username));
		}

		else
		{
			Session::set_flash('error', e('Could not delete store #'.Model_User::find($id)->username));
		}

		Response::redirect('admin/users');

	}
}
