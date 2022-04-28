<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class finance_forecast_income extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_finance_forecast_income', 'finance_forecast_income');
		$this->load->model('model_global');
		$this->lang->load('finance_forecast_income');
		$this->active_root_menu = $this->lang->line('finance_forecast_income_alltitle');
		$this->browser_title = $this->lang->line('finance_forecast_income_alltitle');
		$this->modul_name = $this->lang->line('finance_forecast_income_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(),$this->lang->line('finance_forecast_income_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('finance_forecast_income/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('finance_forecast_income/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('finance_forecast_income/valid', $data, TRUE);
		//$this->js_include .= $this->ui->js_include('flexigridMaster');
		//$this->js_include .= $this->ui->load_css('flexigridMaster');
		$this->js_include .= $this->ui->load_css('MaterialIcons');
		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('mask_money');
		$this->js_include .= $this->ui->js_include('dt_fixed_columns');
		$this->js_include .= $this->ui->js_include('select2');
		$this->js_include .= $this->ui->js_include('custom_page');
		//$this->css_include .= $this->ui->load_css('jquery_ui');
		$this->css_include .= $this->ui->load_css('custom_page');

		$data['title_page_table'] = $this->lang->line('finance_forecast_income_alltitle');
		//$data['update_view'] = $this->load->view('finance_forecast_income/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('finance_forecast_income/form', $data, TRUE);
		//$data['delete_view'] = $this->load->view('finance_forecast_income/delete', $data, TRUE);

		$konten = $this->load->view('finance_forecast_income/index', $data, TRUE);
		$this->admin_view($konten);
	}

	public function import()
	{
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(),$this->lang->line('finance_forecast_income_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('finance_invoice_approval/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('finance_forecast_income/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('finance_invoice_approval/valid', $data, TRUE);
		$this->js_include .= $this->ui->load_css('MaterialIcons');
		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('custom_page');
		$this->js_include .= $this->ui->js_include('mask_money');
		$this->css_include .= $this->ui->load_css('jquery_ui');
		$this->css_include .= $this->ui->load_css('custom_page');

		$data['title_page_table'] = $this->lang->line('finance_forecast_income_alltitle');

		$konten = $this->load->view('finance_forecast_income/import', $data, TRUE);
		$this->admin_view($konten);
	}
	
	public function get_data_table()
	{
		$this->finance_forecast_income->get_data_table();
	}
	
	public function insert_data()
	{
		echo $this->finance_forecast_income->insert();
	}
	
	public function select_data()
	{
		echo json_encode($this->finance_forecast_income->select());
	}
	
	public function edit_data()
	{
		echo $this->finance_forecast_income->update();
	}
	
	public function delete_data()
	{
		$id = $this->uri->segment(3);
		echo $this->finance_forecast_income->delete($id);
	}
	
}
