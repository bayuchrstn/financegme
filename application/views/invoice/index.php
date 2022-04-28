<?php
	// pre($req_code);
	// pre($tabs);
	// pre($status_invoice);
    $options = array();
	$data['arr_filter'] = $arr_filter;
	$data['status_invoice'] = $status_invoice;
	$options['component'] = 'component/panel/panel_table_tab';
	$options['max'] = '8';
	$options['panel_id'] = 'panel_task';
	$options['tab_id'] = 'tab_task';
	$options['tab_padding'] = 'no';
	$options['panel_icon'] = $this->theme->icon('invoice');
	$options['panel_title'] = $this->invoice->main_title($arr_filter, $status_invoice);
	$options['panel_heading_ext'] = $this->load->view('invoice/panel_heading_ext', $data, TRUE);
	$options['selected_tab'] = $tabs['selected']['code'];
	$options['panel_action'] = $set_ui['main_action'];
	$options['tabs'] = array();
	if(!empty($tabs)):
        foreach($tabs as $tab):
            $options['tabs'][] = array(
                'label'         => $tab['name'],
                'id'            => $tab['code'],
                'table_columns' => $tab['table_columns']
            );
        endforeach;
    endif;
	echo $this->ui->load_component($options);

	echo (isset($modal_view)) ? $modal_view : '';
?>

<input type="hidden" name="js_invoice_filter" id="js_invoice_filter" value="<?php echo $filter; ?>">
