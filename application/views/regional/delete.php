<?php
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('product');
    $arr['modal_id'] = 'modal_product_delete';
    $arr['form_id'] = 'form_product_delete';
    $arr['form_action'] = '';
    $arr['modal_title'] = $this->lang->line('product_delete');
    echo $this->ui->load_template('modal_delete', $arr, TRUE);
?>
