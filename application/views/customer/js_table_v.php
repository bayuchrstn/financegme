<?php

	if($this->uri->segment(2)=='rv'):
		$data_url = base_url().'customer/datarv/'.$customer_group_detail['id'];
	else:
		$data_url = base_url().'customer/datav/'.$customer_group_detail['id'];
	endif;

    $arr = array();
    $arr['table_id'] = 'js_table_service_id';
    $arr['data_url'] = $data_url;
    $arr['refresh'] = '0';
    $arr['search_form_id'] = 'search_form';

    $column = array(
            array('bSortable' => false),
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
