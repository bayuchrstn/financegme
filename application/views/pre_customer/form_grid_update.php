<?php
	// pre($detail);
	// pre(unserialthis($current_product));
	$default_value = array();
	$forms = $this->ui->forms('customer_update', $default_value, $prefix);
	echo $forms['customer_name'];
	echo $forms['customer_address'];
	// echo $forms['contact_person'];
?>
<div class="form-group">
	<label for="">Koordinat</label>
	<div class="input-group">
		<input name="koordinat" id="koordinat_<?php echo $prefix; ?>" class="form-control" placeholder="Latitude, logintude" type="text">
		<span class="input-group-btn">
			<a data-target="#modal_map" data-latitude='-7.771253761265909' data-longitude='110.36144337889868' data-formtarget='koordinat_<?php echo $prefix; ?>' data-toggle="modal" href="javascript:void(0)" class="btn btn-info"><i class="icon-location3"></i></a>
		</span>
	</div>
</div>


<div id="cp-edit-div"></div>

<div class="row">
	<div class="col-lg-6">
		<?php echo $forms['link_type']; ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms['customer_type']; ?>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<?php echo $forms['ppn']; ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms['nmc']; ?>
	</div>
</div>

<?php
	echo $forms['contract_status'];
?>
<div id="contract_update_div">
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


<div class="row">
	<div class="col-lg-10">
		<?php echo $forms['isp_lama']; ?>
	</div>
	<div class="col-lg-2">
		<div class="form-group">
			<label for="">&nbsp;</label>
			<a href="javascript:void(0);" onclick="input_isp('isp_lama_<?php echo $prefix; ?>');" class="btn btn-default form-control">Input ISP</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<?php echo $forms['bw_isp_lama']; ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms['harga_isp_lama']; ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<?php echo $forms['jumlah_pengguna']; ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms['sumber']; ?>
	</div>
</div>

<?php echo $forms['note']; ?>
<?php echo $forms['id']; ?>

<script type="text/javascript">
	var detail = <?php echo json_encode($detail); ?>;
	// var current_product = <?php //echo json_encode($current_product); ?>;
	console.log(detail);

	set_product(detail.product_category, '<?php echo $current_product; ?>', 'product_category_update', 'product_div_selector_update');

	getajax('<?php echo base_url(); ?>xhr/task_item/index/contact_person/'+detail.id+'/existing/cp-edit-div/cp', 'cp-edit-div');

	set_option('<?php echo base_url(); ?>select_option/customer_type', 'customer_type_update', detail.customer_type);
	set_option('<?php echo base_url(); ?>select_option/link_type', 'link_type_update', detail.link_type);
	set_option('<?php echo base_url(); ?>select_option/satunol', 'contract_status_update', detail.contract_status);
	set_option('<?php echo base_url(); ?>select_option/satunol', 'nmc_update', detail.nmc);
	set_option('<?php echo base_url(); ?>select_option/satunol', 'ppn_update', detail.ppn);
	set_option('<?php echo base_url(); ?>select_option/isp', 'isp_lama_update', detail.isp_lama);

	if(detail.contract_status=='1'){
		$('#contract_update_div').removeClass('hidden');
		$('#contract_update').val(detail.contract);
	} else {
		$('#contract_update_div').addClass('hidden');
		$('#contract_update').val('');
	}

	$('#koordinat<?php echo '_'.$prefix; ?>').val(detail.koordinat);
	$('#customer_name<?php echo '_'.$prefix; ?>').val(detail.customer_name);
	$('#customer_address<?php echo '_'.$prefix; ?>').val(detail.customer_address);
	$('#note<?php echo '_'.$prefix; ?>').val(detail.note);
	$('#id<?php echo '_'.$prefix; ?>').val(detail.id);
	$('#harga_isp_lama<?php echo '_'.$prefix; ?>').val(detail.harga_isp_lama);
	$('#bw_isp_lama<?php echo '_'.$prefix; ?>').val(detail.bw_isp_lama);
	$('#jumlah_pengguna<?php echo '_'.$prefix; ?>').val(detail.jumlah_pengguna);
	$('#sumber<?php echo '_'.$prefix; ?>').val(detail.sumber);

	$('#contract_status_update').change(function(e){
		// e.preventDefault();
		var yesno = $(this).val();
		if(yesno=='1'){
			$('#contract_update_div').removeClass('hidden');
		}else{
			$('#contract_update_div').addClass('hidden');
		}
		return false;
	});

	$(document).ready(function(){
		$('#product_category_update').change(function(e){
			e.preventDefault();
			var product_category = $(this).val();
			set_product(product_category, '', 'product_category_update', 'product_div_selector_update');
		});
	});
</script>
