<?php
	$data = array();
	$data['prefix'] = 'insert';
	$options = array();
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_ipman_insert';
	$options['modal_size'] = 'modal-default';
	$options['modal_icon'] = $this->theme->icon('ipman');
	$options['modal_title'] = 'Input ipman';
	$options['modal_footer'] = 'no';
	$options['form_id'] = 'form_ipman_insert';
	$options['form_action'] = base_url().'ipman/insert';
	$options['main_content'] = $this->load->view('ipman/form_grid', $data, TRUE);
	echo $this->ui->load_component($options);
?>
