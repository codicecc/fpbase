<?php
class Controller_Admin_Info extends Controller_Admin{

	public function action_index(){	
		$this->template->title = "Info";
		$this->template->content = View::forge('admin/info/index');
	}
}
