<?php
	// pre($modul);
	// pre($prefix);
	$default_value = array();
	$default_value['task_category'] = $modul['categories'];
	$default_value['req_code'] = $req_code;
	$default_value['status'] = 'belum_dikirim';
	$default_value['category'] = 'general';
	// pre($default_value);
	$forms = $this->ui->forms('task', $default_value, $prefix);
	$forms_task_hidden = $this->ui->forms('task_hidden', $default_value, $prefix);
	$forms_task_marketing_request = $this->ui->forms('task_marketing_request', $default_value, $prefix);


	echo $forms['task_category'];
	echo $forms['status'];
	echo $forms['req_code'];
	echo ($prefix == 'insert') ? $forms_task_hidden['category'] : '';

?>
<div class="row">
	<div class="col-lg-6">
		<?php echo $forms['location']; ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms['location_id']; ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<?php echo $forms['subject']; ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms_task_marketing_request['date_request_start']; ?>
	</div>
</div>
<?php

	echo $forms['body'];
	echo ($prefix == 'update') ? $forms['id'] : '';
?>
