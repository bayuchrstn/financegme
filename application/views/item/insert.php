<?php
    $default_brand = $this->item->get_category_brand();
    $default_category = $this->item->arr_category($default_brand[0]['id']);
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('item');
    $arr['modal_id'] = 'modal_item_insert';
    $arr['form_id'] = 'form_item_insert';
    $arr['form_action'] = base_url().'item/insert';
    $arr['modal_title'] = $this->lang->line('item_insert');
    $arr['form_input_top'] = '<div id="alert_modal_insert"></div>';
    $arr['form_input'] = array(
            $this->ui->load_template('form_group_dropdown',
                array(
                    'label'         => $this->lang->line('item_brand'),
                    'name'          => 'item_brand',
                    'ext'           => 'class="form-control" id="item_brand" ',
                    'option'        => $select_brand,
                )
            ),
            $this->ui->load_template('form_group_dropdown',
                array(
                    'label'         => $this->lang->line('item_category'),
                    'name'          => 'item_category',
                    'ext'           => 'class="form-control" id="item_category" ',
                    'option'        => $default_category,
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('item_name'),
                    'id'            => 'item_name_insert',
                    'name'          => 'item_name',
                    'class'         => 'cos form-control',
                    'maxlength'     => '200',
                    'value'         => ''
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('item_code'),
                    'id'            => 'item_code_insert',
                    'name'          => 'item_code',
                    'class'         => 'cos form-control',
                    'maxlength'     => '200',
                )
            ),
        );
    echo $this->ui->load_template('modal_default_form_one_column', $arr, TRUE);
?>
