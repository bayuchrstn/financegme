<?php
defined('BASEPATH') or exit('No direct script access allowed');

class finance_invoice_dp extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('model_global', 'm_global');
        $this->load->model('model_finance_invoice_dp', 'finance_invoice_dp');
        $this->lang->load('finance_invoice_dp');
        $this->active_root_menu = $this->lang->line('finance_invoice_dp_alltitle');
        $this->browser_title = $this->lang->line('finance_invoice_dp_alltitle');
        $this->modul_name = $this->lang->line('finance_invoice_dp_alltitle');
        $this->css_include = '';
        $this->js_include = '';
        $this->js_inject = '';
    }

    public function index()
    {
        // $options = array();
        // $options['modul_code'] = 'bts';
        // $this->frame->main_crud($options);

        $this->breadcrumb = array('Home' => base_url(), $this->lang->line('finance_invoice_dp_alltitle') => '#');
        $data = array();

        //$this->js_inject .= $this->load->view('finance_customer/js_table', $data, TRUE);
        $this->js_inject .= $this->load->view('finance_invoice_dp/js', $data, TRUE);
        //$this->js_inject .= $this->load->view('finance_customer/valid', $data, TRUE);
        //$this->js_include .= $this->ui->js_include('flexigridMaster');
        //$this->js_include .= $this->ui->load_css('flexigridMaster');
        $this->js_include .= $this->ui->load_css('MaterialIcons');
        $this->js_include .= $this->ui->js_include('jquery_ui');
        $this->js_include .= $this->ui->js_include('custom_page');
        $this->js_include .= $this->ui->js_include('select2');

        $this->js_include .= $this->ui->js_include('toastr');
        $this->js_include .= $this->ui->js_include('mask_money');
        $this->css_include .= $this->ui->load_css('custom_page');
        $this->css_include .= $this->ui->load_css('toastr');
        $this->js_include .= $this->ui->js_include('datatable_biasa');
        $this->css_include .= $this->ui->load_css('datatable_css');

        $data['title_page_table'] = $this->lang->line('finance_invoice_dp_alltitle');
        //$data['update_view'] = $this->load->view('finance_customer/update', $data, TRUE);
        $data['insert_view'] = $this->load->view('finance_invoice_dp/form', $data, TRUE);
        //$data['delete_view'] = $this->load->view('finance_customer/delete', $data, TRUE);

        $konten = $this->load->view('finance_invoice_dp/index', $data, TRUE);
        $this->admin_view($konten);
    }

    public function get_data_table()
    {
        $this->finance_invoice_dp->get_data_table();
    }

    public function select_data()
    {
        $this->finance_invoice_dp->select();
    }
}
