<?php
	// pre($detail);
	$default_value = array();
	$default_value['date_approve'] = now();
	$prefix = 'return_item';
	$forms_return_item = $this->ui->forms('return_item', $default_value, $prefix);
	// pre($this->ui->forms_debug($forms_return_item));

	echo $forms_return_item['bcn'];
	echo $forms_return_item['nomor_barang'];
	echo $forms_return_item['return_status'];
	echo $forms_return_item['note'];
	echo $forms_return_item['date_approve'];
	echo $forms_return_item['status'];
	echo $forms_return_item['task_id'];
	echo $forms_return_item['transaction_id'];
	echo $forms_return_item['id_item_detail'];
	echo $forms_return_item['id_task_ri'];

?>
<script type="text/javascript">
	var detail = <?php echo json_encode($detail); ?>;
	console.log(detail);
	$('#bcn_return_item').val(detail.bcn);
	$('#nomor_barang_return_item').val(detail.nomor_mac);

	$('#task_id_return_item').val(detail.task_id);
	$('#transaction_id_return_item').val(detail.transaction_id);
	$('#id_item_detail_return_item').val(detail.item_detail_id);
	$('#id_task_ri_return_item').val(detail.id);


	set_option('<?php echo base_url(); ?>select_option/request/barang_masuk/status_barang_kembali', 'return_status_return_item', detail.codition);
	set_option('<?php echo base_url(); ?>select_option/request/barang_masuk/terima_status', 'status_return_item', detail.status);
	$(function() {
		if( $('.date_picker').length ) {

			$( ".date_picker" ).datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: 'yy-mm-dd'
			});
		}

		if( $('.datetime_picker').length ) {

			$( ".datetime_picker" ).datetimepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: 'yy-mm-dd',
				timeFormat: 'HH:mm:ss'
			});
		}

	});
</script>
