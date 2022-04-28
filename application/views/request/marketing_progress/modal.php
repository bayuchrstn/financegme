<?php
    // $options['component'] = 'component/modal/modal_default';
    // $options['modal_id'] = 'modal_detail_mp';
    // $options['modal_size'] = 'modal-lg';
    // $options['modal_icon'] = $this->theme->icon($modul['code']);
    // $options['modal_title'] = 'Detail Marketing Progress';
    // $options['main_content'] = '<div id="show_detail_mp_div"></div>';
    // echo $this->ui->load_component($options);

    $options['component'] = 'component/modal/modal_tab';
    $options['modal_id'] = 'modal_detail_mp';
    $options['modal_size'] = 'modal-lg';
    $options['modal_icon'] = $this->theme->icon($modul['code']);
    $options['modal_title'] = 'Detail Marketing Progress';
    $options['tabs'] = array();
    $options['max'] = '8';
    $options['selected_tab'] = 'show_detail_mp';
    $options['tabs'][] = array(
        'label'         => 'Marketing Progress',
        'id'            => 'show_detail_mp',
        'content'       => '<div id="show_detail_mp_div"></div>',
    );
    $options['tabs'][] = array(
        'label'         => 'Komentar',
        'id'            => 'show_komentar',
        'content'       => '<div id="show_komentar_div"></div>',
    );
    // $options['main_content'] = '<div id="show_detail_mp_div"></div>';
    echo $this->ui->load_component($options);

    $data = array();
    $options['component'] = 'component/modal/modal_form';
    $options['modal_id'] = 'modal_map';
    $options['modal_size'] = 'modal-form';
    $options['modal_icon'] = 'icon-location3';
    $options['modal_title'] = 'Lokasi';
    $options['form_id'] = 'modal_map_form';
    $options['form_action'] = '';
    $options['main_content'] = $this->load->view('pre_customer/maps', $data, TRUE);
    // $options['main_content'] = 'wkwkwkwkwkkw';
    echo $this->ui->load_component($options);

    $options['component'] = 'component/modal/modal_form';
    $options['modal_id'] = 'modal_add_comment';
    $options['modal_size'] = 'modal-default';
    $options['modal_icon'] = 'icon-comments';
    $options['modal_title'] = 'Tambahkan Komentar';
    $options['form_id'] = 'form_add_comment';
    $options['form_action'] = base_url().'comment/insert_task_comment';
    $options['main_content'] = '<div class="form-group"><label class="control-label">Komentar</label><textarea name="comment" class="form-control" required></textarea><input type="hidden" name="task_id" id="comment_task_id"></div>';
    echo $this->ui->load_component($options);
?>
