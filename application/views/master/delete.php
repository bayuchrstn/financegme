<?php
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon($category);
    $arr['modal_id'] = 'modal_master_delete';
    $arr['form_id'] = 'form_master_delete';
    $arr['form_action'] = '';
    $arr['modal_title'] = $this->lang->line('all_delete').' '.$master_name;
    echo $this->ui->load_template('modal_delete', $arr, TRUE);
?>
