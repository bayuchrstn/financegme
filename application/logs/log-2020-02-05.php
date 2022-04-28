<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-02-05 08:25:26 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-05 08:25:26 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-05 08:38:18 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-05 08:38:18 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-05 08:58:29 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-05 08:58:29 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-05 09:06:06 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-05 09:06:06 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-05 09:16:09 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-05 09:16:09 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-05 10:20:59 --> Query error: Unknown column 'c.status' in 'where clause' - Invalid query: SELECT * FROM (SELECT
		z.`id`,
		z.`nomor`,
		z.`nama_site`,
		z.`idcust`,
		z.`tanggalnya`,
		SUM(z.`ppnnya`) AS ppn,
		SUM(z.`nominal`) AS invoice,
		z.`jml_bayar` AS bayar,
		z.`tanggal_invoice`
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
		  a.`tanggal_invoice`
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
		z.`tanggal_invoice` FROM (
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
		  c.`tanggal_invoice`
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
		  ) z GROUP BY z.`id_arpost_merge`) x WHERE c.`status` != 9 AND (x.`nama_site` LIKE '%%' ESCAPE '!' OR 
			x.`nomor` LIKE '%%' ESCAPE '!' OR x.`idcust` LIKE '%%' ESCAPE '!')  AND (x.`tanggal_invoice` BETWEEN '2020-02-01' AND '2020-02-29') ORDER BY x.`tanggal_invoice` ASC
ERROR - 2020-02-05 03:21:02 --> 404 Page Not Found: Assets/js
ERROR - 2020-02-05 03:21:05 --> 404 Page Not Found: Assets/js
ERROR - 2020-02-05 10:21:05 --> Query error: Unknown column 'c.status' in 'where clause' - Invalid query: SELECT * FROM (SELECT
		z.`id`,
		z.`nomor`,
		z.`nama_site`,
		z.`idcust`,
		z.`tanggalnya`,
		SUM(z.`ppnnya`) AS ppn,
		SUM(z.`nominal`) AS invoice,
		z.`jml_bayar` AS bayar,
		z.`tanggal_invoice`
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
		  a.`tanggal_invoice`
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
		z.`tanggal_invoice` FROM (
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
		  c.`tanggal_invoice`
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
		  ) z GROUP BY z.`id_arpost_merge`) x WHERE c.`status` != 9 AND (x.`nama_site` LIKE '%%' ESCAPE '!' OR 
			x.`nomor` LIKE '%%' ESCAPE '!' OR x.`idcust` LIKE '%%' ESCAPE '!')  AND (x.`tanggal_invoice` BETWEEN '2020-02-01' AND '2020-02-29') ORDER BY x.`tanggal_invoice` ASC
ERROR - 2020-02-05 03:22:14 --> 404 Page Not Found: Assets/js
ERROR - 2020-02-05 10:22:14 --> Query error: Unknown column 'z.status' in 'where clause' - Invalid query: SELECT * FROM (SELECT
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
		  ) z GROUP BY z.`id_arpost_merge`) x WHERE z.`status` != 9 AND (x.`nama_site` LIKE '%%' ESCAPE '!' OR 
			x.`nomor` LIKE '%%' ESCAPE '!' OR x.`idcust` LIKE '%%' ESCAPE '!')  AND (x.`tanggal_invoice` BETWEEN '2020-02-01' AND '2020-02-29') ORDER BY x.`tanggal_invoice` ASC
ERROR - 2020-02-05 03:22:18 --> 404 Page Not Found: Assets/js
ERROR - 2020-02-05 03:22:19 --> 404 Page Not Found: Assets/js
ERROR - 2020-02-05 10:22:19 --> Query error: Unknown column 'z.status' in 'where clause' - Invalid query: SELECT * FROM (SELECT
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
		  ) z GROUP BY z.`id_arpost_merge`) x WHERE z.`status` != 9 AND (x.`nama_site` LIKE '%%' ESCAPE '!' OR 
			x.`nomor` LIKE '%%' ESCAPE '!' OR x.`idcust` LIKE '%%' ESCAPE '!')  AND (x.`tanggal_invoice` BETWEEN '2020-02-01' AND '2020-02-29') ORDER BY x.`tanggal_invoice` ASC
