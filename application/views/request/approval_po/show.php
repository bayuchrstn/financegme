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

$options['data_row']['Pembuat'] = $detail['author_name'];
$options['data_row']['Tanggal'] = format_date($detail['date_start']);
$options['data_row']['Lokasi Pekerjaan'] = $detail['location_name'];
$options['data_row']['judul'] = $detail['subject'];
$options['data_row']['keterangan'] = $detail['body'];

echo $this->ui->load_component($options);
?>

<?php
	$this->db->where('task_id', $detail['id']);
	$data['items'] = $this->db->get('task_boq')->result_array();
	echo $this->load->view('request/boq/show/boq', $data, TRUE);
?>
