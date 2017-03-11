<?php if(Auth::has_access(Request::active()->controller.'.index')):?>
	<?php echo Html::anchor('admin/users/','User List') ?> |
<?php endif;?>	
<?php if(Auth::has_access(Request::active()->controller.'.viewprofile')):?>
	<?php echo Html::anchor('admin/users/viewprofile/','View profile') ?> |
<?php endif;?>	
<?php if(Auth::has_access(Request::active()->controller.'.changepassword')):?>
	<?php echo Html::anchor('admin/users/changepassword/','Change Password') ?> |
<?php endif;?>	
<?php if(Auth::has_access(Request::active()->controller.'.changeprofile')):?>
	<?php echo Html::anchor('admin/users/changeprofile/','Edit Profile') ?> |
<?php endif;?>	
	<?php echo Html::anchor('admin', 'Back'); ?>

