<?php
defined('BASEPATH') or exit('No direct script access allowed');

class finance_coa_general_ledger extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_global', 'm_global');
		$this->load->model('model_finance_coa_general_ledger', 'finance_coa_general_ledger');
		$this->lang->load('finance_coa_general_ledger');
		$this->active_root_menu = $this->lang->line('finance_coa_general_ledger_alltitle');
		$this->browser_title = $this->lang->line('finance_coa_general_ledger_alltitle');
		$this->modul_name = $this->lang->line('finance_coa_general_ledger_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(), $this->lang->line('finance_coa_general_ledger_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('finance_coa_general_ledger/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('finance_coa_general_ledger/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('finance_coa_general_ledger/valid', $data, TRUE);
		//$this->js_include .= $this->ui->js_include('flexigridMaster');
		//$this->js_include .= $this->ui->load_css('flexigridMaster');
		$this->js_include .= $this->ui->load_css('MaterialIcons');
		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('custom_page');
		$this->js_include .= $this->ui->js_include('dt_fixed_columns');
		$this->js_include .= $this->ui->js_include('select2');
		$this->js_include .= $this->ui->js_include('mask_money');
		$this->js_include .= $this->ui->js_include('toastr');
		//$this->css_include .= $this->ui->load_css('jquery_ui');
		$this->css_include .= $this->ui->load_css('custom_page');
		$this->css_include .= $this->ui->load_css('toastr');

		$data['title_page_table'] = $this->lang->line('finance_coa_general_ledger_alltitle');
		//$data['update_view'] = $this->load->view('finance_coa_general_ledger/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('finance_coa_general_ledger/form', $data, TRUE);
		//$data['delete_view'] = $this->load->view('finance_coa_general_ledger/delete', $data, TRUE);

		$konten = $this->load->view('finance_coa_general_ledger/index', $data, TRUE);
		$this->admin_view($konten);
	}

	public function get_data_table()
	{
		$this->finance_coa_general_ledger->get_data_table();
	}

	public function insert_data()
	{
		echo $this->finance_coa_general_ledger->insert();
	}

	public function select_data()
	{
		echo json_encode($this->finance_coa_general_ledger->select());
	}

	public function inject_data()
	{
		echo json_encode($this->finance_coa_general_ledger->inject());
	}

	public function edit_data()
	{
		echo $this->finance_coa_general_ledger->update();
	}

	public function delete_data()
	{
		echo $this->finance_coa_general_ledger->delete();
	}

	public function select_data_detail_invoice()
	{
		echo $this->finance_coa_general_ledger->select_data_detail_invoice();
	}

	public function select_autocomplite_coa_id()
	{
		echo json_encode($this->m_global->select_autocomplite_coa_id());
	}

	public function select_card()
	{
		echo $this->finance_coa_general_ledger->select_card();
	}

	public function select_card_name()
	{
		echo $this->finance_coa_general_ledger->select_card_name();
	}

	public function get_card()
	{
		$this->finance_coa_general_ledger->get_card();
	}
}
