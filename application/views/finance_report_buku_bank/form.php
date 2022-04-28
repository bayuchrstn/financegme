<?php
$data = array();
$data['prefix'] = 'insert';
$options = array();
$options['component'] = 'component/modal/modal_form';
$options['modal_id'] = 'modal_finance_coa';
$options['modal_size'] = 'modal-default';
//$options['modal_icon'] = $this->theme->icon('finance_coa');
$options['modal_title'] = '<i class="material-icons">&#xE865;</i> Form <span id="title_modal_flexible"></span>';
$options['modal_footer'] = 'no';
$options['form_id'] = 'formulir_modal';
$options['form_action'] = '';
$options['main_content'] = $this->load->view('finance_report_buku_bank/form_grid', $data, TRUE);
echo $this->ui->load_component($options);

$data = array();
$data['prefix'] = 'insert';
$options = array();
$options['component'] = 'component/modal/modal_form';
$options['modal_id'] = 'modal_finance_tax_import';
$options['modal_size'] = 'modal-lg';
//$options['modal_icon'] = $this->theme->icon('finance_transaksi_kasir_out');
$options['modal_title'] = '<i class="material-icons">&#xE865;</i> Form <span id="title_modal_flexible"></span>';
$options['modal_footer'] = 'no';
$options['form_id'] = 'formulir_modal_import';
$options['form_action'] = '';
$options['main_content'] = $this->load->view('finance_report_buku_bank/form_import', $data, TRUE);
echo $this->ui->load_component($options);