ERROR - 2020-02-05 03:22:35 --> 404 Page Not Found: Assets/js
ERROR - 2020-02-05 03:24:52 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-05 03:24:52 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-05 03:24:52 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-05 03:24:52 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-05 03:24:53 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-05 03:34:22 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-05 03:34:22 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-05 03:34:22 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-05 03:34:22 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-05 03:34:22 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-05 03:47:07 --> 404 Page Not Found: Finance_ap_report/get_supplier
ERROR - 2020-02-05 03:47:12 --> 404 Page Not Found: Finance_ap_report/get_supplier
ERROR - 2020-02-05 03:47:33 --> 404 Page Not Found: Finance_ap_report/get_supplier
ERROR - 2020-02-05 03:47:37 --> 404 Page Not Found: Finance_ap_report/get_supplier
ERROR - 2020-02-05 03:47:39 --> 404 Page Not Found: Finance_ap_report/get_supplier
ERROR - 2020-02-05 03:47:40 --> 404 Page Not Found: Finance_ap_report/get_supplier
ERROR - 2020-02-05 03:47:41 --> 404 Page Not Found: Finance_ap_report/get_supplier
ERROR - 2020-02-05 03:47:41 --> 404 Page Not Found: Finance_ap_report/get_supplier
ERROR - 2020-02-05 03:47:41 --> 404 Page Not Found: Finance_ap_report/get_supplier
ERROR - 2020-02-05 03:47:43 --> 404 Page Not Found: Finance_ap_report/get_supplier
ERROR - 2020-02-05 03:47:44 --> 404 Page Not Found: Finance_ap_report/get_supplier
ERROR - 2020-02-05 03:47:44 --> 404 Page Not Found: Finance_ap_report/get_supplier
ERROR - 2020-02-05 03:47:44 --> 404 Page Not Found: Finance_ap_report/get_supplier
ERROR - 2020-02-05 03:47:44 --> 404 Page Not Found: Finance_ap_report/get_supplier
ERROR - 2020-02-05 03:47:53 --> 404 Page Not Found: Finance_ap_report/get_supplier
ERROR - 2020-02-05 03:47:56 --> 404 Page Not Found: Finance_ap_report/get_supplier
ERROR - 2020-02-05 03:47:56 --> 404 Page Not Found: Finance_ap_report/get_supplier
ERROR - 2020-02-05 03:47:56 --> 404 Page Not Found: Finance_ap_report/get_supplier
ERROR - 2020-02-05 03:47:57 --> 404 Page Not Found: Finance_ap_report/get_supplier
ERROR - 2020-02-05 03:47:58 --> 404 Page Not Found: Finance_ap_report/get_supplier
ERROR - 2020-02-05 03:56:44 --> 404 Page Not Found: Assets/js
ERROR - 2020-02-05 11:14:11 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-05 11:14:11 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-05 11:22:59 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-05 11:22:59 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-05 04:34:11 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-05 04:34:11 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-05 04:34:11 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-05 04:34:11 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-05 04:34:11 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-05 14:52:52 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-05 14:52:52 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-05 14:54:38 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-05 14:54:38 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-05 08:00:11 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-05 08:00:11 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-05 08:00:11 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-05 08:00:11 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-05 08:00:11 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-05 15:07:49 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-05 15:07:49 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-05 15:54:03 --> Query error: Unknown column 'a.email_billing' in 'field list' - Invalid query: SELECT *,IF(a.`attention_display`=0,a.`email_billing`,c.`email`) AS email_cust FROM erp_gmedia.`order_header` a LEFT JOIN erp_gmedia.`ms_site` b ON a.`id_site`=b.`id` LEFT JOIN erp_gmedia.`ms_contact` c ON b.`id`=c.`id_site` AND a.`attention_display` = c.`id` WHERE a.`id`=1324
ERROR - 2020-02-05 15:54:11 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 1 - Invalid query: SELECT *,IF(a.`attention_display`=0,a.`email_billing`,c.`email`) AS email_cust FROM erp_gmedia.`order_header` a LEFT JOIN erp_gmedia.`ms_site` b ON a.`id_site`=b.`id` LEFT JOIN erp_gmedia.`ms_contact` c ON b.`id`=c.`id_site` AND a.`attention_display` = c.`id` WHERE a.`id`=
ERROR - 2020-02-05 15:54:20 --> Query error: Unknown column 'a.email_billing' in 'field list' - Invalid query: SELECT *,IF(a.`attention_display`=0,a.`email_billing`,c.`email`) AS email_cust FROM erp_gmedia.`order_header` a LEFT JOIN erp_gmedia.`ms_site` b ON a.`id_site`=b.`id` LEFT JOIN erp_gmedia.`ms_contact` c ON b.`id`=c.`id_site` AND a.`attention_display` = c.`id` WHERE a.`id`=1269
ERROR - 2020-02-05 08:54:37 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-05 08:54:37 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-05 08:54:37 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-05 08:54:37 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-05 08:54:37 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-05 15:54:39 --> Query error: Unknown column 'a.email_billing' in 'field list' - Invalid query: SELECT *,IF(a.`attention_display`=0,a.`email_billing`,c.`email`) AS email_cust FROM erp_gmedia.`order_header` a LEFT JOIN erp_gmedia.`ms_site` b ON a.`id_site`=b.`id` LEFT JOIN erp_gmedia.`ms_contact` c ON b.`id`=c.`id_site` AND a.`attention_display` = c.`id` WHERE a.`id`=1324
ERROR - 2020-02-05 15:54:48 --> Query error: Unknown column 'a.email_billing' in 'field list' - Invalid query: SELECT *,IF(a.`attention_display`=0,a.`email_billing`,c.`email`) AS email_cust FROM erp_gmedia.`order_header` a LEFT JOIN erp_gmedia.`ms_site` b ON a.`id_site`=b.`id` LEFT JOIN erp_gmedia.`ms_contact` c ON b.`id`=c.`id_site` AND a.`attention_display` = c.`id` WHERE a.`id`=1269
ERROR - 2020-02-05 08:55:06 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-05 08:55:06 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-05 08:55:06 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-05 08:55:06 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-05 08:55:06 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-05 16:13:48 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ORDER BY a.nomor asc  LIMIT 0,100' at line 26 - Invalid query: SELECT SQL_CALC_FOUND_ROWS 
        a.*,
          c.nama,
          c.email_billing,
          b.`nama` AS cust,
          b.`idcust`,
          d.id_serv,
          e.`label` AS nama_layanan
        FROM
          erp_gmedia.order_header a
           JOIN erp_gmedia.ms_customers b
            ON b.`id` = a.`id_cust`
           JOIN erp_gmedia.ms_site c
            ON c.`id` = a.`id_site` AND b.`id`=c.`id_cust`
           JOIN erp_gmedia.order_service d
            ON d.`id_order` = a.`id` AND d.status = '1'
           JOIN erp_gmedia.ms_layanan e
          ON d.`id_serv`=e.`id`
          LEFT JOIN erp_gmedia.ms_contact f
          ON c.`id`=f.`id_site` AND a.attention_display=f.id
        WHERE a.`status` = '3' AND (
            `c`.`nama` LIKE '%PT. Mitra Ekspedisi Sejahtera%' ESCAPE '!'
            OR `c`.`email_billing` LIKE '%PT. Mitra Ekspedisi Sejahtera%' ESCAPE '!'
            OR `b`.`nama` LIKE '%PT. Mitra Ekspedisi Sejahtera%' ESCAPE '!'
            OR `e`.`label` LIKE '%PT. Mitra Ekspedisi Sejahtera%' ESCAPE '!'
          ) GROUP BY   ORDER BY a.nomor asc  LIMIT 0,100
