<?php
	$data = array();
	$options = array();
	// $options['component'] = 'component/panel/panel_table';
	// $options['panel_icon'] = '';
	// $options['panel_title'] = 'Trace Barang';
	// $options['table_id'] = 'js_table_item_trace';
 //    // $options['panel_content'] = '<div id="content_marketing_fee"><p style="text-align: center;">Loading...</p></div>';
	// $options['panel_action'] = array();
	// $options['panel_heading_ext'] = $this->load->view('item_trace/panel_heading_ext', $data, TRUE);
 //    $options['table_column'] = array(
 //        array('label'   => '#', 'width'=>'5'),
 //        array('label'   => $this->lang->line('item_detail_name') ),
 //        array('label'   => $this->lang->line('item_detail_no_item')),
 //        array('label'   => $this->lang->line('item_detail_mac')),
 //        array('label'	=> $this->lang->line('customer_customer_name')),
 //        array('label'	=> 'Status'),
 //        array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
 //    );
	// echo $this->ui->load_component($options);

	$options['component'] = 'component/panel/panel_table_tab';
	$options['panel_id'] = 'panel_item_trace';
	$options['panel_icon'] = '';
	$options['panel_title'] = 'Trace Barang';
	$options['table_id'] = 'js_table_item_trace';
	$options['tabs'] = $tabs;
	$options['max'] = 8;
	$options['tab_id'] = 'table_item_trace';
	$options['selected_tab'] = 'install';
	$options['tab_padding'] = 'no';
	$options['button_search'] = 'yes';
    // $options['panel_content'] = '<div id="content_marketing_fee"><p style="text-align: center;">Loading...</p></div>';
	$options['panel_action'] = array();
	$options['panel_heading_ext'] = $this->load->view('item_trace/panel_heading_ext', $data, TRUE);
	
	echo $this->ui->load_component($options);

    echo $detail_view;
?>