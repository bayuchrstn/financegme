<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-11-28 00:04:27 --> Query error: Out of range value for column 'id' at row 1 - Invalid query: INSERT INTO `gmd_finance_ap_invoice` (`nomor`, `tanggal`, `date_due`, `supplier`, `potongan`, `materai`, `ppn`, `jumlah`, `no_referensi`, `branch`, `regional`, `id_penerimaan`, `id_pembelian`, `insert_at`, `insert_by`) VALUES ('1/INV/11/19', '2019-11-28', '2019-11-29', '77', '', '', '', '673500', 'qeq', '8', '2', '0', '2828', '2019-11-28 00:04:27', NULL)
ERROR - 2019-11-28 10:27:43 --> Query error: Unknown column 'kas_bank' in 'where clause' - Invalid query: SELECT 
		  SQL_CALC_FOUND_ROWS *, date_format(tanggal, '%d-%m-%Y') as tanggalnya 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '9'
			AND branch = '8'
			AND (
			  tanggal BETWEEN '2019-11-01' AND '2019-11-30'
			)
		) AS kasnya 
		ORDER BY tanggal ASC, saldo_m DESC, saldo_k ASC 
ERROR - 2019-11-28 03:27:46 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 03:27:49 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 10:27:49 --> Query error: Unknown column 'kas_bank' in 'where clause' - Invalid query: SELECT 
		  SQL_CALC_FOUND_ROWS *, date_format(tanggal, '%d-%m-%Y') as tanggalnya 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '9'
			AND branch = '8'
			AND (
			  tanggal BETWEEN '2019-11-01' AND '2019-11-30'
			)
		) AS kasnya 
		ORDER BY tanggal ASC, saldo_m DESC, saldo_k ASC 
ERROR - 2019-11-28 10:28:24 --> Query error: Unknown column 'kas_bank' in 'where clause' - Invalid query: SELECT 
		  SUM(saldo_m - saldo_k) AS saldo 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '9'
			AND tanggal < '2019-11-28'
			AND branch = '8'
			) AS kasnya 
		ORDER BY tanggal ASC 
ERROR - 2019-11-28 06:51:15 --> 404 Page Not Found: Finance_coa_card/index
ERROR - 2019-11-28 14:17:14 --> Query error: Unknown column 'a.invoice_id' in 'where clause' - Invalid query: SELECT a.*
FROM `gmd_finance_ap_invoice_detail` AS `a`
WHERE `a`.`invoice_id` = '1'
ORDER BY `a`.`deskripsi` ASC
ERROR - 2019-11-28 15:41:45 --> Query error: Unknown column 'kas_bank' in 'where clause' - Invalid query: SELECT 
		  SQL_CALC_FOUND_ROWS *, date_format(tanggal, '%d-%m-%Y') as tanggalnya 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '9'
			AND branch = '8'
			AND (
			  tanggal BETWEEN '2019-11-01' AND '2019-11-30'
			)
		) AS kasnya 
		ORDER BY tanggal ASC, saldo_m DESC, saldo_k ASC 
ERROR - 2019-11-28 15:41:54 --> Query error: Unknown column 'kas_bank' in 'where clause' - Invalid query: SELECT 
		  SUM(saldo_m - saldo_k) AS saldo 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '9'
			AND tanggal < '2019-11-28'
			AND branch = '8'
			) AS kasnya 
		ORDER BY tanggal ASC 
ERROR - 2019-11-28 15:41:59 --> Query error: Unknown column 'kas_bank' in 'where clause' - Invalid query: SELECT 
		  SUM(saldo_m - saldo_k) AS saldo 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '9'
			AND tanggal < '2019-11-28'
			AND branch = '8'
			) AS kasnya 
		ORDER BY tanggal ASC 
ERROR - 2019-11-28 16:11:57 --> Query error: Unknown column 'kas_bank' in 'where clause' - Invalid query: SELECT 
		  SQL_CALC_FOUND_ROWS *, date_format(tanggal, '%d-%m-%Y') as tanggalnya 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '9'
			AND branch = '8'
			AND (
			  tanggal BETWEEN '2019-11-01' AND '2019-11-30'
			)
		) AS kasnya 
		ORDER BY tanggal ASC, saldo_m DESC, saldo_k ASC 
