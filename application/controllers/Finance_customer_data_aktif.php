<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class finance_customer_data_aktif extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('model_global', 'm_global');
        $this->load->model('model_finance_customer_data_aktif', 'finance_customer_data_aktif');
        $this->load->model('Kamus_model');
        $this->lang->load('finance_customer_data_aktif');
        $this->active_root_menu = $this->lang->line('finance_customer_data_aktif_alltitle');
        $this->browser_title = $this->lang->line('finance_customer_data_aktif_alltitle');
        $this->modul_name = $this->lang->line('finance_customer_data_aktif_alltitle');
        $this->css_include = '';
        $this->js_include = '';
        $this->js_inject = '';
    }

    public function index()
    {
        // $options = array();
        // $options['modul_code'] = 'bts';
        // $this->frame->main_crud($options);

        $this->breadcrumb = array('Home' => base_url(), $this->lang->line('finance_customer_data_aktif_alltitle') => '#');
        $data = array();

        //$this->js_inject .= $this->load->view('finance_customer_data_aktif/js_table', $data, TRUE);
        $this->js_inject .= $this->load->view('finance_customer_aktif/js', $data, TRUE);
        //$this->js_inject .= $this->load->view('finance_customer_data_aktif/valid', $data, TRUE);
        //$this->js_include .= $this->ui->js_include('flexigridMaster');
        //$this->js_include .= $this->ui->load_css('flexigridMaster');
        $this->js_include .= $this->ui->load_css('MaterialIcons');
        $this->js_include .= $this->ui->js_include('jquery_ui');
        $this->js_include .= $this->ui->js_include('mask_money');
        $this->js_include .= $this->ui->js_include('dt_fixed_columns');
        $this->js_include .= $this->ui->js_include('select2');
        $this->js_include .= $this->ui->js_include('custom_page');
        $this->js_include .= $this->ui->js_include('toastr');
        $this->js_include .= $this->ui->js_include('bootstrap-toggle');
        //$this->css_include .= $this->ui->load_css('jquery_ui');
        $this->css_include .= $this->ui->load_css('bootstrap-toggle');
        $this->css_include .= $this->ui->load_css('custom_page');
        $this->css_include .= $this->ui->load_css('toastr');

        $data['title_page_table'] = $this->lang->line('finance_customer_data_aktif_alltitle');
        //$data['update_view'] = $this->load->view('finance_customer_data_aktif/update', $data, TRUE);
        $data['insert_view'] = $this->load->view('finance_customer_aktif/form', $data, TRUE);
        //$data['delete_view'] = $this->load->view('finance_customer_data_aktif/delete', $data, TRUE);

        $konten = $this->load->view('finance_customer_aktif/index', $data, TRUE);
        $this->admin_view($konten);
    }

    public function get_data_table()
    {
        $this->finance_customer_data_aktif->get_data_table();
    }

    public function insert_data()
    {
        echo $this->finance_customer_data_aktif->insert();
    }

    public function select_data()
    {
        echo json_encode($this->finance_customer_data_aktif->select());
    }

    public function edit_data()
    {
        echo $this->finance_customer_data_aktif->update();
    }

    public function delete_data()
    {
        $id = $this->uri->segment(3);
        echo $this->finance_customer_data_aktif->delete($id);
    }

    public function select_autocomplite()
    {
        echo json_encode($this->finance_customer_data_aktif->select_autocomplite());
    }

    function ajax_get_order()
    {
        echo $this->finance_customer_data_aktif->ajax_get_order();
    }

    public function view_data()
    {
        echo $this->finance_customer_data_aktif->view_data();
    }
}
