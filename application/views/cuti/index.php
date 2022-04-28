<?php
	$options['component'] = 'component/panel/panel_table';
	$options['panel_icon'] = $this->theme->icon('cuti');
	$options['panel_title'] = $this->lang->line('cuti_alltitle');
	$options['panel_action'] = array(
            '<a onclick="insert_cuti();" href="javascript:void(0)"><i class="icon-plus3"></i> Tambah Cuti</a>',
        );
	$options['table_id'] = 'js_table_cuti';
	$options['table_column'] = array(
			array('label'   => '#', 'width'=>'5'),
	        array('label'   => $this->lang->line('cuti_name')),
	        array('label'   => $this->lang->line('cuti_date')),
	        array('label'   => $this->lang->line('cuti_length')),
	        array('label'   => $this->lang->line('cuti_status')),
	        array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
        );
	echo $this->ui->load_component($options);
?>

<?php
    echo $insert_view;
    echo $update_view;
    echo $delete_view;
    echo $update_status_view;
?>
