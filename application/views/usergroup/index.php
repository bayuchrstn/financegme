<?php
	// pre($ui);

	$data = array();

	$options['component'] = 'component/panel/panel_table';
	$options['panel_icon'] = $this->theme->icon('usergroup');
	$options['panel_title'] = $ui['main_title'];

	$options['table_id'] = 'js_table_usergroup';

	switch ($category) {
		case 'divisi':
			$options['panel_heading_ext'] = '';
			$options['panel_action'] = array(
		            '<a onclick="input_usergroup(\'divisi\');" href="javascript:void(0)"><i class="icon-plus3"></i> '.$ui['button_input'].'</a>',
		        );
		break;

		case 'department':
			$options['panel_heading_ext'] = $this->load->view('usergroup/picker/department', $data, TRUE);
			$options['panel_action'] = array(
		            '<a onclick="input_usergroup(\'department\');" href="javascript:void(0)"><i class="icon-plus3"></i> '.$ui['button_input'].'</a>',
		        );
		break;

		case 'sub_department':
			$options['panel_heading_ext'] = $this->load->view('usergroup/picker/sub_department', $data, TRUE);
			$options['panel_action'] = array(
		            '<a onclick="input_usergroup(\'sub_department\');" href="javascript:void(0)"><i class="icon-plus3"></i> '.$ui['button_input'].'</a>',
		        );
		break;

		case 'jabatan':
			$options['panel_heading_ext'] = '';
			$options['panel_action'] = array(
		            '<a onclick="input_jabatan_main();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$ui['button_input'].'</a>',
		        );
		break;

		default:
			$options['panel_heading_ext'] = '';
			$options['panel_action'] = array();
		break;
	}

	$options['table_column'] = array(
	        array('label'   => '#', 'width'=>'5'),
	        array('label'   => $ui['th_group_name']),
	        array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
        );
	echo $this->ui->load_component($options);
?>

<?php echo $privileges_view; ?>
<?php echo $modal_view; ?>
