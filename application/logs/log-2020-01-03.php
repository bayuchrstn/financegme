<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-01-03 10:02:08 --> Severity: Notice --> Undefined index: memo /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 160
ERROR - 2020-01-03 10:02:08 --> Severity: Notice --> Undefined index: memo /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 160
ERROR - 2020-01-03 03:02:37 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-03 03:02:37 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-03 03:02:37 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-01-03 03:02:37 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-03 03:02:37 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-03 03:26:34 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-03 03:26:34 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-03 03:26:34 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-01-03 03:26:34 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-03 03:26:34 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-03 10:33:15 --> Severity: Notice --> Undefined index: memo /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 160
ERROR - 2020-01-03 10:33:15 --> Severity: Notice --> Undefined index: memo /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_coa_general_ledger.php 160
ERROR - 2020-01-03 03:48:22 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-03 03:48:22 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-01-03 03:48:22 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-03 03:48:22 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-03 03:48:23 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-03 03:51:52 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-03 03:51:52 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-03 03:51:52 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-01-03 03:51:52 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-03 03:51:52 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-03 08:38:47 --> 404 Page Not Found: Assets/invoice
ERROR - 2020-01-03 08:38:47 --> 404 Page Not Found: Assets/invoice
ERROR - 2020-01-03 15:38:58 --> Query error: Unknown column 'deskripsi' in 'field list' - Invalid query: SELECT 
		  SUM(saldo_m - saldo_k) AS saldo 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '9'
			AND tanggal < '2020-01-03'
			AND branch = '8'
			) AS kasnya 
		ORDER BY tanggal ASC 
