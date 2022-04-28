<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cancel_out extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->lang->load('inbox');
		$this->load->model('model_cancel_out', 'cancel_out');
		$this->load->model('model_bcn', 'bcn');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	function index($filter='')
	{
		$modul = $this->cancel_out->info_modul();
		$set_ui = $this->cancel_out->set_ui();

		$data = array();
		$arr_filter = un_filter_serialthis($filter);
		// $data['what'] = $what;
		$data['filter'] = $filter;
		$data['arr_filter'] = $arr_filter;
		$data['modul'] = $modul;
		// $data['req_code'] = $what;
		$data['set_ui'] = $set_ui;



		$tabs = $this->cancel_out->tabs();
		// pre($tabs);
		$data['modal_view'] = $this->load->view('cancel_out/modal', $data, TRUE);
		$data['tabs'] = $tabs;
		$data['columns'] = $this->cancel_out->js_table();

		// pre($data);
		$this->js_inject .= $this->load->view('cancel_out/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('cancel_out/js', $data, TRUE);
		$this->js_inject .= $this->load->view('cancel_out/valid', $data, TRUE);

		$this->js_include .= $this->ui->js_include('wysiwyg');

		$main_index_view = (empty($tabs)) ? 'index' : 'index_tab';
		$konten = $this->load->view('cancel_out/'.$main_index_view, $data, TRUE);
		$this->admin_view($konten);
	}

	public function data($status, $filter='')
	{
		$this->cancel_out->data($status, $filter);
	}

	function update($id)
	{
		$arr = array();
		$detail = $this->cancel_out->detail($id);
		if(!$this->form_validation->run('sender')):
			$data = array();
			$data['detail'] = $detail;
			$arr['form'] = $this->load->view('cancel_out/update', $data, TRUE);
			$arr['form_action'] = base_url().'cancel_out/update/'.$id;
			echo json_encode($arr);
		else:
			$arr['post'] = $_POST;

			// $data = array();
			// $data['user_id'] = $this->input->post('user_id');
			// $data['options'] = $this->input->post('options');
			// $data['final_option'] = $this->input->post('final_option');
			// $data['sort'] = $this->input->post('sort');
			// $data['required'] = $this->input->post('required');
			//
			// $this->db->where('id', $this->input->post('id'));
			// $this->db->update('approval_config', $data);

			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan';

			echo json_encode($arr);
		endif;
	}

}
