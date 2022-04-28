<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class finance_customer_isolir extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('model_global', 'm_global');
        $this->load->model('model_finance_customer_isolir', 'finance_customer_isolir');
        $this->lang->load('finance_customer_isolir');
        $this->load->model('Kamus_model');
        $this->active_root_menu = $this->lang->line('finance_customer_isolir_alltitle');
        $this->browser_title = $this->lang->line('finance_customer_isolir_alltitle');
        $this->modul_name = $this->lang->line('finance_customer_isolir_alltitle');
        $this->css_include = '';
        $this->js_include = '';
        $this->js_inject = '';
    }

    public function index()
    {
        // $options = array();
        // $options['modul_code'] = 'bts';
        // $this->frame->main_crud($options);

        $this->breadcrumb = array('Home' => base_url(), $this->lang->line('finance_customer_isolir_alltitle') => '#');
        $data = array();

        //$this->js_inject .= $this->load->view('finance_customer_isolir/js_table', $data, TRUE);
        $this->js_inject .= $this->load->view('finance_customer_isolir/js', $data, TRUE);
        //$this->js_inject .= $this->load->view('finance_customer_isolir/valid', $data, TRUE);
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

        $data['title_page_table'] = $this->lang->line('finance_customer_isolir_alltitle');
        //$data['update_view'] = $this->load->view('finance_customer_isolir/update', $data, TRUE);
        $data['insert_view'] = $this->load->view('finance_customer_isolir/form', $data, TRUE);
        //$data['delete_view'] = $this->load->view('finance_customer_isolir/delete', $data, TRUE);

        $konten = $this->load->view('finance_customer_isolir/index', $data, TRUE);
        $this->admin_view($konten);
    }

    public function get_data_table()
    {
        $this->finance_customer_isolir->get_data_table();
    }

    public function insert_data()
    {
        echo $this->finance_customer_isolir->insert();
    }

    public function select_data()
    {
        echo json_encode($this->finance_customer_isolir->select());
    }

    public function edit_data()
    {
        echo $this->finance_customer_isolir->update();
    }

    public function delete_data()
    {
        $id = $this->uri->segment(3);
        echo $this->finance_customer_isolir->delete($id);
    }

    public function select_autocomplite()
    {
        echo json_encode($this->finance_customer_isolir->select_autocomplite());
    }

    public function get_cust_site()
	{
		echo $this->finance_customer_isolir->get_cust_site();
    }
    
    public function get_so($id)
	{
		echo $this->finance_customer_isolir->get_so($id);
	}
}
