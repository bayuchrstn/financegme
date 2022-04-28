<?php
    $arr = array();
    // $arr['modal_icon'] = $this->theme->icon('item');
    $arr['modal_id'] = 'modal_item_detail_delete';
    $arr['form_id'] = 'form_item_detail_delete';
    $arr['form_action'] = '';
    $arr['modal_title'] = $this->lang->line('item_detail_delete');
    echo $this->ui->load_template('modal_delete', $arr, TRUE);
?>
