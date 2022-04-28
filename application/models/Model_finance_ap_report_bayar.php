<?php
class Model_finance_ap_report_bayar extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function get_data_table()
	{
		$kondisi = null;
		if ($this->input->post('search_keyword') != '') {
			$kondisi = " AND (c.`no_referensi` LIKE '%" . $this->input->post('search_keyword') . "%' OR b.nama LIKE '%$this->input->post('search_keyword')%')";
		}
		$q = $this->db->query("SELECT
		SQL_CALC_FOUND_ROWS a.*,
		DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya,
		c.no_referensi,
		IF(c.supplier = 0, 'Lain2', b.nama) AS nama_service,
		SUM(a.jumlah) AS jumlah,c.nomor,b.nama AS nama_perusahaan
	  FROM
		erp_financev2.`gmd_finance_ap_billing` `a`
		LEFT JOIN  erp_financev2.`gmd_finance_ap_invoice` `c`
		  ON `a`.`id_ap` = `c`.`id`
		LEFT JOIN  inventory_v2.`ms_perusahaan` `b`
		  ON `c`.`supplier` = `b`.`id_perusahaan`
	  WHERE (
		a.tanggal between '" . $this->input->post('searchDateFirst') . "' and '" . $this->input->post('searchDateFinish') . "'
		) $kondisi
	  GROUP BY `a`.`id`
	  ORDER BY `a`.`tanggal` ASC ");
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
		$data = array();
		$no = $_POST['start'];

		$total = 0;
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$no++;
				$total += $r['jumlah'];
				$row  = array(
					$no . '.',
					$r['tanggalnya'],
					$r['nomor'],
					$r['no_ref'],
					$r['nama_perusahaan'],
					number_format($r['jumlah'], 0),
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
}
