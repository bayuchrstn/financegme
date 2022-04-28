<?php
    // pre($modul);
    $data['prefix'] = 'tak_itemss';
    $options['component'] = 'component/modal/modal_form';
    $options['modal_id'] = 'modal_task_item_insert';
    $options['modal_size'] = 'modal-default';
    $options['modal_icon'] = $modul['icon'];
    $options['modal_title'] = 'Create';
    $options['form_id'] = 'modal_task_item_insert_form';
    $options['form_action'] = base_url().'ajax_request/create_cart_boq';
    $options['main_content'] = '<div id="modal_task_item_insert_div"></div>';
    echo $this->ui->load_component($options);

?>
