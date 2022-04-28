<?php
	// pre($detail);
	// $prefix = 'insert';
	$default_value = array();
	$default_value['qty'] = '1';
	$default_value['table'] = $table;
	$default_value['prefix'] = $prefix;
	$default_value['task_id'] = $task_id;
	$default_value['target_div'] = $target_div;
	$default_value['parent_modul'] = $parent_modul;
	$bcn_forms = $this->ui->forms('bcn', $default_value, $prefix);
	$task_item = $this->ui->forms('task_item', $default_value, $prefix);
	$forms_return_in = $this->ui->forms('task_request_replace', $default_value, $prefix);
?>

<?php
	// pre($modul);
	// pre($prefix);
	// $default_value = array();
	// $default_value['options_type'] = 'in';
	// $prefix = 'rp_in';
	// $pengadaan_forms = $this->ui->forms('task_item', $default_value, $prefix);
?>

<div id="form_msg_div"></div>
<?php
	echo $forms_return_in['condition'];
	echo $forms_return_in['note'];
?>

<?php
	echo $task_item['table'];
	echo $task_item['prefix'];
	echo $task_item['task_id'];
	echo $task_item['target_div'];
	echo $task_item['parent_modul'];
	echo $task_item['id_item'];
?>

<input type="hidden" name="sender" value="1">

<script type="text/javascript">
	var detail = <?php echo json_encode($detail); ?>;
	// alert(detail.id);
	$('#note_<?php echo $prefix; ?>').val(detail.note);
	$('#id_item_<?php echo $prefix; ?>').val(detail.id);
	set_option('<?php echo base_url(); ?>select_option/request/request_replace/kondisi_barang', 'condition_update', detail.codition);
</script>
