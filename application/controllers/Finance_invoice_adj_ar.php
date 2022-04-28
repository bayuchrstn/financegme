<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class finance_invoice_adj_ar extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->helper('my_func_helper');
		$this->load->model('model_global', 'm_global');
		$this->load->model('model_finance_invoice_adj_ar', 'finance_invoice_adj_ar');
		$this->lang->load('finance_invoice_adj_ar');
		$this->active_root_menu = $this->lang->line('finance_invoice_adj_ar_alltitle');
		$this->browser_title = $this->lang->line('finance_invoice_adj_ar_alltitle');
		$this->modul_name = $this->lang->line('finance_invoice_adj_ar_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(),$this->lang->line('finance_invoice_adj_ar_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('finance_invoice_adj_ar/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('finance_invoice_adj_ar/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('finance_invoice_adj_ar/valid', $data, TRUE);
		//$this->js_include .= $this->ui->js_include('flexigridMaster');
		//$this->js_include .= $this->ui->load_css('flexigridMaster');
		$this->js_include .= $this->ui->load_css('MaterialIcons');
		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('custom_page');
		$this->js_include .= $this->ui->js_include('dt_fixed_columns');
		$this->js_include .= $this->ui->js_include('jszip');
		$this->js_include .= $this->ui->js_include('pdfmake');
		$this->js_include .= $this->ui->js_include('vfs_fonts');
		$this->js_include .= $this->ui->js_include('buttons');
		$this->js_include .= $this->ui->js_include('select2');
		$this->js_include .= $this->ui->js_include('mask_money');
		//$this->css_include .= $this->ui->load_css('jquery_ui');
		$this->css_include .= $this->ui->load_css('custom_page');

		$data['title_page_table'] = $this->lang->line('finance_invoice_adj_ar_alltitle');
		//$data['update_view'] = $this->load->view('finance_invoice_adj_ar/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('finance_invoice_adj_ar/form', $data, TRUE);
		//$data['delete_view'] = $this->load->view('finance_invoice_adj_ar/delete', $data, TRUE);

		$konten = $this->load->view('finance_invoice_adj_ar/index', $data, TRUE);
		$this->admin_view($konten);
	}
	
	public function get_data_table()
	{
		$this->finance_invoice_adj_ar->get_data_table();
	}
	
	public function insert_data()
	{
		echo $this->finance_invoice_adj_ar->insert();
	}
	
	public function select_data()
	{
		echo json_encode($this->finance_invoice_adj_ar->select());
	}
	
	public function edit_data()
	{
		echo $this->finance_invoice_adj_ar->update();
	}
	
	public function delete_data()
	{
		$id = $this->uri->segment(3);
		echo $this->finance_invoice_adj_ar->delete($id);
	}
	
	public function select_autocomplite_service()
	{
		echo json_encode($this->finance_invoice_adj_ar->select_autocomplite_service());
	}
	
	public function select_autocomplite_service_add()
	{
		$id = $this->uri->segment(3);
		echo $this->finance_invoice_adj_ar->select_autocomplite_service_add($id);
	}
	
	public function select_autocomplite_customer()
	{
		echo json_encode($this->finance_invoice_adj_ar->select_autocomplite_customer());
	}
	
	public function select_data_detail_invoice()
	{
		echo $this->finance_invoice_adj_ar->select_data_detail_invoice();
	}
	
	public function invoice_info()
	{
		$this->finance_invoice_adj_ar->invoice_info();
	}
	
	public function invoice_create()
	{
		set_time_limit(0);
		echo $this->finance_invoice_adj_ar->invoice_create();
		//echo 2;
	}
	
	public function invoice_delete()
	{
		echo $this->finance_invoice_adj_ar->invoice_delete();
	}
	
	
	public function invoice_belum_edit()
	{
		$id = $this->uri->segment(3);
		echo $this->finance_invoice_adj_ar->invoice_belum_edit($id);
	}
	
	public function invoice_sudah_edit()
	{
		$id = $this->uri->segment(3);
		echo $this->finance_invoice_adj_ar->invoice_sudah_edit($id);
	}
	
	
	public function invoice_sudah_approve()
	{
		$id = $this->uri->segment(3);
		echo $this->finance_invoice_adj_ar->invoice_sudah_approve($id);
	}
	
	
	public function invoice_sudah_print()
	{
		$id = $this->uri->segment(3);
		echo $this->finance_invoice_adj_ar->invoice_sudah_print($id);
	}
	
	public function qrcode($qr_image, $value = 'gmedia')
	{
		$this->load->library('ciqrcode');
		$qr_image = $qr_image.'.png';
		$params['data'] = $value;
		$params['level'] = 'H';
		$params['size'] = 3;
		$params['savename'] = "assets/images/".$qr_image;
        $this->ciqrcode->generate($params);
	}
	
}
