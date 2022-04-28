<?php
    // $prefix = 'insert';
    $def = array();
    $forms = $this->ui->forms('product_category', $def, $prefix);
    // pre($this->ui->forms_debug($forms));
	echo $forms['name'];
	echo $forms['flag_packet'];
	echo $forms['regional'];
	echo ($prefix=='update') ? $forms['id'] : '';
?>
