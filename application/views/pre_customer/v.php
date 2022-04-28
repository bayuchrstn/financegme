<?php
    $arr = array();
    $arr['main_icon'] = $this->theme->icon('customer');
    $arr['main_title'] = $customer_group_detail['customer_name'].'  -  '.$customer_group_detail['customer_id'];
    $arr['table_id'] = 'js_table_service_id';
    $arr['table_action'] = array(
            '<a onclick="insert_customer();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('customer_input').'</a>',
            '<a onclick="reload_table(\'js_table_customer\');" href="javascript:void(0)"><i class="icon-reload-alt"></i> '.$this->lang->line('all_refresh').'</a>',
        );
    $arr['table_th'] = array(
            array('label'   => "#", 'width'=>'10'),
            array('label'   => $this->lang->line('customer_name')),
            array('label'   => $this->lang->line('customer_telephone')),
            array('label'   => $this->lang->line('customer_email')),
            array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
        );
    echo $this->ui->load_template('datatable',$arr);
?>

<?php
    echo $insert_view;
    echo $update_view;
    // echo $product_view;
    echo $delete_view;
?>
