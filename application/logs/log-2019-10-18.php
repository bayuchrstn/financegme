<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-10-18 01:49:21 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-10-18 01:49:21 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-10-18 01:49:21 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-10-18 01:49:21 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-10-18 01:49:21 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-10-18 10:16:21 --> Severity: Error --> Allowed memory size of 268435456 bytes exhausted (tried to allocate 12288 bytes) /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_result.php 183
ERROR - 2019-10-18 03:16:27 --> 404 Page Not Found: Assets/js
ERROR - 2019-10-18 10:16:45 --> Severity: Error --> Allowed memory size of 268435456 bytes exhausted (tried to allocate 12288 bytes) /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_result.php 183
ERROR - 2019-10-18 03:27:02 --> 404 Page Not Found: Assets/js
ERROR - 2019-10-18 03:38:20 --> 404 Page Not Found: Assets/js
ERROR - 2019-10-18 03:44:20 --> 404 Page Not Found: Assets/js
ERROR - 2019-10-18 03:47:32 --> 404 Page Not Found: Assets/js
ERROR - 2019-10-18 14:45:43 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2019-10-18 14:59:02 --> Severity: Notice --> Undefined variable: label /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 231
ERROR - 2019-10-18 14:59:10 --> Severity: Notice --> Undefined variable: label /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 231
ERROR - 2019-10-18 14:59:13 --> Severity: Notice --> Undefined variable: label /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 231
ERROR - 2019-10-18 15:03:14 --> Severity: Notice --> Undefined property: stdClass::$nama_site /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 217
ERROR - 2019-10-18 15:03:15 --> Severity: Notice --> Undefined property: stdClass::$nama_site /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 217
ERROR - 2019-10-18 15:03:18 --> Severity: Notice --> Undefined property: stdClass::$nama_site /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 217
ERROR - 2019-10-18 15:16:31 --> Query error: Unknown column 'kas_bank' in 'where clause' - Invalid query: SELECT 
		  SQL_CALC_FOUND_ROWS *, date_format(tanggal, '%d-%m-%Y') as tanggalnya 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '9'
			AND branch = '8'
			AND (
			  tanggal BETWEEN '2019-10-01' AND '2019-10-31'
			)
		) AS kasnya 
		ORDER BY tanggal ASC, saldo_m DESC, saldo_k ASC 
ERROR - 2019-10-18 15:19:41 --> Severity: Notice --> Undefined property: stdClass::$nama_site /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 217
ERROR - 2019-10-18 15:27:29 --> Query error: Unknown column 'kas_bank' in 'where clause' - Invalid query: SELECT 
		  SUM(saldo_m - saldo_k) AS saldo 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '9'
			AND tanggal < '2019-10-18'
			AND branch = '8'
			) AS kasnya 
		ORDER BY tanggal ASC 
