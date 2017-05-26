<h2><?php echo __('admin.EditUserPassword');?>: <?php echo Auth::get('username');?></h2>
<br>
<?php echo render('admin/users/_changepassword'); ?>
<p>
<?php if(Auth::has_access(Request::active()->controller.'.view')):?>
		<?php echo Html::anchor('admin/users/view/'.Auth::get('id'), __('admin.View'),array("class"=>"btn btn-primary")); ?> 
<?php endif;?>

<?php echo render('admin/users/_actionuser'); ?>
</p>