ERROR - 2020-02-05 16:13:51 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ORDER BY a.nomor asc  LIMIT 0,100' at line 26 - Invalid query: SELECT SQL_CALC_FOUND_ROWS 
        a.*,
          c.nama,
          c.email_billing,
          b.`nama` AS cust,
          b.`idcust`,
          d.id_serv,
          e.`label` AS nama_layanan
        FROM
          erp_gmedia.order_header a
           JOIN erp_gmedia.ms_customers b
            ON b.`id` = a.`id_cust`
           JOIN erp_gmedia.ms_site c
            ON c.`id` = a.`id_site` AND b.`id`=c.`id_cust`
           JOIN erp_gmedia.order_service d
            ON d.`id_order` = a.`id` AND d.status = '1'
           JOIN erp_gmedia.ms_layanan e
          ON d.`id_serv`=e.`id`
          LEFT JOIN erp_gmedia.ms_contact f
          ON c.`id`=f.`id_site` AND a.attention_display=f.id
        WHERE a.`status` = '3' AND (
            `c`.`nama` LIKE '%PT. Mitra Ekspedisi Sejahtera%' ESCAPE '!'
            OR `c`.`email_billing` LIKE '%PT. Mitra Ekspedisi Sejahtera%' ESCAPE '!'
            OR `b`.`nama` LIKE '%PT. Mitra Ekspedisi Sejahtera%' ESCAPE '!'
            OR `e`.`label` LIKE '%PT. Mitra Ekspedisi Sejahtera%' ESCAPE '!'
          ) GROUP BY   ORDER BY a.nomor asc  LIMIT 0,100
