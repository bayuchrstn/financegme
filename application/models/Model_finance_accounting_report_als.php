<?php
class Model_finance_accounting_report_als extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function get_data_table()
	{
		$tanggal_awal = date('Y-m-d');
		$tanggal_akhir = date('Y-m-d');
		if ($this->input->post('searchTanggal') == '1') {
			$tanggal_awal = $this->input->post('searchDateFirst');
			$tanggal_akhir = $this->input->post('searchDateFinish');
		} elseif ($this->input->post('searchTanggal') == '3') {
			$tanggal_awal = $this->input->post('searchDateFinish2');
			$tanggal_akhir = $this->input->post('searchDateFinish2');
		}

		$this->db->select("DATE_FORMAT(b.tanggal, '%d-%m-%Y') AS tanggalnya,
		  a.no_trans,
		  a.id_biaya,
		  b.jurnal_group,
		  a.ket,
		  b.deskripsi,
		  IF(c.tukar = 0, a.debet, a.kredit) AS penambahana,
		  IF(c.tukar = 1, a.debet, a.kredit) AS pengurangana,
		  a.debet AS penambahan,
		  a.kredit AS pengurangan", false);
		$this->db->from('finance_coa_general_ledger_detail a');
		$this->db->group_start();
		$this->db->like('IFNULL(a.ket,"")', $this->input->post('search_keyword'));
		$this->db->group_end();
		if ($this->input->post('id_biaya') != '') {
			$this->db->where('a.id_biaya', $this->input->post('id_biaya'));
		}
		if ($this->input->post('id_card') != '') {
			$this->db->where('a.card_id', $this->input->post('id_card'));
		}
		$this->db->where("(a.tanggal BETWEEN '" . $this->input->post('searchDateFirst') . "' AND '" . $this->input->post('searchDateFinish') . "')", NULL, FALSE);
		$this->db->order_by('a.tanggal', 'asc');
		$this->db->order_by('b.id', 'asc');
		$this->db->order_by('b.jurnal_group', 'asc');
		$this->db->order_by('b.no_trans', 'asc');


		$this->db->where('a.branch', $this->m_global->cek_id_regional($this->session->userdata('scope_area')));
		$this->db->join('finance_coa_general_ledger b', 'a.no_trans = b.no_trans', 'left');
		$this->db->join('finance_coa c', 'a.id_biaya = c.id', 'left');
		$q = $this->db->get();
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
		$data = array();
		$no = $_POST['start'];

		$saldo = 0;
		if ($this->input->post('id_biaya') != '') {
			$saldo += $this->saldo_awal();
		}
		$saldo_awal = $saldo;
		$row  = array(
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'<strong>' . number_format($saldo_awal, 2) . '</strong>',
		);


		$data[] = $row;

		$penambahan = 0.00;
		$pengurangan = 0.00;
		if ($q->num_rows() > 0) {
			$page_uri = base_url() . 'finance_coa_general_ledger/index/';
			foreach ($q->result_array() as $r) {

				$no++;
				$penambahan += $r['penambahan'];
				$pengurangan += $r['pengurangan'];
				if ($this->input->post('id_biaya') != '') {
					$saldo += $r['penambahan'] - $r['pengurangan'];
				}
				$row  = array(
					$no . '.',
					$r['tanggalnya'],
					'<a href="' . $page_uri . $r['no_trans'] . '" target="blank" class="text-primary-800">' . $r['no_trans'] . '</a>',
					$r['jurnal_group'],
					$r['deskripsi'],
					$r['ket'],
					number_format($r['penambahan'], 2),
					number_format($r['pengurangan'], 2),
					number_format($saldo, 2),
				);

				$data[] = $row;
			}
		}
		$q->free_result();

		$row  = array(
			'',
			'',
			'',
			'',
			'',
			'',
			'<strong>' . number_format($penambahan, 2) . '</strong>',
			'<strong>' . number_format($pengurangan, 2) . '</strong>',
			'<strong>' . number_format($saldo, 2) . '</strong>',
		);


		$data[] = $row;

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $n,
			"recordsFiltered" => $n,
			"data" => $data,
		);
		echo json_encode($output);
	}

	function saldo_awal()
	{
		$data = 0.00;

		$branch = $this->m_global->cek_id_regional($this->session->userdata('scope_area'));
		$tanggal_awal_tahun = date("Y-01-01", strtotime($this->input->post('searchDateFirst')));
		$tanggal_akhir = $this->input->post('searchDateFinish');
		$tanggal_awal = $this->input->post('searchDateFirst');
		$tanggal_akhir1 = date("Y-m-d", strtotime("+1 month", strtotime($tanggal_akhir)));

		if ($this->cek_kelompok($this->input->post('id_biaya')) == 1) {
			$tanggal_awal_tahun = '2000-01-01';
		}

		$this->db->select("coalesce(b.saldo, 0.00) as saldo", false);
		$this->db->from('finance_coa a');
		$this->db->join('finance_coa_saldo b', "a.id = b.id_biaya AND b.branch = '" . $branch . "'", 'left');
		$this->db->where("a.id", $this->input->post('id_biaya'));
		if ($this->input->post('id_card') != '') {
			$this->db->where('b.card_id', $this->input->post('id_card'));
		}
		$this->db->where('b.tanggal >=', $tanggal_awal_tahun);
		$this->db->where('b.tanggal <', $tanggal_akhir);
		$this->db->group_by('a.id');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data += $r['saldo'];
			}
		}

		// $this->db->select("SUM(a.debet) as saldo_debet, SUM(a.kredit) as saldo_kredit", false);
		// $this->db->where('a.id_biaya', $this->input->post('id_biaya'));
		// $this->db->where('a.bulan >=', $tanggal_awal_tahun);
		// $this->db->where('a.bulan <', $tanggal_akhir);
		// $this->db->where('a.branch', $branch);
		// $q = $this->db->get('finance_coa_general_ledger_monthly a');
		$this->db->select("SUM(a.debet) as saldo_debet, SUM(a.kredit) as saldo_kredit", false);
		$this->db->where('a.id_biaya', $this->input->post('id_biaya'));
		if ($this->input->post('id_card') != '') {
			$this->db->where('a.card_id', $this->input->post('id_card'));
		}
		$this->db->where('a.tanggal >=', $tanggal_awal_tahun);
		$this->db->where('a.tanggal <', $tanggal_awal);
		$this->db->where('a.branch', $branch);
		$q = $this->db->get('finance_coa_general_ledger_detail a');
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				//if($tukar == '1'){$data += $r['saldo_kredit'] - $r['saldo_debet'];}
				//else{$data += $r['saldo_debet'] - $r['saldo_kredit'];}
				$data += $r['saldo_debet'] - $r['saldo_kredit'];
			}
		}
		return $data;
	}

	function saldo()
	{
		$this->db->select("DATE_FORMAT(b.tanggal, '%d-%m-%Y') AS tanggalnya,
		  a.no_trans,
		  a.id_biaya,
		  b.jurnal_group,
		  a.ket,
		  IF(c.tukar = 0, a.debet, a.kredit) AS penambahana,
		  IF(c.tukar = 1, a.debet, a.kredit) AS pengurangana,
		  a.debet AS penambahan,
		  a.kredit AS pengurangan", false);
		$this->db->from('finance_coa_general_ledger_detail a');
		$this->db->group_start();
		$this->db->like('a.ket', $this->input->post('search_keyword'));
		$this->db->group_end();
		$this->db->where('a.id_biaya', $this->input->post('id_biaya'));
		if ($this->input->post('id_card') != '') {
			$this->db->where('a.card_id', $this->input->post('id_card'));
		}
		$this->db->where("(a.tanggal BETWEEN '" . $this->input->post('searchDateFirst') . "' AND '" . $this->input->post('searchDateFinish') . "')", NULL, FALSE);
		$this->db->order_by('a.tanggal', 'asc');
		$this->db->order_by('a.no_trans', 'asc');
		$this->db->where('a.branch', $this->m_global->cek_id_regional($this->session->userdata('scope_area')));
		$this->db->join('finance_coa_general_ledger b', 'a.no_trans = b.no_trans', 'left');
		$this->db->join('finance_coa c', 'a.id_biaya = c.id', 'left');
		$q = $this->db->get();
		return $q;
	}

	function cek_kelompok($id)
	{
		$data = 0;

		$this->db->where('id', $id);
		$q = $this->db->get('finance_coa');
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				if ($r['kelompok'] == '1' || $r['kelompok'] == '2' || $r['kelompok'] == '3') {
					$data = 1;
				}
			}
		}

		return $data;
	}

	function get_card()
	{
		$id = $this->input->post('id');
		$data = null;
		$q = $this->db->query("SELECT a.id,CONCAT(a.code_card,' - ',a.nama ) AS card FROM `gmd_finance_coa_card_name` a WHERE a.`coa`=$id")->result();

		if (!empty($q)) {
			foreach ($q as $row) {
				$data .= '<option value="' . $row->id . '"> ' . $row->card . '</option>';
			}
		}
		echo $data;
	}
}
