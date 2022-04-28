<?php
    $table_id = 'js_table_master';
    $data_url = base_url().'master/data/'.$category;
    $arr = array();
    $arr['table_id'] = 'js_table_master';
    $arr['data_url'] = base_url().'master/data/'.$category;
    $arr['refresh'] = '30000';
    $arr['search_form_id'] = 'search_form';
    $arr['per_page']= '10';
    $arr['sorting'] = array(
        'column'        => '1',
        'sorting_mode'  => 'asc'
    );
    switch ($category) {
        case 'trial_questions':
        case 'ticket_questions':
            $column = array(
                array(
                    'data'  => 'urut',
                    'searchable'    => false,
                    'orderable' => false
                ),
                array(
                    'data'  => 'name',
                    'name'  => 'name',
                    'searchable'    => true,
                    'orderable' => false
                ),
                array(
                    'data'  => 'note',
                    'name'  => 'note',
                    'searchable'    => true,
                    'orderable' => false
                ),
                array(
                    'data'  => 'action',
                    'searchable'    => false,
                    'orderable' => false
                ),
            );
            $arr['aocolumns']= json_encode($column);
            echo $this->ui->load_template('js_datatables_serverside',$arr);
            break;
        
        default:
            $column = array(
                array('bSortable' => false),
                array('bSortable' => true),
                array('bSortable' => false),
            );
            $arr['aocolumns']= json_encode($column);
            echo $this->ui->load_template('js_datatables',$arr);
            break;
    }
?>