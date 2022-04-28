<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class finance_tax_report_faktur extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_finance_tax_report_faktur', 'finance_tax_report_faktur');
		$this->load->model('model_global');
		$this->lang->load('finance_tax_report_faktur');
		$this->active_root_menu = $this->lang->line('finance_tax_report_faktur_alltitle');
		$this->browser_title = $this->lang->line('finance_tax_report_faktur_alltitle');
		$this->modul_name = $this->lang->line('finance_tax_report_faktur_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(),$this->lang->line('finance_tax_report_faktur_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('finance_tax_report_faktur/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('finance_tax_report_faktur/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('finance_tax_report_faktur/valid', $data, TRUE);
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

		$data['title_page_table'] = $this->lang->line('finance_tax_report_faktur_alltitle');

		$konten = $this->load->view('finance_tax_report_faktur/index', $data, TRUE);
		$this->admin_view($konten);
	}
	
	public function get_data_table()
	{
		$this->finance_tax_report_faktur->get_data_table();
	}
	
}
