<?php
defined('BASEPATH') or exit('No direct script access allowed');

class finance_tax_nomor extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('model_finance_tax_nomor', 'finance_tax_nomor');
        $this->load->model('model_global');
        $this->lang->load('finance_tax_nomor');
        $this->active_root_menu = $this->lang->line('finance_tax_nomor_alltitle');
        $this->browser_title = $this->lang->line('finance_tax_nomor_alltitle');
        $this->modul_name = $this->lang->line('finance_tax_nomor_alltitle');
        $this->css_include = '';
        $this->js_include = '';
        $this->js_inject = '';
    }

    public function index()
    {
        // $options = array();
        // $options['modul_code'] = 'bts';
        // $this->frame->main_crud($options);

        $this->breadcrumb = array('Home' => base_url(), $this->lang->line('finance_tax_nomor_alltitle') => '#');
        $data = array();

        //$this->js_inject .= $this->load->view('finance_tax_transaksi_billing/js_table', $data, TRUE);
        //$this->js_inject .= $this->load->view('finance_tax_transaksi_billing/valid', $data, TRUE);
        //$this->js_include .= $this->ui->js_include('flexigridMaster');
        //$this->js_include .= $this->ui->load_css('flexigridMaster');
        $this->js_include .= $this->ui->load_css('MaterialIcons');
        $this->js_include .= $this->ui->js_include('jquery_ui');
        $this->js_include .= $this->ui->js_include('mask_money');
        $this->js_include .= $this->ui->js_include('dt_fixed_columns');
        $this->js_include .= $this->ui->js_include('select2');
        $this->js_include .= $this->ui->js_include('custom_page');
        $this->js_include .= $this->ui->js_include('nofak');
        $this->js_include .= $this->ui->js_include('toastr');
        //$this->css_include .= $this->ui->load_css('jquery_ui');
        $this->css_include .= $this->ui->load_css('custom_page');
        $this->css_include .= $this->ui->load_css('toastr');

        $data['title_page_table'] = $this->lang->line('finance_tax_nomor_alltitle');
        //$data['update_view'] = $this->load->view('finance_tax_transaksi/update', $data, TRUE);
        //$data['delete_view'] = $this->load->view('finance_tax_transaksi/delete', $data, TRUE);

        $konten = $this->load->view('finance_tax_transaksi/nomor_faktur', $data, TRUE);
        $this->admin_view($konten);
    }

    public function get_data_table()
    {
        $this->finance_tax_nomor->get_data_table();
    }

    function select_data()
    {
        echo json_encode($this->finance_tax_nomor->select_data());
    }

    function insert_data()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y:m:d H-i-s');
        $b = null;
        $letters = array('/', ',', '.', '-');
        $nofak = str_replace($letters, "", $this->input->post('nofak'));
        $b = substr($nofak, 8);
        for ($a = 0; $a < $this->input->post('jumlah'); $a++) {
            $b = $b + 1;
            $no_faktur = substr($nofak, 0, 3) . '.' . substr($nofak, 3, 3) . '-' . substr($nofak, 6, 2) . '.' . $b;
            if (empty($this->finance_tax_nomor->checkid($no_faktur))) {
                $data = array(
                    'no_faktur' => $no_faktur,
                    'status' => 0,
                    'tanggal' => $date,
                    'insert_by' => $this->session->userdata('username'),
                );
                $c = $this->finance_tax_nomor->insertdata($data);
            }
            if (!empty($c)) {
                $this->output->set_content_type('application/json')->set_output(json_encode(['status' => 1, 'message' => 'Tambah Data Berhasil']));
            } else {
                $this->output->set_content_type('application/json')->set_output(json_encode(['status' => 0, 'message' => 'Tambah Data Gagal']));
            }
        }
    }
    function edit_data()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y:m:d H-i-s');
        $b = null;
        $letters = array('/', ',', '.', '-');
        $nofak = str_replace($letters, "", $this->input->post('nofak'));
        if (empty($this->finance_tax_nomor->checkid($this->input->post('nofak')))) {
            $no_faktur = substr($nofak, 0, 3) . '.' . substr($nofak, 3, 3) . '-' . substr($nofak, 6, 2) . '.' . substr($nofak, 8);
            $data = array(
                'no_faktur' => $no_faktur,
                'update_at' => $date,
                'update_by' => $this->session->userdata('username'),
            );
            $c = $this->finance_tax_nomor->updatedata($data, $this->input->post('id'));
            if (!empty($c)) {
                $this->output->set_content_type('application/json')->set_output(json_encode(['status' => 1, 'message' => 'Update Data Berhasil']));
            } else {
                $this->output->set_content_type('application/json')->set_output(json_encode(['status' => 1, 'message' => 'Update Data Berhasil, Data Tidak Ada Yang Berubah']));
            }
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode(['status' => 0, 'message' => 'No Faktur Telah Digunakan']));
        }
    }

    function delete_data($id)
    {
        $this->finance_tax_nomor->delete($id);
        if ($this->db->affected_rows() > 0) {
            $this->output->set_content_type('application/json')->set_output(json_encode(['status' => 1, 'message' => 'Delete Data Berhasil']));
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode(['status' => 0, 'message' => 'Delete Data Gagal']));
        }
    }
}
