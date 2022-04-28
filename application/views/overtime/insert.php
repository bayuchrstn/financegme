<?php
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('overtime');
    $arr['modal_id'] = 'modal_overtime_insert';
    $arr['form_id'] = 'form_overtime_insert';
    $arr['form_action'] = base_url().'overtime/insert';
    $arr['modal_title'] = $this->lang->line('overtime_insert');
    $arr['form_input_top'] = '<div id="alert_modal_insert"></div>';
    $arr['form_input'] = array(
            $this->ui->load_template('form_group_dropdown',
                array(
                    'label'         => $this->lang->line('overtime_red'),
                    'name'          => 'overtime_red',
                    'ext'           => 'class="form-control" id="overtime_red_insert" ',
                    'option'        => array('0' => 'Tidak','1' => 'Ya'),
                    'selected'      => '',
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('overtime_red_date'),
                    'id'            => 'overtime_red_date_insert',
                    'name'          => 'overtime_red_date',
                    'class'         => 'cos form-control date_picker',
                    'maxlength'     => '200',
                    'value'         => ''
                )
            ),
            $this->ui->load_template('form_group_dropdown',
                array(
                    'label'         => $this->lang->line('overtime_shift'),
                    'name'          => 'overtime_shift',
                    'ext'           => 'class="form-control" id="overtime_shift_insert" ',
                    'option'        => array('Shift 1' => 'Shift 1','Shift 2' => 'Shift 2','Shift 3'=> 'Shift 3'),
                    'selected'      => '',
                )
            ),
            //select task undone
            $this->ui->load_template('form_group_dropdown',
                array(
                    'label'         => $this->lang->line('overtime_task'),
                    'name'          => 'overtime_task',
                    'ext'           => 'class="form-control" id="overtime_task_insert" ',
                    'option'        => '',
                    'selected'      => ''
                )
            ),

            $this->ui->load_template('form_group_dropdown',
                array(
                    'label'         => $this->lang->line('overtime_oncall'),
                    'name'          => 'overtime_oncall',
                    'ext'           => 'class="form-control" id="overtime_oncall_insert" ',
                    'option'        => array('0' => 'Tidak','1' => 'Ya'),
                    'selected'      => '',
                )
            ),

            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('overtime_start'),
                    'id'            => 'overtime_start_insert',
                    'name'          => 'overtime_start',
                    'class'         => 'cos form-control datetime_picker',
                    'maxlength'     => '200',
                    'value'         => ''
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('overtime_finish'),
                    'id'            => 'overtime_finish_insert',
                    'name'          => 'overtime_finish',
                    'class'         => 'cos form-control datetime_picker',
                    'maxlength'     => '200',
                    'value'         => ''
                )
            ),

            $this->ui->load_template('form_group_textarea',
                array(
                    'label'         => $this->lang->line('overtime_note'),
                    'id'            => 'overtime_note_insert',
                    'name'          => 'overtime_note',
                    'class'         => 'cos form-control',
                )
            ),
        );
    echo $this->ui->load_template('modal_default_form_one_column', $arr, TRUE);
?>
