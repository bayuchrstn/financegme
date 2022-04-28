<?php

    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('task');
    $arr['modal_id'] = 'modal_task_update';
    $arr['form_id'] = 'form_task_update';
    $arr['form_action'] = '';
    $arr['form_input_top'] = '<div id="alert_modal_update"></div>';
    $arr['modal_title'] = '$modal_title';
    $arr['form_input'] = array(
        $this->ui->load_template('form_group_text',
            array(
                'label'         => '$form_name',
                'id'            => 'name_update',
                'name'          => 'name',
                'class'         => 'cos form-control',
                'maxlength'     => '200',
            )
        ),
        $this->ui->load_template('form_group_text',
            array(
                'label'         => '$form_code',
                'id'            => 'code_update',
                'name'          => 'code',
                'class'         => 'cos form-control',
                'maxlength'     => '200',
            )
        ),
        $this->ui->load_template('form_group_dropdown',
            array(
                'label'         => 'Timezone',
                'name'          => 'timezone',
                'ext'           => 'class="form-control" id="timezone_update"',
                'option'        => $this->master->arr('timezone'),
            )
        ),
        $this->ui->load_template('hidden',
            array(
                'id'            => 'id_update',
                'name'          => 'id',
                'value'         => '',
            )
        )
    );
    echo $this->ui->load_template('modal_default_form_one_column', $arr, TRUE);
?>
