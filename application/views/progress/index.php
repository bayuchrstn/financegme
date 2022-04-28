<?php
	$data = array();
	$prefix = (isset($prefix)) ? $prefix : '';
	$default_value = array();
	$forms = $this->ui->forms('progress', $default_value, $prefix);
    echo $forms['progress_label'];
    echo $forms['progress_code'];
    echo $forms['progress_id'];
?>
