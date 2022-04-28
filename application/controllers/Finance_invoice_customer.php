<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
ini_set('memory_limit', "256M");
class finance_invoice_customer extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('my_func_helper');
		$this->load->model('model_global');
		$this->load->model('model_finance_invoice_customer', 'finance_invoice_customer');
		$this->load->model('model_finance_tax_transaksi', 'finance_tax_transaksi');
		$this->load->model('model_finance_invoice_approval', 'finance_invoice_approval');
		$this->load->model('Finance_model');
		$this->load->model('Marketing_model');
		$this->load->model('Main_model');
		$this->load->model('Kamus_model');
		$this->lang->load('finance_invoice_customer');
		$this->active_root_menu = $this->lang->line('finance_invoice_customer_alltitle');
		$this->browser_title = $this->lang->line('finance_invoice_customer_alltitle');
		$this->modul_name = $this->lang->line('finance_invoice_customer_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
		set_time_limit(0);
		check_login();
	}
	public $divisi = '2';
	public function index()
	{
		check_login();
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(), $this->lang->line('finance_invoice_customer_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('finance_invoice_customer/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('finance_invoice_customer/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('finance_invoice_customer/valid', $data, TRUE);
		//$this->js_include .= $this->ui->js_include('flexigridMaster');
		//$this->js_include .= $this->ui->load_css('flexigridMaster');
		$this->js_include .= $this->ui->load_css('MaterialIcons');
		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('custom_page');
		$this->js_include .= $this->ui->js_include('dt_fixed_columns');
		$this->js_include .= $this->ui->js_include('jszip');
		$this->js_include .= $this->ui->js_include('pdfmake');
		$this->js_include .= $this->ui->js_include('vfs_fonts');
		$this->js_include .= $this->ui->js_include('buttons');
		$this->js_include .= $this->ui->js_include('mask_money');
		$this->js_include .= $this->ui->js_include('toastr');
		//$this->css_include .= $this->ui->load_css('jquery_ui');
		$this->css_include .= $this->ui->load_css('datatable_reorder');
		$this->css_include .= $this->ui->load_css('datatable_resize');
		$this->css_include .= $this->ui->load_css('toastr');

		$this->css_include .= $this->ui->load_css('custom_page');
		$data['total'] = $this->finance_invoice_customer->get_total();
		$data['title_page_table'] = $this->lang->line('finance_invoice_customer_alltitle');
		//$data['update_view'] = $this->load->view('finance_invoice_customer/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('finance_invoice_customer/form', $data, TRUE);
		$data['manual_view'] = $this->load->view('finance_invoice_customer/form2', $data, TRUE);
		//$data['delete_view'] = $this->load->view('finance_invoice_customer/delete', $data, TRUE);

		$konten = $this->load->view('finance_invoice_customer/index', $data, TRUE);
		$this->admin_view($konten);
	}

	public function list_invoice()
	{
		check_login();
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(), $this->lang->line('finance_invoice_customer_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('finance_invoice_customer/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('finance_invoice_customer/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('finance_invoice_customer/valid', $data, TRUE);
		$this->js_include .= $this->ui->js_include('flexigridMaster');
		$this->js_include .= $this->ui->load_css('flexigridMaster');
		$this->js_include .= $this->ui->load_css('MaterialIcons');
		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('custom_page');
		$this->js_include .= $this->ui->js_include('toastr');
		$this->js_include .= $this->ui->js_include('mask_money');
		//$this->css_include .= $this->ui->load_css('jquery_ui');
		$this->css_include .= $this->ui->load_css('toastr');
		$this->css_include .= $this->ui->load_css('custom_page');


		$data['title_page_table'] = $this->lang->line('finance_invoice_customer_alltitle');
		//$data['update_view'] = $this->load->view('finance_invoice_customer/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('finance_invoice_customer/form', $data, TRUE);
		//$data['delete_view'] = $this->load->view('finance_invoice_customer/delete', $data, TRUE);

		$konten = $this->load->view('finance_invoice_customer/list_invoice', $data, TRUE);
		$this->admin_view($konten);
	}

	public function get_data_table()
	{
		$this->finance_invoice_customer->get_data_table();
	}

	public function insert_data()
	{
		echo $this->finance_invoice_customer->insert_data();
	}

	public function select_data()
	{
		echo json_encode($this->finance_invoice_customer->select($this->input->post("id")));
	}

	public function get_customer_id($id)
	{
		echo $this->finance_invoice_customer->get_customer_id($id);
	}

	public function edit_data()
	{
		echo $this->finance_invoice_customer->update_data();
	}

	public function update_tosite()
	{
		$this->finance_invoice_customer->update_tosite();
	}

	public function update_contact()
	{
		echo $this->finance_invoice_customer->update_contact();
	}

	public function delete_data()
	{
		$id = $this->uri->segment(3);
		echo $this->finance_invoice_customer->delete($id);
	}
	public function delete_data_erp()
	{
		$data = json_decode(file_get_contents('php://input'), true);
		$rawData = file_get_contents('php://input');
		// $data = explode('&',$rawData);
		// $arr = array();
		// foreach($data as $key => $val){
		// $data2 = explode('=',$val);
		// $arr[$data2[0]] = $data2[1];
		// }

		$data = explode('=', $rawData);
		$id = $data[1];

		$this->finance_invoice_customer->delete($id);
	}

	public function select_autocomplite_service()
	{
		echo $this->finance_invoice_customer->select_autocomplite_service();
	}

	public function select_autocomplite_service2()
	{
		echo json_encode($this->finance_invoice_customer->select_autocomplite_service2());
	}

	public function select_customer()
	{
		echo $this->finance_invoice_customer->select_customer();
	}

	public function select_autocomplite_layanan()
	{
		echo $this->finance_invoice_customer->select_autocomplite_layanan();
	}

	public function select_autocomplite_layanan2()
	{
		echo $this->finance_invoice_customer->select_autocomplite_layanan2();
	}

	public function select_autocomplite_service_add()
	{
		$id = $this->uri->segment(3);
		echo $this->finance_invoice_customer->select_autocomplite_service_add($id);
	}

	public function select_autocomplite_customer()
	{
		echo json_encode($this->finance_invoice_customer->select_autocomplite_customer());
	}

	public function select_data_detail_invoice()
	{
		echo $this->finance_invoice_customer->select_data_detail_invoice();
	}

	public function invoice_info()
	{
		$this->finance_invoice_customer->invoice_info();
	}

	public function invoice_create()
	{
		set_time_limit(0);
		echo $this->finance_invoice_customer->invoice_create();
		//echo 2;
	}

	public function invoice_delete()
	{
		echo $this->finance_invoice_customer->invoice_delete();
	}

	public function invoice_print_ppn_no_barcode_no()
	{
		$barcode = '';
		$head_bg = 'bg-t';
		$by_approve = 'Priyo Suyono';
		$by_create = '';
		$phone_cust = '024 - 8509696';
		$email_cust = 'finance.smg@gmedia.co.id';
		$q = $this->finance_invoice_customer->select_data();
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$barcode = '<img width="100" style="display:inline-table" src="' . base_url() . 'cli/qrcode?text=Approved by ' . $by_approve . '%0A' . $r['date_approved'] . '%0APrinted by ' . $by_create . '%0A' . $r['date_printed'] . '"  />';

				if ($r['ppn_tax'] == '1' && ($this->finance_invoice_customer->cek_id_regional($this->session->userdata('scope_area')) == '11' || $this->finance_invoice_customer->cek_id_regional($this->session->userdata('scope_area')) == '13' || $this->finance_invoice_customer->cek_id_regional($this->session->userdata('scope_area')) == '14' || $this->finance_invoice_customer->cek_id_regional($this->session->userdata('scope_area')) == '15')) {
					$head_bg = 'bg-msd-bali';
				}
			}
		}

		$data['title_page_table'] = 'Invoice';
		$data['pdf'] = '0';
		$data['barcode'] = $barcode;
		$data['head_bg'] = $head_bg;
		$data['by_create'] = $by_create;
		$data['by_approve'] = $by_approve;
		$data['phone_cust'] = $phone_cust;
		$data['email_cust'] = $email_cust;

		$this->load->view('finance_invoice_customer/invoice_print_ppn_no_barcode_no', $data);
	}

	public function invoice_print_ppn_no_barcode_no_pdf()
	{
		$this->load->library('Dom_pdf');
		//pdf
		$fname = '';
		$barcode = '';
		$head_bg = 'bg-t';
		$by_create = 'Cahyaningrum';
		$by_approve = 'Budi Yanto';
		$phone_cust = '0274 - 380 345';
		$email_cust = 'finance.jogja@gmedia.co.id';
		if ($this->finance_invoice_customer->cek_id_regional($this->session->userdata('scope_area')) == '4') {
			$by_create = 'Galih Hapsari';
			$phone_cust = '0271 - 668 800';
		} elseif ($this->finance_invoice_customer->cek_id_regional($this->session->userdata('scope_area')) == '11' || $this->finance_invoice_customer->cek_id_regional($this->session->userdata('scope_area')) == '13' || $this->finance_invoice_customer->cek_id_regional($this->session->userdata('scope_area')) == '14' || $this->finance_invoice_customer->cek_id_regional($this->session->userdata('scope_area')) == '15') {
			$by_create = 'Nadya Nisitaswari';
			$phone_cust = '0361 - 4715 157';
			$email_cust = 'billing.bali@gmedia.co.id';
			$by_approve = 'Setia Indarwati';
			$head_bg = 'bg-t-bali';
		}
		$q = $this->finance_invoice_customer->select_data();
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$fname = str_replace("/", "_", $r['no_invoice'] . ' - ' . $r['nama']);
				$this->qrcode($fname, 'Approved by ' . $by_approve . ' ' . $r['date_approved'] . ' Printed by ' . $by_create . ' ' . $r['date_printed']);
				//$barcode = '<img width="100" style="display:inline-table" src="'.base_url().'cli/qrcode?text=Approved by Budi Yanto%0A'.$r['date_approved'].'%0APrinted by Cahyaningrum%0A'.$r['date_printed'].'"  />';

				if ($r['ppn_tax'] == '1' && ($this->finance_invoice_customer->cek_id_regional($this->session->userdata('scope_area')) == '11' || $this->finance_invoice_customer->cek_id_regional($this->session->userdata('scope_area')) == '13' || $this->finance_invoice_customer->cek_id_regional($this->session->userdata('scope_area')) == '14' || $this->finance_invoice_customer->cek_id_regional($this->session->userdata('scope_area')) == '15')) {
					$head_bg = 'bg-msd-bali';
				}
			}
		}

		$data['title_page_table'] = 'Invoice';
		$data['pdf'] = '1';
		$data['barcode'] = $fname;
		$data['head_bg'] = $head_bg;
		$data['by_create'] = $by_create;
		$data['by_approve'] = $by_approve;
		$data['phone_cust'] = $phone_cust;
		$data['email_cust'] = $email_cust;

		$this->load->view('finance_invoice_customer/invoice_print_ppn_no_barcode_no', $data);

		$html = $this->output->get_output();

		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream($fname . ".pdf");

		unlink("assets/images/" . $fname . '.png');
	}

	public function invoice_print_ppn_no_barcode_no_bali()
	{
		$barcode = '';
		$head_bg = 'bg-t-bali';
		$by_create = 'Nadya Nisitaswari';
		$by_approve = 'Setia Indarwati';
		$phone_cust = '0361 - 4715 157';
		$email_cust = 'billing.bali@gmedia.co.id';
		$q = $this->finance_invoice_customer->select_data();
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$barcode = '<img width="100" style="display:inline-table" src="' . base_url() . 'cli/qrcode?text=Approved by ' . $by_approve . '%0A' . $r['date_approved'] . '%0APrinted by ' . $by_create . '%0A' . $r['date_printed'] . '"  />';

				if ($r['ppn_tax'] == '1') {
					$head_bg = 'bg-msd-bali';
				}
			}
		}

		$data['title_page_table'] = 'Invoice';
		$data['pdf'] = '0';
		$data['barcode'] = $barcode;
		$data['head_bg'] = $head_bg;
		$data['by_create'] = $by_create;
		$data['by_approve'] = $by_approve;
		$data['phone_cust'] = $phone_cust;
		$data['email_cust'] = $email_cust;

		$this->load->view('finance_invoice_customer/invoice_print_ppn_no_barcode_no_bali', $data);
	}

	public function invoice_print_ppn_no_barcode_no_pdf_bali()
	{
		$this->load->library('Dom_pdf');
		//pdf
		$fname = '';
		$barcode = '';
		$head_bg = 'bg-t-bali';
		$by_create = 'Nadya Nisitaswari';
		$by_approve = 'Setia Indarwati';
		$phone_cust = '0361 - 4715 157';
		$email_cust = 'billing.bali@gmedia.co.id';
		$q = $this->finance_invoice_customer->select_data();
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$fname = str_replace("/", "_", $r['no_invoice'] . ' - ' . $r['nama']);
				$this->qrcode($fname, 'Approved by ' . $by_approve . ' ' . $r['date_approved'] . ' Printed by ' . $by_create . ' ' . $r['date_printed']);
				//$barcode = '<img width="100" style="display:inline-table" src="'.base_url().'cli/qrcode?text=Approved by Budi Yanto%0A'.$r['date_approved'].'%0APrinted by Cahyaningrum%0A'.$r['date_printed'].'"  />';
				if ($r['ppn_tax'] == '1') {
					$head_bg = 'bg-msd-bali';
				}
			}
		}

		$data['title_page_table'] = 'Invoice';
		$data['pdf'] = '1';
		$data['barcode'] = $fname;
		$data['head_bg'] = $head_bg;
		$data['by_create'] = $by_create;
		$data['by_approve'] = $by_approve;
		$data['phone_cust'] = $phone_cust;
		$data['email_cust'] = $email_cust;

		$this->load->view('finance_invoice_customer/invoice_print_ppn_no_barcode_no_bali', $data);

		$html = $this->output->get_output();

		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream($fname . ".pdf");

		unlink("assets/images/" . $fname . '.png');
	}

	public function invoice_belum_edit()
	{
		$id = $this->uri->segment(3);
		echo $this->finance_invoice_customer->invoice_belum_edit($id);
	}

	public function invoice_sudah_edit()
	{
		$id = $this->uri->segment(3);
		echo $this->finance_invoice_customer->invoice_sudah_edit($id);
	}


	public function invoice_sudah_approve()
	{
		$id = $this->uri->segment(3);
		echo $this->finance_invoice_customer->invoice_sudah_approve($id);
	}


	public function invoice_sudah_print()
	{
		$id = $this->uri->segment(3);
		echo $this->finance_invoice_customer->invoice_sudah_print($id);
	}

	public function qrcode($qr_image, $value = 'gmedia')
	{
		$this->load->library('ciqrcode');
		$qr_image = $qr_image . '.png';
		$params['data'] = $value;
		$params['level'] = 'H';
		$params['size'] = 3;
		$params['savename'] = "assets/images/" . $qr_image;
		$this->ciqrcode->generate($params);
	}


	public function invoice_create_cust()
	{
		$data = json_decode(file_get_contents('php://input'), true);
		$rawData = file_get_contents('php://input');
		$data = explode('&', $rawData);
		$arr = array();
		foreach ($data as $key => $val) {
			$data2 = explode('=', $val);
			$arr[$data2[0]] = $data2[1];
		}

		$cust_id = $arr['cust_id'];
		$serv_id = $arr['serv_id'];
		$bulan = $arr['bulan'];
		$tahun = $arr['tahun'];
		$tgl = $arr['tgl'];
		$flag = $arr['flag'];

		// $cust_id = '03.0745.0119';
		// $serv_id = '0745-1';
		// $bulan = '02';
		// $tahun = '2019';
		return $this->finance_invoice_customer->invoice_create_cust($cust_id, $serv_id, $bulan, $tahun, $tgl, $flag);
	}
	public function invoice_create_cust_test()
	{
		$this->finance_invoice_customer->invoice_create_cust();
	}

	function invoice($id)
	{
		$data['divisi'] = $this->divisi;
		$data['arpost'] = $arpost = $this->Finance_model->get('arpost', $id)->row();
		$data['arpost2'] = $this->Finance_model->get_from_arr('arpost', array('id_order' => $data['arpost']->id_order, 'flag_dp' => 2))->row();
		// print_r($data['arpost2']);exit;
		$data['cust'] = $this->Finance_model->get('ms_customers', $data['arpost']->id_cust)->row();
		$data['header'] = $order = $this->Finance_model->get('order_header', $data['arpost']->id_order)->row();
		// print_r($data['arpost']->id_order);exit;
		$data['site'] = $site = $this->Finance_model->get('ms_site', $data['arpost']->id_site)->row();

		// print_r($data['header']->id_site);exit;
		$data['contact'] = $this->Finance_model->get_from_arr('ms_contact', array('id_site' => $data['arpost']->id_site, 'flag' => 'f', 'status' => '1'))->row();
		if ($data['arpost']->flag == 1) {
			$data['transaksi'] = $this->Finance_model->get_transaksi('', '', $data['arpost']->nomor, '', '', '', '', $data['arpost']->id_order)->result();
			$data['transaksi_dp'] = $this->Finance_model->get_transaksi('', '', $data['arpost']->nomor, '', '', '', '', $data['arpost']->id_order, 'DP')->row();
			$data['transaksi_pn'] = $this->Finance_model->get_transaksi('', '', '', '', '', '', '', $data['arpost']->id_order, 'PN')->row();
			$data['serv'] = $this->Finance_model->get_order('order_service', '', $data['arpost']->id_order)->row();
			$data['sum_lg'] = $this->Finance_model->sum_transaksi_langganan($data['arpost']->nomor)->row();
		} else {
			$data['transaksi'] = $this->Finance_model->get_transaksi('', '', $data['arpost']->nomor, '', '', '', '', $data['arpost']->id_order, '', '', 1)->result();
			$data['serv'] = $this->Finance_model->get_order('order_service', '', '', '', $data['arpost']->id_site)->row();
			$data['brg'] = $this->Finance_model->get_order('order_barang', '', $data['arpost']->id_order)->result();
			$data['jasa'] = $this->Finance_model->get_order('order_jasa', '', $data['arpost']->id_order)->result();
			$data['check1'] = $data['check2'] = $data['check3'] = '';
			if ($data['arpost']->label_barang == '1') {
				$data['check1'] = 'checked';
			} else if ($data['arpost']->label_barang == '2') {
				$data['check2'] = 'checked';
			} else if ($data['arpost']->label_barang == '3') {
				$data['check3'] = 'checked';
			}
			// print_r($data['jasa']);exit;
		}
		$selected1 = $selected2 = $selected3 = '';
		if ($order->address_display == 1) {
			$dat['alamate'] = $site->alamat;
			$dat['kotae'] = $site->kota;
			$selected1 = 'checked';
		} else if ($order->address_display == 2) {
			$selected2 = 'checked';
			$dat['alamate'] = $site->alamat2;
			$dat['kotae'] = $site->kota2;
		} else if ($order->address_display == 3) {
			$selected3 = 'checked';
			$dat['alamate'] = $site->alamat3;
			$dat['kotae'] = $site->kota3;
		} else {
			$selected1 = 'checked';
			$dat['alamate'] = $site->alamat;
			$dat['kotae'] = $site->kota;
		}
		$data['radio'] = '<hr><label class="radio radio-inline m-r-20">
					<input ' . $selected1 . ' type="radio" name="address" value="1">
					<i class="input-helper"></i>  
					Alamat NPWP : ' . $site->alamat . '; Kota : ' . $site->kota . '
				</label><hr>
				<label class="radio radio-inline m-r-20">
					<input ' . $selected2 . ' type="radio" name="address" value="2">
					<i class="input-helper"></i>  
					Alamat Penagihan : ' . $site->alamat2 . '; Kota : ' . $site->kota2 . '
				</label><hr>
				<label class="radio radio-inline m-r-20">
					<input ' . $selected3 . ' type="radio" name="address" value="3">
					<i class="input-helper"></i>  
					Alamat Installasi : ' . $site->alamat3 . '; Kota : ' . $site->kota3 . '
				</label><hr>';

		$selected1 = $selected2 = '';
		if ($order->name_display == 1) {
			$selected1 = 'checked';
		} else if ($order->name_display == 2) {
			$selected2 = 'checked';
		}
		$data['radio_nama'] = '<hr><label class="radio radio-inline m-r-20">
					<input ' . $selected1 . ' type="radio" name="name_display" value="1">
					<i class="input-helper"></i>  
					' . $data['cust']->nama . '
				</label><hr>
				<label class="radio radio-inline m-r-20">
					<input ' . $selected2 . ' type="radio" name="name_display" value="2">
					<i class="input-helper"></i>  
					' . $site->nama . '
				</label>';

		$this->load->view('header', $dat);
		$dat['divisi'] = $this->divisi;

		// $this->load->view('menu');
		if ($data['arpost']->flag == 1) {
			if ($data['header']->ppn == 1 or $data['header']->ppn == 3) {
				$this->load->view('finance/invoice', $data);
			} else {
				$this->load->view('finance/invoice_nonppn', $data);
			}
		} else {
			$this->load->view('finance/invoice_pembelian', $data);
		}
		$this->load->view('footer');
	}

	function invoice_merge($id)
	{

		// Include WKPDF class.

		$data['arpost1'] = $this->Marketing_model->get('arpost', $id)->row();
		//urut tanggal dari periode paling awal
		$data['get'] = $this->Marketing_model->get_merge_bydate($id);


		// $data['site'] = $site = $this->Finance_model->get('ms_site',$data['arpost1']->to_site)->row();
		// $data['contact'] = $this->Finance_model->get_from_arr('ms_contact', array('id_site'=>$data['arpost1']->to_site, 'flag'=>'f', 'status'=>'1'))->row();
		$dat['divisi'] = $this->divisi;
		$this->load->view('header', $dat);
		if ($data['arpost1']->ppn == 1 or $data['arpost1']->ppn == 3) {
			$this->load->view('finance/invoice_merge', $data);
		} else {
			$this->load->view('finance/invoice_merge_nonppn', $data);
		}
		$this->load->view('footer');
	}

	function invoicepdf($id)
	{
		$data['arpost1'] = $this->Marketing_model->get('arpost', $id)->row();
		//urut tanggal dari periode paling awal
		$data['get'] = $this->Marketing_model->get_merge_bydate($id);

		$this->load->view('finance/invoice_merge_pdf', $data);
	}


	function invoice_merge_proses()
	{

		if (!empty($this->input->post('label_tgl'))) {
			$data['label_tgl'] = $this->input->post('label_tgl');
		} else {
			$data['label_tgl'] = '0000-00-00';
		}
		$this->Marketing_model->update('arpost', $data, $this->input->post('id_arpost'));

		redirect('Finance_invoice_customer/invoice_merge/' . $this->input->post('id_arpost'));
	}
	function invoice_proses()
	{
		$data = array(
			'label_barang' => $this->input->post('flag'),
			'label' => $this->input->post('label')
		);
		$this->Marketing_model->update('arpost', $data, $this->input->post('id_arpost'));
		redirect('Finance_invoice_customer/invoice/' . $this->input->post('id_arpost'));
	}
	function invoice_so($dari = '', $sampai = '', $region = '', $ppnflag = '', $site = '')
	{
		check_login();
		$data['divisi'] = $this->divisi;
		$data['title'] = "DAFTAR INVOICE PROJECT";
		$data['icon'] = "zmdi zmdi zmdi-bookmark";
		$data['act_menu'] = 'Account Receivable';
		$data['option_company'] = $this->Marketing_model->get_opt_site('', 1);
		$data['id_site'] = $site;
		$grand = $data['titlenote'] = '';
		if ($site) {
			$gs = $this->Marketing_model->get('ms_site', $site)->row();
			$gc = $this->Marketing_model->get('ms_customers', $gs->id_cust)->row();
			$data['titlenote'] = "Site : " . $gc->nama . ' - ' . $gs->nama . "";
		}
		if (!empty($dari)) {
			if (!empty($sampai)) {
				$data['titlenote'] .= " | Periode : " . $this->Kamus_model->tanggal_indo($dari) . " - " . $this->Kamus_model->tanggal_indo($sampai) . "";
			} else {
				$data['titlenote'] .= " | Periode >= " . $this->Kamus_model->tanggal_indo($dari) . "";
			}
		} elseif (!empty($sampai)) {
			if (!empty($dari)) {
				$data['titlenote'] .= " | Periode : " . $this->Kamus_model->tanggal_indo($dari) . " - " . $this->Kamus_model->tanggal_indo($sampai) . "";
			} else {
				$data['titlenote'] .= " | Periode <= " . $this->Kamus_model->tanggal_indo($sampai) . "";
			}
		} else {
			$data['titlenote'] .= " | Periode bulan ini";
			$dari = date('Y-m-01');
			$sampai = date('Y-m-t');
		}
		if ($region) {
			$getregion = $this->Finance_model->get('ms_region', $region)->row();
			$data['titlenote'] .= " | REGION : <i class='zmdi zmdi zmdi-city'></i> " . $getregion->region;
			$data['region'] = $region;
		}
		if ($ppnflag) {
			if ($ppnflag == '1') {
				$data['titlenote'] .= " | <i class='zmdi zmdi zmdi-money'></i> PPN";
			} else if ($ppnflag == '3') {
				$data['titlenote'] .= " | <i class='zmdi zmdi zmdi-money'></i> NON-PPN";
			}
			$data['ppnflag'] = $ppnflag;
		}
		$data['opt_region'] = $this->Marketing_model->get_opt_region();
		$data['button'] =
			anchor('finance/print_so/' . $dari . '/' . $sampai . '/' . $region . '/' . $ppnflag, '<i class="zmdi zmdi-print"></i>', array('class' => 'btn bgm-red btn-float waves-effect waves-circle waves-float tooltipss', 'target' => '_blank', 'title' => 'Download PDF')) . ' ' .
			anchor('Finance/so_email_all/' . $dari . '/' . $sampai . '/' . $region . '/' . $ppnflag, '<i class="zmdi zmdi-email"></i>', array('class' => 'btn bgm-amber btn-float waves-effect waves-circle waves-float tooltipss', 'title' => 'Kirim Semua Email', 'style' => 'right:80px')) . ' ' .
			anchor('#modalFilter', '<i class="zmdi zmdi-filter-list"></i>', array('class' => 'btn bgm-cyan btn-float waves-effect waves-circle waves-float tooltipss', 'title' => 'Filter Data', 'data-toggle' => "modal", 'id' => 'btcek', 'style' => 'right:136px'));

		$query = $this->Finance_model->get_arpost_query($dari, $sampai, 1, 2, 1, $region, $ppnflag, $site)->result();
		$table = '<table id="example" class="uk-table uk-table-hover uk-table-striped row-border" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th style="text-align:center;">No</th>
							<th style="text-align:center;">Invoice</th>
							<th style="text-align:center;">Client Name</th>
							<th style="text-align:center;">Site</th>
							<th style="text-align:center;">Tanggal</th>
							<th style="text-align:center;">Nominal</th>
							<th style="text-align:center;" data-sortable="false">Email</th>
						</tr>
					</thead>
					<tbody>';
		$grand = $o = 0;
		$now = date('Y-m-d');
		foreach ($query as $row) {
			$client = $this->Finance_model->get('ms_customers', $row->id_cust)->row();
			$order = $this->Finance_model->get('order_header', $row->id_order)->row();
			$site = '';
			if ($order->id_site) {
				$site = $this->Marketing_model->get('ms_site', $order->id_site)->row();
			}
			$table .= '<tr>
					<td style="text-align:center;vertical-align:middle;">' . ++$o . '</td>
					<td style="vertical-align:middle;"><a target="_blank" href="' . base_url() . 'Finance/invoice/' . $row->id . '">' . $row->nomor . '</a></td>
					<td style="vertical-align:middle;">' . $client->idcust . ' - ' . $client->nama . '</td>
					<td style="vertical-align:middle;">' . (isset($site->nama) ? $site->nama : '') . '</td>
					<td style="vertical-align:middle;">' . $this->Kamus_model->tanggal_indo($row->tanggal) . '</td>
					<td style="vertical-align:middle;">Rp ' . $this->Kamus_model->uang($row->jml_piutang) . '</td>
					<td style="text-align:center;vertical-align:middle;"><a id="email2_' . $row->id . '" class="btn btn-sm sa-email2 bgm-green btn-default waves-effect"><span class="zmdi zmdi-email"></span></a></td>
				</tr>';
			$grand += $row->jml_piutang;
		}
		$table .= '</tbody>
				</table>';
		$data['table'] = $table;
		$data['grand'] = '<center>Jumlah Invoice : <b>' . $o . '</b><br>Total : <b>Rp ' . $this->Kamus_model->uang($grand) . '</b></center>';
		$data['dari'] = $dari;
		$data['sampai'] = $sampai;
		$data['filter_ok'] = 'filter_inv_so';

		$this->load->view('header', $data);
		$this->load->view('Finance_invoice_customer/accreceives');
		// $this->load->view('footer');
	}
	function print_so($dari = '', $sampai = '', $region = '', $ppnflag = '', $site = '')
	{
		check_login();
		$data['title'] = "DAFTAR INVOICE PROJECT";
		if ($site) {
			$gs = $this->Marketing_model->get('ms_site', $site)->row();
			$gc = $this->Marketing_model->get('ms_customers', $gs->id_cust)->row();
			$data['titlenote'] = "Site : " . $gc->nama . ' - ' . $gs->nama . "";
		}
		if (!empty($dari)) {
			if (!empty($sampai)) {
				$data['titlenote'] .= " | Periode : " . $this->Kamus_model->tanggal_indo($dari) . " - " . $this->Kamus_model->tanggal_indo($sampai) . "";
			} else {
				$data['titlenote'] .= " | Periode >= " . $this->Kamus_model->tanggal_indo($dari) . "";
			}
		} elseif (!empty($sampai)) {
			if (!empty($dari)) {
				$data['titlenote'] .= " | Periode : " . $this->Kamus_model->tanggal_indo($dari) . " - " . $this->Kamus_model->tanggal_indo($sampai) . "";
			} else {
				$data['titlenote'] .= " | Periode <= " . $this->Kamus_model->tanggal_indo($sampai) . "";
			}
		} else {
			$data['titlenote'] .= " | Periode bulan ini";
			$dari = date('Y-m-01');
			$sampai = date('Y-m-t');
		}
		if ($region) {
			$getregion = $this->Finance_model->get('ms_region', $region)->row();
			$data['titlenote'] .= " | REGION : <i class='zmdi zmdi zmdi-city'></i> " . $getregion->region;
		}
		if ($ppnflag) {
			if ($ppnflag == '1') {
				$data['titlenote'] .= " | <i class='zmdi zmdi zmdi-money'></i> PPN";
			} else if ($ppnflag == '3') {
				$data['titlenote'] .= " | <i class='zmdi zmdi zmdi-money'></i> NON-PPN";
			}
		}
		$query = $this->Finance_model->get_arpost_query($dari, $sampai, 1, 2, 1, $region, $ppnflag, $site)->result();
		$table = '<table id="data-table-so" class="table table-condensed table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Invoice</th>
							<th>Client</th>
							<th>Site</th>
							<th>Tanggal</th>
							<th>Nominal</th>
						</tr>
					</thead>
					<tbody>';
		$o = 0;
		$now = date('Y-m-d');
		foreach ($query as $row) {
			$client = $this->Finance_model->get('ms_customers', $row->id_cust)->row();
			$order = $this->Finance_model->get('order_header', $row->id_order)->row();
			$site = '';
			if ($order->id_site) {
				$site = $this->Marketing_model->get('ms_site', $order->id_site)->row();
			}
			$table .= '<tr>
					<td style="vertical-align:middle;">' . ++$o . '</td>
					<td style="vertical-align:middle;">' . $row->nomor . '</td>
					<td style="vertical-align:middle;">' . $client->idcust . ' - ' . $client->nama . '</td>
					<td style="vertical-align:middle;">' . (isset($site->nama) ? $site->nama : '') . '</td>
					<td style="vertical-align:middle;">' . $this->Kamus_model->tanggal_indo($row->tanggal) . '</td>
					<td style="vertical-align:middle;">Rp ' . $this->Kamus_model->uang($row->jml_piutang) . '</td>
				</tr>';
		}
		$table .= '</tbody>
				</table>';
		$data['table'] = $table;
		$data['dari'] = $dari;
		$data['sampai'] = $sampai;

		$this->load->library('pdf');
		$file_pdf = $this->load->view('Finance_invoice_customer/pdf', $data, TRUE);
		$orientation = null;
		$this->pdf->pdf_create($file_pdf, 'DataInvoiceProject', TRUE, $orientation);
	}
	function invoiceso_proses()
	{
		$data = array(
			'label_note' => $this->input->post('label_note')
		);
		if (!empty($this->input->post('label_tgl'))) {
			$data['label_tgl'] = $this->input->post('label_tgl');
		}
		$this->Marketing_model->update('arpost', $data, $this->input->post('id_arpost'));

		$arpost = $this->Finance_model->get('arpost', $this->input->post('id_arpost'))->row();
		$order = $this->Finance_model->get('order_header', $arpost->id_order)->row();
		$data = array(
			'name_display' => $this->input->post('name_display'),
			'address_display' => $this->input->post('address')
		);
		$this->Marketing_model->update('order_header', $data, $order->id);

		redirect('Finance_invoice_customer/invoice/' . $this->input->post('id_arpost'));
	}
	function get_print()
	{
		$this->load->library('pdfgenerator');
		$file_pdf = $data = null;
		$now = date('Y-m-d');
		$id_inv = $this->input->post('inv');
		$inv = explode(',', $id_inv);
		$data['more'] = count($inv);
		$a = $no = 0;
		$ppn = $lain = $detail = null;
		foreach ($inv as $row) {
			$file_pdf = null;
			$data['invoice'] = $this->finance_invoice_customer->get_data_cetak($row);
			foreach ($data['invoice'] as $low) {
				$project = $low->flag;
				$merge = $low->merge_type;
			}
			if ($merge == 1) {
				$data['detail'] = $this->finance_invoice_customer->get_data_detail_merge($row);
				foreach ($data['detail'] as $low) {
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
									'servid' => NULL
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
							'servid' => $low->servid
						);
						$no++;
					}
				}
				$ppn = $this->finance_invoice_customer->get_ppn_merge($row);
			} else {
				$data['detail'] = $this->finance_invoice_customer->get_data_detail($row);
				foreach ($data['detail'] as $low) {
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
									'servid' => NULL
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
							'servid' => $low->servid
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
			if (!empty($file_pdf)) {
				$date = date('Y-m-d H:i:s');
				$status = 3;
				$data = array(
					'date_printed' => $date,
					'status_invoice' => $status
				);
				$this->finance_invoice_customer->update1('arpost', $data, $row);
			}
		}
		if (!empty($file_pdf)) {
			$paper = 'Legal';
			$orientation = "portrait";
			$this->finance_invoice_customer->update1('arpost', $data, $row);
			$a++;
			// $this->pdfgenerator->generate($file_pdf, $now, TRUE, $paper, $orientation);
		}
		if ($a > 0) {
			echo 1;
		} else {
			echo 0;
		}
	}

	function print_selected()
	{
		$this->load->library('pdfgenerator');
		$file_pdf  = null;
		$now = date('Y-m-d');
		$n_ppn = 0;
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
					if ($low->jenis_transaksi == 'PN') {
						$n_ppn = $n_ppn + $low->nominal;
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
					if ($low->jenis_transaksi == 'PN') {
						$n_ppn = $n_ppn + $low->nominal;
					}
				}
				$ppn = $this->finance_invoice_customer->get_ppn($row);
			}
			if ($project == 2) {
				$data['detail'] = $this->finance_invoice_customer->get_data_detail_project($row);
				$file_pdf .= $this->load->view('finance_invoice_customer/cetak_project', $data, TRUE);
			} else {
				if ($ppn != 2 && $n_ppn > 0) {
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

	function cetak($a)
	{
		$this->load->library('pdfgenerator');
		$file_pdf = null;
		$project = 0;
		$ppn = null;
		$merge = $no = $voucher = 0;
		$now = date('Y-m-d');
		$id_inv = $a;
		$inv = explode(',', $id_inv);
		$data['more'] = count($inv);
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

	function email_selected()
	{
		$this->load->library('pdfgenerator');
		$a = $no = 0;
		$nama_invoice = null;
		$tanggal_invoice = null;
		$due_date = null;
		$periode_dari = null;
		$file_pdf = null;
		$now = date('Y-m-d');
		$id_inv = $this->input->post('inv');
		$inv = explode(',', $id_inv);
		$email = $email2 = null;
		foreach ($inv as $row) {
			$file_pdf = null;
			$data['invoice'] = $this->finance_invoice_customer->get_data_cetak($row);
			foreach ($data['invoice'] as $low) {
				$project = $low->flag;
				$merge = $low->merge_type;
			}
			if ($merge == 1) {
				$data['detail'] = $this->finance_invoice_customer->get_data_detail_merge($row);
				foreach ($data['detail'] as $low) {
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
									'servid' => NULL
								);
								$no++;
							}
						}
					} else {
						$nama_invoice = $low->nama;
						$tanggal_invoice = $low->tanggal_invoice;
						$due_date = $low->due_date;
						$periode_dari = $low->periode_dari;
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
							'servid' => $low->servid
						);
						$no++;
					}
					$email2 = $low->email;
				}
				$ppn = $this->finance_invoice_customer->get_ppn_merge($row);
			} else {
				$data['detail'] = $this->finance_invoice_customer->get_data_detail($row);
				foreach ($data['detail'] as $low) {
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
									'servid' => NULL
								);
								$no++;
							}
						}
					} else {
						$nama_invoice = $low->nama;
						$tanggal_invoice = $low->tanggal_invoice;
						$due_date = $low->due_date;
						$periode_dari = $low->periode_dari;
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
							'servid' => $low->servid
						);
						$no++;
					}
					$email2 = $low->email;
				}
				$ppn = $this->finance_invoice_customer->get_ppn($row);
			}
			$fname = $nama_invoice . '-' . $now;
			if ($ppn != 2) {
				$file_pdf = $this->load->view('finance_invoice_customer/email_ppn', $data, TRUE);
				$this->pdfgenerator->create_report($file_pdf, $fname);
			} else {
				$file_pdf = $this->load->view('finance_invoice_customer/email_nonppn', $data, TRUE);
				$this->pdfgenerator->create_report($file_pdf, $fname);
			}
			$file       = './assets/generate/report/invoice/' . $nama_invoice . '-' . $now . '.pdf';
			$from       = 'finance.smg@gmedia.co.id';
			// $to         = $data['site']->email_billing;
			$to         = $email2;
			// $bcc         = 'edy.kristanto@gmedia.co.id';
			$bcc         = 'invoice.smg@gmedia.co.id,retno.ningsih@gmedia.co.id,bayu.christian@gmedia.co.id';
			$subject    = '[GMEDIA] Billing GMedia Periode ' . $this->Kamus_model->tanggal_indo($tanggal_invoice);

			$email      = '<p>Kepada Yth,</p>
							<p style="text-transform:uppercase;"><b>' . $nama_invoice . '</b></p>
							<p>&nbsp;</p>
							<p>Terima kasih atas kepercayaan anda menggunakan layanan GMedia untuk memenuhi kebutuhan internet anda.<p>
							<p>Berikut kami lampirkan tagihan Anda pada periode <b>' . $this->Kamus_model->tanggal_indo($periode_dari) . '</b> dan jatuh tempo pembayaran adalah tanggal <b>' . $this->Kamus_model->tanggal_indo($due_date) . '</b>.</p>
							<p>Konfirmasi pembayaran dapat Anda sampaikan melalui email <b>finance.smg@gmedia.co.id</b></p>
							<p>&nbsp;</p>
							<p>Hormat kami,</p>  
							<p><b>Finance GMedia</b></p>   
						   ';
			$title      = 'Official Finance GMedia';
			$z = $this->Kamus_model->kirim_email($title, $from, $to,  $subject, $email, '', $file, '', $bcc);
			if (!empty($z)) {
				unlink($file);
				$a++;
				$date = date('Y-m-d H:i:s');
				$status = 3;
				$data = array(
					'date_email' => $date,
					'status_invoice' => $status
				);
				$this->finance_invoice_customer->update1('arpost', $data, $row);
			}
		}
		if ($a > 0) {
			echo 1;
		} else {
			echo 0;
		}
	}

	function faktur_selected()
	{
		$id_inv = $this->input->post('inv');
		$inv = explode(',', $id_inv);
		$count = count($inv);
		$a = $this->finance_invoice_customer->get_faktur_kosong();
		$b = 0;
		if ($count > $a) {
			echo 0;
		} else {
			foreach ($inv as $row) {
				$data['invoice'] = $this->finance_invoice_customer->get_data_cetak($row);
				foreach ($data['invoice'] as $low) {
					$data['faktur'] = $this->finance_invoice_customer->get_faktur()->result();
					foreach ($data['faktur'] as $mow) {
						$no_faktur = $mow->no_faktur;
						$id = $mow->id;
						$timestamp = $mow->tanggal;
					}
					$data['tax'] = $this->finance_tax_transaksi->get_tax($low->id)->result();
					if (!empty($data['tax'])) {
						break;
					} else {
						$now = date('Y-m-d');
						$datetime = explode(" ", $timestamp);
						$tanggal_faktur = $datetime[0];
						$jumlah = $low->jumlah;
						$nama_pkp = $low->nama_invoice;
						$this->finance_tax_transaksi->insert_generate($no_faktur, $nama_pkp, $tanggal_faktur, '', $jumlah, $low->id);
						$dat = array(
							'status' => 1,
							'update_at' => $now,
							'update_by' => $this->session->userdata('username'),
						);
						$this->finance_tax_transaksi->update_no($id, $dat);
						$dat = array(
							'date_faktur' => $now,
							'status_invoice' => 3,
						);
						$this->finance_invoice_customer->update_inv($low->id, $dat);
						$b = 1;
						break;
					}
				}
			}
			echo $b;
		}
	}


	//generate invoice
	function generate_invoice()
	{
		check_login();
		$client_kode = $this->input->post('id_client');
		$get = $this->finance_invoice_customer->get_generate_order($client_kode)->result();
		// print_r($get);exit;
		$gabungan = array();
		$lk = 0;
		$z = 0;
		$site1 = null;
		$dari = null;
		$sampai = null;
		foreach ($get as $row) {

			//nando =111178 non ppn
			//alya =111205 ppn
			//sianne = 111127 all
			if ($this->session->userdata('userid') == '111178') {
				if ($row->ppn != 2) {
					continue;
				}
			} else if ($this->session->userdata('userid') == '111205') {
				if ($row->ppn == 2) {
					continue;
				}
			} else {

				if ($this->session->userdata('userid') == '111127' || $this->session->userdata('userid') == '111186' || $this->session->userdata('userid') == '111223') {
				} else {
					$this->session->set_flashdata('message', 'Generate data gagal,tidak ada hak akses.');
					$this->session->set_flashdata('notifikasi', 'warning');
					redirect('finance_invoice_customer');
				}
			}

			if ($row->periode_tagih == 0) {
				continue;
			}
			//cek apakah ini invoice pertama atau bukan
			// $cek = $this->finance_invoice_customer->get_from_arr('arpost', array('id_order' => $row->id))->num_rows();

			// if ($cek != 0) {
			//cek apakah ada data sudah fixed atau ada revisi
			// 	if ($row->revisi == 1) {
			// 		continue;
			// 	}
			// }

			// $date = $this->input->post('tahun').'-'.$this->input->post('bulan').'-01';				
			$periode = $this->input->post('tahun') . '-' . $this->input->post('bulan') . '-01';

			$cek_dismantle = $this->finance_invoice_customer->get_from_arr('dismantle', array('id_order' => $row->id, 'tanggal >=' => $periode, 'status' => 2))->num_rows();
			if (!empty($cek_dismantle)) {
				continue;
			}

			$cekweekend = date('N', strtotime($periode));
			if ($cekweekend == 6) {
				$tgl_invoice = $this->input->post('tahun') . '-' . $this->input->post('bulan') . '-03';
			} else if ($cekweekend == 7) {
				$tgl_invoice = $this->input->post('tahun') . '-' . $this->input->post('bulan') . '-02';
			} else {
				$hol = $this->finance_invoice_customer->get_from_arr('hrd.hol', array('hol_tgl' => $periode))->num_rows();
				if ($hol > 0) {
					$tgl_invoice = $this->input->post('tahun') . '-' . $this->input->post('bulan') . '-02';
				} else {
					$tgl_invoice = $periode;
				}
			}

			$periode2 = date("Y-m-t", strtotime($periode));
			//tentukan tgl cetak_bill 
			$start_awal = $periode;
			$periode_tagih = $row->periode_tagih;
			$cetak_bill = date('Y-m-01', strtotime($start_awal . ' +' . $periode_tagih . ' month'));
			///////////////////////////////////////////////////////

			//Cek dulu apakah data transaksi sudah ada dan periode tidak kurang dari tanggal start billing
			$cek_transaksi = $this->finance_invoice_customer->get_transaksi('', '', '', '', '', '', $periode, $row->id)->num_rows();
			$site = $this->finance_invoice_customer->get('ms_site', $row->id_site)->row();
			if (empty($site)) {
				continue;
			}

			if ($cek_transaksi == 0 and $periode >= $row->tanggal) {

				//gnerate nomor invoice baru atau tidak
				$next_inv = $this->generate_noinvoice($site->id_region, $row->ppn, 1, $this->input->post('bulan'), $this->input->post('tahun'));
				$orderlain = $this->finance_invoice_customer->sum_lain($row->id)->row();
				$lain = $orderlain->jml;

				$get_serv = $this->finance_invoice_customer->get_order('order_service', '', $row->id)->row();
				$total_tax = $total_lg = 0;
				for ($p = 0; $p < $row->periode_tagih; $p++) {
					$tgl_next = date('Y-m-01', strtotime($periode . ' +' . $p . ' month'));
					$bl = 0;
					if (!empty($get_serv->biaya_langganan)) {
						$bl = $get_serv->biaya_langganan;
					}
					// $nv = 0;
					// if (!empty($row->nilai_voucher)) {
					// 	$nv = $row->nilai_voucher;
					// }
					// $biaya = $bl - $nv;
					// $tax = '';
					// if ($row->ppn == 3) {
					// 	$biaya = ($bl - $nv) / 1.1;
					// 	$tax = ($bl - $nv) - $biaya;
					// 	$lain = $orderlain->jml  / 1.1;
					// 	$txlain = $orderlain->jml - $lain;
					// 	$tax = $tax +  $txlain;
					// } else if ($row->ppn == 1) {
					// 	$tax = ($bl - $nv) * 0.1;
					// 	$txlain = $orderlain->jml * 0.1;
					// 	$totalperiod = ($bl - $nv) + $orderlain->jml;
					// 	$tax = $totalperiod * 0.1;
					// }
					$biaya = $bl;
					$tax = '';
					if ($row->ppn == 3) {
						$biaya = $bl / 1.1;
						$tax = $bl - $biaya;
						$lain = $orderlain->jml  / 1.1;
						$txlain = $orderlain->jml - $lain;
						$tax = $tax +  $txlain;
					} else if ($row->ppn == 1) {
						$tax = $bl  * 0.1;
						$txlain = $orderlain->jml * 0.1;
						$totalperiod = $bl  + $orderlain->jml;
						$tax = $totalperiod * 0.1;
					}
					//INSERT TRANSAKSI BIAYA LANGGANAN
					$tr1 = array(
						'id_order' => $row->id,
						'id_order_service' => $get_serv->id,
						'nomor' => $next_inv,
						'id_cust' => $row->id_cust,
						'tanggal' => $tgl_next,
						'nominal' => $biaya,
						'jenis_transaksi' => 'LG',
						'keterangan' => $row->label_note,
						'flag' => 'D',
						'id_user' => $this->session->userdata('userid'),
						'timestamp' => date('Y-m-d H:i:s')
					);
					$this->finance_invoice_customer->insert('transaksi', $tr1);
					$total_lg += $biaya;
					//$tr1 = array(
					//'id_order' => $row->id,
					//'id_order_service' => $get_serv->id,
					//'nomor' => $next_inv,
					//'id_cust' => $row->id_cust,
					//'tanggal' => $tgl_next,
					//'nominal' => $biaya,
					//'jenis_transaksi' => 'LG',
					//'flag' => 'D',
					//'id_user' => $this->session->userdata('id'),
					//'timestamp' => date('Y-m-d H:i:s')
					//);
					//$this->Marketing_model->insert('transaksi', $tr1);
					//$total_lg += $biaya;

					//INSERT TRANSAKSI LAIN2
					if ($orderlain->jml != 0) {
						$tr3 = array(
							'id_order' => $row->id,
							'id_cust' => $row->id_cust,
							'id_order_service' => $get_serv->id,
							'nomor' => $next_inv,
							'tanggal' => $tgl_next,
							'nominal' => $lain,
							'jenis_transaksi' => 'LL',
							'keterangan' => $row->label_note,
							'flag' => 'D',
							'id_user' => $this->session->userdata('userid'),
							'timestamp' => date('Y-m-d H:i:s')
						);
						$this->finance_invoice_customer->insert('transaksi', $tr3);
					}

					if ($row->ppn == 1 or $row->ppn == 3) {
						$tr2 = array(
							'id_order' => $row->id,
							'id_order_service' => $get_serv->id,
							'nomor' => $next_inv,
							'id_cust' => $row->id_cust,
							'tanggal' => $tgl_next,
							'nominal' => $tax,
							'jenis_transaksi' => 'PN',
							'keterangan' => $row->label_note,
							'flag' => 'D',
							'id_user' => $this->session->userdata('userid'),
							'timestamp' => date('Y-m-d H:i:s')
						);
						$this->finance_invoice_customer->insert('transaksi', $tr2);
						$total_lg += $tax;
					}

					if ($p == 0) {
						if ($row->materai == 2) {
							$materei = 3000;
							if ($total_lg >= 1000000) {
								$materei = 6000;
							}
							$tr3 = array(
								'id_order' => $row->id,
								'id_order_service' => $get_serv->id,
								'nomor' => $next_inv,
								'id_cust' => $row->id_cust,
								'tanggal' => $tgl_next,
								'nominal' => $materei,
								'jenis_transaksi' => 'MT',
								'keterangan' => $row->label_note,
								'flag' => 'D',
								'id_user' => $this->session->userdata('userid'),
								'timestamp' => date('Y-m-d H:i:s')
							);
							$this->finance_invoice_customer->insert('transaksi', $tr3);
						}
					}
				}
			}

			//cek apakah periode inputan sama dengan tgl cetak bill
			// if($periode<=$row->cetak_bill and $periode2>=$row->cetak_bill){
			//cek invoice pada bulan ini sudah ada atau blm
			$next = 0;
			$cek_invoice = $this->finance_invoice_customer->get_arpost('', '', '', $row->id, '', $periode, $periode2)->num_rows();
			if ($cek_invoice == 0) {
				if ($row->periode_tagih != 1) {
					if ($periode <= $row->cetak_bill and $periode2 >= $row->cetak_bill) {
						$next = 1;
					}
				} else {
					$next = 1;
				}
				if ($next == 1) {
					//penentuan periode akhir (untuk arpost)
					$arr = explode('-', $periode);
					if ($row->flag == '1') {
						$arr2 = explode('-', $periode);
						// $hari2 = cal_days_in_month(CAL_GREGORIAN, $arr2[1], $arr2[0]);

						if ($row->periode_tagih == 1 or $row->periode_tagih == 0) {
							$sampai = date("Y-m-t", strtotime($arr[0] . '-' . $arr[1] . '-01'));
							// $sampai = $arr[0].'-'.$arr[1].'-'.$hari2;
						} else {
							$plus = date('Y-m-01', strtotime($periode . ' +' . ($row->periode_tagih - 1) . ' month'));
							$arr2 = explode('-', $plus);
							$sampai = date("Y-m-t", strtotime($arr2[0] . '-' . $arr2[1] . '-01'));
							// $sampai = $arr2[0].'-'.$arr2[1].'-'.$hari2;
						}
						$dari = $periode;
					} else {
						$dari = date('Y-m-01', strtotime($periode . ' -' . $row->periode_tagih . ' months'));
						$sampai = date('Y-m-d', strtotime($periode . ' - 1 day'));
					}
					echo $row->id . ' ';
					$get_inv = $this->finance_invoice_customer->get_transaksi('', '', '', '', $dari, $sampai, '', $row->id, 'LG')->row();
					$sum_transaksi_plus = $this->finance_invoice_customer->get_sum_transaksi($row->id, $dari, $sampai, '', $get_inv->nomor, 'D')->row();
					$sum_transaksi_min = $this->finance_invoice_customer->get_sum_transaksi($row->id, $dari, $sampai, 'DP', $get_inv->nomor, 'C')->row();
					$tot = $sum_transaksi_plus->total - $sum_transaksi_min->total;
					$tot = round($tot, 2);
					$due = date("Y-" . $this->input->post('bulan') . "-15");
					$attention = 0;
					if ($row->attention_display == 1) {
						$attention = 0;
					} else {
						$attention = $row->attention_display;
					}
					$arpost = array(
						'id_order' => $row->id,
						'id_cust' => $row->id_cust,
						'id_site' => $row->id_site,
						'id_contact' => $attention,
						'id_address' => $row->address_display,
						'nomor' => $get_inv->nomor,
						'tanggal' => $periode,
						'tanggal_invoice' => $tgl_invoice,
						'periode_dari' => $dari,
						'periode_sampai' => $sampai,
						'jml_piutang' => $tot,
						'due_date' => $due,
						'id_user' => $this->session->userdata('userid'),
						'timestamp' => date('Y-m-d H:i:s')
					);

					//cek apakah ini invoice pertama atau bukan
					// if ($cek != 0) {
					// 	//cek apakah ada data sudah fixed atau ada revisi
					// 	if ($row->revisi == 11) {

					// 	} else {
					// 		continue;
					// 	}
					// }
					$data['status'] = '11';
					$z = $this->finance_invoice_customer->insert('arpost', $arpost, 'ya');

					$cetak_bill = date('Y-m-01', strtotime($row->cetak_bill . ' +' . $row->periode_tagih . ' month'));
					$arpost = array(
						'cetak_bill' => $cetak_bill
					);
					$this->finance_invoice_customer->update('order_header', $arpost, $row->id);

					//CASHBACK//////////////////////////////////
					$nom_cashback = $id_cashback_usage = 0;
					$cashback_usage = $this->finance_invoice_customer->get_from_arr('cashback_usage', array('id_order' => $row->id, 'status' => '1'))->row();

					if (!empty($cashback_usage)) {

						if ($cashback_usage->rule == 'cycle') {

							$cashback = $this->finance_invoice_customer->get_from_arr('cashback', array('id' => $cashback_usage->id_cashback))->row();

							$nom_cashback = $cashback->cashback * $row->periode_tagih;

							$cash = array(
								'id_arpost' => $z,
								'id_cashback_usage' => $cashback_usage->id,
								'nominal' => $nom_cashback,
								'tanggal' => $tgl_invoice
							);

							$cek_tr = $this->finance_invoice_customer->get_from_arr('cashback_transaksi', array('id_arpost' => $z, 'id_cashback_usage' => $cashback_usage->id, 'tanggal' => $tgl_invoice))->row();

							if (empty($cek_tr)) {

								$this->finance_invoice_customer->insert('cashback_transaksi', $cash);
							}
						}
					}
					////////////////////////////////////////////

				}
				$gabungan[$lk] = array(
					'id_arpost' => $z,
					'id_cust' => $row->id_cust,
					'id_site' => $row->id_site,
					'dari' => $dari,
					'sampai' => $sampai
				);
				$lk++;
			}
		} //disini harus menyimpan semua id_site dan id_arpost



		$dat = null;
		$daata = null;
		$dat = $this->finance_invoice_customer->get_setting_merge()->result();
		$a = 1;
		foreach ($dat as $mow) {
			$id = null;
			$x = null;
			$daata = $this->finance_invoice_customer->get_namasite($mow->id_cust, $a);
			if (!empty($daata)) {
				$a++;
				foreach ($daata as $low) {
					foreach ($gabungan as $row) {
						if ($low->id_site == $row['id_site']) {
							$id .= $x . $row['id_arpost'];
							$x = ",";
							$dari = $row['dari'];
							$sampai = $row['sampai'];
							$site1 = $row['id_site'];
						}
					}
				}
				if (count(explode(',', $id)) >= 2) {
					$this->merge_invoice_auto($id, $dari, $sampai, $site1, 1);
				}
			} else {
				$a = $a - 1;
				$daata = $this->finance_invoice_customer->get_namasite($mow->id_cust, $a);
				if (!empty($daata)) {
					$a++;
					foreach ($daata as $low) {
						foreach ($gabungan as $row) {
							if ($low->id_site == $row['id_site']) {
								$id .= $x . $row['id_arpost'];
								$x = ",";
								$dari = $row['dari'];
								$sampai = $row['sampai'];
								$site1 = $row['id_site'];
							}
						}
					}
					if (count(explode(',', $id)) >= 2) {
						$this->merge_invoice_auto($id, $dari, $sampai, $site1, 1);
					}
				}
			}
		}
		$this->session->set_flashdata('message', 'Generate data berhasil.');
		$this->session->set_flashdata('notifikasi', 'success');
		redirect('finance_invoice_customer');
	}

	function merge_invoice_auto($id, $dari, $sampai, $site1, $tipe)
	{
		$arr = explode(',', $id);
		$total = $ppn = 0;
		$f = $this->finance_invoice_customer->get('arpost', $arr[0])->row();
		$get = $this->finance_invoice_customer->get_from_arr('order_header', array('id' => $f->id_order))->row();
		$site = $this->finance_invoice_customer->get_from_arr('ms_site', array('id' => $get->id_site))->row();
		if (empty($dari)) {
			$dari = $f->tanggal;
		}

		$ex = explode('-', $sampai);
		$bul = $ex[1];
		$tah = $ex[0];
		$tt = $tah . '-' . $bul . '-01';
		$cekweekend = date('N', strtotime($tt));
		if ($cekweekend == 6) {
			$tgl_invoice = $tah . '-' . $bul . '-03';
		} else if ($cekweekend == 7) {
			$tgl_invoice = $tah . '-' . $bul . '-02';
		} else {
			$hol = $this->finance_invoice_customer->get_from_arr('hrd.hol', array('hol_tgl' => $tt))->num_rows();
			if ($hol > 0) {
				$tgl_invoice = $tah . '-' . $bul . '-02';
				// $tgl_invoice = $this->input->post('tahun').'-'.$this->input->post('bulan').'-02';					
			} else {
				// $tgl_invoice = $periode;
				$tgl_invoice = $tt;
			}
		}
		$due_date = date('Y-m-d', strtotime($tt . ' + 9 days'));
		$next_inv = $this->generate_noinvoice($site->id_region, $get->ppn, '', $bul, $tah);
		$arpost = array(
			'flag_dp' => '1',
			'id_region' => $site->id_region,
			'ppn' => $get->ppn,
			'tanggal' => $tt,
			'tanggal_invoice' => $tgl_invoice,
			'due_date' => $due_date,
			'jml_piutang' => $total,
			'to_site' => $site1,
			'merge_type' => $tipe,
			'id_user' => $this->session->userdata('userid'),
			'timestamp' => date('Y-m-d H:i:s')
		);
		if ($tipe == 1) {
			$arpost['nomor'] = $next_inv;
		}
		if (!empty($dari)) {
			$arpost['periode_dari'] = $dari;
		}
		if (!empty($sampai)) {
			$arpost['periode_sampai'] = $sampai;
		}
		$this->finance_invoice_customer->insert('arpost', $arpost);
		$get = $this->finance_invoice_customer->get_from_arr('arpost', $arpost)->row();

		for ($l = 0; $l < sizeof($arr); $l++) {
			$arpost = $this->db->query("SELECT SUM(a.nominal) AS total,z.ppn FROM erp_gmedia.`transaksi` a 
			LEFT JOIN erp_gmedia.`arpost` b ON a.nomor = b.nomor AND a.id_order=b.id_order
			LEFT JOIN (SELECT b.id,SUM(a.nominal) AS ppn FROM erp_gmedia.`transaksi` a 
			LEFT JOIN erp_gmedia.`arpost` b ON a.nomor = b.nomor AND a.id_order=b.id_order
			WHERE a.status != 9 AND a.jenis_transaksi = 'PN' AND b.id=$arr[$l] GROUP BY b.id) z ON z.id=b.id
			WHERE a.status != 9 AND a.jenis_transaksi != 'MT' AND b.id=$arr[$l] GROUP BY b.id")->row();
			$total += $arpost->total;
			$ppn += $arpost->ppn;
			$this->finance_invoice_customer->update('arpost', array('merge' => 1, 'to_site' => $site1), $arr[$l]);
			$arpost2 = array(
				'id_arpost_merge' => $get->id,
				'id_arpost' => $arr[$l]
			);
			$this->finance_invoice_customer->insert('arpost_merge', $arpost2);
		}
		if (!empty($ppn)) {
			$total = $total + $ppn;
			if ($total >= 1000000) {
				$total = $total + 6000;
			} else if ($total > 0 && $total < 1000000) {
				$total = $total + 3000;
			}
		}
		$arpost = array(
			'jml_piutang' => $total
		);
		$this->finance_invoice_customer->update('arpost', $arpost, $get->id);
	}

	function generate_noinvoice($region, $ppn, $flag = '', $bulan = '', $tahun = '')
	{

		//GENERATE NOMOR INVOICE
		$count = 0;

		$date = $tahun . '-' . $bulan . '-01';
		if ($ppn == 1 or $ppn == 3) {
			$ppnflag = 1;
		} else {
			$ppnflag = $ppn;
		}
		$count = $this->finance_invoice_customer->last_no_invoice($region, $ppnflag, $flag, $date)->row();

		$cr = $cr2 = '';
		if ($region == 3) {
			$cr = '03';
			$cr2 = 'GMD-SMG';
		} else if ($region == 7) {
			$cr = '07';
			$cr2 = 'GMD-SLTG';
		}

		$next_inv = '';
		if (empty($count)) {
			$next_inv = '0001';
			$next_inv2 = 1;
		} else {

			$next_inv2 = $count->count + 1;
			$digit = strlen(trim($next_inv2));
			$selisih_gigit = (4 - $digit);
			$nol = '';
			for ($m = 0; $m < $selisih_gigit; $m++) {
				$nol .= '0';
			}
			$next_inv .= $nol . $next_inv2;
		}

		if (empty($tahun)) {
			$tahun = date("y");
			$tahun = date("y");
		} else {
			$tahun = substr($tahun, -2);
		}
		if (empty($bulan)) {
			$bulan = date("m");
		}
		if ($ppn == 1 or $ppn == 3) {
			$next = $cr . '.' . $next_inv . '-' . $bulan . $tahun;
		} else {
			$next = $next_inv . '/' . $cr2 . '/' . $bulan . '/' . $tahun;
		}
		// echo $next;exit;
		if (empty($count)) {
			$this->finance_invoice_customer->insert_nomor('nomor', array('count' => $next_inv2, 'id_region' => $region, 'ppn' => $ppnflag, 'periode' => $date));
		} else {
			$this->finance_invoice_customer->update_arr('nomor', array('count' => $next_inv2), array('id_region' => $region, 'ppn' => $ppnflag, 'periode' => $date));
		}
		return $next;
	}

	function split_invoice($id)
	{
		$this->finance_invoice_customer->update_arr('arpost', array('status' => 9), array('id' => $id));
		$this->finance_invoice_customer->update_arr('arpost_merge', array('status' => 9), array('id_arpost_merge' => $id));
		$get = $this->finance_invoice_customer->get_from_arr('arpost_merge', array('id_arpost_merge' => $id))->result();
		foreach ($get as $row) {
			$this->finance_invoice_customer->update_arr('arpost', array('merge' => NULL), array('id' => $row->id_arpost));
		}
		$this->finance_invoice_customer->update1('arpost', array('status' => 9), $id);
		$this->session->set_flashdata('message', 'Invoice berhasil dipecah..');
		$this->session->set_flashdata('notifikasi', 'success');
		redirect('finance_invoice_customer');
	}

	function merge_invoice()
	{
		$id = $this->input->post('input_val');
		$arr = explode(',', $id);
		$total = $ppn = 0;
		$f = $this->finance_invoice_customer->get('arpost', $arr[0])->row();
		$get = $this->finance_invoice_customer->get_from_arr('order_header', array('id' => $f->id_order))->row();
		$site = $this->finance_invoice_customer->get_from_arr('ms_site', array('id' => $get->id_site))->row();
		if (empty($this->input->post('dari'))) {
			$dari = $f->tanggal;
		} else {
			$dari = $this->input->post('dari');
		}
		$sampai = $this->input->post('sampai');
		// for ($l = 0; $l < sizeof($arr); $l++) {
		// 	$arpost = $this->finance_invoice_customer->get('arpost', $arr[$l])->row();
		// 	if ($arpost->status_invoice >= 2) {
		// 		$this->session->set_flashdata('message', 'Invoice gagal digabung, sudah di approve.');
		// 		$this->session->set_flashdata('notifikasi', 'danger');
		// 		redirect('finance_invoice_customer');
		// 		exit;
		// 	}
		// }
		$ex = explode('-', $sampai);
		$bul = $ex[1];
		$tah = $ex[0];
		$tt = $tah . '-' . $bul . '-01';
		$cekweekend = date('N', strtotime($tt));
		if ($cekweekend == 6) {
			$tgl_invoice = $tah . '-' . $bul . '-03';
		} else if ($cekweekend == 7) {
			$tgl_invoice = $tah . '-' . $bul . '-02';
		} else {
			$hol = $this->finance_invoice_customer->get_from_arr('hrd.hol', array('hol_tgl' => $tt))->num_rows();
			if ($hol > 0) {
				$tgl_invoice = $tah . '-' . $bul . '-02';
				// $tgl_invoice = $this->input->post('tahun').'-'.$this->input->post('bulan').'-02';					
			} else {
				// $tgl_invoice = $periode;
				$tgl_invoice = $tt;
			}
		}
		$due_date = date('Y-m-d', strtotime($tt . ' + 9 days'));
		$next_inv = $this->generate_noinvoice($site->id_region, $get->ppn, '', $bul, $tah);
		$arpost = array(
			'flag_dp' => '1',
			'id_region' => $site->id_region,
			'ppn' => $get->ppn,
			'tanggal' => $tt,
			'tanggal_invoice' => $tgl_invoice,
			'due_date' => $due_date,
			'jml_piutang' => $total,
			'to_site' => $this->input->post('site'),
			'merge_type' => 1,
			'id_user' => $this->session->userdata('userid'),
			'timestamp' => date('Y-m-d H:i:s')
		);

		$arpost['nomor'] = $next_inv;
		if (!empty($this->input->post('dari'))) {
			$arpost['periode_dari'] = $this->input->post('dari');
		}
		if (!empty($this->input->post('sampai'))) {
			$arpost['periode_sampai'] = $this->input->post('sampai');
		}
		$this->finance_invoice_customer->insert('arpost', $arpost);
		$get = $this->finance_invoice_customer->get_from_arr('arpost', $arpost)->row();


		for ($l = 0; $l < sizeof($arr); $l++) {
			$arpost = $this->finance_invoice_customer->get('arpost', $arr[$l])->row();
			$transaksi = $this->finance_invoice_customer->get_transaksi2('transaksi', $arpost->nomor, $arpost->id_order)->result();
			foreach ($transaksi as $pow) {
				if ($pow->jenis_transaksi == 'LG') {
					$total += $pow->nominal;
				} else if ($pow->jenis_transaksi == 'LL') {
					$total += $pow->nominal;
				}
				if ($pow->jenis_transaksi == 'PN') {
					$ppn = 1;
				}
			}
			$this->finance_invoice_customer->update('arpost', array('merge' => 1), $arr[$l]);
			$arpost2 = array(
				'id_arpost_merge' => $get->id,
				'id_arpost' => $arr[$l]
			);
			$this->finance_invoice_customer->insert('arpost_merge', $arpost2);
			$data = array(
				'to_site' => $this->input->post('site'),
			);
			$this->finance_invoice_customer->update('arpost', $data, $arr[$l]);
		}
		if ($ppn == 1) {
			$total = $total + ($total / 100 * 10);
			if ($total >= 1000000) {
				$total = $total + 6000;
			} else {
				$total = $total + 3000;
			}
		}
		$arpost = array(
			'jml_piutang' => $total
		);
		$this->finance_invoice_customer->update('arpost', $arpost, $get->id);

		$this->session->set_flashdata('message', 'Invoice berhasil digabung.');
		$this->session->set_flashdata('notifikasi', 'success');
		redirect('finance_invoice_customer');
	}

	function ajax_get_kontak()
	{
		$id = $this->input->post('id');
		$inv = explode(',', $id);
		$k = 0;
		$radio = null;
		foreach ($inv as $row) {
			$k++;
			$arpost = $this->finance_invoice_customer->get('arpost', $row)->row();
			$cust = $this->finance_invoice_customer->get('ms_customers', $arpost->id_cust)->row();
			$order = $this->finance_invoice_customer->get('order_header', $arpost->id_order)->row();
			$site = $this->finance_invoice_customer->get('ms_site', $order->id_site)->row();
			$radio .= '<label class="radio radio-inline m-r-20">
						<input type="radio" name="site" value="' . $order->id_site . '">
						<i class="input-helper"></i>  
						' . $k . '. Perusahaan : ' . $cust->nama . '; Email : ' . $cust->email . '<br>Site : ' . $site->nama . '; Email : ' . $site->email . '
					</label><hr>';
		}
		echo $radio;
	}

	function approve_invoice()
	{
		// $id = $this->input->post('id');
		// $tanggal = date('Y-m-d H:i:s');
		// if (empty($id)) {
		// 	echo 'Invoice tidak ada yg dipilih';
		// } else {
		// 	if ($this->session->userdata('userid') == '111178' || $this->session->userdata('userid') == '111127' || $this->session->userdata('userid') == '111186' || $this->session->userdata('userid') == '111205') {
		// 		$this->finance_invoice_customer->update1('arpost', array('status_invoice' => 2, 'date_approve' => $tanggal, 'id_approve' => $this->session->userdata('userid')), $id);
		// 		$hasil = $this->insert_gl($id);
		// 		if ($hasil == 1) {
		// 			echo '1';
		// 		} else {
		// 			echo '0';
		// 		}
		// 	} else {
		// 		echo 'User tidak punya akses approve';
		// 	}
		// }
		echo $this->finance_invoice_approval->approve_invoice();
	}

	function get_bulan($akhir)
	{
		$bulan = substr($akhir, 5, 2);
		if ($bulan == '01') {
			$bulan = 'Januari';
		} else if ($bulan == '02') {
			$bulan = 'Februari';
		} else if ($bulan == '03') {
			$bulan = 'Maret';
		} else if ($bulan == '04') {
			$bulan = 'April';
		} else if ($bulan == '05') {
			$bulan = 'Mei';
		} else if ($bulan == '06') {
			$bulan = 'Juni';
		} else if ($bulan == '07') {
			$bulan = 'Juli';
		} else if ($bulan == '08') {
			$bulan = 'Agustus';
		} else if ($bulan == '09') {
			$bulan = 'September';
		} else if ($bulan == '10') {
			$bulan = 'Oktober';
		} else if ($bulan == '11') {
			$bulan = 'November';
		} else {
			$bulan = 'Desember';
		}
		return $bulan;
	}

	function insert_gl($id)
	{
		$tanggal = $tahun = $bulan = $nama = null;
		$tanggal = date('Y-m-d');
		$kreditbi = 0;
		$kreditmt = 0;
		$debet = 0;
		$debetmt = 0;
		$kredit = 0;
		$kreditppn = 0;
		$data = $this->db->query("SELECT * FROM erp_gmedia.`arpost` a WHERE a.`id`=$id")->result();
		foreach ($data as $row) {
			if ($row->merge_type == 1) {
				$detail = $this->db->query("SELECT a.`id_arpost`,c.`jenis_transaksi`, c.`nominal`, d.`nama`
				FROM (SELECT a.`id_arpost` AS id_arpost,b.`id_cust` FROM erp_gmedia.`arpost_merge` a LEFT JOIN erp_gmedia.`arpost` b
				ON a.`id_arpost`=b.`id` WHERE a.`id_arpost_merge`='" . $row->id . "') a
				LEFT JOIN erp_gmedia.`arpost` b ON a.`id_arpost`=b.`id`
				LEFT JOIN erp_gmedia.`transaksi` c ON (b.`nomor`=c.`nomor` AND b.`id_order`=c.`id_order`)
				LEFT JOIN erp_gmedia.`ms_customers` d ON a.`id_cust`=d.`id`")->result();
			} else {
				$detail = $this->db->query("SELECT a.`jenis_transaksi`, a.`nominal`, a.`nomor`, c.`nama`
				FROM erp_gmedia.`transaksi` a JOIN erp_gmedia.`order_header` b
				ON a.`id_order`=b.`id` JOIN erp_gmedia.`ms_site` c
				ON b.`id_site`=c.`id` WHERE a.`id_order` = $row->id_order AND a.`nomor` = '" . $row->nomor . "' GROUP BY a.`id`")->result();
			}
			foreach ($detail as $low) {
				if ($low->jenis_transaksi == "BI") {
					$debet = $debet + $low->nominal;
					$kreditbi = $kreditbi + $low->nominal;
				} else if ($low->jenis_transaksi == "PN") {
					$debet = $debet + $low->nominal;
					$kreditppn = $kreditppn + $low->nominal;
				} else if ($low->jenis_transaksi == "MT") {
					if ($debetmt == 0) {
						$debetmt = $debetmt + $low->nominal;
						$debet = $debet + $debetmt;
						$kreditmt = $kreditmt + $low->nominal;
					}
				} else {
					$debet = $debet + $low->nominal;
					$kredit = $kredit + $low->nominal;
				}
				$nama = $low->nama;
			}
			$bulan = $this->get_bulan($row->periode_sampai);
			$tahun = substr($row->periode_sampai, 0, 4);
			$tanggal = $tanggal;
			$no_ref = $row->nomor;
			$kat_gl = 19;
			$deskripsi = "Invoice " . $nama . " periode " . $bulan . " " . $tahun;
			if (!empty($kreditppn)) {
				$ppn = 1;
			} else {
				$ppn = 2;
			}
		}
		if ($this->closing_date_accounting($tanggal) == true) {
			$this->db->from('finance_coa_general_ledger_detail a');
			$this->db->join('finance_coa_general_ledger b', 'a.no_trans = b.no_trans', 'left');
			$this->db->where('b.no_referensi', $no_ref);
			$q = $this->db->get();
			if ($q->num_rows() > 0) {
				$msg = 'No referensi sudah pernah di input';
			} else {
				$create_queue_id = $this->create_queue_id();
				$create_gl_id = $this->create_gl_id($kat_gl);
				$branch = 8;
				$area = 2;
				$data = array(
					'no_trans' => $create_queue_id,
					'kat_gl' => $kat_gl,
					'jurnal_group' => $create_gl_id,
					'deskripsi' => $deskripsi,
					'tanggal' => $tanggal,
					'no_referensi' => $no_ref,
					'ppn' => $ppn,
					'branch' => $branch,
					'area' => $area,
				);
				$this->db->trans_start();
				$result = $this->db->insert('finance_coa_general_ledger', $data);
				$result = $this->db->trans_status();
				$this->db->trans_complete();
				if (!empty($result)) {
					if ($debet != 0 && $kredit != 0) {
						//debet
						$akun = 112101;
						$data = array(
							'no_trans' => $create_queue_id,
							'id_biaya' => $akun,
							'tanggal' => $tanggal,
							'divisi' => 0,
							'debet' => $debet,
							'kredit' => 0,
							'branch' => $branch,
							'area' => $area,
						);
						$this->db->insert('finance_coa_general_ledger_detail', $data);
						$this->model_global->update_jurnal_bulanan($akun, $tanggal, $branch, $area);
						$this->model_global->update_jurnal_harian($akun, $tanggal, $branch, $area);
						//kredit
						$akun = 410001;
						$data = array(
							'no_trans' => $create_queue_id,
							'id_biaya' => $akun,
							'tanggal' => $tanggal,
							'divisi' => 0,
							'debet' => 0,
							'kredit' => $kredit,
							'branch' => $branch,
							'area' => $area,
						);
						$this->db->insert('finance_coa_general_ledger_detail', $data);
						$this->model_global->update_jurnal_bulanan($akun, $tanggal, $branch, $area);
						$this->model_global->update_jurnal_harian($akun, $tanggal, $branch, $area);
					}
					if ($kreditbi != 0) {
						//kredit
						$akun = 440001;
						$data = array(
							'no_trans' => $create_queue_id,
							'id_biaya' => $akun,
							'tanggal' => $tanggal,
							'divisi' => 0,
							'debet' => 0,
							'kredit' => $kreditbi,
							'branch' => $branch,
							'area' => $area,
						);
						$this->db->insert('finance_coa_general_ledger_detail', $data);
						$this->model_global->update_jurnal_bulanan($akun, $tanggal, $branch, $area);
						$this->model_global->update_jurnal_harian($akun, $tanggal, $branch, $area);
					}
					if ($kreditmt != 0) {
						//kredit
						$akun = 623001;
						$data = array(
							'no_trans' => $create_queue_id,
							'id_biaya' => $akun,
							'tanggal' => $tanggal,
							'divisi' => 0,
							'debet' => 0,
							'kredit' => $kreditmt,
							'branch' => $branch,
							'area' => $area,
						);
						$this->db->insert('finance_coa_general_ledger_detail', $data);
						$this->model_global->update_jurnal_bulanan($akun, $tanggal, $branch, $area);
						$this->model_global->update_jurnal_harian($akun, $tanggal, $branch, $area);
					}
					if ($kreditppn != 0) {
						//kredit
						$akun = 213121;
						$data = array(
							'no_trans' => $create_queue_id,
							'id_biaya' => $akun,
							'tanggal' => $tanggal,
							'divisi' => 0,
							'debet' => 0,
							'kredit' => $kreditppn,
							'branch' => $branch,
							'area' => $area,
						);
						$this->db->insert('finance_coa_general_ledger_detail', $data);
						$this->model_global->update_jurnal_bulanan($akun, $tanggal, $branch, $area);
						$this->model_global->update_jurnal_harian($akun, $tanggal, $branch, $area);
					}
					$msg = 1;
				} else {
					$msg = 0;
				}
			}
		}
		$this->db->trans_complete();
		return $msg;
	}

	function closing_date_accounting($tanggal)
	{
		$this->db->select("general_ledger as tanggal", false);
		$this->db->where('branch', $this->finance_invoice_customer->cek_id_regional($this->session->userdata('scope_area')));
		$Q = $this->db->get('finance_close_date');
		if ($Q->num_rows() > 0) {
			foreach ($Q->result_array() as $row) {
				if ($tanggal <= $row['tanggal']) {
					return false;
				} else {
					return true;
				}
			}
		} else {
			return true;
		}
		$Q->free_result();
	}

	function create_queue_id()
	{
		$invoice_cek = 0;
		$userid = str_pad($this->session->userdata('id'), 6, '0', STR_PAD_LEFT);
		$code_queue = 1;
		$code_queue_zero = str_pad($code_queue, 2, '0', STR_PAD_LEFT);
		$invoice = date('ymdhis') . $userid . $code_queue_zero;
		while ($invoice_cek < 1) {
			$this->db->where("no_trans = '" . $invoice . "'", NULL, FALSE);
			$q = $this->db->get('finance_coa_general_ledger');
			if ($q->num_rows() == 0) {
				$invoice_cek = 1;
			} else {
				$code_queue++;
				$code_queue_zero = str_pad($code_queue, 2, '0', STR_PAD_LEFT);
				$invoice = date('ymdHis') . $userid . $code_queue_zero;
			}
			$q->free_result();
		}
		return $invoice;
	}

	function create_gl_id($id)
	{
		$kode_ju = $this->finance_master_kat_gl_name($id);
		$invoice_cek = 0;
		$code_queue = 1;
		$code_queue_zero = str_pad($code_queue, 3, '0', STR_PAD_LEFT);
		$invoice = $kode_ju . '-' . date('ymd') . $code_queue_zero;
		while ($invoice_cek < 1) {
			$this->db->where("jurnal_group = '" . $invoice . "'", NULL, FALSE);
			$q = $this->db->get('finance_coa_general_ledger');
			if ($q->num_rows() == 0) {
				$invoice_cek = 1;
			} else {
				$code_queue++;
				$code_queue_zero = str_pad($code_queue, 3, '0', STR_PAD_LEFT);
				$invoice = $kode_ju . '-' . date('ymd') . $code_queue_zero;
			}
			$q->free_result();
		}
		return $invoice;
	}

	function finance_master_kat_gl_name($id)
	{
		$data = '';

		$q = $this->db->query("select nama from gmd_finance_master_kat_gl where id = '" . $id . "'");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data = $r['nama'];
			}
		}
		$q->free_result();

		return $data;
	}

	public function get_header()
	{
		echo $this->finance_invoice_customer->get_header();
	}

	public function set_header()
	{
		echo $this->finance_invoice_customer->set_header();
	}

	public function get_cust_site()
	{
		echo $this->finance_invoice_customer->get_cust_site();
	}
}
