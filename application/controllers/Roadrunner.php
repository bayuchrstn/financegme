<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roadrunner extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->lang->load('task');
		$this->load->model('model_task', 'task');
		$this->load->model('model_roadrunner', 'roadrunner');
		$this->load->model('model_location', 'location');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	function index($what='', $filter='')
	{
		$modul = $this->roadrunner->info_modul($what);
		$set_ui = $this->roadrunner->set_ui($what);

		$data = array();
		$arr_filter = un_filter_serialthis($filter);
		$data['what'] = $what;
		$data['filter'] = $filter;
		$data['arr_filter'] = $arr_filter;
		$data['modul'] = $modul;
		$data['req_code'] = $what;
		$data['set_ui'] = $set_ui;
		// pre($data);

		$this->js_inject .= $this->load->view('roadrunner/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('roadrunner/js', $data, TRUE);

		$tabs = $this->roadrunner->tabs($what);
		$data['modal_view'] = $this->load->view('roadrunner/modal', $data, TRUE);

		$main_index_view = (empty($tabs)) ? 'index' : 'index_tab';
		$konten = $this->load->view('roadrunner/'.$main_index_view, $data, TRUE);
		$this->admin_view($konten);
	}

	public function data($what='', $filter='')
	{
		$this->report->data($what, $filter);
	}

	function item_debug()
	{
		$this->report->item_debug('marketing_progress');
	}

	// function customer()
	// {
	// 	$params = array();
	// 	$params['view'] = 'report/customer/index';
	// 	$params['panel_title'] = 'Laporan Pelanggan';
	// 	$this->index($params);
	// }
	//
	// function task($category='survey')
	// {
	// 	if($this->input->post('draw')):
	// 		cekpost();
	// 	else:
	// 		//securing
	// 		if(!in_array($category, array('survey', 'installasi', 'dismantle'))):
	// 			show_404();
	// 		endif;
	//
	// 		//load specific model
	// 		$this->load->model('model_task', 'task');
	// 		$this->load->model('model_task_teknis', 'task_teknis');
	//
	// 		//collecting data
	// 		$category_info = $this->task_teknis->task_category_info($category);
	//
	// 		//build data
	// 		$data = array();
	// 		$data['category'] = $category;
	// 		$data['panel_title'] = 'Laporan Pekerjaan ('.$category_info['name'].' )';
	//
	// 		//js
	// 		$this->js_inject .= $this->load->view('report/task/js_table', $data, TRUE);
	//
	// 		//show the UI
	// 		$konten = $this->load->view('report/task/index', $data, TRUE);
	// 		$this->admin_view($konten);
	// 	endif;
	// }


}
