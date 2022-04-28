<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-02-21 08:23:17 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-21 08:23:17 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-21 08:49:35 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-21 08:49:35 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-21 08:49:43 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-21 08:49:43 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-21 09:33:26 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-21 09:33:26 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-21 09:51:41 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-21 09:51:41 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-21 02:52:20 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-21 02:52:21 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-21 02:52:21 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-21 02:52:21 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-21 02:52:21 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-21 10:29:04 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1062
ERROR - 2020-02-21 10:29:04 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1063
ERROR - 2020-02-21 10:29:04 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1064
ERROR - 2020-02-21 10:29:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1062
ERROR - 2020-02-21 10:29:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1063
ERROR - 2020-02-21 10:29:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1064
ERROR - 2020-02-21 10:29:14 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1062
ERROR - 2020-02-21 10:29:14 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1063
ERROR - 2020-02-21 10:29:14 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1064
ERROR - 2020-02-21 10:29:17 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1062
ERROR - 2020-02-21 10:29:17 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1063
ERROR - 2020-02-21 10:29:17 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1064
ERROR - 2020-02-21 04:07:42 --> 404 Page Not Found: Assets/js
ERROR - 2020-02-21 04:13:25 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-21 04:13:25 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-21 04:13:25 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-21 04:13:26 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-21 04:13:26 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-21 11:52:48 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '%' ESCAPE '!' OR 
			a.`nomor` LIKE '%jim'%' ESCAPE '!' OR c.`nama` LIKE '%jim'%' at line 107 - Invalid query: SELECT * FROM (SELECT * FROM (
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
		a.`date_approve`,
		a.`lunas`,
		a.`status_invoice`,
		IF(a.`flag` = 1, 'Langganan', IF(a.`flag` = 2, 'Project', 'Langganan')) AS flag,
		e.`status_merge`,
		c.`idcust`,
		e.`servid`
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
			  z.`date_approve`,
			  z.`merge` AS status_merge,
			  z.`servid`
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
				END AS lain2,
				d.`servid`
			  FROM
			  erp_gmedia.`arpost` a
				LEFT JOIN erp_gmedia.`ms_site` b
				  ON a.`id_site` = b.`id`
				  LEFT JOIN erp_gmedia.`transaksi` c
				  ON a.`nomor` = c.`nomor` AND a.`id_order`=c.`id_order`
				  LEFT JOIN erp_gmedia.`order_service`d
				  ON a.`id_order`=d.`id_order` AND  a.`id_site`=d.`id_site`
			  WHERE d.`status`=1 AND a.`status` = 1  AND a.`lunas` = 0 
				AND c.`status` = 1
				AND a.`merge` = 1
				) z
			GROUP BY z.`id`) e
			ON d.`id_arpost` = e.`id`
		WHERE a.`tanggal` between '2020-03-01' and '2020-03-31'  AND a.`lunas` = 0  AND (b.`nama` LIKE '%jim'%' ESCAPE '!' OR 
			a.`nomor` LIKE '%jim'%' ESCAPE '!' OR c.`nama` LIKE '%jim'%' ESCAPE '!') 
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
		  x.`date_approve`,
		  x.`lunas`,
		  x.`status_invoice`,
		  IF(x.`flag` = 1, 'Langganan', IF(x.`flag` = 2, 'Project', 'Langganan')) AS flag,
		  0 AS status_merge,
		  x.`idcust`,
		  x.`servid`
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
			END AS lain2,
			d.`idcust`,
			e.`servid`
		  FROM
		  erp_gmedia.`arpost` a
			LEFT JOIN erp_gmedia.`ms_site` b
			  ON a.`id_site` = b.`id`
			LEFT JOIN erp_gmedia.`transaksi` c
			  ON a.`nomor` = c.`nomor` AND a.`id_order`=c.`id_order`
			  LEFT JOIN erp_gmedia.`ms_customers` d
				ON a.`id_cust` = d.`id`
			LEFT JOIN erp_gmedia.`order_service` e
				ON a.`id_order`=e.`id_order` AND a.`id_site`=e.`id_site`
		  WHERE e.`status`=1 AND d.`status`=1 AND a.`tanggal` between '2020-03-01' and '2020-03-31'  AND a.`lunas` = 0  
		  AND (b.`nama` LIKE '%jim'%' ESCAPE '!' OR 
			a.`nomor` LIKE '%jim'%' ESCAPE '!' OR d.`nama` LIKE '%jim'%' ESCAPE '!') 
			AND a.`status` = 1
			AND c.`status` = 1
			AND (a.`merge` IS NULL OR a.`merge` = 0)) X GROUP BY x.`id` ) p  ) vb 
