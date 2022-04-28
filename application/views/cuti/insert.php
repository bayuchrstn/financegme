<?php
	$data = array();
	$data['prefix'] = 'insert';
	$options = array();
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_cuti_insert';
	$options['modal_size'] = 'modal-large';
	$options['modal_icon'] = $this->theme->icon('cuti');
	$options['modal_title'] = 'Input cuti';
	$options['modal_footer'] = 'no';
	$options['form_id'] = 'form_cuti_insert';
	$options['form_action'] = base_url().'cuti/insert';
	$options['main_content'] = '';
	$options['main_content'] = $this->load->view('cuti/form_grid', $data, TRUE);
	echo $this->ui->load_component($options);
?>
