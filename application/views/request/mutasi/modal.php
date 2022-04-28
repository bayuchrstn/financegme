<?php

$options['component'] = 'component/modal/modal_form';
$options['modal_id'] = 'modal_mutasi_insert';
$options['modal_size'] = 'modal-default';
$options['modal_icon'] = $this->theme->icon($modul['code']);
$options['modal_title'] = 'Input Mutasi Pelanggan';
$options['form_id'] = 'modal_mutasi_insert_form';
$options['form_action'] = base_url().'ajax_request/create_cart_boq';
$options['main_content'] = '<div id="modal_mutasi_insert_div"></div>';
echo $this->ui->load_component($options);


?>
