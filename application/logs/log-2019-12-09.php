<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-12-09 15:38:46 --> Query error: Unknown column 'kas_bank' in 'where clause' - Invalid query: SELECT 
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
ERROR - 2019-12-09 15:38:58 --> Query error: Unknown column 'kas_bank' in 'where clause' - Invalid query: SELECT 
		  SUM(saldo_m - saldo_k) AS saldo 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '9'
			AND tanggal < '2019-12-03'
			AND branch = '8'
			) AS kasnya 
		ORDER BY tanggal ASC 
ERROR - 2019-12-09 15:59:15 --> Query error: Unknown column 'kas_bank' in 'where clause' - Invalid query: SELECT 
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
ERROR - 2019-12-09 17:38:18 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
