<?php
    //insert
    $arr_insert = array();
    $arr_insert['form_id'] = 'form_supplier_insert';
    $arr_insert['div_loader'] = 'form_supplier_insert';
    $arr_insert['console_log'] = 'yes';
    $arr_insert['alert'] = 'alert_modal_insert';
    $arr_insert['cos'] = 'yes';
    $arr_insert['datatables_reload'] = 'js_table_supplier';
    $arr_insert['hide_modal'] = 'no';
    $arr_insert['rules'] = array(
        'supplier_name'             => array('required' => 'true'),
        'supplier_address'          => array('required' => 'true'),
        'supplier_telephone'        => array('required' => 'true'),
    );
    $arr_insert['messages'] = array(
        'supplier_name'             => array('required' => $this->lang->line('supplier_name_required')),
        'supplier_address'          => array('required' => $this->lang->line('supplier_address_required')),
        'supplier_telephone'         => array('required' => $this->lang->line('supplier_telephone_required')),
    );
    echo $this->ui->load_template('validation',$arr_insert);

    //update
    $arr_update = array();
    $arr_update['form_id'] = 'form_supplier_update';
    $arr_update['div_loader'] = 'form_supplier_update';
    $arr_insert['console_log'] = 'yes';
    $arr_update['alert'] = 'alert_modal_update';
    $arr_update['cos'] = 'no';
    $arr_update['datatables_reload'] = 'js_table_supplier';
    $arr_update['hide_modal'] = 'no';
    $arr_insert['rules'] = array(
        'supplier_name'             => array('required' => 'true'),
        'supplier_address'          => array('required' => 'true'),
        'supplier_telephone'        => array('required' => 'true'),
    );
    $arr_insert['messages'] = array(
        'supplier_name'             => array('required' => $this->lang->line('supplier_name_required')),
        'supplier_address'          => array('required' => $this->lang->line('supplier_address_required')),
        'supplier_telephone'         => array('required' => $this->lang->line('supplier_telephone_required')),
    );
    echo $this->ui->load_template('validation',$arr_update);

    //delete
    $arr_delete = array();
    $arr_delete['form_id'] = 'form_supplier_delete';
    $arr_delete['div_loader'] = 'form_supplier_delete';
    $arr_delete['console_log'] = 'yes';
    $arr_delete['alert'] = 'yes';
    $arr_delete['cos'] = 'yes';
    $arr_delete['datatables_reload'] = 'js_table_supplier';
    $arr_delete['hide_modal'] = 'yes';
    $arr_delete['rules'] = array(
        'id'          => array('required' => 'true'),
    );
    // pre($arr_supplier);
    echo $this->ui->load_template('validation',$arr_delete);
?>