ERROR - 2020-02-21 11:52:48 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 's%' ESCAPE '!' OR 
			a.`nomor` LIKE '%jim's%' ESCAPE '!' OR c.`nama` LIKE '%jim' at line 107 - Invalid query: SELECT * FROM (SELECT * FROM (
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
		a.`date_approve`,
		a.`lunas`,
		a.`status_invoice`,
		IF(a.`flag` = 1, 'Langganan', IF(a.`flag` = 2, 'Project', 'Langganan')) AS flag,
		e.`status_merge`,
		c.`idcust`,
		e.`servid`
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
			  z.`date_approve`,
			  z.`merge` AS status_merge,
			  z.`servid`
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
				END AS lain2,
				d.`servid`
			  FROM
			  erp_gmedia.`arpost` a
				LEFT JOIN erp_gmedia.`ms_site` b
				  ON a.`id_site` = b.`id`
				  LEFT JOIN erp_gmedia.`transaksi` c
				  ON a.`nomor` = c.`nomor` AND a.`id_order`=c.`id_order`
				  LEFT JOIN erp_gmedia.`order_service`d
				  ON a.`id_order`=d.`id_order` AND  a.`id_site`=d.`id_site`
			  WHERE d.`status`=1 AND a.`status` = 1  AND a.`lunas` = 0 
				AND c.`status` = 1
				AND a.`merge` = 1
				) z
			GROUP BY z.`id`) e
			ON d.`id_arpost` = e.`id`
		WHERE a.`tanggal` between '2020-03-01' and '2020-03-31'  AND a.`lunas` = 0  AND (b.`nama` LIKE '%jim's%' ESCAPE '!' OR 
			a.`nomor` LIKE '%jim's%' ESCAPE '!' OR c.`nama` LIKE '%jim's%' ESCAPE '!') 
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
		  x.`date_approve`,
		  x.`lunas`,
		  x.`status_invoice`,
		  IF(x.`flag` = 1, 'Langganan', IF(x.`flag` = 2, 'Project', 'Langganan')) AS flag,
		  0 AS status_merge,
		  x.`idcust`,
		  x.`servid`
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
			END AS lain2,
			d.`idcust`,
			e.`servid`
		  FROM
		  erp_gmedia.`arpost` a
			LEFT JOIN erp_gmedia.`ms_site` b
			  ON a.`id_site` = b.`id`
			LEFT JOIN erp_gmedia.`transaksi` c
			  ON a.`nomor` = c.`nomor` AND a.`id_order`=c.`id_order`
			  LEFT JOIN erp_gmedia.`ms_customers` d
				ON a.`id_cust` = d.`id`
			LEFT JOIN erp_gmedia.`order_service` e
				ON a.`id_order`=e.`id_order` AND a.`id_site`=e.`id_site`
		  WHERE e.`status`=1 AND d.`status`=1 AND a.`tanggal` between '2020-03-01' and '2020-03-31'  AND a.`lunas` = 0  
		  AND (b.`nama` LIKE '%jim's%' ESCAPE '!' OR 
			a.`nomor` LIKE '%jim's%' ESCAPE '!' OR d.`nama` LIKE '%jim's%' ESCAPE '!') 
			AND a.`status` = 1
			AND c.`status` = 1
			AND (a.`merge` IS NULL OR a.`merge` = 0)) X GROUP BY x.`id` ) p  ) vb 
