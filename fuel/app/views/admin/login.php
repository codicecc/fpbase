<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<!--<div class="login-panel panel panel-default">-->

		<div class="login-panel" style="margin-bottom:1rem;">
			<?php echo Asset::img(Config::get('project_logo'), array('id' => 'login-logo','title'=>Config::get('project_name')));?>
		</div>
		<div class=" panel panel-default">
				<div class="panel-heading">
						<h3 class="panel-title">Please Sign In</h3>
				</div>
				<div class="panel-body">
					<?php echo Form::open(array()); ?>

						<?php if (isset($_GET['destination'])): ?>
							<?php echo Form::hidden('destination', $_GET['destination']); ?>
						<?php endif; ?>

						<?php if (isset($login_error)): ?>
							<div class="error"><?php echo $login_error; ?></div>
						<?php endif; ?>

						<div class="form-group <?php echo ! $val->error('email') ?: 'has-error' ?>">
							<?php echo Form::input('email', Input::post('email'), array('class' => 'form-control', 'placeholder' => 'Email or Username', 'autofocus')); ?>

							<?php if ($val->error('email')): ?>
								<span class="control-label"><?php echo $val->error('email')->get_message('You must provide a username or email'); ?></span>
							<?php endif; ?>
						</div>

						<div class="form-group <?php echo ! $val->error('password') ?: 'has-error' ?>">
							<?php echo Form::password('password', null, array('class' => 'form-control', 'placeholder' => 'Password')); ?>

							<?php if ($val->error('password')): ?>
								<span class="control-label"><?php echo $val->error('password')->get_message(':label cannot be blank'); ?></span>
							<?php endif; ?>
						</div>

						<div class="form-group">
							<label for="lostpassword"><a href="<?php echo Uri::create('admin/lostpassword');?>">Forgot?</a></label>
						</div>

						<div class="actions">
							<?php echo Form::submit(array('value'=>'Login', 'name'=>'submit', 'class' => 'btn btn-lg btn-success btn-block ')); ?>
						</div>

					<?php echo Form::close(); ?>
				</div>
			</div>
		</div>
</div>
