<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-02-27 08:24:02 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-27 08:24:02 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-27 08:26:45 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-27 08:26:45 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-27 08:30:00 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-27 08:30:00 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-27 08:30:42 --> Severity: error --> Exception: /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_isolir.php exists, but doesn't declare class Model_finance_customer_isolir /data/www/html/erpsmg/finance_gmedia/system/core/Loader.php 336
ERROR - 2020-02-27 08:42:52 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-27 08:42:52 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-27 08:46:49 --> Query error: Unknown column 'a.sementara' in 'field list' - Invalid query: SELECT SQL_CALC_FOUND_ROWS 
        a.`id`,  
          d.`idcust`,
          d.`nama` as nama_cust,
          a.`sementara`,
          a.`reason`,
          a.`tanggal`,
          a.`timestamp`,
          c.`nama` as nama_site
        FROM
          gmedia_erp_project.`task_terminate` a
          JOIN gmedia_erp_project.`order_header` b
            ON a.`nomor_order_header` = b.`nomor_order`
          JOIN erp_gmedia.`ms_site` c
            ON b.`id_site` = c.`id`
          JOIN erp_gmedia.`ms_customers` d
            ON c.`id_cust` = d.`id`
        WHERE
        (
            `c`.`nama` LIKE '%%' ESCAPE '!'
            OR `d`.`idcust` LIKE '%%' ESCAPE '!'
            OR `d`.`nama` LIKE '%%' ESCAPE '!'
            OR `a`.`alasan_terminate` LIKE '%%' ESCAPE '!'
          )  AND (a.`tanggal` BETWEEN '' AND '2020-02-29') GROUP BY a.`id`  ORDER BY d.nama asc  LIMIT 0,100
ERROR - 2020-02-27 08:48:34 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-27 08:48:34 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-27 08:52:34 --> Query error: Unknown column 'a.tanggal' in 'where clause' - Invalid query: SELECT SQL_CALC_FOUND_ROWS 
        a.`id`,  
          d.`idcust`,
          d.`nama` as nama_cust,
          a.`nomor_order_so` AS nomor_so,
          a.`jenis_terminate`,
          a.`alasan_terminate`,
          a.`tgl_terminate`,
          a.`tgl_dismantle`,
          c.`nama` as nama_site
        FROM
          gmedia_erp_project.`task_terminate` a
          JOIN gmedia_erp_project.`order_header` b
            ON a.`nomor_order_header` = b.`nomor_order`
          JOIN erp_gmedia.`ms_site` c
            ON b.`id_site` = c.`id`
          JOIN erp_gmedia.`ms_customers` d
            ON c.`id_cust` = d.`id`
        WHERE
        (
            `c`.`nama` LIKE '%%' ESCAPE '!'
            OR `d`.`idcust` LIKE '%%' ESCAPE '!'
            OR `d`.`nama` LIKE '%%' ESCAPE '!'
            OR `a`.`alasan_terminate` LIKE '%%' ESCAPE '!'
          )  AND (a.`tanggal` BETWEEN '' AND '2020-02-29') GROUP BY a.`id`  ORDER BY d.nama asc  LIMIT 0,100
ERROR - 2020-02-27 08:56:41 --> Query error: Unknown column 'a.tanggal' in 'where clause' - Invalid query: SELECT SQL_CALC_FOUND_ROWS 
        a.`id`,  
          d.`idcust`,
          d.`nama` as nama_cust,
          a.`nomor_order_so` AS nomor_so,
          a.`jenis_terminate`,
          a.`alasan_terminate`,
          a.`tgl_terminate`,
          a.`tgl_dismantle`,
          c.`nama` as nama_site
        FROM
          gmedia_erp_project.`task_terminate` a
          JOIN gmedia_erp_project.`order_header` b
            ON a.`nomor_order_header` = b.`nomor_order`
          JOIN erp_gmedia.`ms_site` c
            ON b.`id_site` = c.`id`
          JOIN erp_gmedia.`ms_customers` d
            ON c.`id_cust` = d.`id`
        WHERE
        (
            `c`.`nama` LIKE '%%' ESCAPE '!'
            OR `d`.`idcust` LIKE '%%' ESCAPE '!'
            OR `d`.`nama` LIKE '%%' ESCAPE '!'
            OR `a`.`alasan_terminate` LIKE '%%' ESCAPE '!'
          )  AND (a.`tanggal` BETWEEN '' AND '2020-02-29') GROUP BY a.`id`  ORDER BY d.nama asc  LIMIT 0,100
