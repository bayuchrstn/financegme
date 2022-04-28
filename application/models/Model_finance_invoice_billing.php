<?php
class Model_finance_invoice_billing extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function get_data_table()
	{
		$column_order = array(null, 'a.tanggal', 'a.no_invoice', 'a.jml_bayar', 'd.nama', 'd.idcust', 'c.nama', 'status_inv', 'project');
		$order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'a.tanggal';
		$order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'desc';

		$q = $this->db->query("SELECT SQL_CALC_FOUND_ROWS a.*, DATE_FORMAT(a.`tanggal`, '%d-%m-%Y') AS tanggalnya, b.`nomor`,
		d.`nama` AS nama_cust, d.`idcust`, c.`nama` AS nama_site,
		CASE WHEN b.`merge_type` IS NULL
		THEN 'STANDAR'
		ELSE 'GABUNGAN'
		END AS status_inv,
		CASE WHEN b.`flag` = 1 
		THEN 'LANGGANAN'
		WHEN b.`flag` = 2
		THEN 'ONE TIME'
		END AS project FROM erp_gmedia.`billing` a LEFT JOIN erp_gmedia.`arpost` b ON a.`id_arpost`=b.`id` LEFT JOIN erp_gmedia.`ms_site` c ON 
		b.`id_site` = c.`id` OR b.`to_site`=c.`id` LEFT JOIN erp_gmedia.`ms_customers` d ON c.`id_cust` = d.`id` 
		WHERE ( `b`.`nomor` LIKE '%" . $this->input->post('search_keyword') . "%' ESCAPE '!' OR `c`.`nama` LIKE '%" . $this->input->post('search_keyword') . "%' ESCAPE '!' OR `d`.`nama` LIKE '%" . $this->input->post('search_keyword') . "%' ESCAPE '!' OR `d`.`idcust` LIKE '%" . $this->input->post('search_keyword') . "%' ESCAPE '!' ) AND (a.`tanggal` between '" . $this->input->post('searchDateFirst') . "' and '" . $this->input->post('searchDateFinish') . "') AND a.`status`=1 GROUP BY a.`id` ORDER BY $order_name $order_dir ");
		if ($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
		$data = array();
		$no = $_POST['start'];
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$no++;
				$opsi = '<a href="#" onClick="update_data(\'' . $r['id'] . '\')"><i class="icon-menu7 position-left text-slate-800"></i></a>';
				$row  = array(
					$no . '.',
					$r['tanggalnya'],
					$r['no_invoice'],
					number_format($r['jml_bayar'], 0),
					$r['nama_cust'],
					$r['idcust'],
					$r['nama_site'],
					$r['status_inv'],
					$r['project'],
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

	//ini dikasih jurnal
	function insert()
	{
		$db = $this->load->database('erp_gmedia', TRUE);
		$blain2 = $this->input->post('blain2');
		$blain2 = str_replace(",", "", $blain2);
		$ppn = $this->input->post('ppn');
		$ppn = str_replace(",", "", $ppn);
		$plain2 = $this->input->post('plain2');
		$plain2 = str_replace(",", "", $plain2);
		$pph23 = $this->input->post('pph23');
		$pph23 = str_replace(",", "", $pph23);
		$card = $this->input->post('card');
		$jumlah = $this->input->post('debittot');
		$jumlah = str_replace(",", "", $jumlah);
		$id = 0;
		$db->trans_start();
		$cek = $this->cek_bayar_invoice($this->input->post('no_invoice'));
		if (!empty($cek)) {
			if (!empty($plain2)) {
				$jumlah = $jumlah - $plain2;
			}
			$time = date('Y-m-d H:i:s');
			$data = array(
				'id_arpost' => $this->input->post('no_invoice'),
				'tanggal' => $this->input->post('tanggal'),
				'jml_bayar' => $jumlah,
				'blain2' => $blain2,
				'ppn' => $ppn,
				'plain2' => $plain2,
				'pph23' => $pph23,
				'no_invoice' => $this->input->post('val_no_invoice'),
				'status' => 1,
				'insert_id' => $this->session->userdata('userid'),
				'insert_at' => $time
			);
			$result = $db->insert('billing', $data);
			$id = $db->insert_id();
			$db->trans_complete();
			if ($result == true) {
				$data['piutang'] = $db->query("SELECT ROUND(COALESCE(a.`jml_piutang`,0),0) AS jml_piutang FROM erp_gmedia.`arpost` a WHERE a.`id`=" . $this->input->post('no_invoice'))->row();
				$db->trans_start();
				if ($jumlah >= $data['piutang']->jml_piutang) {
					$data = array('jml_bayar' => $jumlah, 'lunas' => 1, 'date_paid' => $this->input->post('tanggal'));
					$db->where('id', $this->input->post('no_invoice'));
					$db->update('arpost', $data);
					$db->trans_complete();
					$db->trans_start();
					$return = $this->insert_gl($this->input->post('tanggal'), $this->input->post('guna'), $card, $this->input->post('debit'), $this->input->post('val_no_invoice'), $this->input->post('kat_gl'), $this->input->post('note'), $blain2, $plain2, $ppn, $pph23);
					if ($return != 2 || $return != 0) {
						$db->where('id', $id);
						$db->update('billing', array('id_gl' => $return));
					}
				} else {
					$q = $this->db->query("SELECT ROUND(COALESCE(b.`jml_piutang`,0),0) AS jml_piutang,SUM(a.`jml_bayar`) AS jml_bayar FROM erp_gmedia.`billing` a JOIN erp_gmedia.`arpost` b ON a.`id_arpost`=b.`id` WHERE b.`lunas`=0 AND b.`id` = '" . $this->input->post('no_invoice') . "'GROUP BY a.`id_arpost`")->row();
					if ($q->jml_piutang < ($q->jml_bayar + $jumlah)) {
						$return = $this->insert_gl_partial($this->input->post('tanggal'), $this->input->post('guna'), $card, $this->input->post('debit'), $this->input->post('val_no_invoice'), $this->input->post('kat_gl'), $this->input->post('note'), $blain2, $plain2, $ppn, $pph23);
						if ($return != 2 || $return != 0) {
							$db->trans_start();
							$db->where('id', $id);
							$db->update('billing', array('id_gl' => $return));
							$db->trans_complete();
							$db->trans_start();
							$data = array('jml_bayar' => $jumlah, 'date_paid' => $this->input->post('tanggal'));
							$db->where('id', $this->input->post('no_invoice'));
							$db->update('arpost', $data);
							$db->trans_complete();
						}
					} else {
						$data = array('jml_bayar' => $jumlah, 'lunas' => 1, 'date_paid' => $this->input->post('tanggal'));
						$db->where('id', $this->input->post('no_invoice'));
						$db->update('arpost', $data);
						$db->trans_complete();
						$db->trans_start();
						$return = $this->insert_gl_partial($this->input->post('tanggal'), $this->input->post('guna'), $card, $this->input->post('debit'), $this->input->post('val_no_invoice'), $this->input->post('kat_gl'), $this->input->post('note'), $blain2, $plain2, $ppn, $pph23);
						// $this->insert_gl_pembalik($this->input->post('kat_gl'), $this->input->post('tanggal'), $card, $this->input->post('val_no_invoice'), $q->jml_bayar);
						// if ($return != 2 || $return != 0) {
						$db->where('id', $id);
						$db->update('billing', array('id_gl' => $return));
					}
				}

				$msg = 1;
			} else {
				$msg = 0;
			}
		} else {
			$msg = 0;
		}
		$db->trans_complete();
		return $msg;
	}

	function update()
	{
		$msg = 0;
		$db = $this->load->database('erp_gmedia', TRUE);
		$blain2 = $this->input->post('blain2');
		$blain2 = str_replace(",", "", $blain2);
		$ppn = $this->input->post('ppn');
		$ppn = str_replace(",", "", $ppn);
		$plain2 = $this->input->post('plain2');
		$plain2 = str_replace(",", "", $plain2);
		$pph23 = $this->input->post('pph23');
		$pph23 = str_replace(",", "", $pph23);
		$id = $this->input->post('id');
		$q = $this->db->query("SELECT * FROM erp_gmedia.`billing`WHERE id=$id")->row();
		if ($q->id_arpost != $this->input->post('no_invoice')) {
			$data = array('jml_bayar' => 0, 'lunas' => 0, 'date_paid' => NULL);
			$db->where('id', $q->id_arpost);
			$db->update('arpost', $data);
		}
		$card = $this->input->post('card');
		$branch = $this->m_global->cek_id_regional($this->session->userdata('scope_area'));
		$area = $this->m_global->cek_id_regional($this->session->userdata('scope_regional'));
		$db->trans_start();
		$jumlah = str_replace(",", "", $this->input->post('debittot'));
		$jumlah = $jumlah - $plain2;
		$time = date('Y-m-d H:i:s');
		$data = array(
			'id_arpost' => $this->input->post('no_invoice'),
			'tanggal' => $this->input->post('tanggal'),
			'jml_bayar' => $jumlah,
			'blain2' => $blain2,
			'ppn' => $ppn,
			'plain2' => $plain2,
			'pph23' => $pph23,
			'no_invoice' => $this->input->post('val_no_invoice'),
			'status' => 1,
			'update_id' => $this->session->userdata('userid'),
			'update_at' => $time
		);
		$db->where('id', $id);
		$db->update('billing', $data);
		$db->trans_complete();
		$data['piutang'] = $db->query("SELECT a.`jml_piutang` FROM erp_gmedia.`arpost` a WHERE a.`id`=" . $this->input->post('no_invoice'))->row();
		$db->trans_start();
		if ($jumlah >= $data['piutang']->jml_piutang) {
			$data = array('jml_bayar' => $jumlah, 'lunas' => 1, 'date_paid' => $this->input->post('tanggal'));
		} else {
			$data = array('jml_bayar' => $jumlah, 'lunas' => 0, 'date_paid' => $this->input->post('tanggal'));
		}
		$db->where('id', $this->input->post('no_invoice'));
		$db->update('arpost', $data);
		$db->trans_complete();
		//delete gl lama
		$q = $db->query("SELECT *,b.`tanggal` AS tanggalnya FROM erp_gmedia.`billing` a JOIN erp_financev2.`gmd_finance_coa_general_ledger_detail` b ON a.`id_gl`=b.`no_trans` WHERE a.`id` = $id")->result();
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
		$this->db->where('no_trans', $no_trans);
		$this->db->delete('finance_coa_general_ledger');
		$db->trans_start();
		$data['piutang'] = $db->query("SELECT a.`jml_piutang` FROM erp_gmedia.`arpost` a WHERE a.`id`=" . $this->input->post('no_invoice'))->row();
		$db->trans_complete();
		$db->trans_start();
		if ($jumlah >= $data['piutang']->jml_piutang) {
			$data = array('jml_bayar' => $jumlah, 'lunas' => 1, 'date_paid' => $this->input->post('tanggal'));
			$db->where('id', $this->input->post('no_invoice'));
			$db->update('arpost', $data);
			$db->trans_complete();
			$db->trans_start();
			$return = $this->insert_gl($this->input->post('tanggal'), $this->input->post('guna'), $card, $this->input->post('debit'), $this->input->post('val_no_invoice'), $this->input->post('kat_gl'), $this->input->post('note'), $blain2, $plain2, $ppn, $pph23);
			if ($return != 2 || $return != 0) {
				$db->where('id', $id);
				$db->update('billing', array('id_gl' => $return));
			}
		} else {
			$q = $this->db->query("SELECT b.`jml_piutang`,SUM(a.`jml_bayar`) AS jml_bayar FROM erp_gmedia.`billing` a JOIN erp_gmedia.`arpost` b ON a.`id_arpost`=b.`id` WHERE b.`lunas`=0 AND b.`id` = '" . $this->input->post('no_invoice') . "'GROUP BY a.`id_arpost`")->row();
			if ($q->jml_piutang < ($q->jml_bayar + $jumlah)) {
				$return = $this->insert_gl_partial($this->input->post('tanggal'), $this->input->post('guna'), $card, $this->input->post('debit'), $this->input->post('val_no_invoice'), $this->input->post('kat_gl'), $this->input->post('note'), $blain2, $plain2, $ppn, $pph23);
				if ($return != 2 || $return != 0) {
					$db->where('id', $id);
					$db->update('billing', array('id_gl' => $return));
				}
			} else {
				$data = array('jml_bayar' => $jumlah, 'lunas' => 1, 'date_paid' => $this->input->post('tanggal'));
				$db->where('id', $this->input->post('no_invoice'));
				$db->update('arpost', $data);
				$db->trans_complete();
				$db->trans_start();
				$return = $this->insert_gl_partial($this->input->post('tanggal'), $this->input->post('guna'), $card, $this->input->post('debit'), $this->input->post('val_no_invoice'), $this->input->post('kat_gl'), $this->input->post('note'), $blain2, $plain2, $ppn, $pph23);
				$db->where('id', $id);
				$db->update('billing', array('id_gl' => $return));
			}
		}

		$msg = 1;
		$db->trans_complete();
		return $msg;
	}

	function cek_bayar_invoice($id)
	{
		$get = $this->db->query("SELECT * FROM erp_gmedia.`arpost` a WHERE a.`id`= $id AND a.`lunas`=0");
		return $get->result();
	}

	function update_dp($id, $nominal, $no_inv, $tgl)
	{
		$data = array('id_dp' => $id, 'no_inv' => $no_inv, 'nominal' => $nominal, 'tanggal' => $tgl, 'status' => 1);
		$query = $this->db->insert("finance_deposit_detail", $data);
		if ($query == true) {
			$this->db->query("UPDATE gmd_finance_deposit set nominal=nominal-$nominal WHERE id=$id");
			return 1;
		} else {
			return 0;
		}
	}

	function seperti($str, $searchTerm)
	{
		$searchTerm = strtolower($searchTerm);
		$str = strtolower($str);
		$pos = strpos($str, $searchTerm);
		if ($pos === false)
			return false;
		else
			return true;
	}

	function create_queue_id()
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

	//ini sedang dikerjakan
	function insert_gl($tanggal, $guna, $card, $debit, $no_ref, $kat_gl, $note, $blain2, $plain2, $ppn2, $pph23)
	{
		$msg = $check_merge = $ppn = $flag = null;
		$deb = $kre = $cart = 0;
		$this->db->trans_start();
		if ($this->m_global->closing_date_accounting($tanggal) == true) {
			$this->db->from('finance_coa_general_ledger_detail a');
			$this->db->join('finance_coa_general_ledger b', 'a.no_trans = b.no_trans', 'left');
			$this->db->where('b.no_referensi', $no_ref . ' Payment');
			$q = $this->db->get();
			if ($q->num_rows() > 0) {
				$msg = 2;
			} else {
				$check_merge = $this->db->query("SELECT * FROM erp_gmedia.`arpost` a WHERE a.`id_order` IS NULL AND a.`nomor`='$no_ref'")->result();
				if (!empty($check_merge)) {
					$data['list'] = $this->db->query("SELECT a.`ppn`,a.`flag`,c.`nama` FROM erp_gmedia.`arpost` a LEFT JOIN erp_gmedia.`ms_site` b ON a.`to_site` = b.`id` LEFT JOIN erp_gmedia.`ms_customers` c ON b.`id_cust`=c.`id` WHERE a.`nomor`='$no_ref'")->result();
				} else {
					$data['list'] = $this->db->query("SELECT a.`flag`,b.`nama`,c.`ppn` FROM erp_gmedia.`arpost` a LEFT JOIN erp_gmedia.`ms_customers` b ON a.`id_cust` = b.`id` LEFT JOIN erp_gmedia.`order_header` c ON a.`id_order`=c.`id` WHERE a.`nomor`='$no_ref'")->result();
				}
				foreach ($data['list'] as $sow) {
					$deskripsi = "Pembayaran invoice no " . $no_ref . " - " . $sow->nama;
					$ppn = $sow->ppn;
					$flag = $sow->flag;
				}
				if ($ppn == 1 || $ppn == 3) {
					$ppn = 1;
				} else {
					$ppn = 2;
				}
				$create_queue_id = $this->create_queue_id();
				$create_gl_id = $this->create_gl_id($kat_gl);
				$branch = $this->m_global->cek_id_regional($this->session->userdata('scope_area'));
				$area = $this->m_global->cek_id_regional($this->session->userdata('scope_regional'));
				$data = array(
					'id' => $this->create_id(),
					'no_trans' => $create_queue_id,
					'kat_gl' => $kat_gl,
					'jurnal_group' => $create_gl_id,
					'deskripsi' => $deskripsi,
					'tanggal' => $tanggal,
					'no_referensi' => $no_ref . ' Payment',
					'ppn' => $ppn,
					'project' => $flag,
					'branch' => $branch,
					'area' => $area,
				);
				$result = $this->db->insert('finance_coa_general_ledger', $data);
				$tot = 0;
				if ($result == true) {
					foreach ($guna as $k => $v) {
						$deb = str_replace(",", "", $debit[$k]);
						$tot = $tot + $deb;
						$data = array(
							'no_trans' => $create_queue_id,
							'id_biaya' => $guna[$k],
							'card_id' => $card[$k],
							'tanggal' => $tanggal,
							'divisi' => 0,
							'debet' => $deb,
							'ket' => $note[$k],
							'branch' => $branch,
							'area' => $area,
						);
						$this->db->insert('finance_coa_general_ledger_detail', $data);
						$this->m_global->update_jurnal_bulanan($guna[$k], $card[$k], $tanggal, $branch, $area);
						$this->m_global->update_jurnal_harian($guna[$k], $card[$k], $tanggal, $branch, $area);
					}
					if ($blain2 > 0 && !empty($blain2)) {
						$deb = '560000';
						$cart = '99';
						$tot = $tot + $blain2;
						$data = array(
							'no_trans' => $create_queue_id,
							'id_biaya' => $deb,
							'card_id' => $cart,
							'tanggal' => $tanggal,
							'divisi' => 0,
							'debet' => $blain2,
							'ket' => $note[$k],
							'branch' => $branch,
							'area' => $area,
						);
						$this->db->insert('finance_coa_general_ledger_detail', $data);
						$this->m_global->update_jurnal_bulanan($deb, $cart, $tanggal, $branch, $area);
						$this->m_global->update_jurnal_harian($deb, $cart, $tanggal, $branch, $area);
					}
					if (!empty($ppn2) && $ppn2 > 0) {
						$deb = '213120';
						$cart = '75';
						$tot = $tot + $ppn2;
						$data = array(
							'no_trans' => $create_queue_id,
							'id_biaya' => $deb,
							'card_id' => $cart,
							'tanggal' => $tanggal,
							'divisi' => 0,
							'debet' => $ppn2,
							'ket' => $note[$k],
							'branch' => $branch,
							'area' => $area,
						);
						$this->db->insert('finance_coa_general_ledger_detail', $data);
						$this->m_global->update_jurnal_bulanan($deb, $cart, $tanggal, $branch, $area);
						$this->m_global->update_jurnal_harian($deb, $cart, $tanggal, $branch, $area);
					}
					if (!empty($pph23) && $pph23 > 0) {
						$deb = '213110';
						$cart = '49';
						$tot = $tot + $pph23;
						$data = array(
							'no_trans' => $create_queue_id,
							'id_biaya' => $deb,
							'card_id' => $cart,
							'tanggal' => $tanggal,
							'divisi' => 0,
							'debet' => $pph23,
							'ket' => $note[$k],
							'branch' => $branch,
							'area' => $area,
						);
						$this->db->insert('finance_coa_general_ledger_detail', $data);
						$this->m_global->update_jurnal_bulanan($deb, $cart, $tanggal, $branch, $area);
						$this->m_global->update_jurnal_harian($deb, $cart, $tanggal, $branch, $area);
					}
					if (!empty($plain2) && $plain2 > 0) {
						$kre = '460000';
						$cart = '94';
						$tot = $tot - $plain2;
						$data = array(
							'no_trans' => $create_queue_id,
							'id_biaya' => $kre,
							'card_id' => $cart,
							'tanggal' => $tanggal,
							'divisi' => 0,
							'kredit' => $plain2,
							'ket' => $note[$k],
							'branch' => $branch,
							'area' => $area,
						);
						$this->db->insert('finance_coa_general_ledger_detail', $data);
						$this->m_global->update_jurnal_bulanan($kre, $cart, $tanggal, $branch, $area);
						$this->m_global->update_jurnal_harian($kre, $cart, $tanggal, $branch, $area);
					}
					$kre = '112100';
					$cart = '22';
					$data = array(
						'no_trans' => $create_queue_id,
						'id_biaya' => $kre,
						'card_id' => $cart,
						'tanggal' => $tanggal,
						'divisi' => 0,
						'kredit' => $tot,
						'ket' => $note[$k],
						'branch' => $branch,
						'area' => $area,
					);
					$this->db->insert('finance_coa_general_ledger_detail', $data);
					$this->m_global->update_jurnal_bulanan($kre, $cart, $tanggal, $branch, $area);
					$this->m_global->update_jurnal_harian($kre, $cart, $tanggal, $branch, $area);
					$msg = $create_queue_id;
				} else {
					$msg = 0;
				}
			}
		}
		$this->db->trans_complete();
		return $msg;
	}
	///kurang konfirmasi
	function insert_gl_partial($tanggal, $guna, $card, $debit, $no_ref, $kat_gl, $note, $blain2, $plain2, $ppn2, $pph23)
	{
		$msg = $check_merge = $ppn = $flag = null;
		$deb = $kre = $tot = $cart = 0;
		$this->db->trans_start();
		if ($this->m_global->closing_date_accounting($tanggal) == true) {
			$check_merge = $this->db->query("SELECT * FROM erp_gmedia.`arpost` a WHERE a.`id_order` IS NULL AND a.`nomor`='$no_ref'")->result();
			if (!empty($check_merge)) {
				$data['list'] = $this->db->query("SELECT a.`ppn`,a.`flag`,c.`nama` FROM erp_gmedia.`arpost` a LEFT JOIN erp_gmedia.`ms_site` b ON a.`to_site` = b.`id` LEFT JOIN erp_gmedia.`ms_customers` c ON b.`id_cust`=c.`id` WHERE a.`nomor`='$no_ref'")->result();
			} else {
				$data['list'] = $this->db->query("SELECT a.`flag`,b.`nama`,c.`ppn` FROM erp_gmedia.`arpost` a LEFT JOIN erp_gmedia.`ms_customers` b ON a.`id_cust` = b.`id` LEFT JOIN erp_gmedia.`order_header` c ON a.`id_order`=c.`id` WHERE a.`nomor`='$no_ref'")->result();
			}
			foreach ($data['list'] as $sow) {
				$deskripsi = "Pembayaran invoice no " . $no_ref . " - " . $sow->nama;
				$ppn = $sow->ppn;
				$flag = $sow->flag;
			}
			if ($ppn == 1 || $ppn == 3) {
				$ppn = 1;
			} else {
				$ppn = 2;
			}
			$create_queue_id = $this->create_queue_id();
			$create_gl_id = $this->create_gl_id($kat_gl);
			$branch = $this->m_global->cek_id_regional($this->session->userdata('scope_area'));
			$area = $this->m_global->cek_id_regional($this->session->userdata('scope_regional'));
			$data = array(
				'id' => $this->create_id(),
				'no_trans' => $create_queue_id,
				'kat_gl' => $kat_gl,
				'jurnal_group' => $create_gl_id,
				'deskripsi' => $deskripsi,
				'tanggal' => $tanggal,
				'no_referensi' => $no_ref . ' Non Full Payment',
				'ppn' => $ppn,
				'project' => $flag,
				'branch' => $branch,
				'area' => $area,
			);
			$result = $this->db->insert('finance_coa_general_ledger', $data);
			if ($result == true) {
				$tot = 0;
				foreach ($guna as $k => $v) {
					$deb = str_replace(",", "", $debit[$k]);
					if (!empty($deb)) {
						$tot = $tot + $deb;
						$data = array(
							'no_trans' => $create_queue_id,
							'id_biaya' => $guna[$k],
							'card_id' => $card[$k],
							'tanggal' => $tanggal,
							'divisi' => 0,
							'debet' => $deb,
							'ket' => $note[$k],
							'branch' => $branch,
							'area' => $area,
						);
						$this->db->insert('finance_coa_general_ledger_detail', $data);
						$this->m_global->update_jurnal_bulanan($guna[$k], $card[$k], $tanggal, $branch, $area);
						$this->m_global->update_jurnal_harian($guna[$k], $card[$k], $tanggal, $branch, $area);
					}
				}
				if (!empty($blain2) && $blain2 > 0) {
					$deb = '560000';
					$cart = '99';
					$tot = $tot + $blain2;
					$data = array(
						'no_trans' => $create_queue_id,
						'id_biaya' => $guna[$k],
						'card_id' => $cart,
						'tanggal' => $tanggal,
						'divisi' => 0,
						'debet' => $blain2,
						'ket' => $note[$k],
						'branch' => $branch,
						'area' => $area,
					);
					$this->db->insert('finance_coa_general_ledger_detail', $data);
					$this->m_global->update_jurnal_bulanan($deb, $cart, $tanggal, $branch, $area);
					$this->m_global->update_jurnal_harian($deb, $cart, $tanggal, $branch, $area);
				}
				if (!empty($ppn2) && $ppn2 > 0) {
					$deb = '213120';
					$cart = '75';
					$tot = $tot + $ppn2;
					$data = array(
						'no_trans' => $create_queue_id,
						'id_biaya' => $deb,
						'card_id' => $cart,
						'tanggal' => $tanggal,
						'divisi' => 0,
						'debet' => $ppn2,
						'ket' => $note[$k],
						'branch' => $branch,
						'area' => $area,
					);
					$this->db->insert('finance_coa_general_ledger_detail', $data);
					$this->m_global->update_jurnal_bulanan($deb, $cart, $tanggal, $branch, $area);
					$this->m_global->update_jurnal_harian($deb, $cart, $tanggal, $branch, $area);
				}
				if (!empty($pph23) && $pph23 > 0) {
					$deb = '213110';
					$cart = '49';
					$tot = $tot + $pph23;
					$data = array(
						'no_trans' => $create_queue_id,
						'id_biaya' => $deb,
						'card_id' => $cart,
						'tanggal' => $tanggal,
						'divisi' => 0,
						'ket' => $note[$k],
						'debet' => $pph23,
						'branch' => $branch,
						'area' => $area,
					);
					$this->db->insert('finance_coa_general_ledger_detail', $data);
					$this->m_global->update_jurnal_bulanan($deb, $cart, $tanggal, $branch, $area);
					$this->m_global->update_jurnal_harian($deb, $cart, $tanggal, $branch, $area);
				}
				if (!empty($plain2) && $plain2 > 0) {
					$kre = '460000';
					$cart = '94';
					$tot = $tot - $plain2;
					$data = array(
						'no_trans' => $create_queue_id,
						'id_biaya' => $kre,
						'card_id' => $cart,
						'tanggal' => $tanggal,
						'divisi' => 0,
						'kredit' => $plain2,
						'ket' => $note[$k],
						'branch' => $branch,
						'area' => $area,
					);
					$this->db->insert('finance_coa_general_ledger_detail', $data);
					$this->m_global->update_jurnal_bulanan($kre, $cart, $tanggal, $branch, $area);
					$this->m_global->update_jurnal_harian($kre, $cart, $tanggal, $branch, $area);
				}
				$kre = '112100';
				$cart = '22';
				$data = array(
					'no_trans' => $create_queue_id,
					'id_biaya' => $kre,
					'card_id' => $cart,
					'tanggal' => $tanggal,
					'divisi' => 0,
					'kredit' => $tot,
					'ket' => $note[$k],
					'branch' => $branch,
					'area' => $area,
				);
				$this->db->insert('finance_coa_general_ledger_detail', $data);
				$this->m_global->update_jurnal_bulanan($kre, $cart, $tanggal, $branch, $area);
				$this->m_global->update_jurnal_harian($kre, $cart, $tanggal, $branch, $area);
				$msg = $create_queue_id;
			} else {
				$msg = 0;
			}
		}
		$this->db->trans_complete();
		return $msg;
	}

	// function insert_gl_pembalik($kat_gl, $tanggal, $no_ref, $tot)
	// {
	// 	$msg = null;
	// 	$create_queue_id = $this->create_queue_id();
	// 	$create_gl_id = $this->create_gl_id($kat_gl);
	// 	$branch = $this->m_global->cek_id_regional($this->session->userdata('scope_area'));
	// 	$area = $this->m_global->cek_id_regional($this->session->userdata('scope_regional'));
	// 	$data = array(
	// 		'no_trans' => $create_queue_id,
	// 		'kat_gl' => $kat_gl,
	// 		'jurnal_group' => $create_gl_id,
	// 		'deskripsi' => 'Pelunasan Invoice partial ' . $no_ref,
	// 		'tanggal' => $tanggal,
	// 		'no_referensi' => $no_ref . ' Payment',
	// 		'branch' => $branch,
	// 		'area' => $area,
	// 	);
	// 	$result = $this->db->insert('finance_coa_general_ledger', $data);
	// 	if ($result == true) {
	// 		$deb = '113000';
	// 		$data = array(
	// 			'no_trans' => $create_queue_id,
	// 			'id_biaya' => $deb,
	// 			'tanggal' => $tanggal,
	// 			'divisi' => 0,
	// 			'debet' => $tot,
	// 			'branch' => $branch,
	// 			'area' => $area,
	// 		);
	// 		$this->db->insert('finance_coa_general_ledger_detail', $data);
	// 		$this->m_global->update_jurnal_bulanan($deb, null, $tanggal, $branch, $area);
	// 		$this->m_global->update_jurnal_harian($deb, null, $tanggal, $branch, $area);

	// 		$kre = '112100';
	// 		$card = '22';
	// 		$data = array(
	// 			'no_trans' => $create_queue_id,
	// 			'id_biaya' => $kre,
	// 			'card_id' => $card,
	// 			'tanggal' => $tanggal,
	// 			'divisi' => 0,
	// 			'kredit' => $tot,
	// 			'branch' => $branch,
	// 			'area' => $area,
	// 		);
	// 		$this->db->insert('finance_coa_general_ledger_detail', $data);
	// 		$this->m_global->update_jurnal_bulanan($kre, $card, $tanggal, $branch, $area);
	// 		$this->m_global->update_jurnal_harian($kre, $card, $tanggal, $branch, $area);
	// 		$msg = $create_queue_id;
	// 	} else {
	// 		$msg = 0;
	// 	}
	// 	$this->db->trans_complete();
	// 	return $msg;
	// }

	function select()
	{
		$data = '';
		$detail = $no_arpost = null;
		$q = $this->db->query("SELECT
		*,f.`nama` AS `nama_kat_gl`,b.`id` AS no_arpost,e.`nama` AS nama_coa,a.`ppn` AS ppnnya,g.`id` AS card_id,g.`nama` AS card_nama,a.`tanggal` AS tanggalnya,IF(COALESCE(b.`jml_piutang`,0) - COALESCE(b.`jml_bayar`,0) > 0,COALESCE(b.`jml_piutang`,0) - COALESCE(b.`jml_bayar`,0),0) AS sisa,COALESCE(b.`jml_piutang`,0) AS jmlh_piutang
	  FROM
		erp_gmedia.`billing` a
		 JOIN erp_gmedia.`arpost` b
		  ON a.`id_arpost` = b.`id`
		 JOIN erp_financev2.`gmd_finance_coa_general_ledger` c
		  ON a.`id_gl`=c.`no_trans`
		   JOIN erp_financev2.`gmd_finance_coa_general_ledger_detail` d
		  ON a.`id_gl`=d.`no_trans`
		  JOIN erp_financev2.`gmd_finance_coa` e
	ON d.`id_biaya`=e.`id`
	JOIN erp_financev2.`gmd_finance_master_kat_gl` f
	ON c.`kat_gl`=f.`id`
	JOIN erp_financev2.`gmd_finance_coa_card_name` g
	ON d.`card_id`=g.`id` WHERE a.`id`=" . $this->input->post("id") . " AND d.`kredit`<1 AND d.`id_biaya`!=560000 AND d.`id_biaya` != 115120 AND d.`id_biaya`!=213120 AND d.`id_biaya`!=213110");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $k => $r) {
				if (empty($r['ppnnya'])) {
					$ppn = 0;
				} else {
					$ppn = $r['ppnnya'];
				}
				if (empty($r['pph23'])) {
					$pph23 = 0;
				} else {
					$pph23 = $r['pph23'];
				}
				if (empty($r['plain2'])) {
					$plain2 = 0;
				} else {
					$plain2 = $r['plain2'];
				}
				if (empty($r['blain2'])) {
					$blain2 = 0;
				} else {
					$blain2 = $r['blain2'];
				}
				if (empty($r['jml_bayar'])) {
					$jml_bayar = 0;
				} else {
					$jml_bayar = $r['jml_bayar'];
				}
				$data .= '<div class="row adder">';
				$data .= '<div class="col-lg-2"><label>kode jurnal</label>
				<select class="form-control guna" id="guna_' . $k . '" name="guna[]"></select></div>';
				$data .= '<div class="col-lg-2"><label>card</label>
				<select class="form-control card" id="card_' . $k . '" name="card[]"></select></div>';
				$data .= '<div class="col-lg-2"><label>debit</label>
				<input class="form-control currdebit" id="debit_' . $k . '" type="text" name="debit[]" value="0" style="text-align:right"/></div>';
				$data .= '<div class="col-lg-2"><label>kredit</label></div>';
				$data .= '<div class="col-lg-3"><label>note</label>
				<input class="form-control" type="text" id="note_' . $k . '" name="note[]"></div>';
				$data .= '<a href="#" class="delete" style="color:red">Delete</a></a><br></div>';
				$detail[$k] = array(
					'id' => $r['id_biaya'],
					'coa' => $r['id_biaya'] . ' - ' . $r['nama_coa'],
					'card_id' => $r['card_id'],
					'card_name' => $r['card_nama'],
					'debit' => $r['debet'],
					'note' => $r['ket'],
					'kode' => $r['kat_gl'],
					'kat_gl' => $r['nama_kat_gl'],
					'nomor' => $r['nomor'],
					'jml_bayar' => $jml_bayar,
					'ppn' => $ppn,
					'pph23' => $pph23,
					'plain2' => $plain2,
					'blain2' => $blain2,
					'piut' => $r['jml_piutang'],
					'id_arpost' => $r['id_arpost'],
					'tanggal' => $r['tanggalnya'],
					'jumlah_piutang' => $r['jmlh_piutang'],
					'sisa' => $r['sisa']
				);
				$no_arpost = $r['no_arpost'];
			}
		}
		$data2 = array('data' => $data, 'detail' => $detail, 'no_invoice' => $no_arpost);
		$q->free_result();
		return $data2;
	}
	// function select()
	// {
	// 	$this->db->select("a.*, b.no_invoice as val_no_invoice,c.id as id_jurnal,c.nama as nama_jurnal", false);
	// 	$this->db->from('finance_invoice_billing a');
	// 	$this->db->join('finance_invoice_customer b', "a.no_invoice = b.id", 'left');
	// 	$this->db->join('finance_coa c', "a.kas_bank = c.id");
	// 	$this->db->where("a.id", $this->input->post('id'));
	// 	$q = $this->db->get();
	// 	return $q->result();
	// }



	function delete($id)
	{
		$this->db->trans_start();
		$old_no_invoice = 0;

		$q = $this->db->query("select no_invoice from gmd_finance_invoice_billing where id = '" . $id . "'");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$old_no_invoice = $r['no_invoice'];
			}
		}
		$q->free_result();

		$this->db->where('id', $id);
		$result = $this->db->delete('finance_invoice_billing');
		if ($result == true) {
			//OLD TRANSAKSI
			$this->m_global->cek_bayar_invoice($old_no_invoice);
			$msg = 1;
		} else {
			$msg = 0;
		}
		$this->db->trans_complete();
		return $msg;
	}

	function finance_bank()
	{
		$this->db->order_by('name', 'asc');
		$q = $this->db->get('finance_bank');
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
		$kode = $this->input->post('term');
		$q = $this->db->query("SELECT * FROM (SELECT a.`id`, a.`nomor`, CONCAT('<div>No Invoice: <b>',a.`nomor`,'</b>
		, Inv Date: <b>',DATE_FORMAT(a.tanggal_invoice, '%d-%m-%Y'),'</b>
		, Due Date: <b>',DATE_FORMAT(a.due_date, '%d-%m-%Y'),'</b>
		<br> Customer: <b>',b.nama,'</b>
		, Cust. ID: <b>',b.idcust,'</b>
		, Site: <b>',c.nama,'</b>
		<br> Jumlah Tagihan: <b>',CAST(FORMAT(a.jml_piutang,0) AS CHAR CHARACTER SET utf8),'</b>
		<br> Sisa Tagihan: <b>',CAST(FORMAT(a.jml_piutang - COALESCE(a.jml_bayar,0),0) AS CHAR CHARACTER SET utf8),'</b></div>') AS konten
FROM erp_gmedia.`arpost` a LEFT JOIN erp_gmedia.`ms_customers` b ON a.`id_cust`=b.`id` LEFT JOIN erp_gmedia.`ms_site` c ON a.`id_site`=c.`id`
WHERE a.`status`=1 AND a.`status_invoice` > 1 AND a.`lunas`=0 AND a.`id_order` IS NOT NULL AND (a.`nomor` LIKE '%$kode%' OR b.`nama` LIKE '%$kode%' OR c.`nama` LIKE '%$kode%' OR b.`idcust` LIKE '%$kode%') GROUP BY a.`id`
UNION ALL
SELECT a.`id`, a.`nomor`, CONCAT('<div>No Invoice: <b>',a.`nomor`,'</b>
		, Inv Date: <b>',DATE_FORMAT(a.tanggal_invoice, '%d-%m-%Y'),'</b>
		, Due Date: <b>',DATE_FORMAT(a.due_date, '%d-%m-%Y'),'</b>
		<br> Customer: <b>',c.nama,'</b>
		, Cust. ID: <b>',c.idcust,'</b>
		, Site: <b>',d.nama,'</b>
		<br> Jumlah Tagihan: <b>',CAST(FORMAT(a.jml_piutang,0) AS CHAR CHARACTER SET utf8),'</b>
		<br> Sisa Tagihan: <b>',CAST(FORMAT(a.jml_piutang - COALESCE(a.jml_bayar,0),0) AS CHAR CHARACTER SET utf8),'</b></div>') AS konten
FROM erp_gmedia.`arpost` a LEFT JOIN erp_gmedia.`order_header` b ON a.`to_site`=b.`id_site` LEFT JOIN erp_gmedia.`ms_customers` c ON b.`id_cust`=c.`id` LEFT JOIN erp_gmedia.`ms_site` d ON b.`id_site`=d.`id`
WHERE a.`status`=1 AND a.`status_invoice` > 1 AND a.`lunas`=0 AND a.`id_order` IS NULL AND (a.`nomor` LIKE '%$kode%' OR c.`nama` LIKE '%$kode%' OR d.`nama` LIKE '%$kode%' OR c.`idcust` LIKE '%$kode%') GROUP BY a.`id`) p LIMIT 50");
		return $q->result();
	}

	function select_detail_ref($no_invoice)
	{
		$data = $id = $deposit = $depositid = $piutang = $sisa = $jml_piutang = null;
		$q = $this->db->query("SELECT * FROM (
			SELECT a.`id`,CONCAT('(NO INVOICE): ',a.`nomor`,', (INV DATE): ',DATE_FORMAT(a.`tanggal_invoice`, '%d-%m-%Y'),', (DUE DATE): ',DATE_FORMAT(a.`due_date`, '%d-%m-%Y'),'
(CUSTOMER): ',b.`nama`,', (CUST. ID): ',b.`idcust`,'
(SITE): ',c.`nama`,'
(DPP): ',(SELECT FORMAT(SUM(zz.nominal),0) AS dpp FROM erp_gmedia.`transaksi` zz WHERE zz.`id_order`=a.`id_order` AND zz.`nomor`=a.`nomor` AND zz.`jenis_transaksi`='LG' AND zz.`status`=1),'
(JUMLAH TAGIHAN): ',CAST(FORMAT(a.`jml_piutang`,0) AS CHAR CHARACTER SET utf8),'
(SISA TAGIHAN): ',CAST(FORMAT(COALESCE(a.`jml_piutang`,0) - COALESCE(a.`jml_bayar`,0),0) AS CHAR CHARACTER SET utf8),'') AS konten,
			COALESCE(d.`nominal`,0) AS deposit,d.`id` AS depositid,a.`nomor`,a.`tanggal_invoice`,a.`jml_piutang`,a.`jml_bayar`,COALESCE(a.`jml_piutang`,0) - COALESCE(a.`jml_bayar`,0) AS sisa FROM erp_gmedia.`arpost` a LEFT JOIN erp_gmedia.`ms_customers` b ON b.`id`=a.`id_cust` LEFT JOIN erp_gmedia.`ms_site` c ON a.`id_site`=c.`id`
			LEFT JOIN erp_financev2.`gmd_finance_downpayment` d ON d.`id_cust`=a.`id_cust` AND d.`id_site`=a.`id_site` WHERE a.`id_order` IS NOT NULL AND a.`status`=1 GROUP BY a.`id`
			UNION ALL
			SELECT a.`id`,CONCAT('(NO INVOICE): ',a.`nomor`,', (INV DATE): ',DATE_FORMAT(a.`tanggal_invoice`, '%d-%m-%Y'),', (DUE DATE): ',DATE_FORMAT(a.`due_date`, '%d-%m-%Y'),'
(CUSTOMER): ',c.`nama`,', (CUST. ID): ',c.`idcust`,'
(SITE): ',d.`nama`,'
(DPP): ',(SELECT FORMAT(SUM(zz.nominal),0) AS dpp FROM erp_gmedia.`arpost_merge` z JOIN erp_gmedia.`arpost` zx ON z.`id_arpost`=zx.`id` JOIN erp_gmedia.`transaksi` zz ON zx.`id_order`=zz.`id_order` AND zx.`nomor`=zz.`nomor` WHERE z.`status`=1 AND zx.`status`=1 AND z.`id_arpost_merge`=a.`id` AND zz.`status`=1 AND zz.`jenis_transaksi`='LG'),'
(JUMLAH TAGIHAN): ',CAST(FORMAT(a.`jml_piutang`,0) AS CHAR CHARACTER SET utf8),'
(SISA TAGIHAN): ',CAST(FORMAT(COALESCE(a.`jml_piutang`,0) - COALESCE(a.`jml_bayar`,0),0) AS CHAR CHARACTER SET utf8),'') AS konten,
			COALESCE(e.`nominal`,0) AS deposit,e.`id` AS depositid,a.`nomor`,a.`tanggal_invoice`,a.`jml_piutang`,a.`jml_bayar`,COALESCE(a.`jml_piutang`,0) - COALESCE(a.`jml_bayar`,0) AS sisa FROM erp_gmedia.`arpost` a LEFT JOIN erp_gmedia.`order_header` b ON b.`id_site`=a.`to_site` LEFT JOIN erp_gmedia.`ms_customers` c ON b.`id_cust`=c.`id` LEFT JOIN erp_gmedia.`ms_site` d ON b.`id_site`=d.`id`
			LEFT JOIN erp_financev2.`gmd_finance_downpayment` e ON e.`id_cust`=b.`id_cust` AND e.`id_site`=b.`id_site` WHERE a.`id_order` IS NULL AND a.`status`=1 GROUP BY a.`id`) p WHERE p.`id`=$no_invoice");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data = $r['konten'];
				$id = $r['id'];
				$deposit = $r['deposit'];
				$depositid = $r['depositid'];
				$piutang = number_format($r['jml_piutang'], 0);
				$jml_piutang = $r['jml_piutang'];
				$sisa = $r['sisa'];
			}
		}
		$q->free_result();
		$tanggal = date('Y-m-d');
		$arr = array(
			"html" => $data,
			"id" => $id,
			"deposit" => $deposit,
			"depositid" => $depositid,
			"tanggal" => $tanggal,
			"piutang" => $piutang,
			"jml_piutang" => $jml_piutang,
			"sisa" => $sisa
		);
		echo json_encode($arr);
	}

	function select_autocomplite_coa_id($id)
	{
		$this->db->select("id,nama");
		$this->db->from("finance_coa a");
		$this->db->where("(id like '%" . $id . "%'
		or nama like '%" . $id . "%')", NULL, FALSE);
		$this->db->order_by('id', 'asc');
		$q = $this->db->get();
		return $q->result();
	}

	function select_autocomplite_coa_idfull()
	{
		$this->db->select("id,nama");
		$this->db->from("finance_coa a");
		$this->db->order_by('id', 'asc');
		$q = $this->db->get();
		return $q->result();
	}

	function select_autocomplite_card_id($text, $id)
	{
		$this->db->select("id,nama");
		$this->db->from("finance_coa_card_name a");
		$this->db->where("a.coa", $id);
		$this->db->where("(nama like '%" . $text . "%')", NULL, FALSE);
		$this->db->order_by('id', 'asc');
		$q = $this->db->get();
		return $q->result();
	}

	function select_autocomplite_card_full($id)
	{
		$this->db->select("id,nama");
		$this->db->from("finance_coa_card_name");
		$this->db->where('coa', $id);
		$this->db->order_by('id', 'asc');
		$q = $this->db->get();
		return $q->result();
	}
}
