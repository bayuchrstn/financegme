<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class finance_merge_invoice extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('model_global', 'm_global');
        $this->load->model('model_finance_merge_invoice', 'finance_merge_invoice');
        $this->load->model('Kamus_model');
        $this->lang->load('finance_merge_invoice');
        $this->active_root_menu = $this->lang->line('finance_merge_invoice_alltitle');
        $this->browser_title = $this->lang->line('finance_merge_invoice_alltitle');
        $this->modul_name = $this->lang->line('finance_merge_invoice_alltitle');
        $this->css_include = '';
        $this->js_include = '';
        $this->js_inject = '';
    }

    public function index()
    {
        // $options = array();
        // $options['modul_code'] = 'bts';
        // $this->frame->main_crud($options);

        $this->breadcrumb = array('Home' => base_url(), $this->lang->line('finance_merge_invoice_alltitle') => '#');
        $data = array();

        //$this->js_inject .= $this->load->view('finance_merge_invoice/js_table', $data, TRUE);
        $this->js_inject .= $this->load->view('finance_merge_invoice/js', $data, TRUE);
        //$this->js_inject .= $this->load->view('finance_merge_invoice/valid', $data, TRUE);
        //$this->js_include .= $this->ui->js_include('flexigridMaster');
        //$this->js_include .= $this->ui->load_css('flexigridMaster');
        $this->js_include .= $this->ui->load_css('MaterialIcons');
        $this->js_include .= $this->ui->js_include('jquery_ui');
        $this->js_include .= $this->ui->js_include('mask_money');
        $this->js_include .= $this->ui->js_include('dt_fixed_columns');
        $this->js_include .= $this->ui->js_include('select2');
        $this->js_include .= $this->ui->js_include('custom_page');
        $this->js_include .= $this->ui->js_include('toastr');
        $this->js_include .= $this->ui->js_include('datatable_checkbox');
        //$this->css_include .= $this->ui->load_css('jquery_ui');
        $this->css_include .= $this->ui->load_css('custom_page');
        $this->css_include .= $this->ui->load_css('datatable_checkbox');
        $this->css_include .= $this->ui->load_css('toastr');

        $data['title_page_table'] = $this->lang->line('finance_merge_invoice_alltitle');
        //$data['update_view'] = $this->load->view('finance_merge_invoice/update', $data, TRUE);
        $data['insert_view'] = $this->load->view('finance_merge_invoice/form', $data, TRUE);
        //$data['delete_view'] = $this->load->view('finance_merge_invoice/delete', $data, TRUE);

        $konten = $this->load->view('finance_merge_invoice/index', $data, TRUE);
        $this->admin_view($konten);
    }

    public function get_data_table()
    {
        $this->finance_merge_invoice->get_data_table();
    }

    function insert_data()
    {
        $ceksite = null;
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y:m:d H-i-s');
        $cek = $this->finance_merge_invoice->check_idcust2($this->input->post('id_cust'));
        if (!empty($cek)) {
            foreach ($cek as $row) {
                $group = $row->group_cust;
            }
            $group_cust = $group + 1;
            $id_site = $this->input->post('id_site');
            foreach ($id_site as $row) {
                $data = array(
                    'id_cust' => $this->input->post('id_cust'),
                    'id_site' => $row,
                    'insert_by' => $this->session->userdata('username'),
                    'insert_at' => $date,
                    'group_cust' => $group_cust
                );
                $a = $this->finance_merge_invoice->insert('setting_merge', $data);
            }
            if ($a > 0) {
                $this->output->set_content_type('application/json')->set_output(json_encode(['sukses' => true, 'message' => 'Tambah Data Berhasil']));
            } else {
                return false;
            }
        } else {
            $id_site = $this->input->post('id_site');
            foreach ($id_site as $row) {
                $data = array(
                    'id_cust' => $this->input->post('id_cust'),
                    'id_site' => $row,
                    'insert_by' => $this->session->userdata('username'),
                    'insert_at' => $date,
                    'group_cust' => 1
                );
                $a = $this->finance_merge_invoice->insert('setting_merge', $data);
            }
            if ($a > 0) {
                $this->output->set_content_type('application/json')->set_output(json_encode(['sukses' => true, 'message' => 'Tambah Data Berhasil']));
            } else {
                return false;
            }
        }
    }

    function update_data()
    {
        $nama = null;
        $tanggal = null;
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y:m:d H-i-s');
        $data = $this->finance_merge_invoice->get_id_group($this->input->post('id'));
        foreach ($data as $sow) {
            $id_cust = $sow->id_cust;
            $group = $sow->group_cust;
        }
        $cek = $this->finance_merge_invoice->check_idcust($id_cust, $group);
        $id_site = $this->input->post('id_site');
        foreach ($id_site as $row) {
            $ceksite = $this->finance_merge_invoice->check_site($row)->result();
            if (!empty($ceksite)) {
                break;
            }
        }
        if (empty($ceksite)) {
            if (!empty($cek)) {
                $nama = $this->finance_merge_invoice->get_namasetmerge($this->input->post('id_cust'));
                $tanggal = $this->finance_merge_invoice->get_tglsetmerge($this->input->post('id_cust'));
                $this->finance_merge_invoice->delete_setmerge($this->input->post('id_cust'), $group);
                $id_site = $this->input->post('id_site');
                foreach ($id_site as $row) {
                    $data = array(
                        'id_cust' => $this->input->post('id_cust'),
                        'id_site' => $row,
                        'insert_by' => $nama,
                        'insert_at' => $tanggal,
                        'update_by' => $this->session->userdata('username'),
                        'update_at' => $date,
                    );
                    $a = $this->finance_merge_invoice->insert('setting_merge', $data);
                }
                if ($a > 0) {
                    $this->output->set_content_type('application/json')->set_output(json_encode(['sukses' => true, 'message' => 'Update Data Berhasil']));
                } else {
                    return false;
                }
            } else {
                $id_site = $this->input->post('id_site');
                foreach ($id_site as $row) {
                    $data = array(
                        'id_cust' => $this->input->post('id_cust'),
                        'id_site' => $row,
                        'insert_by' => $this->session->userdata('username'),
                        'insert_at' => $date,
                        'group_cust' => 1
                    );
                    $a = $this->finance_merge_invoice->insert('setting_merge', $data);
                }
                if ($a > 0) {
                    $this->output->set_content_type('application/json')->set_output(json_encode(['sukses' => true, 'message' => 'Update Data Berhasil']));
                } else {
                    return false;
                }
            }
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode(['gagal' => true, 'message' => 'Tambah Data Gagal,Site Sudah Digabung']));
        }
    }

    function select_data()
    {
        $id = $this->input->post('id');
        $data = $this->finance_merge_invoice->get_id_group($id);
        foreach ($data as $sow) {
            $id_cust = $sow->id_cust;
            $group = $sow->group_cust;
        }
        $data = $this->finance_merge_invoice->get_namacust($id_cust, $group);
        if (!empty($data)) {
            foreach ($data as $row) {
                $a = 0;
                $sitesite = $this->finance_merge_invoice->get_namasite($row->id_cust, $row->group_cust);
                foreach ($sitesite as $sow) {
                    $id_site[$a] = $sow->id_site;
                    $a++;
                }
                $arr = array(
                    'id_cust' => $id_cust,
                    'nama_cust' => $row->nama_cust,
                    'id_site' => $id_site
                );
            }
            echo json_encode($arr);
        } else {
            return false;
        }
    }

    public function edit_data()
    {
        echo $this->finance_merge_invoice->update();
    }

    function delete_settingmerge($id)
    {
        $a = null;
        $data = $this->finance_merge_invoice->get_id_group($id);
        foreach ($data as $row) {
            $a .= $this->finance_merge_invoice->delete_setmerge($row->id_cust, $row->group_cust);
        }
        if ($a > 0) {
            $this->output->set_content_type('application/json')->set_output(json_encode(['sukses' => true, 'message' => 'Delete Berhasil']));
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode(['gagal' => true, 'message' => 'Delete Gagal']));
        }
    }


    function get_data_mssite($id)
    {
        $list = $this->finance_merge_invoice->get_ms_site($id);
        $data = array();
        $no = 0;
        foreach ($list as $site) {
            $no++;
            $row = array();
            $row[] = $site->id;
            $row[] = $no;
            $row[] = $site->nama . ' - ' . $site->alamat3;
            $data[] = $row;
        }
        $output = array(
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function get_data_mssite2($id)
    {
        $list = $this->finance_merge_invoice->get_ms_site2($id)->result();
        $data = array();
        $no = 0;
        foreach ($list as $site) {
            $no++;
            $row = array();
            $row[] = $site->id;
            $row[] = $no;
            $row[] = $site->nama . ' - ' . $site->alamat3;
            $data[] = $row;
        }
        $output = array(
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function get_nama()
    {
        if (!empty($this->input->post('searchTerm'))) {
            $list = $this->finance_merge_invoice->get_cust1($this->input->post('searchTerm'));
        } else {
            $list = $this->finance_merge_invoice->get_cust();
        }
        $data = array();
        foreach ($list as $row) {
            $data[] = array("id" => $row->id, "text" => $row->nama);
        }
        echo json_encode($data);
    }
}
