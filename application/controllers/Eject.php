<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Eject extends MY_Controller {

	public function __construct()
    {
		parent::__construct();
		check_login();
		$this->lang->load('eject');
	}

	public function index()
	{
		$konten = $this->load->view('flat/eject', '', TRUE);
		$this->admin_view($konten);
	}

	public function related()
	{
		$konten = $this->load->view(ADMIN_FOLDER.'/v3/related', '', TRUE);
		$this->admin_view($konten);
	}
}
