<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View_marketing_request extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
        $this->load->model('Model_request', 'request');
		$this->load->model('Model_user_assign', 'user_assign');
		$this->load->model('Model_progress', 'progress');
        // $this->load->model('Model_bcn', 'bcn');
	}

    function index()
    {
        exit;
    }

	function create_task()
	{
		if($this->form_validation->run('sender')):
			$data = array();
			$arr['post']  = $_POST;

			//update requestnya
			$id = $this->input->post('id');
			$this->db->query("UPDATE {PRE}task SET status='sudah_dijadwalkan' where id='".$id."' ");

			//buat taksnya
			$params = array();
			// $params = array(
			// 	'up'	=> $id,
			// 	'progress_id'	=> $this->input->post('progress_id'),
			// 	'task_category'	=> $this->input->post('task_category'),
			// 	'category'	=> $this->input->post('category'),
			// 	'status'	=> $this->input->post('status'),
			// 	'date_start' => $this->input->post('date_start'),
			// 	'date_due'	=> $this->input->post('date_due'),
			// 	'subject'	=> $this->input->post('subject'),
			// 	'body'	=> $this->input->post('body_fake'),
			// 	'location'	=> $this->input->post('location'),
			// 	'location_id'	=> $this->input->post('location_id'),
			// 	'flock'	=> $this->input->post('flock') ? $this->input->post('flock') : '',

			// );
			$data_insert = $this->request->insert($params);

			// progress update +++++++++++++++++++++++++++++++++++++++++++++
			// progress update tag
			if($this->input->post('progress_id')):
				$params_progress = array(
					'id'		=> $this->input->post('progress_id'),
					'task_id'	=> $data_insert['last_id'],
					'label'		=> 'Pekerjaan Teknis',
					'show_url'	=> 'pekerjaan_teknis/show/'.$data_insert['last_id'].'/echo',
					'code'		=> 'task_teknis',
				);
				$progress = $this->progress->update($params_progress);
			endif;
			// progress update +++++++++++++++++++++++++++++++++++++++++++++

			// if($this->input->post('user_assigned')):
				// $assigned = $this->user_assign->save($data_insert['last_id'], $this->input->post('user_assigned'));
				$assigned = $this->user_assign->save_pld($data_insert['last_id'], $this->input->post('user_assigned_id'));
			// endif;

			// alert notif
			switch ($this->input->post('category')) {
				case 'pre_survey':
					$params['code'] = 'task_teknis_1';
					$params['category'] = 'Pre Survey';
					break;

				case 'survey':
					$params['code'] = 'task_teknis_2';
					$params['category'] = 'Survey';
					break;

				case 'installasi':
				case 'installasi_new':
					$params['code'] = 'task_teknis_3';
					$params['category'] = 'installasi';
					break;
				
				default:
					$params['code'] = 'task_teknis_4';
					$params['category'] = 'Lain lain';
					break;
			}

			$task_id = $data_insert['last_id'];

			$params_alert = array(
				'alert_code'	=> $params['code'],
				'title'	=> 'Pekerjaan '.$params['category'],
				'content'	=> (isset($params['subject']) && $params['subject'] !='') ? $params['subject'] : ( $this->input->post('subject') ? $this->input->post('subject') : '' ) ,
				'user_id'	=> $this->alert_notif->get_user_task($task_id),
				'url_link'	=> 'pekerjaan_saya'
			);
			$this->alert_notif->insert($params_alert);
			// end alert notif


			$arr['assigned'] = $assigned;
			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan';
			echo json_encode($arr);
		endif;
	}


}
