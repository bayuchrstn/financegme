<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		// $this->lang->load('inbox');
		// $this->load->model('model_ticket_email', 'ticket_email');
		// $this->load->model('Model_request', 'request');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	function index($filter='')
	{
		pre('view');
	}



}
