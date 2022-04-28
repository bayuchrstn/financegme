<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-04-03 07:35:11 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-03 07:35:11 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-03 07:35:13 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-30'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-04-30'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-04-30')
ERROR - 2020-04-03 07:35:34 --> Severity: Warning --> move_uploaded_file(./assets/generate/excel/buku bank/2020/April/7d002913c61cd61a8c673cb9c009403b.xls): failed to open stream: Permission denied /data/www/html/erpsmg/finance_gmedia/application/libraries/ImportFile.php 65
ERROR - 2020-04-03 07:35:34 --> Severity: Warning --> move_uploaded_file(): Unable to move '/tmp/phpEbLRGt' to './assets/generate/excel/buku bank/2020/April/7d002913c61cd61a8c673cb9c009403b.xls' /data/www/html/erpsmg/finance_gmedia/application/libraries/ImportFile.php 65
ERROR - 2020-04-03 07:35:34 --> Severity: Notice --> Undefined variable: objPHPExcel /data/www/html/erpsmg/finance_gmedia/application/libraries/ImportFile.php 76
ERROR - 2020-04-03 07:35:34 --> Severity: error --> Exception: Call to a member function getSheetCount() on null /data/www/html/erpsmg/finance_gmedia/application/libraries/ImportFile.php 76
ERROR - 2020-04-03 00:35:37 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-03 07:35:49 --> Severity: Warning --> move_uploaded_file(./assets/generate/excel/buku bank/2020/April/2a7babb1f6f7b1d9685e0aa0bec7b70e.csv): failed to open stream: Permission denied /data/www/html/erpsmg/finance_gmedia/application/libraries/ImportFile.php 65
ERROR - 2020-04-03 07:35:49 --> Severity: Warning --> move_uploaded_file(): Unable to move '/tmp/php58iNKz' to './assets/generate/excel/buku bank/2020/April/2a7babb1f6f7b1d9685e0aa0bec7b70e.csv' /data/www/html/erpsmg/finance_gmedia/application/libraries/ImportFile.php 65
ERROR - 2020-04-03 07:35:49 --> Severity: Notice --> Undefined variable: objPHPExcel /data/www/html/erpsmg/finance_gmedia/application/libraries/ImportFile.php 76
ERROR - 2020-04-03 07:35:49 --> Severity: error --> Exception: Call to a member function getSheetCount() on null /data/www/html/erpsmg/finance_gmedia/application/libraries/ImportFile.php 76
ERROR - 2020-04-03 01:21:52 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-03 01:27:14 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-03 01:27:56 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-03 01:28:21 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-03 01:29:11 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-03 01:29:44 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-03 03:12:42 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-03 10:17:58 --> Severity: Notice --> Undefined variable: highcol /data/www/html/erpsmg/finance_gmedia/application/libraries/ImportFile.php 85
ERROR - 2020-04-03 10:17:58 --> Severity: error --> Exception: Invalid cell coordinate 23 /data/www/html/erpsmg/finance_gmedia/application/libraries/PHPExcel/Cell.php 546
ERROR - 2020-04-03 10:18:00 --> Severity: Notice --> Undefined variable: highcol /data/www/html/erpsmg/finance_gmedia/application/libraries/ImportFile.php 85
ERROR - 2020-04-03 10:18:00 --> Severity: error --> Exception: Invalid cell coordinate 6 /data/www/html/erpsmg/finance_gmedia/application/libraries/PHPExcel/Cell.php 546
ERROR - 2020-04-03 10:45:43 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-03 10:45:43 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-03 10:45:45 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-30'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-04-30'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-04-30')
ERROR - 2020-04-03 10:50:47 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-03 10:50:47 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-03 10:51:00 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-30'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-04-30'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-04-30')
ERROR - 2020-04-03 03:51:16 --> 404 Page Not Found: Finance_report_buku_bank/upload_file_
ERROR - 2020-04-03 10:52:13 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-03 10:52:13 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-03 10:52:19 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-30'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-04-30'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-04-30')
ERROR - 2020-04-03 11:00:56 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 1 - Invalid query: SELECT id_gl,kat_gl,nomor FROM erp_financev2.`gmd_finance_ap_invoice` WHERE id=
ERROR - 2020-04-03 11:02:00 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND a.`status`!=9' at line 1 - Invalid query: SELECT a.flag FROM erp_financev2.`gmd_finance_ap_invoice` a WHERE a.`id`= AND a.`status`!=9
ERROR - 2020-04-03 11:02:58 --> Severity: Notice --> Undefined property: stdClass::$tanggalnya /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 442
ERROR - 2020-04-03 11:02:58 --> Severity: Notice --> Undefined property: stdClass::$tanggalnya /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 442
ERROR - 2020-04-03 11:02:58 --> Severity: Notice --> Undefined property: stdClass::$tanggalnya /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 442
ERROR - 2020-04-03 11:04:17 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 454
ERROR - 2020-04-03 11:07:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 454
ERROR - 2020-04-03 11:07:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 454
ERROR - 2020-04-03 11:14:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 456
ERROR - 2020-04-03 11:19:58 --> Query error: SELECT command denied to user 'erp'@'103.255.240.2' for table 'gmd_finance_ap_invoice' - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.*,
		DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya,
		DATE_FORMAT(a.date_due, '%d-%m-%Y') AS date_duenya,
		IF(a.supplier = 0, 'LAIN2', b.nama) AS nama_sup
	  FROM
		rp_financev2.`gmd_finance_ap_invoice` a
		LEFT JOIN  inventory_v2.`ms_perusahaan` b
		  ON `a`.`supplier` = `b`.`id_perusahaan`
	  WHERE (
		`a`.`no_referensi` LIKE '%%' ESCAPE '!'
            OR `a`.`nomor` LIKE '%%' ESCAPE '!'
			OR `b`.`nama` LIKE '%%' ESCAPE '!'
		)
		AND (
			a.`insert_at` BETWEEN '2020-04-03'
            AND '2020-04-30'
		)
		AND `a`.`branch` = '8' AND a.`status`=1  AND a.`lunas` = 0
	  ORDER BY a.nomor desc  LIMIT 0,100
ERROR - 2020-04-03 14:14:26 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-03 14:14:26 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-03 14:14:28 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-30'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-04-30'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-04-30')
ERROR - 2020-04-03 15:07:45 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-03 15:07:45 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-03 15:07:46 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-30'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-04-30'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-04-30')
ERROR - 2020-04-03 08:28:11 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-04-03 08:28:11 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-04-03 08:28:11 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-04-03 08:28:11 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-04-03 08:28:11 --> 404 Page Not Found: Select_data_income_expenses/2020
