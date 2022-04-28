<?php
	// pre($detail);
	// $prefix = 'insert';
	$default_value = array();
	$default_value['qty'] = '1';

	// penting ----------------------------------------
	$default_value['table'] = $table;
	$default_value['prefix'] = $prefix;
	$default_value['task_id'] = $task_id;
	$default_value['target_div'] = $target_div;
	$default_value['parent_modul'] = $parent_modul;
	// penting ----------------------------------------

	$bcn_forms = $this->ui->forms('bcn', $default_value, $prefix);
	$task_item = $this->ui->forms('task_item', $default_value, $prefix);
	$forms_return_in = $this->ui->forms('task_request_replace', $default_value, $prefix);
?>

<div id="form_msg_div"></div>
<?php
	echo $forms_return_in['jumlah'];
	echo $forms_return_in['status_kepemilikan'];
	echo $forms_return_in['note'];
?>

<?php
	echo $task_item['table'];
	echo $task_item['prefix'];
	echo $task_item['task_id'];
	echo $task_item['target_div'];
	echo $task_item['parent_modul'];
	/////////////////////////////
	echo $task_item['id_item'];
?>

<input type="hidden" name="sender" value="1">
<input type="hidden" name="current_qty" id="current_qty_<?php echo $prefix; ?>" value="">

<script type="text/javascript">
	$(function(){
		if( $('.duit').length ) {
			// $('.duit').maskMoney({prefix:'Rp ', thousands:'.', decimal:',', precision:0});
			$('.duit').autoNumeric('init', {
				currencySymbol 				: 'Rp ',
				digitGroupSeparator        	: '.',
				decimalCharacter           : ',',
				decimalPlacesOverride: '0',
				minimumValue: '0',
				maximumValue: '999999999999',
			});
		}

		if( $('.angka').length ) {
			$('.angka').autoNumeric('init', {
				currencySymbol 				: '',
				digitGroupSeparator        	: '.',
				decimalCharacter           : ',',
				decimalPlacesOverride: '0',
				minimumValue: '0',
				maximumValue: '999999999999',
			});
		}
	});

	var detail = <?php echo json_encode($detail); ?>;
	console.log(detail);
	$('#jumlah_<?php echo $prefix; ?>').val(detail.qty);
	$('#current_qty_<?php echo $prefix; ?>').val(detail.qty);
	$('#id_item_<?php echo $prefix; ?>').val(detail.item_id);
	$('#note_<?php echo $prefix; ?>').val(detail.note);
	set_option('<?php echo base_url(); ?>select_option/request/request_replace/status_kepemilikan', 'status_kepemilikan_<?php echo $prefix; ?>', detail.owner_status);
</script>
