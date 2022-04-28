<?php
    $arr = array();
    $arr['table_id'] = 'js_table_bts';
    $arr['data_url'] = base_url().'bts/data/';
    $arr['refresh'] = '30000';
    $arr['search_form_id'] = 'search_form';
    $arr['per_page']= '10';
    $column = array(
            array('bSortable' => false),
            array('bSortable' => true),
            array('bSortable' => true),
            array('bSortable' => false),
            array('bSortable' => false),
        );
    $arr['aocolumns']= json_encode($column);

    $arr['sorting'] = array(
        'column'        => '1',
        'sorting_mode'  => 'asc'
    );
    echo $this->ui->load_template('js_datatables',$arr);
?>
