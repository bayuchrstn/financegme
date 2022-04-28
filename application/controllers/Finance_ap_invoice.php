<?php
defined('BASEPATH') or exit('No direct script access allowed');

class finance_ap_invoice extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_global', 'm_global');
		$this->load->model('model_finance_ap_invoice', 'finance_ap_invoice');
		$this->lang->load('finance_ap_invoice');
		$this->active_root_menu = $this->lang->line('finance_ap_invoice_alltitle');
		$this->browser_title = $this->lang->line('finance_ap_invoice_alltitle');
		$this->modul_name = $this->lang->line('finance_ap_invoice_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(), $this->lang->line('finance_ap_invoice_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('finance_ap_invoice/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('finance_ap_invoice/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('finance_ap_invoice/valid', $data, TRUE);
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
		$this->css_include .= $this->ui->load_css('toastr');
		$this->css_include .= $this->ui->load_css('custom_page');

		$data['title_page_table'] = $this->lang->line('finance_ap_invoice_alltitle');
		//$data['update_view'] = $this->load->view('finance_ap_invoice/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('finance_ap_invoice/form', $data, TRUE);
		//$data['delete_view'] = $this->load->view('finance_ap_invoice/delete', $data, TRUE);

		$konten = $this->load->view('finance_ap_invoice/index', $data, TRUE);
		$this->admin_view($konten);
	}

	public function get_data_table()
	{
		$this->finance_ap_invoice->get_data_table();
	}

	public function insert_data()
	{
		echo $this->finance_ap_invoice->insert();
	}

	public function insert_data_manual()
	{
		echo $this->finance_ap_invoice->insert_manual();
	}


	public function select_data()
	{
		echo json_encode($this->finance_ap_invoice->select());
	}

	public function edit_data()
	{
		echo $this->finance_ap_invoice->update();
	}

	public function edit_data_manual()
	{
		echo $this->finance_ap_invoice->update_manual();
	}

	public function delete_data()
	{
		$id = $this->uri->segment(3);
		echo $this->finance_ap_invoice->delete($id);
	}

	public function select_data_detail_invoice()
	{
		echo $this->finance_ap_invoice->select_data_detail_invoice();
	}

	public function select_autocomplite()
	{
		echo json_encode($this->finance_ap_invoice->select_autocomplite());
	}

	public function select_detail_ref()
	{
		echo $this->finance_ap_invoice->select_detail_ref($this->uri->segment(3), $this->uri->segment(4));
	}

	public function get_supplier()
	{
		$param = $this->input->post('searchTerm');
		if (!empty($param)) {
			echo $this->finance_ap_invoice->get_supp($param);
		} else {
			echo $this->finance_ap_invoice->get_supp();
		}
	}

	public function select_po()
	{
		echo json_encode($this->finance_ap_invoice->select_po());
	}

	public function select_po2()
	{
		echo json_encode($this->finance_ap_invoice->select_po2());
	}

	public function get_detail_barang()
	{
		echo $this->finance_ap_invoice->get_detail_barang();
	}

	function search_po()
	{
		echo json_encode($this->finance_ap_invoice->search_po());
	}

	function load_kd_jurnal()
	{
		echo $this->finance_ap_invoice->load_kd_jurnal();
	}

	function view_data()
	{
		echo json_encode($this->finance_ap_invoice->view_data());
	}
}
