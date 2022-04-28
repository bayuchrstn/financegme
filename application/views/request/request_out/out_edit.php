<?php
	$default_value = array();
	$prefix = 'out_item';
	$forms = $this->ui->forms('item_transaction', $default_value, $prefix);
	echo $forms['status_kepemilikan'];
	echo $forms['note'];
	echo $forms['id'];
?>

<div class="alert alert-styled bg-danger">
	<div class="checkbox" style="margin:0 !important;">
		<label for="">
			<input type="checkbox" name="" value="">
			Hapus request
		</label>
	</div>
</div>
