<?php
	$options['component'] = 'component/modal/modal_tab';
	$options['modal_id'] = 'modal_show_this';
	$options['modal_size'] = 'modal-lg';
	$options['modal_icon'] = 'icon-search4';
	$options['modal_title'] = 'Detail Customer';
	$options['tabs'] = array();
	$options['max'] = '8';
	$options['selected_tab'] = 'show_detail_customer';
	$options['tabs'][] = array(
			'label'         => 'Detail Customer',
			'id'            => 'show_detail_customer',
			'content'       => '<div id="show_detail_customer"></div>',
		);

	$options['tabs'][] = array(
			'label'         => 'Daftar Perangkat',
			'id'            => 'daftar_perangkat',
			'content'       => '<div id="daftar_perangkat"></div>',
		);
	echo $this->ui->load_component($options);
?>