ERROR - 2020-02-21 11:52:52 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '%' ESCAPE '!' OR 
			a.`nomor` LIKE '%jim'%' ESCAPE '!' OR c.`nama` LIKE '%jim'%' at line 107 - Invalid query: SELECT * FROM (SELECT * FROM (
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
		a.`date_approve`,
		a.`lunas`,
		a.`status_invoice`,
		IF(a.`flag` = 1, 'Langganan', IF(a.`flag` = 2, 'Project', 'Langganan')) AS flag,
		e.`status_merge`,
		c.`idcust`,
		e.`servid`
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
			  z.`date_approve`,
			  z.`merge` AS status_merge,
			  z.`servid`
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
				END AS lain2,
				d.`servid`
			  FROM
			  erp_gmedia.`arpost` a
				LEFT JOIN erp_gmedia.`ms_site` b
				  ON a.`id_site` = b.`id`
				  LEFT JOIN erp_gmedia.`transaksi` c
				  ON a.`nomor` = c.`nomor` AND a.`id_order`=c.`id_order`
				  LEFT JOIN erp_gmedia.`order_service`d
				  ON a.`id_order`=d.`id_order` AND  a.`id_site`=d.`id_site`
			  WHERE d.`status`=1 AND a.`status` = 1  AND a.`lunas` = 0 
				AND c.`status` = 1
				AND a.`merge` = 1
				) z
			GROUP BY z.`id`) e
			ON d.`id_arpost` = e.`id`
		WHERE a.`tanggal` between '2020-03-01' and '2020-03-31'  AND a.`lunas` = 0  AND (b.`nama` LIKE '%jim'%' ESCAPE '!' OR 
			a.`nomor` LIKE '%jim'%' ESCAPE '!' OR c.`nama` LIKE '%jim'%' ESCAPE '!') 
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
		  x.`date_approve`,
		  x.`lunas`,
		  x.`status_invoice`,
		  IF(x.`flag` = 1, 'Langganan', IF(x.`flag` = 2, 'Project', 'Langganan')) AS flag,
		  0 AS status_merge,
		  x.`idcust`,
		  x.`servid`
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
			END AS lain2,
			d.`idcust`,
			e.`servid`
		  FROM
		  erp_gmedia.`arpost` a
			LEFT JOIN erp_gmedia.`ms_site` b
			  ON a.`id_site` = b.`id`
			LEFT JOIN erp_gmedia.`transaksi` c
			  ON a.`nomor` = c.`nomor` AND a.`id_order`=c.`id_order`
			  LEFT JOIN erp_gmedia.`ms_customers` d
				ON a.`id_cust` = d.`id`
			LEFT JOIN erp_gmedia.`order_service` e
				ON a.`id_order`=e.`id_order` AND a.`id_site`=e.`id_site`
		  WHERE e.`status`=1 AND d.`status`=1 AND a.`tanggal` between '2020-03-01' and '2020-03-31'  AND a.`lunas` = 0  
		  AND (b.`nama` LIKE '%jim'%' ESCAPE '!' OR 
			a.`nomor` LIKE '%jim'%' ESCAPE '!' OR d.`nama` LIKE '%jim'%' ESCAPE '!') 
			AND a.`status` = 1
			AND c.`status` = 1
			AND (a.`merge` IS NULL OR a.`merge` = 0)) X GROUP BY x.`id` ) p  ) vb 
ERROR - 2020-02-21 13:58:53 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-21 13:58:53 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-21 14:50:39 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-21 14:50:39 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-21 08:43:25 --> 404 Page Not Found: Assets/js
ERROR - 2020-02-21 15:44:20 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-21 15:44:20 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-21 08:57:47 --> 404 Page Not Found: Assets/js
ERROR - 2020-02-21 09:02:28 --> 404 Page Not Found: Assets/js
ERROR - 2020-02-21 09:46:01 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-21 09:46:01 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-21 09:46:01 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-21 09:46:01 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-21 09:46:01 --> 404 Page Not Found: Select_data_income_expenses/2020
