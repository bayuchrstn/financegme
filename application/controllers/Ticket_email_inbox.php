<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket_email_inbox extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->lang->load('inbox');
		$this->load->model('model_ticket_email', 'ticket_email');
		$this->load->model('Model_request', 'request');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	function index($filter='')
	{
		$modul = $this->ticket_email->info_modul();
		$set_ui = $this->ticket_email->set_ui();

		$data = array();
		$arr_filter = un_filter_serialthis($filter);
		// $data['what'] = $what;
		$data['filter'] = $filter;
		$data['arr_filter'] = $arr_filter;
		$data['modul'] = $modul;
		// $data['req_code'] = $what;
		$data['set_ui'] = $set_ui;



		$tabs = $this->ticket_email->tabs();
		// pre($tabs);
		$data['modal_view'] = $this->load->view('ticket_email_inbox/modal', $data, TRUE);
		$data['tabs'] = $tabs;
		$data['columns'] = $this->ticket_email->js_table();

		// pre($data);
		$this->js_inject .= $this->load->view('ticket_email_inbox/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('ticket_email_inbox/js', $data, TRUE);
		$this->js_inject .= $this->load->view('ticket_email_inbox/valid', $data, TRUE);

		$this->js_include .= $this->ui->js_include('wysiwyg');

		$main_index_view = (empty($tabs)) ? 'index' : 'index_tab';
		$konten = $this->load->view('ticket_email_inbox/'.$main_index_view, $data, TRUE);
		$this->admin_view($konten);
	}

	public function data($status, $filter='')
	{
		$this->ticket_email->data($status, $filter);
	}

	function open_ticket($id)
	{
		$arr = array();
		$detail = $this->ticket_email->detail($id);
		if(!$this->form_validation->run('sender')):
			$data = array();
			$data['detail'] = $detail;
			$arr['form'] = $this->load->view('ticket_email_inbox/open_ticket', $data, TRUE);
			$arr['form_action'] = base_url().'ticket_email_inbox/open_ticket/'.$id;
			echo json_encode($arr);
		else:
			$arr['post'] = $_POST;

			//update status table gmd_ticket_email
			$ticket_email_id = $this->input->post('id');
			$this->db->query("UPDATE {PRE}ticket_email SET status='open' WHERE id='".$ticket_email_id."'");

			//membuat ticket baru
			$params = array();
			$params['category'] = $this->input->post('ticket_type');
			$params['body'] = $this->input->post('body_fake');
			$params['flock'] = $this->input->post('n');
			$new_ticket = $this->request->insert($params);

			$params_ext = array();
			$params_ext['priority'] = $this->input->post('ticket_priority');
			$params_ext['email'] = $this->input->post('email');
			$this->request->task_ext_partial($new_ticket['last_id'], 'task_ticket', $params_ext);


			// $arr['debug'] = $this->db->last_query();
			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan';

			echo json_encode($arr);
		endif;
	}

}
