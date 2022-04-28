<?php

	// $data = array();
	// $data['prefix'] = 'update';
	// $options = array();
	// $options['component'] = 'component/modal/modal_form';
	// $options['modal_id'] = 'modal_maps_update';
	// $options['modal_size'] = 'modal-default';
	// $options['modal_icon'] = $this->theme->icon('maps');
	// $options['modal_title'] = 'Update maps';
	// $options['modal_footer'] = 'no';
	// $options['form_id'] = 'form_maps_update';
	// $options['form_action'] = '';
	// $options['main_content'] = '';
	// echo $this->ui->load_component($options);
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('maps');
    $arr['modal_id'] = 'modal_maps_update';
    $arr['form_id'] = 'form_maps_update';
    $arr['form_action'] = '';
    $arr['form_input_top'] = '<div id="alert_modal_update"></div>';
    $arr['modal_title'] = $this->lang->line('maps_update');
    $arr['form_input'] = array(
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('maps_name'),
                    'id'            => 'maps_name_update',
                    'name'          => 'maps_name',
                    'class'         => 'form-control',
                    // 'ext'           => 'class="form-control" id="maps_people_update" ',
                    'maxlength'     => '200',
                )
            ),
            $this->ui->load_template('form_group_dropdown',
                array(
                    'label'         => $this->lang->line('maps_name'),
                    'name'          => 'maps_customer',
                    'ext'           => 'class="form-control select-chosen" id="maps_customer_update" ',
                    'option'        => '',
                    'selected'      => '',
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('maps_lat'),
                    'id'            => 'maps_lat_update',
                    'name'          => 'maps_lat',
                    'class'         => 'cos form-control',
                    'maxlength'     => '200',
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('maps_lng'),
                    'id'            => 'maps_lng_update',
                    'name'          => 'maps_lng',
                    'class'         => 'cos form-control',
                    'maxlength'     => '200',
                )
            ),
             $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('maps_lat2'),
                    'id'            => 'maps_lat2_update',
                    'name'          => 'maps_lat2',
                    'class'         => 'cos form-control',
                    'maxlength'     => '200',
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('maps_lng2'),
                    'id'            => 'maps_lng2_update',
                    'name'          => 'maps_lng2',
                    'class'         => 'cos form-control',
                    'maxlength'     => '200',
                )
            ),
            $this->ui->load_template('form_group_textarea',
                array(
                    'label'         => $this->lang->line('maps_desc'),
                    'id'            => 'maps_desc_update',
                    'name'          => 'maps_desc',
                    'class'         => 'cos form-control',
                )
            ),
            $this->ui->load_template('hidden',
                array(
                    'id'            => 'maps_type_update',
                    'name'          => 'maps_type',
                    'value'         => '',
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
