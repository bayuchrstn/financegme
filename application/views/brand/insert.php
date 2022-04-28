<?php
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('brand');
    $arr['modal_id'] = 'modal_brand_insert';
    $arr['form_id'] = 'form_brand_insert';
    $arr['form_action'] = base_url().'brand/insert';
    $arr['modal_title'] = $this->lang->line('brand_insert');
    $arr['form_input_top'] = '<div id="alert_modal_insert"></div>';
    $arr['form_input'] = array(
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('brand_name'),
                    'id'            => 'brand_name_insert',
                    'name'          => 'brand_name',
                    'class'         => 'cos form-control',
                    'maxlength'     => '200',
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('brand_code'),
                    'id'            => 'brand_code_insert',
                    'name'          => 'brand_code',
                    'class'         => 'cos form-control',
                    'maxlength'     => '200',
                )
            ),
        );
    echo $this->ui->load_template('modal_default_form_one_column', $arr, TRUE);
?>
