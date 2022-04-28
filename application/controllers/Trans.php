<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trans extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();

		$this->load->model('model_trans', 'trans');

		$this->active_root_menu = '';
		$this->browser_title = '';
		$this->modul_name = '';
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index($trans_code='', $filter='')
	{
		$modul = $this->trans->info_modul($trans_code);
		$tabs = $this->trans->tabs($trans_code);
		$ui = $this->trans->set_ui($trans_code);
		$data = array();
		$data['trans_code'] = $trans_code;
		$data['modul'] = $modul;
		$data['filter'] = $filter;
		$data['tabs'] = $tabs;
		$data['ui'] = $ui;
		$data['arr_filter'] = un_filter_serialthis($filter);

		$data['modal_view'] = $this->load->view('trans/modal', $data, TRUE);
		// pre($data);

		if(isset($tabs)):
			$view = 'index';
			$this->js_inject .= $this->load->view('trans/no_tabs/js_table', $data, TRUE);
		else:
			$view = 'index';
			$this->js_inject .= $this->load->view('trans/with_tabs/js_table', $data, TRUE);
		endif;

		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_inject .= $this->load->view('trans/js', $data, TRUE);

		$konten = $this->load->view('trans/'.$view, $data, TRUE);
		$this->admin_view($konten);
	}

	function data($category='', $filter='')
	{
		$this->trans->data($category, $filter);
	}

	function insert($trans_code='')
	{
		$arr = array();
		$data = array();
		$modul = $this->trans->info_modul($trans_code);
		$data['modul'] = $modul;
		if(!$this->form_validation->run('sender')):
			$arr['html'] = $this->load->view('trans/form/insert', $data, TRUE);
			$arr['action'] = base_url('trans/insert/wkwkwk');
			echo json_encode($arr);
		else:
			$data = array();


			$arr['data'] = $data;
			$arr['post'] = $_POST;
			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan';
			echo json_encode($arr);
		endif;
	}


}
