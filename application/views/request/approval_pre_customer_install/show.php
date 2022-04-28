<?php

// pre($modul);
// pre($detail);
// pre($task_ext);

$options = array();
$options['component'] = 'component/table/table_data_info';
$options['label_width'] = '150';
$options['sparator_width'] = '10';

$options['data_row'] = array();
$options['data_row']['Tanggal'] = blank_component('date', 'show');
$options['data_row']['Nama Pelanggan'] = blank_component('customer_name', 'show');
$options['data_row']['Produk'] = blank_component('product', 'show');
$options['data_row']['Bandwidth'] = blank_component('bandwidth', 'show');
$options['data_row']['Nama Marketing'] = blank_component('marketing_name', 'show');
$options['data_row']['Judul'] = blank_component('judul', 'show');
$options['data_row']['Konten'] = blank_component('content', 'show');
$options['data_row']['Attachment'] = blank_component('attachment', 'show');

echo $this->ui->load_component($options);

function blank_component($id, $action) {
	return '<div id="'.$id.'_'.$action.'"></div>';
}

?>

<script type="text/javascript">

	get_task_attachment(<?php echo $detail['id']; ?>, 'attachment_show');

</script>