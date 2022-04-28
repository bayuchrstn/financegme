<?php
defined('BASEPATH') or exit('No direct script access allowed');

class finance_tax_transaksi extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_finance_tax_transaksi', 'finance_tax_transaksi');
		$this->load->model('model_global');
		$this->lang->load('finance_tax_transaksi');
		$this->active_root_menu = $this->lang->line('finance_tax_transaksi_alltitle');
		$this->browser_title = $this->lang->line('finance_tax_transaksi_alltitle');
		$this->modul_name = $this->lang->line('finance_tax_transaksi_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(), $this->lang->line('finance_tax_transaksi_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('finance_tax_transaksi/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('finance_tax_transaksi/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('finance_tax_transaksi/valid', $data, TRUE);
		//$this->js_include .= $this->ui->js_include('flexigridMaster');
		//$this->js_include .= $this->ui->load_css('flexigridMaster');
		$this->js_include .= $this->ui->load_css('MaterialIcons');
		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('mask_money');
		$this->js_include .= $this->ui->js_include('dt_fixed_columns');
		$this->js_include .= $this->ui->js_include('select2');
		$this->js_include .= $this->ui->js_include('custom_page');
		//$this->css_include .= $this->ui->load_css('jquery_ui');
		$this->css_include .= $this->ui->load_css('custom_page');



		$data['title_page_table'] = $this->lang->line('finance_tax_transaksi_alltitle');
		//$data['update_view'] = $this->load->view('finance_tax_transaksi/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('finance_tax_transaksi/form', $data, TRUE);
		//$data['delete_view'] = $this->load->view('finance_tax_transaksi/delete', $data, TRUE);

		$konten = $this->load->view('finance_tax_transaksi/index', $data, TRUE);
		$this->admin_view($konten);
	}

	public function import()
	{
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(), $this->lang->line('finance_tax_transaksi_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('finance_invoice_approval/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('finance_tax_transaksi/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('finance_invoice_approval/valid', $data, TRUE);
		$this->js_include .= $this->ui->load_css('MaterialIcons');
		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('custom_page');
		$this->js_include .= $this->ui->js_include('mask_money');
		$this->css_include .= $this->ui->load_css('jquery_ui');
		$this->css_include .= $this->ui->load_css('custom_page');

		$data['title_page_table'] = $this->lang->line('finance_tax_transaksi_alltitle');

		$konten = $this->load->view('finance_tax_transaksi/import', $data, TRUE);
		$this->admin_view($konten);
	}

	public function get_data_table()
	{
		$this->finance_tax_transaksi->get_data_table();
	}

	public function insert_data()
	{
		echo $this->finance_tax_transaksi->insert();
	}

	public function select_data()
	{
		echo json_encode($this->finance_tax_transaksi->select());
	}

	public function edit_data()
	{
		echo $this->finance_tax_transaksi->update();
	}

	public function delete_data()
	{
		$id = $this->uri->segment(3);
		echo $this->finance_tax_transaksi->delete($id);
	}

	public function get_karyawan()
	{
		$id = $this->uri->segment(3);
		echo $this->finance_tax_transaksi->get_karyawan($id);
	}

	public function upload_file()
	{
		$this->load->helper('string');
		set_time_limit(0);
		$jsonData = '';
		$file_upload = 'excel_file';

		//photo rumah
		if ($_FILES[$file_upload]["error"] == 0) {
			$filename = $_FILES[$file_upload]['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);

			if ($ext == 'xls' || $ext == 'xlsx' || $ext == 'XLS' || $ext == 'XLSX') {
				$randname = random_string('alnum', 100);
				$cek_filename = str_replace(" ", "", $_FILES[$file_upload]["name"]);
				$nama_photo = $randname . '.' . $ext;
				$tmp_name = $_FILES[$file_upload]["tmp_name"];
				$dir_name = './assets/';
				move_uploaded_file($tmp_name, $dir_name . $nama_photo);

				$this->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));
				// Read your Excel workbook
				try {
					$inputFileType = IOFactory::identify($dir_name . $nama_photo);
					$objReader = IOFactory::createReader($inputFileType);
					$objPHPExcel = $objReader->load($dir_name . $nama_photo);
				} catch (Exception $e) {
					//die('Error loading file "'.pathinfo($dir_name.$nama_photo,PATHINFO_BASENAME).'": '.$e->getMessage());
					$jsonData  = 'Error loading file "' . pathinfo($dir_name . $nama_photo, PATHINFO_BASENAME) . '": ' . $e->getMessage();
				}

				//Get worksheet dimensions
				$sheet = $objPHPExcel->getSheet(0);
				$highestRow = $sheet->getHighestRow();
				$highestColumn = $sheet->getHighestColumn();

				$this->db->trans_start();
				$rowDataHead = $sheet->rangeToArray('A1:D1', NULL, TRUE, FALSE);

				if ($rowDataHead[0][0] != 'NO SERI FAKTUR' || $rowDataHead[0][1] != 'TANGGAL FAKTUR' || $rowDataHead[0][2] != 'NAMA WAJIB PAJAK' || $rowDataHead[0][3] != 'PPN') {
					$jsonData  = 'Header table tidak sesuai dengan format sistem';
				} else {
					//  Loop through each row of the worksheet in turn
					$no = 0;
					$jsonData = '<table class="table table-xxs text-nowrap"><thead><tr class="text-bold"><th>NO</th><th>NO SERI FAKTUR</th><th>TANGGAL FAKTUR</th><th>NAMA WAJIB PAJAK</th><th>PPN</th></tr></thead><tbody>';
					$total = 0;
					for ($row = 2; $row <= $highestRow; $row++) {
						$no++;
						$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
						if ($rowData[0][0] == '') {
							$jsonData .= '<tr><td colspan="4">Total<td align="right">' . number_format($total, 0) . '</td></tr>';
							break;
						}
						$no_seri = trim($rowData[0][0]);
						$tanggal = trim($rowData[0][1]);
						$tanggal = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($tanggal));
						$nama_pkp = trim($rowData[0][2]);
						$jumlah = trim($rowData[0][3]);
						$jumlah = str_replace(",", "", $jumlah);
						$total += $jumlah;
						if ($tanggal >= '2000-01-01') {
							$jsonData .= '<tr><td align="right">' . $no . '</td><td>' . $no_seri . '</td><td align="center">' . $tanggal . '</td><td>' . $nama_pkp . '</td><td align="right">' . number_format($jumlah, 0) . '</td>
					<input type="hidden" name="tax_no_seri[]" value="' . $no_seri . '">
					<input type="hidden" name="tax_tanggal[]" value="' . $tanggal . '">
					<input type="hidden" name="tax_nama_pkp[]" value="' . $nama_pkp . '">
					<input type="hidden" name="tax_jumlah[]" value="' . $jumlah . '">
					</tr>';
						}
					}
					$jsonData  .= '</tbody></table>';
				}
				$this->db->trans_complete();
				unlink('./assets/' . $nama_photo);
			} else {
				$jsonData  = 'Format harus XLS atau XLSX';
			}
		} else {
			$jsonData  = 'Gagal disimpan';
		}

		echo $jsonData;
	}

	public function save_data_import()
	{
		if ($this->input->post('tipe') == '' || $this->input->post('tax_type') == '' || $this->input->post('cabang') == '') {
			echo 'Proses gagal. isi semua pilihan';
		} else {
			echo $this->finance_tax_transaksi->save_data_import();
		}
	}
}
