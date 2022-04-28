<?php
    $arr_product_category =  $this->master->arr('product_category');
    $selected_product_category = (isset($selected_product_category)) ? $selected_product_category : '';
    $ext_product_category = (isset($ext_product_category)) ? $ext_product_category : 'class="form-control"';
    // $product_lists_div = (isset($product_lists_div)) ? $product_lists_div : '';
?>
<div class="form-group">
    <label for="regional">Product</label>
    <?php
        echo form_dropdown('product_category', $arr_product_category, $selected_product_category, $ext_product_category);
    ?>
    <div class="product_lists_div">

    </div>
</div>
