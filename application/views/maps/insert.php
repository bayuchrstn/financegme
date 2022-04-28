<?php
	$data = array();
	$data['prefix'] = 'insert';
	$data['category'] = $this->maps->get_maps_type_icon();
	$options = array();
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_maps_insert';
	$options['modal_size'] = 'modal-large';
	$options['modal_icon'] = $this->theme->icon('maps');
	$options['modal_title'] = 'Input maps';
	$options['modal_footer'] = 'no';
	$options['form_id'] = 'form_maps_insert';
	$options['form_action'] = base_url().'maps/insert';
	$options['main_content'] = '';
	$options['main_content'] = $this->parser->parse('maps/form_grid', $data, TRUE);
	echo $this->ui->load_component($options);
?>
