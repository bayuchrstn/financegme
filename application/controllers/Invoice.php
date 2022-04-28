<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Invoice extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		check_login();
		// $this->lang->load('dashboard');
		$this->active_root_menu = 'Dashboard';
		$this->browser_title = 'Dashboard';
		$this->modul_name = 'Dashboard';
		$this->load->model('model_invoice', 'invoice');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index($filter='')
	{
		$this->breadcrumb = array(
				'Invoice'	=> '#',
			);
		$this->js_include .= $this->ui->js_include('editable');

		if($filter==''):
			$arr_redirect = array();
			$arr_redirect['bulan'] = date('m');
			$arr_redirect['tahun'] = date('Y');
			$red = filter_serialthis($arr_redirect);
			// pre($red);
			redirect(base_url().'invoice/index/'.$red);
		endif;

		$arr_filter = un_filter_serialthis($filter);
		// pre($arr_filter);

		if(empty($arr_filter)):
			redirect(base_url().'invoice/index/');
		endif;

		$set_ui = $this->invoice->set_ui();

		$status_invoice = $this->uri->segment(2);
		// pre($status_invoice);

		$data = array();
		$data['filter'] = $filter;
		$data['arr_filter'] = $arr_filter;
		// pre($data['arr_filter']);
		$data['tabs'] = $this->invoice->tabs();
		// pre($data['tabs']);
		$data['set_ui'] = $set_ui;
		$data['status_invoice'] = $status_invoice;

		$this->js_inject .= $this->load->view('invoice/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('invoice/js', $data, TRUE);
		$this->js_inject .= $this->load->view('invoice/valid', $data, TRUE);
		$data['modal_view'] = $this->load->view('invoice/modal', $data, TRUE);
		$konten = $this->load->view('invoice/index', $data, TRUE);
		$this->admin_view($konten);
	}

	public function edit($filter)
	{
		if($filter==''):
			$arr_redirect = array();
			$arr_redirect['bulan'] = date('m');
			$arr_redirect['tahun'] = date('Y');
			$red = filter_serialthis($arr_redirect);
			// pre($red);
			redirect(base_url().'invoice/edit/'.$red);
		endif;
		$this->index($filter);
	}

	public function ready($filter)
	{
		if($filter==''):
			$arr_redirect = array();
			$arr_redirect['bulan'] = date('m');
			$arr_redirect['tahun'] = date('Y');
			$red = filter_serialthis($arr_redirect);
			// pre($red);
			redirect(base_url().'invoice/ready/'.$red);
		endif;
		$this->index($filter);
	}

	function generate()
	{
		$arr = array();
		if(!$this->form_validation->run('generate_invoice')):
			$data = array();
			$arr['html'] = $this->load->view('invoice/form/generate', $data, TRUE);
			echo json_encode($arr);
		else:
			$generated_invoice_data = array();
			// $debug_number = array();


			$month = $this->input->post('bulan_generate');
			$year = $this->input->post('tahun_generate');
			$customer = "SELECT *
							FROM gmd_customer
							WHERE
								status_active !='0' AND
								status='customer' AND
								invoice_flag ='1' AND
								group_id ='1'
							ORDER BY `order` ASC , `group_order` ASC
						";
			// pre($customer);
			// exit;
			$query = $this->db->query($customer);
			$data = $query->result_array();

			$ct = 0;
			foreach($data as $dt):

				$cek = "SELECT * FROM gmd_invoice where id_customer='".$dt['id']."' AND invoice_month='".$month."' AND invoice_year='".$year."' ";
				$query_cek = $this->db->query($cek);
				$data_cek = $query_cek->row_array();

				if(empty($data_cek)):
					$ct++;

					$number = $this->invoice->invoice_number($dt['id'], $dt['customer_id'], $month, $year);
					$template = $this->invoice->get_invoice_template($dt['invoice_category']);
					$ppn = $this->invoice->get_ppn($dt['id']);
					$ppn_mode = $this->invoice->get_ppn_mode($dt['id']);
					$item = $this->invoice->get_item($dt['id']);
					$diskon = $this->invoice->get_diskon($dt['id']);
					$prorate = $this->invoice->get_prorate($dt['id']);

					// $debug_number[] = array(
					// 	'cid'		=> $dt['customer_id'],
					// 	'number'	=> $number,
					// );
					$awal_periode = '1';

					//dicek dulu maxi atau bukan
					if( $dt['flag_maxi']=='1' ):
						$bulan_next_maxi = date("m", mktime(0, 0, 0, $month+1, 1, $year));
						$maxday = days_in_month($month, $year);
						$maxday_maxi = days_in_month($bulan_next_maxi, $year);


						$info_date = '15 '.number_to_month( (int) $month ).' '.$year;
						$info_due_date = $maxday.' '.number_to_month( (int) $month ).' '.$year;
						$info_periode = $awal_periode.' - '.$maxday_maxi.' '.number_to_month( (int) $bulan_next_maxi ).' '.$year;

					else:
						$maxday = days_in_month($month, $year);
						$info_date = '1 '.number_to_month( (int) $month ).' '.$year;
						$info_due_date = '15 '.number_to_month( (int) $month ).' '.$year;
						$info_periode = $awal_periode.' - '.$maxday.' '.number_to_month( (int) $month ).' '.$year;
						// pre($info_date.'  -  '.$info_due_date.'  -  '.$info_periode);
					endif;

					if($dt['flag_maxi']=='1'):
						$category = 'maxi';
					elseif($dt['ppn']=='1'):
						$category = 'ppn';
					else:
						$category = 'non_ppn';
					endif;


					$data_invoice = array(
							'date'				=> now(),
							'number'			=> $number,
							'id_customer'		=> $dt['id'],
							'note'				=> '',
							'total'				=> '',
							'invoice_month'		=> $month,
							'invoice_year'		=> $year,
							'info_date'			=> $info_date,
							'info_due_date'		=> $info_due_date,
							'info_periode'		=> $info_periode,
							'invoice_order'		=> $this->invoice->get_max($dt['id'], $month, $year),
							'items'				=> $item,
							'diskon'			=> $diskon,
							'prorate'			=> $prorate,
							'ppn'				=> $ppn,
							'ppn_mode'			=> $ppn_mode,
							'category'			=> $category,
							'status'			=> 'edit',
							'regional'			=> session_scope_regional(),
							'area'				=> session_scope_area(),

						);
					$generated_invoice_data[] = $data_invoice;
					// pre($data_invoice);
					$this->db->insert('invoice', $data_invoice);
				endif;

			endforeach;

			$arr['status'] = 'success';
			$arr['msg'] = 'Invoice bulan Januari 2018';
			$arr['post'] = $_POST;
			// $arr['list_pelanggan'] = $data;
			$arr['generated_invoice_data'] = $generated_invoice_data;
			// $arr['debug_number'] = $debug_number;
			echo json_encode($arr);
		endif;
	}

	function generate_old()
	{
		if($this->input->post('bulan_generate') && $this->input->post('tahun_generate')):
			// exit('2');
			$arr = array();
			$month = $this->input->post('bulan_generate');
			$year = $this->input->post('tahun_generate');
			$customer = "SELECT *
							FROM gmd_customer
							WHERE
								status_active !='0' AND
								status='customer' AND
								invoice_flag ='1'
							ORDER BY `order` ASC , `group_order` ASC
						";
			// pre($customer);
			// exit;
			$query = $this->db->query($customer);
			$data = $query->result_array();
			// pre($data);

			$ct = 0;
			foreach($data as $dt):

				$cek = "SELECT * FROM gmd_invoice where id_customer='".$dt['id']."' AND invoice_month='".$month."' AND invoice_year='".$year."' ";
				$query_cek = $this->db->query($cek);
				$data_cek = $query_cek->row_array();

				if(empty($data_cek)):
					$ct++;

					$template = $this->invoice->get_invoice_template($dt['invoice_category']);
					$info_date = $this->invoice->get_info_date($dt['id']);
					$info_due_date = $this->invoice->get_info_due_date($dt['id']);
					$info_periode = $this->invoice->get_info_periode($dt['id']);
					$ppn = $this->invoice->get_ppn($dt['id']);
					$ppn_mode = $this->invoice->get_ppn_mode($dt['id']);
					$item = $this->invoice->get_item($dt['id']);
					$diskon = $this->invoice->get_diskon($dt['id']);
					$prorate = $this->invoice->get_prorate($dt['id']);

					$data_invoice = array(
							'date'				=> now(),
							'number'			=> '',
							'id_customer'		=> $dt['id'],
							'note'				=> '',
							'total'				=> '',
							'invoice_month'		=> $month,
							'invoice_year'		=> $year,
							'info_date'			=> $info_date,
							'info_due_date'		=> $info_due_date,
							'info_periode'		=> $info_periode,
							'invoice_order'		=> '0',
							'item'				=> $item,
							'diskon'			=> $diskon,
							'prorate'			=> $prorate,
							'ppn'				=> $ppn,
							'ppn_mode'			=> $ppn_mode,
							'status'			=> 'edit',
							'regional'			=> session_scope_regional(),
							'area'				=> session_scope_area(),

						);
					// pre($data_invoice);
					$this->db->insert('invoice', $data_invoice);
				endif;

			endforeach;
			$arr['status'] = 'success';
			$arr['msg'] = 'Invoice berhasil di generate';
			echo json_encode($arr);
		endif;
	}

	public function approved($filter)
	{
		if($filter==''):
			$arr_redirect = array();
			$arr_redirect['bulan'] = date('m');
			$arr_redirect['tahun'] = date('Y');
			$red = filter_serialthis($arr_redirect);
			// pre($red);
			redirect(base_url().'invoice/approved/'.$red);
		endif;
		$this->index($filter);
	}

	public function printed($filter)
	{
		if($filter==''):
			$arr_redirect = array();
			$arr_redirect['bulan'] = date('m');
			$arr_redirect['tahun'] = date('Y');
			$red = filter_serialthis($arr_redirect);
			// pre($red);
			redirect(base_url().'invoice/printed/'.$red);
		endif;
		$this->index($filter);
	}

	public function data($status, $category='', $filter='')
	{
		$this->invoice->data($status, $category, $filter);
	}

	function update($invoice_id='')
	{
		if(!$this->form_validation->run('sender')):
			$data = array();
			$detail = $this->invoice->detail($invoice_id);
			$data['detail'] = $detail;
			// echo json_encode($detail);
			echo $this->load->view('invoice/update/msd', $data, TRUE);
		else:
			$arr = array();
			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan';
			echo json_encode($arr);
		endif;
	}


	//update field 2 penting invoice
	function editable($table='customer')
	{
		$arr = array();
		$invoice_id = $this->input->post('pk');
		$detail = $this->invoice->detail($invoice_id);
		switch ($table) {
			//update table invoice
			case 'invoice':
				$field = $this->input->post('name');
				$data[$field] = $this->input->post('value');
				$this->db->where('id', $detail['id']);
				$this->db->update('invoice', $data);
			break;

			//update table customer
			default:
				$field = $this->input->post('name');
				$data[$field] = $this->input->post('value');
				$this->db->where('id', $detail['id_customer']);
				$this->db->update('customer', $data);
			break;
		}
		$arr['debug'] = $this->db->last_query();
		pre($arr);
	}

	//menampilkan table utama invoice
	function table_editor($invoice_id)
	{
		$data = array();
		$detail = $this->invoice->detail($invoice_id);
		$data['detail'] = $detail;
		echo $this->load->view('invoice/table_editor', $data, TRUE);
	}

	//update item invoice
	function update_item($invoice_id='', $item_id='')
	{
		$arr = array();
		$detail = $this->invoice->detail($invoice_id);
		$items = unserialize($detail['items']);
		$item = isset($items[$item_id]) ? $items[$item_id] : array();
		// pre($detail);
		// pre($item);
		if(!$this->form_validation->run('invoice_item')):
			$data = array();
			$data['items'] = $items;
			$data['item'] = $item;
			$data['invoice_id'] = $invoice_id;
			$data['item_id'] = $item_id;
			echo $this->load->view('invoice/update/item/update_item', $data, TRUE);
		else:
			$arr['post'] = $_POST;
			$arr['items_asli'] = $items;
			$unit_price = $this->input->post('unit_price');

			$item_id = $this->input->post('item_id');
			$items[$item_id] = array(
					'product_description'		=> $this->input->post('item_name'),
					'product_note'				=> $this->input->post('note'),
					'product_qty'				=> $this->input->post('qty'),
					'product_currency'			=> 'idr',
					'product_price'				=> paranoid($unit_price),
					'sort'						=> $this->input->post('sort'),
				);

			$arr['items_edited'] = $items;
			// pre($arr);
			$final_items = serialize($items);


			$data = array();
			$data['items'] = $final_items;
			$this->db->where('id', $this->input->post('invoice_id'));
			$this->db->update('invoice', $data);

			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan';

			echo json_encode($arr);
		endif;
	}

	//add item invoice
	function add_item($invoice_id='')
	{
		$detail = $this->invoice->detail($invoice_id);
		$items = unserialize($detail['items']);
		// $item = isset($items[$item_id]) ? $items[$item_id] : array();
		// pre($detail);
		// pre($item);
		if(!$this->form_validation->run('invoice_item')):
			$data = array();
			$data['items'] = $items;
			$data['invoice_id'] = $invoice_id;
			echo $this->load->view('invoice/update/item/add_item', $data, TRUE);
		else:
			$arr = array();
			$arr['detail'] = $detail;
			$arr['items'] = $items;
			$unit_price = $this->input->post('unit_price');

			$items[] = array(
				'product_description'		=> $this->input->post('item_name'),
				'product_note'				=> $this->input->post('note'),
				'product_qty'				=> $this->input->post('qty'),
				'product_currency'			=> 'idr',
				'product_price'				=> paranoid($unit_price),
				'sort'						=> $this->input->post('sort'),
			);

			$arr['items_edited'] = $items;

			$final_items = serialize($items);

			$data = array();
			$data['items'] = $final_items;
			$this->db->where('id', $this->input->post('invoice_id'));
			$this->db->update('invoice', $data);

			$arr['post'] = $_POST;
			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan';
			// pre($arr);
			echo json_encode($arr);
		endif;
	}

	function dummy_item()
	{
		$arr = array();
		$arr[] = array(
				'product_description'	=> 'bakso',
				'product_note'	=> 'bakso sapi',
				'product_qty'	=> '1',
				'product_currency'	=> 'idr',
				'product_price'	=> '7800',
			);
		$arr[] = array(
				'product_description'	=> 'soto',
				'product_note'	=> 'soto ayam',
				'product_qty'	=> '2',
				'product_currency'	=> 'idr',
				'product_price'	=> '6000',
			);
		// pre($arr);
		$fp = serialize($arr);
		echo $fp;
	}

}
