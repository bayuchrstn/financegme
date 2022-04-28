<div id="modal_customer_insert" class="modal fade" >
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form_customer_insert" action="<?php echo base_url(); ?>pre_customer/insert" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title modal-title-custom">Input Pre Customerrg</h4>
                </div>
                <div class="modal-body no-bottom-padding">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="alert_modal_insert"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <table id="input_mode_table" class="table table-hover table-striped mb-10">
                                <tr>
									<td >Existing Customer</td>
                                    <td class="">
                                        <?php
                                            echo form_dropdown('existing_customer_picker', $usergroup_active, '', 'class="form-control" id="existing_customer_picker"');
                                        ?>
                                    </td>
                                    <td width="5" class="">
                                        <a onclick="new_customer_mode('existing');" class="btn btn-default" href="javascript:void(0)">Pilih</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-bottom">Pelanggan Baru</td>
                                    <td class="border-bottom">&nbsp;</td>
                                    <td class="border-bottom">
                                        <a onclick="new_customer_mode('new');" class="btn btn-default" href="javascript:void(0)">Pilih</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="main_form_insert" class="pre-scrollable p-20 hidden">
					<input type="hidden" name="mode" id="mode_insert" value="">
					<input type="hidden" name="existing" id="existing_insert" value="">

					<?php
						$default_value = array();
						$default_value['customer_type'] = $customer_type;
						$forms = $this->ui->load_form_element_by_modul('pre_customer_insert', $default_value);
						$this->ui->hook_this_array($forms);
					?>

                    <!--
                    <div class="form-group">
                        <label for="fax"><?php echo $this->lang->line('customer_customer_type') ?></label>
                        <?php
                            echo form_dropdown('customer_type', $customer_type, '', 'class="form-control chosen" id="customer_type_insert"');
                        ?>
                    </div> -->

                    <!-- <div class="form-group">
                        <label for="registration_date"><?php echo $this->lang->line('customer_registration_date') ?></label>
                        <input type="text" class="form-control datetime_picker" id="registration_date_insert" name="registration_date">
                    </div> -->

                    <!-- <div class="form-group">
                        <label for="link_type"><?php echo $this->lang->line('customer_link_type') ?></label>
                        <?php
                            echo form_dropdown('link_type', $link_type, '', 'class="form-control chosen" id="link_type_insert"');
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="note"><?php echo $this->lang->line('customer_note') ?></label>
                        <textarea class="form-control" id="note_insert" name="note"></textarea>
                    </div> -->

                    <!-- <div class="form-group">
                        <label for="mrtg"><?php echo $this->lang->line('customer_mrtg') ?></label>
                        <input type="text" class="form-control" id="mrtg_insert" name="mrtg">
                    </div>

                    <div class="form-group">
                        <label for="ip_address"><?php echo $this->lang->line('customer_ip_address') ?></label>
                        <input type="text" class="form-control" id="ip_address_insert" name="ip_address">
                    </div> -->

                    <!-- <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="contract_status"><?php echo $this->lang->line('customer_contract_status') ?></label>
                                <?php
                                    echo form_dropdown('contract_status', $contract_status, '', 'class="form-control chosen" id="contract_status_insert"');
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="contract"><?php echo $this->lang->line('customer_contract') ?></label>
                                <input type="text" class="form-control" id="contract_insert" name="contract">
                            </div>
                        </div>
                    </div> -->

					<?php
						echo $this->ui->load_template('checkbox_collapse',
				            array(
				                'label'        				=> $this->lang->line('customer_contract_status'),
				                'name'        				=> 'contract_status',
				                'class'        				=> '',
				                'id'          				=> 'contract_status_insert',
				                'value'         			=> 'Y',
								'collapse_target'         	=> 'collapse_contract_insert',
				            )
				        );
					?>
					<!-- <div id="collapse_contract_insert" class="collapse">
						<div class="form-group">
							<label for="contract"><?php echo $this->lang->line('customer_contract') ?></label>
							<input type="text" class="form-control" id="contract_insert" name="contract" placeholder="Keterangan Kontrak">
						</div>
					</div> -->

                    <!-- <div class="form-group">
                        <label for="id_am"><?php echo $this->lang->line('customer_id_am') ?></label>
                        <?php
                            echo form_dropdown('id_am', $am_lists, '', 'class="form-control chosen" id="id_am_insert"');
                        ?>
                    </div> -->



                    <!-- //pp -->
                    <?php
                        echo $this->ui->load_template('product_picker_accordion',
                            array(
                                'ext_product_category'         => 'class="form-control chosen"',
                            )
                        );
                    ?>

                </div>

                <div class="modal-footer mt-20">
                    <button type="submit" class="btn btn-success" ><i class="position-left icon-checkmark"></i> <?php echo $this->lang->line('all_submit_button'); ?></button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="position-left icon-cancel-circle2"></i> <?php echo $this->lang->line('all_close_button'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
