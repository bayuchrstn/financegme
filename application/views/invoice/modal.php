<?php

    //modal pilih bulan invoice
    $options['component'] = 'component/modal/modal_form';
    $options['modal_id'] = 'modal_month_selector';
    $options['modal_size'] = 'modal-xs';
    $options['modal_icon'] = $this->theme->icon('invoice');
    $options['modal_title'] = 'Filter Invoice';
    $options['form_id'] = 'modal_month_selector_form';
    $options['form_action'] = base_url().'poe/invoice';
    $options['main_content'] = $this->load->view('invoice/form/filter', '', TRUE);
    echo $this->ui->load_component($options);

    //modal Generate
    $options['component'] = 'component/modal/modal_form';
    $options['modal_id'] = 'modal_generate_invoice';
    $options['modal_size'] = 'modal-large';
    $options['modal_icon'] = $this->theme->icon('invoice');
    $options['modal_title'] = 'Generate Invoice';
    $options['form_id'] = 'modal_generate_invoice_form';
    $options['form_action'] = base_url().'invoice/generate';
    $options['main_content'] = '<div id="modal_generate_invoice_div"></div>';
    echo $this->ui->load_component($options);

    //modal search invoice
    $options['component'] = 'component/modal/modal_default';
    $options['modal_id'] = 'modal_search_invoice';
    $options['modal_size'] = 'modal-lg';
    $options['modal_icon'] = $this->theme->icon('invoice');
    $options['modal_title'] = 'pencarian Invoice';
    $options['main_content'] = $this->load->view('invoice/form/search', '', TRUE);
    echo $this->ui->load_component($options);

    //modal main editor
    $options['component'] = 'component/modal/modal_default';
    $options['modal_id'] = 'modal_editor_invoice';
    $options['modal_size'] = 'modal-full';
    $options['modal_icon'] = $this->theme->icon('invoice');
    $options['modal_title'] = 'Detail Invoice';
    $options['main_content'] = '<div id="update_div"></div>';
    echo $this->ui->load_component($options);

    //modal add item
    $options['component'] = 'component/modal/modal_form';
    $options['modal_id'] = 'modal_add_item';
    $options['modal_size'] = 'modal-default';
    $options['modal_icon'] = $this->theme->icon('invoice');
    $options['modal_title'] = 'Add Item';
    $options['form_id'] = 'modal_add_item_form';
    $options['form_action'] = '';
    $options['main_content'] = '<div id="modal_add_item_div"></div>';
    echo $this->ui->load_component($options);

    //modal update item
    $options['component'] = 'component/modal/modal_form';
    $options['modal_id'] = 'modal_update_item';
    $options['modal_size'] = 'modal-default';
    $options['modal_icon'] = $this->theme->icon('invoice');
    $options['modal_title'] = 'Update Item';
    $options['form_id'] = 'modal_update_item_form';
    $options['form_action'] = '';
    $options['main_content'] = '<div id="modal_update_item_div"></div>';
    echo $this->ui->load_component($options);



?>
