<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View_pengadaan_barang extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
        $this->load->model('Model_request', 'request');
        // $this->load->model('Model_bcn', 'bcn');
	}

    function index()
    {
        exit;
    }

	function approval()
	{
		if($this->form_validation->run('sender')):
			$data = array();
			$arr['post']  = $_POST;

			//input approval
			$this->request->approval($this->input->post('id'));

			//update status
			$new_status = $this->input->post('approval_status');
			$task_id = $this->input->post('id');
			$this->db->query("UPDATE {PRE}task SET status='".$new_status."' WHERE id='".$task_id."' ");

			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan';
			echo json_encode($arr);
		endif;
	}


}
