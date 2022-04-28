<?php
	$data = array();
	$options['component'] = 'component/modal/modal_default';
	$options['modal_id'] = 'modal_customer_insert';
	$options['modal_size'] = 'modal-lg';
	$options['modal_icon'] = $this->theme->icon('customer');
	$options['modal_title'] = 'Input Pre Customer';
	$options['modal_footer'] = 'no';
	// $options['main_content'] = $this->load->view('pre_customer/form_grid', $data, TRUE);
	$options['main_content'] = '<div id="insert_area_div"></div>';
	echo $this->ui->load_component($options);
?>
