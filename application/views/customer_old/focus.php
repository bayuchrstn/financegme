<?php
$arr = array();
$arr['tab_id'] = 'tab1';
$arr['tab_padding'] = 'no';
$arr['max'] = '8';
$arr['selected_tab'] = '1';
$arr['tabs'] = array();

$arr['tabs'][] = array(
		'label'         => 'Detail Pelanggan',
		'id'            => '1',
		'content'       => 'Detail pelanggan'
	);

$arr['tabs'][] = array(
		'label'         => 'Marketing Progress',
		'id'            => '2',
		'content'       => 'Marketing Progress',
	);
$arr['tabs'][] = array(
		'label'         => 'Daftar Perangkat',
		'id'            => '3',
		'content'       => 'Daftar Perangkat',
	);
$arr['tabs'][] = array(
		'label'         => 'Dokumen',
		'id'            => '4',
		'content'       => 'Dokumen',
	);


echo $this->ui->load_template('tab_default', $arr, TRUE);
?>
