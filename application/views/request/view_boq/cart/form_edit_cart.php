<?php
	// pre($carts[$rowid]);
	$default_value = array();
	$prefix = 'update_cart';
	$bcn_forms = $this->ui->forms('bcn', $default_value, $prefix);
	$pengadaan_forms = $this->ui->forms('task_pengadaan', $default_value, $prefix);
?>

<?php
	// echo $pengadaan_forms['supplier'];
	echo $pengadaan_forms['qty'];
	echo $pengadaan_forms['price'];
?>
<input type="hidden" name="rowid" id="rowid_<?php echo $prefix; ?>" value="">
<input type="hidden" name="prefix" value="<?php echo $prefix_mode; ?>">

<script type="text/javascript">
	var current = <?php echo json_encode($carts[$rowid]); ?>;
	$('#qty_update_cart').val(current.qty);
	$('#price_update_cart').val(current.price);
	$('#rowid_update_cart').val('<?php echo $rowid; ?>');



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
