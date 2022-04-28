<?php
class Model_finance_invoice_report_bayar extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function get_data_table()
	{
		$keyword = $guna = $tanggal = null;
		$keyword = $this->input->post('search_keyword');
		$guna = $this->input->post('searchguna');

		$tanggal = " AND (x.`tanggal_invoice` BETWEEN '" . $this->input->post('searchDateFirst') . "' AND '" . $this->input->post('searchDateFinish') . "')";

		$q = $this->db->query("SELECT * FROM (SELECT
		z.`id`,
		z.`nomor`,
		z.`nama_site`,
		z.`idcust`,
		z.`tanggalnya`,
		SUM(z.`ppnnya`) AS ppn,
		SUM(z.`nominal`) AS invoice,
		z.`jml_bayar` AS bayar,
		z.`tanggal_invoice`,
		z.`status`
	  FROM
		(SELECT
		  a.`id`,
		  a.`nomor`,
		  CASE
			WHEN e.`jenis_transaksi` = 'PN'
			THEN e.`nominal`
			ELSE 0
		  END AS ppnnya,
		  e.`nominal`,
		  c.`nama` AS nama_site,
		  d.`idcust`,
		  DATE_FORMAT(a.`tanggal_invoice`, '%d-%m-%Y') AS tanggalnya,
		  b.`jml_bayar`,
		  a.`tanggal_invoice`,
		  a.`status`
		FROM
		  erp_gmedia.`arpost` a
		  JOIN erp_gmedia.`billing` b
			ON a.`id` = b.`id_arpost`
		  JOIN erp_gmedia.`ms_site` c
			ON a.`id_site` = c.`id`
		  JOIN erp_gmedia.`ms_customers` d
			ON c.`id_cust` = d.`id`
		  JOIN erp_gmedia.`transaksi` e
			ON a.`nomor` = e.`nomor`
			AND a.`id_order` = e.`id_order`
		WHERE a.`id_order` IS NOT NULL
		  AND a.`status` = 1
		  AND e.`status` = 1) z
	  GROUP BY z.`id`
	  UNION ALL
	  SELECT
		z.`id`,
		z.`nomor`,
		z.`nama_site`,
		z.`idcust`,
		z.`tanggalnya`,
		SUM(z.`ppnnya`) AS ppn,
		SUM(z.`nominal`) AS invoice,
		z.`jml_bayar` AS bayar,
		z.`tanggal_invoice`,
		z.`status` FROM (
	  SELECT
		  b.`id_arpost_merge`,
		  c.`id`,
		  c.`nomor`,
		  CASE
			WHEN f.`jenis_transaksi` = 'PN'
			THEN f.`nominal`
			ELSE 0
		  END AS ppnnya,
		  f.`nominal`,
		  e.`nama` AS nama_site,
		  e.`idcust`,
		  DATE_FORMAT(c.`tanggal_invoice`, '%d-%m-%Y') AS tanggalnya,
		  a.`jml_bayar`,
		  c.`tanggal_invoice`,
		  c.`status`
		  FROM erp_gmedia.`billing` a
		  JOIN erp_gmedia.`arpost_merge` b
		  ON a.`id_arpost`=b.`id_arpost_merge`
		  JOIN erp_gmedia.`arpost` c
		  ON b.`id_arpost`=c.`id`
		  JOIN erp_gmedia.`ms_site` d
		  ON c.`to_site`=d.`id`
		  JOIN erp_gmedia.`ms_customers` e
		  ON d.`id_cust`=e.`id`
		  JOIN erp_gmedia.`transaksi` f
		  ON f.`id_order`=c.`id_order` AND c.`nomor`=f.`nomor`
		  ) z GROUP BY z.`id_arpost_merge`) x WHERE x.`status` != 9 AND (x.`nama_site` LIKE '%$keyword%' ESCAPE '!' OR 
			x.`nomor` LIKE '%$keyword%' ESCAPE '!' OR x.`idcust` LIKE '%$keyword%' ESCAPE '!') $tanggal ORDER BY x.`tanggal_invoice` ASC");

		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
		$data = array();
		$no = $_POST['start'];

		$total = $bayar = 0;
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				if (!empty($guna)) {
					if ($guna == 1) {
						$no++;
						$total += $r['invoice'];
						$bayar += $r['bayar'];
						$row  = array(
							$no . '.',
							$r['tanggalnya'],
							$r['nomor'],
							$r['nama_site'],
							$r['idcust'],
							number_format($r['invoice'], 0),
							'INVOICE',
							number_format($r['bayar'], 0),
						);
						$data[] = $row;
					} else if ($guna == 2) {
						$no++;
						$total += $r['ppn'];
						$bayar += $r['bayar'];
						$row  = array(
							$no . '.',
							$r['tanggalnya'],
							$r['nomor'],
							$r['nama_site'],
							$r['idcust'],
							number_format($r['ppn'], 0),
							'PPN',
							number_format($r['bayar'], 0),
						);
						$data[] = $row;
					}
				} else {
					$no++;
					$total += $r['invoice'];
					$bayar += $r['bayar'];
					$row  = array(
						$no . '.',
						$r['tanggalnya'],
						$r['nomor'],
						$r['nama_site'],
						$r['idcust'],
						number_format($r['invoice'], 0),
						'INVOICE',
						number_format($r['bayar'], 0),
					);
					$data[] = $row;

					// $no++;
					// $total += $r['ppn'];
					// $bayar += $r['bayar'];
					// $row  = array(
					// 	$no . '.',
					// 	$r['tanggalnya'],
					// 	$r['nomor'],
					// 	$r['nama_site'],
					// 	$r['idcust'],
					// 	number_format($r['ppn'], 0),
					// 	'PPN',
					// 	number_format($r['bayar'], 0),
					// );
					// $data[] = $row;
				}
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
			'',
			'<strong>' . number_format($bayar, 0) . '</strong>',
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
}
