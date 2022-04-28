<?php
    //update
    $arr_update = array();
    $arr_update['form_id'] = 'form_email_notification_update';
    $arr_update['div_loader'] = 'form_email_notification_update';
    $arr_insert['console_log'] = 'yes';
    $arr_update['alert'] = 'alert_modal_update';
    $arr_update['cos'] = 'no';
    $arr_update['datatables_reload'] = 'js_table_email_notification';
    $arr_update['hide_modal'] = 'no';
    $arr_update['rules'] = array(
        'subject'          => array('required' => 'true'),
        'body_fake'        => array('required' => 'true'),
    );
    $arr_update['messages'] = array(
        'name'          => array('required' => $this->lang->line('email_notification_subject_required')),
        'body_fake'     => array('required' => $this->lang->line('email_notification_body_required')),
    );
    echo $this->ui->load_template('validation',$arr_update);
?>
