<?php
class Model_finance_dashboard extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function data_monthly()
	{
		set_time_limit(0);
		$year = $this->uri->segment(3);
		$month = $this->uri->segment(4);

		$tanggal_awal = date('' . $year . '-' . $month . '-01');
		$tanggal_akhir = date('' . $year . '-' . $month . '-t');

		$data = array();
		$net_profit = 0;
		//INCOME
		$q = $this->db->query("SELECT
			 COALESCE(SUM(a.`jml_bayar`),0) AS jumlah
			FROM
			  erp_gmedia.`billing` a
			WHERE (
				a.`tanggal` BETWEEN '" . $tanggal_awal . "'
				AND '" . $tanggal_akhir . "'
			  )");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data['total_income'] =  number_format($r['jumlah'], 0);
				$net_profit += $r['jumlah'];
			}
		}
		$q->free_result();
		//AR
		$q = $this->db->query("SELECT 
		COALESCE(
			SUM(z.jumlah) - SUM(COALESCE((SELECT SUM(jml_bayar)
				FROM
				  erp_gmedia.`billing` m
				WHERE m.`status`=1
				  AND m.`tanggal` <= '" . $tanggal_akhir . "'),0)),
			0
		  ) AS jumlah
		FROM (
		SELECT
		COALESCE(SUM(b.`nominal`),0) AS jumlah
		FROM
		  erp_gmedia.`arpost` a
		  JOIN erp_gmedia.`transaksi` b
		  ON a.`id_order`=b.`id_order` AND a.`nomor`=b.`nomor`
		WHERE a.`status`=1 AND b.`status`=1 AND a.`status_invoice` > 1 AND a.`tanggal_invoice`<= '" . $tanggal_akhir . "' AND a.`merge` IS NULL AND a.`id_order` IS NOT NULL
		  AND (
			a.`date_paid` = ''
			OR a.`date_paid` IS NULL
			OR a.`date_paid` > '" . $tanggal_akhir . "'
		  )
		  UNION ALL 
		  SELECT
		COALESCE(SUM(c.`nominal`),0) AS jumlah
		FROM
		  erp_gmedia.`arpost_merge` a
		  JOIN erp_gmedia.`arpost` b
		  ON a.`id_arpost`=b.`id`
		  JOIN erp_gmedia.`transaksi` c
		  ON b.`id_order`=c.`id_order` AND b.`nomor`=c.`nomor`
		WHERE a.`status`=1 AND b.`status`=1 AND c.`status`=1 AND b.`status_invoice` > 1 AND b.`tanggal_invoice` <= '" . $tanggal_akhir . "' AND b.`merge`=1
		  AND (
			b.`date_paid` = ''
			OR b.`date_paid` IS NULL
			OR b.`date_paid` > '" . $tanggal_akhir . "'
		  ) ) z");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data['accounts_receivable'] =  number_format($r['jumlah'], 0);
			}
		}
		$q->free_result();

		$tanggal = date('Y-m-d');
		$q = $this->db->query("SELECT DATEDIFF('" . $tanggal . "', a.`due_date`) as aging
		FROM
		erp_gmedia.`arpost` a
		WHERE a.`tanggal_invoice` <= '2019-09-30' AND a.`id_order` IS NULL AND a.`status_invoice` > 1
		AND (a.`date_paid` = '' OR a.`date_paid` IS NULL OR a.`date_paid` > '" . $tanggal_akhir . "')
		HAVING aging <= 30
		UNION ALL
		SELECT DATEDIFF('" . $tanggal . "', a.`due_date`) as aging
		FROM
		erp_gmedia.`arpost` a
		WHERE a.`tanggal_invoice` <= '2019-09-30' AND a.`status_invoice` > 1 AND a.`id_order` IS NOT NULL AND a.`merge` IS NULL
		AND (a.`date_paid` = '' OR a.`date_paid` IS NULL OR a.`date_paid` > '" . $tanggal_akhir . "')
		HAVING aging <= 30");
		$data['accounts_receivable_1'] =  $q->num_rows();
		$q->free_result();
		$q = $this->db->query("SELECT DATEDIFF('" . $tanggal . "', a.`due_date`) as aging
		FROM
		erp_gmedia.`arpost` a
		WHERE a.`tanggal_invoice` <= '2019-09-30' AND a.`status_invoice` > 1 AND a.`id_order` IS NULL
		AND (a.`date_paid` = '' OR a.`date_paid` IS NULL OR a.`date_paid` > '" . $tanggal_akhir . "')
		HAVING aging <= 60
		UNION ALL
		SELECT DATEDIFF('" . $tanggal . "', a.`due_date`) as aging
		FROM
		erp_gmedia.`arpost` a
		WHERE a.`tanggal_invoice` <= '2019-09-30' AND a.`status_invoice` > 1 AND a.`id_order` IS NOT NULL AND a.`merge` IS NULL
		AND (a.`date_paid` = '' OR a.`date_paid` IS NULL OR a.`date_paid` > '" . $tanggal_akhir . "')
		HAVING aging <= 60");
		$data['accounts_receivable_2'] =  $q->num_rows();
		$q->free_result();
		$q = $this->db->query("SELECT DATEDIFF('" . $tanggal . "', a.`due_date`) as aging
		FROM
		  erp_gmedia.`arpost` a
		WHERE a.`tanggal_invoice` <= '2019-09-30' AND a.`status_invoice` > 1 AND a.`id_order` IS NULL
		AND (a.`date_paid` = '' OR a.`date_paid` IS NULL OR a.`date_paid` > '" . $tanggal_akhir . "')
		HAVING aging >= 61
		UNION ALL
		SELECT DATEDIFF('" . $tanggal . "', a.`due_date`) as aging
		FROM
		erp_gmedia.`arpost` a
		WHERE a.`tanggal_invoice` <= '2019-09-30' AND a.`status_invoice` > 1 AND a.`id_order` IS NOT NULL AND a.`merge` IS NULL
		AND (a.`date_paid` = '' OR a.`date_paid` IS NULL OR a.`date_paid` > '" . $tanggal_akhir . "')
		HAVING aging >= 61");
		$data['accounts_receivable_3'] =  $q->num_rows();
		$q->free_result();
		//EXPENSES
		// $total_expenses = 0;
		// $q = $this->db->query("SELECT
		// 	 COALESCE(SUM(a.jumlah),0) AS jumlah
		// 	FROM
		// 	  gmd_finance_ap_billing a
		// 	WHERE (
		// 		a.tanggal BETWEEN '" . $tanggal_awal . "'
		// 		AND '" . $tanggal_akhir . "'
		// 	  )
		// 	  AND a.branch = '" . $this->model_global->cek_id_regional($this->session->userdata('scope_area')) . "'");
		// if ($q->num_rows() > 0) {
		// 	foreach ($q->result_array() as $r) {
		// 		$total_expenses += $r['jumlah'];
		// 		$net_profit -= $r['jumlah'];
		// 	}
		// }
		// $q->free_result();
		// $q = $this->db->query("SELECT
		// 	 COALESCE(SUM(a.jumlah),0) AS jumlah
		// 	FROM
		// 	  gmd_finance_transaksi_kasir a
		// 	  LEFT JOIN gmd_finance_fixcost_cat b ON a.fixcost_cat = b.id
		// 	WHERE (
		// 		a.tanggal BETWEEN '" . $tanggal_awal . "'
		// 		AND '" . $tanggal_akhir . "'
		// 	  )
		// 	  AND a.branch = '" . $this->model_global->cek_id_regional($this->session->userdata('scope_area')) . "'
		// 	  AND a.tipe = '0'
		// 	  AND b.hide_expenses = '0'");
		// if ($q->num_rows() > 0) {
		// 	foreach ($q->result_array() as $r) {
		// 		$total_expenses += $r['jumlah'];
		// 		$net_profit -= $r['jumlah'];
		// 	}
		// }
		// $q->free_result();
		// $data['total_expenses'] =  number_format($total_expenses, 0);
		//AP
		$q = $this->db->query("SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '" . $tanggal_akhir . "'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '" . $this->model_global->cek_id_regional($this->session->userdata('scope_area')) . "'
			AND a.tanggal <= '" . $tanggal_akhir . "'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '" . $tanggal_akhir . "')");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data['accounts_payable'] =  number_format($r['jumlah'], 0);
			}
		}
		$q->free_result();
		//Cash of this month
		$q = $this->db->query("SELECT 
			COALESCE(SUM(IF(tipe = 1, jumlah, 0.00) - IF(tipe = 0, jumlah, 0.00))) AS jumlah 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE tanggal <= '" . $tanggal_akhir . "'");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data['cash_at_end_of_month'] =  number_format($r['jumlah'], 0);
			}
		}
		$q->free_result();
		//TAX
		$q = $this->db->query("SELECT
		  (SUM(sp.debet) - SUM(sp.kredit)) as jumlah
		FROM
		  (SELECT
			id, tipe, tanggal_faktur AS tanggal, jumlah as debet, 0 as kredit, CONCAT(no_seri_faktur, ' - ', nama_pkp) AS deskripsi
		  FROM
			gmd_finance_transaksi_tax
		  WHERE tanggal_faktur <= '" . $tanggal_akhir . "'
			AND tipe = '0'
			AND branch = '" . $this->model_global->cek_id_regional($this->session->userdata('scope_area')) . "'
		  UNION
		  ALL
		  SELECT
			a.id, a.tipe, a.tanggal_faktur AS tanggal, 0 as debet, a.jumlah as kredit, CONCAT(a.no_seri_faktur, ' - ', a.nama_pkp) AS deskripsi
		  FROM
			gmd_finance_transaksi_tax a
			LEFT JOIN gmd_finance_master_cat_tax_type b ON a.tax_type = b.id
		  WHERE a.tanggal_faktur <= '" . $tanggal_akhir . "'
			AND a.tipe = '1'
			AND b.ignore_masukan = '0'
			AND a.branch = '" . $this->model_global->cek_id_regional($this->session->userdata('scope_area')) . "'
		  UNION
		  ALL
		  SELECT
			id, '2' AS tipe, tanggal, 0 as debet, jumlah as kredit, CONCAT('Pembayaran') AS deskripsi
		  FROM
			gmd_finance_transaksi_tax_billing
		  WHERE tanggal <= '" . $tanggal_akhir . "'
			AND branch = '" . $this->model_global->cek_id_regional($this->session->userdata('scope_area')) . "') AS sp
		ORDER BY sp.tanggal ASC, sp.tipe ASC");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data['tax'] =  number_format($r['jumlah'], 0);
				$net_profit -= $r['jumlah'];
			}
		}
		$q->free_result();
		//sales this month
		// $q = $this->db->query("SELECT
		//   SUM(b.product_price) AS jumlah
		// FROM
		//   gmd_customer a
		//   LEFT JOIN gmd_customer_product b
		// 	ON a.id = b.customer_id
		//   LEFT JOIN gmd_users c
		// 	ON a.id_user = c.id
		// WHERE (
		// 	a.tanggal_billing BETWEEN '" . $tanggal_awal . " 00:00:00'
		// 	AND '" . $tanggal_akhir . " 23:59:59'
		//   )
		//   AND a.area = '" . $this->session->userdata('scope_area') . "'");
		// if ($q->num_rows() > 0) {
		// 	foreach ($q->result_array() as $k => $r) {
		// 		$data['sales_this_month'] =  number_format($r['jumlah'], 0);
		// 	}
		// }
		// $q->free_result();
		//EXPENSES DIVISI
		// $q = $this->db->query("SELECT
		//  SUM(a.jumlah) AS jumlah
		// FROM
		//   gmd_finance_transaksi_kasir a
		//   LEFT JOIN gmd_finance_master_divisi b
		// 	ON a.divisi_cat = b.id
		//   LEFT JOIN gmd_finance_fixcost_cat c
		// 	ON a.fixcost_cat = c.id
		// WHERE (
		// 	a.tanggal BETWEEN '" . $tanggal_awal . "'
		// 	AND '" . $tanggal_akhir . "'
		//   )
		//   AND a.branch = '" . $this->model_global->cek_id_regional($this->session->userdata('scope_area')) . "'
		//   AND a.tipe = '0'
		//   AND c.hide_expenses = '0'");
		// if ($q->num_rows() > 0) {
		// 	foreach ($q->result_array() as $k => $r) {
		// 		$data['expenses_divisi'] =  number_format($r['jumlah'], 0);
		// 	}
		// }
		// $q->free_result();
		//EXPENSES VENDOR
		// $q = $this->db->query("SELECT
		//   SUM(a.jumlah) AS jumlah
		// FROM
		//   gmd_finance_ap_billing a
		//   LEFT JOIN gmd_finance_ap_invoice b
		// 	ON a.id_invoice = b.id
		//   LEFT JOIN gmd_finance_supplier c
		// 	ON b.supplier = c.id
		// WHERE (
		// 	a.tanggal BETWEEN '" . $tanggal_awal . "'
		// 	AND '" . $tanggal_akhir . "'
		//   )
		//   AND a.branch = '" . $this->model_global->cek_id_regional($this->session->userdata('scope_area')) . "'");
		// if ($q->num_rows() > 0) {
		// 	foreach ($q->result_array() as $k => $r) {
		// 		$data['expenses_vendor'] =  number_format($r['jumlah'], 0);
		// 	}
		// }
		// $q->free_result();
		//EXPENSES FIXCOST
		/*
		$q = $this->db->query("SELECT
		 SUM(a.jumlah) AS jumlah
		FROM
		  gmd_finance_transaksi_kasir a
		  LEFT JOIN gmd_finance_fixcost_cat c
			ON a.fixcost_cat = c.id
		WHERE (
			a.tanggal BETWEEN '".$tanggal_awal."'
			AND '".$tanggal_akhir."'
		  )
		  AND a.branch = '".$this->model_global->cek_id_regional($this->session->userdata('scope_area'))."'
		  AND a.tipe = '0'");
		if($q->num_rows() > 0){
			foreach($q->result_array() as $k => $r){
				$data['expenses_fixcost'] =  number_format($r['jumlah'],0);
			}
		}
		$q->free_result();
		*/
		//FORECAST INCOME
		// $q = $this->db->query("SELECT
		//   SUM(a.jumlah) AS jumlah
		// FROM
		//   gmd_finance_forecast a
		//   LEFT JOIN gmd_finance_forecast_cat c
		// 	ON a.tipe_detail = c.id
		// WHERE (
		// 	a.tanggal BETWEEN '" . $tanggal_awal . "'
		// 	AND '" . $tanggal_akhir . "'
		//   )
		//   AND a.branch = '" . $this->model_global->cek_id_regional($this->session->userdata('scope_area')) . "'
		//   AND a.tipe = '3'");
		// if ($q->num_rows() > 0) {
		// 	foreach ($q->result_array() as $k => $r) {
		// 		$data['forecast_income'] =  number_format($r['jumlah'], 0);
		// 	}
		// }
		// $q->free_result();
		//FORECAST EXPENSES
		// $q = $this->db->query("SELECT
		//   SUM(a.jumlah) AS jumlah
		// FROM
		//   gmd_finance_forecast a
		// WHERE (
		// 	a.tanggal BETWEEN '" . $tanggal_awal . "'
		// 	AND '" . $tanggal_akhir . "'
		//   )
		//   AND a.branch = '" . $this->model_global->cek_id_regional($this->session->userdata('scope_area')) . "'
		//   AND a.tipe != '3'");
		// if ($q->num_rows() > 0) {
		// 	foreach ($q->result_array() as $k => $r) {
		// 		$data['forecast_expenses'] =  number_format($r['jumlah'], 0);
		// 	}
		// }
		// $q->free_result();


		$data['net_profit'] =  number_format($net_profit, 0);
		echo json_encode($data);
	}

	function cash_month()
	{
		set_time_limit(0);
		$year = $this->uri->segment(3);
		$bulan = array(
			'01' => ucwords('jan'),
			'02' => ucwords('feb'),
			'03' => ucwords('mar'),
			'04' => ucwords('apr'),
			'05' => ucwords('mey'),
			'06' => ucwords('jun'),
			'07' => ucwords('jul'),
			'08' => ucwords('aug'),
			'09' => ucwords('sep'),
			'10' => ucwords('oct'),
			'11' => ucwords('nov'),
			'12' => ucwords('dec'),
		);
		$data = array();
		foreach ($bulan as $k => $v) {
			$tanggal_awal = date('' . $year . '-' . $k . '-01');
			$tanggal_akhir = date('' . $year . '-' . $k . '-t');

			$q = $this->db->query("SELECT 
			COALESCE(SUM(a.`jml_bayar`),0) AS jumlah 
		  FROM
			erp_gmedia.`billing` a 
		  WHERE a.`tanggal` <= '" . $tanggal_akhir . "'");
			if ($q->num_rows() > 0 && $tanggal_awal <= date('Y-m-d')) {
				foreach ($q->result_array() as $r) {
					$data[$k]['nama'] = $v;
					$data[$k]['nilai'] =  $r['jumlah'];
				}
			} else {
				$data[$k]['nama'] = $v;
				$data[$k]['nilai'] =  0;
			}
			$q->free_result();
		}

		echo json_encode($data);
	}

	function income_expenses()
	{
		set_time_limit(0);
		$year = $this->uri->segment(3);
		$bulan = array(
			'01' => ucwords('jan'),
			'02' => ucwords('feb'),
			'03' => ucwords('mar'),
			'04' => ucwords('apr'),
			'05' => ucwords('mey'),
			'06' => ucwords('jun'),
			'07' => ucwords('jul'),
			'08' => ucwords('aug'),
			'09' => ucwords('sep'),
			'10' => ucwords('oct'),
			'11' => ucwords('nov'),
			'12' => ucwords('dec'),
		);
		$data = array();
		foreach ($bulan as $k => $v) {
			$tanggal_awal = date('' . $year . '-' . $k . '-01');
			$tanggal_akhir = date('' . $year . '-' . $k . '-t');

			$net = 0;
			$q = $this->db->query("SELECT
			 COALESCE(SUM(a.`jml_bayar`),0) AS jumlah
			FROM
			  erp_gmedia.`billing` a
			WHERE (
				a.`tanggal` BETWEEN '" . $tanggal_awal . "'
				AND '" . $tanggal_akhir . "'
			  )");
			if ($q->num_rows() > 0 && $tanggal_awal <= date('Y-m-d')) {
				foreach ($q->result_array() as $r) {
					$data[$k]['nama'] = $v;
					$data[$k]['income'] =  $r['jumlah'];
					$net += $r['jumlah'];
				}
			} else {
				$data[$k]['nama'] = $v;
				$data[$k]['income'] =  0;
				$net += 0;
			}
			$q->free_result();


			$total_expenses = 0;
			$q = $this->db->query("SELECT
				 COALESCE(SUM(a.`jml_bayar`),0) AS jumlah
				FROM
				  erp_gmedia.`billing` a
				WHERE (
					a.`tanggal` BETWEEN '" . $tanggal_awal . "'
					AND '" . $tanggal_akhir . "'
				  )");
			if ($q->num_rows() > 0) {
				foreach ($q->result_array() as $r) {
					$total_expenses += $r['jumlah'];
				}
			}
			$q->free_result();
			// $q = $this->db->query("SELECT
			// 	 COALESCE(SUM(a.`jumlah`),0) AS jumlah
			// 	FROM
			// 	  gmd_finance_transaksi_kasir a
			// 	  LEFT JOIN gmd_finance_fixcost_cat b
			// 		ON a.fixcost_cat = b.id
			// 	WHERE (
			// 		a.tanggal BETWEEN '" . $tanggal_awal . "'
			// 		AND '" . $tanggal_akhir . "'
			// 	  )
			// 	  AND a.branch = '" . $this->model_global->cek_id_regional($this->session->userdata('scope_area')) . "'
			// 	  AND a.tipe = '0'
			// 	  AND b.hide_expenses = '0'");
			// if ($q->num_rows() > 0) {
			// 	foreach ($q->result_array() as $r) {
			// 		$total_expenses += $r['jumlah'];
			// 	}
			// }
			// $q->free_result();
			// if ($tanggal_awal <= date('Y-m-d')) {
			// 	$data[$k]['expenses'] =  $total_expenses;
			// 	$net -= $total_expenses;
			// } else {
			// 	$data[$k]['expenses'] =  0;
			// 	$net -= 0;
			// }

			// $q = $this->db->query("SELECT
			//   (SUM(sp.debet) - SUM(sp.kredit)) as jumlah
			// FROM
			//   (SELECT
			// 	id, tipe, tanggal_faktur AS tanggal, jumlah as debet, 0 as kredit, CONCAT(no_seri_faktur, ' - ', nama_pkp) AS deskripsi
			//   FROM
			// 	gmd_finance_transaksi_tax
			//   WHERE tanggal_faktur <= '" . $tanggal_akhir . "'
			// 	AND tipe = '0'
			// 	AND branch = '" . $this->model_global->cek_id_regional($this->session->userdata('scope_area')) . "'
			//   UNION
			//   ALL
			//   SELECT
			// 	a.id, a.tipe, a.tanggal_faktur AS tanggal, 0 as debet, a.jumlah as kredit, CONCAT(a.no_seri_faktur, ' - ', a.nama_pkp) AS deskripsi
			//   FROM
			// 	gmd_finance_transaksi_tax a
			// 	LEFT JOIN gmd_finance_master_cat_tax_type b ON a.tax_type = b.id
			//   WHERE a.tanggal_faktur <= '" . $tanggal_akhir . "'
			// 	AND a.tipe = '1'
			// 	AND b.ignore_masukan = '0'
			// 	AND a.branch = '" . $this->model_global->cek_id_regional($this->session->userdata('scope_area')) . "'
			//   UNION
			//   ALL
			//   SELECT
			// 	id, '2' AS tipe, tanggal, 0 as debet, jumlah as kredit, CONCAT('Pembayaran') AS deskripsi
			//   FROM
			// 	gmd_finance_transaksi_tax_billing
			//   WHERE tanggal <= '" . $tanggal_akhir . "'
			// 	AND branch = '" . $this->model_global->cek_id_regional($this->session->userdata('scope_area')) . "') AS sp
			// ORDER BY sp.tanggal ASC, sp.tipe ASC");
			// if ($q->num_rows() > 0 && $tanggal_awal <= date('Y-m-d')) {
			// 	foreach ($q->result_array() as $r) {
			// 		$data[$k]['tax'] =  $r['jumlah'];
			// 		$net -= $r['jumlah'];
			// 	}
			// } else {
			// 	$data[$k]['tax'] =  0;
			// 	$net -= 0;
			// }
			// $q->free_result();
			$data[$k]['net'] =  $net;
		}

		echo json_encode($data);
	}

	function expenses_divisi_this_month()
	{
		set_time_limit(0);
		$year = $this->uri->segment(3);
		$month = $this->uri->segment(4);

		$tanggal_awal = date('' . $year . '-' . $month . '-01');
		$tanggal_akhir = date('' . $year . '-' . $month . '-t');

		$data = array();
		$q = $this->db->query("SELECT
			  COALESCE(b.nama, 'Lain2') AS divisi, SUM(a.jumlah) AS harga
			FROM
			  gmd_finance_transaksi_kasir a
			  LEFT JOIN gmd_finance_master_divisi b
				ON a.divisi_cat = b.id
			  LEFT JOIN gmd_finance_fixcost_cat c
				ON a.fixcost_cat = c.id
			WHERE (
				a.tanggal BETWEEN '" . $tanggal_awal . "'
				AND '" . $tanggal_akhir . "'
			  )
			  AND a.branch = '" . $this->model_global->cek_id_regional($this->session->userdata('scope_area')) . "'
			  AND a.tipe = '0'
			  AND c.hide_expenses = '0' 
			GROUP BY b.nama
			ORDER BY b.nama ASC");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $k => $r) {
				$data[$k]['nama'] = ucwords(strtolower($r['divisi']));
				$data[$k]['rupiah'] =  $r['harga'];
			}
		}
		$q->free_result();

		echo json_encode($data);
	}

	function expenses_vendor_this_month()
	{
		set_time_limit(0);
		$year = $this->uri->segment(3);
		$month = $this->uri->segment(4);

		$tanggal_awal = date('' . $year . '-' . $month . '-01');
		$tanggal_akhir = date('' . $year . '-' . $month . '-t');

		$data = array();
		$q = $this->db->query("SELECT
			  COALESCE(c.nama, 'Lain2') AS vendor, SUM(a.jumlah) AS harga
			FROM
			  gmd_finance_ap_billing a
			  LEFT JOIN gmd_finance_ap_invoice b
				ON a.id_invoice = b.id
			  LEFT JOIN gmd_finance_supplier c
				ON b.supplier = c.id
			WHERE (
				a.tanggal BETWEEN '" . $tanggal_awal . "'
				AND '" . $tanggal_akhir . "'
			  )
			  AND a.branch = '" . $this->model_global->cek_id_regional($this->session->userdata('scope_area')) . "'
			GROUP BY c.nama
			ORDER BY c.nama ASC");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $k => $r) {
				$data[$k]['nama'] = ucwords(strtolower($r['vendor']));
				$data[$k]['rupiah'] =  $r['harga'];
			}
		}
		$q->free_result();

		echo json_encode($data);
	}

	function expenses_fixcost_this_month()
	{
		set_time_limit(0);
		$year = $this->uri->segment(3);
		$month = $this->uri->segment(4);

		$tanggal_awal = date('' . $year . '-' . $month . '-01');
		$tanggal_akhir = date('' . $year . '-' . $month . '-t');

		$data = array();
		$q = $this->db->query("SELECT
			  COALESCE(c.nama, 'Lain2') AS divisi, SUM(a.jumlah) AS harga
			FROM
			  gmd_finance_transaksi_kasir a
			  LEFT JOIN gmd_finance_fixcost_cat c
				ON a.fixcost_cat = c.id
			WHERE (
				a.tanggal BETWEEN '" . $tanggal_awal . "'
				AND '" . $tanggal_akhir . "'
			  )
			  AND a.branch = '" . $this->model_global->cek_id_regional($this->session->userdata('scope_area')) . "'
			  AND a.tipe = '0'
			GROUP BY c.nama
			ORDER BY c.nama ASC");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $k => $r) {
				$data[$k]['nama'] = ucwords(strtolower($r['divisi']));
				$data[$k]['rupiah'] =  $r['harga'];
			}
		}
		$q->free_result();

		echo json_encode($data);
	}

	function forecast_income_this_month()
	{
		set_time_limit(0);
		$year = $this->uri->segment(3);
		$month = $this->uri->segment(4);

		$tanggal_awal = date('' . $year . '-' . $month . '-01');
		$tanggal_akhir = date('' . $year . '-' . $month . '-t');

		$data = array();
		$q = $this->db->query("SELECT
			  b.nama, SUM(a.jumlah) AS jumlah
			FROM
			  gmd_finance_forecast a
			  LEFT JOIN gmd_finance_forecast_cat b
				ON a.tipe_detail = b.id
			WHERE (
				a.tanggal BETWEEN '" . $tanggal_awal . "'
				AND '" . $tanggal_akhir . "'
			  )
			  AND a.branch = '" . $this->model_global->cek_id_regional($this->session->userdata('scope_area')) . "'
			  AND a.tipe = '3'
			GROUP BY b.nama
			ORDER BY b.nama ASC");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $k => $r) {
				$data[$k]['nama'] = ucwords(strtolower($r['nama']));
				$data[$k]['rupiah'] =  $r['jumlah'];
			}
		}
		$q->free_result();

		echo json_encode($data);
	}

	function forecast_expenses_this_month()
	{
		set_time_limit(0);
		$year = $this->uri->segment(3);
		$month = $this->uri->segment(4);

		$tanggal_awal = date('' . $year . '-' . $month . '-01');
		$tanggal_akhir = date('' . $year . '-' . $month . '-t');

		$data = array();
		$q = $this->db->query("SELECT
			  IF(a.tipe = 1, b.nama, c.nama) AS nama, SUM(a.jumlah) AS jumlah
			FROM
			  gmd_finance_forecast a
			  LEFT JOIN gmd_finance_supplier b
				ON a.tipe_detail = b.id
			  LEFT JOIN gmd_finance_fixcost_cat c
				ON a.tipe_detail = c.id
			WHERE (
				a.tanggal BETWEEN '" . $tanggal_awal . "'
				AND '" . $tanggal_akhir . "'
			  )
			  AND a.branch = '" . $this->model_global->cek_id_regional($this->session->userdata('scope_area')) . "'
			  AND a.tipe != '3'
			GROUP BY b.nama
			ORDER BY b.nama ASC");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $k => $r) {
				$data[$k]['nama'] = ucwords(strtolower($r['nama']));
				$data[$k]['rupiah'] =  $r['jumlah'];
			}
		}
		$q->free_result();

		echo json_encode($data);
	}

	function sales_this_month()
	{
		set_time_limit(0);
		$year = $this->uri->segment(3);
		$month = $this->uri->segment(4);

		$tanggal_awal = date('' . $year . '-' . $month . '-01');
		$tanggal_akhir = date('' . $year . '-' . $month . '-t');

		$data = array();
		/*
			$q = $this->db->query("SELECT
			  c.name, a.ppn, b.product_price, COUNT(a.id) AS qty, SUM(b.product_price) AS harga
			FROM
			  gmd_customer a
			  LEFT JOIN gmd_customer_product b
				ON a.id = b.customer_id
			  LEFT JOIN gmd_users c
				ON a.id_user = c.id
			WHERE (
				a.tanggal_billing BETWEEN '".$tanggal_awal." 00:00:00'
				AND '".$tanggal_akhir." 23:59:59'
			  )
			  AND a.area = '".$this->session->userdata('scope_area')."'
			GROUP BY c.name
			ORDER BY c.name ASC");
			*/
		$q = $this->db->query("SELECT
			  sls.*,COUNT(sls.id) AS qty, SUM(IF(sls.loss = 0,1,0)) AS qty_sales, SUM(IF(sls.sales = 0,1,0)) AS qty_loss, SUM(sls.sales) AS sales, SUM(sls.loss) AS loss
			FROM
			  (SELECT
				a.id, c.name, a.ppn, if(a.ppn = 1, (b.product_price - round( b.product_price/ 1.1)), b.product_price) AS sales, 0 AS loss
			  FROM
				gmd_customer a
				LEFT JOIN gmd_customer_product b
				  ON a.id = b.customer_id
				LEFT JOIN gmd_users c
				  ON a.id_user = c.id
			  WHERE (
				  a.tanggal_billing BETWEEN '" . $tanggal_awal . " 00:00:00'
				  AND '" . $tanggal_akhir . " 23:59:59'
				)
				AND a.area = '" . $this->session->userdata('scope_area') . "'
			  UNION
			  ALL
			  SELECT
				a.id, c.name, a.ppn, 0 AS sales, if(a.ppn = 1, (b.product_price - round( b.product_price/ 1.1)), b.product_price) AS loss
			  FROM
				gmd_customer a
				LEFT JOIN gmd_customer_product b
				  ON a.id = b.customer_id
				LEFT JOIN gmd_users c
				  ON a.id_user = c.id
			  WHERE (
				  a.nonaktif_date BETWEEN '" . $tanggal_awal . "'
				  AND '" . $tanggal_akhir . "'
				)
				AND a.area = '" . $this->session->userdata('scope_area') . "') AS sls
			GROUP BY sls.name
			ORDER BY sls.name ASC");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $k => $r) {
				$data[$k]['nama'] = ucwords(strtolower($r['name']));
				$data[$k]['qty'] = $r['qty'];
				$data[$k]['nominal1'] =  $r['sales'];
				$data[$k]['nominal2'] =  $r['loss'];
			}
		}
		$q->free_result();

		echo json_encode($data);
	}

	function sales_of_the_year()
	{
		set_time_limit(0);
		$year = $this->uri->segment(3);
		$bulan = array(
			'01' => ucwords('jan'),
			'02' => ucwords('feb'),
			'03' => ucwords('mar'),
			'04' => ucwords('apr'),
			'05' => ucwords('mey'),
			'06' => ucwords('jun'),
			'07' => ucwords('jul'),
			'08' => ucwords('aug'),
			'09' => ucwords('sep'),
			'10' => ucwords('oct'),
			'11' => ucwords('nov'),
			'12' => ucwords('dec'),
		);
		$data = array();
		foreach ($bulan as $k => $v) {
			$tanggal_awal = date('' . $year . '-' . $k . '-01');
			$tanggal_akhir = date('' . $year . '-' . $k . '-t');


			$q = $this->db->query("SELECT
			  SUM(sls.sales) AS sales, SUM(sls.loss) AS loss
			FROM
			  (SELECT
				a.id, c.name, a.ppn, if(a.ppn = 1, (b.product_price - round( b.product_price/ 1.1)), b.product_price) AS sales, 0 AS loss
			  FROM
				gmd_customer a
				LEFT JOIN gmd_customer_product b
				  ON a.id = b.customer_id
				LEFT JOIN gmd_users c
				  ON a.id_user = c.id
			  WHERE (
				  a.tanggal_billing BETWEEN '" . $tanggal_awal . " 00:00:00'
				  AND '" . $tanggal_akhir . " 23:59:59'
				)
				AND a.area = '" . $this->session->userdata('scope_area') . "'
			  UNION
			  ALL
			  SELECT
				a.id, c.name, a.ppn, 0 AS sales, if(a.ppn = 1, (b.product_price - round( b.product_price/ 1.1)), b.product_price) AS loss
			  FROM
				gmd_customer a
				LEFT JOIN gmd_customer_product b
				  ON a.id = b.customer_id
				LEFT JOIN gmd_users c
				  ON a.id_user = c.id
			  WHERE (
				  a.nonaktif_date BETWEEN '" . $tanggal_awal . "'
				  AND '" . $tanggal_akhir . "'
				)
				AND a.area = '" . $this->session->userdata('scope_area') . "') AS sls");
			if ($q->num_rows() > 0 && $tanggal_awal <= date('Y-m-d')) {
				foreach ($q->result_array() as $r) {
					$data[$k]['nama'] = $v;
					$data[$k]['nilai'] =  $r['sales'];
					$data[$k]['nilai2'] =  $r['loss'];
				}
			} else {
				$data[$k]['nama'] = $v;
				$data[$k]['nilai'] =  0;
				$data[$k]['nilai2'] =  0;
			}
			$q->free_result();
		}

		echo json_encode($data);
	}

	function ap_month()
	{
		set_time_limit(0);
		$year = $this->uri->segment(3);
		$month = $this->uri->segment(4);

		$tanggal_awal = date('Y-m-d');
		$tanggal_akhir = date('Y-m-d');
		if ($month == 'th') {
			$tanggal_awal = date('' . $year . '-01-01');
			$tanggal_akhir = date('' . $year . '-12-t');
		} elseif ($month == 'sm_1') {
			$tanggal_awal = date('' . $year . '-01-01');
			$tanggal_akhir = date('' . $year . '-06-t');
		} elseif ($month == 'sm_2') {
			$tanggal_awal = date('' . $year . '-07-01');
			$tanggal_akhir = date('' . $year . '-12-t');
		} elseif ($month == 'tw_1') {
			$tanggal_awal = date('' . $year . '-01-01');
			$tanggal_akhir = date('' . $year . '-03-t');
		} elseif ($month == 'tw_2') {
			$tanggal_awal = date('' . $year . '-04-01');
			$tanggal_akhir = date('' . $year . '-06-t');
		} elseif ($month == 'tw_3') {
			$tanggal_awal = date('' . $year . '-07-01');
			$tanggal_akhir = date('' . $year . '-09-t');
		} elseif ($month == 'tw_4') {
			$tanggal_awal = date('' . $year . '-10-01');
			$tanggal_akhir = date('' . $year . '-12-t');
		} else {
			$tanggal_awal = date('' . $year . '-' . $month . '-01');
			$tanggal_akhir = date('' . $year . '-' . $month . '-t');
		}

		$data = array();
		$q = $this->db->query("SELECT
			  COALESCE(SUM(a.jumlah),0) AS jumlah, COALESCE(SUM(a.bayar),0) AS bayar, COALESCE((SUM(a.jumlah) - SUM(a.bayar)),0) AS sisa
			FROM
			  gmd_finance_ap_invoice a
			WHERE (
				a.tanggal BETWEEN '" . $tanggal_awal . "'
				AND '" . $tanggal_akhir . "'
			  )");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data[0]['nama'] = 'Lunas';
				$data[0]['nilai'] =  $r['bayar'];
				$data[1]['nama'] = 'Belum Lunas';
				$data[1]['nilai'] =  $r['sisa'];
				$data[2]['nama'] = 'Total AP Rp ';
				$data[2]['nilai'] =  number_format($r['jumlah'], 0);
			}
		}
		$q->free_result();
		echo json_encode($data);
	}

	function gross_profit()
	{
		set_time_limit(0);
		$year = $this->uri->segment(3);
		$month = $this->uri->segment(4);

		$tanggal_awal = date('Y-m-d');
		$tanggal_akhir = date('Y-m-d');

		if ($month == 'th') {
			$tanggal_awal = date('' . $year . '-01-01');
			$tanggal_akhir = date('' . $year . '-12-t');
		} elseif ($month == 'sm_1') {
			$tanggal_awal = date('' . $year . '-01-01');
			$tanggal_akhir = date('' . $year . '-06-t');
		} elseif ($month == 'sm_2') {
			$tanggal_awal = date('' . $year . '-07-01');
			$tanggal_akhir = date('' . $year . '-12-t');
		} elseif ($month == 'tw_1') {
			$tanggal_awal = date('' . $year . '-01-01');
			$tanggal_akhir = date('' . $year . '-03-t');
		} elseif ($month == 'tw_2') {
			$tanggal_awal = date('' . $year . '-04-01');
			$tanggal_akhir = date('' . $year . '-06-t');
		} elseif ($month == 'tw_3') {
			$tanggal_awal = date('' . $year . '-07-01');
			$tanggal_akhir = date('' . $year . '-09-t');
		} elseif ($month == 'tw_4') {
			$tanggal_awal = date('' . $year . '-10-01');
			$tanggal_akhir = date('' . $year . '-12-t');
		} else {
			$tanggal_awal = date('' . $year . '-' . $month . '-01');
			$tanggal_akhir = date('' . $year . '-' . $month . '-t');
		}

		$data = array();

		$ar = 0;
		$q = $this->db->query("SELECT
			  COALESCE(SUM(a.jumlah),0) AS jumlah_ar
			FROM
			  gmd_finance_invoice_customer a
			WHERE (
				a.date_invoice BETWEEN '" . $tanggal_awal . "'
				AND '" . $tanggal_akhir . "'
			  )");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$ar += $r['jumlah_ar'];
			}
		}
		$q->free_result();

		$ap = 0;
		$q = $this->db->query("SELECT
			  COALESCE(SUM(a.jumlah),0) AS jumlah_ap
			FROM
			  gmd_finance_ap_invoice a
			WHERE (
				a.tanggal BETWEEN '" . $tanggal_awal . "'
				AND '" . $tanggal_akhir . "'
			  )");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$ap += $r['jumlah_ap'];
			}
		}
		$q->free_result();

		$data[0]['nama'] = 'Accounts Receivable';
		$data[0]['nilai'] =  $ar;
		$data[1]['nama'] = 'Accounts Payable';
		$data[1]['nilai'] =  $ap;
		$data[2]['nama'] = 'Gross Profit Rp ';
		$data[2]['nilai'] =  number_format($ar - $ap, 0);
		echo json_encode($data);
	}
}
