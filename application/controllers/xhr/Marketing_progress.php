<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marketing_progress extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
        $this->load->model('Model_customer', 'customer');
	}

    function index()
    {
        echo 'MP';
    }

	function form_ext($progress='', $customer_id='', $prefix='')
	{
		// pre($progress);
		// pre($customer_id);
		$data = array();
		$data['$progress'] = $progress;
		$data['customer_id'] = $customer_id;
		$data['prefix'] = $prefix;
		$data['detail_customer'] = $this->customer->detail_customer($customer_id);
		switch ($progress) {

			case 'mp_pre_survey':
				$this->load->view('request/marketing_progress/form_ext/mp_pre_survey', $data);
			break;

			case 'mp_survey':
				$this->load->view('request/marketing_progress/form_ext/mp_survey', $data);
			break;

			case 'mp_instalasi':
				$this->load->view('request/marketing_progress/form_ext/mp_instalasi', $data);
			break;

			case 'mp_trial':
				$this->load->view('request/marketing_progress/form_ext/mp_trial', $data, FALSE);
				break;

			default:
				echo '';
			break;
		}
	}


}
