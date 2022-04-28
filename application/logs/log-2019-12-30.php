<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-12-30 01:54:19 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-30 01:59:46 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-30 02:36:40 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-30 02:37:18 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-30 02:45:29 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-30 02:46:17 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-30 02:49:22 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-30 02:50:31 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-30 02:50:56 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-30 02:55:33 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-30 02:55:39 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-30 02:55:49 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-30 09:55:55 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 428
ERROR - 2019-12-30 02:57:09 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-30 02:57:09 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-12-30 02:57:09 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-30 02:57:09 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-30 02:57:09 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-30 10:01:19 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2019-12-30 03:04:14 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-30 03:09:44 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-30 10:26:52 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 428
ERROR - 2019-12-30 03:29:35 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-30 10:30:32 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 428
ERROR - 2019-12-30 03:30:38 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-30 10:33:41 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 428
ERROR - 2019-12-30 03:41:58 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-30 03:41:58 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-30 03:41:58 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-12-30 03:41:58 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-30 03:41:58 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-30 03:47:53 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-30 03:47:53 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-30 03:47:53 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-12-30 03:47:53 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-30 03:47:53 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-30 03:53:02 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-30 11:01:27 --> Query error: SELECT command denied to user 'erp'@'103.255.240.2' for table 'arpost' - Invalid query: SELECT * FROM (
		SELECT
		d.`id_arpost_merge` AS id,
		a.`nomor`,
		a.`tanggal`,
		a.`tanggal_invoice`,
		a.`due_date`,
		c.`nama` AS nama_cust,
		b.`nama` AS nama_site,
		SUM(e.`bw`) AS bw,
		SUM(e.`lain2`)+e.`materai` AS lain2,
		SUM(e.`instalasi`) AS instalasi,
		SUM(e.`ppn`) AS ppn,
		SUM(e.`total`)+e.`materai` AS total,
		e.`jml_bayar`,
		IF(SUM(e.`ppn`) = 0, 'TIDAK', IF(SUM(e.`ppn`) > 0, 'STANDAR', 'SEDERHANA')) AS jenis_ppn,
		a.`date_printed`,
		a.`date_email`,
		a.`date_faktur`,
		a.`date_edited`,
		a.`lunas`,
		a.`status_invoice`,
		IF(a.`flag` = 1, 'Langganan', IF(a.`flag` = 2, 'Project', 'Langganan')) AS flag,
		e.`status_merge`
		FROM
		  erp_gmedia.`arpost` a
		  LEFT JOIN erp_gmedia.`arpost_merge` d
			ON a.`id` = d.`id_arpost_merge`
			LEFT JOIN erp_gmedia.`ms_site` b
			ON a.`to_site` = b.`id`
			LEFT JOIN erp_gmedia.`ms_customers` c
			ON b.`id_cust` = c.`id`
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
			  SUM(z.`bw`) + SUM(z.`lain2`) + SUM(z.`ppn2`) + SUM(z.`instalasi`)  AS total,
			  z.`jml_bayar`,
			  z.`date_printed`,
			  z.`date_email`,
			  z.`date_faktur`,
			  z.`date_edited`,
			  z.`merge_type` AS status_merge
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
			  erp_gmedia.`arpost` a
				LEFT JOIN erp_gmedia.`ms_site` b
				  ON a.`id_site` = b.`id`
				  LEFT JOIN erp_gmedia.`transaksi` c
				  ON a.`nomor` = c.`nomor` AND a.`id_order`=c.`id_order`
			  WHERE a.`status` = 1  AND a.`lunas` = 0 
				AND c.`status` = 1
				AND a.`merge` = 1
				) z
			GROUP BY z.`id`) e
			ON d.`id_arpost` = e.`id`
		WHERE a.`tanggal` between '2019-12-01' and '2020-01-31'  AND a.`lunas` = 0  AND (b.`nama` LIKE '%%' ESCAPE '!' OR 
			a.`nomor` LIKE '%%' ESCAPE '!' OR c.`nama` LIKE '%%' ESCAPE '!') 
		  AND a.`id_order` IS NULL
		  AND a.`status` = 1
		GROUP BY d.`id_arpost_merge`) p 
		UNION ALL
	  SELECT * FROM (
		 SELECT
		  x.`id`,
		  x.`nomor`,
		  x.`tanggal`,
		  x.`tanggal_invoice`,
		  x.`due_date`,
		  x.`nama_cust`,
		  x.`nama_site`,
		  SUM(x.`bw`) AS bw,
		  CASE
		  WHEN SUM(x.`materai`) >= 6000
		  THEN SUM(x.`lain2`)+6000
		  WHEN SUM(x.`materai`) < 6000
		  THEN SUM(x.`lain2`)+SUM(x.`materai`)
		  END AS lain2,
		  SUM(x.`instalasi`) AS instalasi,
		  SUM(x.`ppn2`) AS ppn,
		  SUM(x.`bw`) + SUM(x.`lain2`) + SUM(x.`ppn2`) + SUM(x.`instalasi`) + SUM(x.`materai`) AS total,
		  x.`jml_bayar`,
		  IF(SUM(x.`ppn2`) = 0, 'TIDAK', IF(SUM(x.`ppn2`) > 0, 'STANDAR', 'SEDERHANA')) AS jenis_ppn,
		  x.`date_printed`,
		  x.`date_email`,
		  x.`date_faktur`,
		  x.`date_edited`,
		  x.`lunas`,
		  x.`status_invoice`,
		  IF(x.`flag` = 1, 'Langganan', IF(x.`flag` = 2, 'Project', 'Langganan')) AS flag,
		  0 AS status_merge
		FROM
		  (SELECT
			a.*,
			d.`nama` AS nama_cust,
			b.`nama` AS nama_site,
			CASE
    			WHEN b.`nama` IS NULL
    			THEN d.`nama`
    			ELSE b.`nama`
    			END AS nama,
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
		  rp_gmedia.`arpost` a
			LEFT JOIN erp_gmedia.`ms_site` b
			  ON a.`id_site` = b.`id`
			LEFT JOIN erp_gmedia.`transaksi` c
			  ON a.`nomor` = c.`nomor` AND a.`id_order`=c.`id_order`
			LEFT JOIN erp_gmedia.`ms_customers` d
			  ON a.`id_cust`=d.`id`
		  WHERE a.`tanggal` between '2019-12-01' and '2020-01-31'  AND a.`lunas` = 0  
		  AND (b.`nama` LIKE '%%' ESCAPE '!' OR 
			a.`nomor` LIKE '%%' ESCAPE '!' OR d.`nama` LIKE '%%' ESCAPE '!') 
			AND a.`status` = 1
			AND c.`status` = 1
			AND (a.`merge` IS NULL OR a.`merge` = 0)) X GROUP BY x.`id` ) p  
