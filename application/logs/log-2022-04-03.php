<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-04-03 11:41:32 --> Severity: Notice --> Undefined index: level C:\xampp\htdocs\finance_gmedia7\application\helpers\gitcms_helper.php 679
ERROR - 2022-04-03 11:41:32 --> Severity: Notice --> Undefined index: level C:\xampp\htdocs\finance_gmedia7\application\helpers\gitcms_helper.php 679
ERROR - 2022-04-03 11:41:39 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2022-04-30'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2022-04-30'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2022-04-30')
