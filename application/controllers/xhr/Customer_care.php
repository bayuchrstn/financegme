<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_care extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_customer', 'customer');
		$this->load->model('model_request', 'request');
		$this->load->model('request/model_customer_visit','customer_visit');
	}

    function index()
    {
        echo 'customer_care';
    }

	function customer_info($customer_id)
	{
		// $this->load->model('model_customer', 'customer');
		$arr = array();
		$this->db->where('id', $customer_id);
		$cif = $this->db->get('customer')->row_array();
		if(!empty($cif)):
			$gpro_data['layanan'] =  $this->customer->layanan_show($cif['id']);
			$arr['gpro'] = $this->load->view('customer/layanan/show1', $gpro_data, TRUE);
			$arr['product_name'] = count($gpro_data['layanan']) > 0 ? $gpro_data['layanan'][0]['product_name'] : '';
			// $arr['gpro'] = strip_tags($gpro);
			foreach($cif as $key=>$val):
				$arr[$key] = $val;
			endforeach;
		endif;
		// pre($arr);
		echo json_encode($arr);
	}

	function update()
	{
		$arr = array();

		$params = array();
		// $params['up'] = 'wkw';
		$data_update = $this->request->update($params);

		$params_ext = array();
		$params_ext['respon'] = $this->input->post('respon_fake');
		$params_ext['note'] = $this->input->post('note_fake');
		$data_update_ext = $this->request->task_ext_partial($this->input->post('id'), 'task_customer_care', $params_ext);

		$arr['post'] = $_POST;
		$arr['data_update'] = $data_update;
		$arr['data_update_ext'] = $data_update_ext;
		$arr['status'] = 'success';
		$arr['msg'] = 'Data berhasil disimpan';
		// $arr['data_insert'] = $data_insert;
		echo json_encode($arr);
	}

	function insert()
	{
		$arr = array();
		$data = array();
		$arr['post'] = $_POST;

		$params = array(
			'task_category'	=> $this->input->post('customer_care_type'),
			'date_created'	=> now(),
			'status'		=> $this->input->post('status'),
			'date_start'	=> now(),
			'subject'		=> '',
			'body'			=> '',
			'location'		=> 'customer',
			'location_id'	=> $this->input->post('customer_id'),
		);
		$data_insert = $this->request->insert($params);

		$params_ext = array();
		$params_ext['respon'] = $this->input->post('respon_fake');
		$params_ext['note'] = $this->input->post('note_fake');
		$this->request->task_ext_partial($data_insert['last_id'], 'task_customer_care', $params_ext);

		$detail = $this->request->detail($data_insert['last_id']);
		$customer = $this->customer->detail_customer($detail['location_id']);
		$last_visit = $this->customer_visit->last_task($detail['location_id']);

		$data['detail'] = $detail;
		$data['customer'] = $customer;
		$data['task_ext'] = $this->customer_visit->get_task_ext($detail['id'], $detail);
		$data['last_visit'] = empty($last_visit) ? '-' : date('d M Y', strtotime($last_visit['date_created']));

		// kirim email
		$email_support = $this->emailer->sendto('support');
		$receiver = $email_support;

		$email_ce = $this->emailer->sendto('ce');

		$judul = $data['detail']['task_category']=='customer_call' ? 'Customer.Call' : 'Customer.Visit';


		$subject = 'ERP#'.$judul.'#'.$data_insert['last_id'].'#'.$customer['customer_name'];

		// $view = $detail['category'];

		$html = $this->load->view('email/template/customer_visit', $data, TRUE);
		$email['to'] = $receiver;
		$email['cc'] = $email_ce;
		$email['subject'] = $subject;
		$email['body'] = $html;

		$debug = $this->send_email->compose($email);
		// end kirim email

		$arr['status'] = 'success';
		$arr['msg'] = 'Data berhasil disimpan';
		$arr['data_insert'] = $data_insert;
		$arr['sendmail'] = $debug;
		echo json_encode($arr);
	}

	function sendmail($task_id)
	{
		$data = array();

		$detail = $this->request->detail($task_id);
		$customer = $this->customer->detail_customer($detail['location_id']);
		$last_visit = $this->customer_visit->last_task($detail['location_id']);

		$data['detail'] = $detail;
		$data['customer'] = $customer;
		$data['task_ext'] = $this->customer_visit->get_task_ext($detail['id'], $detail);
		$data['last_visit'] = empty($last_visit) ? '-' : date('d M Y', strtotime($last_visit['date_created']));

		// print_r($data); 
		//$am_email = $customer['am_email'];
		$this->load->view('email/template/customer_visit', $data, FALSE);
	}
}
