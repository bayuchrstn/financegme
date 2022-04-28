<?php
// pre($modul);
// pre($detail);
// pre($task_ext);

$options = array();
$options['component'] = 'component/table/table_data_info';
$options['label_width'] = '200';
$options['sparator_width'] = '10';
$options['data_row'] = array();

$options['data_row']['Nama'] = $detail['author_name'];
$options['data_row']['Tanggal '] = format_date($detail['date_created']);
$options['data_row']['Judul'] = $detail['subject'];
$options['data_row']['Keterangan'] = $detail['body'];

// if($task_ext['tanggal_request_survey']):
// 	$options['data_row']['Tanggal Request Survey'] = $task_ext['tanggal_request_survey'];
// endif;
// if($task_ext['tanggal_request_install']):
// 	$options['data_row']['Tanggal Request Installasi'] = $task_ext['tanggal_request_install'];
// endif;


echo $this->ui->load_component($options);
?>
