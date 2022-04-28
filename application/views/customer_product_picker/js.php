<script type="text/javascript">
	function set_product(product_category, product, product_category_select, product_list_div)
	{
		$.ajax({
			type:'GET',
			url: '<?php echo base_url(); ?>customer_product_picker/index/'+product_category+'/'+product,
			success: function(res) {
				var response = jQuery.parseJSON(res);
				// console.log(response);
				// $('#'+product_category_select).html(response.product_category).val(product_category).chosen().trigger('chosen:updated');
				$('#'+product_category_select).html(response.product_category).val(product_category);
				$('#'+product_list_div).html(response.product_lists);
			}
		});
	}


	// alert('c');

	function get_product(c)
	{
		// console.log(c.value);
		set_product(c.value, '', 'product_category_insert', 'product_div_selector_insert');
	}

</script>
