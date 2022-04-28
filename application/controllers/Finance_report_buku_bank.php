<?php
defined('BASEPATH') or exit('No direct script access allowed');

class finance_report_buku_bank extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->helper('my_func_helper');
        $this->load->model('model_global', 'm_global');
        $this->load->model('model_finance_report_buku_bank', 'finance_report_buku_bank');
        $this->lang->load('finance_report_buku_bank');
        $this->load->library('ImportFile', 'importfile');
        $this->active_root_menu = $this->lang->line('finance_report_buku_bank_alltitle');
        $this->browser_title = $this->lang->line('finance_report_buku_bank_alltitle');
        $this->modul_name = $this->lang->line('finance_report_buku_bank_alltitle');
        $this->css_include = '';
        $this->js_include = '';
        $this->js_inject = '';
        ini_set('memory_limit', '-1');
        set_time_limit(0);
    }

    public function index()
    {
        // $options = array();
        // $options['modul_code'] = 'bts';
        // $this->frame->main_crud($options);
        $this->breadcrumb = array('Home' => base_url(), $this->lang->line('finance_report_buku_bank_alltitle') => '#');
        $data = array();

        //$this->js_inject .= $this->load->view('finance_accounting_report_als/js_table', $data, TRUE);
        $this->js_inject .= $this->load->view('finance_report_buku_bank/js', $data, TRUE);
        //$this->js_inject .= $this->load->view('finance_accounting_report_als/valid', $data, TRUE);
        $this->js_include .= $this->ui->load_css('MaterialIcons');
        $this->js_include .= $this->ui->js_include('jquery_ui');
        $this->js_include .= $this->ui->js_include('mask_money');
        $this->js_include .= $this->ui->js_include('dt_fixed_columns');
        $this->js_include .= $this->ui->js_include('jszip');
        $this->js_include .= $this->ui->js_include('pdfmake');
        $this->js_include .= $this->ui->js_include('vfs_fonts');
        $this->js_include .= $this->ui->js_include('buttons');
        $this->js_include .= $this->ui->js_include('select2');
        $this->js_include .= $this->ui->js_include('custom_page');
        $this->js_include .= $this->ui->js_include('toastr');
        //$this->css_include .= $this->ui->load_css('jquery_ui');
        $this->css_include .= $this->ui->load_css('toastr');
        $this->css_include .= $this->ui->load_css('custom_page');

        $data['title_page_table'] = $this->lang->line('finance_report_buku_bank_alltitle');
        $data['insert_view'] = $this->load->view('finance_report_buku_bank/form', $data, TRUE);
        $konten = $this->load->view('finance_report_buku_bank/index', $data, TRUE);
        $this->admin_view($konten);
    }

    public function get_data_table()
    {
        $this->finance_report_buku_bank->get_data_table();
    }

    public function gmd_finance_coa_info()
    {
        echo $this->m_global->gmd_finance_coa_info($this->uri->segment(3));
    }

    public function print_report()
    {
        $data['title_page_table'] = $this->lang->line('finance_accounting_report_als_alltitle');

        $this->load->view('finance_accounting_report_als/report', $data);
    }

    public function upload_file()
    {
        $validate_file = array(
            "row_range" => 'A1:F1',
            "row_name"  => ['periode', 'tanggal transaksi', 'keterangan', 'cabang', 'jumlah', 'saldo']
        );
        $buku_bank = $this->importfile->CekExcel('excel_file', 'buku bank', $validate_file['row_range'], $validate_file['row_name']);
        my_json($buku_bank, 200);
    }

    public function upload_file_bni()
    {
        $validate_file = array(
            "row_range" => 'A1:E1',
            "row_name"  => ['post date', 'description', 'amount', 'db/cr', 'balance']
        );
        $buku_bank = $this->importfile->CekExcel('excel_file', 'buku bank', $validate_file['row_range'], $validate_file['row_name'], 'E1');
        my_json($buku_bank, 200);
    }

    public function upload_file_bca()
    {
        $validate_file = array(
            "row_range" => 'A5:H5',
            "row_name"  => ['tanggal transaksi', 'keterangan', 'cabang', 'jumlah', 'jumlah', '', 'saldo', 'keterangan pembayaran']
        );
        $buku_bank = $this->importfile->CekExcel('excel_file', 'buku bank', $validate_file['row_range'], $validate_file['row_name'], 'H5');
        my_json($buku_bank, 200);
    }

    public function upload_file_bri()
    {
        $validate_file = array(
            "row_range" => 'A6:F6',
            "row_name"  => ['tanggal', 'transaksi', 'debet', 'kredit', 'saldo', 'keterangan']
        );
        $buku_bank = $this->importfile->CekExcel('excel_file', 'buku bank', $validate_file['row_range'], $validate_file['row_name'], 'F6');
        my_json($buku_bank, 200);
    }

    public function upload_file_permata()
    {
        $validate_file = array(
            "row_range" => 'A1:F1',
            "row_name"  => ['Tanggal', 'Keterangan', 'Cabang', 'Jumlah', '', 'Saldo']
        );
        $buku_bank = $this->importfile->CekExcel('excel_file', 'buku bank', $validate_file['row_range'], $validate_file['row_name']);
        my_json($buku_bank, 200);
    }

    public function save_data_import()
    {
        if ($this->input->post('tipe') == '' || $this->input->post('tax_type') == '' || $this->input->post('cabang') == '') {
            echo 'Proses gagal. isi semua pilihan';
        } else {
            echo $this->finance_report_buku_bank->save_data_import();
        }
    }

    public function import_bri()
    {

        $this->importfile->excel($this->input->post(), 'A6', function ($data) {
            $rek = $this->input->post('id_rek');
            $this->finance_report_buku_bank->import_file_excel_bri($data, $rek);
        });
    }

    public function import_bni()
    {

        $this->importfile->excel($this->input->post(), 'A1', function ($data) {
            $rek = $this->input->post('id_rek');
            $this->finance_report_buku_bank->import_file_excel_bni($data, $rek);
        });
    }

    public function import_bca()
    {

        $this->importfile->excel($this->input->post(), 'A5', function ($data) {
            $rek = $this->input->post('id_rek');
            $this->finance_report_buku_bank->import_file_excel_bca($data, $rek);
        });
    }

    public function select_data()
    {
        echo json_encode($this->finance_report_buku_bank->select());
    }

    public function edit_data()
    {
        echo $this->finance_report_buku_bank->update();
    }
}
