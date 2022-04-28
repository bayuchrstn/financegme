<?php
    //main update
    $data = array();
    $options['component'] = 'component/modal/modal_form';
    $options['modal_id'] = 'modal_customer_update';
    $options['modal_size'] = 'modal-lg';
    $options['modal_icon'] = $this->theme->icon('customer');
    $options['modal_title'] = 'Update Pre Customer';
    $options['modal_footer'] = 'yes';
    $options['form_id'] = 'modal_customer_update_form';
    $options['form_action'] = '';
    $options['main_content'] = '<div id="modal_customer_update_div"></div>';
    echo $this->ui->load_component($options);
    //
    // //show this
    // $data = array();
    // $options['component'] = 'component/modal/modal_default';
    // $options['modal_id'] = 'modal_show_this';
    // $options['modal_size'] = 'modal-lg';
    // $options['modal_icon'] = $this->theme->icon('customer');
    // $options['modal_title'] = 'Detail Pre Customer';
    // $options['modal_footer'] = 'no';
    // $options['main_content'] = $this->load->view('pre_customer/tab_show', $data, TRUE);
    // echo $this->ui->load_component($options);
    //
    $data = array();
    $options['component'] = 'component/modal/modal_form';
    $options['modal_id'] = 'modal_map';
    $options['modal_size'] = 'modal-form';
    $options['modal_icon'] = 'icon-location3';
    $options['modal_title'] = 'Lokasi';
    $options['form_id'] = 'modal_map_form';
    $options['form_action'] = '';
    $options['main_content'] = $this->load->view('pre_customer/maps', $data, TRUE);
    echo $this->ui->load_component($options);

    $data = array();
    $options['component'] = 'component/modal/modal_form';
    $options['modal_id'] = 'modal_isp';
    $options['modal_size'] = 'modal-form';
    $options['modal_icon'] = 'icon-location3';
    $options['modal_title'] = 'ISP';
    $options['form_id'] = 'modal_isp_form';
    $options['form_action'] = base_url('pre_customer/isp/insert');
    $options['main_content'] = '<div id="modal_isp_div"></div>';
    echo $this->ui->load_component($options);

    $options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_mp';
	$options['modal_size'] = 'modal-standasrt';
	$options['modal_icon'] = $this->theme->icon('pre_customer');
	$options['modal_title'] = 'Input Marketing Progress';
	$options['form_id'] = 'modal_mp_form';
	$options['form_action'] = base_url().'request/insert';
	$options['main_content'] = '<div id="modal_mp_div"></div>';
	echo $this->ui->load_component($options);

    //show this
    $data = array();
    $options['component'] = 'component/modal/modal_default';
    $options['modal_id'] = 'modal_customer_timeline';
    $options['modal_size'] = 'modal-lg';
    $options['modal_icon'] = $this->theme->icon('customer');
    $options['modal_title'] = 'Detail Timeline';
    $options['modal_footer'] = 'no';
    $options['main_content'] = '<div id="detail_customer_timeline"></div>';
    echo $this->ui->load_component($options);

    //detail_task
    $data = array();
    $options['component'] = 'component/modal/modal_tab';
    $options['modal_id'] = 'modal_task_detail';
    $options['modal_size'] = 'modal-lg';
    $options['modal_icon'] = $this->theme->icon('customer');
    $options['modal_title'] = 'Detail Timeline';
    $options['modal_footer'] = 'no';
    $options['tabs'] = array();
    $options['max'] = '8';
    // $options['main_content'] = '<div id="detail_task_detail"></div>';
    $options['selected_tab'] = 'show_detail_task';
    $options['tabs'][] = array(
        'label'         => 'Marketing Progress',
        'id'            => 'show_detail_task',
        'content'       => '<div id="detail_task_detail"></div>',
    );
    $options['tabs'][] = array(
        'label'         => 'Komentar',
        'id'            => 'show_komentar',
        'content'       => '<div id="show_komentar_div"></div>',
    );
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
