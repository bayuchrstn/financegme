<?php
    //main update
    $data = array();
    $options['component'] = 'component/modal/modal_form';
    $options['modal_id'] = 'modal_comment';
    $options['modal_size'] = 'modal-default';
    $options['modal_icon'] = 'icon-comments';
    $options['modal_title'] = 'Komentar';
    $options['modal_footer'] = 'yes';
    $options['form_id'] = 'modal_comment_form';
    $options['form_action'] = '';
    $options['main_content'] = '<div id="modal_comment_div"></div>';
    echo $this->ui->load_component($options);


?>
