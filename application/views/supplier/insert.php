<?php
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('supplier');
    $arr['modal_id'] = 'modal_supplier_insert';
    $arr['form_id'] = 'form_supplier_insert';
    $arr['form_action'] = base_url().'supplier/insert';
    $arr['modal_title'] = $this->lang->line('supplier_insert');
    $arr['form_input_top'] = '<div id="alert_modal_insert"></div>';
    $arr['form_input'] = array(
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('supplier_name'),
                    'id'            => 'supplier_name_insert',
                    'name'          => 'supplier_name',
                    'class'         => 'cos form-control',
                    'maxlength'     => '200',
                )
            ),
            $this->ui->load_template('form_group_textarea',
                array(
                    'label'         => $this->lang->line('supplier_address'),
                    'id'            => 'supplier_address_insert',
                    'name'          => 'supplier_address',
                    'class'         => 'cos form-control',
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('supplier_telephone'),
                    'id'            => 'supplier_telephone_insert',
                    'name'          => 'supplier_telephone',
                    'class'         => 'cos form-control',
                    'maxlength'     => '200',
                )
            ),
        );
    echo $this->ui->load_template('modal_default_form_one_column', $arr, TRUE);
?>
