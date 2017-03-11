<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Name', 'name', array('class'=>'control-label')); ?>

				<?php echo Form::input('name', Input::post('name', isset($store) ? strtoupper($store->name) : ''), array('class' => 'uppercase col-md-4 form-control', 'placeholder'=>'Name')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Note', 'note', array('class'=>'control-label')); ?>

				<?php echo Form::input('note', Input::post('note', isset($store) ? $store->note : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Note')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>