ERROR - 2020-02-05 16:14:11 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ORDER BY a.nomor asc  LIMIT 0,100' at line 26 - Invalid query: SELECT SQL_CALC_FOUND_ROWS 
        a.*,
          c.nama,
          c.email_billing,
          b.`nama` AS cust,
          b.`idcust`,
          d.id_serv,
          e.`label` AS nama_layanan
        FROM
          erp_gmedia.order_header a
           JOIN erp_gmedia.ms_customers b
            ON b.`id` = a.`id_cust`
           JOIN erp_gmedia.ms_site c
            ON c.`id` = a.`id_site` AND b.`id`=c.`id_cust`
           JOIN erp_gmedia.order_service d
            ON d.`id_order` = a.`id` AND d.status = '1'
           JOIN erp_gmedia.ms_layanan e
          ON d.`id_serv`=e.`id`
          LEFT JOIN erp_gmedia.ms_contact f
          ON c.`id`=f.`id_site` AND a.attention_display=f.id
        WHERE a.`status` = '3' AND (
            `c`.`nama` LIKE '%PT. Mitra Ekspedisi Sejahtera%' ESCAPE '!'
            OR `c`.`email_billing` LIKE '%PT. Mitra Ekspedisi Sejahtera%' ESCAPE '!'
            OR `b`.`nama` LIKE '%PT. Mitra Ekspedisi Sejahtera%' ESCAPE '!'
            OR `e`.`label` LIKE '%PT. Mitra Ekspedisi Sejahtera%' ESCAPE '!'
          ) GROUP BY   ORDER BY a.nomor asc  LIMIT 0,100
