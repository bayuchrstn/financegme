<?php
    $arr = array();
    // $arr['main_icon'] = $this->theme->icon('item');
    $arr['main_title'] = $this->lang->line('item_alltitle');
    $arr['table_id'] = 'js_table_item';

    if (have_privileges('input_daftar_barang')) :
        $arr['table_action'] = array(
                '<a onclick="insert_item();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('item_insert').'</a>',
                // '<a onclick="reload_table(\'js_table_item\');" href="javascript:void(0)"><i class="icon-reload-alt"></i> '.$this->lang->line('all_refresh').'</a>',
            );
    else:
        $arr['table_action'] = array();
    endif;
     $arr['table_th'] = array(
        array('label'   => '#', 'width'=>'5'),
        array('label'   => $this->lang->line('item_name')),
        array('label'   => $this->lang->line('item_category')),
        array('label'   => $this->lang->line('item_brand')),
        array('label'   => $this->lang->line('item_detail_total_item_available')),
        array('label'   => $this->lang->line('item_detail_total_item')),
        array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
    );

    if ($item=='' || $item=='0') :
        $table['component'] = 'component/panel/panel_table';
        $table['panel_icon'] = $this->theme->icon('item');
        $table['panel_title'] = $arr['main_title'];
        $table['table_id'] = $arr['table_id'];
        $table['panel_action'] = $arr['table_action'];
        $table['table_column'] = $arr['table_th'];
        // echo $this->ui->load_template('datatable',$arr);
        echo $this->ui->load_component($table);

    else :
        $item_status = $this->item_detail->status_item();
        $arrtab['main_title'] = $arr['main_title'].' - '.$this->item->detail($item)['item_name'];
        $arrtab['table_id'] = $arr['table_id'];
        $arrtab['table_action'] = $arr['table_action'];

        $arrtab['panel_id'] = 'panel_item';
        $arrtab['tab_id'] = 'tab1';
        $arrtab['tab_padding'] = 'no';
        $arrtab['max'] = '8';
        $arrtab['selected_tab'] = 'available';
        
        $arrtab['tabs'] = array();
        if (!empty($item_status)) {
            foreach ($item_status as $tab) {

                $arrtab['tabs'][] = array(
                    'label'         => $tab['item_status'],
                    'id'            => $tab['item_status'],
                    'table_columns' => array(
                        array('label'   => '#', 'width'=>'5'),
                        array('label'   => $this->lang->line('item_detail_no_item')),
                        array('label'   => $this->lang->line('item_detail_mac')),
                        array('label'   => $this->lang->line('item_detail_barcode')),
                        array('label'   => $this->lang->line('item_detail_price')),
                        array('label'   => $this->lang->line('item_detail_date_buy')),
                        array('label'   =>  $tab['item_status']=='install' ? 'Lokasi' : $this->lang->line('item_detail_warranty')),
                        array('label'   => $this->lang->line('item_category')),
                        array('label'   => $this->lang->line('item_brand')),
                        array('label'   => $this->lang->line('all_action'), 'width'=>'80')
                        )
                );
            }
        }
        echo $this->ui->load_template('table_in_tab',$arrtab);
    endif;
?>

<?php
    echo $insert_view;
    echo $update_view;
    echo $delete_view;
?>
