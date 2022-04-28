<?php
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('category');
    $arr['modal_id'] = 'modal_category_update';
    $arr['form_id'] = 'form_category_update';
    $arr['form_action'] = '';
    $arr['form_input_top'] = '<div id="alert_modal_update"></div>';
    $arr['modal_title'] = $this->lang->line('category_update');
    $arr['form_input'] = array(
            $this->ui->load_template('form_group_dropdown',
                array(
                    'label'         => $this->lang->line('category_brand'),
                    'name'          => 'category_brand',
                    'ext'           => 'class="form-control" id="category_brand" ',
                    'option'        => $select_brand,
                    'selected'      => '',
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('category_name'),
                    'id'            => 'category_name_update',
                    'name'          => 'category_name',
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
