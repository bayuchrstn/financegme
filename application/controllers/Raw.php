<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Raw extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('Model_raw', 'raw');
	}


	function customer($customer_id='')
	{
		$this->load->model('model_customer', 'customer');
		$arr = array();
		$arr['detail'] = $this->raw->customer($customer_id);
		// pre($arr);
		echo json_encode($arr);
	}

	function request($id='')
	{
		$arr = array();
		$arr['detail'] = $this->raw->get_task($id);
		pre($arr);
		echo json_encode($arr);
	}

}
