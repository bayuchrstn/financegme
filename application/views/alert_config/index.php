<?php
    $options['component'] = 'component/panel/panel_table';
	$options['panel_icon'] = 'icon-bell3';
	$options['panel_title'] = 'Konfigurasi Alert';
	$options['panel_action'] = array();
	$options['table_id'] = 'js_table_alert_config';
	$options['table_column'] = array(
            array('label'   => '#', 'width'=>'5'),
            // array('label'   => 'Kode'),
            array('label'   => 'Nama / Keterangan Alert'),
            array('label'   => 'Divisi'),
            array('label'   => 'Department'),
            array('label'   => 'Sub Department'),
            array('label'   => 'Jabatan'),
            array('label'   => 'User ID'),
            array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
        );
	echo $this->ui->load_component($options);
    echo $modal_view;
?>
