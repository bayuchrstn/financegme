<?php
defined('BASEPATH') or exit('No direct script access allowed');

class finance_coa extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_finance_coa', 'finance_coa');
		$this->load->model('model_global', 'm_global');
		$this->lang->load('finance_coa');
		$this->active_root_menu = $this->lang->line('finance_coa_alltitle');
		$this->browser_title = $this->lang->line('finance_coa_alltitle');
		$this->modul_name = $this->lang->line('finance_coa_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(), $this->lang->line('finance_coa_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('finance_coa/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('finance_coa/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('finance_coa/valid', $data, TRUE);
		$this->js_include .= $this->ui->js_include('flexigridMaster');
		$this->js_include .= $this->ui->load_css('flexigridMaster');
		$this->js_include .= $this->ui->load_css('MaterialIcons');
		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('custom_page');
		$this->js_include .= $this->ui->js_include('mask_money');
		$this->css_include .= $this->ui->load_css('jquery_ui');
		$this->css_include .= $this->ui->load_css('custom_page');

		$data['title_page_table'] = $this->lang->line('finance_coa_alltitle');
		//$data['update_view'] = $this->load->view('finance_coa/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('finance_coa/form', $data, TRUE);
		//$data['delete_view'] = $this->load->view('finance_coa/delete', $data, TRUE);

		$konten = $this->load->view('finance_coa/index', $data, TRUE);
		$this->admin_view($konten);
	}

	public function get_data_table()
	{
		echo $this->finance_coa->get_data_table();
	}

	public function insert_data()
	{
		echo $this->finance_coa->insert();
	}

	public function insert_injectcoa()
	{
		$this->finance_coa->insert_injectcoa();
	}

	public function select_data()
	{
		echo json_encode($this->finance_coa->select());
	}

	public function edit_data()
	{
		echo $this->finance_coa->update();
	}

	public function delete_data()
	{
		$id = $this->uri->segment(3);
		echo $this->finance_coa->delete($id);
	}

	public function select_parent()
	{
		echo $this->finance_coa->select_parent($this->uri->segment(3), $this->uri->segment(4), $this->uri->segment(5));
	}

	public function get_number_type()
	{
		echo json_encode($this->finance_coa->get_number_type($this->uri->segment(3)));
	}
}
