<?php
    $options['component'] = 'component/modal/modal_default';
    $options['modal_id'] = 'modal_as_mrk';
    $options['modal_size'] = 'modal-lg';
    $options['modal_icon'] = $this->theme->icon($modul['code']);
    $options['modal_title'] = 'Detail Marketing Request';
    $options['main_content'] = '<div id="modal_as_mrk_div"></div>';
    echo $this->ui->load_component($options);

    $options['component'] = 'component/modal/modal_default';
    $options['modal_id'] = 'modal_detail_customer';
    $options['modal_size'] = 'modal-lg';
    $options['modal_icon'] = $this->theme->icon($modul['code']);
    $options['modal_title'] = 'Detail Customer';
    $options['main_content'] = '<div id="div_detail_customer"></div>';
    echo $this->ui->load_component($options);
?>
