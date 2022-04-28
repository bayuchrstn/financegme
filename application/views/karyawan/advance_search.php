<?php
	$data = array();
	$data['prefix'] = 'search';
	$options = array();
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_karyawan_search';
	$options['modal_size'] = 'modal-lg';
	$options['modal_icon'] = $this->theme->icon('Karyawan');
	$options['modal_title'] = 'Advance Search Karyawan';
	$options['modal_footer'] = 'no';
	$options['form_id'] = 'form_karyawan_search';
	$options['form_action'] = base_url().'karyawan/data';
	$options['main_content'] = $this->load->view('karyawan/advance_search_form', $data, TRUE);
	echo $this->ui->load_component($options);
?>
