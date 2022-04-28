<?php

    $data['prefix'] = 'create';
    $options['component'] = 'component/modal/modal_form';
    $options['modal_id'] = 'modal_ticket_insert';
    $options['modal_size'] = 'modal-lg';
    $options['modal_icon'] = $this->theme->icon($modul['code']);
    $options['modal_title'] = 'Create Ticket';
    $options['form_id'] = 'modal_ticket_insert_form';
    $options['form_action'] = base_url().'xhr/ticket/insert';
    $options['main_content'] = $this->load->view('request/ticket/form_grid', $data, TRUE);
    // $options['main_content'] = $this->load->view('request/ticket/tab_form', '', TRUE);
    echo $this->ui->load_component($options);

    $data['prefix'] = 'view_ticket';
    $options['component'] = 'component/modal/modal_default';
    $options['modal_id'] = 'modal_ticket_update';
    $options['modal_size'] = 'modal-full';
    $options['modal_icon'] = $this->theme->icon($modul['code']);
    $options['modal_title'] = 'Update Ticket';
    $options['form_id'] = 'modal_ticket_update_form';
    $options['form_action'] = base_url().'ajax_request/create_cart_boq';
    $options['main_content'] = $this->load->view('request/ticket/tab_form', $data, TRUE);
    echo $this->ui->load_component($options);

    $options['component'] = 'component/modal/modal_default';
    $options['modal_id'] = 'modal_ticket';
    $options['modal_size'] = 'modal-default';
    $options['modal_icon'] = '';
    $options['modal_title'] = 'Ticket';
    // $options['main_content'] = '<div id="modal_ticket_div"></div>';
    $options['main_content'] = $this->load->view('request/ticket/tab_detail', $data, TRUE);
    echo $this->ui->load_component($options);

    $options['modal_id'] = 'modal_balas_ticket';
    $options['modal_title'] = 'Komentari';
    $options['main_content'] = '<div id="modal_balas_ticket_div"></div>';
    echo $this->ui->load_component($options);

?>
