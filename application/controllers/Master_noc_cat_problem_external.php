<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class master_noc_cat_problem_external extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_master_noc_cat_problem_external', 'master_noc_cat_problem_external');
		$this->lang->load('master_noc_cat_problem_external');
		$this->active_root_menu = $this->lang->line('master_noc_cat_problem_external_alltitle');
		$this->browser_title = $this->lang->line('master_noc_cat_problem_external_alltitle');
		$this->modul_name = $this->lang->line('master_noc_cat_problem_external_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(),$this->lang->line('master_noc_cat_problem_external_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('master_noc_cat_problem_external/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('master_noc_cat_problem_external/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('master_noc_cat_problem_external/valid', $data, TRUE);
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

		$data['title_page_table'] = $this->lang->line('master_noc_cat_problem_external_alltitle');
		//$data['update_view'] = $this->load->view('master_noc_cat_problem_external/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('master_noc_cat_problem_external/form', $data, TRUE);
		//$data['delete_view'] = $this->load->view('master_noc_cat_problem_external/delete', $data, TRUE);

		$konten = $this->load->view('master_noc_cat_problem_external/index', $data, TRUE);
		$this->admin_view($konten);
	}
	
	public function get_data_table()
	{
		$this->master_noc_cat_problem_external->get_data_table();
	}
	
	public function insert_data()
	{
		echo $this->master_noc_cat_problem_external->insert();
	}
	
	public function select_data()
	{
		echo json_encode($this->master_noc_cat_problem_external->select());
	}
	
	public function edit_data()
	{
		echo $this->master_noc_cat_problem_external->update();
	}
	
	public function delete_data()
	{
		$id = $this->uri->segment(3);
		echo $this->master_noc_cat_problem_external->delete($id);
	}
	
}
