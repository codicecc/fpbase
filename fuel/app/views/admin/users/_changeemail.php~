<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Your password', 'password', array('class'=>'control-label')); ?>

				<?php echo Form::input('password', Input::post('password'), array('autocomplete'=>'off','type' => 'password','class' => 'col-md-4 form-control', 'placeholder'=>'Your Password')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('New password', 'newpassword', array('class'=>'control-label')); ?>

				<?php echo Form::input('newpassword', Input::post('newpassword'), array('autocomplete'=>'off','type' => 'password', 'class' => 'col-md-4 form-control', 'placeholder'=>'New Password')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Repeat New password', 'repeatnewpassword', array('class'=>'control-label')); ?>

				<?php echo Form::input('repeatnewpassword', Input::post('repeatnewpassword'), array('autocomplete'=>'off','type' => 'password', 'class' => 'col-md-4 form-control', 'placeholder'=>'Repeat New Password')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>