<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nojs extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();

	}

	public function index()
	{
		echo 'Aplikasi ini harus menggunakan javascript. Silahkan aktifkan javascript pada web browser anda dan klik <a href="'.base_url().'login">disini</a> untuk login';
	}


}
