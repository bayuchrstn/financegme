<?php
$options['component'] = 'component/modal/modal_default';
$options['modal_id'] = 'modal_detail_mp';
$options['modal_size'] = 'modal-lg';
$options['modal_icon'] = $modul['code'];
$options['modal_title'] = 'Detail Marketing Progress';
$options['main_content'] = '<div id="show_detail_mp_div"></div>';
echo $this->ui->load_component($options);
?>
