<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class finance_transaksi_kasir_in extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_finance_transaksi_kasir_in', 'finance_transaksi_kasir_in');
		$this->load->model('model_global');
		$this->lang->load('finance_transaksi_kasir_in');
		$this->active_root_menu = $this->lang->line('finance_transaksi_kasir_in_alltitle');
		$this->browser_title = $this->lang->line('finance_transaksi_kasir_in_alltitle');
		$this->modul_name = $this->lang->line('finance_transaksi_kasir_in_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(),$this->lang->line('finance_transaksi_kasir_in_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('finance_transaksi_kasir_in/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('finance_transaksi_kasir_in/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('finance_transaksi_kasir_in/valid', $data, TRUE);
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

		$data['title_page_table'] = $this->lang->line('finance_transaksi_kasir_in_alltitle');
		//$data['update_view'] = $this->load->view('finance_transaksi_kasir_in/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('finance_transaksi_kasir_in/form', $data, TRUE);
		//$data['delete_view'] = $this->load->view('finance_transaksi_kasir_in/delete', $data, TRUE);

		$konten = $this->load->view('finance_transaksi_kasir_in/index', $data, TRUE);
		$this->admin_view($konten);
	}
	
	public function get_data_table()
	{
		$this->finance_transaksi_kasir_in->get_data_table();
	}
	
	public function insert_data()
	{
		echo $this->finance_transaksi_kasir_in->insert();
	}
	
	public function select_data()
	{
		echo json_encode($this->finance_transaksi_kasir_in->select());
	}
	
	public function edit_data()
	{
		echo $this->finance_transaksi_kasir_in->update();
	}
	
	public function delete_data()
	{
		$id = $this->uri->segment(3);
		echo $this->finance_transaksi_kasir_in->delete($id);
	}
	
	public function select_autocomplite()
	{
		echo json_encode($this->finance_transaksi_kasir_in->select_autocomplite());
	}
	
	public function select_detail_ref()
	{
		echo $this->finance_transaksi_kasir_in->select_detail_ref($this->uri->segment(3),$this->uri->segment(4));
	}
	
}
