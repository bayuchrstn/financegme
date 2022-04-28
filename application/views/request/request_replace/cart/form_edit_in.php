<?php
	// pre($modul);
	// pre($prefix);
	$prefix = 'rp_in_update';
	$default_value = array();
	$default_value['options_type'] = 'in';
	$forms_task_request_replace = $this->ui->forms('task_request_replace', $default_value, $prefix);
	// pre($parent_task_detail);
?>
<div id="form_in_msg_div"></div>
<?php
	// echo $forms_task_request_replace['item'];
	// echo $forms_task_request_replace['item_detail'];
	echo $forms_task_request_replace['condition'];
	echo $forms_task_request_replace['note'];
	echo $forms_task_request_replace['options[task_parent]'];
	echo $forms_task_request_replace['options[type]'];
	echo $forms_task_request_replace['item_in_hidden'];
	echo $forms_task_request_replace['transaction_hidden'];

?>
<input type="hidden" name="rowid" id="rowid_<?php echo $prefix; ?>" value="">

<script type="text/javascript">
	var cart_detail = <?php echo json_encode($cart_detail); ?>;
	var item_detail = <?php echo json_encode($item_detail); ?>;
	var parent_task_detail = <?php echo json_encode($parent_task_detail); ?>;

	console.log(cart_detail);
	console.log(item_detail);
	console.log(parent_task_detail);


	$('#modal_rpc_in span#modal_title_custom').html('Barang Terpasang Di <?php //echo $location_name; ?>');
	set_option('<?php echo base_url(); ?>select_option/request/request_replace/kondisi_barang', 'condition_rp_in_update',cart_detail.options.condition);
	$('#note_rp_in_update').val(cart_detail.options.note);
	$('#rowid_rp_out').val(cart_detail.rowid);
	$('#task_parent_rp_in_update').val(parent_task_detail.id);
	$('#rowid_rp_in_update').val(cart_detail.rowid);
	$('#item_in_hidden_rp_in_update').val(cart_detail.options.item);
	$('#transaction_hidden_rp_in_update').val(cart_detail.options.transaction_id);
</script>
