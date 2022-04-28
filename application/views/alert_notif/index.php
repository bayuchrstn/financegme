<?php
    $options = array();
	$options['component'] = 'component/panel/panel_table_tab';
	$options['max'] = '8';
	$options['panel_id'] = 'panel_alert_notif';
	$options['tab_id'] = 'tab_alert_notif';
	$options['tab_padding'] = 'no';
	$options['panel_icon'] = 'icon-bell3';
	$options['panel_title'] = 'Daftar Notifikasi';
	$options['panel_heading_ext'] = '';
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
?>
