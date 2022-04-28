<?php
    $product_category = $this->product->get_product_category();
    // pre($product_category[0]['code']);
    // pre($selected);
    $arr = array();
    $arr['panel_id'] = 'panel_product';
    $arr['tab_id'] = 'tab1';
    $arr['tab_padding'] = 'no';
    $arr['main_icon'] = $this->theme->icon('product');
    $arr['main_title'] = $this->lang->line('product_alltitle');
    $arr['max'] = '10';
    $arr['selected_tab'] = (!isset($product_category) || $product_category=='') ? $product_category[0]['code'] : $product_category[0]['code'];
    $arr['table_action'] = array(
            '<a onclick="input_product();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('product_insert').'</a>',
            // '<a onclick="reload_multiple_table(\'js_table_master\');" href="javascript:void(0)"><i class="icon-reload-alt"></i> '.$this->lang->line('all_refresh').'</a>',
        );
    $arr['tabs'] = array();
    if(!empty($product_category)):
        foreach($product_category as $tab):
            $arr['tabs'][] = array(
                'label'         => $tab['name'],
                'id'            => $tab['code'],
                'table_columns' => array(
                    array('label'   => '#', 'width'=>'5'),
                    array('label'   => $this->lang->line('product_name')),
                    array('label'   => $this->lang->line('product_note')),
                    array('label'   => $this->lang->line('product_price'), 'width'=>'170'),
                    array('label'   => $this->lang->line('product_flag_internet_service'), 'width'=>'160'),
                    array('label'   => 'Action', 'width'=>'50'),
                    array('label'   => 'sort', 'width'=>'160'),
                )
            );
        endforeach;
    endif;
    // pre($arr);
    echo $this->ui->load_template('table_in_tab',$arr);
?>

<?php
    echo $insert_view;
    echo $update_view;
    echo $delete_view;
?>
