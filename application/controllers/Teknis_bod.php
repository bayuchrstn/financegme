<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class teknis_bod extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->helper('my_func_helper');
		$this->load->model('model_global', 'm_global');
		$this->load->model('model_teknis_bod', 'teknis_bod');
		$this->lang->load('teknis_bod');
		$this->active_root_menu = $this->lang->line('teknis_bod_alltitle');
		$this->browser_title = $this->lang->line('teknis_bod_alltitle');
		$this->modul_name = $this->lang->line('teknis_bod_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(),$this->lang->line('teknis_bod_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('teknis_bod/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('teknis_bod/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('teknis_bod/valid', $data, TRUE);
		//$this->js_include .= $this->ui->js_include('flexigridMaster');
		//$this->js_include .= $this->ui->load_css('flexigridMaster');
		$this->js_include .= $this->ui->load_css('MaterialIcons');
		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('custom_page');
		$this->js_include .= $this->ui->js_include('mask_money');
		$this->js_include .= $this->ui->js_include('dt_fixed_columns');
		$this->js_include .= $this->ui->js_include('select2');
		$this->js_include .= $this->ui->js_include('time_picker');
		$this->css_include .= $this->ui->load_css('time_picker');
		//$this->css_include .= $this->ui->load_css('jquery_ui');
		$this->css_include .= $this->ui->load_css('custom_page');

		$data['title_page_table'] = $this->lang->line('teknis_bod_alltitle');
		//$data['update_view'] = $this->load->view('teknis_bod/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('teknis_bod/form', $data, TRUE);
		//$data['delete_view'] = $this->load->view('teknis_bod/delete', $data, TRUE);

		$konten = $this->load->view('teknis_bod/index', $data, TRUE);
		$this->admin_view($konten);
	}
	
	public function get_data_table()
	{
		$this->teknis_bod->get_data_table();
	}
	
	public function insert_data()
	{
		echo $this->teknis_bod->insert();
	}
	
	public function select_data()
	{
		echo json_encode($this->teknis_bod->select());
	}
	
	public function edit_data()
	{
		echo $this->teknis_bod->update();
	}
	
	public function delete_data()
	{
		$id = $this->uri->segment(3);
		$task_id = $this->uri->segment(4);
		echo $this->teknis_bod->delete($id, $task_id);
	}
	
	public function select_autocomplite()
	{
		echo json_encode($this->teknis_bod->select_autocomplite());
	}
	
	public function cek_email_on()
	{
		echo $this->teknis_bod->cek_email_on();
	}
	
	public function cek_email_off()
	{
		echo $this->teknis_bod->cek_email_off();
	}
	
}
