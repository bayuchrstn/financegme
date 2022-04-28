<?php
    $product_category = $this->product->get_product_category();
    $arr = array();
    $arr['datatables'] = array();
    if(!empty($product_category)):
        foreach($product_category as $cat):
            $column = array(
                    array('bSortable' => false),
                    array('bSortable' => true),
                    array('bSortable' => true),
                    array('bSortable' => false),
                    array('bSortable' => false),
                    array('bSortable' => false),
                    array('bSortable' => false, 'bVisible' => false),
                );

            $arr['datatables'][] = array(
                'table_id'          => 'js_table_'.$cat['code'],
                'data_url'          => base_url().'product/data/'.$cat['code'],
                'refresh'           => '30000',
                'search_form_id'    => 'search_form_'.$cat['code'],
                'per_page'          => '10',
                'aocolumns'         => json_encode($column),
                'sorting'          => array(
                        'column'        => '6',
                        'sorting_mode'  => 'asc'
                    ),
            );
        endforeach;
    endif;
    // pre($arr);
    echo $this->ui->load_template('js_multiple_datatables',$arr);
?>
