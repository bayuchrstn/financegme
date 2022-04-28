<?php
	$default_value = array();
	$prefix = 'update';
	$forms = $this->ui->forms('customer_update', $default_value, $prefix);
	echo $forms['customer_name'];
	echo $forms['customer_address'];
	echo $forms['contact_person'];
?>
<div class="row">
	<div class="col-lg-4">
		<?php echo $forms['telephone_home']; ?>
	</div>
	<div class="col-lg-4">
		<?php echo $forms['telephone_mobile']; ?>
	</div>
	<div class="col-lg-4">
		<?php echo $forms['telephone_work']; ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-4">
		<?php echo $forms['fax']; ?>
	</div>
	<div class="col-lg-4">
		<?php echo $forms['email']; ?>
	</div>
	<div class="col-lg-4">
		<?php echo $forms['customer_type']; ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-4">
		<?php echo $forms['link_type']; ?>
	</div>
	<div class="col-lg-4">
		<?php echo $forms['nmc']; ?>
	</div>
	<div class="col-lg-4">
		<?php echo $forms['ppn']; ?>
	</div>
</div>

<?php
	echo $forms['contract_status'];
?>
<div id="contract_update_div" class="hidden">
	<?php
	echo $forms['contract'];
	?>
</div>

<?php
	echo $forms['product_category'];
?>
<div class="form-group">
	<div id="product_div_selector_update"></div>
</div>

<?php echo $forms['note']; ?>
<?php echo $forms['id']; ?>

<div class="pull-right">
	<input type="submit" name="" value="submit" class="btn btn-success">
</div>
