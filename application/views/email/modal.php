<?php

    $options['component'] = 'component/modal/modal_form';
    $options['modal_id'] = 'modal_email';
    $options['modal_size'] = 'modal-default';
    $options['modal_icon'] = $modul['icon'];
    $options['modal_title'] = 'Update Email';
    $options['form_id'] = 'modal_email_form';
    $options['form_action'] = base_url().'ajax_request/create_cart_boq';
    $options['main_content'] = $this->load->view('email/update', '', TRUE);
    echo $this->ui->load_component($options);

?>
