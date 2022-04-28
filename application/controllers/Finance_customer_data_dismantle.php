<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class finance_customer_data_dismantle extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('model_global', 'm_global');
        $this->load->model('Kamus_model');
        $this->load->model('model_finance_invoice_customer', 'finance_invoice_customer');
        $this->load->model('model_finance_customer_data_dismantle', 'finance_customer_data_dismantle');
        $this->lang->load('finance_customer_data_dismantle');
        $this->active_root_menu = $this->lang->line('finance_customer_data_dismantle_alltitle');
        $this->browser_title = $this->lang->line('finance_customer_data_dismantle_alltitle');
        $this->modul_name = $this->lang->line('finance_customer_data_dismantle_alltitle');
        $this->css_include = '';
        $this->js_include = '';
        $this->js_inject = '';
    }

    public function index()
    {
        // $options = array();
        // $options['modul_code'] = 'bts';
        // $this->frame->main_crud($options);

        $this->breadcrumb = array('Home' => base_url(), $this->lang->line('finance_customer_data_dismantle_alltitle') => '#');
        $data = array();

        //$this->js_inject .= $this->load->view('finance_customer_data_dismantle/js_table', $data, TRUE);
        $this->js_inject .= $this->load->view('finance_customer_dismantle/js', $data, TRUE);
        //$this->js_inject .= $this->load->view('finance_customer_data_dismantle/valid', $data, TRUE);
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

        $data['title_page_table'] = $this->lang->line('finance_customer_data_dismantle_alltitle');
        //$data['update_view'] = $this->load->view('finance_customer_data_dismantle/update', $data, TRUE);
        $data['insert_view'] = $this->load->view('finance_customer_dismantle/form', $data, TRUE);
        //$data['delete_view'] = $this->load->view('finance_customer_data_dismantle/delete', $data, TRUE);

        $konten = $this->load->view('finance_customer_dismantle/index', $data, TRUE);
        $this->admin_view($konten);
    }

    public function get_data_table()
    {
        $this->finance_customer_data_dismantle->get_data_table();
    }

    public function insert_data()
    {
        echo $this->finance_customer_data_dismantle->insert();
    }

    public function select_data()
    {
        echo $this->finance_customer_data_dismantle->select();
    }

    public function edit_data()
    {
        echo $this->finance_customer_data_dismantle->update();
    }

    public function delete_data()
    {
        $id = $this->uri->segment(3);
        echo $this->finance_customer_data_dismantle->delete($id);
    }

    public function select_autocomplite()
    {
        echo json_encode($this->finance_customer_data_dismantle->select_autocomplite());
    }

    function print_selected()
    {

        $this->load->library('pdfgenerator');
        $file_pdf  = null;
        $now = date('Y-m-d');
        $id_inv = $this->input->get('inv');
        $inv = explode(',', $id_inv);
        $data['more'] = count($inv);
        $no = $voucher = 0;
        foreach ($inv as $row) {

            $data['invoice'] = $this->finance_invoice_customer->get_data_cetak($row);
            foreach ($data['invoice'] as $low) {
                $project = $low->flag;
                $merge = $low->merge_type;
            }
            if ($merge == 1) {
                $data['detail'] = $this->finance_invoice_customer->get_data_detail_merge($row);
                foreach ($data['detail'] as $low) {
                    if ($low->nilai_voucher > 0) {
                        $voucher = $low->nilai_voucher;
                    }
                    if ($low->jenis_transaksi == 'LL') {
                        $lain = $this->finance_invoice_customer->get_data_lain($low->id_order);
                        if (!empty($lain)) {
                            foreach ($lain as $sow) {
                                $data['isi'][$no] = array(
                                    'attention' => $low->attention,
                                    'alamat' => $low->alamat,
                                    'cust_id' => $low->cust_id,
                                    'nomor' => $low->nomor,
                                    'tanggal_invoice' => $low->tanggal_invoice,
                                    'due_date' => $low->due_date,
                                    'nama' => $low->nama,
                                    'phone' => $low->phone,
                                    'periode_dari' => $low->periode_dari,
                                    'periode_sampai' => $low->periode_sampai,
                                    'keterangan' => $low->keterangan,
                                    'email' => $low->email,
                                    'kota' => $low->kota,
                                    'jenis_transaksi' => 'LL',
                                    'nominal' => $sow->nominal,
                                    'detail' => $sow->detail,
                                    'servid' => NULL,
                                    'voucher' => $low->voucher,
                                    'nilai_voucher' => $voucher
                                );
                                $no++;
                            }
                        }
                    } else {
                        $data['isi'][$no] = array(
                            'attention' => $low->attention,
                            'alamat' => $low->alamat,
                            'cust_id' => $low->cust_id,
                            'nomor' => $low->nomor,
                            'tanggal_invoice' => $low->tanggal_invoice,
                            'due_date' => $low->due_date,
                            'nama' => $low->nama,
                            'phone' => $low->phone,
                            'periode_dari' => $low->periode_dari,
                            'periode_sampai' => $low->periode_sampai,
                            'keterangan' => $low->keterangan,
                            'email' => $low->email,
                            'kota' => $low->kota,
                            'jenis_transaksi' => $low->jenis_transaksi,
                            'nominal' => $low->nominal,
                            'detail' => $low->detail,
                            'servid' => $low->servid,
                            'voucher' => $low->voucher,
                            'nilai_voucher' => $voucher
                        );
                        $no++;
                    }
                }
                $ppn = $this->finance_invoice_customer->get_ppn_merge($row);
            } else {
                $data['detail'] = $this->finance_invoice_customer->get_data_detail($row);
                foreach ($data['detail'] as $low) {
                    if ($low->nilai_voucher > 0) {
                        $voucher = $low->nilai_voucher;
                    }
                    if ($low->jenis_transaksi == 'LL') {
                        $lain = $this->finance_invoice_customer->get_data_lain($low->id_order);
                        if (!empty($lain)) {
                            foreach ($lain as $sow) {
                                $data['isi'][$no] = array(
                                    'attention' => $low->attention,
                                    'alamat' => $low->alamat,
                                    'cust_id' => $low->cust_id,
                                    'nomor' => $low->nomor,
                                    'tanggal_invoice' => $low->tanggal_invoice,
                                    'due_date' => $low->due_date,
                                    'nama' => $low->nama,
                                    'phone' => $low->phone,
                                    'periode_dari' => $low->periode_dari,
                                    'periode_sampai' => $low->periode_sampai,
                                    'keterangan' => $low->keterangan,
                                    'email' => $low->email,
                                    'kota' => $low->kota,
                                    'jenis_transaksi' => 'LL',
                                    'nominal' => $sow->nominal,
                                    'detail' => $sow->detail,
                                    'servid' => NULL,
                                    'voucher' => $low->voucher,
                                    'nilai_voucher' => $voucher
                                );
                                $no++;
                            }
                        }
                    } else {
                        $data['isi'][$no] = array(
                            'attention' => $low->attention,
                            'alamat' => $low->alamat,
                            'cust_id' => $low->cust_id,
                            'nomor' => $low->nomor,
                            'tanggal_invoice' => $low->tanggal_invoice,
                            'due_date' => $low->due_date,
                            'nama' => $low->nama,
                            'phone' => $low->phone,
                            'periode_dari' => $low->periode_dari,
                            'periode_sampai' => $low->periode_sampai,
                            'keterangan' => $low->keterangan,
                            'email' => $low->email,
                            'kota' => $low->kota,
                            'jenis_transaksi' => $low->jenis_transaksi,
                            'nominal' => $low->nominal,
                            'detail' => $low->detail,
                            'servid' => $low->servid,
                            'voucher' => $low->voucher,
                            'nilai_voucher' => $voucher
                        );
                        $no++;
                    }
                }
                $ppn = $this->finance_invoice_customer->get_ppn($row);
            }
            if ($project == 2) {
                $data['detail'] = $this->finance_invoice_customer->get_data_detail_project($row);
                $file_pdf .= $this->load->view('finance_invoice_customer/cetak_project', $data, TRUE);
            } else {
                if ($ppn != 2) {
                    $file_pdf .= $this->load->view('finance_invoice_customer/cetak_ppn', $data, TRUE);
                } else {
                    $file_pdf .= $this->load->view('finance_invoice_customer/cetak_nonppn', $data, TRUE);
                }
            }
        }
        // create CodeIgniter create pdf file
        $paper = 'Legal';
        $orientation = "portrait";
        $this->pdfgenerator->generate($file_pdf, $now, TRUE, $paper, $orientation);
    }
}
