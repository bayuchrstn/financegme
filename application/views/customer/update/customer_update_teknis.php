<form id="form_customer_update_teknis" class="" action="<?php echo base_url(); ?>customer/customer_update_teknis" method="post">
	<div id="form_customer_update_teknis_msg"></div>
<?php
	// pre($detail);
	$default_value = array();
	$prefix = 'update_teknis';
	$forms = $this->ui->forms('customer', $default_value, $prefix);
	// pre($this->ui->forms_debug($forms));
?>

<div class="row">
	<div class="col-lg-6">
		<?php echo $forms['mrtg']; ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms['ip_address']; ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<?php echo $forms['latitude']; ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms['longitude']; ?>
	</div>
</div>

	<?php echo $forms['id']; ?>
	<input type="hidden" name="sender" value="1">

	<div class="text-right">
		<button type="submit" class="btn btn-success" ><i class="position-left icon-checkmark"></i> Submit</button>
		<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="position-left icon-cancel-circle2"></i> Close</button>
	</div>

</form>

<script type="text/javascript">
	var detail = <?php echo json_encode($detail); ?>;
	// console.log(detail);
	$('#id_update_teknis').val(detail.id);
	$('#ip_address_update_teknis').val(detail.ip_address);
	$('#mrtg_update_teknis').val(detail.mrtg);
	$('#latitude_update_teknis').val(detail.latitude);
	$('#longitude_update_teknis').val(detail.longitude);
</script>
