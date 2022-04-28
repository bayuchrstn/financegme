<?php
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('overtime');
    $arr['modal_id'] = 'modal_overtime_approve';
    $arr['form_id'] = 'form_overtime_approve';
    $arr['form_action'] = '';
    $arr['modal_title'] = $this->lang->line('overtime_approve');
    echo $this->ui->load_template('modal_approve', $arr, TRUE);
?>
