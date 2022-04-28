<?php
	// pre($prefix);
	$default_value = array();
	$default_value['task_category'] = 'task_teknis';
	$default_value['status'] = 'progress';
	$default_value['req_code'] = 'task_teknis';
	$forms = $this->ui->forms('task', $default_value, $prefix);
	echo $forms['task_category'];
	echo $forms['status'];
	echo $forms['req_code'];
?>

<div class="row">
	<div class="col-lg-6">
		<?php echo $forms['location']; ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms['location_id']; ?>
	</div>
</div>

<?php
	echo $forms['subject'];
	echo $forms['body'];
	echo $forms['category'];
	// echo $forms['user_assigned'];
?>
<div class="row">
	<div class="col-lg-4">
		<?php echo $forms['user_assigned_structure']; ?>
	</div>
	<div class="col-lg-8">
		<?php echo $forms['user_assigned_id']; ?>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<?php echo $forms['date_start']; ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms['date_due']; ?>
	</div>
</div>

<?php
	echo $forms['progress_id'];
	echo $forms['up'];

	if($prefix=='update'):
		echo $forms['id'];
	endif;
?>
