<?php
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('supplier');
    $arr['modal_id'] = 'modal_supplier_update';
    $arr['form_id'] = 'form_supplier_update';
    $arr['form_action'] = '';
    $arr['form_input_top'] = '<div id="alert_modal_update"></div>';
    $arr['modal_title'] = $this->lang->line('supplier_update');
    $arr['form_input'] = array(
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('supplier_name'),
                    'id'            => 'supplier_name_update',
                    'name'          => 'supplier_name',
                    'class'         => 'cos form-control',
                    'maxlength'     => '200',
                )
            ),
            $this->ui->load_template('form_group_textarea',
                array(
                    'label'         => $this->lang->line('supplier_address'),
                    'id'            => 'supplier_address_update',
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
