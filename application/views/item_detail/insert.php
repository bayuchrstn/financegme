<?php
    if ($item=='' || $item=='0'):
        $default_brand = $this->item->get_category_brand();
        $default_brand_id = $default_brand[0]['id'];
        $default_brand_code = $default_brand[0]['code_name'];

        $default_category = $this->item_detail->get_category_only($default_brand_id);
        $default_category_id = $default_category[0]['id'];
        $default_category_code = $default_category[0]['code_name'];

        $default_item_id = '';
    else :
        $row_item = $this->item_detail->detail_item($item);
        $default_brand = $this->item_detail->get_category_brand_by_id($row_item['brand']);
        $default_category = $this->item_detail->get_category_brand_by_id($row_item['category_id']);

        $default_brand_id = $default_brand['id'];
        $default_brand_code = $default_brand['code_name'];
        $default_category_id = $default_category['id'];
        $default_category_code = $default_category['code_name'];
        $default_item_id = $item;
    endif;

    $default_nobarang = $default_brand_code.'-'.$default_category_code.'-';
    $default_nobarang .= date('YmdHis').$this->session->userdata('userid');

    $arr_category = $this->item->arr_category($default_brand_id);
    $arr_item = $this->item_detail->arr_item_category($default_category_id);
    
    // print_r($arr_category);
    // $default_item = $this->item_detail->
    $arr = array();
    // $arr['modal_icon'] = $this->theme->icon('item');
    $arr['modal_id'] = 'modal_item_detail_insert';
    $arr['form_id'] = 'form_item_detail_insert';
    $arr['form_action'] = base_url().'item_detail/insert';
    $arr['modal_title'] = $this->lang->line('item_insert');
    $arr['form_input_top'] = '<div id="alert_modal_insert"></div>';
    $arr['form_input_left'] = array(
            $this->ui->load_template('form_group_dropdown',
                array(
                    'label'         => $this->lang->line('item_detail_company'),
                    'name'          => 'item_company',
                    'ext'           => 'class="form-control" id="item_company" ',
                    'option'        => $select_company,
                    'selected'         => '',
                )
            ),
            $this->ui->load_template('form_group_dropdown',
                array(
                    'label'         => $this->lang->line('item_detail_klasifikasi'),
                    'name'          => 'item_klasifikasi',
                    'ext'           => 'class="form-control" id="item_klasifikasi" ',
                    'option'        => $select_klasifikasi,
                    'selected'         => '',
                )
            ),
            $this->ui->load_template('form_group_dropdown',
                array(
                    'label'         => $this->lang->line('item_brand'),
                    'name'          => 'item_brand',
                    'ext'           => 'class="form-control select-chosen" id="item_brand" ',
                    'option'        => $select_brand,
                    'selected'         => $default_brand_id,
                )
            ),
            $this->ui->load_template('form_group_dropdown',
                array(
                    'label'         => $this->lang->line('item_category'),
                    'name'          => 'item_category',
                    'ext'           => 'class="form-control select-chosen" id="item_category" ',
                    'option'        => $arr_category,
                    'selected'      => $default_category_id,
                )
            ),
            $this->ui->load_template('form_group_dropdown',
                array(
                    'label'         => $this->lang->line('item_detail_name'),
                    'name'          => 'item_item',
                    'ext'           => 'class="form-control" id="item_item" ',
                    'option'        => $arr_item,
                    'selected'      => $default_item_id,
                )
            ),
            $this->ui->load_template('form_group_text_readonly',
                array(
                    'label'         => $this->lang->line('item_detail_no_item'),
                    'id'            => 'item_no_item',
                    'name'          => 'item_no_item',
                    'class'         => 'cos form-control',
                    'maxlength'     => '200',
                    'value'         => $default_nobarang
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('item_detail_mac'),
                    'id'            => 'item_mac',
                    'name'          => 'item_mac',
                    'class'         => 'cos form-control',
                    'maxlength'     => '200',
                    'value'         => ''
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('item_detail_barcode'),
                    'id'            => 'item_barcode',
                    'name'          => 'item_barcode',
                    'class'         => 'cos form-control',
                    'maxlength'     => '200',
                    'value'         => ''
                )
            ),
        );
    $arr['form_input_right'] = array(
            $this->ui->load_template('form_group_dropdown',
                array(
                    'label'         => $this->lang->line('item_detail_supplier'),
                    'name'          => 'item_supplier',
                    'ext'           => 'class="form-control select-chosen" id="item_supplier" ',
                    'option'        => $select_supplier,
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('item_detail_price'),
                    'id'            => 'item_price',
                    'name'          => 'item_price',
                    'class'         => 'cos form-control price',
                    'maxlength'     => '30',
                    'value'         => '0',
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('item_detail_invoice'),
                    'id'            => 'item_invoice',
                    'name'          => 'item_invoice',
                    'class'         => 'cos form-control',
                    'maxlength'     => '200',
                    'value'         => ''
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('item_detail_date_buy'),
                    'id'            => 'item_date_buy',
                    'name'          => 'item_date_buy',
                    'class'         => 'cos form-control date_picker',
                    'maxlength'     => '200',
                    'value'         => ''
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('item_detail_warranty'),
                    'id'            => 'item_warranty',
                    'name'          => 'item_warranty',
                    'class'         => 'cos form-control',
                    'maxlength'     => '200',
                    'value'         => ''
                )
            ),
            $this->ui->load_template('form_group_textarea',
                array(
                    'label'         => $this->lang->line('item_detail_note'),
                    'id'            => 'item_note',
                    'name'          => 'item_note',
                    'class'         => 'cos form-control',
                    'maxlength'     => '200',
                    'rows'          => '4',
                )
            ),
        );
    echo $this->ui->load_template('modal_large_form_two_column', $arr, TRUE);
?>