<?php
	$data = array();
	$data['prefix'] = 'update';

	$options = array();
	$options['component'] = 'component/tab/tab_default';
	$options['tab_id'] = 'tab1';
	$options['tab_padding'] = 'no';
	$options['max'] = '8';
	$options['selected_tab'] = 'data_pelanggan';
	$options['tabs'] = array();

	$options['tabs'][] = array(
			'label'         => 'Data Pelanggan',
			'id'            => 'data_pelanggan',
			'content'       => '<div id="div_edit_global"></div>',
		);

	if(have_access('update_cs_product')):
		$options['tabs'][] = array(
				'label'         => 'Product',
				'id'            => 'edit_product',
				'content'       => '<div id="div_edit_product"></div>',
			);
	endif;

	if(have_access('update_cs_invoice_marketing')):
		$options['tabs'][] = array(
				'label'         => 'Marketing &amp; Invoice',
				'id'            => 'edit_invoice',
				'content'       => '<div id="div_edit_invoice_marketing"></div>',
			);
	endif;

	if(have_access('update_cs_teknis')):
		$options['tabs'][] = array(
				'label'         => 'Data Teknis',
				'id'            => 'edit_teknis',
				'content'       => '<div id="div_edit_teknis"></div>',
			);
	endif;

	if(have_access('update_cs_item')):
		$options['tabs'][] = array(
				'label'         => 'Data Perangkat',
				'id'            => 'edit_item',
				'content'       => '<div id="div_edit_item"></div>',
			);
	endif;

	$tabs = $this->ui->load_component($options);

	$options['component'] = 'component/modal/modal_default';
	$options['modal_id'] = 'modal_customer_update';
	$options['modal_size'] = 'modal-lg';
	$options['modal_icon'] = $this->theme->icon('customer');
	$options['modal_title'] = 'Update Pelanggan';
	$options['modal_footer'] = 'no';
	$options['form_id'] = 'form_customer_update';
	$options['form_action'] = '';
	// $options['main_content'] = $this->load->view('pre_customer/form_grid_update', $data, TRUE);
	$options['main_content'] = $tabs;
	echo $this->ui->load_component($options);
?>
