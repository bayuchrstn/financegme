<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		check_login();
		$this->lang->load('dashboard');
		$this->active_root_menu = 'Dashboard';
		$this->browser_title = 'Dashboard';
		$this->modul_name = 'Dashboard';
		$this->load->model('model_dashboard', 'dashboard');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		// print_r($this->all_session);exit;
		$this->breadcrumb = array(
				'Dashboard'	=> '#',
			);
		$data = array();
		$data['widget_lists'] = $this->dashboard->widget_lists();
		// pre($this->db->last_query() );
		$this->js_inject .= $this->load->view('dashboard/js', $data, TRUE);
		// $this->js_include .= $this->ui->js_include('masonry');
		$this->js_include .= $this->ui->js_include('ctiga');
		$this->js_include .= $this->ui->js_include('fullcalendar');
		$this->js_include .= $this->ui->js_include('chartjs');
		$konten = $this->load->view('dashboard/index', $data, TRUE);
		$this->admin_view($konten);
	}

	public function widget($widget_code='')
	{
		$widget_detail = $this->dashboard->widget_detail($widget_code);
		$options['component'] = 'component/panel/panel_default';
		$options['panel_icon'] = $widget_detail['icon'];
		$options['panel_title'] = $widget_detail['name'];
		$options['panel_action'] = array();
		$options['panel_padding'] = $widget_detail['padding'];
		$options['panel_content'] = $this->$widget_detail['code']();
		echo $this->ui->load_component($options);
	}




}
