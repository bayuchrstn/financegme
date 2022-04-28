<?php
class Model_finance_invoice_adj_ar extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function get_data_table()
	{
		set_time_limit(0);
		$column_order = array(null, 'a.date_invoice', 'a.date_due', 'a.no_invoice', 'nama', 'a.pph2223', 'a.mf', 'a.bupot_ppn');
		$order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'a.tanggal';
		$order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'asc';

		$this->db->select("SQL_CALC_FOUND_ROWS a.*, 
		date_format(a.date_invoice, '%d-%m-%Y') as date_invoicenya, 
		date_format(a.date_due, '%d-%m-%Y') as date_duenya, 
		if(b.invoice_name = '', b.nama, b.invoice_name) as nama, 
		if(b.ppn = 0, 'TIDAK', if(b.jenis_ppn = 0, 'STANDAR', 'SEDERHANA')) as jenis_ppn", false);
		$this->db->from('finance_invoice_customer a');
		$this->db->join('finance_customer_service2 b', 'a.service_id = b.service_id', 'left');
		$this->db->group_start();
		$this->db->like('b.nama', $this->input->post('search_keyword'));
		$this->db->or_like('b.invoice_name', $this->input->post('search_keyword'));
		$this->db->or_like('a.no_invoice', $this->input->post('search_keyword'));
		$this->db->or_like('a.service_id', $this->input->post('search_keyword'));
		$this->db->or_like('b.customer_id', $this->input->post('search_keyword'));
		$this->db->group_end();
		$this->db->where("(a.date_invoice between '" . $this->input->post('searchDateFirst') . "' and '" . $this->input->post('searchDateFinish') . "')", NULL, FALSE);
		$this->db->where('a.branch', $this->cek_id_regional($this->session->userdata('scope_area')));
		if ($this->input->post('searchkategori') != '0') {
			$this->db->where('b.kategori', $this->input->post('searchkategori'));
		}
		if ($this->input->post('searchkat_inv') == '1') {
			$this->db->where('b.ppn', '1');
		} elseif ($this->input->post('searchkat_inv') == '2') {
			$this->db->where('b.ppn', '0');
		} elseif ($this->input->post('searchkat_inv') == '3') {
			$this->db->where('b.status_maxi', '1');
		} elseif ($this->input->post('searchkat_inv') == '4') {
			$this->db->where('b.status_cabang', '1');
		}
		if ($this->input->post('searchstatus_inv') != '') {
			$this->db->where('a.status_invoice', $this->input->post('searchstatus_inv'));
		}
		if ($this->input->post('searchlunas') != '') {
			$this->db->where('a.lunas', $this->input->post('searchlunas'));
		}
		$this->db->order_by($order_name, $order_dir);
		$this->db->order_by('a.id', 'desc');
		$this->db->group_by('a.id');
		if ($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
		$q = $this->db->get();
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
		$data = array();
		$no = $_POST['start'];
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$no++;
				//$opsi = '<a href="#" onClick="update_data(\''.$r['id'].'\')"><i class="icon-menu7 position-left text-slate-800"></i></a> <a href="#" onClick="delete_data(\''.$r['id'].'\')"><i class="icon-bin position-left text-grey"></i></a>';
				//$bayar = $this->cek_bayar($r['id']);
				//$edit = '<a href="#" onclick="update_data(\''.$r['id'].'\')" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a> <a href="#" onclick="delete_data(\''.$r['id'].'\')"><i class="icon-trash text-danger"></i></a> <a href="#" onclick="print_invoice(\''.$r['id'].'\')"><i class="material-icons">&#xE8AD;</i></a>';
				if ($r['status_invoice'] == '0') { }
				if ($r['bayar'] > 0) {
					//$edit = '<a href="#" onclick="update_data(\''.$r['id'].'\')"><i class="material-icons" style="font-size:20px; color:blue">&#xE5D2;</i></a>';
					//$edit .= '<a href="#" onclick="print_invoice(\''.$r['id'].'\')"><i class="material-icons" style="font-size:20px; color:green">&#xE8AD;</i></a>';
				}
				$status_invoice = '';
				$edit = '';
				$edit .= '<a href="#" onclick="update_data(\'' . $r['id'] . '\')"><i class="icon-menu7 position-left text-slate-800"></i></a>';
				$row  = array(
					$no . '.',
					$r['date_invoicenya'],
					$r['date_duenya'],
					'<a href="#" onclick="popup(\'' . base_url() . 'finance_invoice_customer/invoice_print_ppn_no_barcode_no/' . $r['id'] . '/0\',800,500,\'yes\')" style="color:blue">' . $r['no_invoice'] . '</a>',
					$r['nama'],
					//'nama_produk' => $r['nama_produk'],
					number_format($r['pph2223'], 0),
					number_format($r['mf'], 0),
					number_format($r['bupot_ppn'], 0),
					//$status_invoice,
					$edit,
				);


				$data[] = $row;
			}
		}
		$q->free_result();

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $n,
			"recordsFiltered" => $n,
			"data" => $data,
		);
		echo json_encode($output);
	}

	function insert()
	{
		$this->db->trans_start();
		$customer_id = strtoupper($this->input->post('customer_id'));
		$service_id = strtoupper($this->input->post('service_id'));
		$no_invoice = $this->input->post('no_invoice');
		$no_invoice = str_replace(" ", "", $no_invoice);
		if ($no_invoice == '') {
			$date_invoice = date_create($this->input->post('date_invoice'));
			$date_invoice = date_format($date_invoice, "my");
			$customer_id = str_replace("/", ".", $customer_id);
			$cust_id = explode('.', $customer_id);
			$cust_id = $cust_id[0] . '.' . $cust_id[1];
			$no_invoice = $this->invoice_create_queue_id($date_invoice, $cust_id);
		}

		$bw = (float)str_replace(",", "", $this->input->post('bw'));
		$colo = (float)str_replace(",", "", $this->input->post('colo'));
		$instalasi = (float)str_replace(",", "", $this->input->post('instalasi'));
		$perangkat = (float)str_replace(",", "", $this->input->post('perangkat'));
		$lain2 = (float)str_replace(",", "", $this->input->post('lain2'));
		$potongan = (float)str_replace(",", "", $this->input->post('potongan'));
		//$mf = (float)str_replace(",", "", $this->input->post('mf'));
		$ppnnya = (float)str_replace(",", "", $this->input->post('ppnnya'));

		$ppn = 0;

		$service = $bw + $colo + $instalasi + $perangkat + $lain2 - $potongan;
		/*
		if($this->input->post('ppn') == '1'){
			$q = $this->db->query("select floor(".$service." * 0.1) as ppn");
			if($q->num_rows() > 0){
				foreach($q->result_array() as $k => $r){
					$ppn = $r['ppn'];
				}
			}
			$q->free_result();
		}
		*/
		//$ppn = (float)str_replace(",", "", $this->input->post('ppn'));
		//$pph2223 = (float)str_replace(",", "", $this->input->post('pph2223'));
		$jumlah = (float)str_replace(",", "", $this->input->post('total_tagihan'));
		//$jumlah = $service + $ppnnya;
		$data = array(
			'no_invoice' => $no_invoice,
			'periode_invoice' => $this->input->post('periode_invoice'),
			'date_invoice' => $this->input->post('date_invoice'),
			'date_due' => $this->input->post('date_due'),
			'service_id' => $service_id,
			'product_desc' => $this->input->post('service_produk'),
			'product_note' => $this->input->post('service_note'),
			'bw' => $bw,
			'colo' => $colo,
			'instalasi' => $instalasi,
			'perangkat' => $perangkat,
			'lain2' => $lain2,
			'potongan' => $potongan,
			'jenis_potongan' => $this->input->post('jenis_potongan'),
			'ppn' => $ppnnya,
			//'pph2223' => $pph2223,
			//'mf' => $mf,
			'jumlah' => $jumlah,
			'manual' => '1',
			'date_create' => date('Y-m-d H:i:s'),
			'status_invoice' => '0',
			'date_approved' => date('Y-m-d H:i:s'),
			'date_printed' => date('Y-m-d H:i:s'),
			'branch' => $this->cek_id_regional($this->session->userdata('scope_area')),
		);
		$result = $this->db->insert('finance_invoice_customer', $data);
		if ($result == true) {
			if (isset($_POST['tambah_service_produk'])) {
				foreach ($_POST['tambah_service_produk'] as $k => $v) {
					$bw = (float)str_replace(",", "", $_POST['tambah_bw'][$k]);
					$colo = (float)str_replace(",", "", $_POST['tambah_colo'][$k]);
					$instalasi = (float)str_replace(",", "", $_POST['tambah_instalasi'][$k]);
					$perangkat = (float)str_replace(",", "", $_POST['tambah_perangkat'][$k]);
					$lain2 = (float)str_replace(",", "", $_POST['tambah_lain2'][$k]);
					$qd = $this->db->query("insert into gmd_finance_invoice_customer_add (no_invoice, description, note, bw, colo, instalasi, perangkat, lain2) values 
					((SELECT id FROM gmd_finance_invoice_customer WHERE no_invoice = '" . $no_invoice . "' ORDER BY id DESC limit 1), '" . $_POST['tambah_service_produk'][$k] . "', '" . $_POST['tambah_service_note'][$k] . "', '" . $bw . "', '" . $colo . "', '" . $instalasi . "', '" . $perangkat . "', '" . $lain2 . "')");
					//$service += $bw + $colo + $instalasi + $perangkat + $lain2;
					$jumlah += $bw + $colo + $instalasi + $perangkat + $lain2;
				}
				/*
				if($this->input->post('ppn') == '1'){
					$q = $this->db->query("select floor(".$service." * 0.1) as ppn");
					if($q->num_rows() > 0){
						foreach($q->result_array() as $k => $r){
							$ppn = $r['ppn'];
						}
					}
					$q->free_result();
				}
				//$jumlah += $service_add;
				$data = array( 
							//'ppn' => $ppn,
							'jumlah' => $jumlah,
						);
				$this->db->where('no_invoice', ''.$no_invoice.'');
				$this->db->update('finance_invoice_customer', $data);
				*/
			}
			$msg = 1;
		} else {
			$msg = 0;
		}
		$this->db->trans_complete();
		return $msg;
	}

	function select()
	{
		$this->db->select("a.*, 
		FORMAT(a.bw, 0) as bw, FORMAT(a.colo, 0) as colo, FORMAT(a.instalasi, 0) as instalasi, FORMAT(a.perangkat, 0) as perangkat, FORMAT(a.lain2, 0) as lain2, 
		FORMAT(a.potongan, 0) as potongan, FORMAT(a.ppn, 0) as ppn, FORMAT(a.pph2223, 0) as pph2223, FORMAT(a.mf, 0) as mf, FORMAT(a.bupot_ppn, 0) as bupot_ppn, 
		b.customer_id, concat(b.nama,' / ', b.invoice_name) as nama, b.product_description, b.ppn as ppnnya, if(b.cid = 0, c.nama, d.nama) as customer_group_name", false);
		$this->db->from('finance_invoice_customer a');
		$this->db->join('finance_customer_service2 as b', 'a.service_id = b.service_id', 'left');
		$this->db->join('finance_customer2 as c', 'b.customer_id = c.customer_id', 'left');
		$this->db->join('finance_customer2 as d', "b.cid = d.id", 'left');
		$this->db->where("a.id", $this->input->post('id'));
		$q = $this->db->get();
		return $q->result();
	}

	function update()
	{
		$this->db->trans_start();
		$mf = (float)str_replace(",", "", $this->input->post('mf'));
		$pph2223 = (float)str_replace(",", "", $this->input->post('pph2223'));
		$bupot_ppn = (float)str_replace(",", "", $this->input->post('bupot_ppn'));
		$data = array(
			'pph2223' => $pph2223,
			'mf' => $mf,
			'bupot_ppn' => $bupot_ppn,
		);
		$this->db->where('id', $this->input->post('id'));
		$result = $this->db->update('finance_invoice_customer', $data);
		if ($result == true) {
			$msg = 1;
		} else {
			$msg = 0;
		}
		$this->db->trans_complete();
		return $msg;
	}

	function delete($id)
	{
		$this->db->trans_start();
		$this->db->where('id', $id);
		$result = $this->db->delete('finance_invoice_customer');
		if ($result == true) {
			$this->db->where('no_invoice', $id);
			$this->db->delete('finance_invoice_customer_add');
			$msg = 1;
		} else {
			$msg = 0;
		}
		$this->db->trans_complete();
		return $msg;
	}

	function cek_id_regional($id)
	{
		$data = 0;

		$q = $this->db->query("select id from gmd_regional where code = '" . $id . "'");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data = $r['id'];
			}
		}
		$q->free_result();

		return $data;
	}

	function produk()
	{
		$q = $this->db->query("select a.*, b.name as nama_category from gmd_product a
		left join gmd_product_category b on a.category = b.code
		order by b.name asc, a.name asc");
		return $q;
	}

	function kategori()
	{
		$q = $this->db->query("select * from gmd_master where category = 'customer_type'
		order by name asc");
		return $q;
	}

	function select_autocomplite_service()
	{
		$this->db->select("a.*, if(a.cid = 0, b.nama, c.nama) as customer_group_name, 
		FORMAT(a.bandwith, 0) as bandwith, FORMAT(a.colocation, 0) as colocation, FORMAT(a.instalasi, 0) as instalasi, FORMAT(a.perangkat, 0) as perangkat, FORMAT(a.lain2, 0) as lain2", false);
		$this->db->from("finance_customer_service2 a");
		$this->db->join('finance_customer2 b', 'a.customer_id = b.customer_id', 'left');
		$this->db->join('finance_customer2 c', "a.cid = c.id", 'left');
		//$this->db->where("(a.service_id like '%".$this->input->post('term')."%'
		//OR a.nama like '%".$this->input->post('term')."%'
		//OR b.customer_id like '%".$this->input->post('term')."%'
		//or b.nama like '%".$this->input->post('term')."%')", NULL, FALSE);
		$this->db->where('a.service_id', '' . $this->input->post('service_id_val') . '');
		$this->db->where('a.status_service', '0');
		$q = $this->db->get();
		return $q->result();
	}

	function select_autocomplite_service_add($id)
	{
		$data = '';

		$this->db->where('service_id', $id);
		$this->db->from('finance_customer_service_add');
		$this->db->order_by('id', 'asc');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $k => $r) {
				$data .= '<tr class="remove">';
				$data .= '<td style="vertical-align:middle;"><input class="form-control" type="text" style="width:270px;" readonly="readonly" name="tambah_service_produk[]" value="' . $r['description'] . '" /><br><input class="form-control" type="text" style="width:270px;" readonly="readonly" name="tambah_service_note[]" value="' . $r['note'] . '" /></td>';
				$data .= '<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" readonly="readonly" name="tambah_bw[]" value="' . number_format($r['bw'], 0) . '" /></td>';
				$data .= '<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" readonly="readonly" name="tambah_colo[]" value="' . number_format($r['colo'], 0) . '" /></td>';
				$data .= '<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" readonly="readonly" name="tambah_instalasi[]" value="' . number_format($r['instalasi'], 0) . '" /></td>';
				$data .= '<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" readonly="readonly" name="tambah_perangkat[]" value="' . number_format($r['perangkat'], 0) . '" /></td>';
				$data .= '<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" readonly="readonly" name="tambah_lain2[]" value="' . number_format($r['lain2'], 0) . '" /></td>';
				$data .= '<td style="vertical-align:middle;"><button type="button" class="button">X</button></td>';
				$data .= '</tr>';
			}
		}
		$q->free_result();
		return $data;
	}

	function select_autocomplite_customer()
	{
		$this->db->select("a.*", false);
		$this->db->from("marketing_customer a");
		$this->db->where("(a.customer_id like '%" . $this->input->post('term') . "%'
		or a.nama like '%" . $this->input->post('term') . "%')", NULL, FALSE);
		$q = $this->db->get();
		return $q->result();
	}

	function select_data_detail_invoice()
	{
		$data = '';

		$this->db->where('no_invoice', $this->input->post('id'));
		$this->db->from('finance_invoice_customer_add');
		$this->db->order_by('id', 'asc');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $k => $r) {
				$data .= '<tr class="remove">';
				$data .= '<td style="vertical-align:middle;"><input class="form-control" type="text" style="width:270px;" readonly="readonly" name="tambah_service_produk[]" value="' . $r['description'] . '" /><br><input class="form-control" type="text" style="width:270px;" readonly="readonly" name="tambah_service_note[]" value="' . $r['note'] . '" /></td>';
				$data .= '<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" readonly="readonly" name="tambah_bw[]" value="' . number_format($r['bw'], 0) . '" /></td>';
				$data .= '<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" readonly="readonly" name="tambah_colo[]" value="' . number_format($r['colo'], 0) . '" /></td>';
				$data .= '<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" readonly="readonly" name="tambah_instalasi[]" value="' . number_format($r['instalasi'], 0) . '" /></td>';
				$data .= '<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" readonly="readonly" name="tambah_perangkat[]" value="' . number_format($r['perangkat'], 0) . '" /></td>';
				$data .= '<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" readonly="readonly" name="tambah_lain2[]" value="' . number_format($r['lain2'], 0) . '" /></td>';
				$data .= '<td style="vertical-align:middle;"><button type="button" class="button">X</button></td>';
				$data .= '</tr>';
			}
		}
		$q->free_result();
		return $data;
	}

	function invoice_info()
	{
		set_time_limit(0);
		$data = '';

		$this->db->select("a.*, 
		date_format(a.date_invoice, '" . date('Y') . "-" . date('m') . "-%d') as date_invoicenya, 
		date_format(a.date_due, '" . date('Y') . "-" . date('m') . "-%d') as date_duenya,
		IF(a.ppn = 1, ((a.bandwith + a.colocation + a.instalasi + a.perangkat + a.lain2) * 0.1),0) as ppn,
		COUNT(b.id) AS jml", false);
		$this->db->where('a.branch', $this->cek_id_regional($this->session->userdata('scope_area')));
		//$this->db->where('a.date_invoice <=', ''.date('Y').'-'.date('m').'-'.date('t').'');
		$this->db->where('a.date_invoice <', '' . date('Y') . '-' . date('m') . '-01');
		$this->db->where('a.billing_cycle', '1');
		$this->db->where('a.status_service', '0');
		//$this->db->where("(a.billing_cycle = '1' OR (a.billing_cycle = '0' AND DATE_FORMAT(a.date_invoice, '%m%Y') = '".date('m').date('Y')."'))", NULL, FALSE);
		$this->db->from('finance_customer_service2 AS a');
		$this->db->join('finance_invoice_customer b', "a.service_id = b.service_id 
		AND '" . date('m') . "' = DATE_FORMAT(b.date_invoice, '%m') 
		AND '" . date('Y') . "' = DATE_FORMAT(b.date_invoice, '%Y')", 'left');
		$this->db->order_by('a.service_id', 'desc');
		$this->db->group_by('a.service_id');
		$this->db->having('jml', '0');
		$q = $this->db->get();
		$this->db->trans_complete();
		if ($q->num_rows() != 0) {
			echo '<a href="' . base_url() . $this->uri->segment(1) . '/list_invoice"><em style="color:#ff0000;">Terdapat <strong>' . $q->num_rows() . '</strong> layanan belum terbit invoice dibulan <strong>' . date('M') . ' ' . date('Y') . '</strong></em></a>';
		} else {
			echo '<em>Semua layanan dibulan <strong>' . date('M') . ' ' . date('Y') . '</strong> telah terbit invoice</em>';
		}
	}

	function invoice_create_queue_id($bulan, $cust_id)
	{
		$invoice_cek = 0;
		$this->db->select("TRIM(LEADING '0' FROM SUBSTRING_INDEX(SUBSTRING_INDEX(no_invoice, '/', -1), '.', 1)) AS no_urut", false);
		$this->db->where("SUBSTRING_INDEX(SUBSTRING_INDEX(no_invoice, '/', 2), '/', -1) = '" . $cust_id . "'", NULL, FALSE);
		//$this->db->where("DATE_FORMAT(date_invoice, '%m%Y') = '042018'", NULL, FALSE);
		$this->db->order_by('no_urut', 'desc');
		$this->db->limit(1);
		$q = $this->db->get('finance_invoice_customer');
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$code_queue = $r['no_urut'] + 1;
			}
		} else {
			$code_queue = 1;
		}

		$code_queue_zero = str_pad($code_queue, 3, '0', STR_PAD_LEFT);

		$invoice = 'INV/' . $cust_id . '/' . $code_queue_zero . '.' . $bulan;
		while ($invoice_cek < 1) {
			$this->db->where("no_invoice = '" . $invoice . "'", NULL, FALSE);
			$this->db->where("SUBSTRING_INDEX(SUBSTRING_INDEX(no_invoice, '/', 2), '/', -1) = '" . $cust_id . "'", NULL, FALSE);
			$this->db->where("DATE_FORMAT(date_invoice, '%m%y') = '" . $bulan . "'", NULL, FALSE);
			$q = $this->db->get('finance_invoice_customer');
			if ($q->num_rows() == 0) {
				$invoice_cek = 1;
			} else {
				$code_queue++;
				$code_queue_zero = str_pad($code_queue, 3, '0', STR_PAD_LEFT);
				$invoice = 'INV/' . $cust_id . '/' . $code_queue_zero . '.' . $bulan;
			}
			$q->free_result();
		}
		return $invoice;
	}

	function invoice_create()
	{
		set_time_limit(0);
		$data = '';
		$date = date_create("" . $this->input->post('searchTahun') . "-" . $this->input->post('searchBulan') . "-01");
		$date_finish = date_format($date, "t");

		$this->db->trans_start();
		$this->db->select("a.*, SUBSTRING_INDEX(SUBSTRING_INDEX(REPLACE(a.customer_id,'/','.'), '.', 2), '/', 1) AS cust_id,
		date_format('" . $this->input->post('searchTahun') . "-" . $this->input->post('searchBulan') . "-01', '%m%y') as bulan_invoicenya, 
		date_format(a.date_invoice, '" . $this->input->post('searchTahun') . "-" . $this->input->post('searchBulan') . "-%d') as date_invoicenya, 
		date_format(a.date_due, '" . $this->input->post('searchTahun') . "-" . $this->input->post('searchBulan') . "-%d') as date_duenya,
		IF(a.ppn = 1, round(((a.bandwith + coalesce(sum(e.bw),0)) + (a.colocation + coalesce(sum(e.colo),0)) + (a.instalasi + coalesce(sum(e.instalasi),0)) + 
		(a.perangkat + coalesce(sum(e.perangkat),0)) + (a.lain2 + coalesce(sum(e.lain2),0))) * 0.1),0) as ppn,
		COUNT(b.id) AS jml,
		if(a.mf_cycle = '1', a.mf, if(DATE_FORMAT(a.date_invoice, '%m%Y') = '" . $this->input->post('searchBulan') . $this->input->post('searchTahun') . "', a.mf, 0)) as mf", false);
		$this->db->where('a.branch', $this->cek_id_regional($this->session->userdata('scope_area')));
		//$this->db->where('a.date_invoice <=', ''.$this->input->post('searchTahun').'-'.$this->input->post('searchBulan').'-'.$date_finish.'');
		$this->db->where('a.date_invoice <', '' . $this->input->post('searchTahun') . '-' . $this->input->post('searchBulan') . '-01');
		$this->db->where('a.billing_cycle', '1');
		$this->db->where('a.status_service', '0');
		//$this->db->where("(a.billing_cycle = '1' OR (a.billing_cycle = '0' AND DATE_FORMAT(a.date_invoice, '%m%Y') = '".$this->input->post('searchBulan').$this->input->post('searchTahun')."'))", NULL, FALSE);
		$this->db->from('finance_customer_service2 AS a');
		$this->db->join('finance_invoice_customer b', "a.service_id = b.service_id 
		AND '" . $this->input->post('searchBulan') . "' = DATE_FORMAT(b.date_invoice, '%m') 
		AND '" . $this->input->post('searchTahun') . "' = DATE_FORMAT(b.date_invoice, '%Y')", 'left');
		$this->db->join('finance_customer_service_add e', 'a.id = e.service_id', 'left');
		//$this->db->join('finance_invoice_customer b', "a.service_id = b.service_id 
		//AND '03' = DATE_FORMAT(b.date_invoice, '%m') 
		//AND '2018' = DATE_FORMAT(b.date_invoice, '%Y')", 'left');
		$this->db->order_by('a.date_invoice', 'asc');
		$this->db->order_by('a.service_id', 'asc');
		$this->db->group_by('a.id');
		$this->db->having('jml', '0');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $k => $r) {
				$inv = $this->invoice_create_queue_id($r['bulan_invoicenya'], $r['cust_id']);
				//$inv = 'INV/'.$cust_id.'/'.$urut_zero;
				$jumlah = $r['bandwith'] + $r['colocation'] + $r['instalasi'] + $r['perangkat'] + $r['lain2'] + $r['ppn'];

				$datasql = "('" . $inv . "', '" . $r['date_invoicenya'] . "', '" . $r['date_duenya'] . "', '" . $r['service_id'] . "', '" . $r['product_description'] . "', '" . $r['bandwith'] . "', '" . $r['colocation'] . "', '" . $r['instalasi'] . "', '" . $r['perangkat'] . "', '" . $r['lain2'] . "', '" . $r['mf'] . "', '" . $r['ppn'] . "', '" . $jumlah . "', '" . date('Y-m-d H:i:s') . "', '" . $this->cek_id_regional($this->session->userdata('scope_area')) . "')";
				$this->db->query("insert into gmd_finance_invoice_customer (no_invoice, date_invoice, date_due, service_id, product_desc, bw, colo, instalasi, perangkat, lain2, mf, ppn, jumlah, date_create, branch) values " . $datasql . "");


				$this->db->where('service_id', $r['id']);
				$this->db->from('finance_customer_service_add');
				$this->db->order_by('id', 'asc');
				$qr = $this->db->get();
				if ($qr->num_rows() > 0) {
					foreach ($qr->result_array() as $kr => $rr) {
						$this->db->query("insert into gmd_finance_invoice_customer_add (no_invoice, description, note, bw, colo, instalasi, perangkat, lain2) values ((SELECT id FROM gmd_finance_invoice_customer WHERE no_invoice = '" . $inv . "' order by id asc limit 1), '" . $rr['description'] . "', '" . $rr['note'] . "', '" . $rr['bw'] . "', '" . $rr['colo'] . "', '" . $rr['instalasi'] . "', '" . $rr['perangkat'] . "', '" . $rr['lain2'] . "')");
					}
				}
			}
		}
		$q->free_result();
		$this->db->trans_complete();
		return 1;
	}

	function invoice_delete()
	{

		$this->db->trans_start();
		$msg = '';
		$this->db->select('id');
		$this->db->where("DATE_FORMAT(date_invoice, '%Y-%m') = '" . $this->input->post('searchTahun') . "-" . $this->input->post('searchBulan') . "'", NULL, FALSE);
		$this->db->where("bayar", '0');
		$this->db->where("manual", '0');
		$this->db->from('finance_invoice_customer');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$this->db->where('id', $r['id']);
				$result = $this->db->delete('finance_invoice_customer');

				$this->db->where('no_invoice', $r['id']);
				$this->db->delete('finance_invoice_customer_add');

				$msg = 1;
			}
		}
		$q->free_result();






		//$dn = '2';
		//$qd = $this->db->query("delete from gmd_finance_invoice_customer where DATE_FORMAT(date_invoice, '%Y-%m') = '".$this->input->post('searchTahun')."-".$this->input->post('searchBulan')."' and bayar = '0' and manual = '0'");
		//$qd = $this->db->query("delete from gmd_finance_invoice_customer where DATE_FORMAT(date_invoice, '%Y-%m') = '2018-03';");
		//$qd->free_result();
		//$dn = $data;

		$this->db->trans_complete();
		return 1;

		//return $this->input->post('searchTahun')."-".$this->input->post('searchBulan');
	}

	function select_data()
	{
		$this->db->select("a.*, 
		b.customer_id, 
		if(b.invoice_name = '', b.nama, b.invoice_name) as nama,
		if(b.invoice_address = '', b.alamat, b.invoice_address) as alamat,
		if(b.invoice_phone = '', b.telp, b.invoice_phone) as telp,
		if(b.invoice_attention = '', b.cp, b.invoice_attention) as cp,
		if(a.jenis_potongan = 0, 'Diskon', 'Potongan') as jenis_potongan,
		if(b.ppn = 1 AND b.jenis_ppn = 0,1,0) as ppnnya, if(b.ppn = 1 AND b.jenis_ppn = 1,1,0) as jenis_ppn, 
		b.barcode, b.kategori, b.produk, b.product_description, b.payment_to, c.nama as customer_group_name, 
		date_format(a.date_invoice, '%d-%m-%Y') as date_invoicenya, 
		date_format(a.date_due, '%d-%m-%Y') as date_duenya, 
		date_format(LAST_DAY(a.date_invoice),'%d') as product_note_last_day,
		date_format(a.date_invoice,'%m') as product_note_m,
		date_format(a.date_invoice, '%Y') as product_note_y, 
		floor((a.bw + a.colo + a.instalasi + a.perangkat + a.lain2) * 0.1) as ppn_head,
		(1 + COALESCE((SELECT COUNT(id) FROM gmd_finance_invoice_customer_add WHERE no_invoice = a.id), 0)) as jml_det,
		b.ppn as ppn_tax", false);
		$this->db->from('finance_invoice_customer a');
		$this->db->join('finance_customer_service2 as b', 'a.service_id = b.service_id', 'left');
		$this->db->join('finance_customer2 as c', 'b.customer_id = c.customer_id', 'left');
		$this->db->where("a.id", $this->uri->segment(3));
		$this->db->limit('1');
		$q = $this->db->get();
		return $q;
	}
}
