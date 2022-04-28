<?php
class Model_finance_customer_service extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function get_data_tablea()
	{
		$page = ($this->input->post('page')) ? $this->input->post('page') : 1;
		$rp = ($this->input->post('rp')) ? $this->input->post('rp') : 10;
		$sortname = ($this->input->post('sortname')) ? $this->input->post('sortname') : 'a.id';
		$sortorder = ($this->input->post('sortorder')) ? $this->input->post('sortorder') : 'asc';

		header("Content-type: application/json");
		$jsonData = array('page' => $page, 'total' => 0, 'rows' => array());

		$this->db->select("SQL_CALC_FOUND_ROWS a.*, 
		if(a.status_service = 1, 'NON AKTIF', 'AKTIF') as status_service, 
		if(a.billing_cycle = 1, 'YA', 'TIDAK') as billing_cycle, 
		if(a.ppn = 1, 'YA', 'TIDAK') as ppn,
		if(a.status_maxi = 1, 'YA', 'TIDAK') as status_maxi, 
		if(a.status_cabang = 1, 'YA', 'TIDAK') as status_cabang, 
		if(a.msa = 1, 'MSA', 'MSD') as jenis_pelanggan", false);
		$this->db->where("(a.nama like '%" . $this->input->post('searchKeyword') . "%'
		OR a.alamat like '%" . $this->input->post('searchKeyword') . "%'
		OR a.telp like '%" . $this->input->post('searchKeyword') . "%'
		OR a.cp like '%" . $this->input->post('searchKeyword') . "%'
		OR a.invoice_name like '%" . $this->input->post('searchKeyword') . "%'
		OR a.invoice_address like '%" . $this->input->post('searchKeyword') . "%'
		OR a.invoice_phone like '%" . $this->input->post('searchKeyword') . "%'
		OR a.service_id like '%" . $this->input->post('searchKeyword') . "%'
		OR a.customer_id like '%" . $this->input->post('searchKeyword') . "%')", NULL, FALSE);
		$this->db->where('a.branch', $this->m_global->cek_id_regional($this->session->userdata('scope_area')));
		if ($this->input->post('searchkategori') != '0') {
			$this->db->where('a.kategori', $this->input->post('searchkategori'));
		}
		if ($this->input->post('searchstatus') != '') {
			$this->db->where('a.status_service', $this->input->post('searchstatus'));
		}
		if ($this->input->post('searchbilling_cycle') != '') {
			$this->db->where('a.billing_cycle', $this->input->post('searchbilling_cycle'));
		}
		if ($this->input->post('searchkat_inv') == '1') {
			$this->db->where('a.ppn', '1');
		} elseif ($this->input->post('searchkat_inv') == '2') {
			$this->db->where('a.ppn', '0');
		} elseif ($this->input->post('searchkat_inv') == '3') {
			$this->db->where('a.status_maxi', '1');
		} elseif ($this->input->post('searchkat_inv') == '4') {
			$this->db->where('a.status_cabang', '1');
		}
		$this->db->from('finance_customer_service2 AS a');
		//$this->db->join('finance_customer b', "a.customer_id = b.customer_id", 'left');
		//$this->db->join('master d', "a.kategori = d.id AND d.category = 'customer_type'", 'left');
		$this->db->order_by($sortname, $sortorder);
		$this->db->order_by('a.id', 'desc');
		$this->db->limit($rp, (($page - 1) * $rp));
		$q = $this->db->get();
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
		$no = (($page - 1) * $rp);
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$no++;
				$bayar = $this->cek_child($r['service_id']);
				//$bayar = 1;
				$edit = '<a href="#" onclick="update_data(\'' . $r['id'] . '\')" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a> <a href="#" onclick="delete_data(\'' . $r['id'] . '\')"><i class="icon-trash text-danger"></i></a>';
				if ($bayar > 0) {
					$edit = '<a href="#" onclick="update_data(\'' . $r['id'] . '\')" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a>';
				}
				$entry  = array(
					'id' => $r['id'],
					'cell' => array(
						'no' => $no . '.',
						'a.service_id' => $r['service_id'],
						'a.customer_id' => $r['customer_id'],
						'a.nama' => $r['nama'],
						'a.alamat' => $r['alamat'],
						'a.telp' => $r['telp'],
						'status_service' => $r['status_service'],
						'billing_cycle' => $r['billing_cycle'],
						'ppn' => $r['ppn'],
						'status_maxi' => $r['status_maxi'],
						'status_cabang' => $r['status_cabang'],
						'jenis_pelanggan' => $r['jenis_pelanggan'],
						'edit' => $edit,
					)
				);
				$jsonData['rows'][] = $entry;
			}
		}
		$q->free_result();
		/*
		if(count($jsonData['rows']) < $rp){
			$jsonData_push = $jsonData['rows'];
			for ($row_i = 1; $row_i <= ($rp - count($jsonData_push)); $row_i++){
							$entry_sub = array();
							foreach($jsonData_push[0]['cell'] as $jsonData_x3 => $jsonData_v3) {
								$entry_sub[$jsonData_x3] = '';
							}
							$entry  = array('id' =>'', 'cell'=>$entry_sub);
							$jsonData['rows'][] = $entry;
			}
		}
		*/
		$jsonData['total'] = $n;
		echo json_encode($jsonData);
	}

	function get_data_table()
	{
		$column_order = array(null, 'a.service_id', 'a.customer_id', 'a.nama', 'a.alamat', 'a.telp', 'status_service', 'billing_cycle', 'ppn', 'status_maxi', 'status_cabang', 'jenis_pelanggan');
		$order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'a.tanggal';
		$order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'asc';

		$this->db->select("SQL_CALC_FOUND_ROWS a.*, 
		if(a.status_service = 1, 'NON AKTIF', 'AKTIF') as status_service, 
		if(a.billing_cycle = 1, 'YA', 'TIDAK') as billing_cycle, 
		if(a.ppn = 1, 'YA', 'TIDAK') as ppn,
		if(a.status_maxi = 1, 'YA', '') as status_maxi, 
		if(a.status_cabang = 1, 'YA', '') as status_cabang, 
		if(a.msa = 1, 'MSA', 'MSD') as jenis_pelanggan", false);
		$this->db->from('finance_customer_service2 a');
		$this->db->group_start();
		$this->db->like('a.nama', $this->input->post('search_keyword'));
		$this->db->or_like('a.alamat', $this->input->post('search_keyword'));
		$this->db->or_like('a.telp', $this->input->post('search_keyword'));
		$this->db->or_like('a.cp', $this->input->post('search_keyword'));
		$this->db->or_like('a.invoice_name', $this->input->post('search_keyword'));
		$this->db->or_like('a.invoice_address', $this->input->post('search_keyword'));
		$this->db->or_like('a.invoice_phone', $this->input->post('search_keyword'));
		$this->db->or_like('a.service_id', $this->input->post('search_keyword'));
		$this->db->or_like('a.customer_id', $this->input->post('search_keyword'));
		$this->db->group_end();
		if ($this->input->post('searchkategori') != '0') {
			$this->db->where('a.kategori', $this->input->post('searchkategori'));
		}
		if ($this->input->post('searchstatus') != '') {
			$this->db->where('a.status_service', $this->input->post('searchstatus'));
		}
		if ($this->input->post('searchbilling_cycle') != '') {
			$this->db->where('a.billing_cycle', $this->input->post('searchbilling_cycle'));
		}
		if ($this->input->post('searchkat_inv') == '1') {
			$this->db->where('a.ppn', '1');
		} elseif ($this->input->post('searchkat_inv') == '2') {
			$this->db->where('a.ppn', '0');
		} elseif ($this->input->post('searchkat_inv') == '3') {
			$this->db->where('a.status_maxi', '1');
		} elseif ($this->input->post('searchkat_inv') == '4') {
			$this->db->where('a.status_cabang', '1');
		}
		$this->db->where('a.branch', $this->m_global->cek_id_regional($this->session->userdata('scope_area')));
		$this->db->order_by($order_name, $order_dir);
		$this->db->order_by('a.id', 'desc');
		if ($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
		$q = $this->db->get();
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
		$data = array();
		$no = $_POST['start'];
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$no++;
				$bayar = $this->cek_child($r['service_id']);
				//$bayar = 1;
				$edit = '<a href="#" onclick="update_data(\'' . $r['id'] . '\')" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7 position-left text-slate-800"></i></a> <a href="#" onclick="delete_data(\'' . $r['id'] . '\')"><i class="icon-bin position-left text-grey"></i></a>';
				if ($bayar > 0) {
					$edit = '<a href="#" onclick="update_data(\'' . $r['id'] . '\')" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7 position-left text-slate-800"></i></a>';
				}
				$row  = array(
					$no . '.',
					$r['service_id'],
					$r['customer_id'],
					$r['nama'],
					$r['alamat'],
					$r['telp'],
					$r['status_service'],
					$r['billing_cycle'],
					$r['ppn'],
					$r['status_maxi'],
					$r['status_cabang'],
					$r['jenis_pelanggan'],
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
		$service_id = strtoupper($this->input->post('service_id'));
		$service_id = str_replace(" ", "", $service_id);
		$this->db->from('finance_customer_service2 a');
		$this->db->where('service_id', $service_id);
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$msg = 'Service ID telah digunakan';
		} else {
			$bandwith = (float) str_replace(",", "", $this->input->post('bandwith'));
			$colocation = (float) str_replace(",", "", $this->input->post('colocation'));
			$instalasi = (float) str_replace(",", "", $this->input->post('instalasi'));
			$perangkat = (float) str_replace(",", "", $this->input->post('perangkat'));
			$lain2 = (float) str_replace(",", "", $this->input->post('lain2'));
			$mf = (float) str_replace(",", "", $this->input->post('mf'));
			$payment_to = '';
			if (isset($_POST['payment_to'])) {
				foreach ($_POST['payment_to'] as $k => $v) {
					$payment_to .= ($k == 0) ? $v : ',' . $v;
				}
			}
			$data = array(
				'service_id' => $service_id,
				'cid' => $this->input->post('cid'),
				'customer_id' => $this->input->post('customer_id'),
				'nama' => strtoupper($this->input->post('nama')),
				'alamat' => strtoupper($this->input->post('alamat')),
				'telp' => strtoupper($this->input->post('telp')),
				'cp' => strtoupper($this->input->post('cp')),
				'product_description' => $this->input->post('product_description'),
				'product_note' => $this->input->post('product_note'),
				'bandwith' => $bandwith,
				'colocation' => $colocation,
				'instalasi' => $instalasi,
				'perangkat' => $perangkat,
				'lain2' => $lain2,
				'mf' => $mf,
				'date_invoice' => $this->input->post('date_invoice'),
				'date_due' => $this->input->post('date_due'),
				'ppn' => $this->input->post('ppn'),
				'bhp_uso' => $this->input->post('bhp_uso'),
				'billing_cycle' => $this->input->post('billing_cycle'),
				'mf_cycle' => $this->input->post('mf_cycle'),
				'barcode' => $this->input->post('barcode'),
				'jenis_ppn' => $this->input->post('jenis_ppn'),
				'status_service' => $this->input->post('status_service'),
				'invoice_name' => $this->input->post('invoice_name'),
				'invoice_address' => $this->input->post('invoice_address'),
				'invoice_attention' => $this->input->post('invoice_attention'),
				'invoice_phone' => $this->input->post('invoice_phone'),
				'status_maxi' => $this->input->post('status_maxi'),
				'status_cabang' => $this->input->post('status_cabang'),
				'msa' => $this->input->post('msa'),
				'payment_to' => $payment_to,
				'branch' => $this->m_global->cek_id_regional($this->session->userdata('scope_area')),
			);
			$result = $this->db->insert('finance_customer_service2', $data);
			if ($result == true) {
				if (isset($_POST['tambah_service_produk'])) {
					foreach ($_POST['tambah_service_produk'] as $k => $v) {
						$bw = (float) str_replace(",", "", $_POST['tambah_bw'][$k]);
						$colo = (float) str_replace(",", "", $_POST['tambah_colo'][$k]);
						$instalasi = (float) str_replace(",", "", $_POST['tambah_instalasi'][$k]);
						$perangkat = (float) str_replace(",", "", $_POST['tambah_perangkat'][$k]);
						$lain2 = (float) str_replace(",", "", $_POST['tambah_lain2'][$k]);
						$qd = $this->db->query("insert into gmd_finance_customer_service_add (service_id, description, note, bw, colo, instalasi, perangkat, lain2) values 
						((SELECT id FROM gmd_finance_customer_service2 WHERE service_id = '" . $service_id . "'), '" . $_POST['tambah_service_produk'][$k] . "', '" . $_POST['tambah_service_note'][$k] . "', '" . $bw . "', '" . $colo . "', '" . $instalasi . "', '" . $perangkat . "', '" . $lain2 . "')");
					}
				}
				$msg = 1;
			} else {
				$msg = 0;
			}
		}
		$this->db->trans_complete();
		return $msg;
	}

	function select()
	{
		$this->db->select("SQL_CALC_FOUND_ROWS a.*, if(a.cid = 0, b.nama, c.nama) as customer_group, if(a.cid = 0, b.id, c.id) as cid, if(a.cid = 0, b.customer_id, c.customer_id) as customer_id", false);
		$this->db->from('finance_customer_service2 a');
		$this->db->join('finance_customer2 b', "a.customer_id = b.customer_id", 'left');
		$this->db->join('finance_customer2 c', "a.cid = c.id", 'left');
		$this->db->where("a.id", $this->input->post('id'));
		$q = $this->db->get();
		return $q->result();
	}

	function update()
	{
		$this->db->trans_start();
		$service_id = strtoupper($this->input->post('service_id'));
		$service_id = str_replace(" ", "", $service_id);
		$this->db->from('finance_customer_service2 a');
		$this->db->where('service_id', $service_id);
		$this->db->where('id !=', $this->input->post('id'));
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$msg = 'Service ID telah digunakan';
		} else {
			$bandwith = (float) str_replace(",", "", $this->input->post('bandwith'));
			$colocation = (float) str_replace(",", "", $this->input->post('colocation'));
			$instalasi = (float) str_replace(",", "", $this->input->post('instalasi'));
			$perangkat = (float) str_replace(",", "", $this->input->post('perangkat'));
			$lain2 = (float) str_replace(",", "", $this->input->post('lain2'));
			$mf = (float) str_replace(",", "", $this->input->post('mf'));
			$payment_to = '';
			if (isset($_POST['payment_to'])) {
				foreach ($_POST['payment_to'] as $k => $v) {
					$payment_to .= ($k == 0) ? $v : ',' . $v;
				}
			}
			$data = array(
				'service_id' => $service_id,
				'cid' => $this->input->post('cid'),
				'customer_id' => $this->input->post('customer_id'),
				'nama' => strtoupper($this->input->post('nama')),
				'alamat' => strtoupper($this->input->post('alamat')),
				'telp' => strtoupper($this->input->post('telp')),
				'cp' => strtoupper($this->input->post('cp')),
				'product_description' => $this->input->post('product_description'),
				'product_note' => $this->input->post('product_note'),
				'bandwith' => $bandwith,
				'colocation' => $colocation,
				'instalasi' => $instalasi,
				'perangkat' => $perangkat,
				'lain2' => $lain2,
				'mf' => $mf,
				'date_invoice' => $this->input->post('date_invoice'),
				'date_due' => $this->input->post('date_due'),
				'ppn' => $this->input->post('ppn'),
				'bhp_uso' => $this->input->post('bhp_uso'),
				'billing_cycle' => $this->input->post('billing_cycle'),
				'mf_cycle' => $this->input->post('mf_cycle'),
				'barcode' => $this->input->post('barcode'),
				'jenis_ppn' => $this->input->post('jenis_ppn'),
				'status_service' => $this->input->post('status_service'),
				'invoice_name' => $this->input->post('invoice_name'),
				'invoice_address' => $this->input->post('invoice_address'),
				'invoice_attention' => $this->input->post('invoice_attention'),
				'invoice_phone' => $this->input->post('invoice_phone'),
				'status_maxi' => $this->input->post('status_maxi'),
				'status_cabang' => $this->input->post('status_cabang'),
				'msa' => $this->input->post('msa'),
				'payment_to' => $payment_to,
				'branch' => 8,
				// 'branch' => $this->m_global->cek_id_regional($this->session->userdata('scope_area')),
			);
			$this->db->where('id', $this->input->post('id'));
			$result = $this->db->update('finance_customer_service2', $data);
			if ($result == true) {
				$data = array(
					'service_id' => $service_id,
				);
				$this->db->where('service_id', $this->input->post('service_id_old'));
				$this->db->update('finance_invoice_customer', $data);

				$this->db->where('service_id', $this->input->post('id'));
				$this->db->delete('gmd_finance_customer_service_add');
				if (isset($_POST['tambah_service_produk'])) {
					foreach ($_POST['tambah_service_produk'] as $k => $v) {
						$bw = (float) str_replace(",", "", $_POST['tambah_bw'][$k]);
						$colo = (float) str_replace(",", "", $_POST['tambah_colo'][$k]);
						$instalasi = (float) str_replace(",", "", $_POST['tambah_instalasi'][$k]);
						$perangkat = (float) str_replace(",", "", $_POST['tambah_perangkat'][$k]);
						$lain2 = (float) str_replace(",", "", $_POST['tambah_lain2'][$k]);
						$data = array(
							'service_id' => $this->input->post('id'),
							'description' => $_POST['tambah_service_produk'][$k],
							'note' => $_POST['tambah_service_note'][$k],
							'bw' => $bw,
							'colo' => $colo,
							'instalasi' => $instalasi,
							'perangkat' => $perangkat,
							'lain2' => $lain2,
						);
						$this->db->insert('gmd_finance_customer_service_add', $data);
					}
				}

				$msg = 1;
			} else {
				$msg = 0;
			}
		}
		$this->db->trans_complete();
		return $msg;
	}

	function delete()
	{
		$this->db->where('id', $this->input->post('id'));
		$result = $this->db->delete('finance_customer_service2');
		if ($result == true) {
			$this->db->where('service_id', $this->input->post('id'));
			$this->db->delete('finance_invoice_customer_add');
			$msg = 1;
		} else {
			$msg = 0;
		}
		return $msg;
	}

	function select_data_detail_invoice()
	{
		$data = '';

		$this->db->where('service_id', $this->input->post('id'));
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

	function cek_child($id)
	{
		$data = 0;

		$this->db->from('finance_invoice_customer');
		$this->db->where("service_id", $id);
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$data = 1;
		}

		return $data;
	}
}
