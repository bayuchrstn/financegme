<?php
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('ipman');
    $arr['modal_id'] = 'modal_ipman_delete';
    $arr['form_id'] = 'form_ipman_delete';
    $arr['form_action'] = '';
    $arr['modal_title'] = $this->lang->line('ipman_delete');
    echo $this->ui->load_template('modal_delete', $arr, TRUE);
?>
