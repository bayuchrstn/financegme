<?php
    $options['component'] = 'component/modal/modal_default';
    $options['modal_id'] = 'modal_detail_mrk';
    $options['modal_size'] = 'modal-lg';
    $options['modal_icon'] = $this->theme->icon($modul['code']);
    $options['modal_title'] = 'Detail Marketing Request';
    $options['main_content'] = '<div id="modal_detail_mrk_div"></div>';
    echo $this->ui->load_component($options);
?>
