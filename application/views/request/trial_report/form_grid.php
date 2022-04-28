<?php
	// pre($modul);
	// pre($prefix);
	$default_value = array();
	$default_value['task_category'] = $modul['categories'];
	$default_value['req_code'] = $req_code;
	$forms = $this->ui->forms('task', $default_value, $prefix);

	$default_value_laporan_harian = array();
	$form_laporan_harian = $this->ui->forms('task_laporan_harian', $default_value_laporan_harian, $prefix);
	// pre($this->ui->forms_debug($form_laporan_harian));

	//required
	echo $forms['task_category'];
	echo $forms['req_code'];
?>
<?php
	echo $forms['subject'];
	echo $forms['body'];
?>

<div class="row">
	<div class="col-lg-6">
		<?php echo $form_laporan_harian['shift']; ?>
	</div>
	<div class="col-lg-6">
		<?php echo $form_laporan_harian['jenis_laporan']; ?>
	</div>
</div>

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
		<?php echo $forms['date_start']; ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms['date_due']; ?>
	</div>
</div>
<?php
	echo $form_laporan_harian['pelapor'];
	echo $form_laporan_harian['laporan'];
	echo $form_laporan_harian['analisa'];
	echo $form_laporan_harian['tindakan'];
	echo $form_laporan_harian['solve'];
	echo $form_laporan_harian['sla'];

?>

<?php
	echo $forms['attachment'];
	echo ($prefix == 'update') ? $forms['id'] : '';
?>
