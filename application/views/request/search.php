<?php
	$data = array();
	$data['prefix'] = 'search';
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_asearch';
	$options['modal_size'] = 'modal-standart';
	$options['modal_icon'] = $this->theme->icon('marketing_progress');
	$options['modal_title'] = 'Search Marketing progress';
	// $options['modal_footer'] = 'no';
	$options['form_id'] = 'form_marketing_progress_search';
	$options['form_action'] = base_url().'poe';
	$options['main_content'] = $this->load->view('request/'.$modul['code'].'/search', $data, TRUE);
	echo $this->ui->load_component($options);
?>
