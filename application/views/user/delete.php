<?php
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('user');
    $arr['modal_id'] = 'modal_user_delete';
    $arr['form_id'] = 'form_user_delete';
    $arr['form_action'] = '';
    $arr['modal_title'] = $this->lang->line('user_delete');
    echo $this->ui->load_template('modal_delete', $arr);
?>
