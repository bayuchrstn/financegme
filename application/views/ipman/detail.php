<?php
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('ipman');
    $arr['modal_id'] = 'modal_ipman_detail';
    $arr['modal_title'] = $this->lang->line('ipman_detail');
    $arr['modal_size'] = 'modal-full';
    $arr['main_content'] = '<div id="modal_ipman_detail_body"></div>';
    echo $this->ui->load_template('modal_default', $arr, TRUE);
?>