<?php
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('product');
    $arr['modal_id'] = 'modal_product_insert';
    $arr['form_id'] = 'form_product_insert';
    $arr['form_action'] = base_url().'product/insert';
    $arr['modal_title'] = $this->lang->line('product_insert');
    $arr['form_input_top'] = '<div id="alert_modal_insert"></div>';
    $arr['form_input'] = array(
		$this->ui->load_template('form_group_dropdown',
            array(
                'label'         => $this->lang->line('product_category'),
                'name'          => 'category',
                'ext'           => 'class="form-control" id="category_insert" ',
                'option'        => $this->product->arr_product_category(),
            )
        ),
        $this->ui->load_template('form_group_text',
            array(
                'label'         => $this->lang->line('product_name'),
                'id'            => 'name_insert',
                'name'          => 'name',
                'class'         => 'cos form-control',
                'maxlength'     => '200',
            )
        ),

		$this->ui->load_template('checkbox_collapse',
            array(
                'label'         => $this->lang->line('product_flag_fixprice'),
                'name'          => 'flag_fixprice',
                'class'         => '',
                'id'          	=> 'flag_fixprice_insert',
                'value'         => 'Y',
				'collapse_target'         	=> 'collapse_price_insert',
            )
        ),
		'<div id="collapse_price_insert" class="collapse in">'.
        $this->ui->load_template('form_group_text',
            array(
                'label'         => 'Harga',
                'id'            => 'price_insert',
                'name'          => 'price',
                'class'         => 'cos form-control price',
                'maxlength'     => '200',
                )
        ).
        $this->ui->load_template('form_group_text',
            array(
                'label'         => 'Besar Bandwidth',
                'id'            => 'value_insert',
                'name'          => 'value',
                'class'         => 'cos form-control',
                'maxlength'     => '200',
                )
        ).
		$this->ui->load_template('form_group_dropdown',
            array(
                'label'         => 'Satuan Bandwidth',
                'name'          => 'satuan_bandwidth',
                'ext'         	=> 'class="form-control" id="satuan_bandwith_insert"',
                'option'     	=> array('Mbps'=>'Mbps', 'Kbps'=>'Kbps')
                )
        ).
		'</div>',
        $this->ui->load_template('form_group_textarea',
            array(
                'label'         => $this->lang->line('product_note'),
                'id'            => 'note_insert',
                'name'          => 'note',
                'class'         => 'cos form-control',
            )
        ),
        // $this->ui->load_template('form_group_textarea',
        //     array(
        //         'label'         => $this->lang->line('product_invoice_label'),
        //         'id'            => 'invoice_label_insert',
        //         'name'          => 'invoice_label',
        //         'class'         => 'cos form-control',
        //     )
        // ),
        // $this->ui->load_template('form_group_dropdown',
        //     array(
        //         'label'         => $this->lang->line('product_flag_fixprice'),
        //         'name'          => 'flag_fixprice',
        //         'ext'           => 'class="form-control" id="flag_fixprice_insert" ',
        //         'option'        => array(
        //                 'N'     => 'NO',
        //                 'Y'     => 'Yes'
        //             )
        //     )
        // ),
        $this->ui->load_template('checkbox_default',
            array(
                'label'         => $this->lang->line('product_flag_internet_service'),
                'name'          => 'flag_internet_service',
                'class'         => '',
                'id'          	=> 'flag_internet_service_insert',
                'value'         => 'Y',
                'checked'       => 'yes',
            )
        ),

    );
    echo $this->ui->load_template('modal_default_form_one_column', $arr, TRUE);
?>
