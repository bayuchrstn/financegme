<?php
	// pre($modul);
	// pre($prefix);
	$default_value = array();
	$default_value['task_category'] = $modul['categories'];
	$default_value['req_code'] = $req_code;
	$forms = $this->ui->forms('task', $default_value, $prefix);
	$forms_task_hidden = $this->ui->forms('task_hidden', $default_value, $prefix);
	$bcn_forms = $this->ui->forms('bcn', $default_value, $prefix);

	//required
	echo $forms['task_category'];
	echo $forms['req_code'];
?>
<input type="hidden" name="subject" value="-">
<input type="hidden" name="status" value="request">
<input type="hidden" id="location_<?php echo $prefix; ?>" name="location" value="">
<input type="hidden" id="location_id_<?php echo $prefix; ?>" name="location_id" value="">



<?php
	$this->request->referensi($prefix, 'request_out');
	echo $forms['body'];
?>

<!-- =========================New================================== -->
<div id="item_out_<?php echo $prefix; ?>"></div>
<!-- =========================New================================== -->

<?php
	echo ($prefix == 'update') ? $forms['id'] : '';
?>
