<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-04-04 03:21:29 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\xampp\htdocs\finance_gmedia7\system\database\drivers\mysqli\mysqli_driver.php 201
ERROR - 2022-04-04 03:21:29 --> Unable to connect to the database
ERROR - 2022-04-04 03:21:50 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\xampp\htdocs\finance_gmedia7\system\database\drivers\mysqli\mysqli_driver.php 201
ERROR - 2022-04-04 03:21:50 --> Unable to connect to the database
ERROR - 2022-04-04 03:23:06 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\xampp\htdocs\finance_gmedia7\system\database\drivers\mysqli\mysqli_driver.php 201
ERROR - 2022-04-04 03:23:06 --> Unable to connect to the database
ERROR - 2022-04-04 08:23:42 --> Severity: Notice --> Undefined index: level C:\xampp\htdocs\finance_gmedia7\application\helpers\gitcms_helper.php 679
ERROR - 2022-04-04 08:23:42 --> Severity: Notice --> Undefined index: level C:\xampp\htdocs\finance_gmedia7\application\helpers\gitcms_helper.php 679
ERROR - 2022-04-04 08:23:46 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2022-04-30'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2022-04-30'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2022-04-30')
ERROR - 2022-04-04 03:41:48 --> Severity: Warning --> mysqli::real_connect(): (HY000/1049): Unknown database 'erp_financev2' C:\xampp\htdocs\finance_gmedia7\system\database\drivers\mysqli\mysqli_driver.php 201
ERROR - 2022-04-04 03:41:48 --> Unable to connect to the database
ERROR - 2022-04-04 03:42:08 --> Query error: Table 'erp_financev2.gmd_sessions' doesn't exist - Invalid query: SELECT `data`
FROM `gmd_sessions`
WHERE `id` = 's86vd5drg3va5snnkbqoamnsibg61dpn'
ERROR - 2022-04-04 03:42:08 --> Severity: Warning --> session_write_close(): Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2022-04-04 03:42:08 --> Severity: Warning --> session_write_close(): Failed to write session data using user defined save handler. (session.save_path: \xampp\tmp) Unknown 0
ERROR - 2022-04-04 08:44:16 --> Query error: Table 'absensi.ms_user' doesn't exist - Invalid query: SELECT * FROM absensi.`ms_user` WHERE id=''
ERROR - 2022-04-04 08:44:17 --> Query error: Table 'absensi.ms_user' doesn't exist - Invalid query: SELECT * FROM absensi.`ms_user` WHERE id=''
ERROR - 2022-04-04 08:44:41 --> Severity: Notice --> Undefined index: level C:\xampp\htdocs\finance_gmedia7\application\helpers\gitcms_helper.php 679
ERROR - 2022-04-04 08:44:41 --> Severity: Notice --> Undefined index: level C:\xampp\htdocs\finance_gmedia7\application\helpers\gitcms_helper.php 679
ERROR - 2022-04-04 08:44:42 --> Query error: Table 'erp_gmedia.billing' doesn't exist - Invalid query: SELECT 
			COALESCE(SUM(a.`jml_bayar`),0) AS jumlah 
		  FROM
			erp_gmedia.`billing` a 
		  WHERE a.`tanggal` <= '2022-01-30'
ERROR - 2022-04-04 08:44:42 --> Query error: Table 'erp_gmedia.billing' doesn't exist - Invalid query: SELECT
			 COALESCE(SUM(a.`jml_bayar`),0) AS jumlah
			FROM
			  erp_gmedia.`billing` a
			WHERE (
				a.`tanggal` BETWEEN '2022-04-01'
				AND '2022-04-30'
			  )
ERROR - 2022-04-04 08:44:42 --> Query error: Table 'erp_gmedia.billing' doesn't exist - Invalid query: SELECT
			 COALESCE(SUM(a.`jml_bayar`),0) AS jumlah
			FROM
			  erp_gmedia.`billing` a
			WHERE (
				a.`tanggal` BETWEEN '2022-01-01'
				AND '2022-01-30'
			  )
ERROR - 2022-04-04 08:44:42 --> Query error: Table 'erp_gmedia.billing' doesn't exist - Invalid query: SELECT 
			COALESCE(SUM(a.`jml_bayar`),0) AS jumlah 
		  FROM
			erp_gmedia.`billing` a 
		  WHERE a.`tanggal` <= '2022-01-30'
ERROR - 2022-04-04 08:44:42 --> Query error: Table 'erp_gmedia.billing' doesn't exist - Invalid query: SELECT
			 COALESCE(SUM(a.`jml_bayar`),0) AS jumlah
			FROM
			  erp_gmedia.`billing` a
			WHERE (
				a.`tanggal` BETWEEN '2022-01-01'
				AND '2022-01-30'
			  )
