<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class teknis_dashboard extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_global');
		$this->load->model('model_teknis_dashboard', 'teknis_dashboard');
		$this->lang->load('teknis_dashboard');
		$this->active_root_menu = $this->lang->line('teknis_dashboard_alltitle');
		$this->browser_title = $this->lang->line('teknis_dashboard_alltitle');
		$this->modul_name = $this->lang->line('teknis_dashboard_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(),$this->lang->line('teknis_dashboard_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('teknis_dashboard/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('teknis_dashboard/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('teknis_dashboard/valid', $data, TRUE);
		$this->js_include .= $this->ui->js_include('flexigridMaster');
		$this->js_include .= $this->ui->load_css('flexigridMaster');
		$this->js_include .= $this->ui->load_css('MaterialIcons');
		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('custom_page');
		$this->js_include .= $this->ui->js_include('mask_money');
		//$this->css_include .= $this->ui->load_css('jquery_ui');
		$this->css_include .= $this->ui->load_css('custom_page');

		$data['title_page_table'] = $this->lang->line('teknis_dashboard_alltitle');

		$konten = $this->load->view('teknis_dashboard/index', $data, TRUE);
		$this->admin_view($konten);
	}
	
	public function print_report()
	{
		$data['title_page_table'] = $this->lang->line('teknis_dashboard_alltitle');

		$this->load->view('teknis_dashboard/report', $data);
	}
	
	public function select_data_monthly()
	{
		$this->teknis_dashboard->data_monthly();
	}
	
	public function donut_persentase_problem()
	{
		$this->teknis_dashboard->donut_persentase_problem();
	}
	
	public function donut_persentase_source_problem()
	{
		$this->teknis_dashboard->donut_persentase_source_problem();
	}
	
	public function select_data_cash_month()
	{
		$this->teknis_dashboard->cash_month();
	}
	
	public function select_data_sales_of_the_year()
	{
		$this->teknis_dashboard->sales_of_the_year();
	}
	
	public function bar_problem_by_category_customer()
	{
		$this->teknis_dashboard->bar_problem_by_category_customer();
	}
	
	public function bar_problem_by_external_internal()
	{
		$this->teknis_dashboard->bar_problem_by_external_internal();
	}
	
	public function bar_total_problem()
	{
		$this->teknis_dashboard->bar_total_problem();
	}
	
	public function select_data_expenses_divisi_this_month()
	{
		$this->teknis_dashboard->expenses_divisi_this_month();
	}
	
	public function select_data_expenses_vendor_this_month()
	{
		$this->teknis_dashboard->expenses_vendor_this_month();
	}
	
	public function select_data_gp_month()
	{
		$this->teknis_dashboard->gross_profit();
	}
	
	public function table_summary_problem()
	{
		$this->teknis_dashboard->table_summary_problem();
	}
	
	public function table_top_teen()
	{
		$this->teknis_dashboard->table_top_teen();
	}
	
}
