<?php
    //insert
    $arr_insert = array();
    $arr_insert['form_id'] = 'form_task_insert';
    $arr_insert['div_loader'] = 'form_task_insert';
    $arr_insert['console_log'] = 'yes';
    $arr_insert['alert'] = 'alert_modal_insert';
    $arr_insert['cos'] = 'yes';
    $arr_insert['datatables_reload'] = 'js_table_task';
    $arr_insert['hide_modal'] = 'no';
    $arr_insert['rules'] = array(
        'task_name'             => array('required' => 'true'),
        'task_address'          => array('required' => 'true'),
        'task_telephone'        => array('required' => 'true'),
    );
    $arr_insert['messages'] = array(
        'task_name'             => array('required' => $this->lang->line('task_name_required')),
        'task_address'          => array('required' => $this->lang->line('task_address_required')),
        'task_telephone'         => array('required' => $this->lang->line('task_telephone_required')),
    );
    echo $this->ui->load_template('validation',$arr_insert);

    //update
    $arr_update = array();
    $arr_update['form_id'] = 'form_task_update';
    $arr_update['div_loader'] = 'form_task_update';
    $arr_insert['console_log'] = 'yes';
    $arr_update['alert'] = 'alert_modal_update';
    $arr_update['cos'] = 'no';
    $arr_update['datatables_reload'] = 'js_table_task';
    $arr_update['hide_modal'] = 'no';
    $arr_insert['rules'] = array(
        'task_name'             => array('required' => 'true'),
        'task_address'          => array('required' => 'true'),
        'task_telephone'        => array('required' => 'true'),
    );
    $arr_insert['messages'] = array(
        'task_name'             => array('required' => $this->lang->line('task_name_required')),
        'task_address'          => array('required' => $this->lang->line('task_address_required')),
        'task_telephone'         => array('required' => $this->lang->line('task_telephone_required')),
    );
    echo $this->ui->load_template('validation',$arr_update);

    //delete
    $arr_delete = array();
    $arr_delete['form_id'] = 'form_task_delete';
    $arr_delete['div_loader'] = 'form_task_delete';
    $arr_delete['console_log'] = 'yes';
    $arr_delete['alert'] = 'yes';
    $arr_delete['cos'] = 'yes';
    $arr_delete['datatables_reload'] = 'js_table_task';
    $arr_delete['hide_modal'] = 'yes';
    $arr_delete['rules'] = array(
        'id'          => array('required' => 'true'),
    );
    // pre($arr_task);
    echo $this->ui->load_template('validation',$arr_delete);
?>
