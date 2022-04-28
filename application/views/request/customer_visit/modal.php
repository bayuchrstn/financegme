<?php

$options['component'] = 'component/modal/modal_form';
$options['modal_id'] = 'modal_boq';
$options['modal_size'] = 'modal-default';
$options['modal_icon'] = $this->theme->icon($modul['code']);
$options['modal_title'] = 'Tambah Item';
$options['form_id'] = 'modal_boq_form';
$options['form_action'] = base_url().'ajax_request/create_cart_boq';
$options['main_content'] = $this->load->view('request/boq/cart/form_grid_add_item', '', TRUE);
echo $this->ui->load_component($options);

// $options['component'] = 'component/modal/modal_form';
// $options['modal_id'] = 'modal_form_add_item';
// $options['modal_size'] = 'modal-default';
// $options['modal_icon'] = '';
// $options['modal_title'] = 'Tambah Barang BOQ';
// $options['form_id'] = 'form_'.$modul['code'].'_insert';
// $options['form_action'] = base_url().'request/insert';
// $options['main_content'] = '<div id="show_detail_pekerjaan_div"></div>';
// echo $this->ui->load_component($options);

$options['component'] = 'component/modal/modal_default';
$options['modal_id'] = 'modal_boq_view_lap_survey_ts';
$options['modal_size'] = 'modal-default';
$options['modal_icon'] = 'icon-search4';
$options['modal_title'] = 'Laporan Hasil Survey';
$options['main_content'] = '<div id="modal_boq_view_lap_survey_ts_div"></div>';
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
$options['modal_title'] = 'Detail Customer Visit';
$options['main_content'] = '<div id="modal_show_this_div"></div>';
echo $this->ui->load_component($options);

?>
