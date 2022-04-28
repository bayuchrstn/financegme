<?php
    $arr = array();
    // $arr['component'] = 'component/panel/panel_table';
    // $arr['panel_icon'] = $this->theme->icon('overtime');
    // $arr['panel_title'] = $this->lang->line('overtime_alltitle');
    // $arr['table_id'] = 'js_table_overtime';
    $arr['panel_action'] = array(
            '<a onclick="insert_overtime();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('overtime_insert').'</a>',
            '<a onclick="reload_table(\'js_table_bts\');" href="javascript:void(0)"><i class="icon-reload-alt"></i> '.$this->lang->line('all_refresh').'</a>',
        );
    // $arr['table_column'] = array(
    //         array('label'   => '#', 'width'=>'5'),
    //         array('label'   => $this->lang->line('user_name')),
    //         array('label'   => $this->lang->line('overtime_start')),
    //         array('label'   => $this->lang->line('overtime_finish')),
    //         array('label'   => $this->lang->line('overtime_status')),
    //         array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
    //     );
    // echo $this->ui->load_template('datatable',$arr);
    $arr['component'] = 'component/panel/panel_table_tab';
    $arr['max'] = '8';
    $arr['panel_id'] = 'panel_overtime';
    $arr['tab_id'] = 'tab_overtime';
    $arr['tab_padding'] = 'no';
    $arr['panel_icon'] = $this->theme->icon('overtime');
    $arr['panel_title'] = $this->lang->line('overtime_alltitle');
    $arr['panel_heading_ext'] = '';
    $arr['selected_tab'] = $tabs['selected']['code'];
    $arr['panel_action'] = array(
            '<a onclick="insert_overtime();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('overtime_insert').'</a>',
            // '<a onclick="reload_table(\'js_table_bts\');" href="javascript:void(0)"><i class="icon-reload-alt"></i> '.$this->lang->line('all_refresh').'</a>',
        );
    $arr['tabs'] = array();
    if(!empty($tabs)):
        foreach($tabs as $tab):
            $arr['tabs'][] = array(
                'label'         => $tab['name'],
                'id'            => $tab['code'],
                'table_columns' => $tab['table_columns']
            );
        endforeach;
    endif;
    echo $this->ui->load_component($arr);
?>

<?php
    echo $insert_view;
    echo $update_view;
    echo $delete_view;
    echo $approve_view;
    echo $detail_view;
?>
