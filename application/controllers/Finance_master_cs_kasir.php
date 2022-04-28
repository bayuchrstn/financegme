<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class finance_master_cs_kasir extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_global');
		$this->load->model('model_finance_master_cs_kasir', 'finance_master_cs_kasir');
		$this->lang->load('finance_master_cs_kasir');
		$this->active_root_menu = $this->lang->line('finance_master_cs_kasir_alltitle');
		$this->browser_title = $this->lang->line('finance_master_cs_kasir_alltitle');
		$this->modul_name = $this->lang->line('finance_master_cs_kasir_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(),$this->lang->line('finance_master_cs_kasir_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('finance_master_cs_kasir/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('finance_master_cs_kasir/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('finance_master_cs_kasir/valid', $data, TRUE);
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

		$data['title_page_table'] = $this->lang->line('finance_master_cs_kasir_alltitle');
		//$data['update_view'] = $this->load->view('finance_master_cs_kasir/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('finance_master_cs_kasir/form', $data, TRUE);
		//$data['delete_view'] = $this->load->view('finance_master_cs_kasir/delete', $data, TRUE);

		$konten = $this->load->view('finance_master_cs_kasir/index', $data, TRUE);
		$this->admin_view($konten);
	}
	
	public function get_data_table()
	{
		$this->finance_master_cs_kasir->get_data_table();
	}
	
	public function insert_data()
	{
		echo $this->finance_master_cs_kasir->insert();
	}
	
	public function select_data()
	{
		echo json_encode($this->finance_master_cs_kasir->select());
	}
	
	public function edit_data()
	{
		echo $this->finance_master_cs_kasir->update();
	}
	
	public function delete_data()
	{
		$id = $this->uri->segment(3);
		echo $this->finance_master_cs_kasir->delete($id);
	}
	
}
