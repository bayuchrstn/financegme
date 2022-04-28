<?php
	// pre($set_ui['modal_update_title']);
	// pre($modul);

	if(isset($set_ui['modal_update_title'])):
		$modal_title = $set_ui['modal_update_title'];
	else:
		switch ($modul['code']) {
			case 'marketing_progress' :
				$modal_title = 'Update Marketing Progress';
			break;

			case 'request_in' :
				$modal_title = 'Permintaan Barang Masuk';
			break;

			case 'barang_keluar' :
				$modal_title = 'Approval Barang Keluar';
			break;

			case 'view_marketing_request' :
				$modal_title = 'Input Pekerjaan Teknis';
			break;

			case 'approval_pre_customer_install' :
				$modal_title = 'Approval Pre Customer';
			break;

			case 'my_task' :
				$modal_title = 'Laporan Hasil Pekerjaan';
			break;

			//mkt_ts
			default:
				$modal_title = $modul['name'];
			break;
		}
	endif;

	$data = array();
	$data['prefix'] = 'update';

	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_request_update';
	$options['modal_size'] = 'modal-lg';
	$options['modal_icon'] = $this->theme->icon($modul['code']);
	$options['modal_title'] = $modal_title;
	// $options['modal_footer'] = 'no';
	$options['form_id'] = 'form_'.$modul['code'].'_update';
	$options['form_action'] = '';
	$options['main_content'] = $this->load->view('request/'.$modul['code'].'/form_grid', $data, TRUE);
	echo $this->ui->load_component($options);
?>
