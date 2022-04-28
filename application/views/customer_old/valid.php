<?php
    //insert
    $arr_insert = array();
    $arr_insert['form_id'] = 'form_customer_insert';
    $arr_insert['div_loader'] = 'form_customer_insert';
    $arr_insert['console_log'] = 'yes';
    $arr_insert['alert'] = 'alert_modal_insert';
    $arr_insert['cos'] = 'yes';
    $arr_insert['datatables_reload'] = 'js_table_customer';
    $arr_insert['hide_modal'] = 'no';
    $arr_insert['rules'] = array(
        'customer_name'          => array('required' => 'true'),
    );
    $arr_insert['messages'] = array(
        'customer_name'          => array('required' => $this->lang->line('customer_name_required')),
    );
    echo $this->ui->load_template('validation',$arr_insert);

    //update
    $arr_update = array();
    $arr_update['form_id'] = 'form_customer_update';
    $arr_update['div_loader'] = 'form_customer_update';
    $arr_insert['console_log'] = 'yes';
    $arr_update['alert'] = 'alert_modal_update';
    $arr_update['cos'] = 'no';
    $arr_update['datatables_reload'] = 'js_table_customer';
    $arr_update['hide_modal'] = 'no';
    $arr_update['rules'] = array(
        'name'          => array('required' => 'true'),
        'telephone'     => array('required' => 'true'),
        'email'         => array('required' => 'true', 'email'=>'true'),
        'username'      => array('required' => 'true'),
    );
    $arr_update['messages'] = array(
        'name'          => array('required' => $this->lang->line('customer_name_required')),
        'telephone'     => array('required' => $this->lang->line('customer_telephone_required')),
        'email'         => array(
                'required'  => $this->lang->line('customer_email_required'),
                'email'     => $this->lang->line('customer_email_valid')
            ),
        'username'      => array('required' => $this->lang->line('customer_username_required')),
    );
    echo $this->ui->load_template('validation',$arr_update);

    //product
    $arr_product = array();
    $arr_product['form_id'] = 'form_customer_product';
    $arr_product['div_loader'] = 'form_customer_product';
    $arr_insert['console_log'] = 'no';
    $arr_product['alert'] = 'alert_modal_product';
    $arr_product['cos'] = 'no';
    $arr_product['datatables_reload'] = 'js_table_customer';
    $arr_product['hide_modal'] = 'no';
    $arr_product['rules'] = array(
        'name'          => array('required' => 'true'),
    );
    $arr_product['messages'] = array(
        'name'          => array('required' => $this->lang->line('customer_name_required')),
    );
    // pre($arr_product);
    echo $this->ui->load_template('validation',$arr_product);

    $arr_delete = array();
    $arr_delete['form_id'] = 'form_customer_delete';
    $arr_delete['div_loader'] = 'form_customer_delete';
    $arr_delete['console_log'] = 'yes';
    $arr_delete['alert'] = 'yes';
    $arr_delete['cos'] = 'yes';
    $arr_delete['datatables_reload'] = 'js_table_customer';
    $arr_delete['hide_modal'] = 'yes';
    $arr_delete['rules'] = array(
        'id'          => array('required' => 'true'),
    );
    $arr_delete['messages'] = array(
        'id'          => array('required' => $this->lang->line('customer_name_required')),
    );
    // pre($arr_product);
    echo $this->ui->load_template('validation',$arr_delete);
?>
