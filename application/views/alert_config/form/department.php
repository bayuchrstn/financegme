<?php
	$default_value = array();
	$prefix = 'update';
	$forms = $this->ui->forms('alert_config', $default_value, $prefix);
	echo $forms['department'];
?>
