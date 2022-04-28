<?php
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('cuti');
    $arr['modal_id'] = 'modal_cuti_delete';
    $arr['form_id'] = 'form_cuti_delete';
    $arr['form_action'] = '';
    $arr['modal_title'] = $this->lang->line('cuti_delete');
    echo $this->ui->load_template('modal_delete', $arr, TRUE);
?>
