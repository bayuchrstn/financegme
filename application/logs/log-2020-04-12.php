<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-04-12 09:22:29 --> Severity: Notice --> Undefined index: level C:\xampp\htdocs\finance_gmedia\application\helpers\gitcms_helper.php 679
ERROR - 2020-04-12 09:22:29 --> Severity: Notice --> Undefined index: level C:\xampp\htdocs\finance_gmedia\application\helpers\gitcms_helper.php 679
ERROR - 2020-04-12 09:22:33 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-30'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-04-30'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-04-30')
ERROR - 2020-04-12 04:48:24 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\xampp\htdocs\finance_gmedia\system\database\drivers\mysqli\mysqli_driver.php 201
ERROR - 2020-04-12 04:48:24 --> Unable to connect to the database