ERROR - 2019-11-28 09:22:08 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-11-28 09:22:08 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-11-28 09:22:08 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-11-28 09:22:08 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-11-28 09:22:08 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-11-28 09:29:24 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-11-28 09:29:24 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-11-28 09:29:24 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-11-28 09:29:24 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-11-28 09:29:24 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-11-28 16:41:21 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:41:21 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:41:24 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:41:24 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:41:30 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:41:30 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:41:32 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:41:32 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:41:34 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:41:34 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:41:40 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:41:40 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:41:54 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:41:54 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:42:02 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:42:02 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:42:04 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:42:04 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:42:20 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:42:20 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:42:20 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:42:20 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:42:20 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:42:20 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:44:38 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:44:38 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:44:48 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:44:48 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:44:48 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:44:48 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:44:48 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:44:48 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 16:49:07 --> Query error: Table 'erp_financev2.gmd_inance_transaksi_kasir' doesn't exist - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.*, DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya, c.nama as nama_divisi, COALESCE(a.jumlah, 0), d.nama as nama_kode, CASE WHEN a.`branch`=1 THEN 'Semarang' WHEN a.`branch`=2 THEN 'Salatiga' END AS cabang
FROM `gmd_inance_transaksi_kasir` `a`
LEFT JOIN `gmd_finance_transaksi_kasir_detail` `b` ON `a`.`id` = `b`.`id_kasir`
LEFT JOIN `gmd_finance_master_divisi` `c` ON `a`.`divisi` = `c`.`id`
LEFT JOIN `gmd_finance_master_kat_gl` `d` ON `a`.`kode` = `d`.`id`
WHERE   (
`a`.`deskripsi` LIKE '%%' ESCAPE '!'
AND  `a`.`nomor` LIKE '%%' ESCAPE '!'
 )
AND `a`.`status` = '1'
AND `b`.`status` = '1'
AND (a.tanggal between '2019-11-01' and '2019-11-30')
GROUP BY `a`.`id`
 LIMIT 100
ERROR - 2019-11-28 16:49:13 --> Query error: Table 'erp_financev2.gmd_inance_transaksi_kasir' doesn't exist - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.*, DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya, c.nama as nama_divisi, COALESCE(a.jumlah, 0), d.nama as nama_kode, CASE WHEN a.`branch`=1 THEN 'Semarang' WHEN a.`branch`=2 THEN 'Salatiga' END AS cabang
FROM `gmd_inance_transaksi_kasir` `a`
LEFT JOIN `gmd_finance_transaksi_kasir_detail` `b` ON `a`.`id` = `b`.`id_kasir`
LEFT JOIN `gmd_finance_master_divisi` `c` ON `a`.`divisi` = `c`.`id`
LEFT JOIN `gmd_finance_master_kat_gl` `d` ON `a`.`kode` = `d`.`id`
WHERE   (
`a`.`deskripsi` LIKE '%%' ESCAPE '!'
AND  `a`.`nomor` LIKE '%%' ESCAPE '!'
 )
AND `a`.`status` = '1'
AND `b`.`status` = '1'
AND (a.tanggal between '2019-11-01' and '2019-11-30')
GROUP BY `a`.`id`
 LIMIT 100
