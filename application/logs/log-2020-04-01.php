<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-04-01 08:03:02 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-01 08:03:02 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-01 08:03:04 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-30'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-04-30'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-04-30')
ERROR - 2020-04-01 09:33:01 --> Severity: Notice --> Undefined index: deskripsi /data/www/html/erpsmg/finance_gmedia/application/views/finance_ap_report/report.php 47
ERROR - 2020-04-01 09:33:01 --> Severity: Notice --> Undefined index: deskripsi /data/www/html/erpsmg/finance_gmedia/application/views/finance_ap_report/report.php 47
ERROR - 2020-04-01 09:34:11 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-01 09:34:11 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-01 09:34:15 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-30'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-04-30'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-04-30')
ERROR - 2020-04-01 09:39:19 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2020-04-01 10:03:54 --> Severity: Notice --> Undefined offset: 1 /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 547
ERROR - 2020-04-01 10:04:52 --> Severity: Notice --> Undefined offset: 1 /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 547
ERROR - 2020-04-01 03:04:57 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-01 10:05:08 --> Severity: Notice --> Undefined offset: 1 /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 547
ERROR - 2020-04-01 10:11:54 --> Query error: Incorrect date value: '' for column 'tanggal' at row 1 - Invalid query: INSERT INTO `transaksi` (`id_order`, `id_cust`, `id_order_service`, `nomor`, `tanggal`, `nominal`, `jenis_transaksi`, `keterangan`, `flag`, `status`, `id_user`, `timestamp`) VALUES ('1543', '2525', '1872', '03.0765-0320', '', 3000, 'MT', '', 'D', 1, '111186', '2020-04-01 10:11:54')
ERROR - 2020-04-01 03:11:58 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-01 10:12:05 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND id_site=' at line 1 - Invalid query: SELECT attention_display FROM erp_gmedia.`order_header` WHERE id= AND id_site=
ERROR - 2020-04-01 10:12:14 --> Query error: Incorrect date value: '' for column 'tanggal' at row 1 - Invalid query: INSERT INTO `transaksi` (`id_order`, `id_cust`, `id_order_service`, `nomor`, `tanggal`, `nominal`, `jenis_transaksi`, `keterangan`, `flag`, `status`, `id_user`, `timestamp`) VALUES ('1543', '2525', '1872', '03.0765-0320', '', 3000, 'MT', '', 'D', 1, '111186', '2020-04-01 10:12:14')
ERROR - 2020-04-01 10:53:32 --> Query error: Table 'erp_financev2.gmd_inance_ap_invoice' doesn't exist - Invalid query: SELECT a.*, date_format(a.tanggal, '%d-%m-%Y') as date_invoicenya, date_format(a.date_due, '%d-%m-%Y') as date_duenya, if(a.supplier = 0, 'Lain2', b.nama) as nama_supplier, (a.jumlah - a.bayar) as piutang, DATEDIFF('2020-04-01', a.date_due) as aging
FROM `gmd_inance_ap_invoice` AS `a`
LEFT JOIN `gmd_finance_supplier` `b` ON `a`.`supplier` = `b`.`id`
WHERE `a`.`supplier` = '77'
AND (a.tanggal between '2020-04-01' and '2020-04-30')
GROUP BY `a`.`id`
ORDER BY `b`.`nama` ASC, `a`.`tanggal` ASC, `a`.`no_referensi` ASC
ERROR - 2020-04-01 10:58:34 --> Severity: Notice --> Undefined variable: kondisi /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_report.php 28
ERROR - 2020-04-01 10:58:38 --> Severity: Notice --> Undefined variable: kondisi /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_report.php 28
ERROR - 2020-04-01 10:58:56 --> Severity: Notice --> Undefined index: deskripsi /data/www/html/erpsmg/finance_gmedia/application/views/finance_ap_report/report.php 47
ERROR - 2020-04-01 11:00:43 --> Severity: Notice --> Undefined index: deskripsi /data/www/html/erpsmg/finance_gmedia/application/views/finance_ap_report/report.php 49
ERROR - 2020-04-01 11:01:22 --> Severity: Notice --> Undefined index: deskripsi /data/www/html/erpsmg/finance_gmedia/application/views/finance_ap_report/report.php 50
ERROR - 2020-04-01 11:05:51 --> Query error: Unknown column 'a.branch' in 'where clause' - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.*, DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya, c.no_referensi, if(c.supplier = 0, 'Lain2', b.nama) as nama_service, sum(a.jumlah) as jumlah
FROM `gmd_finance_ap_billing` `a`
LEFT JOIN `gmd_finance_ap_invoice` `c` ON `a`.`id_invoice` = `c`.`id`
LEFT JOIN `gmd_finance_supplier` `b` ON `c`.`supplier` = `b`.`id`
WHERE (a.tanggal between '2020-04-01' and '2020-04-30')
AND `a`.`branch` = '8'
GROUP BY `a`.`id`
ORDER BY `a`.`tanggal` ASC
ERROR - 2020-04-01 04:07:10 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-01 04:07:11 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-01 11:07:11 --> Query error: Table 'erp_financev2.gmd_inance_ap_billing' doesn't exist - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.*, DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya, c.no_referensi, if(c.supplier = 0, 'Lain2', b.nama) as nama_service, sum(a.jumlah) as jumlah
FROM `gmd_inance_ap_billing` `a`
LEFT JOIN `gmd_finance_ap_invoice` `c` ON `a`.`id_invoice` = `c`.`id`
LEFT JOIN `gmd_finance_supplier` `b` ON `c`.`supplier` = `b`.`id`
WHERE (a.tanggal between '2020-04-01' and '2020-04-30')
AND `a`.`branch` = '8'
GROUP BY `a`.`id`
ORDER BY `a`.`tanggal` ASC
ERROR - 2020-04-01 04:15:49 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-04-01 04:15:49 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-04-01 04:15:49 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-04-01 04:15:49 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-04-01 04:15:49 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-04-01 04:36:13 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-01 12:08:16 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT a.*, date_format(a.tanggal, '%d-%m-%Y') as date_invoicenya, date_format(a.date_due, '%d-%m-%Y') as date_duenya, if(a.supplier = 0, 'Lain2', b.nama) as nama_supplier, COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-01'), 0) AS bayar, DATEDIFF('2020-04-01', a.date_due) as aging
FROM `gmd_finance_ap_invoice` AS `a`
LEFT JOIN `gmd_finance_supplier` `b` ON `a`.`supplier` = `b`.`id`
WHERE `a`.`branch` = '8'
AND (a.date_paid = '' OR a.date_paid IS NULL)
GROUP BY `a`.`id`
ORDER BY `b`.`nama` ASC, `a`.`tanggal` ASC, `a`.`no_referensi` ASC
ERROR - 2020-04-01 05:13:25 --> 404 Page Not Found: Finance_ap_report_od/get_supplier
ERROR - 2020-04-01 05:18:29 --> 404 Page Not Found: Finance_ap_report_od/get_supplier
ERROR - 2020-04-01 12:19:25 --> Severity: Notice --> Undefined property: finance_ap_report_od::$finance_ap_report /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_ap_report_od.php 62
ERROR - 2020-04-01 12:19:25 --> Severity: error --> Exception: Call to a member function get_supp() on null /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_ap_report_od.php 62
ERROR - 2020-04-01 12:19:43 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT a.*, date_format(a.tanggal, '%d-%m-%Y') as date_invoicenya, date_format(a.date_due, '%d-%m-%Y') as date_duenya, if(a.supplier = 0, 'Lain2', b.nama) as nama_supplier, COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-01'), 0) AS bayar, DATEDIFF('2020-04-01', a.date_due) as aging
FROM `gmd_finance_ap_invoice` AS `a`
LEFT JOIN `gmd_finance_supplier` `b` ON `a`.`supplier` = `b`.`id`
WHERE `a`.`branch` = '8'
AND `a`.`supplier` = '77'
AND (a.date_paid = '' OR a.date_paid IS NULL)
GROUP BY `a`.`id`
ORDER BY `b`.`nama` ASC, `a`.`tanggal` ASC, `a`.`no_referensi` ASC
ERROR - 2020-04-01 12:46:52 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-01 12:46:52 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-01 12:46:54 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-30'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-04-30'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-04-30')
ERROR - 2020-04-01 06:32:30 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-04-01 06:32:30 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-04-01 06:32:30 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-04-01 06:32:30 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-04-01 06:32:30 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-04-01 14:40:39 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-01 14:40:39 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-01 14:40:45 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-30'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-04-30'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-04-30')
