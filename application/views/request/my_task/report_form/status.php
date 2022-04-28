<?php
	// pre($task_detail);
	// pre($report_detail);
	// pre($report_ext);
	// pre($prefix);
	$prefix  = 'report_form';
	$default_value = array();
	$default_value['flag_email'] = '1';
	$forms = $this->ui->forms('task', $default_value, $prefix);
	$forms_task_hidden = $this->ui->forms('task_hidden', $default_value, $prefix);
	$forms_report = $this->ui->forms('task_report', $default_value, $prefix);
	// $fo_report = $this->ui->forms_by_section('task_report', 'fo', $default_value, $prefix);
	// $wr_report = $this->ui->forms_by_section('task_report', 'wr', $default_value, $prefix);

	echo $forms_task_hidden['category'];
	echo $forms_task_hidden['location'];
	echo $forms_task_hidden['location_id'];
	echo $forms_task_hidden['up'];
	echo $forms_task_hidden['subject'];
	echo $forms['id'];

    echo $forms['body'];
	// echo $forms['attachment'];
	echo $forms_report['owncloud'];
	echo $forms_report['status_pekerjaan'];
	echo $forms['flag_email'];
?>

<script type="text/javascript">
	var task_detail = <?php echo json_encode($task_detail); ?>;
	var report_detail = <?php echo json_encode($report_detail); ?>;
	var report_ext = <?php echo json_encode($report_ext); ?>;
	// console.log(report_detail);

	// if(Object.keys(myObject).length == 0){
	//
	// } else {
	//
	// }

	$('#location_<?php echo $prefix; ?>').val(task_detail.location);
	$('#location_id_<?php echo $prefix; ?>').val(task_detail.location_id);
	$('#id_<?php echo $prefix; ?>').val(task_detail.id);
	$('#category_<?php echo $prefix; ?>').val(task_detail.category);
	$('#up_<?php echo $prefix; ?>').val(task_detail.id);
	$('#subject_<?php echo $prefix; ?>').val(task_detail.subject);
	$('#body_fake_<?php echo $prefix; ?>').val(report_detail.body);
	$('#flag_email_<?php echo $prefix; ?>').prop('checked', true);
	$('#owncloud_<?php echo $prefix; ?>').val(report_ext.owncloud);
</script>
