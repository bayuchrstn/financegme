<?php
// pre($arr_jenis_task);
// pre($table);
$options = array();
$options['component'] = 'component/tab/tab_default';
$options['tab_id'] = 'tab1';
$options['tab_padding'] = 'no';
$options['max'] = '8';
$options['selected_tab'] = 'table_survey';
$options['tabs'] = array();

foreach($arr_jenis_task as $code=>$val):
	$options['tabs'][] = array(
			'label'         => $val,
			'id'            => 'table_'.$code,
			'content'       => $table[$code],
		);

endforeach;
$content = $this->ui->load_component($options);
echo $content;

$options['component'] = 'component/modal/modal_tab';
$options['modal_id'] = 'modal_tab_detail_pekerjaan';
$options['modal_size'] = 'modal-lg';
$options['modal_icon'] = '';
$options['modal_title'] = 'Detail Pekerjaan';
$options['tabs'] = array();
$options['max'] = '8';
$options['selected_tab'] = 'show_detail_pekerjaan';
$options['tabs'][] = array(
		'label'         => 'Detail Pekerjaan',
		'id'            => 'show_detail_pekerjaan',
		'content'       => '<div id="xshow_detail_pekerjaan_div"></div>',
	);
$options['tabs'][] = array(
		'label'         => 'laporan Hasil Pekerjaan',
		'id'            => 'show_laporan_hasil_pekerjaan',
		'content'       => '<div id="xshow_laporan_hasil_pekerjaan_div"></div>',
	);


echo $this->ui->load_component($options);

?>
