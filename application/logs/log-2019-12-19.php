<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-12-19 09:05:49 --> Query error: Unknown column 'deskripsi' in 'field list' - Invalid query: SELECT 
		  SQL_CALC_FOUND_ROWS *, date_format(tanggal, '%d-%m-%Y') as tanggalnya 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '9'
			AND branch = '8'
			AND (
			  tanggal BETWEEN '2019-12-01' AND '2019-12-31'
			)
		) AS kasnya 
		ORDER BY tanggal ASC, saldo_m DESC, saldo_k ASC 
ERROR - 2019-12-19 02:06:40 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-19 02:10:34 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-19 02:10:34 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-19 02:10:34 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-19 02:10:34 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-19 02:10:34 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-19 09:12:32 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_detail' doesn't exist - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.no_trans, DATE_FORMAT(a.tanggal, '%d/%m/%Y') AS tanggalnya, b.jurnal_group, b.deskripsi, b.`no_referensi` AS ref, a.ket AS memo, SUM(a.debet) AS debet, SUM(a.kredit) AS kredit
FROM `gmd_inance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
`a`.`no_trans` LIKE '%%' ESCAPE '!'
OR  `b`.`jurnal_group` LIKE '%%' ESCAPE '!'
OR  `b`.`deskripsi` LIKE '%%' ESCAPE '!'
OR  `a`.`id_biaya` LIKE '%%' ESCAPE '!'
OR  `c`.`nama` LIKE '%%' ESCAPE '!'
OR  `a`.`ket` LIKE '%%' ESCAPE '!'
OR  `b`.`no_referensi` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2019-12-01' and '2019-12-31')
GROUP BY `a`.`no_trans`
ORDER BY `a`.`no_trans` DESC
ERROR - 2019-12-19 09:15:58 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_detail' doesn't exist - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.no_trans, DATE_FORMAT(a.tanggal, '%d/%m/%Y') AS tanggalnya, b.jurnal_group, b.deskripsi, b.`no_referensi` AS ref, a.ket AS memo, SUM(a.debet) AS debet, SUM(a.kredit) AS kredit
FROM `gmd_inance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
`a`.`no_trans` LIKE '%%' ESCAPE '!'
OR  `b`.`jurnal_group` LIKE '%%' ESCAPE '!'
OR  `b`.`deskripsi` LIKE '%%' ESCAPE '!'
OR  `a`.`id_biaya` LIKE '%%' ESCAPE '!'
OR  `c`.`nama` LIKE '%%' ESCAPE '!'
OR  `a`.`ket` LIKE '%%' ESCAPE '!'
OR  `b`.`no_referensi` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2019-12-01' and '2019-12-31')
GROUP BY `a`.`no_trans`
ORDER BY `a`.`no_trans` DESC
ERROR - 2019-12-19 02:17:20 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-19 02:22:49 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-12-19 02:22:49 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-19 02:22:49 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-19 02:22:49 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-19 02:22:49 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-19 09:22:57 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_detail' doesn't exist - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.no_trans, DATE_FORMAT(a.tanggal, '%d/%m/%Y') AS tanggalnya, b.jurnal_group, b.deskripsi, b.`no_referensi` AS ref, a.ket AS memo, SUM(a.debet) AS debet, SUM(a.kredit) AS kredit
FROM `gmd_inance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
`a`.`no_trans` LIKE '%%' ESCAPE '!'
OR  `b`.`jurnal_group` LIKE '%%' ESCAPE '!'
OR  `b`.`deskripsi` LIKE '%%' ESCAPE '!'
OR  `a`.`id_biaya` LIKE '%%' ESCAPE '!'
OR  `c`.`nama` LIKE '%%' ESCAPE '!'
OR  `a`.`ket` LIKE '%%' ESCAPE '!'
OR  `b`.`no_referensi` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2019-12-01' and '2019-12-31')
GROUP BY `a`.`no_trans`
ORDER BY `a`.`no_trans` DESC
ERROR - 2019-12-19 02:26:47 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-19 02:26:47 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-19 02:26:47 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-12-19 02:26:47 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-19 02:26:47 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-19 09:27:54 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2019-12-19 02:37:22 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-19 02:37:22 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-19 02:37:22 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-12-19 02:37:22 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-19 02:37:22 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-19 02:38:12 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-12-19 02:38:12 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-19 02:38:12 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-19 02:38:12 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-19 02:38:12 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-19 09:59:47 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_detail' doesn't exist - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.no_trans, DATE_FORMAT(a.tanggal, '%d/%m/%Y') AS tanggalnya, b.jurnal_group, b.deskripsi, b.`no_referensi` AS ref, a.ket AS memo, SUM(a.debet) AS debet, SUM(a.kredit) AS kredit
FROM `gmd_inance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
`a`.`no_trans` LIKE '%%' ESCAPE '!'
OR  `b`.`jurnal_group` LIKE '%%' ESCAPE '!'
OR  `b`.`deskripsi` LIKE '%%' ESCAPE '!'
OR  `a`.`id_biaya` LIKE '%%' ESCAPE '!'
OR  `c`.`nama` LIKE '%%' ESCAPE '!'
OR  `a`.`ket` LIKE '%%' ESCAPE '!'
OR  `b`.`no_referensi` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2019-12-01' and '2019-12-31')
GROUP BY `a`.`no_trans`
ORDER BY `a`.`no_trans` DESC
ERROR - 2019-12-19 10:00:06 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_detail' doesn't exist - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.no_trans, DATE_FORMAT(a.tanggal, '%d/%m/%Y') AS tanggalnya, b.jurnal_group, b.deskripsi, b.`no_referensi` AS ref, a.ket AS memo, SUM(a.debet) AS debet, SUM(a.kredit) AS kredit
FROM `gmd_inance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
`a`.`no_trans` LIKE '%%' ESCAPE '!'
OR  `b`.`jurnal_group` LIKE '%%' ESCAPE '!'
OR  `b`.`deskripsi` LIKE '%%' ESCAPE '!'
OR  `a`.`id_biaya` LIKE '%%' ESCAPE '!'
OR  `c`.`nama` LIKE '%%' ESCAPE '!'
OR  `a`.`ket` LIKE '%%' ESCAPE '!'
OR  `b`.`no_referensi` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2019-12-01' and '2019-12-31')
GROUP BY `a`.`no_trans`
ORDER BY `a`.`no_trans` DESC
ERROR - 2019-12-19 10:08:32 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_detail' doesn't exist - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.no_trans, DATE_FORMAT(a.tanggal, '%d/%m/%Y') AS tanggalnya, b.jurnal_group, b.deskripsi, b.`no_referensi` AS ref, a.ket AS memo, SUM(a.debet) AS debet, SUM(a.kredit) AS kredit
FROM `gmd_inance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
`a`.`no_trans` LIKE '%%' ESCAPE '!'
OR  `b`.`jurnal_group` LIKE '%%' ESCAPE '!'
OR  `b`.`deskripsi` LIKE '%%' ESCAPE '!'
OR  `a`.`id_biaya` LIKE '%%' ESCAPE '!'
OR  `c`.`nama` LIKE '%%' ESCAPE '!'
OR  `a`.`ket` LIKE '%%' ESCAPE '!'
OR  `b`.`no_referensi` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2019-12-01' and '2019-12-31')
GROUP BY `a`.`no_trans`
ORDER BY `a`.`no_trans` DESC
ERROR - 2019-12-19 10:30:27 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_detail' doesn't exist - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.no_trans, DATE_FORMAT(a.tanggal, '%d/%m/%Y') AS tanggalnya, b.jurnal_group, b.deskripsi, b.`no_referensi` AS ref, a.ket AS memo, SUM(a.debet) AS debet, SUM(a.kredit) AS kredit
FROM `gmd_inance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
`a`.`no_trans` LIKE '%%' ESCAPE '!'
OR  `b`.`jurnal_group` LIKE '%%' ESCAPE '!'
OR  `b`.`deskripsi` LIKE '%%' ESCAPE '!'
OR  `a`.`id_biaya` LIKE '%%' ESCAPE '!'
OR  `c`.`nama` LIKE '%%' ESCAPE '!'
OR  `a`.`ket` LIKE '%%' ESCAPE '!'
OR  `b`.`no_referensi` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2019-12-01' and '2019-12-31')
GROUP BY `a`.`no_trans`
ORDER BY `a`.`no_trans` DESC
ERROR - 2019-12-19 11:39:49 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_detail' doesn't exist - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.no_trans, DATE_FORMAT(a.tanggal, '%d/%m/%Y') AS tanggalnya, b.jurnal_group, b.deskripsi, b.`no_referensi` AS ref, a.ket AS memo, SUM(a.debet) AS debet, SUM(a.kredit) AS kredit
FROM `gmd_inance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
`a`.`no_trans` LIKE '%%' ESCAPE '!'
OR  `b`.`jurnal_group` LIKE '%%' ESCAPE '!'
OR  `b`.`deskripsi` LIKE '%%' ESCAPE '!'
OR  `a`.`id_biaya` LIKE '%%' ESCAPE '!'
OR  `c`.`nama` LIKE '%%' ESCAPE '!'
OR  `a`.`ket` LIKE '%%' ESCAPE '!'
OR  `b`.`no_referensi` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2019-12-01' and '2019-12-31')
GROUP BY `a`.`no_trans`
ORDER BY `a`.`no_trans` DESC
ERROR - 2019-12-19 11:40:00 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_detail' doesn't exist - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.no_trans, DATE_FORMAT(a.tanggal, '%d/%m/%Y') AS tanggalnya, b.jurnal_group, b.deskripsi, b.`no_referensi` AS ref, a.ket AS memo, SUM(a.debet) AS debet, SUM(a.kredit) AS kredit
FROM `gmd_inance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
`a`.`no_trans` LIKE '%%' ESCAPE '!'
OR  `b`.`jurnal_group` LIKE '%%' ESCAPE '!'
OR  `b`.`deskripsi` LIKE '%%' ESCAPE '!'
OR  `a`.`id_biaya` LIKE '%%' ESCAPE '!'
OR  `c`.`nama` LIKE '%%' ESCAPE '!'
OR  `a`.`ket` LIKE '%%' ESCAPE '!'
OR  `b`.`no_referensi` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2019-12-01' and '2019-12-31')
GROUP BY `a`.`no_trans`
ORDER BY `a`.`no_trans` DESC
ERROR - 2019-12-19 11:41:22 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_detail' doesn't exist - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.no_trans, DATE_FORMAT(a.tanggal, '%d/%m/%Y') AS tanggalnya, b.jurnal_group, b.deskripsi, b.`no_referensi` AS ref, a.ket AS memo, SUM(a.debet) AS debet, SUM(a.kredit) AS kredit
FROM `gmd_inance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
`a`.`no_trans` LIKE '%%' ESCAPE '!'
OR  `b`.`jurnal_group` LIKE '%%' ESCAPE '!'
OR  `b`.`deskripsi` LIKE '%%' ESCAPE '!'
OR  `a`.`id_biaya` LIKE '%%' ESCAPE '!'
OR  `c`.`nama` LIKE '%%' ESCAPE '!'
OR  `a`.`ket` LIKE '%%' ESCAPE '!'
OR  `b`.`no_referensi` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2019-12-01' and '2019-12-31')
GROUP BY `a`.`no_trans`
ORDER BY `a`.`no_trans` DESC
ERROR - 2019-12-19 04:53:09 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-19 04:53:09 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-12-19 04:53:09 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-19 04:53:09 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-19 04:53:09 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-19 11:53:28 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_detail' doesn't exist - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.no_trans, DATE_FORMAT(a.tanggal, '%d/%m/%Y') AS tanggalnya, b.jurnal_group, b.deskripsi, b.`no_referensi` AS ref, a.ket AS memo, SUM(a.debet) AS debet, SUM(a.kredit) AS kredit
FROM `gmd_inance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
`a`.`no_trans` LIKE '%%' ESCAPE '!'
OR  `b`.`jurnal_group` LIKE '%%' ESCAPE '!'
OR  `b`.`deskripsi` LIKE '%%' ESCAPE '!'
OR  `a`.`id_biaya` LIKE '%%' ESCAPE '!'
OR  `c`.`nama` LIKE '%%' ESCAPE '!'
OR  `a`.`ket` LIKE '%%' ESCAPE '!'
OR  `b`.`no_referensi` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2019-12-01' and '2019-12-31')
GROUP BY `a`.`no_trans`
ORDER BY `a`.`no_trans` DESC
ERROR - 2019-12-19 06:31:50 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-19 06:31:50 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-19 06:31:50 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-12-19 06:31:50 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-19 06:31:50 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-19 13:39:43 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_detail' doesn't exist - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.no_trans, DATE_FORMAT(a.tanggal, '%d/%m/%Y') AS tanggalnya, b.jurnal_group, b.deskripsi, b.`no_referensi` AS ref, a.ket AS memo, SUM(a.debet) AS debet, SUM(a.kredit) AS kredit
FROM `gmd_inance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
`a`.`no_trans` LIKE '%%' ESCAPE '!'
OR  `b`.`jurnal_group` LIKE '%%' ESCAPE '!'
OR  `b`.`deskripsi` LIKE '%%' ESCAPE '!'
OR  `a`.`id_biaya` LIKE '%%' ESCAPE '!'
OR  `c`.`nama` LIKE '%%' ESCAPE '!'
OR  `a`.`ket` LIKE '%%' ESCAPE '!'
OR  `b`.`no_referensi` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2019-12-01' and '2019-12-31')
GROUP BY `a`.`no_trans`
ORDER BY `a`.`no_trans` DESC
ERROR - 2019-12-19 13:47:12 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_detail' doesn't exist - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.no_trans, DATE_FORMAT(a.tanggal, '%d/%m/%Y') AS tanggalnya, b.jurnal_group, b.deskripsi, b.`no_referensi` AS ref, a.ket AS memo, SUM(a.debet) AS debet, SUM(a.kredit) AS kredit
FROM `gmd_inance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
`a`.`no_trans` LIKE '%%' ESCAPE '!'
OR  `b`.`jurnal_group` LIKE '%%' ESCAPE '!'
OR  `b`.`deskripsi` LIKE '%%' ESCAPE '!'
OR  `a`.`id_biaya` LIKE '%%' ESCAPE '!'
OR  `c`.`nama` LIKE '%%' ESCAPE '!'
OR  `a`.`ket` LIKE '%%' ESCAPE '!'
OR  `b`.`no_referensi` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2019-12-01' and '2019-12-31')
GROUP BY `a`.`no_trans`
ORDER BY `a`.`no_trans` DESC
ERROR - 2019-12-19 07:23:33 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-12-19 07:23:33 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-19 07:23:33 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-19 07:23:33 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-19 07:23:33 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-19 14:23:40 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_detail' doesn't exist - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.no_trans, DATE_FORMAT(a.tanggal, '%d/%m/%Y') AS tanggalnya, b.jurnal_group, b.deskripsi, b.`no_referensi` AS ref, a.ket AS memo, SUM(a.debet) AS debet, SUM(a.kredit) AS kredit
FROM `gmd_inance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
`a`.`no_trans` LIKE '%%' ESCAPE '!'
OR  `b`.`jurnal_group` LIKE '%%' ESCAPE '!'
OR  `b`.`deskripsi` LIKE '%%' ESCAPE '!'
OR  `a`.`id_biaya` LIKE '%%' ESCAPE '!'
OR  `c`.`nama` LIKE '%%' ESCAPE '!'
OR  `a`.`ket` LIKE '%%' ESCAPE '!'
OR  `b`.`no_referensi` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2019-12-01' and '2019-12-31')
GROUP BY `a`.`no_trans`
ORDER BY `a`.`no_trans` DESC
ERROR - 2019-12-19 14:25:13 --> Query error: Table 'erp_financev2.gmd_fnance_coa_general_ledger_detail' doesn't exist - Invalid query: SELECT DATE_FORMAT(b.tanggal, '%d-%m-%Y') AS tanggalnya, a.no_trans, a.id_biaya, b.jurnal_group, a.ket, b.deskripsi, IF(c.tukar = 0, a.debet, a.kredit) AS penambahana, IF(c.tukar = 1, a.debet, a.kredit) AS pengurangana, a.debet AS penambahan, a.kredit AS pengurangan
FROM `gmd_fnance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
IFNULL(a.ket,"") LIKE '%%' ESCAPE '!'
 )
AND `a`.`id_biaya` = '100000'
AND (a.tanggal BETWEEN '2019-12-19' AND '2019-12-19')
AND `a`.`branch` = '8'
ORDER BY `a`.`tanggal` ASC, `a`.`no_trans` ASC
ERROR - 2019-12-19 07:25:17 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-19 07:25:22 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-19 14:25:22 --> Query error: Table 'erp_financev2.gmd_fnance_coa_general_ledger_detail' doesn't exist - Invalid query: SELECT DATE_FORMAT(b.tanggal, '%d-%m-%Y') AS tanggalnya, a.no_trans, a.id_biaya, b.jurnal_group, a.ket, b.deskripsi, IF(c.tukar = 0, a.debet, a.kredit) AS penambahana, IF(c.tukar = 1, a.debet, a.kredit) AS pengurangana, a.debet AS penambahan, a.kredit AS pengurangan
FROM `gmd_fnance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
IFNULL(a.ket,"") LIKE '%%' ESCAPE '!'
 )
