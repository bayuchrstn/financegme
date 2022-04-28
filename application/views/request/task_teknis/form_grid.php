
<?php
	// pre($modul);
	// pre($prefix);
	// pre($req_code);
	$default_value = array();
	$default_value['task_category'] = $modul['categories'];
	$default_value['status'] = 'progress';
	$default_value['req_code'] = $req_code;
	// pre($default_value);

	$forms = $this->ui->forms('task', $default_value, $prefix);
	// pre($this->ui->forms_debug($forms));

	//required
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
	echo $forms['category'];
	echo $forms['subject'];
	echo $forms['body'];
	echo $forms['assign_to'];
?>

<div id="user_assigned_div">
	<?php echo $forms['user_assigned']; ?>
</div>

<div class="row">
	<div class="col-lg-6">
		<?php echo $forms['date_start']; ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms['date_due']; ?>
	</div>
</div>

<?php if($prefix=='update'): ?>
<!-- <div id="current_attachment_div_<?php echo $modul['code']; ?>">
	current_attachment_div_<?php echo $modul['code']; ?>
</div> -->
<?php endif; ?>

<?php
	//echo $forms['attachment'];
	echo ($prefix == 'update') ? $forms['id'] : '';
?>
