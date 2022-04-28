<?php
    $reg_name = ($regional=='' || $regional=='0') ? $this->lang->line('regional_alltitle') : $this->lang->line('sub_regional_alltitle');
    $input_name = ($regional=='' || $regional=='0') ? $this->lang->line('regional_insert') : $this->lang->line('area_insert');
    $arr = array();
    $arr['main_icon'] = $this->theme->icon('regional');
    $arr['main_title'] = $reg_name;
    $arr['table_id'] = 'js_table_regional';
    $arr['table_action'] = array(
            '<a onclick="insert_regional();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$input_name.'</a>',
            '<a onclick="reload_table(\'js_table_regional\');" href="javascript:void(0)"><i class="icon-reload-alt"></i> '.$this->lang->line('all_refresh').'</a>',
        );
    $arr['table_th'] = array(
            array('label'   => '#', 'width'=>'5'),
            array('label'   => $reg_name),
            array('label'   => $this->lang->line('regional_code')),
            array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
        );
    echo $this->ui->load_template('datatable',$arr);
?>

<?php
    echo $insert_view;
    echo $update_view;
    echo $delete_view;
?>
