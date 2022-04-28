<?php
    //main update
    $data = array();
    $options['component'] = 'component/modal/modal_form';
    $options['modal_id'] = 'modal_alert_config';
    $options['modal_size'] = 'modal-lg';
    $options['modal_icon'] = 'icon-bell3';
    $options['modal_title'] = 'Update Notifikasi';
    $options['modal_footer'] = 'yes';
    $options['form_id'] = 'modal_alert_config_form';
    $options['form_action'] = '';
    $options['main_content'] = '<div id="modal_alert_config_div"></div>';
    echo $this->ui->load_component($options);
?>
