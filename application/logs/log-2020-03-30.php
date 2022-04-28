<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-03-30 07:59:52 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-30 07:59:52 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-30 07:59:54 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-03-31'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-03-31'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-03-31')
ERROR - 2020-03-30 09:54:04 --> Query error: Unknown column 'a.branch' in 'where clause' - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.*, DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya, c.no_referensi, if(c.supplier = 0, 'Lain2', b.nama) as nama_service
FROM `gmd_finance_ap_billing` `a`
LEFT JOIN `gmd_finance_ap_invoice` `c` ON `a`.`id_invoice` = `c`.`id`
LEFT JOIN `gmd_finance_supplier` `b` ON `c`.`supplier` = `b`.`id`
WHERE   (
`c`.`no_referensi` LIKE '%%' ESCAPE '!'
OR  `b`.`nama` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2020-02-01' and '2020-03-31')
AND `a`.`branch` = '8'
GROUP BY `a`.`id`
ORDER BY `a`.`tanggal` DESC
 LIMIT 100
ERROR - 2020-03-30 09:54:19 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-30 09:54:19 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-30 09:54:23 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-03-31'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-03-31'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-03-31')
ERROR - 2020-03-30 10:18:14 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-30 10:18:14 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-30 10:18:17 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-03-31'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-03-31'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-03-31')
ERROR - 2020-03-30 10:35:29 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-30 10:35:29 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-30 10:35:29 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-03-31'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-03-31'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-03-31')
ERROR - 2020-03-30 11:16:12 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-30 11:16:12 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-30 11:16:14 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-03-31'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-03-31'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-03-31')
ERROR - 2020-03-30 05:53:13 --> 404 Page Not Found: Finance_ap_report/get_supplier
ERROR - 2020-03-30 05:53:16 --> 404 Page Not Found: Finance_ap_report/get_supplier
ERROR - 2020-03-30 12:53:40 --> Query error: Unknown column 'a.branch' in 'where clause' - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.*, DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya, c.no_referensi, if(c.supplier = 0, 'Lain2', b.nama) as nama_service
FROM `gmd_finance_ap_billing` `a`
LEFT JOIN `gmd_finance_ap_invoice` `c` ON `a`.`id_invoice` = `c`.`id`
LEFT JOIN `gmd_finance_supplier` `b` ON `c`.`supplier` = `b`.`id`
WHERE   (
`c`.`no_referensi` LIKE '%%' ESCAPE '!'
OR  `b`.`nama` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2020-02-01' and '2020-03-31')
AND `a`.`branch` = '8'
GROUP BY `a`.`id`
ORDER BY `a`.`tanggal` DESC
 LIMIT 100
ERROR - 2020-03-30 12:53:55 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT a.*, date_format(a.tanggal, '%d-%m-%Y') as date_invoicenya, date_format(a.date_due, '%d-%m-%Y') as date_duenya, if(a.supplier = 0, 'Lain2', b.nama) as nama_supplier, COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-03-30'), 0) AS bayar, DATEDIFF('2020-03-30', a.date_due) as aging
FROM `gmd_finance_ap_invoice` AS `a`
LEFT JOIN `gmd_finance_supplier` `b` ON `a`.`supplier` = `b`.`id`
WHERE `a`.`branch` = '8'
AND `a`.`supplier` = '0'
AND (a.date_paid = '' OR a.date_paid IS NULL)
GROUP BY `a`.`id`
ORDER BY `b`.`nama` ASC, `a`.`tanggal` ASC, `a`.`no_referensi` ASC
ERROR - 2020-03-30 14:03:40 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-30 14:03:40 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-30 14:03:42 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-03-31'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-03-31'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-03-31')
ERROR - 2020-03-30 14:34:10 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-30 14:34:10 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-30 14:34:14 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-03-31'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-03-31'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-03-31')
ERROR - 2020-03-30 14:51:38 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-30 14:51:38 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-30 14:51:40 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-03-31'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-03-31'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-03-31')
ERROR - 2020-03-30 08:19:52 --> 404 Page Not Found: Finance_ap_report/get_supplier
ERROR - 2020-03-30 08:22:08 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-03-30 08:22:08 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-03-30 08:22:08 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-03-30 08:22:08 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-03-30 08:22:08 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-03-30 09:13:10 --> 404 Page Not Found: Finance_ap_report/get_supplier
