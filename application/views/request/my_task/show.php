<?php
$options = array();
$options['component'] = 'component/table/table_data_info';
$options['label_width'] = '150';
$options['sparator_width'] = '10';
$options['data_row'] = array();

// $options['data_row']['Customer ID'] = 'xxx';
// $options['data_row']['Service ID'] = 'yyy';
$options['data_row']['Judul'] = $detail['subject'];
$options['data_row']['Tanggal Mulai'] = format_date($detail['date_start']);
$options['data_row']['Tanggal Selesai'] = format_date($detail['date_due']);
$options['data_row']['Pembuat Task'] = $detail['author_name'];
$options['data_row']['Pembuat Task'] = $detail['author_name'];
$options['data_row']['Tanggal Task dibuat'] = format_date($detail['date_created']);
$options['data_row']['Lokasi Pekerjaan'] = $detail['location_name'];
$options['data_row']['Jenis Pekerjaan'] = $detail['jenis_pekerjaan'];
$options['data_row']['Pelaksana'] = $detail['pelaksana'];
$options['data_row']['Keterangan'] = $detail['body'];


echo $this->ui->load_component($options);
?>
