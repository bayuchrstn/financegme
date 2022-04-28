<?php

	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_usergroup_modul_view';
	$options['modal_size'] = 'modal-default';
	$options['modal_icon'] = '';
	$options['modal_title'] = 'Custom Modul Access';
	$options['form_id'] = 'modal_usergroup_modul_view_form';
	$options['form_action'] = '';
	$options['main_content'] = '<div id="modal_usergroup_modul_view_form_div"></div>';
	echo $this->ui->load_component($options);

	//insert
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_usergroup_insert';
	$options['modal_size'] = 'modal-default';
	$options['modal_icon'] = '';
	$options['modal_title'] = 'Custom Modul Access';
	$options['form_id'] = 'modal_usergroup_insert_form';
	$options['form_action'] = '';
	$options['main_content'] = '<div id="modal_usergroup_insert_div"></div>';
	echo $this->ui->load_component($options);

	//update
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_usergroup_update';
	$options['modal_size'] = 'modal-default';
	$options['modal_icon'] = '';
	$options['modal_title'] = 'Custom Modul Access';
	$options['form_id'] = 'modal_usergroup_update_form';
	$options['form_action'] = '';
	$options['main_content'] = '<div id="modal_usergroup_update_div"></div>';
	echo $this->ui->load_component($options);

	//jabatan
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_jabatan';
	$options['modal_size'] = 'modal-default';
	$options['modal_icon'] = '';
	$options['modal_title'] = 'Custom Modul Access';
	$options['form_id'] = 'modal_jabatan_form';
	$options['form_action'] = '';
	$options['main_content'] = '<div id="modal_jabatan_div"></div>';
	echo $this->ui->load_component($options);

	//jabatan main
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_input_jabatan';
	$options['modal_size'] = 'modal-default';
	$options['modal_icon'] = '';
	$options['modal_title'] = 'Input Jabatan';
	$options['form_id'] = 'modal_input_jabatan_form';
	$options['form_action'] = base_url('usergroup/insert_jabatan');
	$options['main_content'] = '<div id="modal_input_jabatan_div"></div>';
	echo $this->ui->load_component($options);

?>