ERROR - 2020-02-05 16:30:45 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-05 16:30:45 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-05 16:41:34 --> Query error: Unknown column 'a.emailwakil' in 'field list' - Invalid query: SELECT SQL_CALC_FOUND_ROWS 
        a.*,
          c.nama,
          CASE WHEN a.`attention_display`=0
          THEN a.`emailwakil`
          WHEN a.`attention_display`=1
          THEN a.`email_billing`
          ELSE f.`email`
          END AS email_billing,
          b.`nama` AS cust,
          b.`idcust`,
          d.id_serv,
          e.`label` AS nama_layanan
        FROM
          erp_gmedia.order_header a
           JOIN erp_gmedia.ms_customers b
            ON b.`id` = a.`id_cust`
           JOIN erp_gmedia.ms_site c
            ON c.`id` = a.`id_site` AND b.`id`=c.`id_cust`
           JOIN erp_gmedia.order_service d
            ON d.`id_order` = a.`id` AND d.status = '1'
           JOIN erp_gmedia.ms_layanan e
          ON d.`id_serv`=e.`id`
          LEFT JOIN erp_gmedia.ms_contact f
          ON c.`id`=f.`id_site` AND a.attention_display=f.id
        WHERE a.`status` = '3' AND (
            `c`.`nama` LIKE '%f%' ESCAPE '!'
            OR `c`.`email_billing` LIKE '%f%' ESCAPE '!'
            OR `b`.`nama` LIKE '%f%' ESCAPE '!'
            OR `e`.`label` LIKE '%f%' ESCAPE '!'
          )   ORDER BY a.nomor asc  LIMIT 0,100
ERROR - 2020-02-05 16:41:39 --> Query error: Unknown column 'a.emailwakil' in 'field list' - Invalid query: SELECT SQL_CALC_FOUND_ROWS 
        a.*,
          c.nama,
          CASE WHEN a.`attention_display`=0
          THEN a.`emailwakil`
          WHEN a.`attention_display`=1
          THEN a.`email_billing`
          ELSE f.`email`
          END AS email_billing,
          b.`nama` AS cust,
          b.`idcust`,
          d.id_serv,
          e.`label` AS nama_layanan
        FROM
          erp_gmedia.order_header a
           JOIN erp_gmedia.ms_customers b
            ON b.`id` = a.`id_cust`
           JOIN erp_gmedia.ms_site c
            ON c.`id` = a.`id_site` AND b.`id`=c.`id_cust`
           JOIN erp_gmedia.order_service d
            ON d.`id_order` = a.`id` AND d.status = '1'
           JOIN erp_gmedia.ms_layanan e
          ON d.`id_serv`=e.`id`
          LEFT JOIN erp_gmedia.ms_contact f
          ON c.`id`=f.`id_site` AND a.attention_display=f.id
        WHERE a.`status` = '3' AND (
            `c`.`nama` LIKE '%fr%' ESCAPE '!'
            OR `c`.`email_billing` LIKE '%fr%' ESCAPE '!'
            OR `b`.`nama` LIKE '%fr%' ESCAPE '!'
            OR `e`.`label` LIKE '%fr%' ESCAPE '!'
          )   ORDER BY a.nomor asc  LIMIT 0,100
ERROR - 2020-02-05 16:41:46 --> Query error: Unknown column 'a.emailwakil' in 'field list' - Invalid query: SELECT SQL_CALC_FOUND_ROWS 
        a.*,
          c.nama,
          CASE WHEN a.`attention_display`=0
          THEN a.`emailwakil`
          WHEN a.`attention_display`=1
          THEN a.`email_billing`
          ELSE f.`email`
          END AS email_billing,
          b.`nama` AS cust,
          b.`idcust`,
          d.id_serv,
          e.`label` AS nama_layanan
        FROM
          erp_gmedia.order_header a
           JOIN erp_gmedia.ms_customers b
            ON b.`id` = a.`id_cust`
           JOIN erp_gmedia.ms_site c
            ON c.`id` = a.`id_site` AND b.`id`=c.`id_cust`
           JOIN erp_gmedia.order_service d
            ON d.`id_order` = a.`id` AND d.status = '1'
           JOIN erp_gmedia.ms_layanan e
          ON d.`id_serv`=e.`id`
          LEFT JOIN erp_gmedia.ms_contact f
          ON c.`id`=f.`id_site` AND a.attention_display=f.id
        WHERE a.`status` = '3' AND (
            `c`.`nama` LIKE '%%' ESCAPE '!'
            OR `c`.`email_billing` LIKE '%%' ESCAPE '!'
            OR `b`.`nama` LIKE '%%' ESCAPE '!'
            OR `e`.`label` LIKE '%%' ESCAPE '!'
          )   ORDER BY a.nomor asc  LIMIT 0,100
