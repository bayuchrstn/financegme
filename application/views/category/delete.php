<?php
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('category');
    $arr['modal_id'] = 'modal_category_delete';
    $arr['form_id'] = 'form_category_delete';
    $arr['form_action'] = '';
    $arr['modal_title'] = $this->lang->line('category_delete');
    echo $this->ui->load_template('modal_delete', $arr, TRUE);
?>
