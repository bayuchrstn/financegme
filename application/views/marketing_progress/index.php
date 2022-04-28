<?php
	// pre($arr_filter['my_data']);
	$data['arr_filter'] = $arr_filter;
	$options['component'] = 'component/panel/panel_table';
	$options['panel_icon'] = $this->theme->icon($task_info['code']);
	$options['panel_title'] = $task_info['name'];
	$options['panel_sub_title'] = $this->marketing_progress->sub_title();
	$options['panel_action'] = array(
		'<a onclick="insert_marketing_progress();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('all_input').' '.$task_info['name'].'</a>',
		'<a onclick="open_search_modal();" href="javascript:void(0)"><i class="icon-search4"></i> Search</a>',
		'<a onclick="insert_marketing_progress();" href="javascript:void(0)"><i class="icon-chart"></i> Statistik</a>',
        );
	$options['table_id'] = 'js_table_marketing_progress';
	$options['panel_heading_ext'] = '';
	$options['table_column'] = array(
	        array('label'   => '#', 'width'=>'5'),
	        array('label'   => $this->lang->line('marketing_progress_date_start')),
	        array('label'   => $this->lang->line('marketing_progress_author')),
	        array('label'   => $this->lang->line('marketing_progress_subject')),
	        array('label'   => $this->lang->line('marketing_progress_customer_name')),
	        array('label'   => $this->lang->line('marketing_progress_category')),
	        array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
        );
	echo $this->ui->load_component($options);
	echo $insert_view;
    echo $update_view;
    echo $delete_view;
    echo $search_view;
?>
