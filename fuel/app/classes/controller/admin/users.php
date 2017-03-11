<?php
class Controller_Admin_Users extends Controller_Admin
{

	public function action_index()
	{
		$data['users'] = Model_User::find('all',array('order_by' => array('last_login' => 'desc')));
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

	public function action_changepassword($id = null)
	{
		$user = Model_User::find($id);
		
		//Debug::dump(Input::post('password'));
		$val = Model_User::validatechangepassword('changepassword');

		if ($val->run())
		{
			$user->password = Input::post('password');
			$user->newpassword = Input::post('newpassword');
			$user->repeatnewpassword = Input::post('repeatnewpassword');
			
			if (Auth::change_password($user->password,$user->newpassword,$user->username))
			{
				Session::set_flash('success', e('Changed password for ' . $user->username));
				Response::redirect('admin/users/viewprofile');
			}
			else
			{
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

	public function action_create()
	{
		// generate grouplabel array
		$grouplabel=array();
		foreach(Auth::group('Simplegroup')->groups() as $label => $value):
			//Debug::dump($value);
			array_push($grouplabel,array($value=>Auth::group('Simplegroup')->get_name($value)));
		endforeach;
		
		
		if (Input::method() == 'POST')
		{
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
		$this->template->title = "Users";
		$this->template->content = View::forge('admin/users/create');

	}
	public function action_edit($id = null)
	{
		// generate grouplabel array
		$grouplabel=array();
		foreach(Auth::group('Simplegroup')->groups() as $label => $value):
			//Debug::dump($value);
			array_push($grouplabel,array($value=>Auth::group('Simplegroup')->get_name($value)));
		endforeach;
		
		$user = Model_User::find($id);
		$val = Model_User::validate('edit');
		
		if ($val->run())
		{
			$user->username = Input::post('username');
			$user->group = Input::post('group');
			$user->email = Input::post('email');

			if ($user->save())
			{
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
