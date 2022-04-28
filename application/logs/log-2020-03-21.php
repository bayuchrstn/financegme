<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-03-21 09:17:58 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-21 09:17:58 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-03-21 09:18:00 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-03-31'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-03-31'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-03-31')
