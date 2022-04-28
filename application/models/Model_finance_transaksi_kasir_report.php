<?php
class Model_finance_transaksi_kasir_report extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function get_data_table()
	{
		set_time_limit(0);
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
		SQL_CALC_FOUND_ROWS *,
		DATE_FORMAT(kasnya.`tanggal`, '%d-%m-%Y') AS tanggalnya,
		kasnya.urutan
	  FROM
	  (SELECT
    a.id AS idnya,
	a.nomor,
	RIGHT(a.`nomor`, 10) AS urutan,
	b.id_card,
    b.id_coa AS coa,
	c.code_card,
	c.nama AS card_name,
    a.tanggal,
	a.insert_at,
    b.`memo` AS ket,
	b.`id` AS id_det,
    IF(a.tipe = 1, b.nominal, 0.00) AS saldo_m,
    IF(a.tipe = 0, b.nominal, 0.00) AS saldo_k FROM
	gmd_finance_transaksi_kasir a
    JOIN gmd_finance_transaksi_kasir_detail b ON a.`id`=b.`id_kasir`
	JOIN gmd_finance_coa_card_name c ON b.id_card=c.id
		  WHERE  a.status=1 AND b.status=1 AND a.branch = '" . $this->input->post('searchKasBank') . "'
			AND (
			  tanggal BETWEEN '" . $tanggal_awal . "' AND '" . $tanggal_akhir . "'
			)
		) AS kasnya 
		ORDER BY kasnya.insert_at ASC,kasnya.id_det ASC,kasnya.urutan ASC, kasnya.saldo_m DESC, kasnya.saldo_k ASC");
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
		$data = array();
		$no = $_POST['start'];

		$saldo = $this->saldo_awal();
		$saldo_awal = $saldo;
		// $row  = array(
		// 	'',
		// 	'',
		// 	'',
		// 	'',
		// 	'',
		// 	'<strong>Saldo Awal (' . $this->m_global->finance_bank_name($this->input->post('searchKasBank')) . ')</strong>',
		// 	'',
		// 	'',
		// 	'<strong>' . number_format($saldo_awal, 2) . '</strong>',
		// );
		$row  = array(
			'',
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



		// $data[] = $row;
		$total_masuk = 0.00;
		$total_keluar = 0.00;
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$no++;
				$masuk = $r['saldo_m'];
				$keluar = $r['saldo_k'];

				$total_masuk += $masuk;
				$total_keluar += $keluar;

				$saldo += ($masuk - $keluar);
				$row  = array(
					$no . '.',
					date('d-M-Y', strtotime($r['tanggal'])),
					$r['nomor'],
					$r['coa'],
					$r['code_card'],
					$r['card_name'],
					$r['ket'],
					number_format($masuk, 2),
					number_format($keluar, 2),
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
			'',
			'',
			'<b>PENGELUARAN</b>',
			'<strong>' . number_format($total_keluar, 2) . '</strong>',
		);


		$data[] = $row;


		$row  = array(
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'<b>SALDO AKHIR TUNAI</b>',
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
		set_time_limit(0);
		$data = 0.00;
		$tanggal_awal = date('Y-m-d');
		if ($this->input->post('searchTanggal') == '1') {
			$tanggal_awal = $this->input->post('searchDateFirst');
		} elseif ($this->input->post('searchTanggal') == '3') {
			$tanggal_awal = $this->input->post('searchDateFinish2');
		}

		$q = $this->db->query("SELECT
		SUM(kasnya.saldo_m - kasnya.saldo_k) AS saldo
	  FROM
	  (SELECT
    a.id AS idnya,
    a.tanggal,
    b.memo AS ket,
    IF(a.tipe = 1, b.`nominal`, 0.00) AS saldo_m,
    IF(a.tipe = 0, b.`nominal`, 0.00) AS saldo_k
  FROM
    gmd_finance_transaksi_kasir a
    JOIN `gmd_finance_transaksi_kasir_detail` b ON a.`id`=b.`id_kasir`
		  WHERE  a.status=1 AND b.status=1
			AND a.tanggal < '" . $tanggal_awal . "'
			AND a.branch = '" . $this->input->post('searchKasBank') . "'
			) AS kasnya 
		ORDER BY kasnya.tanggal ASC ");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data += $r['saldo'];
			}
		}
		return $data;
	}

	function saldo_detail()
	{
		set_time_limit(0);
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
			AND branch = '" . $this->m_global->cek_id_regional($this->session->userdata('scope_area')) . "'
			AND (
			  tanggal BETWEEN '" . $tanggal_awal . "' AND '" . $tanggal_akhir . "'
			)
		) AS kasnya 
		ORDER BY tanggal ASC, saldo_m DESC, saldo_k ASC ");
		return $q;
	}
}
