<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-01-13 09:23:03 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 459
ERROR - 2020-01-13 09:26:35 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 459
ERROR - 2020-01-13 09:30:20 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 459
ERROR - 2020-01-13 09:33:30 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 459
ERROR - 2020-01-13 09:36:28 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 459
ERROR - 2020-01-13 09:36:51 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2020-01-13 09:40:36 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 459
ERROR - 2020-01-13 09:43:30 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 459
ERROR - 2020-01-13 09:51:16 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 459
ERROR - 2020-01-13 10:03:59 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 459
ERROR - 2020-01-13 10:09:01 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 459
ERROR - 2020-01-13 10:14:19 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 459
ERROR - 2020-01-13 10:22:51 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 459
ERROR - 2020-01-13 10:29:10 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 459
ERROR - 2020-01-13 03:48:45 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-13 03:48:45 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-13 03:48:45 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-01-13 03:48:45 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-13 03:48:45 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-13 10:57:55 --> Invalid query: 
ERROR - 2020-01-13 10:58:18 --> Query error: Table 'erp_financev2.gmd_inance_ap_invoice' doesn't exist - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.*, DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya, DATE_FORMAT(a.date_due, '%d-%m-%Y') AS date_duenya, if(a.supplier = 0, 'LAIN2', b.nama) as nama_sup
FROM `gmd_inance_ap_invoice` `a`
LEFT JOIN `gmd_finance_supplier` `b` ON `a`.`supplier` = `b`.`id`
WHERE   (
`a`.`no_referensi` LIKE '%%' ESCAPE '!'
OR  `a`.`nomor` LIKE '%%' ESCAPE '!'
OR  `b`.`nama` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2020-01-01' and '2020-01-31')
AND `a`.`branch` = '8'
ORDER BY `a`.`tanggal` DESC
 LIMIT 100
ERROR - 2020-01-13 11:05:19 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'OR `b`.`nama` LIKE '%%' ESCAPE '!'
		)
		AND (
			a.`tanggal` BETWEEN '2020-01-0' at line 13 - Invalid query: SELECT
		SQL_CALC_FOUND_ROWS a.*,
		DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya,
		DATE_FORMAT(a.date_due, '%d-%m-%Y') AS date_duenya,
		IF(a.supplier = 0, 'LAIN2', b.nama) AS nama_sup
	  FROM
		erp_financev2.`gmd_finance_ap_invoice` a
		LEFT JOIN  inventory_v2.`ms_perusahaan` b
		  ON `a`.`supplier` = `b`.`id_perusahaan`
	  WHERE (
		`a`.`no_referensi` LIKE '%%' ESCAPE '!'
            OR `a`.`nomor` LIKE '%%' ESCAPE '!'
			OR  OR `b`.`nama` LIKE '%%' ESCAPE '!'
		)
		AND (
			a.`tanggal` BETWEEN '2020-01-01'
            AND '2020-01-31'
		)
		AND `a`.`branch` = '8'
	  ORDER BY a.tanggal desc  LIMIT 0,100
ERROR - 2020-01-13 11:05:22 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'OR `b`.`nama` LIKE '%%' ESCAPE '!'
		)
		AND (
			a.`tanggal` BETWEEN '2020-01-0' at line 13 - Invalid query: SELECT
		SQL_CALC_FOUND_ROWS a.*,
		DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya,
		DATE_FORMAT(a.date_due, '%d-%m-%Y') AS date_duenya,
		IF(a.supplier = 0, 'LAIN2', b.nama) AS nama_sup
	  FROM
		erp_financev2.`gmd_finance_ap_invoice` a
		LEFT JOIN  inventory_v2.`ms_perusahaan` b
		  ON `a`.`supplier` = `b`.`id_perusahaan`
	  WHERE (
		`a`.`no_referensi` LIKE '%%' ESCAPE '!'
            OR `a`.`nomor` LIKE '%%' ESCAPE '!'
			OR  OR `b`.`nama` LIKE '%%' ESCAPE '!'
		)
		AND (
			a.`tanggal` BETWEEN '2020-01-01'
            AND '2020-01-31'
		)
		AND `a`.`branch` = '8'
	  ORDER BY a.tanggal desc  LIMIT 0,100
ERROR - 2020-01-13 11:05:26 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'OR `b`.`nama` LIKE '%%' ESCAPE '!'
		)
		AND (
			a.`tanggal` BETWEEN '2020-01-0' at line 13 - Invalid query: SELECT
		SQL_CALC_FOUND_ROWS a.*,
		DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya,
		DATE_FORMAT(a.date_due, '%d-%m-%Y') AS date_duenya,
		IF(a.supplier = 0, 'LAIN2', b.nama) AS nama_sup
	  FROM
		erp_financev2.`gmd_finance_ap_invoice` a
		LEFT JOIN  inventory_v2.`ms_perusahaan` b
		  ON `a`.`supplier` = `b`.`id_perusahaan`
	  WHERE (
		`a`.`no_referensi` LIKE '%%' ESCAPE '!'
            OR `a`.`nomor` LIKE '%%' ESCAPE '!'
			OR  OR `b`.`nama` LIKE '%%' ESCAPE '!'
		)
		AND (
			a.`tanggal` BETWEEN '2020-01-01'
            AND '2020-01-31'
		)
		AND `a`.`branch` = '8'
	  ORDER BY a.tanggal desc  LIMIT 0,100
ERROR - 2020-01-13 11:06:35 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2020-01-13 11:06:37 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2020-01-13 11:06:44 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2020-01-13 11:07:26 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2020-01-13 11:07:48 --> Query error: Unknown column 'a.invoice_id' in 'where clause' - Invalid query: SELECT a.*
FROM `gmd_finance_ap_invoice_detail` AS `a`
WHERE `a`.`invoice_id` = '2'
ORDER BY `a`.`deskripsi` ASC
ERROR - 2020-01-13 11:09:20 --> Query error: Unknown column 'a.invoice_id' in 'where clause' - Invalid query: SELECT a.*
FROM `gmd_finance_ap_invoice_detail` AS `a`
WHERE `a`.`invoice_id` = '2'
ORDER BY `a`.`deskripsi` ASC
ERROR - 2020-01-13 11:09:27 --> Query error: Unknown column 'a.invoice_id' in 'where clause' - Invalid query: SELECT a.*
FROM `gmd_finance_ap_invoice_detail` AS `a`
WHERE `a`.`invoice_id` IS NULL
ORDER BY `a`.`deskripsi` ASC
ERROR - 2020-01-13 11:14:49 --> Query error: Unknown column 'a.invoice_id' in 'where clause' - Invalid query: SELECT a.*
FROM `gmd_finance_ap_invoice_detail` AS `a`
WHERE `a`.`invoice_id` IS NULL
ORDER BY `a`.`deskripsi` ASC
ERROR - 2020-01-13 11:16:22 --> Query error: Unknown column 'a.invoice_id' in 'where clause' - Invalid query: SELECT a.*
FROM `gmd_finance_ap_invoice_detail` AS `a`
WHERE `a`.`invoice_id` IS NULL
ORDER BY `a`.`deskripsi` ASC
ERROR - 2020-01-13 04:48:00 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-13 04:48:00 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-13 04:48:00 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-01-13 04:48:01 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-13 04:48:01 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-13 07:32:06 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-13 07:32:06 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-01-13 07:32:06 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-13 07:32:06 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-13 07:32:06 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-13 08:38:53 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-13 08:38:53 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-13 08:38:53 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-01-13 08:38:53 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-13 08:38:53 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-13 08:51:10 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-13 08:51:10 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-13 08:51:10 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-01-13 08:51:10 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-13 08:51:10 --> 404 Page Not Found: Select_data_income_expenses/2020
