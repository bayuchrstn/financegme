<?php
	$default_value = array();
	$default_value['options_type'] = 'out';
	$prefix = 'rp_out';
	$bcn_forms = $this->ui->forms('bcn', $default_value, $prefix);
	$forms_task_request_replace = $this->ui->forms('task_request_replace', $default_value, $prefix);
?>
<div id="form_out_msg_div"></div>

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

<input type="hidden" name="sender" value="1">
<input type="hidden" name="prefix_mode" value="<?php echo $prefix_mode; ?>">

<script type="text/javascript">
	$('#task_parent_rp_out').val($('#up_select_<?php echo $prefix_mode; ?>').val());
	set_option('<?php echo base_url(); ?>select_option/request/request_replace/status_kepemilikan', 'status_kepemilikan_rp_out');

	bcn_picker('1', '4', '3', 'item_brand_rp_out', 'item_category_rp_out', 'item_name_rp_out');
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

	if( $('#item_brand_rp_out').length ){
		$('#item_brand_rp_out').change(function(){
			var brand = $(this).val();
			bcn_picker(brand, '', '', 'item_brand_rp_out', 'item_category_rp_out', 'item_name_rp_out');
		});
	}

	if( $('#item_category_rp_out').length ){
		$('#item_category_rp_out').change(function(){
			var brand = $('#item_brand_rp_out').val();
			var cat = $(this).val();
			// alert(brand+' '+cat);
			// alert(brand);
			bcn_picker(brand, cat, '', 'item_brand_rp_out', 'item_category_rp_out', 'item_name_rp_out');
		});
	}

	$(function(){


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
