<?php

	// $data = array();
	// $data['prefix'] = 'update';
	// $options = array();
	// $options['component'] = 'component/modal/modal_form';
	// $options['modal_id'] = 'modal_cuti_update';
	// $options['modal_size'] = 'modal-default';
	// $options['modal_icon'] = $this->theme->icon('cuti');
	// $options['modal_title'] = 'Update cuti';
	// $options['modal_footer'] = 'no';
	// $options['form_id'] = 'form_cuti_update';
	// $options['form_action'] = '';
	// $options['main_content'] = '';
	// echo $this->ui->load_component($options);
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('cuti');
    $arr['modal_id'] = 'modal_cuti_update';
    $arr['form_id'] = 'form_cuti_update';
    $arr['form_action'] = '';
    $arr['form_input_top'] = '<div id="alert_modal_update"></div>';
    $arr['modal_title'] = $this->lang->line('cuti_update');
    $arr['form_input'] = array(
            $this->ui->load_template('form_group_text_readonly',
                array(
                    'label'         => $this->lang->line('cuti_name'),
                    'id'            => 'cuti_people_update',
                    'name'          => 'cuti_people',
                    'class'         => 'form-control',
                    // 'ext'           => 'class="form-control" id="cuti_people_update" ',
                    'maxlength'     => '200',
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('cuti_date_start'),
                    'id'            => 'cuti_date_start_update',
                    'name'          => 'cuti_date_start',
                    'class'         => 'cos form-control date_picker',
                    'maxlength'     => '200',
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('cuti_date_end'),
                    'id'            => 'cuti_date_end_update',
                    'name'          => 'cuti_date_end',
                    'class'         => 'cos form-control date_picker',
                    'maxlength'     => '200',
                )
            ),
            $this->ui->load_template('form_group_textarea',
                array(
                    'label'         => $this->lang->line('cuti_note'),
                    'id'            => 'cuti_note_insert',
                    'name'          => 'cuti_note',
                    'class'         => 'cos form-control',
                )
            ),
            $this->ui->load_template('hidden',
                array(
                    'id'            => 'id_update',
                    'name'          => 'id',
                    'value'         => '',
                )
            ),
	
        );
    echo $this->ui->load_template('modal_default_form_one_column', $arr, TRUE);
?>
