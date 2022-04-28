<form id="form_customer_update_global" class="" action="<?php echo base_url(); ?>customer/customer_update_global" method="post">
	<div id="form_customer_update_global_msg"></div>
<?php
	// pre($detail);
	$default_value = array();
	$prefix = 'update';
	$forms = $this->ui->forms('customer', $default_value, $prefix);
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
	//echo $forms['product_category'];
	?>
	<!-- <div class="form-group">
	<div id="product_div_selector_update"></div>
	</div> -->

	<?php echo $forms['note']; ?>
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
	$('#customer_name_update').val('<?php echo $detail['customer_name'] ?>');
	$('#customer_address_update').val('<?php echo $detail['customer_address'] ?>');
	$('#contact_person_update').val('<?php echo $detail['contact_person'] ?>');
	$('#telephone_home_update').val('<?php echo $detail['telephone_home'] ?>');
	$('#telephone_mobile_update').val('<?php echo $detail['telephone_mobile'] ?>');
	$('#telephone_work_update').val('<?php echo $detail['telephone_work'] ?>');
	$('#fax_update').val('<?php echo $detail['fax'] ?>');
	$('#email_update').val('<?php echo $detail['email'] ?>');
	$('#contract_update').val('<?php echo $detail['contract'] ?>');
	$('#id_update').val('<?php echo $detail['id'] ?>');
	set_option('<?php echo base_url(); ?>select_option/customer/customer_type', 'customer_type_update', '<?php echo $detail['customer_type'] ?>');
	set_option('<?php echo base_url(); ?>select_option/customer/link_type', 'link_type_update', '<?php echo $detail['link_type'] ?>');
	set_option('<?php echo base_url(); ?>select_option/customer/contract', 'contract_status_update', '<?php echo $detail['contract_status'] ?>');
	set_option('<?php echo base_url(); ?>select_option/yesno', 'nmc_update', '<?php echo $detail['nmc'] ?>');
	set_option('<?php echo base_url(); ?>select_option/yesno', 'ppn_update', '<?php echo $detail['ppn'] ?>');

	$('#contract_status_update').change(function(){
		var cs = $(this).val();
		contract_info(cs);
	});

	contract_info('<?php echo $detail['contract_status'] ?>');

	function contract_info(contract_status){
		if(contract_status=='kontrak'){
			// alert('sss '+contract_status);
			$('#contract_update_div').removeClass('hidden');
		} else {
			$('#contract_update_div').addClass('hidden');
		}
		return false;
	}

</script>
