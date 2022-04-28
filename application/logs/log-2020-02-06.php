<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-02-06 00:44:24 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-06 00:44:24 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-06 00:44:53 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2020-02-06 00:45:48 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2020-02-06 00:46:17 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2020-02-06 00:46:37 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2020-02-06 00:47:03 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2020-02-06 00:47:36 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2020-02-06 00:47:42 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2020-02-06 00:47:56 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2020-02-06 00:48:00 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2020-02-06 01:05:42 --> Query error: Table 'erp_financev2.gmd_inance_coa' doesn't exist - Invalid query: SELECT coalesce(b.saldo, 0.00) as saldo
FROM `gmd_inance_coa` `a`
LEFT JOIN `gmd_finance_coa_saldo` `b` ON `a`.`id` = `b`.`id_biaya` AND `b`.`branch` = '8'
WHERE `a`.`id` = '111200'
AND `b`.`card_id` = '1'
AND `b`.`tanggal` >= '2000-01-01'
AND `b`.`tanggal` < '2020-01-04'
GROUP BY `a`.`id`
ERROR - 2020-02-06 01:05:47 --> Query error: Table 'erp_financev2.gmd_inance_coa' doesn't exist - Invalid query: SELECT coalesce(b.saldo, 0.00) as saldo
FROM `gmd_inance_coa` `a`
LEFT JOIN `gmd_finance_coa_saldo` `b` ON `a`.`id` = `b`.`id_biaya` AND `b`.`branch` = '8'
WHERE `a`.`id` = '111200'
AND `b`.`card_id` = '1'
AND `b`.`tanggal` >= '2000-01-01'
AND `b`.`tanggal` < '2020-01-04'
GROUP BY `a`.`id`
ERROR - 2020-02-06 01:06:40 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_daily' doesn't exist - Invalid query: SELECT SUM(a.debet) as saldo_debet, SUM(a.kredit) as saldo_kredit
FROM `gmd_inance_coa_general_ledger_daily` `a`
WHERE `a`.`id_biaya` = '111200'
AND `a`.`card_id` = '1'
AND `a`.`tanggal` >= '2000-01-01'
AND `a`.`tanggal` < '2020-01-04'
AND `a`.`branch` = '8'
ERROR - 2020-02-06 08:16:36 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-06 08:16:36 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-06 08:28:39 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-06 08:28:39 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-06 09:04:48 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2020-02-06 09:24:52 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-06 09:24:52 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-06 09:29:38 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2020-02-06 09:43:30 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-06 09:43:30 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-06 09:51:25 --> Severity: error --> Exception: Too few arguments to function Model_global::update_jurnal_bulanan(), 4 passed in /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php on line 165 and exactly 5 expected /data/www/html/erpsmg/finance_gmedia/application/models/Model_global.php 156
ERROR - 2020-02-06 09:52:12 --> Severity: error --> Exception: Too few arguments to function Model_global::update_jurnal_bulanan(), 4 passed in /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php on line 226 and exactly 5 expected /data/www/html/erpsmg/finance_gmedia/application/models/Model_global.php 156
ERROR - 2020-02-06 10:56:02 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-06 10:56:02 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-06 04:00:22 --> 404 Page Not Found: Assets/invoice
ERROR - 2020-02-06 11:00:22 --> Query error: Unknown column 'f.id_arpost' in 'on clause' - Invalid query: SELECT `d`.`nama` AS `site`, `b`.`id_cust`, `b`.`cashback`, `e`.`id` AS `id_trx`, `a`.*, CASE WHEN e.status=1 THEN 'Belum' WHEN e.status=2 THEN 'Lunas' END AS status_bayar, `e`.`tanggal` AS `tanggal`
FROM `cashback_usage` `a`
INNER JOIN `cashback` `b` ON `a`.`id_cashback`=`b`.`id`
INNER JOIN `order_header` `c` ON `c`.`id`=`a`.`id_order`
INNER JOIN `ms_site` `d` ON `d`.`id`=`c`.`id_site`
INNER JOIN `cashback_transaksi` `e` ON `e`.`id_cashback_usage`=`a`.`id`
INNER JOIN `erp_finance`.`gmd_finance_invoice_customer_detail` `f` ON `f`.`id_arpost`=`e`.`id_arpost`
INNER JOIN `erp_finance`.`gmd_finance_invoice_customer` `g` ON `f`.`no_invoice`=`g`.`id`
WHERE   (
`d`.`nama` LIKE '%%' ESCAPE '!'
AND  `a`.`pic` LIKE '%%' ESCAPE '!'
 )
AND `a`.`status` != "9" AND `b`.`status` = "2" AND `g`.`lunas` = "1"
AND `e`.`status` = '1'
AND (e.tanggal between '2020-02-01' and '2020-02-29')
ORDER BY `d`.`nama` ASC
 LIMIT 100
