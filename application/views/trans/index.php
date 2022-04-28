<?php
	// pre($arr_filter['my_data']);
	// pre($modul);

	$kolom = array();
	$kolom[] = array('label' => '#', 'width' => '5');
	$kolom[] = array('label' => 'Nomor');
	$kolom[] = array('label' => 'Date');
	if($modul['flag_due_date']=='y'):
		$kolom[] = array('label' => 'Due Date');
	endif;
	if($modul['flag_title']=='y'):
		$kolom[] = array('label' => 'Title');
	endif;
	$kolom[] = array('label' => 'Amount');
	$kolom[] = array('label' => 'Action', 'width'=>'80');

	$modul_code = $modul['code'];
	$data['arr_filter'] = $arr_filter;
	// pre($modul_code);
	switch ($modul_code) {
		// case 'pu':
		// break;

		default:
			$insert_url = base_url('trans/insert/'.$modul_code);
		break;
	}

	$options['component'] = 'component/panel/panel_table';
	$options['panel_icon'] = $modul['icon'];
	$options['panel_title'] = $modul['name'];
	$options['panel_sub_title'] = '';

	$options['panel_action'] = array(
			'<a onclick="input(\''.$insert_url.'\');" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('all_input').' </a>',
		);

	$options['table_id'] = 'js_table_'.$modul['code'];
	$options['panel_heading_ext'] = '';
	$options['table_column'] = $kolom;
	echo $this->ui->load_component($options);

	// echo (isset($insert_view)) ? $insert_view : '';
    // echo (isset($update_view)) ? $update_view : '';
    // echo (isset($delete_view)) ? $delete_view : '';
    // echo (isset($search_view)) ? $search_view : '';
	// echo (isset($index_ext_view)) ? $index_ext_view : '';
	echo (isset($modal_view)) ? $modal_view : '';
	// echo (isset($global_modal_view)) ? $global_modal_view : '';
?>
