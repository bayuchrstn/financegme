<?php
	$prefix  = 'report_form';
	$default_value = array();
	$forms = $this->ui->forms('task', $default_value, $prefix);
	$forms_task_hidden = $this->ui->forms('task_hidden', $default_value, $prefix);
	$forms_report = $this->ui->forms('task_report', $default_value, $prefix);

	$data_teknis_survey = $this->ui->forms_by_section('task_report', 'data_teknis_survey', $default_value, $prefix);

    echo $data_teknis_survey['status_coverage'];
    echo $data_teknis_survey['koordinat_klien'];
?>
<script type="text/javascript">
	var survey_data = <?php echo json_encode($pre_survey_data); ?>;
	$('#status_coverage_<?php echo $prefix; ?>').val(survey_data.status_coverage);
	$('#koordinat_klien_<?php echo $prefix; ?>').val(survey_data.koordinat);
</script>