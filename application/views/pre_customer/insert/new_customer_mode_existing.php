<?php
	// pre($existing_customer_info);
	$data['existing_customer_info'] = $existing_customer_info;
	$prefix = 'existing';
	$default_value = array();

	// pre($prefix);

	$forms = $this->ui->forms('customer_insert', $default_value, $prefix);
?>
<form id="form_pre_customer_insert_existing" action="<?php echo base_url(); ?>pre_customer/insert_existing" method="post">

	<?php
		if(!empty($existing_customer_info)):
			foreach($existing_customer_info as $col=>$val):
				echo '<input type="hidden" name="current_cg_'.$col.'" value="'.$val.'">';
			endforeach;
		endif;
	?>

	<div class="row">
		<div class="col-lg-12">
			<?php
				echo $this->load->view('pre_customer/insert/existing_customer_info', $data, TRUE);
				echo $forms['product_category'];
			?>
			<div class="form-group">
				<div id="product_div_selector_existing"></div>
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

			<div class="row">
				<div class="col-lg-12">
					<?php echo $forms['customer_type']; ?>
				</div>
			</div>

			<?php
			echo $forms['contract_status'];
			?>
			<div id="contract_existing_div" class="hidden">
				<?php
				echo $forms['contract'];
				?>
			</div>

			<?php
				echo $forms['custom_address'];
			?>

			<div id="custom_address_div" class="hidden">
				<?php
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
					echo $forms['note'];
				?>
				<div id="cp-existing-div"></div>
			</div>


			<div class="text-right">
				<button type="submit" class="btn btn-success" ><i class="position-left icon-checkmark"></i> <?php echo $this->lang->line('all_submit_button'); ?></button>
				<button type="button" class="btn btn-warning" onclick="back_to_picker();"><i class="position-left icon-arrow-left12"></i> kembali</button>
				<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="position-left icon-cancel-circle2"></i> <?php echo $this->lang->line('all_close_button'); ?></button>
			</div>

		</div>
	</div>
</form>

<script type="text/javascript">

	getajax('<?php echo base_url(); ?>xhr/task_item/index/contact_person/0/existing/cp-existing-div/cp', 'cp-existing-div');

	set_product('dedicated', '', 'product_category_existing', 'product_div_selector_existing');

	set_option('<?php echo base_url(); ?>select_option/satunol', 'contract_status_existing', '0');
	set_option('<?php echo base_url(); ?>select_option/satunol', 'nmc_existing', '0');
	set_option('<?php echo base_url(); ?>select_option/satunol', 'ppn_existing', '0');
	set_option('<?php echo base_url(); ?>select_option/yesno', 'custom_address_existing', 'N');
	set_option('<?php echo base_url(); ?>select_option/link_type', 'link_type_existing', 'wr');
	set_option('<?php echo base_url(); ?>select_option/customer_type', 'customer_type_existing', '');
	set_option('<?php echo base_url(); ?>select_option/isp', 'isp_lama_existing', '');

	$(document).ready(function(){
		$('#product_category_existing').change(function(e){
			e.preventDefault();
			var product_category = $(this).val();
			set_product(product_category, '', 'product_category_existing', 'product_div_selector_existing');
		});

		$('#contract_status_existing').change(function(e){
			e.preventDefault();
			var yesno = $(this).val();
			if(yesno=='1'){
				$('#contract_existing_div').removeClass('hidden');
			}else{
				$('#contract_existing_div').addClass('hidden');
			}
		});

		$('#custom_address_existing').change(function(e){
			e.preventDefault();
			var yesno = $(this).val();
			if(yesno=='Y'){
				$('#custom_address_div').removeClass('hidden');
			}else{
				$('#custom_address_div').addClass('hidden');
			}
		});
	});
</script>
