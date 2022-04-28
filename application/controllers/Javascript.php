<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Javascript extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
	}

	function index()
	{
		header('Content-Type: application/x-javascript');
		// echo un_filter_serialthis($this->session->userdata('js_page'));
		// if($this->session->flashdata('js_page')):
		// 	echo un_filter_serialthis($this->session->flashdata('js_page'));
		// endif;
	}
}
