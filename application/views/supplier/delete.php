<?php
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('supplier');
    $arr['modal_id'] = 'modal_supplier_delete';
    $arr['form_id'] = 'form_supplier_delete';
    $arr['form_action'] = '';
    $arr['modal_title'] = $this->lang->line('supplier_delete');
    echo $this->ui->load_template('modal_delete', $arr, TRUE);
?>
