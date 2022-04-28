<?php

//modal show this
$options['component'] = 'component/modal/modal_default';
$options['modal_id'] = 'modal_show_this';
$options['modal_size'] = 'modal-lg';
$options['modal_icon'] = $this->theme->icon($modul['code']);
$options['modal_title'] = 'Detail Approval Pre Customer';
$options['main_content'] = '<div id="modal_show_this_div"></div>';
echo $this->ui->load_component($options);

?>
