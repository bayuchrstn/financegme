<?php
    // pre($detail_regional);
    $modal_title = ($regional=='' || $regional=='0') ? $this->lang->line('regional_update') : $this->lang->line('area_update');
    $form_name = ($regional=='' || $regional=='0') ? $this->lang->line('regional_name') : $this->lang->line('area_name');
    $form_code = ($regional=='' || $regional=='0') ? $this->lang->line('regional_code') : $this->lang->line('area_code');

    if($regional=='' || $regional=='0'):
        $info_regional = '';
        $up = $this->ui->load_template('hidden',
            array(
                'id'            => 'up_update',
                'name'          => 'up',
                'value'         => '0',
            )
        );
    else:
        $info_regional = $this->ui->load_template('form_group_text_readonly',
            array(
                'label'         => $this->lang->line('regional_name'),
                'id'            => 'regional_info_update',
                'name'          => 'regional_info',
                'class'         => 'form-control',
                'maxlength'     => '200',
                'value'         => $detail_regional['name'],
            )
        );
        $up = $this->ui->load_template('hidden',
            array(
                'id'            => 'up_update',
                'name'          => 'up',
                'value'         => $detail_regional['id'],
            )
        );
    endif;

    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('regional');
    $arr['modal_id'] = 'modal_regional_update';
    $arr['form_id'] = 'form_regional_update';
    $arr['form_action'] = '';
    $arr['form_input_top'] = '<div id="alert_modal_update"></div>';
    $arr['modal_title'] = $modal_title;
    $arr['form_input'] = array(
        $info_regional,
        $this->ui->load_template('form_group_text',
            array(
                'label'         => $form_name,
                'id'            => 'name_update',
                'name'          => 'name',
                'class'         => 'cos form-control',
                'maxlength'     => '200',
            )
        ),
        $this->ui->load_template('form_group_text',
            array(
                'label'         => $form_code,
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
        $up,
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
