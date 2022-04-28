<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class finance_bank extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_finance_bank', 'finance_bank');
		$this->lang->load('finance_bank');
		$this->active_root_menu = $this->lang->line('finance_bank_alltitle');
		$this->browser_title = $this->lang->line('finance_bank_alltitle');
		$this->modul_name = $this->lang->line('finance_bank_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(),$this->lang->line('finance_bank_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('finance_bank/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('finance_bank/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('finance_bank/valid', $data, TRUE);
		//$this->js_include .= $this->ui->js_include('flexigridMaster');
		//$this->js_include .= $this->ui->load_css('flexigridMaster');
		$this->js_include .= $this->ui->load_css('MaterialIcons');
		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('custom_page');
		$this->js_include .= $this->ui->js_include('mask_money');
		$this->js_include .= $this->ui->js_include('dt_fixed_columns');
		$this->js_include .= $this->ui->js_include('select2');
		$this->css_include .= $this->ui->load_css('jquery_ui');
		$this->css_include .= $this->ui->load_css('custom_page');

		$data['title_page_table'] = $this->lang->line('finance_bank_alltitle');
		//$data['update_view'] = $this->load->view('finance_bank/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('finance_bank/form', $data, TRUE);
		//$data['delete_view'] = $this->load->view('finance_bank/delete', $data, TRUE);

		$konten = $this->load->view('finance_bank/index', $data, TRUE);
		$this->admin_view($konten);
	}
	
	public function get_data_table()
	{
		$this->finance_bank->get_data_table();
	}
	
	public function insert_data()
	{
		echo $this->finance_bank->insert();
	}
	
	public function select_data()
	{
		echo json_encode($this->finance_bank->select());
	}
	
	public function edit_data()
	{
		echo $this->finance_bank->update();
	}
	
	public function delete_data()
	{
		$id = $this->uri->segment(3);
		echo $this->finance_bank->delete($id);
	}
	
}
