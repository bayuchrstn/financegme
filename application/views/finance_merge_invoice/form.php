<?php
$data = array();
$data['prefix'] = 'insert';
$options = array();
$options['component'] = 'component/modal/modal_form';
$options['modal_id'] = 'modal_dialog_formulir';
$options['modal_size'] = 'modal-lg';
$options['modal_title'] = '<i class="material-icons">&#xE865;</i> Form <span id="title_modal_flexible">' . $title_page_table . '</span>';
$options['modal_footer'] = 'no';
$options['form_id'] = 'formulir_modal';
$options['form_action'] = '';
$options['main_content'] = $this->load->view('finance_merge_invoice/form_grid', $data, TRUE);
echo $this->ui->load_component($options);
