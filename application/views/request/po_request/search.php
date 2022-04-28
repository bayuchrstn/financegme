<?php
	$default_value = array();
	$default_value['filtered_page'] = base_url().$req_code.'/';
	$forms = $this->ui->forms('task_search', $default_value, $prefix);
	echo $forms['location_id'];
	echo $forms['author'];
	echo $forms['filtered_page'];
?>
