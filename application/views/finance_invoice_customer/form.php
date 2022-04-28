<?php
$data = array();
$data['prefix'] = 'insert';
$options = array();
$options['component'] = 'component/modal/modal_form';
$options['modal_id'] = 'modal_dialog_formulir';
$options['modal_size'] = 'modal-full';
$options['modal_title'] = '<i class="material-icons">&#xE865;</i> Form ' . $title_page_table;
$options['modal_footer'] = 'no';
$options['form_id'] = 'formulir_modal';
$options['form_action'] = '';
$options['main_content'] = $this->load->view('finance_invoice_customer/form_grid', $data, TRUE);
echo $this->ui->load_component($options);
