<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Model_myprofil extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getdata()
    {
		$userid = $this->is_valid_token ? $this->tokenArray['userId'] : $this->session->userdata('userid');

        // $this->db->where('id', $userid);
		// $query = $this->db->get('users');
		// return $query->row_array();
		
		return $this->db->query("SELECT * FROM absensi.`ms_user` WHERE id='".$userid."'")->row_array();
    }

	function getModelById($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('users');
		return $query->row_array();
	}

	function updateAccount()
	{
		if($this->input->post('password') != ''){
			$data = array(
				'name' 			=> $this->input->post('name'),
				'password' 		=> md5($this->input->post('password'))
			);
		} else {
			$data = array(
				'name' 			=> $this->input->post('name'),
			);
		}
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('users', $data);
	}

}
