<?php
	$data = array();
	$data['prefix'] = 'insert';
	$options = array();
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_bts_insert';
	$options['modal_size'] = 'modal-default';
	$options['modal_icon'] = $this->theme->icon('bts');
	$options['modal_title'] = 'Input BTS';
	$options['modal_footer'] = 'no';
	$options['form_id'] = 'form_bts_insert';
	$options['form_action'] = base_url().'bts/insert';
	$options['main_content'] = $this->load->view('bts/form_grid', $data, TRUE);
	echo $this->ui->load_component($options);
?>
