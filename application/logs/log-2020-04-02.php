<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-04-02 07:58:29 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-02 07:58:29 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-02 07:58:32 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-30'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-04-30'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-04-30')
ERROR - 2020-04-02 07:58:46 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT a.*, date_format(a.tanggal, '%d-%m-%Y') as date_invoicenya, date_format(a.date_due, '%d-%m-%Y') as date_duenya, if(a.supplier = 0, 'Lain2', b.nama) as nama_supplier, COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-02'), 0) AS bayar, DATEDIFF('2020-04-02', a.date_due) as aging
FROM `gmd_finance_ap_invoice` AS `a`
LEFT JOIN `gmd_finance_supplier` `b` ON `a`.`supplier` = `b`.`id`
WHERE `a`.`branch` = '8'
AND `a`.`supplier` = '77'
AND (a.date_paid = '' OR a.date_paid IS NULL)
GROUP BY `a`.`id`
ORDER BY `b`.`nama` ASC, `a`.`tanggal` ASC, `a`.`no_referensi` ASC
ERROR - 2020-04-02 08:00:58 --> Query error: Table 'erp_financev2.gmd_inance_ap_invoice' doesn't exist - Invalid query: SELECT a.*, date_format(a.tanggal, '%d-%m-%Y') as date_invoicenya, date_format(a.date_due, '%d-%m-%Y') as date_duenya, if(a.supplier = 0, 'Lain2', b.nama) as nama_supplier, COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-02'), 0) AS bayar, DATEDIFF('2020-04-02', a.date_due) as aging
FROM `gmd_inance_ap_invoice` AS `a`
LEFT JOIN `gmd_finance_supplier` `b` ON `a`.`supplier` = `b`.`id`
WHERE `a`.`branch` = '8'
AND `a`.`supplier` = '77'
AND (a.date_paid = '' OR a.date_paid IS NULL)
GROUP BY `a`.`id`
ORDER BY `b`.`nama` ASC, `a`.`tanggal` ASC, `a`.`no_referensi` ASC
ERROR - 2020-04-02 08:12:54 --> Severity: Notice --> Undefined index: deskripsi /data/www/html/erpsmg/finance_gmedia/application/views/finance_ap_report_od/report.php 84
ERROR - 2020-04-02 01:52:57 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-02 09:46:25 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-02 09:46:25 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-02 09:46:28 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-30'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-04-30'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-04-30')
ERROR - 2020-04-02 10:19:42 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-02 10:19:42 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-02 10:31:06 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2020-04-02 11:16:10 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-02 11:16:10 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-02 11:16:11 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-30'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-04-30'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-04-30')
ERROR - 2020-04-02 04:18:14 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-04-02 04:18:14 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-04-02 04:18:14 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-04-02 04:18:14 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-04-02 04:18:14 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-04-02 04:22:24 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-02 04:37:29 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-04-02 04:37:29 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-04-02 04:37:29 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-04-02 04:37:29 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-04-02 04:37:29 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-04-02 11:50:43 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-02 11:50:43 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-02 11:50:44 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-30'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-04-30'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-04-30')
ERROR - 2020-04-02 12:31:12 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-30'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-04-30'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-04-30')
ERROR - 2020-04-02 13:08:27 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-30'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-04-30'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-04-30')
ERROR - 2020-04-02 13:42:17 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-02 13:42:17 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-02 13:42:18 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-30'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-04-30'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-04-30')
ERROR - 2020-04-02 06:43:43 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-04-02 06:43:43 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-04-02 06:43:43 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-04-02 06:43:43 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-04-02 06:43:43 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-04-02 08:08:19 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-04-02 08:08:19 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-04-02 08:08:19 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-04-02 08:08:20 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-04-02 08:08:20 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-04-02 08:23:16 --> 404 Page Not Found: Assets/invoice
ERROR - 2020-04-02 08:23:16 --> 404 Page Not Found: Assets/invoice
ERROR - 2020-04-02 08:25:28 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-04-02 08:25:28 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-04-02 08:25:28 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-04-02 08:25:28 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-04-02 08:25:28 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-04-02 15:33:26 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-02 15:33:26 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-02 15:33:27 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-30'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-04-30'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-04-30')
ERROR - 2020-04-02 08:34:25 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-02 15:34:50 --> Severity: Warning --> move_uploaded_file(./assets/generate/excel/buku bank/2020/April/7d002913c61cd61a8c673cb9c009403b.xls): failed to open stream: Permission denied /data/www/html/erpsmg/finance_gmedia/application/libraries/ImportFile.php 65
ERROR - 2020-04-02 15:34:50 --> Severity: Warning --> move_uploaded_file(): Unable to move '/tmp/phpL5JeyN' to './assets/generate/excel/buku bank/2020/April/7d002913c61cd61a8c673cb9c009403b.xls' /data/www/html/erpsmg/finance_gmedia/application/libraries/ImportFile.php 65
ERROR - 2020-04-02 15:34:50 --> Severity: Notice --> Undefined variable: objPHPExcel /data/www/html/erpsmg/finance_gmedia/application/libraries/ImportFile.php 76
ERROR - 2020-04-02 15:34:50 --> Severity: error --> Exception: Call to a member function getSheetCount() on null /data/www/html/erpsmg/finance_gmedia/application/libraries/ImportFile.php 76
ERROR - 2020-04-02 08:59:50 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-04-02 08:59:50 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-04-02 08:59:50 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-04-02 08:59:50 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-04-02 08:59:50 --> 404 Page Not Found: Select_data_cash_month/2020
