<?php

	$data = array();
	$data['prefix'] = 'update';
	$options = array();
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_ipman_update';
	$options['modal_size'] = 'modal-default';
	$options['modal_icon'] = $this->theme->icon('ipman');
	$options['modal_title'] = $this->lang->line('ipman_update');
	$options['modal_footer'] = 'no';
	$options['form_id'] = 'form_ipman_update';
	$options['form_action'] = '';
	$options['main_content'] = $this->load->view('ipman/form_grid', $data, TRUE);
	echo $this->ui->load_component($options);
?>
