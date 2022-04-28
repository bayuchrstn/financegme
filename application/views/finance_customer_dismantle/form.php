<?php
$data = array();
$data['prefix'] = 'insert';
$options = array();
$options['component'] = 'component/modal/modal_form';
$options['modal_id'] = 'modal_dialog_formulir';
$options['modal_size'] = 'modal-lg';
$options['modal_title'] = '<i class="material-icons">&#xE865;</i> Daftar Invoice</span>';
$options['modal_footer'] = 'no';
$options['form_id'] = 'formulir_modal';
$options['form_action'] = '';
$options['main_content'] = $this->load->view('finance_customer_dismantle/form_grid', $data, TRUE);
echo $this->ui->load_component($options);
