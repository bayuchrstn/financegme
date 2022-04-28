

<?php
	$data = array();
	$data['prefix'] = 'update';

	$options = array();
	$options['component'] = 'component/tab/tab_default';
	$options['tab_id'] = 'tab1';
	$options['tab_padding'] = 'no';
	$options['max'] = '8';
	$options['selected_tab'] = 'data_karyawan';
	$options['tabs'] = array();

	$options['tabs'][] = array(
			'label'         => 'Data Karyawan',
			'id'            => 'data_karyawan',
			'content'       => '<div id="div_data_karyawan"></div>',
		);
	$options['tabs'][] = array(
			'label'         => 'Riwayat Pendidikan',
			'id'            => 'riwayat_pendidikan',
			'content'       => '<div id="div_riwayat_pendidikan"></div>',
		);
	$options['tabs'][] = array(
			'label'         => 'Pengalaman Kerja',
			'id'            => 'pengalaman_kerja',
			'content'       => '<div id="div_pengalaman_kerja"></div>',
		);
	$options['tabs'][] = array(
			'label'         => 'Dokumen',
			'id'            => 'dokumen',
			'content'       => '<div id="div_dokumen"></div>',
		);

	// $options['tabs'][] = array(
	// 		'label'         => 'Edit',
	// 		'id'            => 'edit_delete_request',
	// 		'content'       => '<div id="div_info_request"></div>',
	// 	);
	$tabs = $this->ui->load_component($options);

	$options = array();
	$options['component'] = 'component/modal/modal_default';
	$options['modal_id'] = 'modal_karyawan_update';
	$options['modal_size'] = 'modal-full';
	$options['modal_icon'] = $this->theme->icon('Karyawan');
	$options['modal_title'] = 'Update Karyawan';
	$options['modal_footer'] = 'no';
	// $options['form_id'] = 'form_karyawan_update';
	$options['form_action'] = '';
	$options['main_content'] = '';
	// $options['main_content'] = '<div id="ext_update_alert"></div>';
	$options['main_content'] .= $tabs;
	echo $this->ui->load_component($options);
?>
