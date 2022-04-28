<form id="form_customer_update_product" class="" action="<?php echo base_url(); ?>customer/customer_update_product" method="post">
	<div id="form_customer_update_product_msg"></div>
<?php
	// pre($detail);
	// pre($current_product);
	$default_value = array();
	$prefix = 'update_product';
	$forms = $this->ui->forms('customer', $default_value, $prefix);

?>
	<?php
		echo $forms['product_category'];
	?>
	<div class="form-group">
		<div id="product_div_selector_update"></div>
	</div>

	<?php echo $forms['id']; ?>
	<input type="hidden" id="senderdd" name="senderdd" value="1">
	<input type="hidden" name="sender" value="1">

	<div class="text-right">
		<button type="submit" class="btn btn-success" ><i class="position-left icon-checkmark"></i> Submit</button>
		<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="position-left icon-cancel-circle2"></i> Close</button>
	</div>
</form>

<script type="text/javascript">
	var jsd = <?php echo json_encode($detail); ?>;
	var category = (jsd.product_category == null && typeof(jsd.layanan[0].product_category)!='undefined' ) ? jsd.layanan[0].product_category : jsd.product_category;
	// alert(jsd.id);
	// alert('<?php echo $current_product; ?>');
	// console.log(jsd);


	$("#id_update_product").val(jsd.id);
	set_product(category, '<?php echo $current_product; ?>', 'product_category_update_product', 'product_div_selector_update');
	$('#product_category_update_product').change(function(e){
		e.preventDefault();
		var product_category = $(this).val();
		set_product(product_category, '', 'product_category_update', 'product_div_selector_update');
	});
</script>
