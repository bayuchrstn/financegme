<?php
	// pre($req_code);
    $options = array();
	$data['arr_filter'] = $arr_filter;
	$options['component'] = 'component/panel/panel_table_tab';
	$options['max'] = '8';
	$options['panel_id'] = 'panel_task';
	$options['tab_id'] = 'tab_task';
	$options['tab_padding'] = 'no';
	$options['panel_icon'] = $this->theme->icon($req_code);
	$options['panel_title'] = $modul['name'];
	$options['panel_heading_ext'] = $this->load->view('request/'.$modul['code'].'/panel_heading_ext', '', TRUE);
	$options['selected_tab'] = $tabs['selected']['code'];
	$options['panel_action'] = $set_ui['main_action'];
	$options['tabs'] = array();
	if(!empty($tabs)):
        foreach($tabs as $tab):
            $options['tabs'][] = array(
                'label'         => $tab['name'],
                'id'            => $tab['code'],
                'table_columns' => $tab['table_columns']
            );
        endforeach;
    endif;
	echo $this->ui->load_component($options);

	echo (isset($modal_view)) ? $modal_view : '';
?>
