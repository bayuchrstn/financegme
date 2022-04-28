<?php
    // pre($detail_task);
    // $modal_title = ($task=='' || $task=='0') ? $this->lang->line('task_insert') : $this->lang->line('area_insert');
    // $form_name = ($task=='' || $task=='0') ? $this->lang->line('task_name') : $this->lang->line('area_name');
    // $form_code = ($task=='' || $task=='0') ? $this->lang->line('task_code') : $this->lang->line('area_code');



    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('task');
    $arr['modal_id'] = 'modal_task_insert';
    $arr['form_id'] = 'form_task_insert';
    $arr['form_action'] = base_url().'task/insert';
    $arr['modal_title'] = $modal_title;
    $arr['form_input_top'] = '<div id="alert_modal_insert"></div>';
    $arr['form_input'] = array(
        $this->ui->load_template('form_group_text',
            array(
                'label'         => 'sdvds',
                'id'            => 'name_insert',
                'name'          => 'name',
                'class'         => 'cos form-control',
                'maxlength'     => '200',
            )
        ),
        $this->ui->load_template('form_group_text',
            array(
                'label'         => 'sdv',
                'id'            => 'code_insert',
                'name'          => 'code',
                'class'         => 'cos form-control',
                'maxlength'     => '200',
            )
        ),
        $this->ui->load_template('form_group_dropdown',
            array(
                'label'         => 'Timezone',
                'name'          => 'timezone',
                'ext'           => 'class="form-control" id="timezone_insert"',
                'option'        => $this->master->arr('timezone'),
            )
        ),
    );
    echo $this->ui->load_template('modal_default_form_one_column', $arr, TRUE);
?>
