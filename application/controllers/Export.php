<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		// check_login();
		// $this->lang->load('task');
		// $this->load->model('model_task', 'task');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	function index()
	{
		exit('ok');
	}

	function task($what='')
	{
		if(!$this->form_validation->run('sender')):
			$data = array();
			$this->load->view('export/form/'.$what, $data);
		else:
			$arr = array();
			switch ($what) {
				case 'marketing_progress':
					$arr['post'] = $_POST;
				break;
			}
			echo json_encode($arr);
		endif;
	}

	function customer()
	{
		$this->load->library("Export_data");
		$params = array();
		$params['filename'] = 'fuc.xls';
		$this->export_data->excel($params);
	}





}
