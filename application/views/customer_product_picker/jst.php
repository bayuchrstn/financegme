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
	});
</script>
