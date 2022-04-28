<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Focus extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->lang->load('master');
		$this->load->model('Model_focus', 'focus');
	}

	function index($modul, $id)
	{
		$arr = array();
		$modal_icon = '<i class="icon-search4 position-left"></i>';
		switch($modul){
			case 'user':
				$data_focus = $this->focus->user($id);
				$arr['modal_title'] = 'User info';
			break;

			default:
				$data_focus = $this->focus->customer($id);
				$arr['modal_title'] = 'Customer info';
		}
		$data = array();
	    $data['label_width'] = '130';
	    $data['sparator_width'] = '10';

		$tr = array();
		foreach($data_focus as $col=>$val):
			$tr[$col] = $val;
		endforeach;
		$data['info'] = $tr;
		$arr['modal_content'] = $this->ui->load_template('table_data_info', $data);
	    // echo $this->ui->load_template('table_data_info', $data);
		echo json_encode($arr);
	}

	function customer($id)
	{
		// $this->lang->load('patient');
		// $data_focus = $this->focus->patient($id);
		//
		// $data = array();
		// $data['label_width'] = '130';
		// $data['sparator_width'] = '10';
		//
		// $tr = array();
		// foreach($data_focus as $col=>$val):
		// 	$tr[$col] = $val;
		// endforeach;
		// $data['info'] = $tr;

		$arr = array();
		$arr['modal_title'] = 'Informasi Pelanggan';
		$arr['modal_content'] = $this->load->view('customer/focus', '', TRUE);
		echo json_encode($arr);
	}

	function user($id)
	{
		$this->index('user', $id);
	}


}
