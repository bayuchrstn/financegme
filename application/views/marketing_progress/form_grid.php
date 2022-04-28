<?php
	$default_value = array();
	$forms = $this->ui->forms('task', $default_value, $prefix);
	// pre($this->ui->forms_debug($forms));
	echo ($prefix=='insert') ? $forms['location_id'] : '';
	echo $forms['subject'];
	echo ($prefix=='insert') ? $forms['category'] : '';
	echo $forms['body'];
	echo ($prefix=='update') ? $forms['id'] : '';
?>
