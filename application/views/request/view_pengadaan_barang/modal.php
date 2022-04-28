<?php
//modal pengadaan
$options['component'] = 'component/modal/modal_form';
$options['modal_id'] = 'modal_pengadaan';
$options['modal_size'] = 'modal-default';
$options['modal_icon'] = $this->theme->icon($modul['code']);
$options['modal_title'] = 'Tambah Item';
$options['form_id'] = 'modal_pengadaan_form';
$options['form_action'] = base_url().'ajax_request/create_cart_pengadaan';
$options['main_content'] = $this->load->view('request/pengajuan_barang/cart/form_grid_add_item', '', TRUE);
echo $this->ui->load_component($options);

//modal pembanding
$options['component'] = 'component/modal/modal_form';
$options['modal_id'] = 'modal_pembanding';
$options['modal_size'] = 'modal-default';
$options['modal_icon'] = $this->theme->icon($modul['code']);
$options['modal_title'] = 'Tambah Pembanding';
$options['form_id'] = 'modal_pembanding_form';
$options['form_action'] = base_url().'ajax_request/create_cart_pengadaan';
$options['main_content'] = $this->load->view('request/pengajuan_barang/cart/form_grid_add_pembanding', '', TRUE);
echo $this->ui->load_component($options);

//modal cart update
$options['component'] = 'component/modal/modal_form';
$options['modal_id'] = 'modal_cart_update';
$options['modal_size'] = 'modal-default';
$options['modal_icon'] = $this->theme->icon($modul['code']);
$options['modal_title'] = 'Update Item';
$options['form_id'] = 'modal_cart_update_form';
$options['form_action'] = base_url().'ajax_request/save_cart';
$options['main_content'] = '<div id="modal_cart_update_div"></div>';
echo $this->ui->load_component($options);

//modal current update
$options['component'] = 'component/modal/modal_form';
$options['modal_id'] = 'modal_current_update';
$options['modal_size'] = 'modal-default';
$options['modal_icon'] = $this->theme->icon($modul['code']);
$options['modal_title'] = 'Update Item';
$options['form_id'] = 'modal_current_update_form';
$options['form_action'] = '';
$options['main_content'] = '<div id="modal_current_update_div"></div>';
echo $this->ui->load_component($options);

//modal show this
$options['component'] = 'component/modal/modal_default';
$options['modal_id'] = 'modal_show_this';
$options['modal_size'] = 'modal-lg';
$options['modal_icon'] = $this->theme->icon($modul['code']);
$options['modal_title'] = 'Detail Pengajuan Barang';
$options['main_content'] = '<div id="modal_show_this_div"></div>';
echo $this->ui->load_component($options);

?>
