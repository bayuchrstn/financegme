<?php
    //insert
    $arr_insert = array();
    $arr_insert['form_id'] = 'form_overtime_insert';
    $arr_insert['div_loader'] = 'form_overtime_insert';
    $arr_insert['console_log'] = 'yes';
    $arr_insert['alert'] = 'alert_modal_insert';
    $arr_insert['cos'] = 'yes';
    $arr_insert['datatables_reload'] = array('js_table_request','js_table_approve');
    $arr_insert['hide_modal'] = 'no';
    $arr_insert['rules'] = array(
        'overtime_red'             => array('required' => 'true'),
    );
    $arr_insert['messages'] = array(
        'overtime_red'             => array('required' => $this->lang->line('overtime_red_required')),
    );
    echo $this->ui->load_template('validation',$arr_insert);

    //update
    $arr_update = array();
    $arr_update['form_id'] = 'form_overtime_update';
    $arr_update['div_loader'] = 'form_overtime_update';
    $arr_update['console_log'] = 'yes';
    $arr_update['alert'] = 'alert_modal_update';
    $arr_update['cos'] = 'no';
    $arr_update['datatables_reload'] = array('js_table_request','js_table_approve');
    $arr_update['hide_modal'] = 'no';
    $arr_update['rules'] = array(
        'overtime_red'             => array('required' => 'true'),
    );
    $arr_update['messages'] = array(
        'overtime_red'             => array('required' => $this->lang->line('overtime_red_required')),
    );
    echo $this->ui->load_template('validation',$arr_update);

    //delete
    $arr_delete = array();
    $arr_delete['form_id'] = 'form_overtime_delete';
    $arr_delete['div_loader'] = 'form_overtime_delete';
    $arr_delete['console_log'] = 'yes';
    $arr_delete['alert'] = 'yes';
    $arr_delete['cos'] = 'yes';
    $arr_delete['datatables_reload'] = array('js_table_request','js_table_approve');
    $arr_delete['hide_modal'] = 'yes';
    $arr_delete['rules'] = array(
        'id'          => array('required' => 'true'),
    );
    // pre($arr_bts);
    echo $this->ui->load_template('validation',$arr_delete);

    //approve
    $arr_approve = array();
    $arr_approve['form_id'] = 'form_overtime_approve';
    $arr_approve['div_loader'] = 'form_overtime_approve';
    $arr_approve['console_log'] = 'yes';
    $arr_approve['alert'] = 'yes';
    $arr_approve['cos'] = 'yes';
    $arr_approve['datatables_reload'] = array('js_table_request','js_table_approve');
    $arr_approve['hide_modal'] = 'yes';
    $arr_approve['rules'] = array(
        'id'          => array('required' => 'true'),
    );
    // pre($arr_bts);
    echo $this->ui->load_template('validation',$arr_approve);
?>
