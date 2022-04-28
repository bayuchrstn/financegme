<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class boq extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
        // $this->load->model('request/Model_request_in', 'request_in');
        // $this->load->model('Model_bcn', 'bcn');
	}

    function index()
    {
        echo 'Request_in';
    }

    function get_survey_ref($task_id='')
	{
		$arr = array();
		$this->db->where('id', $task_id);
		$data = $this->db->get('task')->row_array();
		if($data):
			foreach($data as $key=>$val):
				$arr[$key] = $val;
			endforeach;
			$arr['za'] = $this->db->last_query();
			$arr['item_from_ts'] = '';
		endif;
		// pre($arr);
		echo json_encode($arr);
	}

	function wh_moderation()
	{
		if($this->form_validation->run('sender')):
			$data = array(
					'status'	=> $this->input->post('status')
				);
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('task', $data);
			// $arr['post']  = $_POST;
			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan';
			echo json_encode($arr);
		endif;
	}

}
