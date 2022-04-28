<?php
	$data = array();
	$data['prefix'] = 'insert';
	$options = array();
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_finance_forecast_income_out';
	$options['modal_size'] = 'modal-default';
	//$options['modal_icon'] = $this->theme->icon('finance_forecast_income_out');
	$options['modal_title'] = '<i class="material-icons">&#xE865;</i> Form <span id="title_modal_flexible"></span>';
	$options['modal_footer'] = 'no';
	$options['form_id'] = 'formulir_modal';
	$options['form_action'] = '';
	$options['main_content'] = $this->load->view('finance_forecast_income/form_grid', $data, TRUE);
	echo $this->ui->load_component($options);
?>
