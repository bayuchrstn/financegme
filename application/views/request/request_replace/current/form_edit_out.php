<?php
	$default_value = array();
	$default_value['options_type'] = 'out';
	$prefix = 'current_out_update';
	$forms_task_request_replace = $this->ui->forms('task_request_replace', $default_value, $prefix);
?>
<?php
	echo $forms_task_request_replace['status_kepemilikan'];
	echo $forms_task_request_replace['note'];

?>
<input type="hidden" name="id" id="id_<?php echo $prefix; ?>" value="">
<input type="hidden" name="sender" value="1">


<script type="text/javascript">
    var detail = <?php echo json_encode($detail); ?>;
    $('#modal_current_update span#modal_title_custom').html('Update barang Keluar');
    set_option('<?php echo base_url(); ?>select_option/request/request_replace/status_kepemilikan', 'status_kepemilikan_current_out_update', detail.owner_status);
    $('#note_current_out_update').val(detail.note);
    $('#id_current_out_update').val(detail.id);
</script>