ERROR - 2019-10-18 08:39:04 --> 404 Page Not Found: Assets/js
ERROR - 2019-10-18 08:39:04 --> 404 Page Not Found: Assets/js
ERROR - 2019-10-18 08:39:04 --> 404 Page Not Found: Assets/js
ERROR - 2019-10-18 08:39:05 --> 404 Page Not Found: Assets/js
ERROR - 2019-10-18 08:39:05 --> 404 Page Not Found: Assets/js
ERROR - 2019-10-18 09:06:53 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-10-18 09:06:53 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-10-18 09:06:53 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-10-18 09:06:53 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-10-18 09:06:53 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-10-18 16:06:58 --> Query error: Unknown column 'i.nama' in 'field list' - Invalid query: SELECT
		a.`id_arpost_merge` AS armerge,
		a.`id` AS arpost,
		a.`flag`,
		c.`id`,
		c.`id_order`,
		c.`id_cust`,
		c.`id_order_service`,
		c.`nomor`,
		c.`tanggal`,
		c.`nominal`,
		c.`jenis_transaksi`,
		d.`servid`,
		CASE
		  WHEN c.`jenis_transaksi` = 'PN'
		  THEN 'Biaya PPN'
		  WHEN c.`jenis_transaksi` = 'MT' OR c.`jenis_transaksi` = 'MB'
		  THEN 'Biaya Materai'
		  WHEN c.`jenis_transaksi` = 'BI'
		  THEN 'Biaya Instalasi'
		  WHEN c.`jenis_transaksi` = 'LG'
		  THEN f.`label`
		  WHEN c.`jenis_transaksi` = 'LL'
		  THEN e.`layanan`
		  WHEN c.`jenis_transaksi` = 'BR'
		  THEN j.`nama_barang`
		  WHEN c.`jenis_transaksi` = 'BJ'
		  THEN h.`service`
		  WHEN c.`jenis_transaksi` = 'PB'
		  THEN 'Pembayaran'
		END AS detail,
		c.`status`,
		c.`timestamp`,
		a.`to_site`,
		i.`attention_display`,
		CASE 
		WHEN i.`attention_display`=0
		THEN k.`wakil`
		WHEN i.`attention_display`>0
		THEN j.`nama`
		END AS attention,
		 CASE 
		WHEN i.`attention_display`=0
		THEN k.`phonewakil`
		WHEN i.`attention_display`>0
		THEN j.`phone`
		END AS phone,
		 CASE 
		WHEN i.`attention_display`=0
		THEN k.`emailwakil`
		WHEN i.`attention_display`>0
		THEN j.`email`
		END AS email,
		CASE
		WHEN k.`alamat` = ''
		THEN k.`alamat2`
		WHEN k.`alamat` = '' AND k.`alamat2` = ''
		THEN k.`alamat3`
		ELSE k.`alamat`
		END AS `alamat`,
		l.`nama` AS nama_cust,
		i.`nama` AS nama_site,
		l.`idcust` AS cust_id,a.`tanggal_invoice`,a.`due_date`,a.`periode_dari`,a.`periode_sampai` 
		FROM (SELECT b.`id_arpost_merge`,a.`id`,a.`id_order`,a.`nomor`,a.`status`,b.`status` AS merge_status,a.`flag`,
		a.`to_site`,a.`tanggal_invoice`,a.`due_date`,a.`periode_dari`,a.`periode_sampai` 
		FROM arpost a 
		JOIN arpost_merge b ON a.`id`=b.`id_arpost` WHERE b.`status`=1 AND a.`status`=1) a 
		LEFT JOIN transaksi c
		ON a.`id_order`=c.`id_order` AND a.`nomor`=c.`nomor`
		LEFT JOIN order_service d
		  ON c.`id_order_service` = d.`id`
		LEFT JOIN order_lain e
		  ON c.`id_order` = e.`id_order`
		LEFT JOIN ms_layanan f
		  ON d.`id_serv` = f.`id`
		LEFT JOIN order_barang g
		ON c.`id_order`=g.`id_order`
		LEFT JOIN order_jasa h
		ON h.`id_order`=c.`id_order`
		LEFT JOIN inventory_v2.`ms_header_barang` j
		ON g.`id_barang`=j.`id_header`
		LEFT JOIN order_header i
		ON i.`id_site`=a.`to_site`
		LEFT JOIN ms_contact j
		ON i.`attention_display` = j.`id`
		LEFT JOIN ms_site k
		ON k.`id`=a.`to_site`
		LEFT JOIN ms_customers l
		ON c.`id_cust`=l.`id`
		WHERE a.`status`=1 AND c.`status`=1 AND a.`merge_status`= 1 AND a.`id_arpost_merge`=17026
		GROUP BY c.`id` ORDER BY c.`jenis_transaksi`,d.`servid`
ERROR - 2019-10-18 09:47:36 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-10-18 09:47:36 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-10-18 09:47:36 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-10-18 09:47:36 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-10-18 09:47:36 --> 404 Page Not Found: Select_data_income_expenses/2019
