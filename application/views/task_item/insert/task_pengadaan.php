<?php
	// $prefix = 'insert';
	$default_value = array();
	$default_value['qty'] = '1';
	$default_value['table'] = $table;
	$default_value['prefix'] = $prefix;
	$default_value['task_id'] = $task_id;
	$default_value['target_div'] = $target_div;
	$default_value['parent_modul'] = $parent_modul;
	$bcn_forms = $this->ui->forms('bcn', $default_value, $prefix);
	$pengadaan_forms = $this->ui->forms('task_item', $default_value, $prefix);
?>

<div id="form_msg_div"></div>

<?php
	echo $pengadaan_forms['item_selector'];
?>

<div id="barang_div">
	<?php echo $bcn_forms['item_brand']; ?>
	<?php echo $bcn_forms['item_category']; ?>
	<?php echo $bcn_forms['item_name']; ?>
</div>

<div id="custom_div" class="hidden">
	<?php echo $pengadaan_forms['item_id_custom']; ?>
</div>
<?php
	echo $pengadaan_forms['qty'];
	echo $pengadaan_forms['table'];
	echo $pengadaan_forms['prefix'];
	echo $pengadaan_forms['task_id'];
	echo $pengadaan_forms['target_div'];
	echo $pengadaan_forms['parent_modul'];
?>


<script type="text/javascript">


	$('#barang_div').addClass('hidden');
	$('#custom_div').removeClass('hidden');

	<?php if($prefix=='insert'): ?>
	set_option('<?php echo base_url(); ?>select_option/request/pengajuan_barang/item_selector', 'item_selector_insert', 'custom');
	bcn_picker('1', '4', '3', 'item_brand_insert', 'item_category_insert', 'item_name_insert');
	<?php else: ?>
	set_option('<?php echo base_url(); ?>select_option/request/pengajuan_barang/item_selector', 'item_selector_update', 'custom');
	bcn_picker('1', '4', '3', 'item_brand_update', 'item_category_update', 'item_name_update');
	<?php endif; ?>




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


	// <?php if($prefix=='insert'): ?>
	//
	// <?php else: ?>
	//
	// <?php endif; ?>

	<?php if($prefix=='insert'): ?>
	if( $('#item_brand_insert').length ){
		$('#item_brand_insert').change(function(){
			var brand = $(this).val();
			bcn_picker(brand, '', '', 'item_brand_insert', 'item_category_insert', 'item_name_insert');
		});
	}

	if( $('#item_category_insert').length ){
		$('#item_category_insert').change(function(){
			var brand = $('#item_brand_insert').val();
			var cat = $(this).val();
			bcn_picker(brand, cat, '', 'item_brand_insert', 'item_category_insert', 'item_name_insert');
		});
	}
	<?php else: ?>
	if( $('#item_brand_update').length ){
		$('#item_brand_update').change(function(){
			var brand = $(this).val();
			bcn_picker(brand, '', '', 'item_brand_update', 'item_category_update', 'item_name_update');
		});
	}

	if( $('#item_category_update').length ){
		$('#item_category_update').change(function(){
			var brand = $('#item_brand_update').val();
			var cat = $(this).val();
			bcn_picker(brand, cat, '', 'item_brand_update', 'item_category_update', 'item_name_update');
		});
	}
	<?php endif; ?>



	$(document).ready(function(){
		// $('#up_select_insert').change(function(){
		// 	var ref = $('#up_select_insert').val();
		// 	$.ajax({
	    //         type:'GET',
	    //         url: '<?php echo base_url(); ?>xhr/boq/get_survey_ref/'+ref,
	    //         success: function(res) {
	    //             var response = jQuery.parseJSON(res);
		// 			// console.log(response);
		// 			// console.log(response.location_id);
		// 			// alert(response.location_id);
		// 			$('#location_insert').val(response.location);
		// 			$('#location_id_insert').val(response.location_id);
		// 			// $('#boq_item_from_ts').html(response.item_from_ts);
		// 			getajax('<?php echo base_url(); ?>ajax_request/show_boq/'+response.id, 'boq_item_from_ts');
	    //         }
	    //     });
	    //     return false;
		// });

		<?php if($prefix=='insert'): ?>
		$('#item_selector_insert').change(function(){
			var mode = $(this).val();
			if(mode=='barang'){
				$('#barang_div').removeClass('hidden');
				$('#custom_div').addClass('hidden');
			} else {
				$('#barang_div').addClass('hidden');
				$('#custom_div').removeClass('hidden');
			}
			return false;
		});
		<?php else: ?>
		$('#item_selector_update').change(function(){
			var mode = $(this).val();
			if(mode=='barang'){
				$('#barang_div').removeClass('hidden');
				$('#custom_div').addClass('hidden');
			} else {
				$('#barang_div').addClass('hidden');
				$('#custom_div').removeClass('hidden');
			}
			return false;
		});
		<?php endif; ?>


	});
</script>
