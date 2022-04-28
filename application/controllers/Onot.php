<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Onot extends CI_Controller {

		function __construct()
		{
			parent::__construct();
			// check_login();
			// $this->load->model('Model_init', 'init');
		}

		public function index($url_referer='')
		{
			pre($_SESSION);

		}

	}
