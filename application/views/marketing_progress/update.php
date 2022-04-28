<?php
	$data = array();
	$data['prefix'] = 'update';
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_marketing_progress_update';
	$options['modal_size'] = 'modal-standart';
	$options['modal_icon'] = $this->theme->icon('marketing_progress');
	$options['modal_title'] = 'Update Marketing progress';
	// $options['modal_footer'] = 'no';
	$options['form_id'] = 'form_marketing_progress_update';
	$options['form_action'] = '';
	$options['main_content'] = $this->load->view('marketing_progress/form_grid', $data, TRUE);
	echo $this->ui->load_component($options);
?>
