<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud_modal extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		check_login();
		// $this->load->model('model_customer', 'customer');
		// $this->load->model('model_marketing_progress', 'marketing_progress');
		// $this->load->model('model_cli', 'cli');
		// $this->load->model('model_request', 'request');
		// $this->load->model('request/model_laporan_harian', 'laporan_harian');
		// $this->lang->load('customer');
	}

	function index()
	{
		$data = array();
		$this->load->view('crud_modal/index', $data, FALSE);
	}
}
