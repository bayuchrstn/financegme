<?php
	$options['component'] = 'component/panel/panel_table';
	$options['panel_icon'] = $this->theme->icon('customer');
	$options['panel_title'] = $this->lang->line('pre_customer_alltitle');
	$options['panel_action'] = array(
            '<a onclick="insert_customer();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('customer_input').'</a>',
            // '<a onclick="search_customer();" href="javascript:void(0)"><i class="icon-search4"></i> '.$this->lang->line('all_asearch').'</a>',
        );
	$options['table_id'] = 'js_table_pre_customer';
	$options['table_column'] = array(
		array('label'   => "#", 'width'=>'10'),
		array('label'   => $this->lang->line('customer_customer_name')),
		array('label'   => $this->lang->line('customer_customer_address')),
		array('label'   => $this->lang->line('customer_contact_person')),
		array('label'   => $this->lang->line('customer_telephone_work')),
		array('label'   => $this->lang->line('pre_customer_progress_bar')),
		array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
        );
	echo $this->ui->load_component($options);
	echo $insert_view;
    echo $update_view;
    echo $show_view;
    echo $modal_view;
    // echo $search_view;
?>

<?php
	$data['prefix'] = 'tak_itemss';
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_task_item_insert';
	$options['modal_size'] = 'modal-default';
	$options['modal_icon'] = '';
	$options['modal_title'] = 'Create';
	$options['form_id'] = 'modal_task_item_insert_form';
	$options['form_action'] = base_url().'ajax_request/create_cart_boq';
	$options['main_content'] = '<div id="modal_task_item_insert_div"></div>';
	echo $this->ui->load_component($options);
?>
