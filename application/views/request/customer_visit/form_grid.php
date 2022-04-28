
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
	$forms_task_hidden = $this->ui->forms('task_hidden', $default_value, $prefix);
	$forms_task_customer_care = $this->ui->forms('customer_care', $default_value, $prefix);
	// pre($this->ui->forms_debug($forms_task_customer_care));

	//required
	echo $forms['task_category'];
	echo $forms['req_code'];
?>

<?php
	echo $forms_task_customer_care['customer_id'];
?>
<div class="row">
	<div class="col-lg-6">
		<?php echo $forms_task_customer_care['layanan']; ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms_task_customer_care['cis_sid']; ?>
	</div>
</div>

<?php

	echo $forms_task_customer_care['address'];
?>
<div class="row">
	<div class="col-lg-6">
		<?php echo $forms_task_customer_care['email']; ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms_task_customer_care['contact_person']; ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-4">
		<?php echo $forms_task_customer_care['telephone_home']; ?>
	</div>
	<div class="col-lg-4">
		<?php echo $forms_task_customer_care['telephone_mobile']; ?>
	</div>
	<div class="col-lg-4">
		<?php echo $forms_task_customer_care['telephone_work']; ?>
	</div>
</div>

<?php
	echo $forms_task_customer_care['category'];
	echo $forms_task_customer_care['respon'];
?>
<div class="row">
	<div class="col-lg-6">
		<?php echo $forms_task_customer_care['scale']; ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms_task_customer_care['status']; ?>
	</div>
</div>

<?php
	$emails = $this->email_list->get_by_category('customer_care');
	// pre($emails);
?>
<div class="form-group">
	<label class="display-block text-semibold">Tindak Lanjut :</label>
	<?php
	if(!empty($emails)):
		foreach($emails as $receiver=>$name):
	?>
	<label class="checkbox-inline">
		<input type="checkbox" name="receiver[]" value="<?php echo $receiver; ?>">
		<?php echo $name; ?>
	</label>

	<?php
		endforeach;
	endif;
	?>
</div>

<?php
	echo $forms_task_customer_care['note'];
?>
<input type="hidden" name="customer_care_type" value="customer_visit">

<?php
	//echo $forms['attachment'];
	echo ($prefix == 'update') ? $forms['id'] : '';
?>
