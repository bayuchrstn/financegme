<?php
	// pre($modul_view);
	// pre($detail);
	// pre($modul_access);
	$arr_option = array(
		'restrict'		=> 'Restrict',
		// 'full_view'		=> 'Full view',
		'full_access'	=> 'Full access',
	);
?>
<input type="hidden" name="usergroup" value="<?php echo $detail['code']; ?>">
<table class="table">
	<thead>
		<tr>
			<th>Nama Modul</th>
			<th>View Access</th>
		</tr>
	</thead>
	<?php if(!empty($modul_view)): ?>
	<tbody>
		<?php
			foreach($modul_view as $row):
				$selected = (isset($modul_access[$row['code']])) ? $modul_access[$row['code']] : 'restrict';
		?>
		<tr>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo form_dropdown('modul_access['.$row['code'].']', $arr_option, $selected, ''); ?></td>
		</tr>
		<?php
			endforeach;
		?>
	</tbody>
	<?php endif; ?>
</table>
<input type="hidden" name="sender" value="1">
