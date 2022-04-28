
<?php
	// pre($modul);
	// pre($prefix);
	// pre($req_code);
	$default_value = array();
	$default_value['task_category'] = $modul['categories'];
	// $default_value['status'] = 'request';
	$default_value['req_code'] = $req_code;
	// pre($default_value);
	$forms = $this->ui->forms('task', $default_value, $prefix);
	$forms_ticket = $this->ui->forms('ticket', $default_value, $prefix);
	// pre($this->ui->forms_debug($forms));

	//required
	echo $forms['task_category'];
	// echo $forms['status'];
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
	echo $forms_ticket['email'];
	echo $forms['subject'];

	$ticket_question_id = isset($modal_id) ? $modal_id.'_ticket_question' : 'ticket_question';
?>
<div id="<?=$ticket_question_id;?>"></div>
<?php
	echo $forms['body'];
?>

<div class="row">
	<div class="col-lg-4">
		<?php echo $forms_ticket['status']; ?>
	</div>
	<div class="col-lg-4">
		<?php echo $forms_ticket['ticket_type']; ?>
	</div>
	<div class="col-lg-4">
		<?php echo $forms_ticket['ticket_priority']; ?>
	</div>
</div>


<input type="hidden" name="prefix" value="<?php echo $prefix; ?>">
<?php
	echo $forms['attachment'];
	echo ($prefix == 'update') ? $forms['id'] : '';
?>
