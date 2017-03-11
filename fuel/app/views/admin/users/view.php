<h2>Viewing <strong><?php echo $user->username; ?></strong></h2>

<p>
	<strong>id:</strong>
	<?php echo $user->id; ?></p>
<p>
	<strong>Username:</strong>
	<?php echo $user->username; ?></p>
<p>
	<strong>Group:</strong>
	<?php echo Auth::group('Simplegroup')->get_name($user->group); ?></p>
<p>
	<strong>Email:</strong>
	<?php echo $user->email; ?></p>
<p>
	<strong>Last login:</strong>
	<?php echo date("Y-m-d H:i:s",$user->last_login);  ?></p>

<?php echo render('admin/users/_actionuser'); ?>	