<div class="jumbotron">
	<h1><?php echo __('admin.'.'welcome');?> <?php echo $current_user->username ?>!</h1>
	<!--
	<p>Scansione il QR Code!</p>
	<p><a href="intent://scan/#Intent;scheme=zxing;package=com.google.zxing.client.android;end"><img class="zxing" src="<?php echo Asset::get_file('com.google.zxing.client.android.png','img');?>"></a></p>
	<p>Aggiungi Scansione Manualmente</p>
	<p><a class="btn btn-primary btn-lg" href="/admin/scans/create">Aggiungi</a></p>
	-->
</div>
