<?php
	// pre($prefix);
	$data['prefix'] = $prefix;
	$options = array();
	$options['component'] = 'component/tab/tab_default';
	$options['tab_id'] = 'tab1';
	$options['tab_padding'] = 'no';
	$options['max'] = '8';
	$options['selected_tab'] = 'data_ticket';
	$options['tabs'] = array();

	$options['tabs'][] = array(
			'label'         => 'Data Ticket',
			'id'            => 'data_ticket',
			'content'       => $this->load->view('request/ticket/form_grid_update', $data, TRUE),
		);

	$options['tabs'][] = array(
			'label'         => 'Detail',
			'id'            => 'detail_ticket',
			'content'       => '<div id="detail_ticket_div">Timeline</div>',
		);
	$options['tabs'][] = array(
			'label'         => 'Time Line',
			'id'            => 'timeline_ticket',
			'content'       => '<div id="timeline_ticket_div">Timeline</div>',
		);
	$content = $this->ui->load_component($options);
	echo $content;
?>
