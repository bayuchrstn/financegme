<?php
    $arr = array();
    $arr['main_icon'] = $this->theme->icon('customer');
    $arr['main_title'] = $customer_group_detail['customer_name'].'  -  '.$customer_group_detail['customer_id'];
    $arr['table_id'] = 'js_table_service_id';
    $arr['table_action'] = array();
    $arr['table_th'] = array(
            array('label'   => "#", 'width'=>'10'),
            array('label'   => 'Nama'),
            array('label'   => 'Alamat'),
            array('label'   => 'Service ID'),
            array('label'   => 'Produk'),
            array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
        );
    echo $this->ui->load_template('datatable',$arr);
?>

<?php
    echo $insert_view;
    echo $update_view;
    // echo $product_view;
    echo $delete_view;
    echo $show_view;
?>
