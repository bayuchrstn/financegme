<?php
    //insert
    $arr_insert = array();
    $arr_insert['form_id'] = 'form_item_detail_insert';
    $arr_insert['div_loader'] = 'form_item_detail_insert';
    $arr_insert['console_log'] = 'yes';
    $arr_insert['alert'] = 'alert_modal_insert';
    $arr_insert['cos'] = 'no';
    $arr_insert['datatables_reload'] = 'js_table_available';
    $arr_insert['hide_modal'] = 'no';
    $arr_insert['rules'] = array(
        'item_no_item'             => array('required' => 'true'),
        'item_date_buy'          => array('required' => 'true'),
    );
    $arr_insert['messages'] = array(
        'item_no_item'             => array('required' => $this->lang->line('item_detail_no_item_required')),
        'item_date_buy'          => array('required' => $this->lang->line('item_detail_date_buy_required')),
    );
    echo $this->ui->load_template('validation',$arr_insert);

    //update
    $arr_update = array();
    $arr_update['form_id'] = 'form_item_detail_update';
    $arr_update['div_loader'] = 'form_item_detail_update';
    $arr_insert['console_log'] = 'yes';
    $arr_update['alert'] = 'alert_modal_update';
    $arr_update['cos'] = 'no';
    $arr_update['datatables_reload'] = 'js_table_available';
    $arr_update['hide_modal'] = 'no';
    $arr_update['rules'] = array(
        'item_no_item_update'             => array('required' => 'true'),
        'item_date_buy_update'          => array('required' => 'true'),
        // 'item_mac_update'          => array(
            // 'callback_mac_check_edit' => 'true'),
    );
    $arr_update['messages'] = array(
        'item_no_item_update'             => array('required' => $this->lang->line('item_detail_no_item_required')),
        'item_date_buy_update'          => array('required' => $this->lang->line('item_detail_date_buy_required')),
        // 'item_mac_update'          => array('callback_mac_check_edit' => 'Format penulisan Mac Address Salah/mac address ini sudah ada dalam database'),
    );
    echo $this->ui->load_template('validation',$arr_update);

    //delete
    $arr_delete = array();
    $arr_delete['form_id'] = 'form_item_detail_delete';
    $arr_delete['div_loader'] = 'form_item_detail_delete';
    $arr_delete['console_log'] = 'yes';
    $arr_delete['alert'] = 'yes';
    $arr_delete['cos'] = 'yes';
    $arr_delete['datatables_reload'] = 'js_table_available';
    $arr_delete['hide_modal'] = 'yes';
    $arr_delete['rules'] = array(
        'id'          => array('required' => 'true'),
    );
    // pre($arr_item);
    echo $this->ui->load_template('validation',$arr_delete);
?>
