<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Username', 'username', array('class'=>'control-label')); ?>
				<?php echo Form::input('username', Input::post('username', isset($user) ? ($user->username) : ''),
						array('class' => 'col-md-4 form-control', 'placeholder'=>'Username')); ?></div>
		<?php if(Request::active()->route->segments[2]=="create"):?>
		<div class="form-group">
			<?php echo Form::label('Password', 'password', array('class'=>'control-label')); ?>
				<?php echo Form::input('password', Input::post('password', isset($user) ? '' : ''),
						array('class' => 'col-md-4 form-control', 'placeholder'=>'Password')); ?></div>
		<?php endif;?>
		<div class="form-group">
			<?php echo Form::label('Group', 'group', array('class'=>'control-label')); ?>
				<?php echo Form::select('group', Input::post('grop', isset($user) ? $user->group : ''), 
					$grouplabel,
					array('class' => 'col-md-4 form-control', 'placeholder'=>'Group')); ?></div>
		<div class="form-group">
			<?php echo Form::label('Language', 'language', array('class'=>'control-label')); ?>
				<?php echo Form::select('language', Input::post('language', isset($user) ? Arr::get(unserialize(html_entity_decode($user->profile_fields)),"lang") : ''), 
					$language,
					array('class' => 'col-md-4 form-control', 'placeholder'=>'Language')); ?></div>
		<div class="form-group">
			<?php echo Form::label('Email', 'email', array('class'=>'control-label')); ?>
				<?php echo Form::input('email', Input::post('username', isset($user) ? ($user->email) : ''),
						array('class' => 'col-md-4 form-control', 'placeholder'=>'Email')); ?></div>

		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', __('admin.Save'), array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>