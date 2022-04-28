<?php
$this->load->model('Model_supplier', 'supplier');
$this->load->model('Model_bcn', 'bcn');
// pre($modul);
// pre($detail);
// pre($task_ext);

$options = array();
$options['component'] = 'component/table/table_data_info';
$options['label_width'] = '150';
$options['sparator_width'] = '10';
$options['data_row'] = array();

$options['data_row']['Pelanggan'] = blank_component('customer_name', 'show');
$options['data_row']['Layanan'] = blank_component('product_name', 'show');
$options['data_row']['Customer ID / Service ID'] = blank_component('id', 'show');
$options['data_row']['Alamat'] = blank_component('customer_address', 'show');
$options['data_row']['Email'] = blank_component('email', 'show');
$options['data_row']['Kontak Person'] = blank_component('contact_person', 'show');
$options['data_row']['Telepon Rumah'] = blank_component('telephone_home', 'show');
$options['data_row']['Handphone'] = blank_component('telephone_mobile', 'show');
$options['data_row']['Telepon Kantor'] = blank_component('telephone_work', 'show');

echo $this->ui->load_component($options);

function blank_component($id, $action) {
	return '<div id="'.$id.'_'.$action.'"></div>';
}
?>

<?php
	$this->db->where('task_id', $detail['id']);
	$data['items'] = $this->db->get('task_boq')->result_array();
	echo $this->load->view('request/boq/show/boq', $data, TRUE);
?>
