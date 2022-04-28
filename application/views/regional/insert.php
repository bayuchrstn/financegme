<?php
    // pre($detail_regional);
    $modal_title = ($regional=='' || $regional=='0') ? $this->lang->line('regional_insert') : $this->lang->line('area_insert');
    $form_name = ($regional=='' || $regional=='0') ? $this->lang->line('regional_name') : $this->lang->line('area_name');
    $form_code = ($regional=='' || $regional=='0') ? $this->lang->line('regional_code') : $this->lang->line('area_code');

    if($regional=='' || $regional=='0'):
        $info_regional = '';
        $up = $this->ui->load_template('hidden',
            array(
                'id'            => 'up_insert',
                'name'          => 'up',
                'value'         => '0',
            )
        );
    else:
        $info_regional = $this->ui->load_template('form_group_text_readonly',
            array(
                'label'         => $this->lang->line('regional_name'),
                'id'            => 'regional_info_insert',
                'name'          => 'regional_info',
                'class'         => 'form-control',
                'maxlength'     => '200',
                'value'         => $detail_regional['name'],
            )
        );
        $up = $this->ui->load_template('hidden',
            array(
                'id'            => 'up_insert',
                'name'          => 'up',
                'value'         => $detail_regional['id'],
            )
        );
    endif;

    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('regional');
    $arr['modal_id'] = 'modal_regional_insert';
    $arr['form_id'] = 'form_regional_insert';
    $arr['form_action'] = base_url().'regional/insert';
    $arr['modal_title'] = $modal_title;
    $arr['form_input_top'] = '<div id="alert_modal_insert"></div>';
    $arr['form_input'] = array(
        $info_regional,
        $this->ui->load_template('form_group_text',
            array(
                'label'         => $form_name,
                'id'            => 'name_insert',
                'name'          => 'name',
                'class'         => 'cos form-control',
                'maxlength'     => '200',
            )
        ),
        $this->ui->load_template('form_group_text',
            array(
                'label'         => $form_code,
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
        $up
    );
    echo $this->ui->load_template('modal_default_form_one_column', $arr, TRUE);
?>
