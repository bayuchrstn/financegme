<?php
	$data = array();
	$data['prefix'] = 'search';
	$data['user_marketing'] = $this->customer->get_user_marketing();
	$options = array();
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_mf_search';
	$options['modal_size'] = 'modal-default';
	$options['modal_icon'] = '';
	$options['modal_title'] = 'Search MF';
	$options['modal_footer'] = 'no';
	$options['form_id'] = 'form_mf_search';
	$options['form_action'] = base_url().'marketing_fee/detail';
	$options['main_content'] = $this->load->view('marketing_fee/form_grid', $data, TRUE);
	echo $this->ui->load_component($options);
?>
