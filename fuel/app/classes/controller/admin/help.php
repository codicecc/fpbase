<?php
class Controller_Admin_Help extends Controller_Admin{

	public function action_index(){	
		$this->template->title = "Help";
		$this->template->content = View::forge('admin/help/index');
	}
}
