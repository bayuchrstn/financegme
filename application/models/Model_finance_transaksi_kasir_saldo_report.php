<?php
class Model_finance_transaksi_kasir_saldo_report extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function saldo_awal($id)
	{
		$data = 0.00;
		$tanggal_awal = date('Y-m-d');
		if ($this->input->post('searchTanggal') == '1') {
			$tanggal_awal = $this->input->post('searchDateFirst');
		} elseif ($this->input->post('searchTanggal') == '3') {
			$tanggal_awal = $this->input->post('searchDateFinish2');
		}

		$q = $this->db->query("SELECT 
		  SUM(saldo_m - saldo_k) AS saldo 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE tanggal < '" . $tanggal_awal . "'
			AND branch = '" . $id . "' AND status=1
			) AS kasnya 
		ORDER BY tanggal ASC ");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data += $r['saldo'];
			}
		}
		return $data;
	}

	function debet($id)
	{
		$data = 0.00;
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
			SUM(IF(tipe = 1, jumlah, 0.00)) AS saldo
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE (
			  tanggal BETWEEN '" . $tanggal_awal . "' AND '" . $tanggal_akhir . "'
			)
			AND branch = '" . $id . "' AND status=1
			");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data += $r['saldo'];
			}
		}
		return $data;
	}

	function kredit($id)
	{
		$data = 0.00;
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
			SUM(IF(tipe = 0, jumlah, 0.00)) AS saldo
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE (
			  tanggal BETWEEN '" . $tanggal_awal . "' AND '" . $tanggal_akhir . "'
			)
			AND branch = '" . $id . "' AND status=1
			");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data += $r['saldo'];
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
		  WHERE branch = '" . $this->input->post('searchKasBank') . "'
			AND (
			  tanggal BETWEEN '" . $tanggal_awal . "' AND '" . $tanggal_akhir . "' AND status=1
			)
		) AS kasnya 
		ORDER BY tanggal ASC, saldo_m DESC, saldo_k ASC ");
		return $q;
	}
}
