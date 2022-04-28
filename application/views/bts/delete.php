<?php
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('bts');
    $arr['modal_id'] = 'modal_bts_delete';
    $arr['form_id'] = 'form_bts_delete';
    $arr['form_action'] = '';
    $arr['modal_title'] = $this->lang->line('bts_delete');
    echo $this->ui->load_template('modal_delete', $arr, TRUE);
?>
