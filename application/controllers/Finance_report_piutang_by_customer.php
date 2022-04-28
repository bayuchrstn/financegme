<?php
defined('BASEPATH') or exit('No direct script access allowed');

class finance_report_piutang_by_customer extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_finance_report_piutang_by_customer', 'finance_report_piutang_by_customer');
		$this->lang->load('finance_report_piutang_by_customer');
		$this->active_root_menu = $this->lang->line('finance_report_piutang_by_customer_alltitle');
		$this->browser_title = $this->lang->line('finance_report_piutang_by_customer_alltitle');
		$this->modul_name = $this->lang->line('finance_report_piutang_by_customer_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(), $this->lang->line('finance_report_piutang_by_customer_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('finance_report_piutang_by_customer/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('finance_report_piutang_by_customer/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('finance_report_piutang_by_customer/valid', $data, TRUE);
		$this->js_include .= $this->ui->js_include('flexigridMaster');
		$this->js_include .= $this->ui->load_css('flexigridMaster');
		$this->js_include .= $this->ui->load_css('MaterialIcons');
		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('custom_page');
		$this->js_include .= $this->ui->js_include('mask_money');
		$this->css_include .= $this->ui->load_css('jquery_ui');
		$this->css_include .= $this->ui->load_css('custom_page');

		$data['title_page_table'] = $this->lang->line('finance_report_piutang_by_customer_alltitle');

		$konten = $this->load->view('finance_report_piutang_by_customer/index', $data, TRUE);
		$this->admin_view($konten);
	}

	public function print_report()
	{
		$data['title_page_table'] = $this->lang->line('finance_report_piutang_by_customer_alltitle');

		$this->load->view('finance_report_piutang_by_customer/report', $data);
	}

	public function select_customer()
	{
		echo $this->finance_report_piutang_by_customer->select_customer();
	}
}
