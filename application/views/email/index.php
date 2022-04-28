<?php
    $options = array();
    $options['component'] = 'component/panel/panel_table_tab';
    $options['max'] = '8';
    $options['panel_id'] = 'panel_task';
    $options['tab_id'] = 'tab_task';
    $options['tab_padding'] = 'no';
    $options['panel_icon'] = $modul['icon'];
    $options['panel_title'] = $modul['name'];
    $options['panel_heading_ext'] = '';
    $options['selected_tab'] = $tabs['selected']['code'];
    $options['panel_action'] = array(
            // '<a onclick="input_user();" href="javascript:void(0)"><i class="icon-plus3"></i> Input User</a>',
        );
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
    echo $modal_view;
?>
