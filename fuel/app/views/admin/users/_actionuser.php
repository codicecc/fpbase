<?php if(Auth::has_access(Request::active()->controller.'.index')):?>
	<?php echo Html::anchor('admin/users/',__('admin.UserList'),array("class"=>"btn btn-info")) ?> 
<?php endif;?>	
<?php if(Auth::has_access(Request::active()->controller.'.viewprofile')):?>
	<?php echo Html::anchor('admin/users/viewprofile/',__('admin.ViewProfile'),array("class"=>"btn btn-primary")) ?> 
<?php endif;?>	
<?php if(Auth::has_access(Request::active()->controller.'.changepassword')):?>
	<?php echo Html::anchor('admin/users/changepassword/',__('admin.ChangePassword'),array("class"=>"btn btn-warning")) ?> 
<?php endif;?>	
<?php if(Auth::has_access(Request::active()->controller.'.changeprofile')):?>
	<?php echo Html::anchor('admin/users/changeprofile/',__('admin.EditProfile'),array("class"=>"btn btn-warning")) ?> 
<?php endif;?>	
	<?php echo Html::anchor('admin', __('admin.Back'),array("class"=>"btn btn-info")); ?>

