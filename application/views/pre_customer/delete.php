<?php
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('customer');
    $arr['modal_id'] = 'modal_customer_delete';
    $arr['form_id'] = 'form_customer_delete';
    $arr['form_action'] = '';
    $arr['modal_title'] = $this->lang->line('customer_delete');
    echo $this->ui->load_template('modal_delete', $arr, TRUE);
?>
