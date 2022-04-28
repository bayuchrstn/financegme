<?php
	// pre($arr_filter['my_data']);
	// pre($modul);
	$modul_code = $modul['code'];
	$data['arr_filter'] = $arr_filter;
	$options['component'] = 'component/panel/panel_table';
	$options['panel_icon'] = $this->theme->icon($req_code);
	$options['panel_title'] = $modul['name'];
	$options['panel_sub_title'] = $this->$modul_code->sub_title($filter, $modul['url']);
	$options['panel_action'] = $set_ui['main_action'];
	$options['table_id'] = 'js_table_'.$modul['code'];
	$options['panel_heading_ext'] = '';
	$options['table_column'] = $set_ui['table_column'];
	echo $this->ui->load_component($options);

	echo (isset($insert_view)) ? $insert_view : '';
    echo (isset($update_view)) ? $update_view : '';
    echo (isset($delete_view)) ? $delete_view : '';
    echo (isset($search_view)) ? $search_view : '';
	echo (isset($index_ext_view)) ? $index_ext_view : '';
	echo (isset($modal_view)) ? $modal_view : '';
	echo (isset($global_modal_view)) ? $global_modal_view : '';
?>
