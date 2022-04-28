<?php
    $status_task = $this->task_teknis->get_panel_tabs();
    $options = array();
	$options['component'] = 'component/panel/panel_table_tab';
	$options['max'] = '8';
	$options['panel_id'] = 'panel_task';
	$options['tab_id'] = 'tab_task';
	$options['tab_padding'] = 'no';
	$options['panel_icon'] = $this->theme->icon('task');
	$options['panel_title'] = $this->lang->line('task_panel_title');
	$options['panel_heading_ext'] = $this->load->view('task/panel_heading_ext', '', TRUE);
	$options['selected_tab'] = 'request';
	$options['panel_action'] = array(
			'<a onclick="input_task();" href="javascript:void(0)"><i class="icon-plus3"></i> Input Task baru</a>',
		);
	$options['tabs'] = array();
	if(!empty($status_task)):
        foreach($status_task as $tab):
            $options['tabs'][] = array(
                'label'         => $tab['name'],
                'id'            => $tab['code'],
                'table_columns' => $tab['table_columns']
            );
        endforeach;
    endif;
	echo $this->ui->load_component($options);
?>
