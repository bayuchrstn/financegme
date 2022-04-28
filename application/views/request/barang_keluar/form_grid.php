<?php
	$options = array();
	$options['component'] = 'component/tab/tab_default';
	$options['tab_id'] = 'tab1';
	$options['tab_padding'] = 'no';
	$options['max'] = '8';
	$options['selected_tab'] = 'approval_form_'.$prefix;
	$options['tabs'] = array();

	$options['tabs'][] = array(
			'label'         => 'Approval Barang Keluar',
			'id'            => 'approval_form_'.$prefix,
			'content'       => 'approval_form_'.$prefix,
		);

	$options['tabs'][] = array(
			'label'         => 'Detail Request',
			'id'            => 'detail_request_'.$prefix,
			'content'       => 'detail_request_'.$prefix,
		);


	$content = $this->ui->load_component($options);
	echo $content;
?>