ERROR - 2019-11-28 16:54:54 --> Severity: Notice --> Undefined index: desc /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_transaksi_kas_kecil.php 14
ERROR - 2019-11-28 16:54:55 --> Severity: Notice --> Undefined index: desc /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_transaksi_kas_kecil.php 14
ERROR - 2019-11-28 16:55:28 --> Severity: Notice --> Undefined index: desc /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_transaksi_kas_kecil.php 14
ERROR - 2019-11-28 16:55:31 --> Severity: Notice --> Undefined index: desc /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_transaksi_kas_kecil.php 14
ERROR - 2019-11-28 16:56:11 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '.*, DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya, c.nama as nama_divisi, COA' at line 1 - Invalid query: SELECT QL_CALC_FOUND_ROWS a.*, DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya, c.nama as nama_divisi, COALESCE(a.jumlah, 0), d.nama as nama_kode, CASE WHEN a.`branch`=1 THEN 'Semarang' WHEN a.`branch`=2 THEN 'Salatiga' END AS cabang
FROM `gmd_finance_transaksi_kasir` `a`
LEFT JOIN `gmd_finance_transaksi_kasir_detail` `b` ON `a`.`id` = `b`.`id_kasir`
LEFT JOIN `gmd_finance_master_divisi` `c` ON `a`.`divisi` = `c`.`id`
LEFT JOIN `gmd_finance_master_kat_gl` `d` ON `a`.`kode` = `d`.`id`
WHERE   (
`a`.`deskripsi` LIKE '%%' ESCAPE '!'
AND  `a`.`nomor` LIKE '%%' ESCAPE '!'
 )
AND `a`.`status` = '1'
AND `b`.`status` = '1'
AND (a.tanggal between '2019-11-01' and '2019-11-30')
GROUP BY `a`.`id`
 LIMIT 100
ERROR - 2019-11-28 16:57:05 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '.*, DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya, c.nama as nama_divisi, COA' at line 1 - Invalid query: SELECT QL_CALC_FOUND_ROWS a.*, DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya, c.nama as nama_divisi, COALESCE(a.jumlah, 0), d.nama as nama_kode, CASE WHEN a.`branch`=1 THEN 'Semarang' WHEN a.`branch`=2 THEN 'Salatiga' END AS cabang
FROM `gmd_finance_transaksi_kasir` `a`
LEFT JOIN `gmd_finance_transaksi_kasir_detail` `b` ON `a`.`id` = `b`.`id_kasir`
LEFT JOIN `gmd_finance_master_divisi` `c` ON `a`.`divisi` = `c`.`id`
LEFT JOIN `gmd_finance_master_kat_gl` `d` ON `a`.`kode` = `d`.`id`
WHERE   (
`a`.`deskripsi` LIKE '%%' ESCAPE '!'
AND  `a`.`nomor` LIKE '%%' ESCAPE '!'
 )
AND `a`.`status` = '1'
AND `b`.`status` = '1'
AND (a.tanggal between '2019-11-01' and '2019-11-30')
GROUP BY `a`.`id`
 LIMIT 100
ERROR - 2019-11-28 16:58:23 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '.*, DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya, c.nama as nama_divisi, COA' at line 1 - Invalid query: SELECT QL_CALC_FOUND_ROWS a.*, DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya, c.nama as nama_divisi, COALESCE(a.jumlah, 0), d.nama as nama_kode, CASE WHEN a.`branch`=1 THEN 'Semarang' WHEN a.`branch`=2 THEN 'Salatiga' END AS cabang
FROM `gmd_finance_transaksi_kasir` `a`
LEFT JOIN `gmd_finance_transaksi_kasir_detail` `b` ON `a`.`id` = `b`.`id_kasir`
LEFT JOIN `gmd_finance_master_divisi` `c` ON `a`.`divisi` = `c`.`id`
LEFT JOIN `gmd_finance_master_kat_gl` `d` ON `a`.`kode` = `d`.`id`
WHERE   (
`a`.`deskripsi` LIKE '%%' ESCAPE '!'
AND  `a`.`nomor` LIKE '%%' ESCAPE '!'
 )
AND `a`.`status` = '1'
AND `b`.`status` = '1'
AND (a.tanggal between '2019-11-01' and '2019-11-30')
GROUP BY `a`.`id`
 LIMIT 100
