<h2><?php echo(__('admin.UserList'));?></h2>
<br>

<?php
//var_dump(Auth::group('Simplegroup')->groups());
?>
<?php if ($users): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>id <?php echo utilities::listOrderField('id');?></th>
			<th>username <?php echo utilities::listOrderField('username');?></th>
			<th>lang</th>
			<th>group <?php echo utilities::listOrderField('group');?></th>
			<th>email <?php echo utilities::listOrderField('email');?></th>
			<th>last_login <?php echo utilities::listOrderField('last_login');?></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($users as $item): ?>		<tr>

			<td><?php echo $item->id; ?></td>
			<td><?php echo $item->username; ?></td>
			<td><?php echo Arr::get(unserialize(html_entity_decode($item->profile_fields)),"lang"); ?></td>
			<td><?php echo Auth::group('Simplegroup')->get_name($item->group); ?></td>
			<td><?php echo $item->email; ?></td>
			<td><?php echo date("Y-m-d H:i:s",$item->last_login); ?></td>
			<td>
				<?php //echo Utilities::adminActions($item,Request::active()->route->segments[1],array(array('View','view'),array('Edit','edit'),array('Delete','delete'),));
					echo Utilities::adminActions($item,Request::active()->route->segments[1],array(array(__('admin.ChangePassword'),'changepassword'),array(__('admin.View'),'view'),array(__('admin.Edit'),'edit'),array(__('admin.Delete'),'delete'),));
				?>
			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Stores.</p>

<?php endif; ?><p>
<?php if(Auth::has_access(Request::active()->controller.'.create')):?>
	<?php echo Html::anchor('admin/users/create', __('admin.AddNewUser'), array('class' => 'btn btn-success')); ?>
<?php endif;?>

</p>