ERROR - 2020-02-06 04:00:28 --> 404 Page Not Found: Assets/invoice
ERROR - 2020-02-06 11:00:28 --> Query error: Unknown column 'f.id_arpost' in 'on clause' - Invalid query: SELECT `d`.`nama` AS `site`, `b`.`id_cust`, `b`.`cashback`, `e`.`id` AS `id_trx`, `a`.*, CASE WHEN e.status=1 THEN 'Belum' WHEN e.status=2 THEN 'Lunas' END AS status_bayar, `e`.`tanggal` AS `tanggal`
FROM `cashback_usage` `a`
INNER JOIN `cashback` `b` ON `a`.`id_cashback`=`b`.`id`
INNER JOIN `order_header` `c` ON `c`.`id`=`a`.`id_order`
INNER JOIN `ms_site` `d` ON `d`.`id`=`c`.`id_site`
INNER JOIN `cashback_transaksi` `e` ON `e`.`id_cashback_usage`=`a`.`id`
INNER JOIN `erp_finance`.`gmd_finance_invoice_customer_detail` `f` ON `f`.`id_arpost`=`e`.`id_arpost`
INNER JOIN `erp_finance`.`gmd_finance_invoice_customer` `g` ON `f`.`no_invoice`=`g`.`id`
WHERE   (
`d`.`nama` LIKE '%%' ESCAPE '!'
AND  `a`.`pic` LIKE '%%' ESCAPE '!'
 )
AND `a`.`status` != "9" AND `b`.`status` = "2" AND `g`.`lunas` = "1"
AND `e`.`status` = '1'
AND (e.tanggal between '2020-02-01' and '2020-02-29')
ORDER BY `d`.`nama` ASC
 LIMIT 100
ERROR - 2020-02-06 11:01:01 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-06 11:01:01 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-06 04:01:27 --> 404 Page Not Found: Assets/invoice
ERROR - 2020-02-06 11:01:27 --> Query error: Unknown column 'f.id_arpost' in 'on clause' - Invalid query: SELECT `d`.`nama` AS `site`, `b`.`id_cust`, `b`.`cashback`, `e`.`id` AS `id_trx`, `a`.*, CASE WHEN e.status=1 THEN 'Belum' WHEN e.status=2 THEN 'Lunas' END AS status_bayar, `e`.`tanggal` AS `tanggal`
FROM `cashback_usage` `a`
INNER JOIN `cashback` `b` ON `a`.`id_cashback`=`b`.`id`
INNER JOIN `order_header` `c` ON `c`.`id`=`a`.`id_order`
INNER JOIN `ms_site` `d` ON `d`.`id`=`c`.`id_site`
INNER JOIN `cashback_transaksi` `e` ON `e`.`id_cashback_usage`=`a`.`id`
INNER JOIN `erp_finance`.`gmd_finance_invoice_customer_detail` `f` ON `f`.`id_arpost`=`e`.`id_arpost`
INNER JOIN `erp_finance`.`gmd_finance_invoice_customer` `g` ON `f`.`no_invoice`=`g`.`id`
WHERE   (
`d`.`nama` LIKE '%%' ESCAPE '!'
AND  `a`.`pic` LIKE '%%' ESCAPE '!'
 )
AND `a`.`status` != "9" AND `b`.`status` = "2" AND `g`.`lunas` = "1"
AND `e`.`status` = '1'
AND (e.tanggal between '2020-02-01' and '2020-02-29')
ORDER BY `d`.`nama` ASC
 LIMIT 100
ERROR - 2020-02-06 04:01:34 --> 404 Page Not Found: Assets/invoice
ERROR - 2020-02-06 11:01:34 --> Query error: Unknown column 'f.id_arpost' in 'on clause' - Invalid query: SELECT `d`.`nama` AS `site`, `b`.`id_cust`, `b`.`cashback`, `e`.`id` AS `id_trx`, `a`.*, CASE WHEN e.status=1 THEN 'Belum' WHEN e.status=2 THEN 'Lunas' END AS status_bayar, `e`.`tanggal` AS `tanggal`
FROM `cashback_usage` `a`
INNER JOIN `cashback` `b` ON `a`.`id_cashback`=`b`.`id`
INNER JOIN `order_header` `c` ON `c`.`id`=`a`.`id_order`
INNER JOIN `ms_site` `d` ON `d`.`id`=`c`.`id_site`
INNER JOIN `cashback_transaksi` `e` ON `e`.`id_cashback_usage`=`a`.`id`
INNER JOIN `erp_finance`.`gmd_finance_invoice_customer_detail` `f` ON `f`.`id_arpost`=`e`.`id_arpost`
INNER JOIN `erp_finance`.`gmd_finance_invoice_customer` `g` ON `f`.`no_invoice`=`g`.`id`
WHERE   (
`d`.`nama` LIKE '%%' ESCAPE '!'
AND  `a`.`pic` LIKE '%%' ESCAPE '!'
 )
AND `a`.`status` != "9" AND `b`.`status` = "2" AND `g`.`lunas` = "1"
AND `e`.`status` = '1'
AND (e.tanggal between '2020-02-01' and '2020-02-29')
ORDER BY `d`.`nama` ASC
 LIMIT 100
