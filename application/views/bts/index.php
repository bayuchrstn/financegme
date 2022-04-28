<?php
    // $arr = array();
    // $arr['main_icon'] = $this->theme->icon('bts');
    // $arr['main_title'] = $this->lang->line('bts_alltitle');
    // $arr['table_id'] = 'js_table_bts';
    // $arr['table_action'] = array(
    //         '<a onclick="insert_bts();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('bts_insert').'</a>',
    //         '<a onclick="reload_table(\'js_table_bts\');" href="javascript:void(0)"><i class="icon-reload-alt"></i> '.$this->lang->line('all_refresh').'</a>',
    //     );
    // $arr['table_th'] = array(
    //         array('label'   => '#', 'width'=>'5'),
    //         array('label'   => $this->lang->line('bts_name')),
    //         array('label'   => $this->lang->line('bts_address')),
    //         array('label'   => $this->lang->line('bts_note')),
    //         array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
    //     );
    // echo $this->ui->load_template('datatable',$arr);
	$options['component'] = 'component/panel/panel_table';
	$options['panel_icon'] = $this->theme->icon('bts');
	$options['panel_title'] = $this->lang->line('bts_alltitle');
	$options['panel_action'] = array(
            '<a onclick="insert_bts();" href="javascript:void(0)"><i class="icon-plus3"></i> Input BTS</a>',
        );
	$options['table_id'] = 'js_table_bts';
	$options['table_column'] = array(
			array('label'   => '#', 'width'=>'5'),
	        array('label'   => $this->lang->line('bts_name')),
	        array('label'   => $this->lang->line('bts_address')),
	        array('label'   => $this->lang->line('bts_note')),
	        array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
        );
	echo $this->ui->load_component($options);
?>

<?php
    echo $insert_view;
    echo $update_view;
    echo $delete_view;
?>
