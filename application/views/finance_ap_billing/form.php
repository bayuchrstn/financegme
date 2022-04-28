<?php
	$data = array();
	$data['prefix'] = 'insert';
	$options = array();
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_formulir';
	$options['modal_size'] = 'modal-default';
	//$options['modal_icon'] = $this->theme->icon('finance_ap_billing');
	$options['modal_title'] = '<i class="material-icons">&#xE865;</i> Form <span id="title_modal_flexible"></span>';
	$options['modal_footer'] = 'no';
	$options['form_id'] = 'formulir_modal';
	$options['form_action'] = '';
	$options['main_content'] = $this->load->view('finance_ap_billing/form_grid', $data, TRUE);
	echo $this->ui->load_component($options);
?>
