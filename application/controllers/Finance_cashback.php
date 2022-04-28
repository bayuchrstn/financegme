<?php
defined('BASEPATH') or exit('No direct script access allowed');

class finance_cashback extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('model_global', 'm_global');
        $this->load->model('model_finance_cashback', 'finance_cashback');
        $this->lang->load('finance_cashback');
        $this->active_root_menu = $this->lang->line('finance_cashback_alltitle');
        $this->browser_title = $this->lang->line('finance_cashback_alltitle');
        $this->modul_name = $this->lang->line('finance_cashback_alltitle');
        $this->css_include = '';
        $this->js_include = '';
        $this->js_inject = '';
    }

    public function index()
    {
        // $options = array();
        // $options['modul_code'] = 'bts';
        // $this->frame->main_crud($options);

        $this->breadcrumb = array('Home' => base_url(), $this->lang->line('finance_cashback_alltitle') => '#');
        $data = array();

        //$this->js_inject .= $this->load->view('finance_customer/js_table', $data, TRUE);
        $this->js_inject .= $this->load->view('finance_cashback/js', $data, TRUE);
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

        $data['title_page_table'] = $this->lang->line('finance_cashback_alltitle');
        //$data['update_view'] = $this->load->view('finance_customer/update', $data, TRUE);
        $data['insert_view'] = $this->load->view('finance_cashback/form', $data, TRUE);
        //$data['delete_view'] = $this->load->view('finance_customer/delete', $data, TRUE);

        $konten = $this->load->view('finance_cashback/index', $data, TRUE);
        $this->admin_view($konten);
    }

    public function get_data_table()
    {
        $this->finance_cashback->get_data_table();
    }

    public function select_data()
    {
        echo json_encode($this->finance_cashback->select());
    }

    public function insert_data()
    {
        echo $this->finance_cashback->insert();
    }

    function get_coa()
    {
        if (!empty($this->input->post('searchTerm'))) {
            $list = $this->finance_cashback->select_autocomplite_coa_id($this->input->post('searchTerm'));
        } else {
            $list = $this->finance_cashback->select_autocomplite_coa_id($id = '');
        }
        $data = array();
        foreach ($list as $row) {
            $data[] = array("id" => $row->id, "text" => $row->id . " - " . $row->nama);
        }
        echo json_encode($data);
    }
}
