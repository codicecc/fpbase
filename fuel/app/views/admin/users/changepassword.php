<h2>Change Password for user: <?php echo Auth::get('username');?></h2>
<br>
<?php echo render('admin/users/_changepassword'); ?>
<p>
<?php if(Auth::has_access(Request::active()->controller.'.view')):?>
		<?php echo Html::anchor('admin/users/view/'.Auth::get('id'), 'View'); ?> |
<?php endif;?>

<?php echo render('admin/users/_actionuser'); ?>
