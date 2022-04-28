<?php
    // $default_category = $this->item->arr_category();
    $arr = array();
    // $arr['modal_icon'] = $this->theme->icon('item_detail');
    $arr['modal_id'] = 'modal_item_detail_update';
    $arr['form_id'] = 'form_item_detail_update';
    $arr['form_action'] = '';
    $arr['form_input_top'] = '<div id="alert_modal_update"></div>';
    $arr['modal_title'] = $this->lang->line('item_detail_update');
    $arr['form_input_left'] = array(
            $this->ui->load_template('form_group_dropdown',
                array(
                    'label'         => $this->lang->line('item_detail_company'),
                    'name'          => 'item_company_update',
                    'ext'           => 'class="form-control" id="item_company_update" ',
                    'option'        => $select_company,
                    'selected'      => '',
                )
            ),
            $this->ui->load_template('form_group_dropdown',
                array(
                    'label'         => $this->lang->line('item_detail_klasifikasi'),
                    'name'          => 'item_klasifikasi_update',
                    'ext'           => 'class="form-control" id="item_klasifikasi_update" ',
                    'option'        => $select_klasifikasi,
                    'selected'      => '',
                )
            ),
            $this->ui->load_template('form_group_text_readonly',
                array(
                    'label'         => $this->lang->line('item_detail_no_item'),
                    'id'            => 'item_no_item_update',
                    'name'          => 'item_no_item_update',
                    'class'         => 'cos form-control',
                    'maxlength'     => '200',
                    'value'         => '',
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('item_detail_mac'),
                    'id'            => 'item_mac_update',
                    'name'          => 'item_mac_update',
                    'class'         => 'cos form-control',
                    'maxlength'     => '200',
                    'value'         => ''
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('item_detail_barcode'),
                    'id'            => 'item_barcode_update',
                    'name'          => 'item_barcode_update',
                    'class'         => 'cos form-control',
                    'maxlength'     => '200',
                    'value'         => ''
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('item_detail_price'),
                    'id'            => 'item_price_update',
                    'name'          => 'item_price_update',
                    'class'         => 'cos form-control price',
                    'maxlength'     => '30',
                    'value'         => '0',
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('item_detail_invoice'),
                    'id'            => 'item_invoice_update',
                    'name'          => 'item_invoice_update',
                    'class'         => 'cos form-control',
                    'maxlength'     => '200',
                    'value'         => ''
                )
            ),
        );
    $arr['form_input_right'] = array(
            // $this->ui->load_template('form_group_dropdown',
            //     array(
            //         'label'         => $this->lang->line('item_detail_status'),
            //         'name'          => 'item_detail_status',
            //         'ext'           => 'class="form-control" id="item_detail_status_update" ',
            //         'option'        => $select_status,
            //         'selected'      => '',
            //     )
            // ),

            $this->ui->load_template('form_group_dropdown',
                array(
                    'label'         => $this->lang->line('item_detail_supplier'),
                    'name'          => 'item_supplier_update',
                    'ext'           => 'class="form-control select-chosen" id="item_supplier_update" ',
                    'option'        => $select_supplier,
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('item_detail_date_buy'),
                    'id'            => 'item_date_buy_update',
                    'name'          => 'item_date_buy_update',
                    'class'         => 'cos form-control date_picker',
                    'maxlength'     => '200',
                    'value'         => ''
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('item_detail_warranty'),
                    'id'            => 'item_warranty_update',
                    'name'          => 'item_warranty_update',
                    'class'         => 'cos form-control',
                    'maxlength'     => '200',
                    'value'         => ''
                )
            ),
			$this->ui->load_template('hidden',
                array(
					'id'            => 'item_detail_status',
                    'name'          => 'item_status_update',
                    'value'         => '',
                )
            ),
            $this->ui->load_template('form_group_textarea',
                array(
                    'label'         => $this->lang->line('item_detail_note'),
                    'id'            => 'item_note_update',
                    'name'          => 'item_note_update',
                    'class'         => 'cos form-control',
                    'maxlength'     => '200',
                    'rows'          => '4',
                )
            ),
            $this->ui->load_template('hidden',
                array(
                    'id'            => 'id_update',
                    'name'          => 'id',
                    'value'         => '',
                )
            ),
        );
    echo $this->ui->load_template('modal_large_form_two_column', $arr, TRUE);
?>
