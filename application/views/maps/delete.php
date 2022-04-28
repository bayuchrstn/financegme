<?php
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('maps');
    $arr['modal_id'] = 'modal_maps_delete';
    $arr['form_id'] = 'form_maps_delete';
    $arr['form_action'] = '';
    $arr['modal_title'] = $this->lang->line('maps_delete');
    echo $this->ui->load_template('modal_delete', $arr, TRUE);
?>
