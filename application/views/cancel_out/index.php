<?php
	// pre($arr_filter['my_data']);
	// pre($modul);
	$modul_code = $modul['code'];
	$data['arr_filter'] = $arr_filter;
	$options['component'] = 'component/panel/panel_table';
	$options['panel_icon'] = $this->theme->icon($req_code);
	$options['panel_title'] = $modul['name'];
	$options['panel_sub_title'] = '';
	$options['panel_action'] = $set_ui['main_action'];
	$options['table_id'] = 'js_table_'.$modul['code'];
	$options['panel_heading_ext'] = '';
	$options['table_column'] = $set_ui['table_column'];
	echo $this->ui->load_component($options);

	echo (isset($modal_view)) ? $modal_view : '';
?>
