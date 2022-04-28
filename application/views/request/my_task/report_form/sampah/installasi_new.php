<?php
	// pre($task_detail);
	// pre($jenis_form);
	$prefix  = 'report_form';
	$default_value = array();
	$forms = $this->ui->forms('task_report', $default_value, $prefix);
	// pre($this->ui->forms_debug($forms));
?>

<div class="row">
	<div class="col-lg-12">
		<?php echo $forms['tanggal_installasi'] ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<?php echo $forms['nama_vendor'] ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms['support_provisioning'] ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<?php echo $forms['koordinat_klien'] ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms['router'] ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<?php echo $forms['ip_public'] ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms['ip_lan'] ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<?php echo $forms['user_pppoe'] ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms['password_pppoe'] ?>
	</div>
</div>

<?php
	echo $forms['note'];
	echo $forms['status_pekerjaan'];
?>

<?php
	echo $forms['note'];
	echo $forms['status_pekerjaan'];
?>
