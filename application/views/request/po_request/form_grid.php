<?php
	// pre($modul);
	// pre($prefix);
	$default_value = array();
	$default_value['task_category'] = $modul['categories'];
	$default_value['req_code'] = $req_code;
	$default_value['flock'] = 'n';
	$forms = $this->ui->forms('task', $default_value, $prefix);
	$forms_task_status = $this->ui->forms('task_status', $default_value, $prefix);
	echo $forms['task_category'];
	echo $forms['req_code'];
?>



<?php
	echo $forms['subject'];
	echo $forms['body'];
	echo $forms['category'];
	echo $forms['flock'];
	echo ($prefix == 'update') ? $forms['id'] : '';
?>

<div class="row">
	<div class="col-lg-6">
		<?php echo $forms['location']; ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms['location_id']; ?>
	</div>
</div>

<div id="task_item_div_<?php echo $prefix; ?>"></div>

<?php
	echo $forms_task_status['status'];
?>
