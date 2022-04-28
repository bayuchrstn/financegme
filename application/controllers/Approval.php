<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->lang->load('inbox');
		$this->load->model('model_approval', 'approval');
		// $this->load->model('model_task', 'task');
		// $this->load->model('model_roadrunner', 'roadrunner');
		// $this->load->model('model_location', 'location');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	function index($filter='')
	{
		$modul = $this->approval->info_modul();
		$set_ui = $this->approval->set_ui();

		$data = array();
		$arr_filter = un_filter_serialthis($filter);
		// $data['what'] = $what;
		$data['filter'] = $filter;
		$data['arr_filter'] = $arr_filter;
		$data['modul'] = $modul;
		// $data['req_code'] = $what;
		$data['set_ui'] = $set_ui;



		$tabs = $this->approval->tabs();
		// pre($tabs);
		$data['modal_view'] = $this->load->view('approval/config/modal', $data, TRUE);
		$data['tabs'] = $tabs;
		$data['columns'] = $this->approval->js_table();

		// pre($data);
		$this->js_inject .= $this->load->view('approval/config/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('approval/config/js', $data, TRUE);
		$this->js_inject .= $this->load->view('approval/config/valid', $data, TRUE);

		$this->js_include .= $this->ui->js_include('wysiwyg');

		$main_index_view = (empty($tabs)) ? 'index' : 'index_tab';
		$konten = $this->load->view('approval/config/'.$main_index_view, $data, TRUE);
		$this->admin_view($konten);
	}

	public function data($status, $filter='')
	{
		$this->approval->data($status, $filter);
	}

	function insert()
	{
		if(!$this->form_validation->run('sender')):
			$data = array();
			$arr['form'] = $this->load->view('approval/config/insert', $data, TRUE);
			$arr['form_action'] = base_url().'approval/insert/';
			echo json_encode($arr);
		else:
			$arr = array();
			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan';

			echo json_encode($arr);
		endif;
	}

	function update($id)
	{
		$arr = array();
		$detail = $this->approval->detail($id);
		if(!$this->form_validation->run('sender')):
			$data = array();
			$data['detail'] = $detail;
			$arr['form'] = $this->load->view('approval/config/update', $data, TRUE);
			$arr['form_action'] = base_url().'approval/update/'.$id;
			echo json_encode($arr);
		else:
			$arr['post'] = $_POST;

			$data = array();
			$data['user_id'] = $this->input->post('user_id');
			$data['options'] = $this->input->post('options');
			$data['final_option'] = $this->input->post('final_option');
			$data['sort'] = $this->input->post('sort');
			$data['required'] = $this->input->post('required');

			$this->db->where('id', $this->input->post('id'));
			$this->db->update('approval_config', $data);

			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan';

			echo json_encode($arr);
		endif;
	}

}
