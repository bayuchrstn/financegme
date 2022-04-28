<?php
    $options['component'] = 'component/modal/modal_default';
    $options['modal_id'] = 'modal_report';
    $options['modal_size'] = 'modal-default';
    $options['modal_icon'] = 'icon-search4';
    $options['modal_title'] = 'Laporan Hasil Survey';
    $options['main_content'] = '<div id="modal_report_div"></div>';
    echo $this->ui->load_component($options);
?>
