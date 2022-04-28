<?php
	$data = array();
	$data['prefix'] = 'update';
	$options = array();
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_user_update';
	$options['modal_size'] = 'modal-lg';
	$options['modal_icon'] = $this->theme->icon('user');
	$options['modal_title'] = 'Input User';
	$options['modal_footer'] = 'no';
	$options['form_id'] = 'form_user_update';
	$options['form_action'] = '';
	$options['main_content'] = $this->load->view('user/form_grid_update', $data, TRUE);
	echo $this->ui->load_component($options);
?>
