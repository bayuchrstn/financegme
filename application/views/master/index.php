<?php
    $options['component'] = 'component/panel/panel_table';
	$options['panel_icon'] = $this->theme->icon($category);
	$options['panel_title'] = $master_name;
	$options['panel_action'] = array(
            '<a onclick="input_master();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('all_input').' '.$master_name.'</a>',
        );
	$options['table_id'] = 'js_table_master';

	switch ($category) {
		case 'trial_questions':
		case 'ticket_questions':
			$options['table_column'] = array(
				array('label'   => "#", 'width'=>'10'),
				array('label'   => $master_name),
				array('label'   => 'Note'),
				array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
	        );
			break;
		
		default:
			$options['table_column'] = array(
				array('label'   => "#", 'width'=>'10'),
				array('label'   => $master_name),
				array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
	        );
			break;
	}

	echo $this->ui->load_component($options);

    echo $view_insert;
    echo $view_update;
    echo $view_delete;
?>
