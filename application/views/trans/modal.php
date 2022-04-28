<?php
    //main update
    $data = array();
    $options['component'] = 'component/modal/modal_form';
    $options['modal_id'] = 'modal_trans_insert';
    $options['modal_size'] = 'modal-lg';
    $options['modal_icon'] = $modul['icon'];
    $options['modal_title'] = 'Input '.$modul['name'];
    $options['modal_footer'] = 'yes';
    $options['form_id'] = 'modal_trans_insert_form';
    $options['form_action'] = '';
    $options['main_content'] = '<div id="modal_trans_insert_div"></div>';
    echo $this->ui->load_component($options);
?>
