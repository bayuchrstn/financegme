<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_sales extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->lang->load('request/admin_sales');
		$this->load->model('model_request', 'request');
		$this->load->model('request/Model_admin_sales', 'admin_sales');
		$this->load->model('Model_customer', 'customer');
	}

    function index($modul='', $task_id='')
    {
		echo 'xhr admin sales';
    }

	function build_form($modes='', $id='')
	{
		if(!$this->form_validation->run('sender')):

			$detail = $this->request->detail($id);
			$data = array();
			$data['detail'] = $detail;
			$data['modes'] = $modes;
			$data['id'] = $id;
			$data['task_ext'] = $this->admin_sales->get_task_ext($detail['id']);
			// pre($data);

			if($detail['location']=='customer' || $detail['location']=='pre_customer'):
				$data['customer_data'] = $this->customer->detail_customer($detail['location_id']);
			else:
				$data['customer_data'] = array();
			endif;

			// pre($modes);
			switch ($modes) {

				case 'pre_survey':
					$fms = $modes;
					$data['detail_customer'] = $this->customer->detail_customer($detail['location_id']);
				break;

				case 'installasi_new':
					$fms = 'new';
					break;

				default:
					$fms = 'general';
				break;
			}

			// pre($fms);
			echo $this->load->view('request/admin_sales/form/'.$fms, $data, TRUE);
		else:
			$arr = array();

			$params['body'] = $_POST['body_fake'];
			$this->crud->update('task', $params, array('id'));



			// if($this->input->post('mode')=='general'):
			// else:
			// endif;

			//jika dikirim update statusnya menjadi
			if($this->input->post('flag_send_request')=='Y'):
				$this->db->query('UPDATE {PRE}task SET status=\'sudah_dikirim\' WHERE id=\''.$this->input->post('id').'\' ');
			endif;

			$arr['status'] = 'success';
			$arr['msg'] = 'data berhasil disimpan';
			echo json_encode($arr);
		endif;
	}


}
