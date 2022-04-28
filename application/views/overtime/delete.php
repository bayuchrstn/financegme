<?php
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('btovertimes');
    $arr['modal_id'] = 'modal_overtime_delete';
    $arr['form_id'] = 'form_overtime_delete';
    $arr['form_action'] = '';
    $arr['modal_title'] = $this->lang->line('overtime_delete');
    echo $this->ui->load_template('modal_delete', $arr, TRUE);
?>
