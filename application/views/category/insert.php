<?php
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('category');
    $arr['modal_id'] = 'modal_category_insert';
    $arr['form_id'] = 'form_category_insert';
    $arr['form_action'] = base_url().'category/insert';
    $arr['modal_title'] = $this->lang->line('category_insert');
    $arr['form_input_top'] = '<div id="alert_modal_insert"></div>';
    $arr['form_input'] = array(
            $this->ui->load_template('form_group_dropdown',
                array(
                    'label'         => $this->lang->line('category_brand'),
                    'name'          => 'category_brand',
                    'ext'           => 'class="form-control" id="category_brand" ',
                    'option'        => $select_brand,
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('category_name'),
                    'id'            => 'category_name_insert',
                    'name'          => 'category_name',
                    'class'         => 'cos form-control',
                    'maxlength'     => '200',
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('category_code'),
                    'id'            => 'category_code_insert',
                    'name'          => 'category_code',
                    'class'         => 'cos form-control',
                    'maxlength'     => '200',
                )
            ),
        );
    echo $this->ui->load_template('modal_default_form_one_column', $arr, TRUE);
?>
