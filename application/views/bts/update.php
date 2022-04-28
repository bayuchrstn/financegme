<?php

	$data = array();
	$data['prefix'] = 'update';
	$options = array();
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_bts_update';
	$options['modal_size'] = 'modal-default';
	$options['modal_icon'] = $this->theme->icon('bts');
	$options['modal_title'] = 'Update BTS';
	$options['modal_footer'] = 'no';
	$options['form_id'] = 'form_bts_update';
	$options['form_action'] = '';
	$options['main_content'] = $this->load->view('bts/form_grid', $data, TRUE);
	echo $this->ui->load_component($options);
    // $arr = array();
    // $arr['modal_icon'] = $this->theme->icon('bts');
    // $arr['modal_id'] = 'modal_bts_update';
    // $arr['form_id'] = 'form_bts_update';
    // $arr['form_action'] = '';
    // $arr['form_input_top'] = '<div id="alert_modal_update"></div>';
    // $arr['modal_title'] = $this->lang->line('bts_update');
    // $arr['form_input'] = array(
    //         $this->ui->load_template('form_group_text',
    //             array(
    //                 'label'         => $this->lang->line('bts_name'),
    //                 'id'            => 'bts_name_update',
    //                 'name'          => 'bts_name',
    //                 'class'         => 'cos form-control',
    //                 'maxlength'     => '200',
    //             )
    //         ),
    //         $this->ui->load_template('form_group_textarea',
    //             array(
    //                 'label'         => $this->lang->line('bts_address'),
    //                 'id'            => 'bts_address_update',
    //                 'name'          => 'bts_address',
    //                 'class'         => 'cos form-control',
    //             )
    //         ),
    //         $this->ui->load_template('form_group_textarea',
    //             array(
    //                 'label'         => $this->lang->line('bts_note'),
    //                 'id'            => 'bts_note_insert',
    //                 'name'          => 'bts_note',
    //                 'class'         => 'cos form-control',
    //             )
    //         ),
    //         $this->ui->load_template('hidden',
    //             array(
    //                 'id'            => 'id_update',
    //                 'name'          => 'id',
    //                 'value'         => '',
    //             )
    //         ),
	//
    //     );
    // echo $this->ui->load_template('modal_default_form_one_column', $arr, TRUE);
?>
