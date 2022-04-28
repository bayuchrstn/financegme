<?php
defined('BASEPATH') or exit('No direct script access allowed');

class finance_dashboard extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_global');
		$this->load->model('model_finance_dashboard', 'finance_dashboard');
		$this->lang->load('finance_dashboard');
		$this->active_root_menu = $this->lang->line('finance_dashboard_alltitle');
		$this->browser_title = $this->lang->line('finance_dashboard_alltitle');
		$this->modul_name = $this->lang->line('finance_dashboard_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(), $this->lang->line('finance_dashboard_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('finance_dashboard/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('finance_dashboard/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('finance_dashboard/valid', $data, TRUE);
		$this->js_include .= $this->ui->js_include('flexigridMaster');
		$this->js_include .= $this->ui->load_css('flexigridMaster');
		$this->js_include .= $this->ui->load_css('MaterialIcons');
		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('custom_page');
		$this->js_include .= $this->ui->js_include('mask_money');
		//$this->css_include .= $this->ui->load_css('jquery_ui');
		$this->css_include .= $this->ui->load_css('custom_page');

		$data['title_page_table'] = $this->lang->line('finance_dashboard_alltitle');

		$konten = $this->load->view('finance_dashboard/index', $data, TRUE);
		$this->admin_view($konten);
	}

	public function print_report()
	{
		$data['title_page_table'] = $this->lang->line('finance_dashboard_alltitle');

		$this->load->view('finance_dashboard/report', $data);
	}

	public function select_data_monthly()
	{
		$this->finance_dashboard->data_monthly();
	}

	public function select_data_ap_month()
	{
		$this->finance_dashboard->ap_month();
	}

	public function select_data_cash_month()
	{
		$this->finance_dashboard->cash_month();
	}

	public function select_data_sales_of_the_year()
	{
		$this->finance_dashboard->sales_of_the_year();
	}

	public function select_data_income_expenses()
	{
		$this->finance_dashboard->income_expenses();
	}

	public function select_data_sales_this_month()
	{
		$this->finance_dashboard->sales_this_month();
	}

	public function select_data_expenses_divisi_this_month()
	{
		$this->finance_dashboard->expenses_divisi_this_month();
	}

	public function select_data_expenses_vendor_this_month()
	{
		$this->finance_dashboard->expenses_vendor_this_month();
	}

	public function select_data_forecast_income_this_month()
	{
		$this->finance_dashboard->forecast_income_this_month();
	}

	public function select_data_forecast_expenses_this_month()
	{
		$this->finance_dashboard->forecast_expenses_this_month();
	}

	public function select_data_expenses_fixcost_this_month()
	{
		$this->finance_dashboard->expenses_fixcost_this_month();
	}

	public function select_data_gp_month()
	{
		$this->finance_dashboard->gross_profit();
	}
}
