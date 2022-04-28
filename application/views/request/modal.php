<?php
// $options['component'] = 'component/modal/modal_tab';
// $options['modal_id'] = 'modal_tab_default';
// $options['modal_size'] = 'modal-lg';
// $options['modal_icon'] = 'icon-search4';
// $options['modal_title'] = 'Modal Tab Detail';
// $options['tabs'] = array();
// $options['max'] = '8';
// $options['selected_tab'] = 'show_detail_customer';
// $options['tabs'][] = array(
// 		'label'         => 'Detail Customer',
// 		'id'            => 'show_detail_customer',
// 		'content'       => '<div id="show_detail_customer"></div>',
// 	);
//
// $options['tabs'][] = array(
// 		'label'         => 'Daftar Perangkat',
// 		'id'            => 'daftar_perangkat',
// 		'content'       => '<div id="daftar_perangkat"></div>',
// 	);
// echo $this->ui->load_component($options);


	$mdl['component'] = 'component/modal/modal_default';
	$mdl['modal_id'] = 'modal_rev';
	$mdl['modal_size'] = 'modal-lg';
	$mdl['modal_icon'] = '';
	$mdl['modal_title'] = 'Detail Request';
	$mdl['main_content'] = '<div id="modal_rev_div"></div>';
	echo $this->ui->load_component($mdl);

?>
