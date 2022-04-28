<?php


class Model_finance_ap_invoice extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function get_data_table()
	{
		$kondisi = null;
		$column_order = array(null, 'a.nomor', 'a.insert_at', 'a.tanggal', 'a.date_due', 'nama_sup', 'a.no_referensi', 'z.nomor_po', 'a.jumlah', null);
		$order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'a.nomor';
		$order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'asc';

		if ($_POST['length'] != -1) $limit = ' LIMIT ' . $_POST['start'] . ',' . $_POST['length'];
		// $this->db->order_by($order_name, $order_dir);
		if (!empty($order_name) && !empty($order_dir)) {
			$order = "ORDER BY $order_name $order_dir";
		} else {
			$order = "ORDER BY a.nomor ASC";
		}
		if ($this->input->post('searchlunas') == '1') {
			$kondisi = " AND a.`lunas` = 1";
		} else if ($this->input->post('searchlunas') == '0') {
			$kondisi = " AND a.`lunas` = 0";
		}
		$q = $this->db->query("SELECT SQL_CALC_FOUND_ROWS a.*,
		DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya,
		DATE_FORMAT(a.date_due, '%d-%m-%Y') AS date_duenya,
		IF(a.supplier = 0, 'LAIN2', b.nama) AS nama_sup,
		z.nomor_po,z.search_po
	  FROM
		erp_financev2.`gmd_finance_ap_invoice` a
		LEFT JOIN  inventory_v2.`ms_perusahaan` b
		  ON `a`.`supplier` = `b`.`id_perusahaan`
		LEFT JOIN (SELECT a.id,c.nomor AS nomor_po,GROUP_CONCAT(c.nomor) as search_po FROM erp_financev2.`gmd_finance_ap_invoice` a JOIN erp_financev2.`gmd_finance_ap_invoice_detail` b ON a.`id`=b.`id_ap`
  JOIN inventory_v2.`tr_h_pembelian` c ON b.id_pembelian=c.`id_header` WHERE a.`status`!=9 AND b.`status`!=9 GROUP BY a.`id`) z ON a.`id`=z.id
	  WHERE (
		`a`.`no_referensi` LIKE '%" . $this->input->post('search_keyword') . "%' ESCAPE '!'
            OR `a`.`nomor` LIKE '%" . $this->input->post('search_keyword') . "%' ESCAPE '!'
			OR `b`.`nama` LIKE '%" . $this->input->post('search_keyword') . "%' ESCAPE '!'
			OR z.`search_po` LIKE '%" . $this->input->post('search_keyword') . "%' ESCAPE '!'
		)
		AND (
			a.`insert_at` BETWEEN '" . $this->input->post('searchDateFirst') . "'
            AND '" . $this->input->post('searchDateFinish') . "'
		)
		AND `a`.`branch` = '8' AND a.`status`=1 $kondisi
	  $order $limit");
		// $q = $this->db->get();
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
		$data = array();
		$no = $_POST['start'];
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$no++;
				$opsi = '<a href="#" onClick="view_data(\'' . $r['id'] . '\')"><i class="icon-folder position-left text-slate-800"></i></a> <a href="#" onClick="update_data(\'' . $r['id'] . '\')"><i class="icon-pencil position-left text-slate-800"></i></a> <a href="#" onClick="delete_data(\'' . $r['id'] . '\')"><i class="icon-bin position-left text-grey"></i></a>';
				$row  = array(
					$no . '.',
					$r['nomor'],
					date("d-m-Y", strtotime($r['insert_at'])),
					$r['tanggalnya'],
					$r['date_duenya'],

					//$r['id_refnya'],
					//$r['transaksinya'],
					$r['nama_sup'],
					$r['no_referensi'],
					$r['nomor_po'],
					number_format($r['jumlah'], 0),
					$opsi,
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

	function create_queue_id($nomor = null)
	{
		$y = substr(date('Y'), 2);
		$q = $this->db->query('select * from erp_financev2.`gmd_finance_ap_invoice` where SUBSTRING(nomor, -2) =' . $y)->num_rows();
		if (!empty($nomor)) {
			$nomor = $nomor + 1;
		} else {
			$nomor = $q + 1;
		}
		$invoice = $nomor . '/INV/' . mdate("%m", time()) . '/' . mdate("%y", time());
		$query = $this->db->query("SELECT * FROM erp_financev2.`gmd_finance_ap_invoice` a WHERE a.`nomor`='$invoice'")->result();
		if (!empty($query)) {
			$invoice = $this->create_queue_id($nomor);
		}
		return $invoice;
	}

	function create_id()
	{
		$invoice_cek = 0;
		$query = $this->db->query("SELECT MAX(id) AS last_id FROM erp_financev2.`gmd_finance_coa_general_ledger`")->row();
		$invoice = $query->last_id;
		while ($invoice_cek < 1) {
			$this->db->where("id = '" . $invoice . "'", NULL, FALSE);
			$q = $this->db->get('finance_coa_general_ledger');
			if ($q->num_rows() == 0) {
				$invoice_cek = 1;
			} else {
				$invoice++;
			}
		}
		return $invoice;
	}

	function insert()
	{
		$this->db->trans_start();
		$create_queue_id = $this->create_queue_id(null);
		$no_referensi = str_replace(" ", "", $this->input->post('inv_supplier'));
		// $potongan = str_replace(",", "", $this->input->post('potongan'));
		$materai = str_replace(",", "", $this->input->post('materai'));
		$ppn = str_replace(",", "", $this->input->post('ppn'));
		$pph = str_replace(",", "", $this->input->post('pph'));
		$jumlah = str_replace(",", "", $this->input->post('jumlah'));
		$kd_pajak = $this->input->post('kd_pajak');
		$now = date('Y-m-d H:i:s');
		$ongkir = $diskon = 0;
		$data = array(
			'nomor' => $create_queue_id,
			'tanggal' => $this->input->post('tanggal'),
			'date_due' => $this->input->post('date_due'),
			'supplier' => $this->input->post('supplier'),
			// 'potongan' => $potongan,
			'materai' => $materai,
			'ket' => $this->input->post('keterangan'),
			'ppn' => $ppn,
			'pph' => $pph,
			'pajak' => $kd_pajak,
			'jumlah' => $jumlah,
			'flag' => 1,
			'no_referensi' => $no_referensi,
			'kat_gl' => $this->input->post('kat_gl'),
			'branch' => $this->cek_id_regional($this->session->userdata('scope_area')),
			'regional' => $this->cek_id_regional($this->session->userdata('scope_regional')),
			'insert_at' => $now,
			'insert_by' => $this->session->userdata('user_id')
		);
		$result = $this->db->insert('finance_ap_invoice', $data);
		$id = $this->db->insert_id();
		$id_barang = $jumlah_barang = $satuan_barang = $jumlah_harga = null;
		if ($result == true) {
			if (isset($_POST['id_barang'])) {
				foreach ($_POST['id_barang'] as $k => $v) {
					if (!empty($_POST['id_barang'][$k])) {
						if ($_POST['id_barang'][$k] == 'x') {
							$ongkir = $ongkir + $_POST['jumlah_harga'][$k];
							$id_barang = $_POST['id_barang'][$k];
							$jumlah_barang = $_POST['jumlah_barang'][$k];
							$satuan_barang = $_POST['satuan_barang'][$k];
							$harga_barang = str_replace(",", "", $_POST['harga_barang'][$k]);
							$jumlah_harga = $_POST['jumlah_harga'][$k];
							$jurnal = $_POST['jurnal'][$k];
							$id_penerimaan = $_POST['id_penerimaan'][$k];
							$id_pembelian = $_POST['id_pembelian'][$k];
							$data = array(
								'id_ap' => $id,
								'id_coa' => $jurnal,
								'id_barang' => $id_barang,
								'jumlah' => $jumlah_barang,
								'satuan' => $satuan_barang,
								'harga' => $harga_barang,
								'jumlah_harga' => $jumlah_harga,
								'id_pembelian' => $id_pembelian,
								'id_penerimaan' => $id_penerimaan
							);
							$this->db->insert('finance_ap_invoice_detail', $data);
						} else if ($_POST['id_barang'][$k] == 'xx') {
							$diskon = $diskon + $_POST['jumlah_harga'][$k];
							$id_barang = $_POST['id_barang'][$k];
							$jumlah_barang = $_POST['jumlah_barang'][$k];
							$satuan_barang = $_POST['satuan_barang'][$k];
							$harga_barang = str_replace(",", "", $_POST['harga_barang'][$k]);
							$jumlah_harga = $_POST['jumlah_harga'][$k];
							$jurnal = $_POST['jurnal'][$k];
							$id_penerimaan = $_POST['id_penerimaan'][$k];
							$id_pembelian = $_POST['id_pembelian'][$k];
							$data = array(
								'id_ap' => $id,
								'id_coa' => $jurnal,
								'id_barang' => $id_barang,
								'jumlah' => $jumlah_barang,
								'satuan' => $satuan_barang,
								'harga' => $harga_barang,
								'jumlah_harga' => $jumlah_harga,
								'id_pembelian' => $id_pembelian,
								'id_penerimaan' => $id_penerimaan
							);
							$this->db->insert('finance_ap_invoice_detail', $data);
						} else {
							$id_barang = $_POST['id_barang'][$k];
							$jumlah_barang = $_POST['jumlah_barang'][$k];
							$satuan_barang = $_POST['satuan_barang'][$k];
							$harga_barang = str_replace(",", "", $_POST['harga_barang'][$k]);
							$jumlah_harga = $_POST['jumlah_harga'][$k];
							$jurnal = $_POST['jurnal'][$k];
							$id_penerimaan = $_POST['id_penerimaan'][$k];
							$id_pembelian = $_POST['id_pembelian'][$k];
							$data = array(
								'id_ap' => $id,
								'id_coa' => $jurnal,
								'id_barang' => $id_barang,
								'jumlah' => $jumlah_barang,
								'satuan' => $satuan_barang,
								'harga' => $harga_barang,
								'jumlah_harga' => $jumlah_harga,
								'id_pembelian' => $id_pembelian,
								'id_penerimaan' => $id_penerimaan
							);
							$this->db->insert('finance_ap_invoice_detail', $data);
						}
					}
				}
				$data = array('ongkir' => $ongkir, 'diskon' => $diskon);
				$this->db->where('id', $id);
				$this->db->update('finance_ap_invoice', $data);
				$supp = $this->db->query('SELECT nama FROM inventory_v2.`ms_perusahaan` WHERE id_perusahaan = "' . $this->input->post('supplier') . '"')->row();
				$res = $this->insert_gl($this->input->post('tanggal'), $this->input->post('kat_gl'), $this->input->post('jurnal'), $this->input->post('jumlah_harga'), $this->input->post('id_barang'), null, $create_queue_id, $materai, $ppn, $pph, $kd_pajak, $no_referensi, $supp->nama, null, null);
			}
			if (!empty($res)) {
				$data = array('id_gl' => $res);
				$this->db->where('id', $id);
				$this->db->update('finance_ap_invoice', $data);
				$msg = 1;
			} else {
				$msg = 0;
			}
		} else {
			$msg = 0;
		}
		$this->db->trans_complete();
		return $msg;
	}

	function insert_manual()
	{
		$this->db->trans_start();
		$create_queue_id = $this->create_queue_id(null);
		$no_referensi = str_replace(" ", "", $this->input->post('inv_supplier'));
		// $potongan = str_replace(",", "", $this->input->post('potongan'));
		$materai = str_replace(",", "", $this->input->post('materai'));
		$ppn = str_replace(",", "", $this->input->post('ppn'));
		$pph = str_replace(",", "", $this->input->post('pph'));
		$ongkir = str_replace(",", "", $this->input->post('ongkir'));
		$jumlah = str_replace(",", "", $this->input->post('jumlah'));
		$kd_pajak = $this->input->post('kd_pajak');
		$now = date('Y-m-d H:i:s');
		$diskon = 0;
		$data = array(
			'nomor' => $create_queue_id,
			'tanggal' => $this->input->post('tanggal'),
			'date_due' => $this->input->post('date_due'),
			'supplier' => $this->input->post('supplier'),
			// 'potongan' => $potongan,
			'materai' => $materai,
			'ket' => $this->input->post('keterangan'),
			'ppn' => $ppn,
			'pph' => $pph,
			'pajak' => $kd_pajak,
			'jumlah' => $jumlah,
			'ongkir' => $ongkir,
			'flag' => 2,
			'no_referensi' => $no_referensi,
			'kat_gl' => $this->input->post('kat_gl'),
			'branch' => $this->cek_id_regional($this->session->userdata('scope_area')),
			'regional' => $this->cek_id_regional($this->session->userdata('scope_regional')),
			'insert_at' => $now,
			'insert_by' => $this->session->userdata('user_id')
		);
		$result = $this->db->insert('finance_ap_invoice', $data);
		$id = $this->db->insert_id();
		$jumlah_barang = $satuan_barang = $jumlah_harga = null;
		if ($result == true) {
			if (isset($_POST['nama_barang'])) {
				foreach ($_POST['nama_barang'] as $k => $v) {
					if (strpos($_POST['nama_barang'][$k], 'Diskon') !== false || strpos($_POST['nama_barang'][$k], 'diskon') !== false) {
						$nama_barang = $_POST['nama_barang'][$k];
						$jumlah_barang = $_POST['qty'][$k];
						$satuan_barang = $_POST['satuan'][$k];
						$harga_barang = str_replace(",", "", $_POST['harga'][$k]);
						$jumlah_harga = str_replace(",", "", $_POST['jumlah_harga'][$k]);
						$jurnal = $_POST['jurnal'][$k];
						$data = array(
							'id_ap' => $id,
							'id_coa' => $jurnal,
							'nama_barang' => $nama_barang,
							'jumlah' => $jumlah_barang,
							'satuan' => $satuan_barang,
							'harga' => $harga_barang,
							'jumlah_harga' => $jumlah_harga
						);
						$this->db->insert('finance_ap_invoice_manual', $data);
						$diskon = $diskon + ($jumlah_harga * -1);
					} else {
						$nama_barang = $_POST['nama_barang'][$k];
						$jumlah_barang = $_POST['qty'][$k];
						$satuan_barang = $_POST['satuan'][$k];
						$harga_barang = str_replace(",", "", $_POST['harga'][$k]);
						$jumlah_harga = str_replace(",", "", $_POST['jumlah_harga'][$k]);
						$jurnal = $_POST['jurnal'][$k];
						$data = array(
							'id_ap' => $id,
							'id_coa' => $jurnal,
							'nama_barang' => $nama_barang,
							'jumlah' => $jumlah_barang,
							'satuan' => $satuan_barang,
							'harga' => $harga_barang,
							'jumlah_harga' => $jumlah_harga
						);
						$this->db->insert('finance_ap_invoice_manual', $data);
					}
				}
				$data = array('diskon' => $diskon);
				$this->db->where('id', $id);
				$this->db->update('finance_ap_invoice', $data);
			}
			$supp = $this->db->query('SELECT nama FROM inventory_v2.`ms_perusahaan` WHERE id_perusahaan = "' . $this->input->post('supplier') . '"')->row();
			$res = $this->insert_gl($this->input->post('tanggal'), $this->input->post('kat_gl'), $this->input->post('jurnal'), $this->input->post('jumlah_harga'), null, $this->input->post('nama_barang'), $create_queue_id, $materai, $ppn, $pph, $kd_pajak, $no_referensi, $supp->nama, $ongkir, null);
			if (!empty($res)) {
				$data = array('id_gl' => $res);
				$this->db->where('id', $id);
				$this->db->update('finance_ap_invoice', $data);
				$msg = 1;
			} else {
				$msg = 0;
			}
		} else {
			$msg = 0;
		}
		$this->db->trans_complete();
		return $msg;
	}

	function update_manual()
	{
		$this->db->trans_start();
		$jurnal_group = null;
		$id = $this->input->post('id');
		$branch = $this->m_global->cek_id_regional($this->session->userdata('scope_area'));
		$area = $this->m_global->cek_id_regional($this->session->userdata('scope_regional'));
		$no_referensi = str_replace(" ", "", $this->input->post('inv_supplier'));
		$materai = str_replace(",", "", $this->input->post('materai'));
		$ppn = str_replace(",", "", $this->input->post('ppn'));
		$pph = str_replace(",", "", $this->input->post('pph'));
		$ongkir = str_replace(",", "", $this->input->post('ongkir'));
		$jumlah = str_replace(",", "", $this->input->post('jumlah'));
		$kd_pajak = $this->input->post('kd_pajak');
		$kat_gl_lama = $this->db->query("SELECT id_gl,kat_gl,nomor FROM erp_financev2.`gmd_finance_ap_invoice` WHERE id=$id")->row();
		$now = date('Y-m-d H:i:s');
		$diskon = 0;
		$data = array(
			'tanggal' => $this->input->post('tanggal'),
			'date_due' => $this->input->post('date_due'),
			'supplier' => $this->input->post('supplier'),
			'materai' => $materai,
			'ket' => $this->input->post('keterangan'),
			'ppn' => $ppn,
			'pph' => $pph,
			'pajak' => $kd_pajak,
			'jumlah' => $jumlah,
			'ongkir' => $ongkir,
			'flag' => 2,
			'no_referensi' => $no_referensi,
			'kat_gl' => $this->input->post('kat_gl'),
			'branch' => $this->cek_id_regional($this->session->userdata('scope_area')),
			'regional' => $this->cek_id_regional($this->session->userdata('scope_regional')),
			'update_at' => $now,
			'update_by' => $this->session->userdata('user_id')
		);
		$this->db->where('id', $id);
		$this->db->update('finance_ap_invoice', $data);
		$data = array('status' => 9);
		$this->db->where('id_ap', $id);
		$this->db->update('finance_ap_invoice_manual', $data);
		$jumlah_barang = $satuan_barang = $jumlah_harga = null;
		if (isset($_POST['nama_barang'])) {
			foreach ($_POST['nama_barang'] as $k => $v) {
				if (strpos($_POST['nama_barang'][$k], 'Diskon') !== false || strpos($_POST['nama_barang'][$k], 'diskon') !== false) {
					$nama_barang = $_POST['nama_barang'][$k];
					$jumlah_barang = $_POST['qty'][$k];
					$satuan_barang = $_POST['satuan'][$k];
					$harga_barang = str_replace(",", "", $_POST['harga'][$k]);
					$jumlah_harga = str_replace(",", "", $_POST['jumlah_harga'][$k]);
					$jurnal = $_POST['jurnal'][$k];
					$data = array(
						'id_ap' => $id,
						'id_coa' => $jurnal,
						'nama_barang' => $nama_barang,
						'jumlah' => $jumlah_barang,
						'satuan' => $satuan_barang,
						'harga' => $harga_barang,
						'jumlah_harga' => $jumlah_harga
					);
					$this->db->insert('finance_ap_invoice_manual', $data);
					$diskon = $diskon + ($jumlah_harga * -1);
				} else {
					$nama_barang = $_POST['nama_barang'][$k];
					$jumlah_barang = $_POST['qty'][$k];
					$satuan_barang = $_POST['satuan'][$k];
					$harga_barang = str_replace(",", "", $_POST['harga'][$k]);
					$jumlah_harga = str_replace(",", "", $_POST['jumlah_harga'][$k]);
					$jurnal = $_POST['jurnal'][$k];
					$data = array(
						'id_ap' => $id,
						'id_coa' => $jurnal,
						'nama_barang' => $nama_barang,
						'jumlah' => $jumlah_barang,
						'satuan' => $satuan_barang,
						'harga' => $harga_barang,
						'jumlah_harga' => $jumlah_harga
					);
					$this->db->insert('finance_ap_invoice_manual', $data);
				}
			}
			$data = array('diskon' => $diskon);
			$this->db->where('id', $id);
			$this->db->update('finance_ap_invoice', $data);
		}
		//insert delete jurnal
		if ($kat_gl_lama->kat_gl == $this->input->post('kat_gl')) {
			$jurnal_group = $this->db->query("SELECT jurnal_group FROM erp_financev2.`gmd_finance_coa_general_ledger` WHERE no_trans = '" . $kat_gl_lama->id_gl . "'")->row();
			$q = $this->db->query("SELECT * FROM erp_financev2.`gmd_finance_coa_general_ledger_detail` a WHERE a.`no_trans` = $kat_gl_lama->id_gl")->result();
			foreach ($q as $row) {
				$no_trans = $row->no_trans;
				$id_biaya = $row->id_biaya;
				$card_id = $row->card_id;
				$tanggal = $row->tanggal;
				$this->db->where('no_trans', $no_trans);
				$this->db->where('id_biaya', $id_biaya);
				$this->db->delete('finance_coa_general_ledger_detail');
				$this->m_global->update_jurnal_bulanan($id_biaya, $card_id, $tanggal, $branch, $area);
				$this->m_global->update_jurnal_harian($id_biaya, $card_id, $tanggal, $branch, $area);
			}
			$this->db->where('no_trans', $kat_gl_lama->id_gl);
			$this->db->delete('finance_coa_general_ledger');

			$supp = $this->db->query('SELECT nama FROM inventory_v2.`ms_perusahaan` WHERE id_perusahaan = "' . $this->input->post('supplier') . '"')->row();

			$res = $this->insert_gl($this->input->post('tanggal'), $this->input->post('kat_gl'), $this->input->post('jurnal'), $this->input->post('jumlah_harga'), null, $this->input->post('nama_barang'), $kat_gl_lama->nomor, $materai, $ppn, $pph, $kd_pajak, $no_referensi, $supp->nama, $ongkir, $jurnal_group->jurnal_group);

			if (!empty($res)) {
				$data = array('id_gl' => $res);
				$this->db->where('id', $id);
				$this->db->update('finance_ap_invoice', $data);
				$msg = 1;
			} else {
				$msg = 0;
			}
		} else {
			$q = $this->db->query("SELECT * FROM erp_financev2.`gmd_finance_coa_general_ledger_detail` a WHERE a.`no_trans` = $kat_gl_lama->id_gl")->result();
			foreach ($q as $row) {
				$no_trans = $row->no_trans;
				$id_biaya = $row->id_biaya;
				$card_id = $row->card_id;
				$tanggal = $row->tanggal;
				$this->db->where('no_trans', $no_trans);
				$this->db->where('id_biaya', $id_biaya);
				$this->db->delete('finance_coa_general_ledger_detail');
				$this->m_global->update_jurnal_bulanan($id_biaya, $card_id, $tanggal, $branch, $area);
				$this->m_global->update_jurnal_harian($id_biaya, $card_id, $tanggal, $branch, $area);
			}
			$this->db->where('no_trans', $kat_gl_lama->id_gl);
			$this->db->delete('finance_coa_general_ledger');

			$supp = $this->db->query('SELECT nama FROM inventory_v2.`ms_perusahaan` WHERE id_perusahaan = "' . $this->input->post('supplier') . '"')->row();

			$res = $this->insert_gl($this->input->post('tanggal'), $this->input->post('kat_gl'), $this->input->post('jurnal'), $this->input->post('jumlah_harga'), null, $this->input->post('nama_barang'), $kat_gl_lama->nomor, $materai, $ppn, $pph, $kd_pajak, $no_referensi, $supp->nama, $ongkir, null);

			if (!empty($res)) {
				$data = array('id_gl' => $res);
				$this->db->where('id', $id);
				$this->db->update('finance_ap_invoice', $data);
				$msg = 1;
			} else {
				$msg = 0;
			}
		}
		$this->db->trans_complete();
		return $msg;
	}

	function update()
	{
		$this->db->trans_start();
		$jurnal_group = null;
		$id = $this->input->post('id');
		$branch = $this->m_global->cek_id_regional($this->session->userdata('scope_area'));
		$area = $this->m_global->cek_id_regional($this->session->userdata('scope_regional'));
		$no_referensi = str_replace(" ", "", $this->input->post('inv_supplier'));
		// $potongan = str_replace(",", "", $this->input->post('potongan'));
		$materai = str_replace(",", "", $this->input->post('materai'));
		$ppn = str_replace(",", "", $this->input->post('ppn'));
		$pph = str_replace(",", "", $this->input->post('pph'));
		$jumlah = str_replace(",", "", $this->input->post('jumlah'));
		$kd_pajak = $this->input->post('kd_pajak');
		$now = date('Y-m-d H:i:s');
		$ongkir = $diskon = 0;
		$kat_gl_lama = $this->db->query("SELECT id_gl,kat_gl,nomor FROM erp_financev2.`gmd_finance_ap_invoice` WHERE id=$id")->row();
		$data = array(
			'tanggal' => $this->input->post('tanggal'),
			'date_due' => $this->input->post('date_due'),
			'supplier' => $this->input->post('supplier'),
			// 'potongan' => $potongan,
			'materai' => $materai,
			'ket' => $this->input->post('keterangan'),
			'ppn' => $ppn,
			'pph' => $pph,
			'pajak' => $kd_pajak,
			'jumlah' => $jumlah,
			'no_referensi' => $no_referensi,
			'kat_gl' => $this->input->post('kat_gl'),
			'branch' => $this->cek_id_regional($this->session->userdata('scope_area')),
			'regional' => $this->cek_id_regional($this->session->userdata('scope_regional')),
			'update_at' => $now,
			'update_by' => $this->session->userdata('user_id')
		);
		$this->db->where('id', $id);
		$this->db->update('finance_ap_invoice', $data);
		$data = array('status' => 9);
		$this->db->where('id_ap', $id);
		$this->db->update('finance_ap_invoice_detail', $data);
		$id_barang = $jumlah_barang = $satuan_barang = $jumlah_harga = null;
		if (isset($_POST['id_barang'])) {
			foreach ($_POST['id_barang'] as $k => $v) {
				if (!empty($_POST['id_barang'][$k])) {
					if ($_POST['id_barang'][$k] == 'x') {
						$ongkir = $ongkir + $_POST['harga_barang'][$k];
						$id_barang = $_POST['id_barang'][$k];
						$jumlah_barang = $_POST['jumlah_barang'][$k];
						$satuan_barang = $_POST['satuan_barang'][$k];
						$harga_barang = str_replace(",", "", $_POST['harga_barang'][$k]);
						$jumlah_harga = $_POST['harga_barang'][$k];
						$jurnal = $_POST['jurnal'][$k];
						$id_penerimaan = $_POST['id_penerimaan'][$k];
						$id_pembelian = $_POST['id_pembelian'][$k];
						$data = array(
							'id_ap' => $id,
							'id_coa' => $jurnal,
							'id_barang' => $id_barang,
							'jumlah' => $jumlah_barang,
							'satuan' => $satuan_barang,
							'harga' => $harga_barang,
							'jumlah_harga' => $jumlah_harga,
							'id_pembelian' => $id_pembelian,
							'id_penerimaan' => $id_penerimaan
						);
						$this->db->insert('finance_ap_invoice_detail', $data);
					} else if ($_POST['id_barang'][$k] == 'xx') {
						$diskon = $diskon + $_POST['harga_barang'][$k];
						$id_barang = $_POST['id_barang'][$k];
						$jumlah_barang = $_POST['jumlah_barang'][$k];
						$satuan_barang = $_POST['satuan_barang'][$k];
						$harga_barang = str_replace(",", "", $_POST['harga_barang'][$k]);
						$jumlah_harga = $_POST['harga_barang'][$k];
						$jurnal = $_POST['jurnal'][$k];
						$id_penerimaan = $_POST['id_penerimaan'][$k];
						$id_pembelian = $_POST['id_pembelian'][$k];
						$data = array(
							'id_ap' => $id,
							'id_coa' => $jurnal,
							'id_barang' => $id_barang,
							'jumlah' => $jumlah_barang,
							'satuan' => $satuan_barang,
							'harga' => $harga_barang,
							'jumlah_harga' => $jumlah_harga,
							'id_pembelian' => $id_pembelian,
							'id_penerimaan' => $id_penerimaan
						);
						$this->db->insert('finance_ap_invoice_detail', $data);
					} else {
						$id_barang = $_POST['id_barang'][$k];
						$jumlah_barang = $_POST['jumlah_barang'][$k];
						$satuan_barang = $_POST['satuan_barang'][$k];
						$harga_barang = str_replace(",", "", $_POST['harga_barang'][$k]);
						$jumlah_harga = $_POST['jumlah_harga'][$k];
						$jurnal = $_POST['jurnal'][$k];
						$id_penerimaan = $_POST['id_penerimaan'][$k];
						$id_pembelian = $_POST['id_pembelian'][$k];
						$data = array(
							'id_ap' => $id,
							'id_coa' => $jurnal,
							'id_barang' => $id_barang,
							'jumlah' => $jumlah_barang,
							'satuan' => $satuan_barang,
							'harga' => $harga_barang,
							'jumlah_harga' => $jumlah_harga,
							'id_pembelian' => $id_pembelian,
							'id_penerimaan' => $id_penerimaan
						);
						$this->db->insert('finance_ap_invoice_detail', $data);
					}
				}
			}
			$data = array('ongkir' => $ongkir, 'diskon' => $diskon);
			$this->db->where('id', $id);
			$this->db->update('finance_ap_invoice', $data);
			//insert delete jurnal
			if ($kat_gl_lama->kat_gl == $this->input->post('kat_gl')) {
				$jurnal_group = $this->db->query("SELECT jurnal_group FROM erp_financev2.`gmd_finance_coa_general_ledger` WHERE no_trans = '" . $kat_gl_lama->id_gl . "'")->row();
				$q = $this->db->query("SELECT * FROM erp_financev2.`gmd_finance_coa_general_ledger_detail` a WHERE a.`no_trans` = $kat_gl_lama->id_gl")->result();
				foreach ($q as $row) {
					$no_trans = $row->no_trans;
					$id_biaya = $row->id_biaya;
					$card_id = $row->card_id;
					$tanggal = $row->tanggalnya;
					$this->db->where('no_trans', $no_trans);
					$this->db->where('id_biaya', $id_biaya);
					$this->db->delete('finance_coa_general_ledger_detail');
					$this->m_global->update_jurnal_bulanan($id_biaya, $card_id, $tanggal, $branch, $area);
					$this->m_global->update_jurnal_harian($id_biaya, $card_id, $tanggal, $branch, $area);
				}
				$this->db->where('no_trans', $kat_gl_lama->id_gl);
				$this->db->delete('finance_coa_general_ledger');

				$supp = $this->db->query('SELECT nama FROM inventory_v2.`ms_perusahaan` WHERE id_perusahaan = "' . $this->input->post('supplier') . '"')->row();

				$res = $this->insert_gl($this->input->post('tanggal'), $this->input->post('kat_gl'), $this->input->post('jurnal'), $this->input->post('jumlah_harga'), $this->input->post('id_barang'), null, $kat_gl_lama->nomor, $materai, $ppn, $pph, $kd_pajak, $no_referensi, $supp->nama, null, $jurnal_group->jurnal_group);

				if (!empty($res)) {
					$data = array('id_gl' => $res);
					$this->db->where('id', $id);
					$this->db->update('finance_ap_invoice', $data);
					$msg = 1;
				} else {
					$msg = 0;
				}
			} else {
				$q = $this->db->query("SELECT * FROM erp_financev2.`gmd_finance_coa_general_ledger_detail` a WHERE a.`no_trans` = $kat_gl_lama->id_gl")->result();
				foreach ($q as $row) {
					$no_trans = $row->no_trans;
					$id_biaya = $row->id_biaya;
					$card_id = $row->card_id;
					$tanggal = $row->tanggalnya;
					$this->db->where('no_trans', $no_trans);
					$this->db->where('id_biaya', $id_biaya);
					$this->db->delete('finance_coa_general_ledger_detail');
					$this->m_global->update_jurnal_bulanan($id_biaya, $card_id, $tanggal, $branch, $area);
					$this->m_global->update_jurnal_harian($id_biaya, $card_id, $tanggal, $branch, $area);
				}
				$this->db->where('no_trans', $kat_gl_lama->id_gl);
				$this->db->delete('finance_coa_general_ledger');

				$supp = $this->db->query('SELECT nama FROM inventory_v2.`ms_perusahaan` WHERE id_perusahaan = "' . $this->input->post('supplier') . '"')->row();

				$res = $this->insert_gl($this->input->post('tanggal'), $this->input->post('kat_gl'), $this->input->post('jurnal'), $this->input->post('jumlah_harga'),  $this->input->post('id_barang'), null, $kat_gl_lama->nomor, $materai, $ppn, $pph, $kd_pajak, $no_referensi, $supp->nama, null, null);
				if (!empty($res)) {
					$data = array('id_gl' => $res);
					$this->db->where('id', $id);
					$this->db->update('finance_ap_invoice', $data);
					$msg = 1;
				} else {
					$msg = 0;
				}
			}
		}
		$msg = 1;
		$this->db->trans_complete();
		return $msg;
	}

	function create_queue_id_gl()
	{
		$invoice_cek = 0;
		$userid = str_pad($this->session->userdata('userid'), 6, '0', STR_PAD_LEFT);
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
		$kode_ju = $this->m_global->finance_master_kat_gl_name($id);
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

	function insert_gl($tanggal, $kat_gl, $id_jurnal, $jumlah_harga, $id_barang, $nama_barang, $no_ref, $materai, $ppn, $pph, $kd_pajak, $deskripsi, $supp, $ongkir, $no_gl)
	{
		$msg = $total = $coa = $card = 0;
		$normal = 1;
		$divisi = 11;
		$barang = null;
		$this->db->trans_start();
		if ($this->m_global->closing_date_accounting($tanggal) == true) {
			$this->db->select('*');
			$this->db->from('finance_coa_general_ledger_detail a');
			$this->db->join('finance_coa_general_ledger b', 'a.no_trans = b.no_trans', 'left');
			$this->db->where('b.no_referensi', $no_ref);
			$q = $this->db->get();
			if ($q->num_rows() > 0) {
				$msg = 2;
			} else {
				if (empty($no_gl)) {
					$create_gl_id = $this->create_gl_id($kat_gl);
				} else {
					$create_gl_id = $no_gl;
				}
				$create_queue_id = $this->create_queue_id_gl();
				$branch = $this->m_global->cek_id_regional($this->session->userdata('scope_area'));
				$area = $this->m_global->cek_id_regional($this->session->userdata('scope_regional'));
				$data = array(
					'id' => $this->create_id(),
					'no_trans' => $create_queue_id,
					'kat_gl' => $kat_gl,
					'jurnal_group' => $create_gl_id,
					'deskripsi' => 'Penerimaan Invoice Supplier ' . $supp . ' Nomor ' . $deskripsi,
					'tanggal' => $tanggal,
					'no_referensi' => $no_ref,
					'branch' => $branch,
					'area' => $area,
				);
				$result = $this->db->insert('finance_coa_general_ledger', $data);
				if ($result == true) {
					foreach ($id_jurnal as $k => $v) {
						$normal = 1;
						$q = $this->db->query("SELECT * FROM erp_financev2.`gmd_finance_coa_automatic` a WHERE a.`id` = $id_jurnal[$k]")->row();
						if (empty($nama_barang)) {
							if ($id_barang[$k] == 'x') {
								$barang = 'Biaya Ongkir';
							} else if ($id_barang[$k] == 'xx') {
								$barang = 'Diskon';
							} else {
								$barang = $this->db->query("SELECT a.`nama_barang` FROM inventory_v2.`ms_header_barang` a WHERE a.`id_header` = $id_barang[$k]")->row();
								$barang = $barang->nama_barang;
							}
						}
						$deb = str_replace(",", "", $jumlah_harga[$k]);
						$deb = $deb * $normal;
						$total = $total + $deb;
						$data = array(
							'no_trans' => $create_queue_id,
							'id_biaya' => $q->coa_d,
							'card_id' => $q->card_d,
							'tanggal' => $tanggal,
							'divisi' => $divisi,
							'debet' => $deb,
							'kredit' => 0,
							'ket' => $barang,
							'branch' => $branch,
							'area' => $area,
						);
						$this->db->insert('finance_coa_general_ledger_detail', $data);
						$this->m_global->update_jurnal_bulanan($q->coa_d, $q->card_d, $tanggal, $branch, $area);
						$this->m_global->update_jurnal_harian($q->coa_d, $q->card_d, $tanggal, $branch, $area);
					}

					if (!empty($ongkir)) {
						$q = $this->db->query("SELECT * FROM erp_financev2.`gmd_finance_coa_automatic` a WHERE a.`id` =6")->row();
						$deb = str_replace(",", "", $ongkir);
						$total = $total + $ongkir;
						$data = array(
							'no_trans' => $create_queue_id,
							'id_biaya' => $q->coa_d,
							'card_id' => $q->card_d,
							'tanggal' => $tanggal,
							'divisi' => $divisi,
							'debet' => $deb,
							'kredit' => 0,
							'ket' => 'Penerimaan Invoice Supplier ' . $supp . ' Nomor ' . $deskripsi,
							'branch' => $branch,
							'area' => $area,
						);
						$this->db->insert('finance_coa_general_ledger_detail', $data);
						$this->m_global->update_jurnal_bulanan($q->coa_d, $q->card_d, $tanggal, $branch, $area);
						$this->m_global->update_jurnal_harian($q->coa_d, $q->card_d, $tanggal, $branch, $area);
					}

					if (!empty($ppn)) {
						$coa = '115120';
						$card = '53';
						$deb = str_replace(",", "", $ppn);
						$total = $total + $ppn;
						$data = array(
							'no_trans' => $create_queue_id,
							'id_biaya' => $coa,
							'card_id' => $card,
							'tanggal' => $tanggal,
							'divisi' => $divisi,
							'debet' => $deb,
							'kredit' => 0,
							'ket' => 'Penerimaan Invoice Supplier ' . $supp . ' Nomor ' . $deskripsi,
							'branch' => $branch,
							'area' => $area,
						);
						$this->db->insert('finance_coa_general_ledger_detail', $data);
						$this->m_global->update_jurnal_bulanan($coa, $card, $tanggal, $branch, $area);
						$this->m_global->update_jurnal_harian($coa, $card, $tanggal, $branch, $area);
					}
					if (!empty($materai)) {
						$coa = '623000';
						$card = '119';
						$deb = str_replace(",", "", $materai);
						$total = $total + $materai;
						$data = array(
							'no_trans' => $create_queue_id,
							'id_biaya' => $coa,
							'card_id' => $card,
							'tanggal' => $tanggal,
							'divisi' => $divisi,
							'debet' => $deb,
							'kredit' => 0,
							'ket' => 'Penerimaan Invoice Supplier ' . $supp . ' Nomor ' . $deskripsi,
							'branch' => $branch,
							'area' => $area,
						);
						$this->db->insert('finance_coa_general_ledger_detail', $data);
						$this->m_global->update_jurnal_bulanan($coa, $card, $tanggal, $branch, $area);
						$this->m_global->update_jurnal_harian($coa, $card, $tanggal, $branch, $area);
					}
					if (!empty($kd_pajak)) {
						if ($kd_pajak == 1) {
							$coa = '213110';
							$card = '70';
							$kre = str_replace(",", "", $pph);
							$total = $total - $pph;
							$data = array(
								'no_trans' => $create_queue_id,
								'id_biaya' => $coa,
								'card_id' => $card,
								'tanggal' => $tanggal,
								'divisi' => $divisi,
								'debet' => 0,
								'kredit' => $kre,
								'ket' => 'Penerimaan Invoice Supplier ' . $supp . ' Nomor ' . $deskripsi,
								'branch' => $branch,
								'area' => $area,
							);
							$this->db->insert('finance_coa_general_ledger_detail', $data);
							$this->m_global->update_jurnal_bulanan($coa, $card, $tanggal, $branch, $area);
							$this->m_global->update_jurnal_harian($coa, $card, $tanggal, $branch, $area);
						} else {
							$coa = '213110';
							$card = '73';
							$kre = str_replace(",", "", $pph);
							$total = $total - $pph;
							$data = array(
								'no_trans' => $create_queue_id,
								'id_biaya' => $coa,
								'card_id' => $card,
								'tanggal' => $tanggal,
								'divisi' => $divisi,
								'debet' => 0,
								'kredit' => $kre,
								'ket' => 'Penerimaan Invoice Supplier ' . $supp . ' Nomor ' . $deskripsi,
								'branch' => $branch,
								'area' => $area,
							);
							$this->db->insert('finance_coa_general_ledger_detail', $data);
							$this->m_global->update_jurnal_bulanan($coa, $card, $tanggal, $branch, $area);
							$this->m_global->update_jurnal_harian($coa, $card, $tanggal, $branch, $area);
						}
					}
					//kredit
					//card hutang pada vendor
					$coa = '211000';
					$card = '190';
					$data = array(
						'no_trans' => $create_queue_id,
						'id_biaya' => $coa,
						'card_id' => $card,
						'tanggal' => $tanggal,
						'divisi' => $divisi,
						'debet' => 0,
						'kredit' => $total,
						'ket' => 'Penerimaan Invoice Supplier ' . $supp . ' Nomor ' . $deskripsi,
						'branch' => $branch,
						'area' => $area,
					);
					$this->db->insert('finance_coa_general_ledger_detail', $data);
					$this->m_global->update_jurnal_bulanan($coa, $card, $tanggal, $branch, $area);
					$this->m_global->update_jurnal_harian($coa, $card, $tanggal, $branch, $area);
				}
				$msg = $create_queue_id;
			}
		}
		$this->db->trans_complete();
		return $msg;
	}

	function select()
	{
		$id = $this->input->post('id');
		$query = $this->db->query("SELECT a.flag FROM erp_financev2.`gmd_finance_ap_invoice` a WHERE a.`id`=$id AND a.`status`!=9")->row();
		$no = 0;
		$id_pembelian = $id_penerimaan = $data = $data2 = null;
		if (!empty($query)) {
			if ($query->flag == 1) {
				$q = $this->db->query("SELECT
		a.id AS id,a.`nomor`,a.`tanggal`,a.`date_due`,a.`supplier`,d.`nama`,a.`no_referensi`,
		a.`potongan`,a.`materai`,a.`ppn`,a.`pph`,a.`jumlah`,a.`lain2`,a.`pajak`,
		b.`id_penerimaan`,b.`id_pembelian`,b.`id_barang`,c.`nama_barang`,b.`jumlah` AS jml_barang,b.`satuan`,b.`jumlah_harga`,a.`kat_gl`,a.`ket`
	  FROM
		erp_financev2.`gmd_finance_ap_invoice` a
		INNER JOIN erp_financev2.`gmd_finance_ap_invoice_detail` b
		  ON a.`id` = b.`id_ap`
		INNER JOIN inventory_v2.`ms_header_barang` c ON c.`id_header`=b.`id_barang`
		INNER JOIN inventory_v2.`ms_perusahaan` d ON a.`supplier`=d.`id_perusahaan`
		WHERE a.`status`=1 AND a.`lunas` =0 AND a.`id` = $id GROUP BY a.`id`");

				$qr = $this->db->query("SELECT a.*,b.*,c.`nomor` AS nomor_po,CASE
		WHEN b.`id_barang` ='x' THEN 'Biaya Ongkir'
		WHEN b.`id_barang`='xx' THEN 'Diskon'
		ELSE e.`nama_barang`
		END AS nama_barang FROM erp_financev2.`gmd_finance_ap_invoice` a
		JOIN erp_financev2.`gmd_finance_ap_invoice_detail` b
		  ON a.`id` = b.`id_ap`
		  LEFT JOIN `inventory_v2`.`tr_h_pembelian` c
		  ON c.`id_header`=b.`id_pembelian`
		  LEFT JOIN  `inventory_v2`.`tr_h_penerimaan` d
		  ON d.`id_header`=b.`id_penerimaan`
		  LEFT JOIN inventory_v2.`ms_header_barang` e
		  ON b.`id_barang`=e.`id_header` WHERE b.`status`=1 AND a.`status`=1 AND a.`id`=$id ORDER BY b.`id`,b.`id_penerimaan`,b.`id_pembelian`")->result();

				if (!empty($qr)) {
					foreach ($qr as $row) {
						if ($id_pembelian != $row->id_pembelian || $id_penerimaan != $row->id_penerimaan) {
							if ($no > 0) {
								$data .= "</tbody></table>";
							}
							$data .= '
				<table class="edit_' . $row->id_penerimaan . '_' . $row->id_pembelian . '" border="1" cellpadding="0" cellspacing="0" width="100%" style="margin-top:5px;">
					<thead>
						<tr>';
							$no = 1;
						}
						if ($no == 1) {
							$data .= "<th valign='top' colspan='4' style='text-align:center'><strong>$row->nomor_po</strong></th>
					<th style='text-align:center' valign='top'><strong>Jumlah</strong></th>
					<th style='text-align:center' valign='top'><strong>Action</strong></th>
					<th style='text-align:center' valign='top' onclick='del_detail(" . $row->id_penerimaan . "," . $row->id_pembelian . ")'><strong>X</strong></th>
					</tr>
					</thead>
					<tbody>";
							$no = 2;
						}
						if ($row->id_barang == 'x') {
							$data .= "
				<tr>
				<td style='width:470px;padding-left:2px'>Biaya Ongkir</td>
				<td style='text-align:center;width:90px'></td>
				<td style='text-align:center;width:90px'></td>
				<input type='hidden' name='id_barang[]' value='x'>
				<input type='hidden' id='jumlah_x' name='jumlah_barang[]' value='1'>
				<input type='hidden' name='satuan_barang[]' value=''>
				<input type='hidden' id='total_x' name='jumlah_harga[]' value='" . ($row->jumlah * $row->harga) . "'>
				<input type='hidden' name='id_penerimaan[]' value='$row->id_penerimaan'>
				<input type='hidden' name='id_pembelian[]' value='$row->id_pembelian'>
				<td style='width:120px'><input class='form-control harga_barang text-right' id='x' type='text' name='harga_barang[]' value='" . number_format($row->harga, 0) . "' onclick='autonumber(this);' onkeyup='hitung(this);'></td>
				<td style='text-align:center;width:11%'><input class='form-control price total_harga' type='text' value='" . number_format((1 * $row->harga), 0) . "' readonly></td>
				<td style='vertical-align:middle;text-align:center;width:4%'><button type='button' class='button' onclick='del_per_detail(this)'> X </button></td>";
						} else if ($row->id_barang == 'xx') {
							$data .= "<tr><td style='width:470px;padding-left:2px'>Diskon</td>
				<td style='text-align:center;width:90px'></td>
				<td style='text-align:center;width:90px'></td>
				<input type='hidden' name='id_barang[]' value='xx'>
				<input type='hidden' id='jumlah_xx' name='jumlah_barang[]' value='1'>
				<input type='hidden' name='satuan_barang[]' value=''>
				<input type='hidden' id='total_xx' name='jumlah_harga[]' value='" . ($row->jumlah * $row->harga) . "'>
				<input type='hidden' name='id_penerimaan[]' value='$row->id_penerimaan'>
					<input type='hidden' name='id_pembelian[]' value='$row->id_pembelian'>
				<td style='width:120px'><input class='form-control harga_barang text-right' id='xx' type='text' name='harga_barang[]' value='" . number_format($row->harga, 0) . "' onclick='autonumber(this);' onkeyup='hitung(this);'></td>
				<td style='text-align:center;width:11%'><input class='form-control price total_harga' type='text' value='" . number_format((-1 * $row->harga), 0) . "' readonly></td>
				<td style='vertical-align:middle;text-align:center;width:4%'><button type='button' class='button' onclick='del_per_detail(this)'> X </button></td>";
						} else {
							$data .= "<tr>
				<input type='hidden' name='id_barang[]' value='$row->id_barang'>
				<td style='width:470px;padding-left:2px'>$row->nama_barang</td>
				<td style='text-align:center;width:11%'><input type='number' class='form-control jumlah_barang' name='jumlah_barang[]' value='$row->jumlah' min='0' max='$row->jumlah' onkeyup='hitung1(this);'></td>
				<td style='text-align:center;width:6.5%'>$row->satuan</td>
				<input type='hidden' name='satuan_barang[]' value='$row->satuan'>
				<input type='hidden' id='jumlah_$row->id_barang' name='jumlah_barang[]' value='$row->jumlah'>
				<input type='hidden' name='id_penerimaan[]' value='$row->id_penerimaan'>
				<input type='hidden' name='id_pembelian[]' value='$row->id_pembelian'>
				<input type='hidden' id='total_$row->id_barang' name='jumlah_harga[]' value='" . ($row->jumlah * $row->harga) . "'>
				<td style='width:120px'><input class='form-control harga_barang text-right' id='$row->id_barang' type='text' name='harga_barang[]' value='" . number_format($row->harga, 0) . "' onclick='autonumber(this);' onkeyup='hitung2(this);'></td>
				<td style='text-align:center;width:11%'><input class='form-control price total_harga' type='text' value='" . number_format(($row->jumlah * $row->harga), 0) . "' readonly></td>
				<td style='vertical-align:middle;text-align:center;width:4%'><button type='button' class='button' onclick='del_per_detail(this)'> X </button></td>";
						}
						if ($id_pembelian != $row->id_pembelian || $id_penerimaan != $row->id_penerimaan) {
							$qq = $this->db->query("SELECT *,SUM(hitung) as total FROM (SELECT b.`id_pembelian`,b.`id_penerimaan`,1 AS hitung FROM erp_financev2.`gmd_finance_ap_invoice` a
					JOIN erp_financev2.`gmd_finance_ap_invoice_detail` b
					ON a.`id` = b.`id_ap`
					LEFT JOIN `inventory_v2`.`tr_h_pembelian` c
					ON c.`id_header`=b.`id_pembelian`
					LEFT JOIN  `inventory_v2`.`tr_h_penerimaan` d
					ON d.`id_header`=b.`id_penerimaan` WHERE b.`status`=1 AND a.`status`=1 AND a.`id`=$id AND b.`id_penerimaan`=$row->id_penerimaan AND b.`id_pembelian`=$row->id_pembelian) z
					GROUP BY z.`id_pembelian`,z.`id_penerimaan`")->row();
							$data .= "<td style='vertical-align:middle;text-align:center;width:4%' rowspan='$qq->total'><button type='button' class='button' onclick='del_detail_edit(" . $row->id_penerimaan . "," . $row->id_pembelian . ")'> X </button></td>";
						}
						$id_pembelian =  $row->id_pembelian;
						$id_penerimaan = $row->id_penerimaan;
					}

					$data2 = array('flag' => $query->flag, 'res' => $q->result(), 'det' => $data);
					return $data2;
				} else {
					$msg = 'Data tidak ditemukan';
					return $msg;
				}
			} else {
				$no = 0;
				$query2 = $this->db->query("SELECT *,FORMAT(a.materai,0) AS bea_materai,FORMAT(a.ongkir,0) AS bea_ongkir FROM erp_financev2.`gmd_finance_ap_invoice` a LEFT JOIN erp_financev2.`gmd_finance_ap_invoice_manual` b ON a.`id`=b.`id_ap` INNER JOIN inventory_v2.`ms_perusahaan` d ON a.`supplier`=d.`id_perusahaan` WHERE a.`id`=$id AND a.`status`=1 AND b.`status`!=9 AND a.`lunas`=0");
				if (!empty($query2->result())) {
					$data = '';
					foreach ($query2->result() as $row) {
						$no++;
						$data .= '
						<div class="row">
						<div class="col-lg-1">
							<label>No</label>
							<input class="form-control no_urut" type="text" value="' . $no . '" disabled>
						</div>
					<div class="col-lg-2">
						<label>Jurnal</label>
						<select class="form-control jurnal" name="jurnal[]">';
						$jurnal = $this->finance_jurnal()->result();
						foreach ($jurnal as $low) {
							if ($low->id == $row->id_coa) {
								$data .= '<option selected value="' . $low->id . '">' . $low->nama . '</option>';
							} else {
								$data .= '<option value="' . $low->id . '">' . $low->nama . '</option>';
							}
						}
						$data .= '</select></div>
						<div class="col-lg-3">
						<label>Nama Barang</label>
						<input class="form-control nama_barang" type="text" name="nama_barang[]" onchange="count_all2()" value="' . $row->nama_barang . '">
					</div>
					<div class="col-lg-1">
						<label>QTY</label>
						<input class="form-control jumlah_barang2" type="text" name="qty[]" onkeyup="hitung4(this)" onblur="hitung4(this)" value="' . $row->jumlah . '">
					</div>
					<div class=" col-lg-1">
						<label>Satuan</label>
						<input class="form-control" type="text" name="satuan[]" value="' . $row->satuan . '">
					</div>
					<div class="col-lg-1">
						<label>Harga</label>
						<input class="form-control harga_brg" type="text" name="harga[]" style="text-align:right" onkeyup="hitung3(this)" onblur="hitung3(this)" value="' . $row->harga . '">
					</div>
					<div class="col-lg-2">
						<label>Jumlah</label>
						<input class="form-control total_harga2" type="text" name="jumlah_harga[]" style="text-align:right" readonly value="' . number_format($row->jumlah_harga, 0) . '">
					</div>
					<div class="col-lg-1" style="display: grid;">
					<label>Action</label>
						<a class="del_detail2" onclick="del_detail2(this);"><i class="btn btn-danger icon-minus-circle2" title="delete" style="color:white;padding-top: 7px;padding-bottom: 7px;"></i></a>
					</div>
				</div>';
					}
					$data2 = array('flag' => $query->flag, 'res' => $query2->row(), 'det' => $data);
					return $data2;
				} else {
					$msg = 'Data tidak ditemukan';
					return $msg;
				}
			}
		} else {
			$msg = 'Data tidak ditemukan';
			return $msg;
		}
	}



	function delete($id)
	{
		$this->db->trans_start();
		$branch = $this->m_global->cek_id_regional($this->session->userdata('scope_area'));
		$area = $this->m_global->cek_id_regional($this->session->userdata('scope_regional'));
		$data = array('status' => 9);
		$this->db->where('id', $id);
		$result = $this->db->update('finance_ap_invoice', $data);
		if ($result == true) {
			$query = $this->db->query("SELECT * FROM erp_financev2.`gmd_finance_ap_invoice` WHERE id=$id")->row();
			$this->db->select('*');
			$this->db->where('a.`no_trans', $query->id_gl);
			$this->db->from('finance_coa_general_ledger a');
			$this->db->join('finance_coa_general_ledger_detail b', 'a.no_trans=b.no_trans', 'left');
			$q = $this->db->get()->result();
			$this->db->where('no_trans', $query->id_gl);
			$this->db->delete('finance_coa_general_ledger');
			foreach ($q as $row) {
				$no_trans = $row->no_trans;
				$id_biaya = $row->id_biaya;
				$card_id = $row->card_id;
				$tanggal = $row->tanggal;
				$this->db->where('no_trans', $no_trans);
				$this->db->where('id_biaya', $id_biaya);
				$this->db->where('card_id', $card_id);
				$this->db->delete('finance_coa_general_ledger_detail');
				$this->m_global->update_jurnal_bulanan($id_biaya, $card_id, $tanggal, $branch, $area);
				$this->m_global->update_jurnal_harian($id_biaya, $card_id, $tanggal, $branch, $area);
			}
			$msg = 1;
		} else {
			$msg = 0;
		}
		$this->db->trans_complete();
		return $msg;
	}

	function select_data_detail_invoice()
	{
		$data = '';

		$this->db->select("a.*", false);
		$this->db->from('finance_ap_invoice_detail AS a');
		$this->db->where('a.invoice_id', $this->input->post('id'));
		$this->db->order_by('a.deskripsi', 'asc');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $k => $r) {
				$data .= '<tr class="remove">';
				$data .= '<td style="vertical-align:middle;"><input class="form-control" type="text" style="width:300px;" readonly="readonly" name="tambah_description[]" value="' . $r['deskripsi'] . '" /></td>';
				$data .= '<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:200px;" readonly="readonly" name="tambah_jumlah[]" value="' . number_format($r['harga'], 0) . '" /></td>';
				$data .= '<td style="vertical-align:middle;"><button type="button" class="button">X</button></td>';
				$data .= '</tr>';
			}
		}
		$q->free_result();
		return $data;
	}

	function finance_bank()
	{
		$this->db->select('*');
		$this->db->from('finance_master_kat_gl');
		$q = $this->db->get();
		return $q;
	}

	function finance_jurnal()
	{
		$this->db->select('*');
		$this->db->from('finance_coa_automatic');
		$this->db->where('coa_k', '211000');
		$q = $this->db->get();
		return $q;
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

	function select_autocomplite()
	{
		if ($this->input->post('transaksi') == '1') {
			$this->db->select("a.id, a.no_invoice, concat('<div>No Invoice: <b>',a.no_invoice,'</b>
			, Inv Date: <b>',date_format(a.date_invoice, '%d-%m-%Y'),'</b>
			, Due Date: <b>',date_format(a.date_due, '%d-%m-%Y'),'</b>
			<br> Service ID: <b>',a.service_id,'</b>
			, Cust. ID: <b>',b.customer_id,'</b>
			, Customer: <b>',b.nama,'</b>
			<br> Jumlah Tagihan: <b>',CAST(format(a.jumlah,0) AS CHAR CHARACTER SET utf8),'</b></div>') as konten", false);
			$this->db->from("finance_invoice_customer a");
			$this->db->join('marketing_customer_service as b', 'a.service_id = b.service_id', 'left');
			$this->db->where("(a.no_invoice like '%" . $this->input->post('term') . "%'
		or b.nama like '%" . $this->input->post('term') . "%'
		OR a.no_invoice like '%" . $this->input->post('term') . "%'
		OR a.service_id like '%" . $this->input->post('term') . "%'
		OR b.customer_id like '%" . $this->input->post('term') . "%')", NULL, FALSE);
			$q = $this->db->get();
		}
		return $q->result();
	}

	function select_detail_ref($trx, $id_ref)
	{
		$data = '';
		if ($trx == '1') {
			$this->db->select("concat('(NO INVOICE): ',a.no_invoice,', (INV DATE): ',date_format(a.date_invoice, '%d-%m-%Y'),', (DUE DATE): ',date_format(a.date_due, '%d-%m-%Y'),'
(SERVICE ID): ',a.service_id,', (CUST. ID): ',b.customer_id,', (CUSTOMER): ',b.nama,'
(JUMLAH TAGIHAN): ',CAST(format(a.jumlah,0) AS CHAR CHARACTER SET utf8),'') as konten", false);
			$this->db->from("finance_invoice_customer a");
			$this->db->join('marketing_customer_service as b', 'a.service_id = b.service_id', 'left');
			$this->db->where("a.id", $id_ref);
			$q = $this->db->get();
			if ($q->num_rows() > 0) {
				foreach ($q->result_array() as $r) {
					$data = $r['konten'];
				}
			}
			$q->free_result();
		}
		return $data;
	}

	function get_supp($param = '')
	{
		$q = $this->db->query("SELECT * FROM inventory_v2.`ms_perusahaan` a WHERE a.`status`=1 AND a.`nama` LIKE '%$param%' ORDER BY a.`nama` ASC LIMIT 10")->result();
		$data = array();
		foreach ($q as $row) {
			$data[] = array(
				"id" => $row->id_perusahaan,
				"text" => $row->nama
			);
		}
		return json_encode($data);
	}
	function select_po()
	{
		$id = $this->input->post('id');
		$total = 0;
		$q = $this->db->query("SELECT *,(SUM(total)-diskon+ongkir) AS total_harga FROM (SELECT h.`tanggal` AS tanggal,h.id_perusahaan,0 AS id_penerimaan, d.id_header AS id_pembelian, NULL AS nomor,h.`nomor` AS nomor_po,d.id_barang, b.nama_barang, 
		SUM(d.qty) AS jumlah, IFNULL(t.jumlah_terima,0) AS jumlah_terima, u.nama_ukuran AS satuan, d.keterangan,d.`harga`,(SUM(d.`qty`)-COALESCE(t.jumlah_terima,0))*d.`harga` AS total,COALESCE(h.diskon-COALESCE(t.diskon,0),0) AS diskon,COALESCE(h.ongkir-COALESCE(t.ongkir,0),0) AS ongkir,cc.nama AS supplier
		FROM inventory_v2.tr_d_pembelian d 
		JOIN inventory_v2.tr_h_pembelian h ON d.id_header=h.id_header
		JOIN inventory_v2.ms_header_barang b ON d.id_barang=b.id_header
		JOIN inventory_v2.ms_ukuran u ON d.id_ukuran=u.id_ukuran
		JOIN inventory_v2.ms_perusahaan cc ON h.id_perusahaan=cc.id_perusahaan
		LEFT JOIN (
			SELECT d.id_pembelian, d.id_barang, SUM(d.jumlah) AS jumlah_terima,satuan,jumlah_harga,h.diskon,h.ongkir,d.status
				FROM erp_financev2.gmd_finance_ap_invoice_detail d 
				JOIN erp_financev2.gmd_finance_ap_invoice h ON d.id_ap=h.id
				WHERE d.id_penerimaan=0 AND d.status=1
				GROUP BY d.id_barang, d.id_pembelian
		) t ON d.id_header=t.id_pembelian AND d.id_barang=t.id_barang
		WHERE b.flag='J' AND d.`status`=1
		AND (d.qty - IFNULL(t.jumlah_terima,0)) > 0 AND h.id_perusahaan=$id
		GROUP BY d.id_barang,d.id_header) z
		GROUP BY z.id_penerimaan,z.id_pembelian
	UNION ALL
	SELECT *,(SUM(z.total)-z.diskon+z.ongkir) AS total_harga FROM (
	SELECT * FROM (
		SELECT h.`tanggal` AS tanggal,hp.id_perusahaan, d.id_header AS id_penerimaan,hp.`id_header` AS id_pembelian, h.`nomor`,hp.`nomor` AS nomor_po,d.id_barang, b.nama_barang, SUM(d.qty) AS jumlah, IFNULL(t.jumlah_terima,0) AS jumlah_terima, 
			u.nama_ukuran AS satuan, d.keterangan,d.`harga`,(SUM(d.`qty`)-COALESCE(t.jumlah_terima,0))*d.`harga` AS total,COALESCE(hp.diskon-COALESCE(t.diskon,0),0) AS diskon,COALESCE(hp.ongkir-COALESCE(t.ongkir,0),0) AS ongkir,cc.nama AS supplier
			FROM inventory_v2.tr_d_penerimaan d 
			JOIN inventory_v2.tr_h_penerimaan h ON d.id_header=h.id_header
			JOIN inventory_v2.ms_header_barang b ON d.id_barang=b.id_header
			JOIN inventory_v2.ms_ukuran u ON d.id_ukuran=u.id_ukuran
			JOIN inventory_v2.tr_h_pembelian hp ON h.id_pembelian=hp.id_header
			JOIN inventory_v2.ms_perusahaan cc ON hp.id_perusahaan=cc.id_perusahaan
			LEFT JOIN (
				SELECT d.id_penerimaan, d.id_barang, SUM(d.jumlah) AS jumlah_terima,satuan,jumlah_harga,h.diskon,h.ongkir,d.status
					FROM erp_financev2.gmd_finance_ap_invoice_detail d 
					JOIN erp_financev2.gmd_finance_ap_invoice h ON d.id_ap=h.id
					WHERE d.status=1
					GROUP BY d.id_barang, d.id_penerimaan
			) t ON d.id_header=t.id_penerimaan AND d.id_barang=t.id_barang
			GROUP BY d.id_barang,d.id_header
	) terima_barang
	WHERE (jumlah - jumlah_terima) > 0 AND id_perusahaan=$id )  z 
	GROUP BY z.id_penerimaan,z.id_pembelian
	
	ORDER BY tanggal DESC")->result();
		$data = null;
		$data .= '
<tbody>';
		foreach ($q as $row) {
			if (empty($row->id_penerimaan)) {
				$row->id_penerimaan = 0;
			}
			$data .= "<tr>
		<td style='text-align: center;width:60px;padding:0 20px'><input type='checkbox' class='check_po_" . $row->id_penerimaan . "_" . $row->id_pembelian . "' onclick='set_up(this,$id,$row->id_penerimaan,$row->id_pembelian);' name='po[]' value=" . $row->id_penerimaan . "," . $row->id_pembelian . "></td>
		<td style='text-align: center;width:230px;padding:0 20px'>$row->nomor</td>
		<td style='text-align: center;width:230px;padding:0 20px'>$row->nomor_po</td>
		<td style='text-align: center;width:340px;padding:0 20px'>$row->supplier</td>
		<td style='text-align: center;width:160px;padding:0 20px'>$row->tanggal</td>
		<td style='text-align: right;width:120px;padding:0 20px'>" . number_format($row->total_harga, 0) . "</td></tr>";
		}
		$data .= "</tbody>";
		$res = array();
		$res = array(
			'html' => $data
		);
		return $res;
	}

	function get_detail_barang()
	{
		$id_supp = $kondisi1 = $kondisi2 = $data = $option = $select = null;
		$id_supp = $this->input->post('id_supp');
		$kondisi1 = " AND d.id_header =" . $this->input->post('id_header');
		$kondisi2 = " AND d.id_header =" . $this->input->post('id_header');
		if (empty($this->input->post('id_header'))) {
			$kondisi1 = " AND d.id_header =" . $this->input->post('id_pembelian');
			$kondisi2 = " AND hp.id_header =" . $this->input->post('id_pembelian');
		}
		$q = $this->db->query("SELECT h.`tanggal` AS tanggal,h.id_perusahaan,0 AS id_penerimaan, d.id_header AS id_pembelian, NULL AS nomor,h.`nomor` AS nomor_po,d.id_barang, b.nama_barang, 
			SUM(d.qty) AS jumlah, IFNULL(t.jumlah_terima,0) AS jumlah_terima, u.nama_ukuran AS satuan, d.keterangan,d.`harga`,(SUM(d.`qty`)-COALESCE(t.jumlah_terima,0))*d.`harga` AS total,COALESCE(h.diskon-COALESCE(t.diskon,0),0) AS diskon,COALESCE(h.ongkir-COALESCE(t.ongkir,0),0) AS ongkir
			FROM inventory_v2.tr_d_pembelian d 
			JOIN inventory_v2.tr_h_pembelian h ON d.id_header=h.id_header
			JOIN inventory_v2.ms_header_barang b ON d.id_barang=b.id_header
			JOIN inventory_v2.ms_ukuran u ON d.id_ukuran=u.id_ukuran
			LEFT JOIN (
				SELECT d.id_pembelian, d.id_barang, SUM(d.jumlah) AS jumlah_terima,d.satuan,d.jumlah_harga,h.diskon,h.ongkir
					FROM erp_financev2.gmd_finance_ap_invoice_detail d 
					JOIN erp_financev2.gmd_finance_ap_invoice h ON d.id_ap=h.id
					WHERE d.id_penerimaan=0 AND d.status=1
					GROUP BY d.id_barang, d.id_pembelian
			) t ON d.id_header=t.id_pembelian AND d.id_barang=t.id_barang
			WHERE b.flag='J' AND d.`status`=1 AND h.id_perusahaan = $id_supp $kondisi1
			AND (d.qty - IFNULL(t.jumlah_terima,0)) > 0
			GROUP BY d.id_barang,d.id_header
		UNION ALL
		SELECT * FROM (
			SELECT h.`tanggal` AS tanggal,hp.id_perusahaan, d.id_header AS id_penerimaan,hp.`id_header` AS id_pembelian, h.`nomor`,hp.`nomor` AS nomor_po,d.id_barang, b.nama_barang, SUM(d.qty) AS jumlah, IFNULL(t.jumlah_terima,0) AS jumlah_terima, 
				u.nama_ukuran AS satuan, d.keterangan,d.`harga`,(SUM(d.`qty`)-COALESCE(t.jumlah_terima,0))*d.`harga` AS total,COALESCE(hp.diskon-COALESCE(t.diskon,0),0) AS diskon,COALESCE(hp.ongkir-COALESCE(t.ongkir,0),0) AS ongkir
				FROM inventory_v2.tr_d_penerimaan d 
				JOIN inventory_v2.tr_h_penerimaan h ON d.id_header=h.id_header
				JOIN inventory_v2.ms_header_barang b ON d.id_barang=b.id_header
				JOIN inventory_v2.ms_ukuran u ON d.id_ukuran=u.id_ukuran
				JOIN inventory_v2.tr_h_pembelian hp ON h.id_pembelian=hp.id_header
				LEFT JOIN (
					SELECT d.id_penerimaan, d.id_barang, SUM(d.jumlah) AS jumlah_terima,d.satuan,d.jumlah_harga,h.diskon,h.ongkir
						FROM erp_financev2.gmd_finance_ap_invoice_detail d 
						JOIN erp_financev2.gmd_finance_ap_invoice h ON d.id_ap=h.id
						WHERE d.status=1
						GROUP BY d.id_barang, d.id_penerimaan
				) t ON d.id_header=t.id_penerimaan AND d.id_barang=t.id_barang
				WHERE hp.id_perusahaan = $id_supp $kondisi2
				GROUP BY d.id_barang,d.id_header
		) terima_barang
		WHERE (jumlah - jumlah_terima) > 0
		
		ORDER BY tanggal DESC")->result();
		$option = $this->db->query("SELECT * FROM erp_financev2.gmd_finance_coa_automatic WHERE status=2")->result();
		foreach ($option as $row) {
			$select .= "<option value='" . $row->id . "'>" . $row->nama . "</option>";
		}
		$no = $ongkir =  $diskon = 0;
		$qn = $this->db->query("SELECT FOUND_ROWS() as total");
		$tot = $qn->row()->total;
		if (!empty($q)) {
			$data .= '
			<table class="' . $this->input->post('id_header') . '_' . $this->input->post('id_pembelian') . '" border="1" cellpadding="0" cellspacing="0" width="100%" style="margin-top:5px;">
				<thead>
					<tr>';
			foreach ($q as $row) {
				$no++;
				if ($no == 1) {
					$data .= "<th valign='top' colspan='5' style='text-align:center'><strong>$row->nomor_po</strong></th>
					<th style='text-align:center' valign='top'><strong>Jumlah</strong></th>
					<th style='text-align:center' valign='top'><strong>Action</strong></th>
					<th style='text-align:center' valign='top' onclick='del_detail(" . $this->input->post('id_header') . "," . $this->input->post('id_pembelian') . ")'><strong>X</strong></th>
					</tr>
					</thead>
					<tbody>";
				}
				$data .= "<tr>
				<td><select class='form-control' name='jurnal[]'>$select</select></td>
				<input type='hidden' name='id_barang[]' value='$row->id_barang'>
				<td style='width:470px;padding-left:2px'>$row->nama_barang</td>
				<td style='text-align:center;width:11%'><input type='number' class='form-control jumlah_barang' name='jumlah_barang[]' value='$row->jumlah' min='0' max='$row->jumlah' onkeyup='hitung1(this);'></td>
				<td style='text-align:center;width:6.5%'>$row->satuan'</td>
				<input type='hidden' name='satuan_barang[]' value='$row->satuan'>
				<input type='hidden' name='id_penerimaan[]' value='$row->id_penerimaan'>
				<input type='hidden' name='id_pembelian[]' value='$row->id_pembelian'>
				<input type='hidden' id='total_$row->id_barang' name='jumlah_harga[]' value='" . ($row->jumlah * $row->harga) . "'>
				<td style='width:120px'><input class='form-control harga_barang text-right' id='$row->id_barang' type='text' name='harga_barang[]' value='" . number_format($row->harga, 0) . "' onclick='autonumber(this);' onkeyup='hitung2(this);'></td>
				<td style='text-align:center;width:11%'><input class='form-control price total_harga' type='text' value='" . number_format(($row->jumlah * $row->harga), 0) . "' readonly></td>
				<td style='vertical-align:middle;text-align:center;width:4%'><button type='button' class='button' onclick='del_per_detail(this)'> X </button></td>";
				if ($no == 1) {
					if (!empty($row->diskon)) {
						$tot = $tot + 1;
						$diskon = $row->diskon;
					}
					if (!empty($row->ongkir)) {
						$tot = $tot + 1;
						$ongkir = $row->ongkir;
					}
					$data .= "<td style='vertical-align:middle;text-align:center;width:4%' rowspan='$tot'><button type='button' class='button' onclick='del_detail(" . $this->input->post('id_header') . "," . $this->input->post('id_pembelian') . ")'> X </button></td>";
				}
			}
			if (!empty($ongkir)) {
				$data .= "
				<tr>
				<td><select class='form-control' name='jurnal'>$select</select></td>
				<td style='width:470px;padding-left:2px'>Biaya Ongkir</td>
				<td style='text-align:center;width:90px'></td>
				<td style='text-align:center;width:90px'></td>
				<input type='hidden' name='id_barang[]' value='x'>
				<input type='hidden' class='jumlah_barang' name='jumlah_barang[]' value='1'>
				<input type='hidden' name='satuan_barang[]' value=''>
				<input type='hidden' id='total_x' name='jumlah_harga[]' value='" . ($row->jumlah * $ongkir) . "'>
				<input type='hidden' name='id_penerimaan[]' value='$row->id_penerimaan'>
				<input type='hidden' name='id_pembelian[]' value='$row->id_pembelian'>
				<td style='width:120px'><input class='form-control harga_barang text-right' id='x' type='text' name='harga_barang[]' value='" . number_format($ongkir, 0) . "' onclick='autonumber(this);' onkeyup='hitung(this);'></td>
				<td style='text-align:center;width:11%'><input class='form-control price total_harga' type='text' value='" . number_format((1 * $ongkir), 0) . "' readonly></td>
				<td style='vertical-align:middle;text-align:center;width:4%'><button type='button' class='button' onclick='del_per_detail(this)'> X </button></td>";
			}
			if (!empty($diskon)) {
				$data .= "
				<tr><td><select class='form-control' name='jurnal'>$select</select></td>
				<td style='width:470px;padding-left:2px'>Diskon</td>
			<td style='text-align:center;width:90px'></td>
			<td style='text-align:center;width:90px'></td>
			<input type='hidden' name='id_barang[]' value='xx'>
			<input type='hidden' class='jumlah_barang' name='jumlah_barang[]' value='1'>
			<input type='hidden' name='satuan_barang[]' value=''>
			<input type='hidden' id='total_xx' name='jumlah_harga[]' value='" . ($row->jumlah * $diskon) . "'>
			<input type='hidden' name='id_penerimaan[]' value='$row->id_penerimaan'>
				<input type='hidden' name='id_pembelian[]' value='$row->id_pembelian'>
			<td style='width:120px'><input class='form-control harga_barang text-right' id='xx' type='text' name='harga_barang[]' value='" . number_format($diskon, 0) . "' onclick='autonumber(this);' onkeyup='hitung(this);'></td>
			<td style='text-align:center;width:11%'><input class='form-control price total_harga' type='text' value='" . number_format((-1 * $diskon), 0) . "' readonly></td>
			<td style='vertical-align:middle;text-align:center;width:4%'><button type='button' class='button' onclick='del_per_detail(this)'> X </button></td>";
			}

			$data .= "</tbody></table>";
			$res = array('html' => $data);
			return json_encode($res);
		} else {
			$msg = 'Data tidak ditemukan';
			return $msg;
		}
	}

	function search_po()
	{
		$id = $this->input->post('id');
		$kode = $this->input->post('kode');
		$check = $this->input->post('check');
		$total = 0;
		$q = $this->db->query("SELECT *,(SUM(total)-diskon+ongkir) AS total_harga FROM (SELECT h.`tanggal` AS tanggal,h.id_perusahaan,0 AS id_penerimaan, d.id_header AS id_pembelian, NULL AS nomor,h.`nomor` AS nomor_po,d.id_barang, b.nama_barang, 
		SUM(d.qty) AS jumlah, IFNULL(t.jumlah_terima,0) AS jumlah_terima, u.nama_ukuran AS satuan, d.keterangan,d.`harga`,(SUM(d.`qty`)-COALESCE(t.jumlah_terima,0))*d.`harga` AS total,COALESCE(h.diskon-COALESCE(t.diskon,0),0) AS diskon,COALESCE(h.ongkir-COALESCE(t.ongkir,0),0) AS ongkir,cc.nama AS supplier
		FROM inventory_v2.tr_d_pembelian d 
		JOIN inventory_v2.tr_h_pembelian h ON d.id_header=h.id_header
		JOIN inventory_v2.ms_header_barang b ON d.id_barang=b.id_header
		JOIN inventory_v2.ms_ukuran u ON d.id_ukuran=u.id_ukuran
		JOIN inventory_v2.ms_perusahaan cc ON h.id_perusahaan=cc.id_perusahaan
		LEFT JOIN (
			SELECT d.id_pembelian, d.id_barang, SUM(d.jumlah) AS jumlah_terima,satuan,jumlah_harga,h.diskon,h.ongkir,d.status
				FROM erp_financev2.gmd_finance_ap_invoice_detail d 
				JOIN erp_financev2.gmd_finance_ap_invoice h ON d.id_ap=h.id
				WHERE d.id_penerimaan=0 AND d.status=1
				GROUP BY d.id_barang, d.id_pembelian
		) t ON d.id_header=t.id_pembelian AND d.id_barang=t.id_barang
		WHERE b.flag='J' AND d.`status`=1
		AND (d.qty - IFNULL(t.jumlah_terima,0)) > 0 AND h.id_perusahaan=$id
		GROUP BY d.id_barang,d.id_header) z
		WHERE (z.nomor LIKE '%$kode%' OR z.nomor_po LIKE '%$kode%')
		GROUP BY z.id_penerimaan,z.id_pembelian
	UNION ALL
	SELECT *,(SUM(z.total)-z.diskon+z.ongkir) AS total_harga FROM (
	SELECT * FROM (
		SELECT h.`tanggal` AS tanggal,hp.id_perusahaan, d.id_header AS id_penerimaan,hp.`id_header` AS id_pembelian, h.`nomor`,hp.`nomor` AS nomor_po,d.id_barang, b.nama_barang, SUM(d.qty) AS jumlah, IFNULL(t.jumlah_terima,0) AS jumlah_terima, 
			u.nama_ukuran AS satuan, d.keterangan,d.`harga`,(SUM(d.`qty`)-COALESCE(t.jumlah_terima,0))*d.`harga` AS total,COALESCE(hp.diskon-COALESCE(t.diskon,0),0) AS diskon,COALESCE(hp.ongkir-COALESCE(t.ongkir,0),0) AS ongkir,cc.nama AS supplier
			FROM inventory_v2.tr_d_penerimaan d 
			JOIN inventory_v2.tr_h_penerimaan h ON d.id_header=h.id_header
			JOIN inventory_v2.ms_header_barang b ON d.id_barang=b.id_header
			JOIN inventory_v2.ms_ukuran u ON d.id_ukuran=u.id_ukuran
			JOIN inventory_v2.tr_h_pembelian hp ON h.id_pembelian=hp.id_header
			JOIN inventory_v2.ms_perusahaan cc ON hp.id_perusahaan=cc.id_perusahaan
			LEFT JOIN (
				SELECT d.id_penerimaan, d.id_barang, SUM(d.jumlah) AS jumlah_terima,satuan,jumlah_harga,h.diskon,h.ongkir,d.status
					FROM erp_financev2.gmd_finance_ap_invoice_detail d 
					JOIN erp_financev2.gmd_finance_ap_invoice h ON d.id_ap=h.id
					WHERE d.status=1
					GROUP BY d.id_barang, d.id_penerimaan
			) t ON d.id_header=t.id_penerimaan AND d.id_barang=t.id_barang
			GROUP BY d.id_barang,d.id_header
	) terima_barang
	WHERE (jumlah - jumlah_terima) > 0 AND id_perusahaan=$id )  z 
	WHERE (z.nomor LIKE '%$kode%' OR z.nomor_po LIKE '%$kode%')
	GROUP BY z.id_penerimaan,z.id_pembelian
	
	ORDER BY tanggal DESC")->result();
		$data = null;
		$idid = null;
		foreach ($q as $row) {
			$checked = null;
			if (empty($row->id_header)) {
				$row->id_header = 0;
			}
			$idid = $row->id_header . ',' . $row->id_pembelian;
			for ($a = 0; $a < count($check); $a++) {
				if ($check[$a][0] == $idid) {
					$checked = 'checked="checked"';
				}
			}
			$total = $row->total - $row->diskon + $row->ongkir;
			$data .= "<div class='row'>
			<div class='col-md-1 text-center'><input type='checkbox' class='check_po_" . $row->id_header . "_" . $row->id_pembelian . "' onclick='set_up(this,$id,$row->id_header,$row->id_pembelian);' name='po' value=" . $row->id_header . "," . $row->id_pembelian . " " . $checked . "></div>
			<div class='col-md-2'>$row->nomor</div>
			<div class='col-md-3'>$row->nomor_po</div>
			<div class='col-md-2'>$row->supplier</div>
			<div class='col-md-2 text-center'>$row->tanggal</div>
			<div class='col-md-2 text-right' style='padding-right:15px'>" . number_format($total, 0) . "</div></div>";
		}
		$res = array();
		$res = array(
			'html' => $data
		);
		return $res;
	}

	function load_kd_jurnal()
	{
		$data = null;
		$this->db->select('*');
		$this->db->from('finance_coa_automatic');
		$this->db->where('coa_k', '211000');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data .= '<option value="' . $r['id'] . '">' . $r['nama'] . '</option>';
			}
		}
		return $data;
	}

	function view_data()
	{
		$id = $this->input->post('id');
		$table = $msg = $ss = null;
		$no = 0;
		$q = $this->db->query("SELECT a.`nomor` AS no_ap,h.`nama` AS kat_gl,d.`nama` AS nama_perusahaan,a.tanggal,a.date_due,a.no_referensi,a.potongan,a.materai,a.ppn,a.jumlah AS total_harga,a.bayar,a.ongkir,
		a.lain2,a.pph,a.pajak,c.`nama_barang`,b.`jumlah`,b.`satuan`,b.`harga`,b.`jumlah_harga`,g.`nama` AS nama_jurnal,e.`nomor` AS no_penerimaan,f.`nomor` AS no_pembelian,a.ket
		FROM erp_financev2.`gmd_finance_ap_invoice` a 
		LEFT JOIN erp_financev2.`gmd_finance_ap_invoice_detail` b ON a.id=b.`id_ap`
		LEFT JOIN inventory_v2.`ms_header_barang` c ON b.`id_barang`=c.`id_header`
		LEFT JOIN inventory_v2.`ms_perusahaan` d ON a.supplier=d.`id_perusahaan`
		LEFT JOIN inventory_v2.`tr_h_penerimaan` e ON b.`id_penerimaan`=e.`id_header`
		LEFT JOIN inventory_v2.`tr_h_pembelian` f ON b.`id_pembelian`=f.`id_header`
		LEFT JOIN erp_financev2.`gmd_finance_coa_automatic` g ON b.`id_coa`=g.`id`
		LEFT JOIN erp_financev2.`gmd_finance_master_kat_gl` h ON a.`kat_gl`=h.`id`
		WHERE a.status=1 AND b.`status`=1 AND a.flag=1 AND a.id=$id
		GROUP BY b.`id`
		UNION ALL
		SELECT a.`nomor` AS no_ap,e.`nama` AS kat_gl,c.`nama` AS nama_perusahaan,a.tanggal,a.date_due,a.no_referensi,a.potongan,a.materai,a.ppn,a.jumlah AS total_harga,a.bayar,a.ongkir,
		a.lain2,a.pph,a.pajak,b.`nama_barang`,b.`jumlah`,b.`satuan`,b.`harga`,b.`jumlah_harga`,d.`nama` AS nama_jurnal,'manual' AS no_penerimaan,'manual' AS no_pembelian,a.ket
		FROM erp_financev2.`gmd_finance_ap_invoice` a 
		LEFT JOIN erp_financev2.`gmd_finance_ap_invoice_manual` b ON a.id=b.`id_ap`
		LEFT JOIN inventory_v2.`ms_perusahaan` c ON a.supplier=c.`id_perusahaan`
		LEFT JOIN erp_financev2.`gmd_finance_coa_automatic` d ON b.`id_coa`=d.`id`
		LEFT JOIN erp_financev2.`gmd_finance_master_kat_gl` e ON a.`kat_gl`=e.`id`
		WHERE a.status=1 AND b.`status`=1 AND a.flag=2 AND a.id=$id
		GROUP BY b.`id`");
		$qr = $q->result();
		if (!empty($qr)) {
			$ss = $q->row();
			if ($ss->no_pembelian != 'manual') {
				$table .= '<thead>
		<th style="text-align:center;padding:5px 10px"><b>No</b></th>
		<th style="text-align:center"><b>No PO</b></th>
		<th style="text-align:center"><b>Jurnal</b></th>
		<th style="text-align:center"><b>Nama Barang</b></th>
		<th style="text-align:center"><b>Jumlah</b></th>
		<th style="text-align:center"><b>Harga</b></th>
		<th style="text-align:center"><b>Jumlah Harga</b></th>
		</thead><tbody>';
			} else {
				$table .= '<thead>
		<th style="text-align:center;padding:5px 10px"><b>No</b></th>
		<th style="text-align:center"><b>Jurnal</b></th>
		<th style="text-align:center"><b>Nama Barang</b></th>
		<th style="text-align:center"><b>Jumlah</b></th>
		<th style="text-align:center"><b>Harga</b></th>
		<th style="text-align:center"><b>Jumlah Harga</b></th>
		</thead><tbody>';
			}
			foreach ($qr as $row) {
				if ($row->no_pembelian != 'manual') {
					$no++;
					$table .= "<tr>
			<td style='text-align:center;padding:0px 5px;'>$no</td>
			<td style='text-align:center;padding:0px 5px;'>$row->no_pembelian</td>
			<td style='text-align:center;padding:0px 5px;'>$row->nama_jurnal</td>
			<td style='padding:0px 5px;'>$row->nama_barang</td>
			<td style='text-align:center;padding:0px 5px;'>$row->jumlah" . ' ' . "$row->satuan</td>
			<td style='text-align:right;padding:0px 5px;'>" . number_format($row->harga, 0) . "</td>
			<td style='text-align:right;padding:0px 5px;'>" . number_format($row->jumlah_harga, 0) . "</td>
			</tr>";
				} else {
					$no++;
					$table .= "<tr>
			<td style='text-align:center;padding:0px 5px;'>$no</td>
			<td style='text-align:center;padding:0px 5px;'>$row->nama_jurnal</td>
			<td style='padding:0px 5px;'>$row->nama_barang</td>
			<td style='text-align:center;padding:0px 5px;'>$row->jumlah" . ' ' . "$row->satuan</td>
			<td style='text-align:right;padding:0px 5px;'>" . number_format($row->harga, 0) . "</td>
			<td style='text-align:right;padding:0px 5px;'>" . number_format($row->jumlah_harga, 0) . "</td>
			</tr>";
				}
			}
			$table .= '</tbody>';
			$data2 = array('res' => $q->row(), 'det' => $table);
			return $data2;
		} else {
			$msg = 'Data tidak ditemukan';
			return $msg;
		}
	}
}