ERROR - 2019-12-30 04:01:32 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-30 04:01:33 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-30 11:01:33 --> Query error: SELECT command denied to user 'erp'@'103.255.240.2' for table 'arpost' - Invalid query: SELECT * FROM (
		SELECT
		d.`id_arpost_merge` AS id,
		a.`nomor`,
		a.`tanggal`,
		a.`tanggal_invoice`,
		a.`due_date`,
		c.`nama` AS nama_cust,
		b.`nama` AS nama_site,
		SUM(e.`bw`) AS bw,
		SUM(e.`lain2`)+e.`materai` AS lain2,
		SUM(e.`instalasi`) AS instalasi,
		SUM(e.`ppn`) AS ppn,
		SUM(e.`total`)+e.`materai` AS total,
		e.`jml_bayar`,
		IF(SUM(e.`ppn`) = 0, 'TIDAK', IF(SUM(e.`ppn`) > 0, 'STANDAR', 'SEDERHANA')) AS jenis_ppn,
		a.`date_printed`,
		a.`date_email`,
		a.`date_faktur`,
		a.`date_edited`,
		a.`lunas`,
		a.`status_invoice`,
		IF(a.`flag` = 1, 'Langganan', IF(a.`flag` = 2, 'Project', 'Langganan')) AS flag,
		e.`status_merge`
		FROM
		  erp_gmedia.`arpost` a
		  LEFT JOIN erp_gmedia.`arpost_merge` d
			ON a.`id` = d.`id_arpost_merge`
			LEFT JOIN erp_gmedia.`ms_site` b
			ON a.`to_site` = b.`id`
			LEFT JOIN erp_gmedia.`ms_customers` c
			ON b.`id_cust` = c.`id`
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
			  SUM(z.`bw`) + SUM(z.`lain2`) + SUM(z.`ppn2`) + SUM(z.`instalasi`)  AS total,
			  z.`jml_bayar`,
			  z.`date_printed`,
			  z.`date_email`,
			  z.`date_faktur`,
			  z.`date_edited`,
			  z.`merge_type` AS status_merge
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
			  erp_gmedia.`arpost` a
				LEFT JOIN erp_gmedia.`ms_site` b
				  ON a.`id_site` = b.`id`
				  LEFT JOIN erp_gmedia.`transaksi` c
				  ON a.`nomor` = c.`nomor` AND a.`id_order`=c.`id_order`
			  WHERE a.`status` = 1  AND a.`lunas` = 0 
				AND c.`status` = 1
				AND a.`merge` = 1
				) z
			GROUP BY z.`id`) e
			ON d.`id_arpost` = e.`id`
		WHERE a.`tanggal` between '2019-12-01' and '2020-01-31'  AND a.`lunas` = 0  AND (b.`nama` LIKE '%%' ESCAPE '!' OR 
			a.`nomor` LIKE '%%' ESCAPE '!' OR c.`nama` LIKE '%%' ESCAPE '!') 
		  AND a.`id_order` IS NULL
		  AND a.`status` = 1
		GROUP BY d.`id_arpost_merge`) p 
		UNION ALL
	  SELECT * FROM (
		 SELECT
		  x.`id`,
		  x.`nomor`,
		  x.`tanggal`,
		  x.`tanggal_invoice`,
		  x.`due_date`,
		  x.`nama_cust`,
		  x.`nama_site`,
		  SUM(x.`bw`) AS bw,
		  CASE
		  WHEN SUM(x.`materai`) >= 6000
		  THEN SUM(x.`lain2`)+6000
		  WHEN SUM(x.`materai`) < 6000
		  THEN SUM(x.`lain2`)+SUM(x.`materai`)
		  END AS lain2,
		  SUM(x.`instalasi`) AS instalasi,
		  SUM(x.`ppn2`) AS ppn,
		  SUM(x.`bw`) + SUM(x.`lain2`) + SUM(x.`ppn2`) + SUM(x.`instalasi`) + SUM(x.`materai`) AS total,
		  x.`jml_bayar`,
		  IF(SUM(x.`ppn2`) = 0, 'TIDAK', IF(SUM(x.`ppn2`) > 0, 'STANDAR', 'SEDERHANA')) AS jenis_ppn,
		  x.`date_printed`,
		  x.`date_email`,
		  x.`date_faktur`,
		  x.`date_edited`,
		  x.`lunas`,
		  x.`status_invoice`,
		  IF(x.`flag` = 1, 'Langganan', IF(x.`flag` = 2, 'Project', 'Langganan')) AS flag,
		  0 AS status_merge
		FROM
		  (SELECT
			a.*,
			d.`nama` AS nama_cust,
			b.`nama` AS nama_site,
			CASE
    			WHEN b.`nama` IS NULL
    			THEN d.`nama`
    			ELSE b.`nama`
    			END AS nama,
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
		  rp_gmedia.`arpost` a
			LEFT JOIN erp_gmedia.`ms_site` b
			  ON a.`id_site` = b.`id`
			LEFT JOIN erp_gmedia.`transaksi` c
			  ON a.`nomor` = c.`nomor` AND a.`id_order`=c.`id_order`
			LEFT JOIN erp_gmedia.`ms_customers` d
			  ON a.`id_cust`=d.`id`
		  WHERE a.`tanggal` between '2019-12-01' and '2020-01-31'  AND a.`lunas` = 0  
		  AND (b.`nama` LIKE '%%' ESCAPE '!' OR 
			a.`nomor` LIKE '%%' ESCAPE '!' OR d.`nama` LIKE '%%' ESCAPE '!') 
			AND a.`status` = 1
			AND c.`status` = 1
			AND (a.`merge` IS NULL OR a.`merge` = 0)) X GROUP BY x.`id` ) p  
