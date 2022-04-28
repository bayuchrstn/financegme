<?php
	$options = array();
	$data = array();
	$options['component'] = 'component/tab/tab_default';
	$options['tab_id'] = 'tab1_'.$prefix;
	$options['tab_padding'] = 'no';
	$options['max'] = '8';
	$options['selected_tab'] = 'create_task_'.$prefix;
	$options['tabs'] = array();

	$options['tabs'][] = array(
			'label'         => 'Create Task',
			'id'            => 'create_task_'.$prefix,
			'content'       => $this->load->view('request/view_marketing_request/form_grid_create_task', $data, TRUE),
		);

	$options['tabs'][] = array(
			'label'         => 'Marketing Request Info',
			'id'            => 'marketing_request_info_'.$prefix,
			'content'       => '<div id="info_request_'.$prefix.'"></div>',
		);


	$content = $this->ui->load_component($options);
	echo $content;
?>
