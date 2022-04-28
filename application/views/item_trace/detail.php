<?php
	$data = array();
	$data['prefix'] = 'detail';
	$options = array();
	$options['component'] = 'component/modal/modal_default';
	$options['modal_id'] = 'modal_detail_item_trace';
	$options['modal_size'] = 'modal-default';
	$options['modal_icon'] = '';
	$options['modal_title'] = 'Detail Barang';
	$options['modal_footer'] = 'no';
	$options['main_content'] = '<div id="div_detail_item_trace"></div>';
	echo $this->ui->load_component($options);
?>