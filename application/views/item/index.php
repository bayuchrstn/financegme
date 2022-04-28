<?php
    $arr = array();
    $arr['component'] = 'component/panel/panel_table';
    $arr['panel_icon'] = $this->theme->icon('item');
    $arr['panel_title'] = $this->lang->line('item_alltitle');
    $arr['table_id'] = 'js_table_item';
    $arr['panel_action'] = array(
            '<a onclick="insert_item();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('item_insert').'</a>',
            // '<a onclick="reload_table(\'js_table_item\');" href="javascript:void(0)"><i class="icon-reload-alt"></i> '.$this->lang->line('all_refresh').'</a>',
        );
    $arr['table_column'] = array(
            array('label'   => '#', 'width'=>'5'),
            array('label'   => $this->lang->line('item_name')),
            array('label'   => $this->lang->line('item_category')),
            array('label'   => $this->lang->line('item_brand')),
            array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
        );
    // echo $this->ui->load_template('datatable',$arr);
    // echo $this->ui->load_template('datatable',$arr);
    echo $this->ui->load_component($arr);
?>

<?php
    echo $insert_view;
    echo $update_view;
    echo $delete_view;
?>
