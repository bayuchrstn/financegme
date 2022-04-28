<?php
defined('BASEPATH') or exit('No direct script access allowed');

class finance_report_invoice_customer extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_finance_report_invoice_customer', 'finance_report_invoice_customer');
		$this->load->model('model_global', 'm_global');
		$this->lang->load('finance_report_invoice_customer');
		$this->active_root_menu = $this->lang->line('finance_report_invoice_customer_alltitle');
		$this->browser_title = $this->lang->line('finance_report_invoice_customer_alltitle');
		$this->modul_name = $this->lang->line('finance_report_invoice_customer_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(), $this->lang->line('finance_report_invoice_customer_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('finance_report_invoice_customer/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('finance_report_invoice_customer/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('finance_report_invoice_customer/valid', $data, TRUE);
		$this->js_include .= $this->ui->load_css('MaterialIcons');
		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('mask_money');
		$this->js_include .= $this->ui->js_include('dt_fixed_columns');
		$this->js_include .= $this->ui->js_include('jszip');
		$this->js_include .= $this->ui->js_include('pdfmake');
		$this->js_include .= $this->ui->js_include('vfs_fonts');
		$this->js_include .= $this->ui->js_include('buttons');
		$this->js_include .= $this->ui->js_include('select2');
		$this->js_include .= $this->ui->js_include('custom_page');
		//$this->css_include .= $this->ui->load_css('jquery_ui');
		$this->css_include .= $this->ui->load_css('custom_page');

		$data['title_page_table'] = $this->lang->line('finance_report_invoice_customer_alltitle');

		$konten = $this->load->view('finance_report_invoice_customer/index', $data, TRUE);
		$this->admin_view($konten);
	}

	public function get_data_table()
	{
		$this->finance_report_invoice_customer->get_data_table();
	}

	public function print_report()
	{
		$data['title_page_table'] = $this->lang->line('finance_report_invoice_customer_alltitle');

		$this->load->view('finance_report_invoice_customer/report', $data);
	}
}
