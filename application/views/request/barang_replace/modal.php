<?php
	$data = array();
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_item_detail_approval';
	$options['modal_size'] = 'modal-default';
	$options['modal_icon'] = 'icon-search4';
	$options['modal_title'] = 'default title';
	$options['form_id'] = 'form_item_detail_approval';
	$options['form_action'] = base_url().'ajax/save_item_out';
	$options['main_content'] = $this->load->view('request/barang_keluar/item_detail_picker', $data, TRUE);
	echo $this->ui->load_component($options);

	$options['component'] = 'component/modal/modal_default';
	$options['modal_id'] = 'modal_detail_ri';
	$options['modal_size'] = 'modal-lg';
	$options['modal_icon'] = $this->theme->icon($modul['code']);
	$options['modal_title'] = 'Detail Request';
	$options['main_content'] = '<div id="modal_detail_ri_div"></div>';
	echo $this->ui->load_component($options);

	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_penerimaan';
	$options['modal_size'] = 'modal-default';
	$options['modal_icon'] = $this->theme->icon($modul['code']);
	$options['modal_title'] = 'Penerimaan Barang Masuk';
	$options['form_id'] = 'modal_penerimaan_form';
	$options['form_action'] = '';
	$options['main_content'] = '<div id="modal_penerimaan_div"></div>';
	echo $this->ui->load_component($options);
?>
