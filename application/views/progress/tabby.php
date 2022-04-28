<?php
    // pre($detail);
    // $tabs = unserialthis($detail['progress']);
    // $selected = array_keys($tabs)[0];
    // $arrext = array_keys($tabs);
    $arr_label = explode(',', $detail['label']);
    $arr_code = explode(',', $detail['code']);
    $arr_show_url = explode(',', $detail['show_url']);
    $arr_task_id = explode(',', $detail['task_id']);
    // pre($arr_label);
    // pre($arr_code);
    // pre($arr_show_url);
    // pre($arr_task_id);

    $tabs = $arr_task_id;
?>


<?php
    $arr = array();
    $arr['tab_id'] = 'tab1';
    $arr['tab_padding'] = 'no';
    $arr['max'] = '8';
    $arr['selected_tab'] = $arr_code[0].'_'.$arr_task_id[0];
    $arr['tabs'] = array();

    $urut = 0;
    foreach($tabs as $tab):
        // pre($urut);
        $dt = array();
        $dt['div_id'] = $arr_code[$urut].'_'.$arr_task_id[$urut];
        // $dt['tab'] = $tab;
        $arr['tabs'][] = array(
                'label'         => $arr_label[$urut],
                'id'            => $arr_code[$urut].'_'.$arr_task_id[$urut],
                'content'       => $this->load->view('progress/loader', $dt, TRUE),
            );
        $urut++;
    endforeach;
    // pre($arr);
    echo $this->ui->load_template('tab_default', $arr, TRUE);
?>
