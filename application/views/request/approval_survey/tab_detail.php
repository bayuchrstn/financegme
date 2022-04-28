<?php
	// pre($prefix);
	$data['prefix'] = $prefix;
	$options = array();
	$options['component'] = 'component/tab/tab_default';
	$options['tab_id'] = 'tab_detail_ticket';
	$options['tab_padding'] = 'no';
	$options['max'] = '8';
	$options['selected_tab'] = 'detail_detail_ticket';
	$options['tabs'] = array();

	$options['tabs'][] = array(
			'label'         => 'Detail',
			'id'            => 'detail_detail_ticket',
			'content'       => '<div id="detail_detail_ticket_div"></div>',
		);
	$options['tabs'][] = array(
			'label'         => 'Time Line',
			'id'            => 'detail_timeline_ticket',
			'content'       => '<div id="detail_timeline_ticket_div"></div>',
		);
	$content = $this->ui->load_component($options);
	echo $content;
?>

