<?php
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('customer');
    $arr['modal_id'] = 'modal_customer_update';
    $arr['form_id'] = 'form_customer_update';
    $arr['form_action'] = '';
    $arr['form_input_top'] = '<div id="alert_modal_update"></div>';
    $arr['modal_title'] = $this->lang->line('customer_update');
    // left
    $arr['form_input_left'] = array(
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('customer_customer_name'),
                    'id'            => 'customer_name_update',
                    'name'          => 'customer_name',
                    'class'         => 'form-control',
                    'maxlength'     => '200',
                    // 'value'         => 'hasek',
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('customer_customer_address'),
                    'id'            => 'customer_address_update',
                    'name'          => 'customer_address',
                    'class'         => 'form-control',
                    'maxlength'     => '200',
                    // 'value'         => 'hasek',
                )
            ),


        );

    // right
    $arr['form_input_right'] = array(
            // $this->ui->load_template('form_group_text',
            //     array(
            //         'label'         => $this->lang->line('all_username'),
            //         'id'            => 'username_update',
            //         'name'          => 'username',
            //         'class'         => 'form-control cos',
            //         'maxlength'     => '200',
            //         // 'value'         => 'hasek',
            //     )
            // ),

        );

    echo $this->ui->load_template('modal_large_form_three_column', $arr, TRUE);
?>
