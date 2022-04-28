<?php
    $arr = array();
    /*
    $arr['table_id'] = 'js_table_icon';
    $arr['data_url'] = base_url().'maps/data/';
    $arr['refresh'] = '30000';
    $arr['search_form_id'] = 'search_form';
    $arr['per_page']= '10';
    $column = array(
            array('bSortable' => false),
            array('bSortable' => true),
            array('bSortable' => false),
            array('bSortable' => false),
            array('bSortable' => false),
        );
    $arr['aocolumns']= json_encode($column);

    $arr['sorting'] = array(
        'column'        => '1',
        'sorting_mode'  => 'asc'
    );
    echo $this->ui->load_template('js_datatables',$arr);
    */
    $maps_type = $this->maps->get_maps_type_icon();
    $arrtab = array();
    $arrtab['datatables'] = array();
    
    if (!empty($maps_type)) {
        foreach ($maps_type as $tab) {
            $maps_type_code = '_'.$tab['maps_type_code'];

            $column_detail = array(
                array('bSortable' => false),
                array('bSortable' => true),
                array('bSortable' => false),
                // array('bSortable' => false),
                array('bSortable' => false),
            );

            $arrtab['datatables'][] = array(
                'table_id'      => 'js_table'.$maps_type_code,
                'data_url'      => base_url().'maps/data'.'/'.$tab['maps_type_code'],
                'refresh'       => '30000',
                'search_form_id'    => 'search_form'.$maps_type_code,
                'per_page'      => '10',
                'aocolumns'     => json_encode($column_detail),
                'sorting'       => array(
                    'column'        => '1',
                    'sorting_mode'  => 'asc'
                ),
                );
        }
    }

    echo $this->ui->load_template('js_multiple_datatables',$arrtab);
?>
