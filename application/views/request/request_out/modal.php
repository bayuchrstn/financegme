<?php
	$options = array();
	$options['component'] = 'component/tab/tab_default';
	$options['tab_id'] = 'tab1';
	$options['tab_padding'] = 'no';
	$options['max'] = '8';
	$options['selected_tab'] = 'info_request';
	$options['tabs'] = array();

	$options['tabs'][] = array(
			'label'         => 'Info Request',
			'id'            => 'info_request',
			'content'       => '<div id="div_info_request"></div>',
		);

	$options['tabs'][] = array(
			'label'         => 'Edit',
			'id'            => 'edit_delete_request',
			'content'       => $this->load->view('request/request_out/out_edit', '', TRUE),
		);
	$content = $this->ui->load_component($options);

	$data = array();
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_item_out_editor';
	$options['modal_size'] = 'modal-default';
	$options['modal_icon'] = 'icon-search4';
	$options['modal_title'] = '';
	$options['form_id'] = 'form_item_out_editor';
	$options['form_action'] = '';
	$options['main_content'] = $content;
	echo $this->ui->load_component($options);

	$options['component'] = 'component/modal/modal_default';
	$options['modal_id'] = 'modal_detail_ro';
	$options['modal_size'] = 'modal-lg';
	$options['modal_icon'] = $this->theme->icon($modul['code']);
	$options['modal_title'] = 'Detail Request';
	$options['main_content'] = '<div id="modal_detail_ro_div"></div>';
	echo $this->ui->load_component($options);

	//new
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_rpc_out';
	$options['modal_size'] = 'modal-default';
	$options['modal_icon'] = $this->theme->icon($modul['code']);
	$options['modal_title'] = 'Barang Dipasang';
	$options['form_id'] = 'modal_rpc_out_form';
	$options['form_action'] = base_url().'ajax_request/create_cart_pengadaan';
	$options['main_content'] = '<div id="modal_rpc_out_div"></div>';
	echo $this->ui->load_component($options);

	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_cart_update_out';
	$options['modal_size'] = 'modal-default';
	$options['modal_icon'] = $this->theme->icon($modul['code']);
	$options['modal_title'] = 'Update Barang Keluar';
	$options['form_id'] = 'modal_cart_update_out_form';
	$options['form_action'] = base_url().'ajax_request/modal_cart_update_out_action';
	$options['main_content'] = '<div id="modal_cart_update_out_div"></div>';
	echo $this->ui->load_component($options);

	//modal current update
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_current_update';
	$options['modal_size'] = 'modal-default';
	$options['modal_icon'] = $this->theme->icon($modul['code']);
	$options['modal_title'] = '';
	$options['form_id'] = 'modal_current_update_form';
	$options['form_action'] = '';
	$options['main_content'] = '<div id="modal_current_update_div"></div>';
	echo $this->ui->load_component($options);
?>
