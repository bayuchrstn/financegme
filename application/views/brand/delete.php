<?php
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('brand');
    $arr['modal_id'] = 'modal_brand_delete';
    $arr['form_id'] = 'form_brand_delete';
    $arr['form_action'] = '';
    $arr['modal_title'] = $this->lang->line('brand_delete');
    echo $this->ui->load_template('modal_delete', $arr, TRUE);
?>
