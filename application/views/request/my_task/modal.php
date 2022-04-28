<?php

    $options['component'] = 'component/modal/modal_default';
    $options['modal_id'] = 'modal_laporan_pekerjaan';
    $options['modal_size'] = 'modal-lg';
    $options['modal_icon'] = $modul['code'];
    $options['modal_title'] = 'Laporan Pekerjaan';
    $options['main_content'] = '<div id="modal_laporan_pekerjaan_div"></div>';
    $options['modal_footer'] = 'no';
    echo $this->ui->load_component($options);
    $data = array();
    echo $this->load->view('task_item/modal', $data, TRUE);

    //modal boq input
    $options['component'] = 'component/modal/modal_form';
    $options['modal_id'] = 'modal_boq';
    $options['modal_size'] = 'modal-default';
    $options['modal_icon'] = $this->theme->icon($modul['code']);
    $options['modal_title'] = 'Tambah Item';
    $options['form_id'] = 'modal_boq_form';
    $options['form_action'] = base_url().'ajax_request/create_cart_boq';
    $options['main_content'] = $this->load->view('request/boq/cart/form_grid_add_item', '', TRUE);
    echo $this->ui->load_component($options);

    //modal cart update
    $options['component'] = 'component/modal/modal_form';
    $options['modal_id'] = 'modal_cart_update';
    $options['modal_size'] = 'modal-default';
    $options['modal_icon'] = $this->theme->icon($modul['code']);
    $options['modal_title'] = 'Update Item';
    $options['form_id'] = 'modal_cart_update_form';
    $options['form_action'] = base_url().'ajax_request/save_cart';
    $options['main_content'] = '<div id="modal_cart_update_div"></div>';
    echo $this->ui->load_component($options);

    $options['component'] = 'component/modal/modal_tab';
    $options['modal_id'] = 'modal_tab_detail_pekerjaan';
    $options['modal_size'] = 'modal-lg';
    $options['modal_icon'] = $this->theme->icon($modul['code']);
    $options['modal_title'] = 'Detail Pekerjaan';
    $options['tabs'] = array();
    $options['max'] = '8';
    $options['selected_tab'] = 'show_detail_pekerjaan';
    $options['tabs'][] = array(
    		'label'         => 'Detail Pekerjaan',
    		'id'            => 'show_detail_pekerjaan',
    		'content'       => '<div id="show_detail_pekerjaan_div"></div>',
    	);
    $options['tabs'][] = array(
    		'label'         => 'laporan Hasil Pekerjaan',
    		'id'            => 'show_laporan_hasil_pekerjaan',
    		'content'       => '<div id="show_laporan_hasil_pekerjaan_div"></div>',
    	);
    $options['tabs'][] = array(
        'label'         => 'Komentar',
        'id'            => 'show_laporan_komentar',
        'content'       => '<div id="show_laporan_komentar_div"></div>',
    );

    echo $this->ui->load_component($options);
    $options_detail['component'] = 'component/modal/modal_tab';
    $options_detail['modal_id'] = 'modal_tab_detail_pekerjaan';
    $options_detail['modal_size'] = 'modal-lg';
    $options_detail['modal_icon'] = $this->theme->icon($modul['code']);
    $options_detail['modal_title'] = 'Detail Pekerjaan';
    $options_detail['tabs'] = array();
    $options_detail['max'] = '8';
    $options_detail['selected_tab'] = 'show_detail_pekerjaan';
    $options_detail['tabs'][] = array(
            'label'         => 'Detail Pekerjaan',
            'id'            => 'show_detail_pekerjaan',
            'content'       => '<div id="show_detail_pekerjaan_div"></div>',
        );
    $options_detail['tabs'][] = array(
            'label'         => 'laporan Hasil Pekerjaan',
            'id'            => 'show_laporan_hasil_pekerjaan',
            'content'       => '<div id="show_laporan_hasil_pekerjaan_div"></div>',
        );


    echo $this->ui->load_component($options_detail);

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
