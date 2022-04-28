<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
        // $this->load->model('request/Model_request_in', 'request_in');
        // $this->load->model('Model_bcn', 'bcn');
	}

    function typeahead_all($keyword='')
	{
		$arr = array();
		if($keyword !=''):
			$this->db->like('customer_name', $keyword);
		endif;
		$this->db->where('status', 'customer');
		$data = $this->db->get('customer')->result_array();
		// pre($data);
		if(!empty($data)):
			foreach($data as $row):
				$arr[] = array(
					'id' => $row['id'],
					'name' => $row['customer_name'],
				);
			endforeach;
		endif;
		// pre($arr);
		echo json_encode($arr);
	}
}