ERROR - 2019-11-28 16:58:24 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '.*, DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya, c.nama as nama_divisi, COA' at line 1 - Invalid query: SELECT QL_CALC_FOUND_ROWS a.*, DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya, c.nama as nama_divisi, COALESCE(a.jumlah, 0), d.nama as nama_kode, CASE WHEN a.`branch`=1 THEN 'Semarang' WHEN a.`branch`=2 THEN 'Salatiga' END AS cabang
FROM `gmd_finance_transaksi_kasir` `a`
LEFT JOIN `gmd_finance_transaksi_kasir_detail` `b` ON `a`.`id` = `b`.`id_kasir`
LEFT JOIN `gmd_finance_master_divisi` `c` ON `a`.`divisi` = `c`.`id`
LEFT JOIN `gmd_finance_master_kat_gl` `d` ON `a`.`kode` = `d`.`id`
WHERE   (
`a`.`deskripsi` LIKE '%%' ESCAPE '!'
AND  `a`.`nomor` LIKE '%%' ESCAPE '!'
 )
AND `a`.`status` = '1'
AND `b`.`status` = '1'
AND (a.tanggal between '2019-11-01' and '2019-11-30')
GROUP BY `a`.`id`
 LIMIT 100
ERROR - 2019-11-28 16:58:28 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '.*, DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya, c.nama as nama_divisi, COA' at line 1 - Invalid query: SELECT QL_CALC_FOUND_ROWS a.*, DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya, c.nama as nama_divisi, COALESCE(a.jumlah, 0), d.nama as nama_kode, CASE WHEN a.`branch`=1 THEN 'Semarang' WHEN a.`branch`=2 THEN 'Salatiga' END AS cabang
FROM `gmd_finance_transaksi_kasir` `a`
LEFT JOIN `gmd_finance_transaksi_kasir_detail` `b` ON `a`.`id` = `b`.`id_kasir`
LEFT JOIN `gmd_finance_master_divisi` `c` ON `a`.`divisi` = `c`.`id`
LEFT JOIN `gmd_finance_master_kat_gl` `d` ON `a`.`kode` = `d`.`id`
WHERE   (
`a`.`deskripsi` LIKE '%%' ESCAPE '!'
AND  `a`.`nomor` LIKE '%%' ESCAPE '!'
 )
AND `a`.`status` = '1'
AND `b`.`status` = '1'
AND (a.tanggal between '2019-11-01' and '2019-11-30')
GROUP BY `a`.`id`
 LIMIT 100
ERROR - 2019-11-28 16:58:30 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '.*, DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya, c.nama as nama_divisi, COA' at line 1 - Invalid query: SELECT QL_CALC_FOUND_ROWS a.*, DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya, c.nama as nama_divisi, COALESCE(a.jumlah, 0), d.nama as nama_kode, CASE WHEN a.`branch`=1 THEN 'Semarang' WHEN a.`branch`=2 THEN 'Salatiga' END AS cabang
FROM `gmd_finance_transaksi_kasir` `a`
LEFT JOIN `gmd_finance_transaksi_kasir_detail` `b` ON `a`.`id` = `b`.`id_kasir`
LEFT JOIN `gmd_finance_master_divisi` `c` ON `a`.`divisi` = `c`.`id`
LEFT JOIN `gmd_finance_master_kat_gl` `d` ON `a`.`kode` = `d`.`id`
WHERE   (
`a`.`deskripsi` LIKE '%%' ESCAPE '!'
AND  `a`.`nomor` LIKE '%%' ESCAPE '!'
 )
AND `a`.`status` = '1'
AND `b`.`status` = '1'
AND (a.tanggal between '2019-11-01' and '2019-11-30')
GROUP BY `a`.`id`
 LIMIT 100
ERROR - 2019-11-28 17:08:46 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 17:08:46 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 17:08:46 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 17:08:46 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 17:08:46 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 17:08:46 --> Severity: Notice --> Undefined property: stdClass::$kota /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1016
ERROR - 2019-11-28 10:09:19 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-11-28 10:09:19 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-11-28 10:09:19 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-11-28 10:09:19 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-11-28 10:09:19 --> 404 Page Not Found: Select_data_income_expenses/2019
