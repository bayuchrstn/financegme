<?php

$options['component'] = 'component/modal/modal_form';
$options['modal_id'] = 'modal_rpc_out';
$options['modal_size'] = 'modal-default';
$options['modal_icon'] = $this->theme->icon($modul['code']);
$options['modal_title'] = 'Barang Keluar';
$options['form_id'] = 'modal_rpc_out_form';
$options['form_action'] = base_url().'ajax_request/create_cart_pengadaan';
$options['main_content'] = '<div id="modal_rpc_out_div"></div>';
echo $this->ui->load_component($options);


$options['component'] = 'component/modal/modal_form';
$options['modal_id'] = 'modal_rpc_in';
$options['modal_size'] = 'modal-default';
$options['modal_icon'] = 'icon-box-add';
$options['modal_title'] = 'Barang Kembali';
$options['form_id'] = 'modal_rpc_in_form';
$options['form_action'] = base_url().'ajax_request/create_cart_rpc';
$options['main_content'] = '<div id="modal_rpc_in_div"></div>';
echo $this->ui->load_component($options);

//modal cart update
$options['component'] = 'component/modal/modal_form';
$options['modal_id'] = 'modal_cart_update_out';
$options['modal_size'] = 'modal-default';
$options['modal_icon'] = $this->theme->icon($modul['code']);
$options['modal_title'] = 'Update Barang Keluar';
$options['form_id'] = 'modal_cart_update_out_form';
$options['form_action'] = base_url().'ajax_request/modal_cart_update_out_action';
$options['main_content'] = '<div id="modal_cart_update_out_div"></div>';
echo $this->ui->load_component($options);

$options['component'] = 'component/modal/modal_form';
$options['modal_id'] = 'modal_cart_update_in';
$options['modal_size'] = 'modal-default';
$options['modal_icon'] = $this->theme->icon($modul['code']);
$options['modal_title'] = 'Update Barang Kembali';
$options['form_id'] = 'modal_cart_update_in_form';
$options['form_action'] = base_url().'ajax_request/modal_cart_update_in_action';
$options['main_content'] = '<div id="modal_cart_update_in_div"></div>';
echo $this->ui->load_component($options);

//modal current update
$options['component'] = 'component/modal/modal_form';
$options['modal_id'] = 'modal_current_update';
$options['modal_size'] = 'modal-default';
$options['modal_icon'] = $this->theme->icon($modul['code']);
$options['modal_title'] = '';
$options['form_id'] = 'modal_current_update_form';
$options['form_action'] = '';
$options['main_content'] = '<div id="modal_current_update_div"></div>';
echo $this->ui->load_component($options);

$options['component'] = 'component/modal/modal_default';
$options['modal_id'] = 'modal_detail_ro';
$options['modal_size'] = 'modal-lg';
$options['modal_icon'] = $this->theme->icon($modul['code']);
$options['modal_title'] = 'Detail Request';
$options['main_content'] = '<div id="modal_detail_ro_div"></div>';
echo $this->ui->load_component($options);
?>
