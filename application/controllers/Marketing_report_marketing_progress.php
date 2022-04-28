<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class marketing_report_marketing_progress extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_marketing_report_marketing_progress', 'marketing_report_marketing_progress');
		$this->load->model('model_global', 'm_global');
		$this->lang->load('marketing_report_marketing_progress');
		$this->active_root_menu = $this->lang->line('marketing_report_marketing_progress_alltitle');
		$this->browser_title = $this->lang->line('marketing_report_marketing_progress_alltitle');
		$this->modul_name = $this->lang->line('marketing_report_marketing_progress_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(),$this->lang->line('marketing_report_marketing_progress_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('marketing_report_marketing_progress/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('marketing_report_marketing_progress/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('marketing_report_marketing_progress/valid', $data, TRUE);
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

		$data['title_page_table'] = $this->lang->line('marketing_report_marketing_progress_alltitle');

		$konten = $this->load->view('marketing_report_marketing_progress/index', $data, TRUE);
		$this->admin_view($konten);
	}
	
	public function get_data_table()
	{
		$this->marketing_report_marketing_progress->get_data_table();
	}
	
}
