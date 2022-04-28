<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Incomes extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->lang->load('user');
		$this->load->model('model_alert', 'alert');

		$this->active_root_menu = 'Notifikasi';
		$this->browser_title = 'Daftar Notifikasi';

		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';

	}

	public function index($customer_group='')
	{
		// valid_action('alert');
		$data = array();
		$this->js_inject .= $this->load->view('alert/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('alert/js', $data, TRUE);
		$this->js_inject .= $this->load->view('alert/valid', $data, TRUE);
		$konten = $this->load->view('alert/index', $data, TRUE);
		$this->admin_view($konten);
	}



}
