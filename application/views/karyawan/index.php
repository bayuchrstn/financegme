<?php
	$options['component'] = 'component/panel/panel_table';
	$options['panel_icon'] = $this->theme->icon('customer');
	$options['panel_title'] = 'Daftar Karyawan';
	$options['panel_action'] = array(
            '<a onclick="input_karyawan();" href="javascript:void(0)"><i class="icon-plus3"></i> Input Karyawan</a>
            <a onclick="advance_search();" href="javascript:void(0)"><i class="icon-search4"></i> Advance Search</a>',
        );
	$options['table_id'] = 'js_table_karyawan';
	$options['table_column'] = array(
			array('label'   => "#", 'width'=>'10'),
			array('label'   => 'NIK Order'),
			array('label'   => 'Nama'),
			array('label'   => 'NIK'),
			array('label'   => 'Departemen'),
			array('label'   => 'Jabatan'),
			array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
        );
	echo $this->ui->load_component($options);
	echo $insert_view;
    echo $update_view;
    echo $modal_view;
    echo $advance_search;
?>
