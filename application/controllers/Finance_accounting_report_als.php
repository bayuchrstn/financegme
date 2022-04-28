<?php
defined('BASEPATH') or exit('No direct script access allowed');

class finance_accounting_report_als extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		//check_login();
		$this->load->helper('my_func_helper');
		$this->load->model('model_global', 'm_global');
		$this->load->model('model_finance_accounting_report_als', 'finance_accounting_report_als');
		$this->lang->load('finance_accounting_report_als');
		$this->active_root_menu = $this->lang->line('finance_accounting_report_als_alltitle');
		$this->browser_title = $this->lang->line('finance_accounting_report_als_alltitle');
		$this->modul_name = $this->lang->line('finance_accounting_report_als_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(), $this->lang->line('finance_accounting_report_als_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('finance_accounting_report_als/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('finance_accounting_report_als/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('finance_accounting_report_als/valid', $data, TRUE);
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

		$data['title_page_table'] = $this->lang->line('finance_accounting_report_als_alltitle');

		$konten = $this->load->view('finance_accounting_report_als/index', $data, TRUE);
		$this->admin_view($konten);
	}

	public function get_data_table()
	{
		$this->finance_accounting_report_als->get_data_table();
	}

	public function gmd_finance_coa_info()
	{
		echo $this->m_global->gmd_finance_coa_info($this->uri->segment(3));
	}

	public function print_report()
	{
		$data['title_page_table'] = $this->lang->line('finance_accounting_report_als_alltitle');

		$this->load->view('finance_accounting_report_als/report', $data);
	}

	public function get_card()
	{
		$this->finance_accounting_report_als->get_card();
	}
}
