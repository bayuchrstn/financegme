<?php
	$data = array();
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_people_ext_update';
	$options['modal_size'] = 'modal-default';
	$options['modal_icon'] = 'icon-search4';
	$options['modal_title'] = '';
	$options['form_id'] = 'form_people_ext_update';
	$options['form_action'] = '';
	$options['main_content'] = '<div id="people_ext_update_div"></div>';
	echo $this->ui->load_component($options);

	$data = array();
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_people_ext_insert';
	$options['modal_size'] = 'modal-default';
	$options['modal_icon'] = 'icon-search4';
	$options['modal_title'] = '';
	$options['form_id'] = 'form_people_ext_insert';
	$options['form_action'] = '';
	$options['main_content'] = '<div id="people_ext_insert_div"></div>';
	echo $this->ui->load_component($options);
?>
