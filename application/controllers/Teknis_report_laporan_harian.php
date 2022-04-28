<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class teknis_report_laporan_harian extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->helper('my_func_helper');
		$this->load->model('model_teknis_report_laporan_harian', 'teknis_report_laporan_harian');
		$this->load->model('model_global', 'm_global');
		$this->lang->load('teknis_report_laporan_harian');
		$this->active_root_menu = $this->lang->line('teknis_report_laporan_harian_alltitle');
		$this->browser_title = $this->lang->line('teknis_report_laporan_harian_alltitle');
		$this->modul_name = $this->lang->line('teknis_report_laporan_harian_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(),$this->lang->line('teknis_report_laporan_harian_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('teknis_report_laporan_harian/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('teknis_report_laporan_harian/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('teknis_report_laporan_harian/valid', $data, TRUE);
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

		$data['title_page_table'] = $this->lang->line('teknis_report_laporan_harian_alltitle');

		$konten = $this->load->view('teknis_report_laporan_harian/index', $data, TRUE);
		$this->admin_view($konten);
	}
	
	public function get_data_table()
	{
		$this->teknis_report_laporan_harian->get_data_table();
	}
	
	public function get_data_info()
	{
		$this->teknis_report_laporan_harian->get_data_info();
	}
	
}
