<?php
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('product');
    $arr['modal_id'] = 'modal_product_update';
    $arr['form_id'] = 'form_product_update';
    $arr['form_action'] = '';
    $arr['form_input_top'] = '<div id="alert_modal_update"></div>';
    $arr['modal_title'] = $this->lang->line('product_update');
    $arr['form_input'] = array(
			$this->ui->load_template('form_group_dropdown',
				array(
					'label'         => $this->lang->line('product_category'),
					'name'          => 'category',
					'ext'           => 'class="form-control" id="category_update" ',
					'option'        => $this->product->arr_product_category(),
				)
			),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('product_name'),
                    'id'            => 'name_update',
                    'name'          => 'name',
                    'class'         => 'form-control',
                    'maxlength'     => '200',
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => 'Invoice Label',
                    'id'            => 'invoice_label_update',
                    'name'          => 'invoice_label',
                    'class'         => 'form-control',
                    'maxlength'     => '200',
                )
            ),

			$this->ui->load_template('checkbox_collapse',
	            array(
	                'label'         			=> $this->lang->line('product_flag_fixprice'),
	                'name'          			=> 'flag_fixprice',
	                'class'         			=> '',
	                'id'          				=> 'flag_fixprice_update',
	                'value'         			=> 'Y',
	                'collapse_target'         	=> 'collapse_price_update',
	            )
	        ),
			'<div id="collapse_price_update" class="collapse in">'.
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('product_price'),
                    'id'            => 'price_update',
                    'name'          => 'price',
                    'class'         => 'form-control price',
                    'maxlength'     => '200',
                    )
            ).
			$this->ui->load_template('form_group_text',
	            array(
	                'label'         => 'Besar Bandwidth',
	                'id'            => 'value_update',
	                'name'          => 'value',
	                'class'         => 'cos form-control',
	                'maxlength'     => '200',
	                )
	        ).
			$this->ui->load_template('form_group_dropdown',
	            array(
	                'label'         => 'Satuan Bandwidth',
	                'name'          => 'satuan_bandwidth',
	                'ext'         	=> 'class="form-control" id="satuan_bandwith_update"',
	                'option'     	=> array('Mbps'=>'Mbps', 'Kbps'=>'Kbps')
	                )
	        ).
			'</div>',
            $this->ui->load_template('form_group_textarea',
                array(
                    'label'         => $this->lang->line('product_note'),
                    'id'            => 'note_update',
                    'name'          => 'note',
                    'class'         => 'form-control',
                )
            ),
            // $this->ui->load_template('form_group_textarea',
            //     array(
            //         'label'         => $this->lang->line('product_invoice_label'),
            //         'id'            => 'invoice_label_update',
            //         'name'          => 'invoice_label',
            //         'class'         => 'form-control',
            //     )
            // ),
			$this->ui->load_template('checkbox_default',
	            array(
	                'label'         => $this->lang->line('product_flag_internet_service'),
	                'name'          => 'flag_internet_service',
	                'class'         => '',
	                'id'          	=> 'flag_internet_service_update',
	                'value'         => 'Y',
	                'checked'       => 'yes',
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
    echo $this->ui->load_template('modal_default_form_one_column', $arr, TRUE);
?>
