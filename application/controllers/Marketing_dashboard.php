<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class marketing_dashboard extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_global');
		$this->load->model('model_marketing_dashboard', 'marketing_dashboard');
		$this->lang->load('marketing_dashboard');
		$this->active_root_menu = $this->lang->line('marketing_dashboard_alltitle');
		$this->browser_title = $this->lang->line('marketing_dashboard_alltitle');
		$this->modul_name = $this->lang->line('marketing_dashboard_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(),$this->lang->line('marketing_dashboard_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('marketing_dashboard/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('marketing_dashboard/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('marketing_dashboard/valid', $data, TRUE);
		$this->js_include .= $this->ui->js_include('flexigridMaster');
		$this->js_include .= $this->ui->load_css('flexigridMaster');
		$this->js_include .= $this->ui->load_css('MaterialIcons');
		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('custom_page');
		$this->js_include .= $this->ui->js_include('mask_money');
		//$this->css_include .= $this->ui->load_css('jquery_ui');
		$this->css_include .= $this->ui->load_css('custom_page');

		$data['title_page_table'] = $this->lang->line('marketing_dashboard_alltitle');

		$konten = $this->load->view('marketing_dashboard/index', $data, TRUE);
		$this->admin_view($konten);
	}
	
	public function print_report()
	{
		$data['title_page_table'] = $this->lang->line('marketing_dashboard_alltitle');

		$this->load->view('marketing_dashboard/report', $data);
	}
	
	public function table_summary_problem()
	{
		$this->marketing_dashboard->table_summary_problem();
	}
	
	public function select_data_sales_of_the_year()
	{
		$this->marketing_dashboard->sales_of_the_year();
	}
	
	public function select_data_sales_by_month()
	{
		$this->marketing_dashboard->sales_by_month();
	}
	
	public function select_data_sales_by_mkt()
	{
		$this->marketing_dashboard->sales_by_mkt();
	}
	
	public function select_data_sales_this_month()
	{
		$this->marketing_dashboard->sales_this_month();
	}
	
}