ERROR - 2020-02-27 08:57:07 --> Query error: Unknown column 'a.tanggal' in 'where clause' - Invalid query: SELECT SQL_CALC_FOUND_ROWS 
        a.`id`,  
          d.`idcust`,
          d.`nama` as nama_cust,
          a.`nomor_order_so` AS nomor_so,
          a.`jenis_terminate`,
          a.`alasan_terminate`,
          a.`tgl_terminate`,
          a.`tgl_dismantle`,
          c.`nama` as nama_site
        FROM
          gmedia_erp_project.`task_terminate` a
          JOIN gmedia_erp_project.`order_header` b
            ON a.`nomor_order_header` = b.`nomor_order`
          JOIN erp_gmedia.`ms_site` c
            ON b.`id_site` = c.`id`
          JOIN erp_gmedia.`ms_customers` d
            ON c.`id_cust` = d.`id`
        WHERE
        (
            `c`.`nama` LIKE '%%' ESCAPE '!'
            OR `d`.`idcust` LIKE '%%' ESCAPE '!'
            OR `d`.`nama` LIKE '%%' ESCAPE '!'
            OR `a`.`alasan_terminate` LIKE '%%' ESCAPE '!'
          )  AND (a.`tanggal` BETWEEN '2020-02-1' AND '2020-02-29') GROUP BY a.`id`  ORDER BY d.nama asc  LIMIT 0,100
ERROR - 2020-02-27 08:59:11 --> Query error: Unknown column 'a.tanggal' in 'where clause' - Invalid query: SELECT SQL_CALC_FOUND_ROWS 
        a.`id`,  
          d.`idcust`,
          d.`nama` as nama_cust,
          a.`nomor_order_so` AS nomor_so,
          a.`jenis_terminate`,
          a.`alasan_terminate`,
          a.`tgl_terminate`,
          a.`tgl_dismantle`,
          c.`nama` as nama_site,
          a.`status`
        FROM
          gmedia_erp_project.`task_terminate` a
          JOIN gmedia_erp_project.`order_header` b
            ON a.`nomor_order_header` = b.`nomor_order`
          JOIN erp_gmedia.`ms_site` c
            ON b.`id_site` = c.`id`
          JOIN erp_gmedia.`ms_customers` d
            ON c.`id_cust` = d.`id`
        WHERE
        (
            `c`.`nama` LIKE '%%' ESCAPE '!'
            OR `d`.`idcust` LIKE '%%' ESCAPE '!'
            OR `d`.`nama` LIKE '%%' ESCAPE '!'
            OR `a`.`alasan_terminate` LIKE '%%' ESCAPE '!'
          )  AND (a.`tanggal` BETWEEN '2020-02-1' AND '2020-02-29') GROUP BY a.`id`  ORDER BY d.nama asc  LIMIT 0,100
ERROR - 2020-02-27 08:59:17 --> Query error: Unknown column 'a.tanggal' in 'where clause' - Invalid query: SELECT SQL_CALC_FOUND_ROWS 
        a.`id`,  
          d.`idcust`,
          d.`nama` as nama_cust,
          a.`nomor_order_so` AS nomor_so,
          a.`jenis_terminate`,
          a.`alasan_terminate`,
          a.`tgl_terminate`,
          a.`tgl_dismantle`,
          c.`nama` as nama_site,
          a.`status`
        FROM
          gmedia_erp_project.`task_terminate` a
          JOIN gmedia_erp_project.`order_header` b
            ON a.`nomor_order_header` = b.`nomor_order`
          JOIN erp_gmedia.`ms_site` c
            ON b.`id_site` = c.`id`
          JOIN erp_gmedia.`ms_customers` d
            ON c.`id_cust` = d.`id`
        WHERE
        (
            `c`.`nama` LIKE '%%' ESCAPE '!'
            OR `d`.`idcust` LIKE '%%' ESCAPE '!'
            OR `d`.`nama` LIKE '%%' ESCAPE '!'
            OR `a`.`alasan_terminate` LIKE '%%' ESCAPE '!'
          )  AND (a.`tanggal` BETWEEN '2020-02-1' AND '2020-02-29') GROUP BY a.`id`  ORDER BY d.nama asc  LIMIT 0,100
