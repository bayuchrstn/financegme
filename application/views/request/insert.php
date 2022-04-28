<?php
	// pre($modul);
	if(isset($set_ui['modal_insert_title'])):
		$modal_title = $set_ui['modal_insert_title'];
	else:
		switch ($modul['code']) {
			case 'marketing_progress' :
			$modal_title = 'Input Marketing Progress';
			break;

			case 'request_in' :
			$modal_title = 'Permintaan Barang Masuk';
			break;

			//mkt_ts
			default:
			$modal_title = 'Input '.$modul['name'];
			break;
		}
	endif;


	$data = array();
	$data['prefix'] = 'insert';

	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_request_insert';
	$options['modal_size'] = 'modal-lg';
	$options['modal_icon'] = $this->theme->icon($modul['code']);
	$options['modal_title'] = $modal_title;
	$options['form_id'] = 'form_'.$modul['code'].'_insert';
	$options['form_action'] = base_url().'request/insert';
	$options['main_content'] = $this->load->view('request/'.$modul['code'].'/form_grid', $data, TRUE);
	echo $this->ui->load_component($options);
?>
