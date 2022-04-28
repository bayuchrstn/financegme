<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ipman extends CI_Model {

	function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	function data($up=0)
	{
		$this->db->where('up', $up);
		$query = $this->db->get('iplist');
		return $query->result_array();
	}
	function detail($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('iplist');
		return $query->row_array();
	}
}

/* End of file Model_ipman.php */
/* Location: ./application/models/Model_ipman.php */