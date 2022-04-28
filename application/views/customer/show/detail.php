<?php
	// pre($customer_info);
	$options = array();
	$options['component'] = 'component/table/table_data_info';
	$options['label_width'] = '150';
	$options['sparator_width'] = '10';
	$options['data_row'] = array();

	$options['data_row']['Customer ID'] = $customer_info['customer_id'];
	$options['data_row']['Service ID'] = $customer_info['service_id'];
	$options['data_row']['Nama'] = $customer_info['customer_name'];
	$options['data_row']['Alamat'] = $customer_info['customer_address'];
	$options['data_row']['Kontak Person'] = $customer_info['contact_person'];
	$options['data_row']['Telepon Rumah'] = $customer_info['telephone_home'];
	$options['data_row']['handphone'] = $customer_info['telephone_mobile'];
	$options['data_row']['Telepon Kantor'] = $customer_info['telephone_work'];
	$options['data_row']['Fax'] = $customer_info['fax'];
	$options['data_row']['Email'] = $customer_info['email'];
	$options['data_row']['Marketing'] = $customer_info['am_name'];
	$options['data_row']['Jenis pelanggan'] = $customer_info['mcustomer_type'];
	$options['data_row']['Telepon Kantor'] = $customer_info['telephone_work'];
	$options['data_row']['Layanan'] = $customer_info['layanan'][0]['product_name'].' '.$customer_info['layanan'][0]['value'].' '.$customer_info['layanan'][0]['satuan_bandwidth'];

	$harga = $this->customer->show_customer_value($customer_info['id']);
	if ($harga!==false) {
		$options['data_row']['Harga'] = $harga;
		// print_r($customer_info['layanan']);
	}

	echo $this->ui->load_component($options);
?>
