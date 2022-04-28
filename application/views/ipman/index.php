<?php
	$options['component'] = 'component/panel/panel_table';
	$options['panel_icon'] = $this->theme->icon('ipman');
	$options['panel_title'] = $this->lang->line('ipman_alltitle');
	$options['panel_action'] = array(
            '<a onclick="insert_ipman();" href="javascript:void(0)"><i class="icon-plus3"></i> Input IP</a>',
        );
	$options['table_id'] = 'js_table_ipman';
	$options['table_column'] = array(
			array('label'   => '#', 'width'=>'5'),
	        array('label'   => $this->lang->line('ipman_ip')),
	        array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
        );
	echo $this->ui->load_component($options);
?>

<?php
    echo $insert_view;
    // echo $update_view;
    // echo $delete_view;
    echo $detail_view;
?>
