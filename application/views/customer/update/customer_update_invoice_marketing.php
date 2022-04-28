<form id="form_customer_update_fn" class="" action="<?php echo base_url(); ?>customer/customer_update_global" method="post">
	<div id="form_customer_update_fn_msg"></div>
<?php
	// pre($detail);
	$default_value = array();
	$prefix = 'update_invoice_marketing';
	$forms = $this->ui->forms('customer', $default_value, $prefix);
	// pre($this->ui->forms_debug($forms));
?>

<?php
	echo $forms['id_am'];
	echo $forms['invoice_flag'];
	echo $forms['invoice_name'];
	echo $forms['invoice_address'];
	echo $forms['invoice_phone'];
	echo $forms['invoice_no_attention'];
	echo $forms['invoice_attention'];
?>

	<?php echo $forms['id']; ?>
	<input type="hidden" name="sender" value="1">

	<div class="text-right">
		<button type="submit" class="btn btn-success" ><i class="position-left icon-checkmark"></i> Submit</button>
		<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="position-left icon-cancel-circle2"></i> Close</button>
	</div>

</form>

<script type="text/javascript">
	var jsd = <?php echo json_encode($detail); ?>;
	set_option('<?php echo base_url(); ?>select_option/customer/am', 'id_am_update_invoice_marketing', jsd.id_am);
	set_option('<?php echo base_url(); ?>select_option/satunol', 'invoice_flag_update_invoice_marketing', jsd.invoice_flag);
</script>
