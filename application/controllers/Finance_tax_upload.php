<?php
defined('BASEPATH') or exit('No direct script access allowed');

class finance_tax_upload extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('model_finance_tax_upload', 'finance_tax_upload');
        $this->load->model('model_global');
        $this->lang->load('finance_tax_upload');
        $this->active_root_menu = $this->lang->line('finance_tax_upload_alltitle');
        $this->browser_title = $this->lang->line('finance_tax_upload_alltitle');
        $this->modul_name = $this->lang->line('finance_tax_upload_alltitle');
        $this->css_include = '';
        $this->js_include = '';
        $this->js_inject = '';
    }

    public function index()
    {
        // $options = array();
        // $options['modul_code'] = 'bts';
        // $this->frame->main_crud($options);

        $this->breadcrumb = array('Home' => base_url(), $this->lang->line('finance_tax_upload_alltitle') => '#');
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
        $this->js_include .= $this->ui->js_include('uploadfaktur');
        $this->js_include .= $this->ui->js_include('toastr');
        //$this->css_include .= $this->ui->load_css('jquery_ui');
        $this->css_include .= $this->ui->load_css('custom_page');
        $this->css_include .= $this->ui->load_css('toastr');

        $data['title_page_table'] = $this->lang->line('finance_tax_upload_alltitle');
        //$data['update_view'] = $this->load->view('finance_tax_transaksi/update', $data, TRUE);
        //$data['delete_view'] = $this->load->view('finance_tax_transaksi/delete', $data, TRUE);

        $konten = $this->load->view('finance_tax_transaksi/upload_faktur', $data, TRUE);
        $this->admin_view($konten);
    }

    public function get_data_table()
    {
        $this->finance_tax_upload->get_data_table();
    }


    function upload_pdf()
    {
        $data = array();
        $file_element_name = 'file';
        $name = str_replace(' ', '_', $_FILES["file"]["name"]);
        $filename = './assets/generate/report/faktur/' . $name;
        $root = './assets/generate/report/faktur/';
        // setting konfigurasi upload
        $config['upload_path'] = './assets/generate/report/faktur/';
        $config['allowed_types'] = 'pdf';
        $config['max_size']    = 0;

        // load library upload
        $this->load->library('upload', $config);
        $this->load->library('textpdf');
        $this->load->library('splitpdf');
        if (!$this->upload->do_upload($file_element_name)) {
            $error = $this->upload->display_errors();
            // menampilkan pesan error
            unlink($filename);
        } else {
            $date = date('Y-m-d');
            $this->upload->data();
            $pagecount = $this->splitpdf->get_page($filename);
            for ($a = 1; $a <= $pagecount; $a++) {
                $hasil = null;
                $text = $this->textpdf->text_pdf($filename, $a);
                $b = str_replace("Nama : PT MEDIA SARANA DATA", " fakturbro ", $text);
                $data = explode(" ", $b);
                foreach ($data as $row) {
                    if ($row == 'fakturbro') {
                        break;
                    } else {
                        $nofak = trim($row);
                        $directory = $root . $nofak . '.pdf';
                    }
                }
                $hasil = $this->splitpdf->split_pdf($filename, $directory, $a);
                if ($hasil == 'sukses') {
                    $data = array(
                        'no_faktur' => $nofak,
                        'insert_by' => $this->session->userdata('username'),
                        'tanggal' => $date,
                        'insert_at' => date('Y-m-d H:i:s')
                    );
                    $this->finance_tax_upload->insertdata($data);
                }
            }
        }
        if (empty($error)) {
            $this->output->set_content_type('application/json')->set_output(json_encode(['status' => 1, 'message' => 'File Berhasil Diupload']));
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode(['status' => 0, 'message' => 'File Gagal Diupload']));
        }
        unlink($filename);
    }

    // function cetak($a)
    // {
    //     $this->load->library('pdfgenerator');
    //     $file_pdf = null;
    //     $now = date('Y-m-d');
    //     $id_inv = $a;
    //     $inv = explode(',', $id_inv);
    //     $data['more'] = count($inv);
    //     foreach ($inv as $row) {
    //         $data['ppn'] = $this->finance_invoice_customer->get_ppn($row);
    //         $data['invoice'] = $this->finance_invoice_customer->get_data_cetak($row);
    //         $data['detail'] = $this->finance_invoice_customer->get_data_detail($row);
    //         if (!empty($data['ppn'])) {
    //             $file_pdf .= $this->load->view('finance_invoice_customer/cetak_ppn', $data, TRUE);
    //         } else {
    //             $file_pdf .= $this->load->view('finance_invoice_customer/cetak_nonppn', $data, TRUE);
    //         }
    //     }
    //     // create CodeIgniter create pdf file
    //     $paper = 'A4';
    //     $orientation = "portrait";
    //     $this->pdfgenerator->generate($file_pdf, $now, TRUE, $paper, $orientation);
    // }
}
