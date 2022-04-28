<?php
    $prefix = 'insert';
    $def = array();
    $forms = $this->ui->forms('users', $def, $prefix);
    // pre($this->ui->forms_debug($forms));
?>

<div class="row">
	<div class="col-lg-6">
		<?php echo $forms['username'] ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms['password'] ?>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<?php echo $forms['name'] ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms['email'] ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<?php echo $forms['divisi'] ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms['status'] ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<?php echo $forms['department'] ?>
	</div>
	<div class="col-lg-6">
		<?php //echo $forms['department'] ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<?php echo $forms['sub_department'] ?>
	</div>
	<div class="col-lg-6">
		<?php //echo $forms['department'] ?>
	</div>
</div>
