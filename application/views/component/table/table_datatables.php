<?php
	//Usage example
	// $options['component'] = 'component/table/table_datatables';
	// $options['table_id'] = 'mrid_table';
	// $options['table_column'] = array();
	//
	// $options['table_column'][] = array(
	// 	'label'		=> 'kkkkk',
	// );
	//
	// $options['table_column'][] = array(
	// 	'label'		=> 'kkkkk',
	// );
	//
	// echo $this->ui->load_component($options);
?>

<table id="<?php echo $table_id; ?>" class="table table-hover table-striped datatable-js" style="width:100%">
	<thead>
		<tr>
			<?php
				foreach($table_column as $th):
					// pre($th);
					$width = (isset($th['width'])) ? 'width="'.$th['width'].'"' : '';
			?>
			<th <?php echo $width; ?>><?php echo $th['label']; ?></th>
			<?php
				endforeach;
			?>
		</tr>
	</thead>
</table>