ERROR - 2020-02-06 04:03:18 --> 404 Page Not Found: Assets/invoice
ERROR - 2020-02-06 04:03:18 --> 404 Page Not Found: Assets/invoice
ERROR - 2020-02-06 04:03:31 --> 404 Page Not Found: Assets/invoice
ERROR - 2020-02-06 04:03:31 --> 404 Page Not Found: Assets/invoice
ERROR - 2020-02-06 04:03:35 --> 404 Page Not Found: Assets/invoice
ERROR - 2020-02-06 04:03:35 --> 404 Page Not Found: Assets/invoice
ERROR - 2020-02-06 04:03:50 --> 404 Page Not Found: Assets/invoice
ERROR - 2020-02-06 04:03:50 --> 404 Page Not Found: Assets/invoice
ERROR - 2020-02-06 04:04:03 --> 404 Page Not Found: Assets/invoice
ERROR - 2020-02-06 04:04:03 --> 404 Page Not Found: Assets/invoice
ERROR - 2020-02-06 04:04:40 --> 404 Page Not Found: Assets/invoice
ERROR - 2020-02-06 04:04:40 --> 404 Page Not Found: Assets/invoice
ERROR - 2020-02-06 11:21:58 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-06 11:21:58 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-06 11:46:53 --> Query error: Data too long for column 'emailwakil' at row 1 - Invalid query: UPDATE `ms_site` SET `emailwakil` = 'bowie.syb1976@gmail.com, bowie_ga@idn-ltd.com, charles@idn-lts.com, cjliu@idn-ltd.com, yesayapitra@gmail.com'
WHERE `id` = '4702'
ERROR - 2020-02-06 11:48:22 --> Query error: Data too long for column 'emailwakil' at row 1 - Invalid query: UPDATE `ms_site` SET `emailwakil` = 'bowie.syb1976@gmail.com, bowie_ga@idn-ltd.com, charles@idn-lts.com, cjliu@idn-ltd.com, yesayapitra@gmail.com'
WHERE `id` = '4702'
ERROR - 2020-02-06 11:48:51 --> Query error: Data too long for column 'emailwakil' at row 1 - Invalid query: UPDATE `ms_site` SET `emailwakil` = 'bowie.syb1976@gmail.com, bowie_ga@idn-ltd.com, charles@idn-lts.com, cjliu@idn-ltd.com, yesayapitra@gmail.com'
WHERE `id` = '4702'
ERROR - 2020-02-06 11:49:28 --> Query error: Data too long for column 'emailwakil' at row 1 - Invalid query: UPDATE `ms_site` SET `emailwakil` = 'bowie.syb1976@gmail.com, bowie_ga@idn-ltd.com, charles@idn-lts.com, cjliu@idn-ltd.com, yesayapitra@gmail.com'
WHERE `id` = '4702'
ERROR - 2020-02-06 13:40:57 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-06 13:40:57 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-06 06:41:56 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-06 06:41:56 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-06 06:41:56 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-06 06:41:56 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-06 06:41:56 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-06 13:48:57 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-06 13:48:57 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-06 07:00:10 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-06 07:00:10 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-06 07:00:10 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-06 07:00:10 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-06 07:00:10 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-06 14:15:04 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-06 14:15:04 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-06 07:17:06 --> 404 Page Not Found: Assets/js
ERROR - 2020-02-06 14:17:08 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_daily' doesn't exist - Invalid query: SELECT SUM(a.debet) as saldo_debet, SUM(a.kredit) as saldo_kredit
FROM `gmd_inance_coa_general_ledger_daily` `a`
WHERE `a`.`id_biaya` = '111200'
AND `a`.`card_id` = '1'
AND `a`.`tanggal` >= '2000-01-01'
AND `a`.`tanggal` < '2020-02-06'
AND `a`.`branch` = '8'
ERROR - 2020-02-06 15:37:05 --> Severity: error --> Exception: Too few arguments to function finance_transaksi_kas_kecil::update_jurnal_harian(), 0 passed in /data/www/html/erpsmg/finance_gmedia/system/core/CodeIgniter.php on line 532 and exactly 1 expected /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_transaksi_kas_kecil.php 107
ERROR - 2020-02-06 15:37:59 --> Severity: error --> Exception: Too few arguments to function finance_transaksi_kas_kecil::update_jurnal_harian(), 0 passed in /data/www/html/erpsmg/finance_gmedia/system/core/CodeIgniter.php on line 532 and exactly 1 expected /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_transaksi_kas_kecil.php 107
ERROR - 2020-02-06 08:41:03 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-06 08:41:03 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-06 08:41:03 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-06 08:41:03 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-06 08:41:03 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-06 09:01:18 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-06 09:01:18 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-06 09:01:18 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-06 09:01:18 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-06 09:01:18 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-06 09:27:20 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-06 09:27:20 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-06 09:27:20 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-06 09:27:20 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-06 09:27:20 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-06 09:30:09 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-06 09:30:09 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-06 09:30:09 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-06 09:30:09 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-06 09:30:09 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-06 22:57:06 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-06 22:57:06 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-06 16:19:08 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-06 16:19:08 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-06 16:19:08 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-06 16:19:08 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-06 16:19:08 --> 404 Page Not Found: Select_data_income_expenses/2020
