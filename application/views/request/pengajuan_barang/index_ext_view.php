<!-- <form class="cart_form" id="cart_form_item_out" action="" method="post">
	<input type="hidden" class="cart_cos" name="cart_id" id="cart_id" value="">
	<input type="hidden" name="cart_qty" id="cart_qty" value="1">
	<input type="hidden" name="cart_price" id="cart_price" value="1">
	<input type="hidden" class="cart_cos" name="cart_name" id="cart_name" value="">
	<input type="hidden" name="options[item_installed_owner_status]" id="cart_options_status" value="dipinjamkan">
</form> -->

<?php
    $data = array();
    echo $this->load->view('task_item/modal', $data, TRUE);
?>
