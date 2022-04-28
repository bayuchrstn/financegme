<?php
class Model_finance_tax_report_saldo extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function get_data_table()
	{
		$q = $this->db->query("SELECT
		  SQL_CALC_FOUND_ROWS *, DATE_FORMAT(tanggal, '%d-%m-%Y') AS tanggalnya
		FROM
		  (SELECT
			id, tipe, tanggal_faktur AS tanggal, jumlah as debet, 0 as kredit, CONCAT(no_seri_faktur, ' - ', nama_pkp) AS deskripsi
		  FROM
			gmd_finance_transaksi_tax
		  WHERE (
			  tanggal_faktur BETWEEN '" . $this->input->post('searchDateFirst') . "'
			  AND '" . $this->input->post('searchDateFinish') . "'
			)
			AND tax_type = '" . $this->input->post('searchtax_type') . "'
			AND msa = '" . $this->input->post('searchmsa') . "'
			AND tipe = '0'
			AND branch = '" . $this->model_global->cek_id_regional($this->session->userdata('scope_area')) . "'
		  UNION
		  ALL
		  SELECT
			a.id, a.tipe, a.tanggal_faktur AS tanggal, 0 as debet, a.jumlah as kredit, CONCAT(a.no_seri_faktur, ' - ', a.nama_pkp) AS deskripsi
		  FROM
			gmd_finance_transaksi_tax a
			LEFT JOIN gmd_finance_master_cat_tax_type b ON a.tax_type = b.id
		  WHERE (
			  a.tanggal_faktur BETWEEN '" . $this->input->post('searchDateFirst') . "'
			  AND '" . $this->input->post('searchDateFinish') . "'
			)
			AND a.tax_type = '" . $this->input->post('searchtax_type') . "'
			AND a.msa = '" . $this->input->post('searchmsa') . "'
			AND a.tipe = '1'
			AND b.ignore_masukan = '0'
			AND a.branch = '" . $this->model_global->cek_id_regional($this->session->userdata('scope_area')) . "'
		  UNION
		  ALL
		  SELECT
			id, '2' AS tipe, tanggal, 0 as debet, jumlah as kredit, CONCAT('Pembayaran') AS deskripsi
		  FROM
			gmd_finance_transaksi_tax_billing
		  WHERE (
			  tanggal BETWEEN '" . $this->input->post('searchDateFirst') . "'
			  AND '" . $this->input->post('searchDateFinish') . "'
			)
			AND tax_type = '" . $this->input->post('searchtax_type') . "'
			AND msa = '" . $this->input->post('searchmsa') . "'
			AND branch = '" . $this->model_global->cek_id_regional($this->session->userdata('scope_area')) . "') AS sp
		ORDER BY sp.tanggal ASC, sp.tipe ASC, sp.id ASC");
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
		$data = array();
		$no = $_POST['start'];

		$saldo = $this->saldo_awal();
		$saldo_awal = $saldo;
		$row  = array(
			'',
			'',
			'<strong>Saldo Awal</strong>',
			'',
			'',
			'<strong>' . number_format($saldo_awal, 0) . '</strong>',
		);

		$data[] = $row;

		$debet = 0;
		$kredit = 0;
		$total = $saldo_awal;
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$no++;
				$debet += $r['debet'];
				$kredit += $r['kredit'];
				$total += $r['debet'] - $r['kredit'];
				$row  = array(
					$no . '.',
					$r['tanggalnya'],
					$r['deskripsi'],
					number_format($r['debet'], 0),
					number_format($r['kredit'], 0),
					number_format($total, 0),
				);


				$data[] = $row;
			}
		}
		$q->free_result();
		$row  = array(
			'',
			'',
			'Saldo Akhir',
			'<strong>' . number_format($debet, 0) . '</strong>',
			'<strong>' . number_format($kredit, 0) . '</strong>',
			'<strong>' . number_format($total, 0) . '</strong>',
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
		$data = 0;
		$q = $this->db->query("SELECT
		  SQL_CALC_FOUND_ROWS *, DATE_FORMAT(tanggal, '%d-%m-%Y') AS tanggalnya
		FROM
		  (SELECT
			id, tipe, tanggal_faktur AS tanggal, jumlah as debet, 0 as kredit, CONCAT(no_seri_faktur, ' - ', nama_pkp) AS deskripsi
		  FROM
			gmd_finance_transaksi_tax
		  WHERE tanggal_faktur < '" . $this->input->post('searchDateFirst') . "'
			AND tax_type = '" . $this->input->post('searchtax_type') . "'
			AND tipe = '0'
			AND msa = '" . $this->input->post('searchmsa') . "'
			AND branch = '" . $this->model_global->cek_id_regional($this->session->userdata('scope_area')) . "'
		  UNION
		  ALL
		  SELECT
			a.id, a.tipe, a.tanggal_faktur AS tanggal, 0 as debet, a.jumlah as kredit, CONCAT(a.no_seri_faktur, ' - ', a.nama_pkp) AS deskripsi
		  FROM
			gmd_finance_transaksi_tax a
			LEFT JOIN gmd_finance_master_cat_tax_type b ON a.tax_type = b.id
		  WHERE a.tanggal_faktur < '" . $this->input->post('searchDateFirst') . "'
			AND a.tax_type = '" . $this->input->post('searchtax_type') . "'
			AND a.tipe = '1'
			AND b.ignore_masukan = '0'
			AND a.msa = '" . $this->input->post('searchmsa') . "'
			AND a.branch = '" . $this->model_global->cek_id_regional($this->session->userdata('scope_area')) . "'
		  UNION
		  ALL
		  SELECT
			id, '2' AS tipe, tanggal, 0 as debet, jumlah as kredit, CONCAT('Pembayaran') AS deskripsi
		  FROM
			gmd_finance_transaksi_tax_billing
		  WHERE tanggal < '" . $this->input->post('searchDateFirst') . "'
			AND tax_type = '" . $this->input->post('searchtax_type') . "'
			AND msa = '" . $this->input->post('searchmsa') . "'
			AND branch = '" . $this->model_global->cek_id_regional($this->session->userdata('scope_area')) . "') AS sp
		ORDER BY sp.tanggal ASC, sp.tipe ASC");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data += $r['debet'] - $r['kredit'];
			}
		}
		return $data;
	}

	function saldo_detail()
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
		$q = $this->db->query("SELECT 
		  *, date_format(tanggal, '%d-%m-%Y') as tanggalnya 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '" . $this->input->post('searchKasBank') . "'
			AND branch = '" . $this->model_global->cek_id_regional($this->session->userdata('scope_area')) . "'
			AND (
			  tanggal BETWEEN '" . $tanggal_awal . "' AND '" . $tanggal_akhir . "'
			)
		) AS kasnya 
		ORDER BY tanggal ASC, saldo_m DESC, saldo_k ASC ");
		return $q;
	}
}
