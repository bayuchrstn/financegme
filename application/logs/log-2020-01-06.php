<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-01-06 08:43:19 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 459
ERROR - 2020-01-06 08:50:25 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 459
ERROR - 2020-01-06 03:22:23 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-06 03:22:23 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-06 03:22:23 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-01-06 03:22:23 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-06 03:22:23 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-06 03:29:24 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-06 03:29:24 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-01-06 03:29:24 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-06 03:29:24 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-06 03:29:24 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-06 10:29:50 --> Query error: Unknown column 'deskripsi' in 'field list' - Invalid query: SELECT 
		  SUM(saldo_m - saldo_k) AS saldo 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '9'
			AND tanggal < '2019-12-18'
			AND branch = '8'
			) AS kasnya 
		ORDER BY tanggal ASC 
