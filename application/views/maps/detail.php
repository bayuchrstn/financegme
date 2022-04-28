<?php
	/*
	$data = array();
	$data['prefix'] = 'detail';
	// $data['category'] = $this->maps->get_maps_type_icon();
	$options = array();
	$options['component'] = 'component/modal/modal_default';
	$options['modal_id'] = 'modal_maps_detail';
	$options['modal_size'] = 'modal-lg';
	$options['modal_icon'] = $this->theme->icon('maps');
	$options['modal_title'] = 'Detail maps';
	$options['modal_footer'] = 'no';
	// $options['form_id'] = 'form_maps_detail';
	// $options['form_action'] = base_url().'maps/detail';
	$options['main_content'] = '<div id="body_detail_maps"></div>';
	$options['main_content'] .= '<iframe id="maps_frame" width="100%" height="360" src="#" frameborder="0" style="border:0" allowfullscreen></iframe>';
	// $options['main_content'] = $this->parser->parse('maps/form_grid', $data, TRUE);
	echo $this->ui->load_component($options);
	*/
	$options['component'] = 'component/modal/modal_tab';
	$options['modal_id'] = 'modal_maps_detail';
	$options['modal_size'] = 'modal-lg';
	$options['modal_icon'] = 'icon-search4';
	$options['modal_title'] = 'Detail Maps';
	$options['tabs'] = array();
	$options['max'] = '8';
	$options['selected_tab'] = 'show_detail_maps';
	$options['tabs'][] = array(
			'label'         => 'Detail Maps',
			'id'            => 'show_detail_maps',
			'content'       => '<div class="col-md-12">
				<div id="body_detail_maps"></div>
				<iframe id="maps_frame" width="100%" height="360" src="#" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>',
		);

	$options['tabs'][] = array(
			'label'         => 'Daftar Perangkat',
			'id'            => 'tab_daftar_perangkat',
			'content'       => '<div class="col-md-12" id="daftar_perangkat"></div>',
		);
	echo $this->ui->load_component($options);
?>
