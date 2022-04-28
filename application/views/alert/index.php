<?php
    $options['component'] = 'component/panel/panel_table';
	$options['panel_icon'] = 'icon-bell3';
	$options['panel_title'] = 'Daftar Notifikasi';
	$options['panel_action'] = array();
	$options['table_id'] = 'js_table_alert';
	$options['table_column'] = array(
            array('label'   => '#', 'width'=>'5'),
            array('label'   => 'Keterangan'),
            array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
        );
	echo $this->ui->load_component($options);
    
?>