ERROR - 2020-02-27 02:56:45 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-27 02:56:45 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-27 02:56:45 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-27 02:56:46 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-27 02:56:46 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-27 03:01:31 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-27 03:01:31 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-27 03:01:31 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-27 03:01:32 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-27 03:01:32 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-27 10:04:01 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_transaksi_kas_kecil.php 413
ERROR - 2020-02-27 10:04:43 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_transaksi_kas_kecil.php 413
ERROR - 2020-02-27 10:04:52 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_transaksi_kas_kecil.php 413
ERROR - 2020-02-27 10:06:35 --> Severity: Warning --> A non-numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 84
ERROR - 2020-02-27 10:06:39 --> Severity: Warning --> A non-numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 84
ERROR - 2020-02-27 10:06:45 --> Severity: Warning --> A non-numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 84
ERROR - 2020-02-27 03:15:04 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-27 03:15:04 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-27 03:15:04 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-27 03:15:04 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-27 03:15:04 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-27 03:31:11 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-27 03:31:11 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-27 03:31:11 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-27 03:31:11 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-27 03:31:11 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-27 10:36:14 --> Severity: Warning --> A non-numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 84
ERROR - 2020-02-27 03:38:39 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-27 03:38:39 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-27 03:38:39 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-27 03:38:39 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-27 03:38:39 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-27 11:27:41 --> Severity: Warning --> A non-numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 86
ERROR - 2020-02-27 11:44:44 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '%' ESCAPE '!' OR 
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
ERROR - 2020-02-27 11:45:39 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '%' ESCAPE '!' OR 
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
ERROR - 2020-02-27 11:46:09 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '%' ESCAPE '!' OR 
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
ERROR - 2020-02-27 11:53:41 --> Severity: Warning --> A non-numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 86
ERROR - 2020-02-27 11:54:39 --> Severity: Warning --> A non-numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 86
ERROR - 2020-02-27 11:55:49 --> Severity: Warning --> A non-numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 86
ERROR - 2020-02-27 05:05:27 --> 404 Page Not Found: Assets/js
ERROR - 2020-02-27 14:13:29 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-27 14:13:29 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-27 14:40:40 --> Query error: Unknown column 'c.nama' in 'where clause' - Invalid query: SELECT a.`nomor_order` FROM gmedia_erp_project.`so_order_header` a LEFT JOIN gmedia_erp_project.`order_header` b ON a.`nomor_order_header`=b.`nomor_order` WHERE b.`id_site` =4674 AND (
						c.`nama` LIKE '%%' ESCAPE '!' OR b.`nama` LIKE '%%' ESCAPE '!' )
						ORDER BY c.`nama` ASC LIMIT 25
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 15:01:19 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 08:54:37 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-27 08:54:37 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-27 08:54:37 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-27 08:54:37 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-27 08:54:37 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-27 15:56:44 --> Severity: Warning --> A non-numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 86
ERROR - 2020-02-27 15:58:32 --> Severity: Warning --> A non-numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 86
ERROR - 2020-02-27 16:00:39 --> Severity: Warning --> A non-numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 86
ERROR - 2020-02-27 16:02:13 --> Severity: Warning --> A non-numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 86
ERROR - 2020-02-27 16:24:51 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-27 16:24:51 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-27 16:25:32 --> Severity: Warning --> A non-numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 86
ERROR - 2020-02-27 16:27:01 --> Severity: Warning --> A non-numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 86
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:27:07 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-27 16:33:08 --> Severity: Warning --> A non-numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 85
ERROR - 2020-02-27 10:05:04 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-27 10:05:04 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-27 10:05:04 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-27 10:05:04 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-27 10:05:04 --> 404 Page Not Found: Select_data_income_expenses/2020
