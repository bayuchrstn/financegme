<?php
	$data = array();
	$data['prefix'] = 'insert';
	$options = array();
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_cuti_status';
	$options['modal_size'] = 'modal-default';
	$options['modal_icon'] = $this->theme->icon('cuti');
	$options['modal_title'] = 'Update Cuti';
	$options['modal_footer'] = 'yes';
	$options['form_id'] = 'form_cuti_update_status';
	$options['form_action'] = '#';
	$options['main_content'] = '<div id="body_cuti_update_status"></div>';
	echo $this->ui->load_component($options);
?>