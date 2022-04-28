
<?php
	// pre($modul);
	// pre($prefix);
	// pre($req_code);
	$default_value = array();
	$default_value['task_category'] = $modul['categories'];
	$default_value['req_code'] = $req_code;
	$default_value['status'] = 'request';
	$default_value['subject'] = '-';
	// pre($default_value);

	$forms = $this->ui->forms('task', $default_value, $prefix);
	$forms_task_hidden = $this->ui->forms('task_hidden', $default_value, $prefix);
	$forms_mutasi = $this->ui->forms('mutasi', $default_value, $prefix);

	//required
	echo $forms['task_category'];
	echo $forms['req_code'];
	echo ($prefix == 'insert') ? $forms['location_id'] : '';
	echo $forms_mutasi['category'];
	echo $forms_mutasi['date_request'];
	echo $forms['body'];
	echo $forms['status'];
	echo $forms_mutasi['subject'];

?>