AND `a`.`id_biaya` = '100000'
AND (a.tanggal BETWEEN '2019-12-19' AND '2019-12-19')
AND `a`.`branch` = '8'
ORDER BY `a`.`tanggal` ASC, `a`.`no_trans` ASC
ERROR - 2019-12-19 14:35:40 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_detail' doesn't exist - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.no_trans, DATE_FORMAT(a.tanggal, '%d/%m/%Y') AS tanggalnya, b.jurnal_group, b.deskripsi, b.`no_referensi` AS ref, a.ket AS memo, SUM(a.debet) AS debet, SUM(a.kredit) AS kredit
FROM `gmd_inance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
`a`.`no_trans` LIKE '%%' ESCAPE '!'
OR  `b`.`jurnal_group` LIKE '%%' ESCAPE '!'
OR  `b`.`deskripsi` LIKE '%%' ESCAPE '!'
OR  `a`.`id_biaya` LIKE '%%' ESCAPE '!'
OR  `c`.`nama` LIKE '%%' ESCAPE '!'
OR  `a`.`ket` LIKE '%%' ESCAPE '!'
OR  `b`.`no_referensi` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2019-12-01' and '2019-12-31')
GROUP BY `a`.`no_trans`
ORDER BY `a`.`no_trans` DESC
ERROR - 2019-12-19 14:35:53 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_detail' doesn't exist - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.no_trans, DATE_FORMAT(a.tanggal, '%d/%m/%Y') AS tanggalnya, b.jurnal_group, b.deskripsi, b.`no_referensi` AS ref, a.ket AS memo, SUM(a.debet) AS debet, SUM(a.kredit) AS kredit
FROM `gmd_inance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
`a`.`no_trans` LIKE '%%' ESCAPE '!'
OR  `b`.`jurnal_group` LIKE '%%' ESCAPE '!'
OR  `b`.`deskripsi` LIKE '%%' ESCAPE '!'
OR  `a`.`id_biaya` LIKE '%%' ESCAPE '!'
OR  `c`.`nama` LIKE '%%' ESCAPE '!'
OR  `a`.`ket` LIKE '%%' ESCAPE '!'
OR  `b`.`no_referensi` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2019-12-01' and '2019-12-31')
GROUP BY `a`.`no_trans`
ORDER BY `a`.`no_trans` DESC
ERROR - 2019-12-19 14:40:07 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_detail' doesn't exist - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.no_trans, DATE_FORMAT(a.tanggal, '%d/%m/%Y') AS tanggalnya, b.jurnal_group, b.deskripsi, b.`no_referensi` AS ref, a.ket AS memo, SUM(a.debet) AS debet, SUM(a.kredit) AS kredit
FROM `gmd_inance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
`a`.`no_trans` LIKE '%%' ESCAPE '!'
OR  `b`.`jurnal_group` LIKE '%%' ESCAPE '!'
OR  `b`.`deskripsi` LIKE '%%' ESCAPE '!'
OR  `a`.`id_biaya` LIKE '%%' ESCAPE '!'
OR  `c`.`nama` LIKE '%%' ESCAPE '!'
OR  `a`.`ket` LIKE '%%' ESCAPE '!'
OR  `b`.`no_referensi` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2019-12-01' and '2019-12-31')
GROUP BY `a`.`no_trans`
ORDER BY `a`.`no_trans` DESC
ERROR - 2019-12-19 14:53:11 --> Severity: Notice --> Undefined index: arr_menu /data/www/html/erpsmg/finance_gmedia/application/core/MY_Controller.php 112
ERROR - 2019-12-19 14:53:11 --> Severity: Notice --> Undefined index: regional_area_picker /data/www/html/erpsmg/finance_gmedia/application/views/flat/navbar.php 26
ERROR - 2019-12-19 14:53:11 --> Severity: Notice --> Undefined index: regional_area_picker /data/www/html/erpsmg/finance_gmedia/application/views/flat/navbar.php 31
ERROR - 2019-12-19 14:53:11 --> Severity: Notice --> Undefined index: regional_area_picker /data/www/html/erpsmg/finance_gmedia/application/views/flat/navbar.php 31
ERROR - 2019-12-19 15:10:57 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_detail' doesn't exist - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.no_trans, DATE_FORMAT(a.tanggal, '%d/%m/%Y') AS tanggalnya, b.jurnal_group, b.deskripsi, b.`no_referensi` AS ref, a.ket AS memo, SUM(a.debet) AS debet, SUM(a.kredit) AS kredit
FROM `gmd_inance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
`a`.`no_trans` LIKE '%%' ESCAPE '!'
OR  `b`.`jurnal_group` LIKE '%%' ESCAPE '!'
OR  `b`.`deskripsi` LIKE '%%' ESCAPE '!'
OR  `a`.`id_biaya` LIKE '%%' ESCAPE '!'
OR  `c`.`nama` LIKE '%%' ESCAPE '!'
OR  `a`.`ket` LIKE '%%' ESCAPE '!'
OR  `b`.`no_referensi` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2019-12-01' and '2019-12-31')
GROUP BY `a`.`no_trans`
ORDER BY `a`.`no_trans` DESC
ERROR - 2019-12-19 15:17:04 --> Severity: error --> Exception: Too few arguments to function finance_invoice_customer::approve_invoice(), 0 passed in /data/www/html/erpsmg/finance_gmedia/system/core/CodeIgniter.php on line 532 and exactly 1 expected /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 2048
ERROR - 2019-12-19 15:17:16 --> Severity: error --> Exception: Too few arguments to function finance_invoice_customer::approve_invoice(), 0 passed in /data/www/html/erpsmg/finance_gmedia/system/core/CodeIgniter.php on line 532 and exactly 1 expected /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 2048
ERROR - 2019-12-19 15:17:16 --> Severity: error --> Exception: Too few arguments to function finance_invoice_customer::approve_invoice(), 0 passed in /data/www/html/erpsmg/finance_gmedia/system/core/CodeIgniter.php on line 532 and exactly 1 expected /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 2048
ERROR - 2019-12-19 15:17:16 --> Severity: error --> Exception: Too few arguments to function finance_invoice_customer::approve_invoice(), 0 passed in /data/www/html/erpsmg/finance_gmedia/system/core/CodeIgniter.php on line 532 and exactly 1 expected /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 2048
ERROR - 2019-12-19 15:17:16 --> Severity: error --> Exception: Too few arguments to function finance_invoice_customer::approve_invoice(), 0 passed in /data/www/html/erpsmg/finance_gmedia/system/core/CodeIgniter.php on line 532 and exactly 1 expected /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 2048
ERROR - 2019-12-19 15:17:16 --> Severity: error --> Exception: Too few arguments to function finance_invoice_customer::approve_invoice(), 0 passed in /data/www/html/erpsmg/finance_gmedia/system/core/CodeIgniter.php on line 532 and exactly 1 expected /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 2048
ERROR - 2019-12-19 15:17:16 --> Severity: error --> Exception: Too few arguments to function finance_invoice_customer::approve_invoice(), 0 passed in /data/www/html/erpsmg/finance_gmedia/system/core/CodeIgniter.php on line 532 and exactly 1 expected /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 2048
ERROR - 2019-12-19 15:17:17 --> Severity: error --> Exception: Too few arguments to function finance_invoice_customer::approve_invoice(), 0 passed in /data/www/html/erpsmg/finance_gmedia/system/core/CodeIgniter.php on line 532 and exactly 1 expected /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 2048
ERROR - 2019-12-19 08:17:50 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-19 08:17:50 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-19 08:17:50 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-12-19 08:17:50 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-19 08:17:50 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-19 15:18:56 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_detail' doesn't exist - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.no_trans, DATE_FORMAT(a.tanggal, '%d/%m/%Y') AS tanggalnya, b.jurnal_group, b.deskripsi, b.`no_referensi` AS ref, a.ket AS memo, SUM(a.debet) AS debet, SUM(a.kredit) AS kredit
FROM `gmd_inance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
`a`.`no_trans` LIKE '%%' ESCAPE '!'
OR  `b`.`jurnal_group` LIKE '%%' ESCAPE '!'
OR  `b`.`deskripsi` LIKE '%%' ESCAPE '!'
OR  `a`.`id_biaya` LIKE '%%' ESCAPE '!'
OR  `c`.`nama` LIKE '%%' ESCAPE '!'
OR  `a`.`ket` LIKE '%%' ESCAPE '!'
OR  `b`.`no_referensi` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2019-12-01' and '2019-12-31')
GROUP BY `a`.`no_trans`
ORDER BY `a`.`no_trans` DESC
ERROR - 2019-12-19 15:19:03 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_detail' doesn't exist - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.no_trans, DATE_FORMAT(a.tanggal, '%d/%m/%Y') AS tanggalnya, b.jurnal_group, b.deskripsi, b.`no_referensi` AS ref, a.ket AS memo, SUM(a.debet) AS debet, SUM(a.kredit) AS kredit
FROM `gmd_inance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
`a`.`no_trans` LIKE '%%' ESCAPE '!'
OR  `b`.`jurnal_group` LIKE '%%' ESCAPE '!'
OR  `b`.`deskripsi` LIKE '%%' ESCAPE '!'
OR  `a`.`id_biaya` LIKE '%%' ESCAPE '!'
OR  `c`.`nama` LIKE '%%' ESCAPE '!'
OR  `a`.`ket` LIKE '%%' ESCAPE '!'
OR  `b`.`no_referensi` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2019-12-01' and '2019-12-31')
GROUP BY `a`.`no_trans`
ORDER BY `a`.`no_trans` DESC
ERROR - 2019-12-19 15:19:21 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_detail' doesn't exist - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.no_trans, DATE_FORMAT(a.tanggal, '%d/%m/%Y') AS tanggalnya, b.jurnal_group, b.deskripsi, b.`no_referensi` AS ref, a.ket AS memo, SUM(a.debet) AS debet, SUM(a.kredit) AS kredit
FROM `gmd_inance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
`a`.`no_trans` LIKE '%%' ESCAPE '!'
OR  `b`.`jurnal_group` LIKE '%%' ESCAPE '!'
OR  `b`.`deskripsi` LIKE '%%' ESCAPE '!'
OR  `a`.`id_biaya` LIKE '%%' ESCAPE '!'
OR  `c`.`nama` LIKE '%%' ESCAPE '!'
OR  `a`.`ket` LIKE '%%' ESCAPE '!'
OR  `b`.`no_referensi` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2019-12-01' and '2019-12-31')
GROUP BY `a`.`no_trans`
ORDER BY `a`.`no_trans` DESC
ERROR - 2019-12-19 15:19:49 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_detail' doesn't exist - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.no_trans, DATE_FORMAT(a.tanggal, '%d/%m/%Y') AS tanggalnya, b.jurnal_group, b.deskripsi, b.`no_referensi` AS ref, a.ket AS memo, SUM(a.debet) AS debet, SUM(a.kredit) AS kredit
FROM `gmd_inance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
`a`.`no_trans` LIKE '%%' ESCAPE '!'
OR  `b`.`jurnal_group` LIKE '%%' ESCAPE '!'
OR  `b`.`deskripsi` LIKE '%%' ESCAPE '!'
OR  `a`.`id_biaya` LIKE '%%' ESCAPE '!'
OR  `c`.`nama` LIKE '%%' ESCAPE '!'
OR  `a`.`ket` LIKE '%%' ESCAPE '!'
OR  `b`.`no_referensi` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2019-12-01' and '2019-12-31')
GROUP BY `a`.`no_trans`
ORDER BY `a`.`no_trans` DESC
ERROR - 2019-12-19 15:23:13 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_detail' doesn't exist - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.no_trans, DATE_FORMAT(a.tanggal, '%d/%m/%Y') AS tanggalnya, b.jurnal_group, b.deskripsi, b.`no_referensi` AS ref, a.ket AS memo, SUM(a.debet) AS debet, SUM(a.kredit) AS kredit
FROM `gmd_inance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
`a`.`no_trans` LIKE '%%' ESCAPE '!'
OR  `b`.`jurnal_group` LIKE '%%' ESCAPE '!'
OR  `b`.`deskripsi` LIKE '%%' ESCAPE '!'
OR  `a`.`id_biaya` LIKE '%%' ESCAPE '!'
OR  `c`.`nama` LIKE '%%' ESCAPE '!'
OR  `a`.`ket` LIKE '%%' ESCAPE '!'
OR  `b`.`no_referensi` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2019-12-01' and '2019-12-31')
GROUP BY `a`.`no_trans`
ORDER BY `a`.`no_trans` DESC
ERROR - 2019-12-19 15:28:43 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_detail' doesn't exist - Invalid query: SELECT DATE_FORMAT(b.tanggal, '%d-%m-%Y') AS tanggalnya, a.no_trans, a.id_biaya, b.jurnal_group, a.ket, b.deskripsi, IF(c.tukar = 0, a.debet, a.kredit) AS penambahana, IF(c.tukar = 1, a.debet, a.kredit) AS pengurangana, a.debet AS penambahan, a.kredit AS pengurangan
FROM `gmd_inance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
IFNULL(a.ket,"") LIKE '%%' ESCAPE '!'
 )
