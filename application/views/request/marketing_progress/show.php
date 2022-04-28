<?php
// pre($modul);
// pre($detail);
// pre($task_ext);

$options = array();
$options['component'] = 'component/table/table_data_info';
$options['label_width'] = '200';
$options['sparator_width'] = '10';
$options['data_row'] = array();

$options['data_row']['Nama Marketing'] = $detail['author_name'];
$options['data_row']['Tanggal '] = format_date($detail['date_created']);
$options['data_row']['Pre Customer'] = $detail['location_name'];
$options['data_row']['Progress'] = $detail['mp_level'];
$options['data_row']['Judul'] = $detail['subject'];
$options['data_row']['Keterangan'] = $detail['body'];

if($task_ext['tanggal_request_survey']):
	$options['data_row']['Tanggal Request Survey'] = $task_ext['tanggal_request_survey'];
endif;

if($task_ext['tanggal_request_install']):
	$options['data_row']['Tanggal Request Installasi'] = $task_ext['tanggal_request_install'];
endif;

//get task report
$condition = array(
	'{PRE}task.task_category'	=> 'task_report',
	'{PRE}task.status'	=> 'selesai',
	'{PRE}task.location_id'	=> $detail['location_id'],
	'{PRE}task.subject'	=> $detail['subject']
);
$this->db->select('task.*, users.name AS author')
	->where($condition)
	->join('users','users.id = task.author', 'left');
$report = $this->db->get('task')->row_array();

// if (!empty($report)) {
// 	$options['data_row']['Laporan'] = $report['body'];
// 	$options['data_row']['Dibuat'] = $report['author'].' pada '.$report['date_created'];
// }

echo $this->ui->load_component($options);

if (!empty($report)) {
	$content['component'] = 'component/grid/12';
	$content['label_width'] = '200';
	$content['sparator_width'] = '10';
	$content['columns'][] = '<hr><b>Laporan</b><br>'.'Dibuat oleh : '.$report['author'].' pada '.$report['date_created'].'<br>'.$report['body'];
	echo $this->ui->load_component($content);
}
?>
