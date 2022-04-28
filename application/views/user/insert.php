<?php
	$data = array();
	$data['prefix'] = 'insert';
	$options = array();
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_user_insert';
	$options['modal_size'] = 'modal-lg';
	$options['modal_icon'] = $this->theme->icon('user');
	$options['modal_title'] = 'Input User';
	$options['modal_footer'] = 'no';
	$options['form_id'] = 'form_user_insert';
	$options['form_action'] = base_url().'user/insert';
	$options['main_content'] = $this->load->view('user/form_grid', $data, TRUE);
	echo $this->ui->load_component($options);
?>
