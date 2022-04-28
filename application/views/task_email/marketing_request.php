<strong>Request Pre Survey</strong>

<?php
    // pre($detail);
    $options = array();
	$options['component'] = 'component/table/table_data_info';
	$options['label_width'] = '150';
	$options['sparator_width'] = '10';
	$options['data_row'] = array();
	$options['data_row']['Nama Marketing'] = $detail['author_name'];
	$options['data_row']['Judul'] = $detail['subject'];
	$options['data_row']['Keterangan'] = $detail['body'];
	echo $this->ui->load_component($options);
?>

<strong>Informasi Pre Customer</strong>
