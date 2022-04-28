<?php
	$prefix  = 'report_form';
	$default_value = array();
	$forms = $this->ui->forms('task', $default_value, $prefix);
	$forms_task_hidden = $this->ui->forms('task_hidden', $default_value, $prefix);
	$forms_report = $this->ui->forms('task_report', $default_value, $prefix);
	$data_teknis_report = $this->ui->forms_by_section('task_report', 'data_teknis', $default_value, $prefix);
    // pre($this->ui->forms_debug($data_teknis_report));

    echo $data_teknis_report['status_coverage'];
    echo $data_teknis_report['koordinat_klien'];
    echo $data_teknis_report['elevasi_client'];
?>
