<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Username', 'username', array('class'=>'control-label')); ?>

				<?php echo Form::input('username', Input::post('username', isset($user) ? $user->username : ''), array('autocomplete'=>'off','type' => 'text','class' => 'col-md-4 form-control', 'placeholder'=>'Username')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Email', 'email', array('class'=>'control-label')); ?>

				<?php echo Form::input('email', Input::post('email', isset($user) ? $user->email : ''), array('autocomplete'=>'off','type' => 'text','class' => 'col-md-4 form-control', 'placeholder'=>'Email')); ?>
		</div>

		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', __('admin.Save'), array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>