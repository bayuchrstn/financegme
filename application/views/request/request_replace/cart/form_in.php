<?php
	// pre($modul);
	// pre($prefix);
	$default_value = array();
	$default_value['options_type'] = 'in';
	$prefix = 'rp_in';
	$forms_task_request_replace = $this->ui->forms('task_request_replace', $default_value, $prefix);
?>
<div id="form_in_msg_div"></div>
<?php
	echo $forms_task_request_replace['item'];
	echo $forms_task_request_replace['item_detail'];
	echo $forms_task_request_replace['condition'];
	echo $forms_task_request_replace['note'];
	echo $forms_task_request_replace['options[task_parent]'];
	echo $forms_task_request_replace['options[type]'];

?>

<input type="hidden" name="sender" value="1">

<script type="text/javascript">
    $('#task_parent_rp_in').val($('#up_select_<?php echo $prefix_mode; ?>').val());
	$(document).ready(function(){
		$('#item_rp_in').change(function(){
			var item = $(this).val();
			// alert(item);
			set_option('<?php echo base_url(); ?>select_option/item_detail_terpasang/<?php echo $location; ?>/<?php echo $location_id; ?>/'+item, 'item_detail_rp_in','');
			return false;
		});
	});
	$('#modal_rpc_in span#modal_title_custom').html('Barang Terpasang Di <?php echo $location_name; ?>');
	set_option('<?php echo base_url(); ?>select_option/item_terpasang/<?php echo $location; ?>/<?php echo $location_id; ?>', 'item_rp_in','');
	set_option('<?php echo base_url(); ?>select_option/kosong', 'item_detail_rp_in','');
	set_option('<?php echo base_url(); ?>select_option/request/request_replace/kondisi_barang', 'condition_rp_in','');
</script>
