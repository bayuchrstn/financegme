<?php
	// $prefix = 'insert';
	$default_value = array();
	// $default_value['qty'] = '1';
	$default_value['table'] = $table;
	$default_value['prefix'] = $prefix;
	$default_value['task_id'] = $task_id;
	$default_value['target_div'] = $target_div;
	$default_value['parent_modul'] = $parent_modul;
	$default_value['id'] = $id;
	$pengadaan_forms = $this->ui->forms('task_item', $default_value, $prefix);
?>

<div id="form_msg_div"></div>

<?php
echo $pengadaan_forms['qty'];
echo $pengadaan_forms['supplier'];
echo $pengadaan_forms['price'];
	echo $pengadaan_forms['table'];
	echo $pengadaan_forms['prefix'];
	echo $pengadaan_forms['task_id'];
	echo $pengadaan_forms['target_div'];
	echo $pengadaan_forms['parent_modul'];
	echo $pengadaan_forms['id'];
?>


<script type="text/javascript">

	var detail = <?php echo json_encode($detail); ?>;
	console.log(detail);
	$('#qty_<?php echo $prefix; ?>').val(detail.qty);
	$('#price_<?php echo $prefix; ?>').val(detail.price);

	<?php if($prefix=='insert'): ?>
	set_option('<?php echo base_url(); ?>select_option/request/pengajuan_barang/supplier', 'supplier_insert', '');
	<?php else: ?>
	set_option('<?php echo base_url(); ?>select_option/request/pengajuan_barang/supplier', 'supplier_update', detail.supplier);
	<?php endif; ?>

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
</script>
