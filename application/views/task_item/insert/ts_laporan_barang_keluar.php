<?php
	$default_value = array();
	$default_value['options_type'] = 'out';

	// penting--------------------------------------
	$default_value['table'] = $table;
	$default_value['prefix'] = $prefix;
	$default_value['task_id'] = $task_id;
	$default_value['target_div'] = $target_div;
	$default_value['parent_modul'] = $parent_modul;
	// penting--------------------------------------


	$bcn_forms = $this->ui->forms('bcn', $default_value, $prefix);
	$task_item = $this->ui->forms('task_item', $default_value, $prefix);
	$forms_task_request_replace = $this->ui->forms('task_request_replace', $default_value, $prefix);
?>
<div id="form_msg_div"></div>

<?php
	echo $bcn_forms['item_brand'];
	echo $bcn_forms['item_category'];
	echo $bcn_forms['item_name'];
	echo $forms_task_request_replace['jumlah'];
	echo $forms_task_request_replace['status_kepemilikan'];
	echo $forms_task_request_replace['note'];
	echo $forms_task_request_replace['options[task_parent]'];
	echo $forms_task_request_replace['options[type]'];
?>

<?php
// penting--------------------------------------
echo $task_item['table'];
echo $task_item['prefix'];
echo $task_item['task_id'];
echo $task_item['target_div'];
echo $task_item['parent_modul'];
// penting--------------------------------------
?>

<input type="hidden" name="sender" value="1">
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

set_option('<?php echo base_url(); ?>select_option/request/request_replace/status_kepemilikan', 'status_kepemilikan_<?php echo $prefix; ?>');
bcn_picker('1', '4', '3', 'item_brand_<?php echo $prefix; ?>', 'item_category_<?php echo $prefix; ?>', 'item_name_<?php echo $prefix; ?>');
// bcn_picker
function bcn_picker(brand, category, name, fbrand, fcategory, fname)
{
	$.ajax({
		type:'GET',
		url: '<?php echo base_url(); ?>bcn_picker/index/'+brand+'/'+category,
		success: function(res) {
			var response = jQuery.parseJSON(res);
			// console.log(response);

			// console.log(brand);
			// console.log(category);
			// console.log(name);

			var sel_brand = (brand !='') ? brand : response.selected_brand;
			var sel_category = (category !='') ? category : response.selected_category;
			var sel_name = (name !='') ? name : response.selected_name;

			// console.log(sel_brand);
			// console.log(sel_category);
			// console.log(sel_name);

			$('#'+fbrand).html(response.brand).val(sel_brand).chosen().trigger('chosen:updated');
			$('#'+fcategory).html(response.category).val(sel_category).chosen().trigger('chosen:updated');
			$('#'+fname).html(response.name).val(sel_name).chosen().trigger('chosen:updated');

			// built_cart_form(sel_name);
		}
	});
}

if( $('#item_brand_<?php echo $prefix; ?>').length ){
	$('#item_brand_<?php echo $prefix; ?>').change(function(){
		var brand = $(this).val();
		bcn_picker(brand, '', '', 'item_brand_<?php echo $prefix; ?>', 'item_category_<?php echo $prefix; ?>', 'item_name_<?php echo $prefix; ?>');
	});
}

if( $('#item_category_<?php echo $prefix; ?>').length ){
	$('#item_category_<?php echo $prefix; ?>').change(function(){
		var brand = $('#item_brand_<?php echo $prefix; ?>').val();
		var cat = $(this).val();
		// alert(brand+' '+cat);
		// alert(brand);
		bcn_picker(brand, cat, '', 'item_brand_<?php echo $prefix; ?>', 'item_category_<?php echo $prefix; ?>', 'item_name_<?php echo $prefix; ?>');
	});
}
</script>
