<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Progress extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		check_login();
		// $this->lang->load('dashboard');
		$this->browser_title = 'Progress';
		$this->load->model('Model_progress', 'progress');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index($pid='')
	{
		$this->breadcrumb = array(
				'Dashboard'	=> '#',
			);
		$detail = $this->progress->detail($pid);
		if(empty($detail)):
			show_404();
		endif;
		$data = array();
		$data['pid'] = $pid;
		$data['detail'] = $detail;
		$data['modal_view'] = $this->load->view('progress/modal', $data, TRUE);

		// $this->js_include .= $this->ui->js_include('ctiga');
		// $this->js_include .= $this->ui->js_include('fullcalendar');
		// $this->js_include .= $this->ui->js_include('chartjs');
		$this->js_inject .= $this->load->view('progress/js', $data, TRUE);

		$konten = $this->load->view('progress/detail', $data, TRUE);
		$this->admin_view($konten);
	}

}
