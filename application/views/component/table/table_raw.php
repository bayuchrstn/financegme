<?php

	// Usage
	// $options = array();
	// $options['component'] = 'component/table/table_raw';
	// $options['class'] = 'aha';
	// $options['id'] = 'ehe';
	// $options['thead'] = array();
	// $options['thead'][] = array(
	// 	'label'	=> 'col 1',
	// 	'width'	=> '200',
	// );
	// $options['thead'][] = array(
	// 	'label'	=> 'col 2',
	// 	'width'	=> 'auto',
	// );
	//
	// $options['tbody'] = array();
	// $options['tbody'][] = array('aaaa', 'cccc');
	// $options['tbody'][] = array('334', 'cccsdvsdvc');
	// echo $this->ui->load_component($options);

	$class = (isset($class)) ? $class : '';
	$id = (isset($id)) ? $id : '';
	$thead = (isset($thead)) ? $thead : array();
	$tbody = (isset($tbody)) ? $tbody : array();
?>


<table class="<?php echo $class; ?>" id="<?php echo $id; ?>">
	<?php
		if(!empty($thead)):
	?>
	<thead>
		<tr>
			<?php
				foreach($thead as $th):
					$width = ($th['width']=='auto') ? '' : 'width="'.$th['width'].'"';
			?>
			<th <?php echo $width; ?>><?php echo $th['label']; ?></th>
			<?php
				endforeach;
			?>
		</tr>
	</thead>
	<?php
		endif;
	?>

	<?php
		if(!empty($tbody)):
	?>
	<tbody>
		<?php
			foreach($tbody as $tr):
				// pre($tr);
		?>
		<tr>
			<?php
				if(!empty($tr)):
					foreach($tr as $td):
						// pre($td);
						$width = ($td['width']=='auto') ? '' : 'width="'.$td['width'].'"';
			?>
			<td <?php echo $width; ?>><?php echo $td['label']; ?></td>
			<?php
					endforeach;
				endif;
			?>
		</tr>
		<?php
			endforeach;
		?>
	</tbody>
	<?php
		endif;
	?>

</table>
