<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class finance_accounting_report_ald extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->helper('my_func_helper');
		$this->load->model('model_global', 'm_global');
		$this->load->model('model_finance_accounting_report_ald', 'finance_accounting_report_ald');
		$this->lang->load('finance_accounting_report_ald');
		$this->active_root_menu = $this->lang->line('finance_accounting_report_ald_alltitle');
		$this->browser_title = $this->lang->line('finance_accounting_report_ald_alltitle');
		$this->modul_name = $this->lang->line('finance_accounting_report_ald_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(),$this->lang->line('finance_accounting_report_ald_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('finance_accounting_report_ald/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('finance_accounting_report_ald/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('finance_accounting_report_ald/valid', $data, TRUE);
		$this->js_include .= $this->ui->js_include('flexigridMaster');
		$this->js_include .= $this->ui->load_css('flexigridMaster');
		$this->js_include .= $this->ui->load_css('MaterialIcons');
		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('custom_page');
		$this->js_include .= $this->ui->js_include('mask_money');
		//$this->css_include .= $this->ui->load_css('jquery_ui');
		$this->css_include .= $this->ui->load_css('custom_page');

		$data['title_page_table'] = $this->lang->line('finance_accounting_report_ald_alltitle');

		$konten = $this->load->view('finance_accounting_report_ald/index', $data, TRUE);
		$this->admin_view($konten);
	}
	
	public function print_report()
	{
		$data['title_page_table'] = $this->lang->line('finance_accounting_report_ald_alltitle');

		$this->load->view('finance_accounting_report_ald/report', $data);
	}
	
}
