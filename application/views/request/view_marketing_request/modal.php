<?php
    $options['component'] = 'component/modal/modal_tab';
    $options['modal_id'] = 'modal_vmr_mrk';
    $options['modal_size'] = 'modal-lg';
    $options['modal_icon'] = $this->theme->icon($modul['code']);
    $options['modal_title'] = 'Detail Marketing Request';
    $options['tabs'] = array();
    $options['max'] = '8';
    $options['selected_tab'] = 'show_vmr_mrk';
    $options['tabs'][] = array(
        'label'         => 'Marketing Request',
        'id'            => 'show_vmr_mrk',
        'content'       => '<div id="modal_vmr_mrk_div"></div>',
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
