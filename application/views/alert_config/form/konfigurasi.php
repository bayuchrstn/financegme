<?php
	$default_value = array();
	$prefix = 'update';
	$forms = $this->ui->forms('alert_config', $default_value, $prefix);
	echo $forms['title'];
	echo $forms['content'];
	echo $forms['max_show'];
	echo $forms['time_interval'];
?>
