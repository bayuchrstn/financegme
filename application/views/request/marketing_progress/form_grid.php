<?php
	// pre($modul);
	// pre($prefix);
	$default_value = array();
	$default_value['task_category'] = $modul['categories'];
	$default_value['req_code'] = $req_code;
	$default_value['flock'] = 'n';

	$forms = $this->ui->forms('task', $default_value, $prefix);
	$forms_task_marketing_request = $this->ui->forms('task_marketing_request', $default_value, $prefix);

	echo $forms['task_category'];
	echo $forms['req_code'];

	//pilihan pelanggan
	echo ($prefix == 'insert') ? $forms['location_id'] : '';

	//jenis marketing progress
	//misalnya prospek, pre survey survey dst
	echo ($prefix == 'insert') ? $forms['category'] : '';
?>

<!-- <div id="tgl_request_date_<?php echo $prefix; ?>" class="hide">
	<?php //echo $forms_task_marketing_request['date_request_start']; ?>
</div> -->

<?php
	echo $forms['subject'];
	echo $forms['body'];
?>
<div id="form_ext_<?php echo $prefix; ?>">

</div>

<?php
	echo $forms['flock'];
	echo ($prefix == 'update') ? $forms['id'] : '';
?>
<!-- untuk marketing progress udah pasti pre customer -->
<input type="hidden" name="location" value="pre_customer">
