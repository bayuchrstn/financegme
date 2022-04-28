<?php
	// pre($modul);
	// pre($prefix);
	$prefix = 'current_in_update';
	$default_value = array();
	$default_value['options_type'] = 'in';
	$forms_task_request_replace = $this->ui->forms('task_request_replace', $default_value, $prefix);
	// pre($parent_task_detail);
?>

<?php
	// echo $forms_task_request_replace['item'];
	// echo $forms_task_request_replace['item_detail'];
	echo $forms_task_request_replace['condition'];
	echo $forms_task_request_replace['note'];
?>

<input type="hidden" name="id" id="id_<?php echo $prefix; ?>" value="">
<input type="hidden" name="sender" value="1">

<script type="text/javascript">
    var detail = <?php echo json_encode($detail); ?>;
    $('#modal_current_update span#modal_title_custom').html('Update barang kembali');
    $('#note_current_in_update').val(detail.note);
    $('#id_current_in_update').val(detail.id);
    set_option('<?php echo base_url(); ?>select_option/request/request_replace/kondisi_barang', 'condition_current_in_update', detail.codition);
</script>
