<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		check_login();
		$this->lang->load('dashboard');
		$this->active_root_menu = 'Dashboard';
		$this->browser_title = 'Dashboard';
		$this->modul_name = 'Dashboard';
		// $this->load->model('model_dashboard', 'dashboard');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		$data = array();
		echo $this->load->view('calendar/index', $data, TRUE);
	}


}
