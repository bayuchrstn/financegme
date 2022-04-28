<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ticket_open extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_global', 'm_global');
		$this->load->model('model_ticket_open', 'ticket_open');
		$this->lang->load('ticket_open');
		$this->active_root_menu = $this->lang->line('ticket_open_alltitle');
		$this->browser_title = $this->lang->line('ticket_open_alltitle');
		$this->modul_name = $this->lang->line('ticket_open_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(),$this->lang->line('ticket_open_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('ticket_open/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('ticket_open/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('ticket_open/valid', $data, TRUE);
		//$this->js_include .= $this->ui->js_include('flexigridMaster');
		//$this->js_include .= $this->ui->load_css('flexigridMaster');
		$this->js_include .= $this->ui->load_css('MaterialIcons');
		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('custom_page');
		$this->js_include .= $this->ui->js_include('mask_money');
		$this->js_include .= $this->ui->js_include('dt_fixed_columns');
		$this->js_include .= $this->ui->js_include('select2');
		$this->js_include .= $this->ui->js_include('form_select2');
		$this->css_include .= $this->ui->load_css('jquery_ui');
		$this->css_include .= $this->ui->load_css('custom_page');

		$data['title_page_table'] = $this->lang->line('ticket_open_alltitle');
		//$data['update_view'] = $this->load->view('ticket_open/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('ticket_open/form', $data, TRUE);
		//$data['delete_view'] = $this->load->view('ticket_open/delete', $data, TRUE);

		$konten = $this->load->view('ticket_open/index', $data, TRUE);
		$this->admin_view($konten);
	}
	
	public function get_data_table()
	{
		$this->ticket_open->get_data_table();
	}
	
	public function insert_data()
	{
		echo $this->ticket_open->insert();
	}
	
	public function select_data()
	{
		echo json_encode($this->ticket_open->select());
	}
	
	public function edit_data()
	{
		echo $this->ticket_open->update();
	}
	
	public function get_detail_lokasi()
	{
		$data = '<option value=""></option>';
		$q = $this->m_global->get_detail_lokasi($this->uri->segment(3));
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$data .= '<option value="'.$r['id'].'">'.$r['nama'].'</option>';
			}
		}
		echo $data;
	}
	
	public function delete_data()
	{
		$id = $this->uri->segment(3);
		echo $this->ticket_open->delete($id);
	}
	
	public function closed_data()
	{
		$id = $this->uri->segment(3);
		echo $this->ticket_open->closed_data($id);
	}
	
	public function insert_comment()
	{
		echo $this->ticket_open->insert_comment();
	}
	
	public function get_comment()
	{
		echo $this->ticket_open->get_timeline($this->input->post('up_default'));
	}
	
	public function change_question()
	{
		echo $this->ticket_open->change_question($this->uri->segment(3), $this->uri->segment(4));
	}
	
}
