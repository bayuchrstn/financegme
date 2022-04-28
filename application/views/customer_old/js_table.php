<?php
    $arr = array();
    $arr['table_id'] = 'js_table_customer';
    $arr['data_url'] = base_url().'customer/data';
    $arr['refresh'] = '0';
    $arr['search_form_id'] = 'search_form';

    $column = array(
            array('bSortable' => false),
            array('bSortable' => false),
            array('bSortable' => false),
            array('bSortable' => false),
            array('bSortable' => false),
        );
    $arr['aocolumns']= json_encode($column);
    $arr['per_page']= '10';

    $arr['sorting'] = array(
        'column'        => '1',
        'sorting_mode'  => 'asc'
    );
    echo $this->ui->load_template('js_datatables',$arr);
?>