ERROR - 2020-02-05 16:41:49 --> Query error: Unknown column 'a.emailwakil' in 'field list' - Invalid query: SELECT SQL_CALC_FOUND_ROWS 
        a.*,
          c.nama,
          CASE WHEN a.`attention_display`=0
          THEN a.`emailwakil`
          WHEN a.`attention_display`=1
          THEN a.`email_billing`
          ELSE f.`email`
          END AS email_billing,
          b.`nama` AS cust,
          b.`idcust`,
          d.id_serv,
          e.`label` AS nama_layanan
        FROM
          erp_gmedia.order_header a
           JOIN erp_gmedia.ms_customers b
            ON b.`id` = a.`id_cust`
           JOIN erp_gmedia.ms_site c
            ON c.`id` = a.`id_site` AND b.`id`=c.`id_cust`
           JOIN erp_gmedia.order_service d
            ON d.`id_order` = a.`id` AND d.status = '1'
           JOIN erp_gmedia.ms_layanan e
          ON d.`id_serv`=e.`id`
          LEFT JOIN erp_gmedia.ms_contact f
          ON c.`id`=f.`id_site` AND a.attention_display=f.id
        WHERE a.`status` = '3' AND (
            `c`.`nama` LIKE '%%' ESCAPE '!'
            OR `c`.`email_billing` LIKE '%%' ESCAPE '!'
            OR `b`.`nama` LIKE '%%' ESCAPE '!'
            OR `e`.`label` LIKE '%%' ESCAPE '!'
          )   ORDER BY a.nomor asc  LIMIT 0,100
ERROR - 2020-02-05 09:42:01 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-05 09:42:01 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-05 09:42:01 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-05 09:42:01 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-05 09:42:01 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-05 16:44:17 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 484
ERROR - 2020-02-05 16:55:26 --> Query error: Unknown column 'b.npwp' in 'field list' - Invalid query: SELECT a.id,a.id_site,b.npwp,b.alamat2,a.materai,a.installasi,CASE WHEN a.`attention_display`=0
        THEN b.`emailwakil`
        WHEN a.`attention_display`=1
        THEN b.`email_billing`
        ELSE c.`email`
        END AS email_cust FROM erp_gmedia.`order_header` a LEFT JOIN erp_gmedia.`ms_site` b ON a.`id_site`=b.`id` LEFT JOIN erp_gmedia.`ms_contact` c ON b.`id`=c.`id_site` AND a.`attention_display` = c.`id` WHERE a.`id`=1332
ERROR - 2020-02-05 10:06:52 --> 404 Page Not Found: Assets/js
ERROR - 2020-02-05 17:45:01 --> 404 Page Not Found: Assets/js
ERROR - 2020-02-05 17:45:17 --> 404 Page Not Found: Assets/js
ERROR - 2020-02-05 17:45:28 --> 404 Page Not Found: Assets/js
ERROR - 2020-02-05 17:45:40 --> 404 Page Not Found: Assets/js
ERROR - 2020-02-05 17:46:08 --> 404 Page Not Found: Assets/js
ERROR - 2020-02-05 17:46:36 --> 404 Page Not Found: Assets/js
ERROR - 2020-02-05 17:47:45 --> 404 Page Not Found: Assets/js
ERROR - 2020-02-05 18:05:45 --> 404 Page Not Found: Assets/js
