<?php
	$data = array();
	$data['prefix'] = 'insert';
	$options = array();
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_karyawan_insert';
	$options['modal_size'] = 'modal-lg';
	$options['modal_icon'] = $this->theme->icon('Karyawan');
	$options['modal_title'] = 'Input Karyawan';
	$options['modal_footer'] = 'no';
	$options['form_id'] = 'form_karyawan_insert';
	$options['form_action'] = base_url().'karyawan/insert';
	$options['main_content'] = $this->load->view('karyawan/form_grid', $data, TRUE);
	echo $this->ui->load_component($options);
?>
