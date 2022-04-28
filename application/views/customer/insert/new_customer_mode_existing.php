<?php
	$data['existing_customer_info'] = $existing_customer_info;
	$forms = $this->ui->forms('customer_insert');
	$form_debug = $this->ui->forms_debug($forms);
	// pre($form_debug);
?>
<form id="form_pre_customer_insert_existing" action="<?php echo base_url(); ?>pre_customer/insert_existing" method="post">

	<div class="row">
		<div class="col-lg-12">
			<?php
			echo $this->load->view('pre_customer/insert/existing_customer_info', $data, TRUE);
			echo $forms['product_category'];
			?>

			<div class="form-group">
				<div id="product_div_selector_insert"></div>
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
			<div id="contract_insert_div" class="hidden">
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
				<?php
					echo $forms['note'];
				?>
			</div>

			<div class="text-right">
				<button type="submit" class="btn btn-success" ><i class="position-left icon-checkmark"></i> <?php echo $this->lang->line('all_submit_button'); ?></button>
				<button type="button" class="btn btn-warning" onclick="back_to_picker();"><i class="position-left icon-arrow-left12"></i> kembali</button>
				<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="position-left icon-cancel-circle2"></i> <?php echo $this->lang->line('all_close_button'); ?></button>
			</div>

		</div>
	</div>
</form>
