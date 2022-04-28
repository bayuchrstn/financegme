<?php
	// pre($existing_customer_info);
	$options = array();
	$options['component'] = 'component/table/table_data_info';
	$options['label_width'] = '150';
	$options['sparator_width'] = '10';
	$options['data_row'] = array();

	$options['data_row']['Nama']= $existing_customer_info['customer_name'];
	$options['data_row']['Alamat']= $existing_customer_info['customer_address'];
	$options['data_row']['Telepon']= $existing_customer_info['telephone_home'];
	$options['data_row']['Handphone']= $existing_customer_info['telephone_mobile'];
	$options['data_row']['Telepon Kantor']= $existing_customer_info['telephone_work'];
	$options['data_row']['Kontak Person']= $existing_customer_info['contact_person'];
	$options['data_row']['Email']= $existing_customer_info['email'];
	$options['data_row']['Fax']= $existing_customer_info['fax'];

	$info_html = $this->ui->load_component($options);
	echo $info_html;
?>