ERROR - 2019-12-30 04:02:11 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-30 04:03:17 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-30 04:03:17 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-30 04:03:17 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-12-30 04:03:17 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-30 04:03:17 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-30 04:15:17 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-30 04:15:17 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-30 04:15:17 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-12-30 04:15:17 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-30 04:15:17 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-30 04:20:21 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-30 04:20:21 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-30 04:20:21 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-12-30 04:20:21 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-30 04:20:21 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-30 04:48:48 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-30 04:48:48 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-30 04:48:48 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-12-30 04:48:48 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-30 04:48:48 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-30 13:40:08 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 458
ERROR - 2019-12-30 13:40:48 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 458
ERROR - 2019-12-30 13:41:14 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 458
ERROR - 2019-12-30 13:42:10 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 458
ERROR - 2019-12-30 07:03:58 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-30 07:03:58 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-30 07:03:58 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-12-30 07:03:59 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-30 07:03:59 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-30 07:23:10 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-30 07:23:10 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-30 07:23:10 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-12-30 07:23:10 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-30 07:23:10 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-30 07:54:19 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-30 07:54:19 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-30 07:54:19 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-12-30 07:54:19 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-30 07:54:19 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-30 09:33:32 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-30 09:33:32 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-30 09:33:32 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-12-30 09:33:32 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-30 09:33:32 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-30 10:26:13 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-30 10:26:13 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-12-30 10:26:13 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-30 10:26:13 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-30 10:26:13 --> 404 Page Not Found: Select_data_income_expenses/2019
