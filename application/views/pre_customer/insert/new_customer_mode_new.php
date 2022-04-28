<form id="form_pre_customer_insert_new" action="<?php echo base_url(); ?>pre_customer/insert_new" method="post">
	<?php
		$prefix = 'new';
		$default_value = array();
		$forms = $this->ui->forms('customer_insert', $default_value, $prefix);

		echo $forms['customer_name'];
		echo $forms['customer_address'];
	?>

	<div class="row">

		<div class="col-lg-12">
			<div class="form-group">
				<label for="">Koordinat</label>
				<div class="input-group">
					<input name="koordinat" id="koordinat_<?php echo $prefix; ?>" class="form-control" placeholder="Latitude, logintude" type="text">
					<span class="input-group-btn">
						<a data-target="#modal_map" data-latitude='-7.771253761265909' data-longitude='110.36144337889868' data-formtarget='koordinat_<?php echo $prefix; ?>' data-toggle="modal" href="javascript:void(0)" class="btn btn-info"><i class="icon-location3"></i></a>
					</span>
				</div>
			</div>
		</div>

	</div>

	<?php
		//echo $forms['contact_person'];
	?>

	<div id="cp-new-div"></div>






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
	<div id="contract_insert_div" class="hidden">
		<?php
		echo $forms['contract'];
		?>
	</div>

	<?php
		echo $forms['product_category'];
	?>
	<div class="form-group">
		<div id="product_div_selector_insert"></div>
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

	<!-- <a href="javascript:void(0)" onclick="show_maps(-7.802619282371105, 110.36447427508551);" >maps</a> -->


	<div class="text-right">
		<button type="submit" class="btn btn-success" ><i class="position-left icon-checkmark"></i> <?php echo $this->lang->line('all_submit_button'); ?></button>
		<button type="button" class="btn btn-warning" onclick="back_to_picker();"><i class="position-left icon-arrow-left12"></i> kembali</button>
		<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="position-left icon-cancel-circle2"></i> <?php echo $this->lang->line('all_close_button'); ?></button>
	</div>
</form>


<script type="text/javascript">

	getajax('<?php echo base_url(); ?>xhr/task_item/index/contact_person/0/existing/cp-new-div/cp', 'cp-new-div');

	set_option('<?php echo base_url(); ?>select_option/satunol', 'contract_status_new', '0');
	set_option('<?php echo base_url(); ?>select_option/satunol', 'nmc_new', '0');
	set_option('<?php echo base_url(); ?>select_option/satunol', 'ppn_new', '0');
	// set_option('<?php echo base_url(); ?>select_option/yesno', 'custom_address_new', 'N');
	set_option('<?php echo base_url(); ?>select_option/link_type', 'link_type_new', 'wr');
	set_option('<?php echo base_url(); ?>select_option/customer_type', 'customer_type_new', '');
	set_option('<?php echo base_url(); ?>select_option/isp', 'isp_lama_new', '');

	set_product('dedicated', '', 'product_category_new', 'product_div_selector_insert');

	$(document).ready(function(){
		$('#product_category_new').change(function(e){
			e.preventDefault();
			var product_category = $(this).val();
			set_product(product_category, '', 'product_category_new', 'product_div_selector_insert');
		});

		$('#contract_status_new').change(function(e){
			e.preventDefault();
			var yesno = $(this).val();
			if(yesno=='1'){
				$('#contract_insert_div').removeClass('hidden');
			}else{
				$('#contract_insert_div').addClass('hidden');
			}
		});

	});

</script>
