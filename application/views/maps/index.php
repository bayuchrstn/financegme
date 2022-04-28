<?php
	/*
	$options['component'] = 'component/panel/panel_table';
	$options['panel_icon'] = $this->theme->icon('maps');
	$options['panel_title'] = $this->lang->line('maps_alltitle');
	$options['panel_action'] = array(
            '<a onclick="insert_maps();" href="javascript:void(0)"><i class="icon-plus3"></i> Tambah maps</a>',
        );
	$options['table_id'] = 'js_table_maps';
	$options['table_column'] = array(
			array('label'   => '#', 'width'=>'5'),
	        array('label'   => $this->lang->line('maps_name')),
	        array('label'   => $this->lang->line('maps_coordinate')),
	        array('label'   => $this->lang->line('maps_type')),
	        array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
        );
	echo $this->ui->load_component($options);
	*/
	$maps_type = $this->maps->get_maps_type_icon();
    $arrtab['main_title'] = $this->lang->line('maps_alltitle');
    $arrtab['table_id'] = 'js_table_maps';
    $arrtab['table_action'] = array(
            '<a onclick="insert_maps();" href="javascript:void(0)"><i class="icon-plus3"></i> Tambah maps</a>',
            '<a onclick="show_maps();" href="javascript:void(0)"><i class="icon-eye"></i> Tampilkan maps</a>',
        );

    $arrtab['panel_id'] = 'panel_item';
    $arrtab['tab_id'] = 'tab1';
    $arrtab['tab_padding'] = 'no';
    $arrtab['max'] = '10';
    $arrtab['selected_tab'] = (!isset($maps_type) || $maps_type=='') ? $maps_type[0]['maps_type_code'] : $maps_type[0]['maps_type_code'];
    
    $arrtab['tabs'] = array();
    if (!empty($maps_type)) {
        foreach ($maps_type as $tab) {

            $arrtab['tabs'][] = array(
                'label'         => $tab['maps_type_name'],
                'id'            => $tab['maps_type_code'],
                'table_columns' => array(
                    array('label'   => '#', 'width'=>'5'),
			        array('label'   => $this->lang->line('maps_name')),
			        array('label'   => $this->lang->line('maps_coordinate')),
			        // array('label'   => $this->lang->line('maps_type')),
			        array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
           			),
            );
        }
    }
    echo $this->ui->load_template('table_in_tab',$arrtab);
?>

<?php
    echo $insert_view;
    echo $update_view;
    echo $delete_view;
    echo $detail_view;
?>
