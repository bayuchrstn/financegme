<?php
	$default_value = array();
	$prefix = 'out_item';
	$forms = $this->ui->forms('item_transaction', $default_value, $prefix);
	echo $forms['status_kepemilikan'];
	echo $forms['note'];
?>
