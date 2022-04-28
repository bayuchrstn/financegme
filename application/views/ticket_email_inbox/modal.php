<?php
    $options['component'] = 'component/modal/modal_form';
    $options['modal_id'] = 'modal_timbox';
    $options['modal_size'] = 'modal-default';
    $options['modal_icon'] = 'icon-search4';
    $options['modal_title'] = 'Laporan Hasil Survey';
    $options['form_id']   = 'modal_timbox_form';
    $options['form_action'] = '';
    $options['main_content'] = '<div id="modal_timbox_div"></div>';
    echo $this->ui->load_component($options);
?>
