<?php 
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_insert_trial_report';
    $options['modal_size'] = 'modal-lg';
    $options['modal_icon'] = $this->theme->icon($modul['code']);
    $options['modal_title'] = 'Buat Laporan Trial';
    $options['form_id'] = 'trial_report_insert';
    $options['form_action'] = '';

    // $options['modal_id'] = 'modal_insert_trial_report';
    // $options['modal_size'] = 'modal-full';
    // $options['modal_icon'] = $this->theme->icon($modul['code']);
    // $options['modal_title'] = 'Buat Laporan Trial';
    $options['main_content'] = '<div id="show_trial_report_div"></div>';
    echo $this->ui->load_component($options);


    $modal2['component'] = 'component/modal/modal_default';
    $modal2['modal_id'] = 'modal_view_trial_report';
    $modal2['modal_size'] = 'modal-full';
    $modal2['modal_icon'] = $this->theme->icon($modul['code']);
    $modal2['modal_title'] = 'Detail Laporan Trial';
    $modal2['main_content'] = '<div id="detail_trial_report_div"></div>';
    echo $this->ui->load_component($modal2);
?>