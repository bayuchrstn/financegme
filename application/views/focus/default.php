<?php
	$options['component'] = 'component/modal/modal_default';
	$options['modal_id'] = 'modal_focus';
	$options['modal_size'] = 'modal-full';
	$options['modal_icon'] = 'icon-search4';
	$options['modal_title'] = '';
	$options['main_content'] = '<div id="focus_main_content_div">c</div>';
	echo $this->ui->load_component($options);
?>
