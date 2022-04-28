<?php
    // $default_category = $this->item->arr_category();
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('item');
    $arr['modal_id'] = 'modal_item_update';
    $arr['form_id'] = 'form_item_update';
    $arr['form_action'] = '';
    $arr['form_input_top'] = '<div id="alert_modal_update"></div>';
    $arr['modal_title'] = $this->lang->line('item_update');
    $arr['form_input'] = array(
            $this->ui->load_template('form_group_dropdown',
                array(
                    'label'         => $this->lang->line('item_brand'),
                    'name'          => 'item_brand',
                    'ext'           => 'class="form-control" id="item_brand" ',
                    'option'        => $select_brand,
                    'selected'      => ''
                )
            ),
            $this->ui->load_template('form_group_dropdown',
                array(
                    'label'         => $this->lang->line('item_category'),
                    'name'          => 'item_category',
                    'ext'           => 'class="form-control" id="item_category" ',
                    'option'        => '',
                    'selected'      => ''
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('item_name'),
                    'id'            => 'item_name',
                    'name'          => 'item_name',
                    'class'         => 'cos form-control',
                    'maxlength'     => '200',
                )
            ),
            $this->ui->load_template('form_group_text_readonly',
                array(
                    'label'         => $this->lang->line('item_code'),
                    'id'            => 'item_code',
                    'name'          => 'item_code',
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
