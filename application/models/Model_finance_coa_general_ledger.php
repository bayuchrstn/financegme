<?php
class Model_finance_coa_general_ledger extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function get_data_table()
	{
		$column_order = array(null, 'a.no_trans', 'a.tanggal', 'b.jurnal_group', 'b.deskripsi', 'a.id_biaya', 'c.nama', 'a.ket', 'a.debet', 'a.kredit');
		$order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'a.no_trans';
		$order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'desc';

		$this->db->select("SQL_CALC_FOUND_ROWS a.no_trans, DATE_FORMAT(a.tanggal, '%d/%m/%Y') AS tanggalnya, b.jurnal_group, b.deskripsi, a.id_biaya, c.nama as nama_coa, a.ket AS memo, a.debet, a.kredit,a.card_id,d.nama AS card_name", false);
		$this->db->from('finance_coa_general_ledger_detail a');
		$this->db->join('finance_coa_general_ledger b', 'a.no_trans = b.no_trans', 'left');
		$this->db->join('finance_coa c', 'a.id_biaya = c.id', 'left');
		$this->db->join('finance_coa_card_name d', 'a.card_id = d.id', 'left');
		$this->db->group_start();
		$this->db->like('a.no_trans', $this->input->post('search_keyword'));
		$this->db->or_like('b.jurnal_group', $this->input->post('search_keyword'));
		$this->db->or_like('b.deskripsi', $this->input->post('search_keyword'));
		$this->db->or_like('a.id_biaya', $this->input->post('search_keyword'));
		$this->db->or_like('c.nama', $this->input->post('search_keyword'));
		$this->db->or_like('a.ket', $this->input->post('search_keyword'));
		$this->db->or_like('b.no_referensi', $this->input->post('search_keyword'));
		$this->db->group_end();
		$this->db->where("(a.tanggal between '" . $this->input->post('searchDateFirst') . "' and '" . $this->input->post('searchDateFinish') . "')", NULL, FALSE);
		if ($this->input->post('searchkat_gl') != '0') {
			$this->db->where('b.kat_gl', $this->input->post('searchkat_gl'));
		}
		if ($this->input->post('id_biaya') != '') {
			$this->db->where('a.id_biaya', $this->input->post('id_biaya'));
		}
		if ($this->input->post('id_card') != '') {
			$this->db->where('a.card_id', $this->input->post('id_card'));
		}
		// $this->db->group_by('a.no_trans');
		$this->db->order_by('a.tanggal', 'DESC');
		$this->db->order_by($order_name, $order_dir);
		$this->db->order_by('a.debet', 'DESC');
		// if ($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
		$q = $this->db->get();
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
		$data = array();
		$no = 0;
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$no++;
				$edit = '<a href="#" onclick="update_data(\'' . $r['no_trans'] . '\')"><i class="icon-menu7 position-left text-slate-800"></i></a> <a href="#" onclick="delete_data(\'' . $r['no_trans'] . '\')"><i class="icon-bin position-left text-grey"></i></a>';
				$row  = array(
					$no . '.',
					$r['no_trans'],
					$r['tanggalnya'],
					$r['jurnal_group'],
					$r['deskripsi'],
					$r['id_biaya'],
					$r['nama_coa'],
					$r['card_name'],
					$r['memo'],
					number_format($r['debet'], 0),
					number_format($r['kredit'], 0),
					$edit,
				);


				$data[] = $row;
			}
		}
		$q->free_result();

		$output = array(
			"data" => $data,
		);
		echo json_encode($output);
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

	function insert()
	{
		$this->db->trans_start();

		if ($this->m_global->closing_date_accounting($this->input->post('tanggal')) == true) {
			$this->db->from('finance_coa_general_ledger_detail a');
			$this->db->join('finance_coa_general_ledger b', 'a.no_trans = b.no_trans', 'left');
			$this->db->where('b.no_referensi', $this->input->post('no_referensi'));
			$q = $this->db->get();
			if ($q->num_rows() > 0) {
				$msg = 'No referensi sudah pernah di input';
			} else {
				$create_queue_id = $this->create_queue_id();
				$create_gl_id = $this->create_gl_id($this->input->post('kat_gl'));
				$branch = $this->m_global->cek_id_regional($this->session->userdata('scope_area'));
				$area = $this->m_global->cek_id_regional($this->session->userdata('scope_regional'));
				$data = array(
					'id' => $this->create_id(),
					'no_trans' => $create_queue_id,
					'kat_gl' => $this->input->post('kat_gl'),
					'jurnal_group' => $create_gl_id,
					'deskripsi' => $this->input->post('deskripsi'),
					'tanggal' => $this->input->post('tanggal'),
					'no_referensi' => $this->input->post('no_referensi'),
					'ppn' => $this->input->post('ppn'),
					'project' => $this->input->post('project'),
					'branch' => $branch,
					'area' => $area,
				);
				$result = $this->db->insert('finance_coa_general_ledger', $data);
				if ($result == true) {
					if (isset($_POST['tambah_account_id'])) {
						foreach ($_POST['tambah_account_id'] as $k => $v) {
							$debet = (float) str_replace(",", "", $_POST['tambah_debet'][$k]);
							$kredit = (float) str_replace(",", "", $_POST['tambah_kredit'][$k]);
							$data = array(
								'no_trans' => $create_queue_id,
								'id_biaya' => $_POST['tambah_account_id'][$k],
								'card_id' =>  $_POST['pra_gl_card_id'][$k],
								'tanggal' => $this->input->post('tanggal'),
								'divisi' => $this->input->post('divisi'),
								'debet' => $debet,
								'kredit' => $kredit,
								'ket' => $_POST['memo'][$k],
								'branch' => $branch,
								'area' => $area,
							);
							$this->db->insert('finance_coa_general_ledger_detail', $data);
							$this->m_global->update_jurnal_bulanan($_POST['tambah_account_id'][$k], $_POST['pra_gl_card_id'][$k], $this->input->post('tanggal'), $branch, $area);
							$this->m_global->update_jurnal_harian($_POST['tambah_account_id'][$k], $_POST['pra_gl_card_id'][$k], $this->input->post('tanggal'), $branch, $area);
						}
					}
					$msg = 1;
				} else {
					$msg = 0;
				}
			}
		} else {
			$msg = 'Proses Gagal, Tanggal transaksi telah ditutup';
		}
		$this->db->trans_complete();
		return $msg;
	}

	function select()
	{
		$this->db->select("a.*, 
		COALESCE((select divisi from gmd_finance_coa_general_ledger_detail where no_trans = a.no_trans limit 1),0) as divisi, 
		COALESCE((select ket from gmd_finance_coa_general_ledger_detail where no_trans = a.no_trans limit 1),NULL) as memo", false);
		$this->db->from('finance_coa_general_ledger a');
		$this->db->where("a.no_trans", $this->input->post('id'));
		$q = $this->db->get();
		return $q->result();
	}

	function update()
	{
		$this->db->trans_start();
		if ($this->m_global->closing_date_accounting($this->input->post('tanggal')) == true && $this->m_global->closing_date_accounting($this->select_date($this->input->post('id'))) == true) {
			$this->db->from('finance_coa_general_ledger_detail a');
			$this->db->join('finance_coa_general_ledger b', 'a.no_trans = b.no_trans', 'left');
			$this->db->where('b.no_trans !=', $this->input->post('id'));
			$this->db->where('b.no_referensi', $this->input->post('no_referensi'));
			$q = $this->db->get();
			if ($q->num_rows() > 0) {
				$msg = 'No referensi sudah pernah di input';
			} else {
				$branch = $this->m_global->cek_id_regional($this->session->userdata('scope_area'));
				$area = $this->m_global->cek_id_regional($this->session->userdata('scope_regional'));
				$data = array(
					//'jurnal_group' => $this->input->post('jurnal_group'),
					'deskripsi' => $this->input->post('deskripsi'),
					'tanggal' => $this->input->post('tanggal'),
					'no_referensi' => $this->input->post('no_referensi'),
					'ppn' => $this->input->post('ppn'),
					'project' => $this->input->post('project'),
					'branch' => $branch,
					'area' => $area,
				);
				$this->db->where('no_trans', $this->input->post('id'));
				$result = $this->db->update('finance_coa_general_ledger', $data);
				if ($result == true) {
					$this->db->from('finance_coa_general_ledger_detail');
					$this->db->where('no_trans', $this->input->post('id'));
					$qd = $this->db->get();
					$this->db->where('no_trans', $this->input->post('id'));
					$this->db->delete('finance_coa_general_ledger_detail');
					if ($qd->num_rows() > 0) {
						foreach ($qd->result_array() as $kd => $rd) {
							$this->m_global->update_jurnal_bulanan($rd['id_biaya'], $rd['card_id'], $rd['tanggal'], $rd['branch'], $rd['area']);
							$this->m_global->update_jurnal_harian($rd['id_biaya'], $rd['card_id'], $rd['tanggal'], $rd['branch'], $rd['area']);
						}
					}

					if (isset($_POST['tambah_account_id'])) {
						foreach ($_POST['tambah_account_id'] as $k => $v) {
							$debet = (float) str_replace(",", "", $_POST['tambah_debet'][$k]);
							$kredit = (float) str_replace(",", "", $_POST['tambah_kredit'][$k]);
							//$qd = $this->db->query("insert into gmd_finance_coa_general_ledger_detail (no_trans, id_biaya, tanggal, divisi, debet, kredit, ket, branch, area) values 
							//('".$this->input->post('id')."', '".$_POST['tambah_account_id'][$k]."', '".$this->input->post('tanggal')."', '".$this->input->post('divisi')."', '".$debet."', '".$kredit."', '".$this->input->post('memo')."', '".$branch."', '".$area."')");
							$data = array(
								'no_trans' => $this->input->post('id'),
								'id_biaya' => $_POST['tambah_account_id'][$k],
								'card_id' => $_POST['pra_gl_card_id'][$k],
								'tanggal' => $this->input->post('tanggal'),
								'divisi' => $this->input->post('divisi'),
								'debet' => $debet,
								'kredit' => $kredit,
								'ket' => $_POST['memo'][$k],
								'branch' => $branch,
								'area' => $area,
							);
							$this->db->insert('finance_coa_general_ledger_detail', $data);
							$this->m_global->update_jurnal_bulanan($_POST['tambah_account_id'][$k], $_POST['pra_gl_card_id'][$k], $this->input->post('tanggal'), $branch, $area);
							$this->m_global->update_jurnal_harian($_POST['tambah_account_id'][$k], $_POST['pra_gl_card_id'][$k], $this->input->post('tanggal'), $branch, $area);
						}
					}

					$msg = 1;
				} else {
					$msg = 0;
				}
			}
		} else {
			$msg = 'Proses Gagal, Tanggal transaksi telah ditutup';
		}
		$this->db->trans_complete();
		return $msg;
	}

	function delete()
	{
		$this->db->trans_start();
		if ($this->m_global->closing_date_accounting($this->select_date($this->input->post('id'))) == true) {
			$this->db->where('no_trans', $this->input->post('id'));
			$result = $this->db->delete('finance_coa_general_ledger');
			if ($result == true) {
				$this->db->from('finance_coa_general_ledger_detail');
				$this->db->where('no_trans', $this->input->post('id'));
				$qd = $this->db->get();
				$this->db->where('no_trans', $this->input->post('id'));
				$this->db->delete('finance_coa_general_ledger_detail');
				if ($qd->num_rows() > 0) {
					foreach ($qd->result_array() as $kd => $rd) {
						$this->m_global->update_jurnal_bulanan($rd['id_biaya'], $rd['card_id'], $rd['tanggal'], $rd['branch'], $rd['area']);
						$this->m_global->update_jurnal_harian($rd['id_biaya'], $rd['card_id'], $rd['tanggal'], $rd['branch'], $rd['area']);
					}
				}
				$msg = 1;
			} else {
				$msg = 0;
			}
		} else {
			$msg = 'Proses Gagal, Tanggal transaksi telah ditutup';
		}
		$this->db->trans_complete();
		return $msg;
	}

	function select_data_detail_invoice()
	{
		$data = '';

		$this->db->select("a.*, b.nama as nama_coa,c.nama AS nama_card", false);
		$this->db->from('finance_coa_general_ledger_detail AS a');
		$this->db->join('finance_coa b', "a.id_biaya = b.id", 'left');
		$this->db->join('finance_coa_card_name c', "c.id = a.card_id", 'left');
		$this->db->where('a.no_trans', $this->input->post('id'));
		$this->db->order_by('a.debet', 'desc');
		$this->db->order_by('a.kredit', 'desc');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $k => $r) {
				$data .= '<tr class="remove">';
				$data .= '<td style="vertical-align:middle;"><input class="form-control" type="text" style="width:90px;" readonly="readonly" name="tambah_account_id[]" value="' . $r['id_biaya'] . '" /></td>';
				$data .= '<td style="vertical-align:middle;"><input class="form-control" type="text" style="width:150px;" readonly="readonly" name="tambah_account_name[]" value="' . $r['nama_coa'] . '" /></td>';
				$data .= '<td style="vertical-align:middle;"><input type="hidden" name="pra_gl_card_id[]" value="' . $r['card_id'] . '" /><input class="form-control" type="text"  readonly="readonly" name="pra_gl_card_name[]" value="' . $r['nama_card'] . '" /></td>';
				$data .= '<td style="vertical-align:middle;"><input class="form-control" type="text"  name="memo[]" value="' . $r['ket'] . '" /></td>';
				$data .= '<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:150px;" readonly="readonly" name="tambah_debet[]" value="' . number_format($r['debet'], 2) . '" /></td>';
				$data .= '<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:150px;" readonly="readonly" name="tambah_kredit[]" value="' . number_format($r['kredit'], 2) . '" /></td>';
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

	function select_date($id)
	{
		$this->db->select("a.tanggal", false);
		$this->db->from('finance_coa_general_ledger a');
		$this->db->where("a.no_trans", $id);
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				return $r['tanggal'];
			}
		}
		$q->free_result();
	}


	function inject()
	{
		$dataga = $this->db->query("SELECT * FROM (SELECT a.`id` AS id, a.`note` AS deskripsi, b.`date` AS tanggal,
		c.`nomor` AS no_referensi, CASE WHEN d.`ppn` > 0 THEN 1 WHEN d.`ppn` = 0 THEN 0 END AS ppn FROM
		erp_gmedia.`jurnal` a JOIN erp_gmedia.`jurnal_detail` b ON a.`id` = b.`idjurnal` JOIN erp_gmedia.`arpost` c
		ON a.`id_arpost` = c.`id` JOIN erp_finance.`view_transaksi` d ON c.`nomor` = d.`nomor` AND c.`id_order` = d.`id_order` WHERE a.`status` != 9 GROUP BY a.`id` ORDER BY b.`date` ASC) AS a
	  UNION ALL
	  SELECT * FROM (SELECT e.`id` AS id, CASE WHEN f.`memo` != '' THEN f.`memo` WHEN e.`note` != '' THEN e.`note`
		END AS deskripsi, f.`date` AS tanggal, NULL AS no_referensi, 0 AS ppn FROM erp_gmedia.`jurnal` e
		JOIN erp_gmedia.`jurnal_detail` f ON e.`id` = f.`idjurnal` WHERE e.`id_arpost`=0 AND e.`status` != 9 GROUP BY e.id ORDER BY f.`date` ASC) AS b")->result();

		foreach ($dataga as $mow) {
			$create_queue_id = $this->create_queue_id();
			$create_gl_id = $this->create_gl_id(19);
			$branch = $this->m_global->cek_id_regional($this->session->userdata('scope_area'));
			$area = $this->m_global->cek_id_regional($this->session->userdata('scope_regional'));
			$data = array(
				'no_trans' => $create_queue_id,
				'kat_gl' => 19,
				'jurnal_group' => $create_gl_id,
				'deskripsi' => $mow->deskripsi,
				'tanggal' => $mow->tanggal,
				'no_referensi' => $mow->no_referensi,
				'ppn' => $mow->ppn,
				'project' => 0,
				'branch' => $branch,
				'area' => $area,
			);
			$result = $this->db->insert('finance_coa_general_ledger', $data);
			if ($result == true) {
				$datadetail = $this->db->query("SELECT * FROM erp_gmedia.`jurnal_detail` WHERE `idjurnal` = $mow->id")->result();
				foreach ($datadetail as $row) {
					$data = array(
						'no_trans' => $create_queue_id,
						'id_biaya' => $row->akun,
						'tanggal' => $row->date,
						'divisi' => 0,
						'debet' => $row->debit,
						'kredit' => $row->kredit,
						'ket' => $this->input->post('memo'),
						'branch' => $branch,
						'area' => $area,
					);
					$this->db->insert('finance_coa_general_ledger_detail', $data);
					$this->m_global->update_jurnal_bulanan($row->akun, $row->date, $branch, $area);
					$this->m_global->update_jurnal_harian($row->akun, $row->date, $branch, $area);
				}
			}
		}
	}

	function select_card()
	{
		$data = '<option value=""></option><option value="0">No Card</option>';
		$this->db->where("coa", $this->input->post('tambah_account_id'));
		$this->db->order_by('nama', 'asc');
		$q = $this->db->get('finance_coa_card_name');
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data .= '<option value="' . $r['id'] . '" >' . $r['nama'] . '</option>';
			}
		}
		$q->free_result();

		return $data;
	}

	function select_card_name()
	{
		$data = '';
		$this->db->where("id", $this->input->post('id'));
		$q = $this->db->get('finance_coa_card_name');
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data .= $r['nama'];
			}
		}
		$q->free_result();

		return $data;
	}
	function get_card()
	{
		$id = $this->input->post('id');
		$data = null;
		if (!empty($id)) {
			$q = $this->db->query("SELECT a.id,CONCAT(a.code_card,' - ',a.nama ) AS card FROM `gmd_finance_coa_card_name` a WHERE a.`coa`=$id")->result();

			if (!empty($q)) {
				foreach ($q as $row) {
					$data .= '<option value="' . $row->id . '"> ' . $row->card . '</option>';
				}
			}
		}

		echo $data;
	}
}