AND `a`.`id_biaya` = '111200'
AND (a.tanggal BETWEEN '2019-12-18' AND '2019-12-19')
AND `a`.`branch` = '8'
ORDER BY `a`.`ket` ASC
ERROR - 2019-12-19 08:28:45 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-19 15:28:49 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_detail' doesn't exist - Invalid query: SELECT DATE_FORMAT(b.tanggal, '%d-%m-%Y') AS tanggalnya, a.no_trans, a.id_biaya, b.jurnal_group, a.ket, b.deskripsi, IF(c.tukar = 0, a.debet, a.kredit) AS penambahana, IF(c.tukar = 1, a.debet, a.kredit) AS pengurangana, a.debet AS penambahan, a.kredit AS pengurangan
FROM `gmd_inance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
IFNULL(a.ket,"") LIKE '%%' ESCAPE '!'
 )
AND `a`.`id_biaya` = '111200'
AND (a.tanggal BETWEEN '2019-12-18' AND '2019-12-19')
AND `a`.`branch` = '8'
ORDER BY `a`.`ket` ASC
ERROR - 2019-12-19 15:36:05 --> Query error: Unknown column 'deskripsi' in 'field list' - Invalid query: SELECT 
		  SQL_CALC_FOUND_ROWS *, date_format(tanggal, '%d-%m-%Y') as tanggalnya 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '9'
			AND branch = '8'
			AND (
			  tanggal BETWEEN '2019-12-01' AND '2019-12-31'
			)
		) AS kasnya 
		ORDER BY tanggal ASC, saldo_m DESC, saldo_k ASC 
ERROR - 2019-12-19 15:39:51 --> Query error: Unknown column 'deskripsi' in 'field list' - Invalid query: SELECT 
		  SQL_CALC_FOUND_ROWS *, date_format(tanggal, '%d-%m-%Y') as tanggalnya 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '9'
			AND branch = '8'
			AND (
			  tanggal BETWEEN '2019-12-01' AND '2019-12-31'
			)
		) AS kasnya 
		ORDER BY tanggal ASC, saldo_m DESC, saldo_k ASC 
ERROR - 2019-12-19 15:40:13 --> Query error: Unknown column 'deskripsi' in 'field list' - Invalid query: SELECT 
		  SUM(saldo_m - saldo_k) AS saldo 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '9'
			AND tanggal < '2019-12-19'
			AND branch = '8'
			) AS kasnya 
		ORDER BY tanggal ASC 
ERROR - 2019-12-19 15:42:55 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_detail' doesn't exist - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.no_trans, DATE_FORMAT(a.tanggal, '%d/%m/%Y') AS tanggalnya, b.jurnal_group, b.deskripsi, b.`no_referensi` AS ref, a.ket AS memo, SUM(a.debet) AS debet, SUM(a.kredit) AS kredit
FROM `gmd_inance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
`a`.`no_trans` LIKE '%%' ESCAPE '!'
OR  `b`.`jurnal_group` LIKE '%%' ESCAPE '!'
OR  `b`.`deskripsi` LIKE '%%' ESCAPE '!'
OR  `a`.`id_biaya` LIKE '%%' ESCAPE '!'
OR  `c`.`nama` LIKE '%%' ESCAPE '!'
OR  `a`.`ket` LIKE '%%' ESCAPE '!'
OR  `b`.`no_referensi` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2019-12-01' and '2019-12-31')
GROUP BY `a`.`no_trans`
ORDER BY `a`.`no_trans` DESC
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:45:15 --> Severity: Notice --> Undefined index: ref /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 51
ERROR - 2019-12-19 15:51:26 --> Severity: Notice --> Use of undefined constant ASC - assumed 'ASC' /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 35
ERROR - 2019-12-19 15:51:26 --> Query error: Unknown column 'debit' in 'order clause' - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.no_trans, DATE_FORMAT(a.tanggal, '%d/%m/%Y') AS tanggalnya, b.jurnal_group, b.deskripsi, a.id_biaya, c.nama as nama_coa, a.ket AS memo, a.debet, a.kredit
FROM `gmd_finance_coa_general_ledger_detail` `a`
LEFT JOIN `gmd_finance_coa_general_ledger` `b` ON `a`.`no_trans` = `b`.`no_trans`
LEFT JOIN `gmd_finance_coa` `c` ON `a`.`id_biaya` = `c`.`id`
WHERE   (
`a`.`no_trans` LIKE '%%' ESCAPE '!'
OR  `b`.`jurnal_group` LIKE '%%' ESCAPE '!'
OR  `b`.`deskripsi` LIKE '%%' ESCAPE '!'
OR  `a`.`id_biaya` LIKE '%%' ESCAPE '!'
OR  `c`.`nama` LIKE '%%' ESCAPE '!'
OR  `a`.`ket` LIKE '%%' ESCAPE '!'
OR  `b`.`no_referensi` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2019-12-01' and '2019-12-31')
ORDER BY `a`.`no_trans` DESC, `debit` ASC
ERROR - 2019-12-19 15:51:39 --> Severity: Notice --> Use of undefined constant ASC - assumed 'ASC' /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 35
ERROR - 2019-12-19 10:04:41 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-19 10:04:41 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-12-19 10:04:41 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-19 10:04:41 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-19 10:04:41 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-19 17:23:07 --> Severity: Notice --> Array to string conversion /data/www/html/erpsmg/finance_gmedia/system/database/DB_driver.php 1476
ERROR - 2019-12-19 17:23:07 --> Query error: Unknown column 'Array' in 'field list' - Invalid query: INSERT INTO `gmd_finance_coa_general_ledger_detail` (`no_trans`, `id_biaya`, `card_id`, `tanggal`, `divisi`, `debet`, `kredit`, `ket`, `branch`, `area`) VALUES ('19121909155700010001', '111200', '1', '2019-12-01', '11', 5000000, 0, Array, '8', '2')
ERROR - 2019-12-19 10:29:58 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-12-19 10:29:58 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-19 10:29:58 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-19 10:29:58 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-19 10:29:58 --> 404 Page Not Found: Select_data_cash_month/2019
