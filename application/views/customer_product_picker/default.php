<?php
	$prefix_id = (isset($prefix_id) && $prefix_id !='') ? $prefix_id : 'insert';
	$selected_product_category = (isset($selected_product_category) && $selected_product_category !='') ? $selected_product_category : 'NFPFW1488033363';

	$product_category = $this->db->get('product_category')->result_array();
	$array_product_category = arr($product_category, 'code', 'name');
	// pre($array_product_category);

?>

<div class="row">
	<div class="col-lg-12">
		<div class="form-group">
			<label for="">Pilih Produk</label>
			<?php
				echo form_dropdown('product_category', $array_product_category, $selected_product_category, 'onchange="get_product(this)" class="form-control" id="product_category_'.$prefix_id.'" ');
			?>
		</div>
	</div>
	<div class="col-lg-12" id="product_div_selector_<?php echo $prefix_id; ?>">
	</div>
</div>
