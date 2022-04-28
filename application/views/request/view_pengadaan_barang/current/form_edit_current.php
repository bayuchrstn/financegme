<?php
	// pre($detail);
	$default_value = $detail;
	$prefix = 'update_current';
	$pengadaan_forms = $this->ui->forms('task_pengadaan', $default_value, $prefix);
?>

<?php
	echo $pengadaan_forms['qty'];
	echo $pengadaan_forms['price'];
?>
<input type="hidden" name="sender" value="1">
<input type="hidden" name="task_id" value="<?php echo $detail['task_id']; ?>">


<script type="text/javascript">
	// alert('ok');
	var d = <?php echo json_encode($detail); ?>;
	$('#qty_update_current').val(d.qty);
	$('#price_update_current').val(d.price);

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
