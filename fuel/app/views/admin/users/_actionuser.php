<?php if(Auth::has_access(Request::active()->controller.'.index')):?>
	<?php echo Html::anchor('admin/users/',__('admin.UserList')) ?> |
<?php endif;?>	
<?php if(Auth::has_access(Request::active()->controller.'.viewprofile')):?>
	<?php echo Html::anchor('admin/users/viewprofile/',__('admin.ViewProfile')) ?> |
<?php endif;?>	
<?php if(Auth::has_access(Request::active()->controller.'.changepassword')):?>
	<?php echo Html::anchor('admin/users/changepassword/',__('admin.ChangePassword')) ?> |
<?php endif;?>	
<?php if(Auth::has_access(Request::active()->controller.'.changeprofile')):?>
	<?php echo Html::anchor('admin/users/changeprofile/',__('admin.EditProfile')) ?> |
<?php endif;?>	
	<?php echo Html::anchor('admin', __('admin.Back')); ?>

