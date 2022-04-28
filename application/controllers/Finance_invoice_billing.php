<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class finance_invoice_billing extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_global', 'm_global');
		$this->load->model('model_finance_invoice_billing', 'finance_invoice_billing');
		$this->lang->load('finance_invoice_billing');
		$this->active_root_menu = $this->lang->line('finance_invoice_billing_alltitle');
		$this->browser_title = $this->lang->line('finance_invoice_billing_alltitle');
		$this->modul_name = $this->lang->line('finance_invoice_billing_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(), $this->lang->line('finance_invoice_billing_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('finance_invoice_billing/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('finance_invoice_billing/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('finance_invoice_billing/valid', $data, TRUE);
		//$this->js_include .= $this->ui->js_include('flexigridMaster');
		//$this->js_include .= $this->ui->load_css('flexigridMaster');
		$this->js_include .= $this->ui->load_css('MaterialIcons');
		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('mask_money');
		$this->js_include .= $this->ui->js_include('dt_fixed_columns');
		$this->js_include .= $this->ui->js_include('select2');
		$this->js_include .= $this->ui->js_include('custom_page');
		$this->js_include .= $this->ui->js_include('toastr');
		//$this->css_include .= $this->ui->load_css('jquery_ui');
		$this->css_include .= $this->ui->load_css('custom_page');
		$this->css_include .= $this->ui->load_css('toastr');

		$data['title_page_table'] = $this->lang->line('finance_invoice_billing_alltitle');
		//$data['update_view'] = $this->load->view('finance_invoice_billing/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('finance_invoice_billing/form', $data, TRUE);
		//$data['delete_view'] = $this->load->view('finance_invoice_billing/delete', $data, TRUE);

		$konten = $this->load->view('finance_invoice_billing/index', $data, TRUE);
		$this->admin_view($konten);
	}

	public function get_data_table()
	{
		$this->finance_invoice_billing->get_data_table();
	}

	public function insert_data()
	{
		echo $this->finance_invoice_billing->insert();
	}

	public function select_data()
	{
		echo json_encode($this->finance_invoice_billing->select());
	}

	public function edit_data()
	{
		echo $this->finance_invoice_billing->update();
	}

	public function delete_data()
	{
		$id = $this->uri->segment(3);
		echo $this->finance_invoice_billing->delete($id);
	}

	public function select_autocomplite()
	{
		echo json_encode($this->finance_invoice_billing->select_autocomplite());
	}

	public function select_detail_ref()
	{
		$this->finance_invoice_billing->select_detail_ref($this->uri->segment(3));
	}

	function get_coa()
	{
		if (!empty($this->input->post('searchTerm'))) {
			$list = $this->finance_invoice_billing->select_autocomplite_coa_id($this->input->post('searchTerm'));
		} else {
			$list = $this->finance_invoice_billing->select_autocomplite_coa_idfull();
		}
		$data = array();
		foreach ($list as $row) {
			$data[] = array("id" => $row->id, "text" => $row->id . " - " . $row->nama);
		}
		echo json_encode($data);
	}

	function get_card($id)
	{
		if (!empty($this->input->post('searchTerm'))) {
			$list = $this->finance_invoice_billing->select_autocomplite_card_id($this->input->post('searchTerm'), $id);
		} else {
			$list = $this->finance_invoice_billing->select_autocomplite_card_full($id);
		}
		$data = array();
		foreach ($list as $row) {
			$data[] = array("id" => $row->id, "text" => $row->nama);
		}
		echo json_encode($data);
	}
}
