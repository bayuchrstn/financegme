<?php
	$default_value = array();
	$default_value['options_type'] = 'out';
	$prefix = 'rp_out_update';
	// $bcn_forms = $this->ui->forms('bcn', $default_value, $prefix);
	$forms_task_request_replace = $this->ui->forms('task_request_replace', $default_value, $prefix);
	// pre($carts[$rowid]);

?>
<div id="form_out_msg_div"></div>
<?php
	echo $forms_task_request_replace['jumlah'];
	echo $forms_task_request_replace['status_kepemilikan'];
	echo $forms_task_request_replace['note'];
	echo $forms_task_request_replace['options[task_parent]'];
	echo $forms_task_request_replace['options[type]'];
?>
<input type="hidden" name="rowid" id="rowid_<?php echo $prefix; ?>" value="">
<input type="hidden" name="sender" value="1">
<script type="text/javascript">
	var cart_detail = <?php echo json_encode($cart_detail); ?>;
	var item_detail = <?php echo json_encode($item_detail); ?>;
	var parent_task_detail = <?php echo json_encode($parent_task_detail); ?>;
	console.log(cart_detail);
	console.log(item_detail);
	$('#jumlah_rp_out_update').val(cart_detail.qty);
	$('#note_rp_out_update').val(cart_detail.options.note);
	$('#rowid_rp_out_update').val(cart_detail.rowid);
	$('#task_parent_rp_out_update').val(parent_task_detail.id);
	set_option('<?php echo base_url(); ?>select_option/request/request_replace/status_kepemilikan', 'status_kepemilikan_rp_out_update', cart_detail.options.status_kepemilikan);
</script>
