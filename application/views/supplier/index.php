<?php
    $arr = array();
    $arr['main_icon'] = $this->theme->icon('supplier');
    $arr['main_title'] = $this->lang->line('supplier_alltitle');
    $arr['table_id'] = 'js_table_supplier';
    $arr['table_action'] = array(
            '<a onclick="insert_supplier();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('supplier_insert').'</a>',
            // '<a onclick="reload_table(\'js_table_supplier\');" href="javascript:void(0)"><i class="icon-reload-alt"></i> '.$this->lang->line('all_refresh').'</a>',
        );
    $arr['table_th'] = array(
            array('label'   => '#', 'width'=>'5'),
            array('label'   => $this->lang->line('supplier_name')),
            array('label'   => $this->lang->line('supplier_address')),
            array('label'   => $this->lang->line('supplier_telephone')),
            array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
        );
    echo $this->ui->load_template('datatable_client',$arr);
?>

<?php
    echo $insert_view;
    echo $update_view;
    echo $delete_view;
?>
