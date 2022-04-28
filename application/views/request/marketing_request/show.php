<?php
    // pre($modul);
    // pre($detail);
    // pre($task_ext);

	$options = array();
	$options['component'] = 'component/table/table_data_info';
	$options['label_width'] = '150';
	$options['sparator_width'] = '10';
	$options['data_row'] = array();

	$options['data_row']['Nama'] = $detail['author_name'];
	// $options['data_row']['Tanggal '] = format_date($detail['date_created']);
	// $options['data_row']['Pre Customer'] = $detail['location_name'];
	// $options['data_row']['Progress'] = $detail['mp_level'];
	$options['data_row']['Judul'] = $detail['subject'];
	$options['data_row']['Keterangan'] = $detail['body'];
	$options['data_row']['Tanggal Request'] = $task_ext['date_request_start'];


	echo $this->ui->load_component($options);
?>
