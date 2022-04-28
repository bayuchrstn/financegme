<?php
	// pre($customer_info);
	$options = array();
	$options['component'] = 'component/table/table_data_info';
	$options['label_width'] = '150';
	$options['sparator_width'] = '10';
	$options['data_row'] = array();

	$options['data_row']['Nama'] = $customer_info['customer_name'];
	$options['data_row']['Alamat'] = $customer_info['customer_address'];
	$options['data_row']['Kontak Person'] = $customer_info['contact_person'];
	$options['data_row']['Telepon Rumah'] = $customer_info['telephone_home'];
	$options['data_row']['handphone'] = $customer_info['telephone_mobile'];
	$options['data_row']['Telepon Kantor'] = $customer_info['telephone_work'];
	$options['data_row']['Fax'] = $customer_info['fax'];
	$options['data_row']['Email'] = $customer_info['email'];
	$options['data_row']['Jenis pelanggan'] = $customer_info['mcustomer_type'];
	$options['data_row']['Jenis Link'] = $customer_info['mlink_type'];
	$options['data_row']['Marketing'] = $customer_info['am_name'];
	$options['data_row']['Kategori Layanan'] = $customer_info['product_category_name'];
	$harga = $this->customer->show_customer_value($customer_info['id']);
	if ($harga!==false) {
		$options['data_row']['Harga'] = $harga;
	}

	$data = array();
	$data['kategori_layanan'] = $customer_info['product_category'];
	$data['layanan'] = $customer_info['layanan'];
	$options['data_row']['Layanan'] = $this->load->view('customer/layanan', $data, TRUE);
	$options['data_row']['Marketing Progress'] = blank_component('marketing_progress', 'show');
	echo $this->ui->load_component($options);

	function blank_component($id, $action) {
		return '<div id="'.$id.'_'.$action.'"></div>';
	}
?>
