<?php
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('brand');
    $arr['modal_id'] = 'modal_brand_update';
    $arr['form_id'] = 'form_brand_update';
    $arr['form_action'] = '';
    $arr['form_input_top'] = '<div id="alert_modal_update"></div>';
    $arr['modal_title'] = $this->lang->line('brand_update');
    $arr['form_input'] = array(
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('brand_name'),
                    'id'            => 'brand_name_update',
                    'name'          => 'brand_name',
                    'class'         => 'cos form-control',
                    'maxlength'     => '200',
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
