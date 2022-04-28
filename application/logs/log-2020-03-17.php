<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-03-17 08:24:11 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-17 08:24:11 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-17 08:42:37 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-17 08:42:37 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-17 08:44:03 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-17 08:44:03 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-17 08:48:54 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-17 08:48:54 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-17 01:52:11 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-03-17 01:52:11 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-03-17 01:52:11 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-03-17 01:52:11 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-03-17 01:52:11 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-03-17 09:18:20 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-17 09:18:20 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-17 02:56:47 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-03-17 02:56:47 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-03-17 02:56:47 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-03-17 02:56:47 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-03-17 02:56:47 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-03-17 10:18:55 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-17 10:18:55 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-17 03:20:23 --> 404 Page Not Found: Assets/js
ERROR - 2020-03-17 03:20:23 --> 404 Page Not Found: Assets/js
ERROR - 2020-03-17 03:20:23 --> 404 Page Not Found: Assets/js
ERROR - 2020-03-17 03:20:23 --> 404 Page Not Found: Assets/js
ERROR - 2020-03-17 03:20:23 --> 404 Page Not Found: Assets/js
ERROR - 2020-03-17 03:26:27 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-03-17 03:26:27 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-03-17 03:26:27 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-03-17 03:26:27 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-03-17 03:26:27 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-03-17 11:24:19 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-17 11:24:19 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-17 11:29:32 --> Query error: Unknown column 'deskripsi' in 'field list' - Invalid query: SELECT 
		  SUM(saldo_m - saldo_k) AS saldo 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '9'
			AND tanggal < '2020-03-13'
			AND branch = '8'
			) AS kasnya 
		ORDER BY tanggal ASC 
ERROR - 2020-03-17 11:29:56 --> Query error: Unknown column 'deskripsi' in 'field list' - Invalid query: SELECT 
		  SUM(saldo_m - saldo_k) AS saldo 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '9'
			AND tanggal < '2020-03-13'
			AND branch = '8'
			) AS kasnya 
		ORDER BY tanggal ASC 
ERROR - 2020-03-17 11:31:14 --> Query error: Unknown column 'deskripsi' in 'field list' - Invalid query: SELECT 
		  SUM(saldo_m - saldo_k) AS saldo 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '9'
			AND tanggal < '2020-03-17'
			AND branch = '8'
			) AS kasnya 
		ORDER BY tanggal ASC 
ERROR - 2020-03-17 05:26:19 --> 404 Page Not Found: Assets/js
ERROR - 2020-03-17 05:26:19 --> 404 Page Not Found: Assets/js
ERROR - 2020-03-17 05:26:19 --> 404 Page Not Found: Assets/js
ERROR - 2020-03-17 05:26:19 --> 404 Page Not Found: Assets/js
ERROR - 2020-03-17 05:26:19 --> 404 Page Not Found: Assets/js
ERROR - 2020-03-17 05:26:20 --> 404 Page Not Found: Assets/js
ERROR - 2020-03-17 05:26:43 --> 404 Page Not Found: Assets/js
ERROR - 2020-03-17 13:38:18 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-17 13:38:18 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-17 14:42:45 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-17 14:42:45 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-17 14:55:44 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-17 14:55:44 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-17 14:59:14 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-17 14:59:14 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-17 15:42:59 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-17 15:42:59 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-17 16:13:12 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-17 16:13:12 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
