<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<?php echo Asset::css(array(
		'bootstrap.css',
		'custom.css',
		'font-awesome.min.css',
		'sb-admin-2.min.css',
		));
	?>
	<style>
		body { margin: 50px; }
	</style>
	<?php echo Asset::js(array(
		'http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js',
		'bootstrap.js',
		'backToTop.js',
		'anchor-highlight.js',
		//'custom.js',
		//'codesource-ajax.js'
	)); ?>
	<script>
		$(function(){ $('.topbar').dropdown(); });
	</script>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body>

	<?php if ($current_user): ?>
	<div class="navbar navbar-defult navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/admin/"><?php echo Asset::img(Config::get('project_logo'), array('id' => 'logo','title'=>Config::get('project_name')));?></a>
			</div>
			<div class="navbar-collapse collapse">
			<?php

			//\Cache::delete_all();

			/**
			** 1705191311 ***
			** 1. Verifica la corretta posizione di questo array, su due piedi ritengo nel file config
			** 2. Verifica permessi
			**/

			echo Helper::build_menu(Config::get('navigation_bar'));
?>
			<ul class="nav navbar-nav pull-right">
					<li class="dropdown">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo $current_user->username ?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<?php if(Auth::has_access("Controller_Admin_Users.viewprofile")):?>
							<li><?php echo Html::anchor('admin/users/viewprofile', __('admin.UserProfile')) ?></li>
							<?php endif;?>
							<li><?php echo Html::anchor('admin/logout', __('admin.Logout')) ?></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php if ($current_user): ?>
				<h1><?php echo (($current_user)?__('admin.'.$title):Config::get('project_name')); ?></h1>
				<hr>
			<?php endif;?>
<?php if (Session::get_flash('success')): ?>
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<p>
					<?php echo implode('</p><p>', (array) Session::get_flash('success')); ?>
					</p>
				</div>
<?php endif; ?>
<?php if (Session::get_flash('error')): ?>
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<p>
					<?php echo implode('</p><p>', (array) Session::get_flash('error')); ?>
					</p>
				</div>
<?php endif; ?>
			</div>
			<div class="col-md-12">
<?php echo $content; ?>
			</div>
		</div>
		<?php if ($current_user): ?>
		<hr/>
		<footer class="noprint">
			<p class="pull-right">Page rendered in {exec_time}s using {mem_usage}mb of memory.</p>
			<p>
			<a href="http://www.francescodattolo.it/" target="_blank">
			<?php echo Asset::img('francescodattolo_favicon.png', array('id' => 'francescodattolofavicon','title'=>'Visibilità sul Web - Francescodattolo.it'));?></a>
			<a href="http://www.codice.cc/" target="_blank">
			<?php echo Asset::img('codice_favicon.png', array('id' => 'codicefavicon','title'=>'Web Developer Blog - Codice.Cc'));?></a>
			<a href="http://gnucms.org/" target="_blank">
			<?php echo Asset::img('gnucms_favicon.ico', array('id' => 'gnucmsfavicon','title'=>'Etica Hacker - GnuCMS.org'));?></a>
			</p>
			<p>
				<a href="http://fuelphp.com">FuelPHP</a> is released under the MIT license.<br>
				<small>Version: <?php echo e(Fuel::VERSION); ?></small>
			</p>
		</footer>
	<?php endif;?>
	</div>
	<div class="modal"><!-- LOADING MODAL --></div>
	<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>
</body>
</html>
