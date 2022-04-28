<?php
    $arr = array();
    $arr['main_icon'] = $this->theme->icon('category');
    $arr['main_title'] = $this->lang->line('category_alltitle');
    $arr['table_id'] = 'js_table_category';
    $arr['table_action'] = array(
            '<a onclick="insert_category();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('category_insert').'</a>',
            // '<a onclick="reload_table(\'js_table_category\');" href="javascript:void(0)"><i class="icon-reload-alt"></i> '.$this->lang->line('all_refresh').'</a>',
        );
    $arr['table_th'] = array(
            array('label'   => '#', 'width'=>'5'),
            array('label'   => $this->lang->line('category_brand_name')),
            array('label'   => $this->lang->line('category_name')),
            array('label'   => $this->lang->line('category_code')),
            array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
        );
    echo $this->ui->load_template('datatable_client',$arr);
?>

<?php
    echo $insert_view;
    echo $update_view;
    echo $delete_view;
?>
