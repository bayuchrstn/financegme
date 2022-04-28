<?php
class Model_finance_report_invoice_customer extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function get_data_table()
	{
		$db = $this->load->database('erp_gmedia', TRUE);
		$first = $end = $kondisi = $ppn = $kondisi2 = null;
		$first = $this->input->post('searchDateFirst');
		$end = $this->input->post('searchDateFinish');
		if (!empty($first) && !empty($end)) {
			$kondisi .= " AND (a.`tanggal_invoice` BETWEEN '" . $first . "' AND '" . $end . "')";
		}
		if ($this->input->post('searchppn') != '') {
			if ($this->input->post('searchppn') == 0) {
				$ppn = 'WHERE x.ppn = 0';
			} else {
				$ppn = 'WHERE x.ppn > 0';
			}
		} else {
			$kondisi2 .= " WHERE (a.`tanggal_invoice` BETWEEN '" . $first . "' AND '" . $end . "')";
		}

		if ($this->input->post('searchstt_inv') != '') {
			$kondisi .= " AND a.`lunas` = " . $this->input->post('searchstt_inv');
			$kondisi2 .= " AND a.`lunas` = " . $this->input->post('searchstt_inv');
		}
		$tanggal = date('Y-m-d');
		$q = $db->query("SELECT * FROM (SELECT * FROM (SELECT
		  DATE_FORMAT(a.`tanggal_invoice`, '%d-%m-%Y') AS date_invoicenya,
		  DATE_FORMAT(a.`due_date`, '%d-%m-%Y') AS date_duenya,
		  b.`idcust`,
		  (a.`jml_piutang` - a.`jml_bayar`) AS piutang,
		  b.`nama` AS nama_cust,
		  c.`nama` AS nama_site,
		  IF(c.`alamat` = '', c.`alamat2`, c.`alamat3`) AS alamat,
		  c.`phonewakil`,
		  0 AS pph2223,
		  a.`jml_bayar` AS bayar,
		  a.`nomor`,
		  0 AS mf,
		  SUM(a.`bw`) AS bw,
		  CASE
			WHEN SUM(a.`materai`) >= 6000
			THEN SUM(a.`lain2`) + 6000
			WHEN SUM(a.`materai`) < 6000
			THEN SUM(a.`lain2`) + SUM(a.`materai`)
		  END AS lain2,
		  SUM(a.`ppn2`) AS ppn,
		  SUM(a.`instalasi`) AS instalasi,
		  CASE
			WHEN SUM(a.`materai`) >= 6000
			THEN SUM(a.`bw`) + SUM(a.`lain2`) + SUM(a.`ppn2`) + SUM(a.`instalasi`) + 6000
			WHEN SUM(a.`materai`) < 6000
			THEN SUM(a.`bw`) + SUM(a.`lain2`) + SUM(a.`ppn2`) + SUM(a.`instalasi`) + SUM(a.`materai`)
		  END AS total,
		  DATEDIFF('2019-09-23', a.`due_date`) AS aging
		FROM
		  (SELECT
			a.*,
			CASE
			  WHEN c.`jenis_transaksi` = 'LG'
			  THEN c.`nominal`
			  ELSE 0
			END AS bw,
			CASE
			  WHEN c.`jenis_transaksi` = 'PN'
			  THEN c.`nominal`
			  ELSE 0
			END AS ppn2,
			CASE
			  WHEN c.`jenis_transaksi` = 'BI'
			  THEN c.`nominal`
			  ELSE 0
			END AS instalasi,
			CASE
			  WHEN c.`jenis_transaksi` = 'MT'
			  THEN c.`nominal`
			  ELSE 0
			END AS materai,
			CASE
			  WHEN c.`jenis_transaksi` = 'LG'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'PN'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'BI'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'MT'
			  THEN 0
			  ELSE c.`nominal`
			END AS lain2
		  FROM
			arpost a
			LEFT JOIN ms_site b
			  ON a.`id_site` = b.`id`
			LEFT JOIN transaksi c
			  ON a.`nomor` = c.`nomor`
			  AND a.`id_order` = c.`id_order`
		  WHERE a.`status` = 1
			AND c.`status` = 1
			AND a.`merge` IS NULL $kondisi ) a
		  LEFT JOIN `ms_customers` `b`
			ON `a`.`id_cust` = `b`.`id`
		  LEFT JOIN `ms_site` `c`
			ON `a`.`id_site` = `c`.`id`
		GROUP BY a.`id` ) x $ppn
		UNION ALL
		SELECT x.`date_invoicenya`,x.`date_duenya`,
		  x.`idcust`,
		  (a.`jml_piutang` - a.`jml_bayar`) AS piutang,
		  x.`nama_cust`,
		  x.`nama_site`,
		  x.`alamat`,
		  x.`phonewakil`,
		  x.`pph2223`,
		  a.`jml_bayar` AS bayar,
		  a.`nomor`,
		  x.`mf`,
		  x.`bw`,
		  x.`lain2`,
		  x.`ppn`,
		  x.`instalasi`,
		  x.`total`,
		  x.`aging` FROM ( 
		SELECT
		b.`id_arpost_merge`,
		  DATE_FORMAT(a.`tanggal_invoice`, '%d-%m-%Y') AS date_invoicenya,
		  DATE_FORMAT(a.`due_date`, '%d-%m-%Y') AS date_duenya,
		  d.`idcust`,
		  d.`nama` AS nama_cust,
		  c.`nama` AS nama_site,
		  IF(c.`alamat` = '', c.`alamat2`, c.`alamat3`) AS alamat,
		  c.`phonewakil`,
		  0 AS pph2223,
		  a.`jml_bayar` AS bayar,
		  a.`nomor`,
		  0 AS mf,
		  SUM(p.`bw`) AS bw,
		  CASE
			WHEN SUM(p.`materai`) >= 6000
			THEN SUM(p.`lain2`) + 6000
			WHEN SUM(p.`materai`) < 6000
			THEN SUM(p.`lain2`) + SUM(p.`materai`)
		  END AS lain2,
		  SUM(p.`ppn`) AS ppn,
		  SUM(p.`instalasi`) AS instalasi,
		  CASE
			WHEN SUM(p.`materai`) >= 6000
			THEN SUM(p.`bw`) + SUM(p.`lain2`) + SUM(p.`ppn`) + SUM(p.`instalasi`) + 6000
			WHEN SUM(p.`materai`) < 6000
			THEN SUM(p.`bw`) + SUM(p.`lain2`) + SUM(p.`ppn`) + SUM(p.`instalasi`) + SUM(p.`materai`)
		  END AS total,
		  DATEDIFF('2019-09-23', a.`due_date`) AS aging	
		  FROM arpost a
		  LEFT JOIN arpost_merge b
		  ON a.`id`=b.`id_arpost`
		  LEFT JOIN ms_site c
		  ON a.`to_site`=c.`id`
		  LEFT JOIN ms_customers d
		  ON c.`id_cust`=d.`id`
	  LEFT JOIN
		(SELECT
		  z.`id`,
		  SUM(z.`bw`) AS bw,
		  CASE
			WHEN SUM(z.`materai`) >= 6000
			THEN 6000
			WHEN SUM(z.`materai`) < 6000
			THEN SUM(z.`materai`)
		  END AS materai,
		  SUM(z.`lain2`) AS lain2,
		  SUM(z.`ppn2`) AS ppn,
		  SUM(z.`instalasi`) AS instalasi,
		  SUM(z.`bw`) + SUM(z.`lain2`) + SUM(z.`ppn2`) + SUM(z.`instalasi`) AS total,
		  z.`jml_bayar`,
		  z.`date_printed`,
		  z.`date_email`,
		  z.`date_faktur`,
		  z.`merge` AS status_merge
		FROM
		   (SELECT
			a.*,
			CASE
			  WHEN c.`jenis_transaksi` = 'LG'
			  THEN c.`nominal`
			  ELSE 0
			END AS bw,
			CASE
			  WHEN c.`jenis_transaksi` = 'PN'
			  THEN c.`nominal`
			  ELSE 0
			END AS ppn2,
			CASE
			  WHEN c.`jenis_transaksi` = 'BI'
			  THEN c.`nominal`
			  ELSE 0
			END AS instalasi,
			CASE
			  WHEN c.`jenis_transaksi` = 'MT'
			  THEN c.`nominal`
			  ELSE 0
			END AS materai,
			CASE
			  WHEN c.`jenis_transaksi` = 'LG'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'PN'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'BI'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'MT'
			  THEN 0
			  ELSE c.`nominal`
			END AS lain2
		  FROM
			arpost a
			 LEFT JOIN ms_site b
			  ON a.`id_site` = b.`id`
			 LEFT JOIN transaksi c 
			  ON a.`nomor` = c.`nomor`
			  AND a.`id_order` = c.`id_order`
		  WHERE a.`status` = 1
			AND c.`status` = 1
			AND a.`merge` = 1 $kondisi GROUP BY a.`id`) z GROUP BY z.`id` ) p
			ON b.`id_arpost`=p.`id` WHERE b.`status`=1
			GROUP BY b.`id_arpost_merge` ) x LEFT JOIN arpost a ON x.`id_arpost_merge`=a.`id` $ppn $kondisi2) fix ORDER BY fix.`date_invoicenya` ASC,fix.`nama_cust` ASC");
		$qn = $db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
		$data = array();
		$no = $_POST['start'];

		$gt_bw = 0;
		$gt_instalasi = 0;
		$gt_lain2 = 0;
		$gt_jumlah = 0;
		$gt_ppn = 0;
		$gt_pph2223 = 0;
		$gt_mf = 0;
		$gt_total = 0;
		$gt_invoice = 0;
		$gt_bayar = 0;
		$gt_piutang = 0;

		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$no++;
				$jumlah = $r['total'];
				$total = $jumlah - $r['ppn'] - $r['pph2223'];
				$row  = array(
					$no . '.',
					$r['date_invoicenya'],
					$r['nomor'],
					$r['nama_cust'],
					$r['idcust'],
					$r['nama_site'],
					number_format($r['bw'], 0),
					number_format($r['instalasi'], 0),
					number_format($r['lain2'], 0),
					number_format($r['ppn'], 0),
					number_format($jumlah, 0),
					number_format($r['ppn'], 0),
					number_format($r['pph2223'], 0), +number_format($r['mf'], 0),
					number_format($total, 0),
					number_format($jumlah, 0),
					number_format($r['bayar'], 0),
					number_format($r['piutang'], 0),
				);

				$gt_bw += $r['bw'];
				$gt_instalasi += $r['instalasi'];
				$gt_lain2 += $r['lain2'];
				$gt_jumlah += $jumlah;
				$gt_ppn += $r['ppn'];
				$gt_pph2223 += $r['pph2223'];
				$gt_mf += $r['mf'];
				$gt_total += $total;
				$gt_invoice += $jumlah;
				$gt_bayar += $r['bayar'];
				$gt_piutang += $r['piutang'];


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
			'<strong>Grand Total</strong>',
			'<strong>' . number_format($gt_bw, 0) . '</strong>',
			'<strong>' . number_format($gt_instalasi, 0) . '</strong>',
			'<strong>' . number_format($gt_lain2, 0) . '</strong>',
			'<strong>' . number_format($gt_ppn, 0) . '</strong>',
			'<strong>' . number_format($gt_jumlah, 0) . '</strong>',
			'<strong>' . number_format($gt_ppn, 0) . '</strong>',
			'<strong>' . number_format($gt_pph2223, 0) . '</strong>',
			'<strong>' . number_format($gt_mf, 0) . '</strong>',
			'<strong>' . number_format($gt_total, 0) . '</strong>',
			'<strong>' . number_format($gt_invoice, 0) . '</strong>',
			'<strong>' . number_format($gt_bayar, 0) . '</strong>',
			'<strong>' . number_format($gt_piutang, 0) . '</strong>',
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

	function produk()
	{
		$q = $this->db->query("select a.*, b.name as nama_category from gmd_product a
		left join gmd_product_category b on a.category = b.code
		order by b.name asc, a.name asc");
		return $q;
	}

	function kategori()
	{
		$q = $this->db->query("select * from gmd_master where category = 'customer_type'
		order by name asc");
		return $q;
	}
}
