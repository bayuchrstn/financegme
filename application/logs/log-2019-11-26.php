<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-11-26 14:17:59 --> Severity: error --> Exception: Too few arguments to function finance_invoice_customer::approve_invoice(), 0 passed in /data/www/html/erpsmg/finance_gmedia/system/core/CodeIgniter.php on line 532 and exactly 1 expected /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 2032
ERROR - 2019-11-26 07:18:37 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-11-26 07:18:37 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-11-26 07:18:37 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-11-26 07:18:37 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-11-26 07:18:37 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-11-26 14:19:08 --> Severity: error --> Exception: Too few arguments to function finance_invoice_customer::approve_invoice(), 0 passed in /data/www/html/erpsmg/finance_gmedia/system/core/CodeIgniter.php on line 532 and exactly 1 expected /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 2032
ERROR - 2019-11-26 14:19:49 --> Severity: error --> Exception: Too few arguments to function finance_invoice_customer::approve_invoice(), 0 passed in /data/www/html/erpsmg/finance_gmedia/system/core/CodeIgniter.php on line 532 and exactly 1 expected /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 2032
ERROR - 2019-11-26 07:20:00 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-11-26 07:20:00 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-11-26 07:20:00 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-11-26 07:20:00 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-11-26 07:20:00 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-11-26 14:20:33 --> Severity: error --> Exception: Too few arguments to function finance_invoice_customer::approve_invoice(), 0 passed in /data/www/html/erpsmg/finance_gmedia/system/core/CodeIgniter.php on line 532 and exactly 1 expected /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 2032
ERROR - 2019-11-26 14:20:46 --> Severity: error --> Exception: Too few arguments to function finance_invoice_customer::approve_invoice(), 0 passed in /data/www/html/erpsmg/finance_gmedia/system/core/CodeIgniter.php on line 532 and exactly 1 expected /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 2032
ERROR - 2019-11-26 14:38:37 --> Query error: Unknown column 'a.nomor' in 'where clause' - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.*, DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya, DATE_FORMAT(a.date_due, '%d-%m-%Y') AS date_duenya, if(a.supplier = 0, 'LAIN2', b.nama) as nama_sup
FROM `gmd_finance_ap_invoice` `a`
LEFT JOIN `gmd_finance_supplier` `b` ON `a`.`supplier` = `b`.`id`
WHERE   (
`a`.`no_referensi` LIKE '%%' ESCAPE '!'
OR  `a`.`nomor` LIKE '%%' ESCAPE '!'
OR  `b`.`nama` LIKE '%%' ESCAPE '!'
 )
AND (a.tanggal between '2019-11-01' and '2019-11-30')
AND `a`.`branch` = '8'
ORDER BY `a`.`tanggal` DESC
 LIMIT 100
