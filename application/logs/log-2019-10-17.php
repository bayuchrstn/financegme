<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-10-17 09:52:36 --> Severity: Error --> Allowed memory size of 134217728 bytes exhausted (tried to allocate 8192 bytes) /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_result.php 183
ERROR - 2019-10-17 11:06:34 --> Query error: Unknown column 'k.phone' in 'field list' - Invalid query: SELECT
		a.`id` AS arpost,
		a.`flag`,
		a.`tanggal_invoice`,
		a.`periode_dari`,
		a.`periode_sampai`,
		b.`id`,
		b.`id_order`,
		b.`id_cust`,
		b.`id_order_service`,
		i.`nama` AS nama_cust,
		i.`idcust`,
		j.`nama` AS nama_site,
		CASE
		WHEN a.`id_address`=1
		THEN j.`alamat`
		WHEN a.`id_address`=2
		THEN j.`alamat2`
		WHEN a.`id_address`=3
		THEN j.`alamat3`
		ELSE j.`alamat`
		END AS `alamat`,
		CASE
		WHEN a.`id_address`=1
		THEN j.`kota`
		WHEN a.`id_address`=2
		THEN j.`kota2`
		WHEN a.`id_address`=3
		THEN j.`kota3`
		ELSE j.`kota`
		END AS `kota`,
		IF(a.`id_contact` = 0, j.`phonewakil`,k.`phone`) AS phone,
		IF(a.`id_contact` = 0, j.`wakil`,k.`nama`) AS attention,
		IF(a.`id_contact` = 0, j.`emailwakil`,k.`email`) AS email,
		j.`taxno`,
		b.`nomor`,
		b.`tanggal`,
		b.`nominal`,
		b.`jenis_transaksi`,
		b.`keterangan`,
		CASE
		  WHEN b.`jenis_transaksi` = 'PN'
		  THEN 'Biaya PPN'
		  WHEN b.`jenis_transaksi` = 'MT'
		  OR b.`jenis_transaksi` = 'MB'
		  THEN 'Biaya Materai'
		  WHEN b.`jenis_transaksi` = 'BI'
		  THEN 'Biaya Instalasi'
		  WHEN b.`jenis_transaksi` = 'LG'
		  THEN e.`label`
		  WHEN b.`jenis_transaksi` = 'LL'
		  THEN d.`layanan`
		  WHEN b.`jenis_transaksi` = 'BR'
		  THEN h.`nama_barang`
		  WHEN b.`jenis_transaksi` = 'BJ'
		  THEN g.`service`
		  WHEN b.`jenis_transaksi` = 'PB'
		  THEN 'Pembayaran'
		END AS detail,
		b.`status`,
		b.`timestamp`
	  FROM
		erp_gmedia.`arpost` a
		LEFT JOIN erp_gmedia.`transaksi` b
		  ON a.`nomor` = b.`nomor`
		  AND a.`id_order` = b.`id_order`
		LEFT JOIN erp_gmedia.`order_service` c
		  ON b.`id_order_service` = c.`id`
		LEFT JOIN erp_gmedia.`order_lain` d
		  ON b.`id_order` = d.`id_order`
		LEFT JOIN erp_gmedia.`ms_layanan` e
		  ON c.`id_serv` = e.`id`
		LEFT JOIN erp_gmedia.`order_barang` f
		  ON b.`id_order` = f.`id_order`
		LEFT JOIN erp_gmedia.`order_jasa` g
		  ON g.`id_order` = b.`id_order`
		LEFT JOIN inventory_v2.`ms_header_barang` h
		  ON f.`id_barang` = h.`id_header`
		LEFT JOIN erp_gmedia.`ms_customers` i
		ON a.`id_cust`=i.`id`
		LEFT JOIN erp_gmedia.`ms_site` j
		ON a.`id_site`=j.`id`
	  WHERE a.`status` = 1
		AND b.`status` = 1
		AND a.`merge` IS NULL
		AND a.`id` = 16200
	  GROUP BY b.`id`
ERROR - 2019-10-17 04:06:41 --> 404 Page Not Found: Assets/js
ERROR - 2019-10-17 11:06:58 --> Query error: Unknown column 'k.phone' in 'field list' - Invalid query: SELECT
		a.`id` AS arpost,
		a.`flag`,
		a.`tanggal_invoice`,
		a.`periode_dari`,
		a.`periode_sampai`,
		b.`id`,
		b.`id_order`,
		b.`id_cust`,
		b.`id_order_service`,
		i.`nama` AS nama_cust,
		i.`idcust`,
		j.`nama` AS nama_site,
		CASE
		WHEN a.`id_address`=1
		THEN j.`alamat`
		WHEN a.`id_address`=2
		THEN j.`alamat2`
		WHEN a.`id_address`=3
		THEN j.`alamat3`
		ELSE j.`alamat`
		END AS `alamat`,
		CASE
		WHEN a.`id_address`=1
		THEN j.`kota`
		WHEN a.`id_address`=2
		THEN j.`kota2`
		WHEN a.`id_address`=3
		THEN j.`kota3`
		ELSE j.`kota`
		END AS `kota`,
		IF(a.`id_contact` = 0, j.`phonewakil`,k.`phone`) AS phone,
		IF(a.`id_contact` = 0, j.`wakil`,k.`nama`) AS attention,
		IF(a.`id_contact` = 0, j.`emailwakil`,k.`email`) AS email,
		j.`taxno`,
		b.`nomor`,
		b.`tanggal`,
		b.`nominal`,
		b.`jenis_transaksi`,
		b.`keterangan`,
		CASE
		  WHEN b.`jenis_transaksi` = 'PN'
		  THEN 'Biaya PPN'
		  WHEN b.`jenis_transaksi` = 'MT'
		  OR b.`jenis_transaksi` = 'MB'
		  THEN 'Biaya Materai'
		  WHEN b.`jenis_transaksi` = 'BI'
		  THEN 'Biaya Instalasi'
		  WHEN b.`jenis_transaksi` = 'LG'
		  THEN e.`label`
		  WHEN b.`jenis_transaksi` = 'LL'
		  THEN d.`layanan`
		  WHEN b.`jenis_transaksi` = 'BR'
		  THEN h.`nama_barang`
		  WHEN b.`jenis_transaksi` = 'BJ'
		  THEN g.`service`
		  WHEN b.`jenis_transaksi` = 'PB'
		  THEN 'Pembayaran'
		END AS detail,
		b.`status`,
		b.`timestamp`
	  FROM
		erp_gmedia.`arpost` a
		LEFT JOIN erp_gmedia.`transaksi` b
		  ON a.`nomor` = b.`nomor`
		  AND a.`id_order` = b.`id_order`
		LEFT JOIN erp_gmedia.`order_service` c
		  ON b.`id_order_service` = c.`id`
		LEFT JOIN erp_gmedia.`order_lain` d
		  ON b.`id_order` = d.`id_order`
		LEFT JOIN erp_gmedia.`ms_layanan` e
		  ON c.`id_serv` = e.`id`
		LEFT JOIN erp_gmedia.`order_barang` f
		  ON b.`id_order` = f.`id_order`
		LEFT JOIN erp_gmedia.`order_jasa` g
		  ON g.`id_order` = b.`id_order`
		LEFT JOIN inventory_v2.`ms_header_barang` h
		  ON f.`id_barang` = h.`id_header`
		LEFT JOIN erp_gmedia.`ms_customers` i
		ON a.`id_cust`=i.`id`
		LEFT JOIN erp_gmedia.`ms_site` j
		ON a.`id_site`=j.`id`
	  WHERE a.`status` = 1
		AND b.`status` = 1
		AND a.`merge` IS NULL
		AND a.`id` = 16201
	  GROUP BY b.`id`
ERROR - 2019-10-17 11:16:43 --> Severity: error --> Exception: Call to undefined method Model_finance_invoice_customer::update_contact() /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 137
ERROR - 2019-10-17 04:22:37 --> 404 Page Not Found: Assets/js
ERROR - 2019-10-17 11:57:06 --> Query error: Unknown column 'j.kota2' in 'field list' - Invalid query: SELECT
		'' AS armerge,
		  a.`id` AS arpost,
		  a.`flag`,
		  b.`id`,
		  b.`id_order`,
		  b.`id_cust`,
		  b.`id_order_service`,
		  b.`nomor`,
		  b.`tanggal`,
		  b.`nominal`,
		  b.`jenis_transaksi`,
		  c.`servid`,
		  CASE
			WHEN b.`jenis_transaksi` = 'PN'
			THEN 'Biaya PPN'
			WHEN b.`jenis_transaksi` = 'MT' OR b.`jenis_transaksi` = 'MB'
			THEN 'Biaya Materai'
			WHEN b.`jenis_transaksi` = 'BI'
			THEN 'Biaya Instalasi'
			WHEN b.`jenis_transaksi` = 'LG'
			THEN e.`label`
			WHEN b.`jenis_transaksi` = 'LL'
			THEN d.`layanan`
			WHEN b.`jenis_transaksi` = 'BR'
			THEN h.`nama_barang`
			WHEN b.`jenis_transaksi` = 'BJ'
			THEN g.`service`
			WHEN b.`jenis_transaksi` = 'PB'
			THEN 'Pembayaran'
		  END AS detail,
		  b.`status`,
		  b.`timestamp`,
		CASE
		WHEN a.`id_address`=1
		THEN j.`kota`
		WHEN a.`id_address`=2
		THEN j.`kota2`
		WHEN a.`id_address`=3
		THEN j.`kota3`
		ELSE j.`kota`
		END AS `kota`,
		IF(a.`id_contact` = 0, j.`wakil`,k.`nama`) AS attention,
		IF(a.`id_contact` = 0, j.`phonewakil`,k.`phone`) AS phone,
		IF(a.`id_contact` = 0, j.`emailwakil`,k.`email`) AS email,
		CASE
		WHEN a.`id_address`=1
		THEN j.`alamat`
		WHEN a.`id_address`=2
		THEN j.`alamat2`
		WHEN a.`id_address`=3
		THEN j.`alamat3`
		ELSE j.`alamat`
		END AS `alamat`,
		 j.`nama` AS nama_cust,
		 j.`idcust` AS cust_id,a.`tanggal_invoice`,a.`due_date`,a.`periode_dari`,a.`periode_sampai` 
		FROM
		  arpost a
		  LEFT JOIN transaksi b
			ON a.`nomor` = b.`nomor`
			AND a.`id_order` = b.`id_order`
		  LEFT JOIN order_service c
			ON b.`id_order_service` = c.`id`
		  LEFT JOIN order_lain d
			ON b.`id_order` = d.`id_order`
		  LEFT JOIN ms_layanan e
			ON c.`id_serv` = e.`id`
		  LEFT JOIN order_barang f
		  ON b.`id_order`=f.`id_order`
		  LEFT JOIN order_jasa g
		  ON g.`id_order`=b.`id_order`
		  LEFT JOIN inventory_v2.`ms_header_barang` h
		  ON f.`id_barang`=h.`id_header`
		  LEFT JOIN ms_site i
		  ON a.`id_site`=i.`id`
		  LEFT JOIN ms_customers j
		  ON a.`id_cust`=j.`id`
		WHERE a.`status` = 1
		  AND b.`status` = 1
		  AND a.`merge` IS NULL
		  AND a.`id` = 17930
		GROUP BY b.`id` ORDER BY b.`jenis_transaksi`,c.`servid`
ERROR - 2019-10-17 12:00:52 --> Query error: Unknown column 'j.kota2' in 'field list' - Invalid query: SELECT
		'' AS armerge,
		  a.`id` AS arpost,
		  a.`flag`,
		  b.`id`,
		  b.`id_order`,
		  b.`id_cust`,
		  b.`id_order_service`,
		  b.`nomor`,
		  b.`tanggal`,
		  b.`nominal`,
		  b.`jenis_transaksi`,
		  c.`servid`,
		  CASE
			WHEN b.`jenis_transaksi` = 'PN'
			THEN 'Biaya PPN'
			WHEN b.`jenis_transaksi` = 'MT' OR b.`jenis_transaksi` = 'MB'
			THEN 'Biaya Materai'
			WHEN b.`jenis_transaksi` = 'BI'
			THEN 'Biaya Instalasi'
			WHEN b.`jenis_transaksi` = 'LG'
			THEN e.`label`
			WHEN b.`jenis_transaksi` = 'LL'
			THEN d.`layanan`
			WHEN b.`jenis_transaksi` = 'BR'
			THEN h.`nama_barang`
			WHEN b.`jenis_transaksi` = 'BJ'
			THEN g.`service`
			WHEN b.`jenis_transaksi` = 'PB'
			THEN 'Pembayaran'
		  END AS detail,
		  b.`status`,
		  b.`timestamp`,
		CASE
		WHEN a.`id_address`=1
		THEN j.`kota`
		WHEN a.`id_address`=2
		THEN j.`kota2`
		WHEN a.`id_address`=3
		THEN j.`kota3`
		ELSE j.`kota`
		END AS `kota`,
		IF(a.`id_contact` = 0, j.`wakil`,k.`nama`) AS attention,
		IF(a.`id_contact` = 0, j.`phonewakil`,k.`phone`) AS phone,
		IF(a.`id_contact` = 0, j.`emailwakil`,k.`email`) AS email,
		CASE
		WHEN a.`id_address`=1
		THEN j.`alamat`
		WHEN a.`id_address`=2
		THEN j.`alamat2`
		WHEN a.`id_address`=3
		THEN j.`alamat3`
		ELSE j.`alamat`
		END AS `alamat`,
		 j.`nama` AS nama_cust,
		 j.`idcust` AS cust_id,a.`tanggal_invoice`,a.`due_date`,a.`periode_dari`,a.`periode_sampai` 
		FROM
		  arpost a
		  LEFT JOIN transaksi b
			ON a.`nomor` = b.`nomor`
			AND a.`id_order` = b.`id_order`
		  LEFT JOIN order_service c
			ON b.`id_order_service` = c.`id`
		  LEFT JOIN order_lain d
			ON b.`id_order` = d.`id_order`
		  LEFT JOIN ms_layanan e
			ON c.`id_serv` = e.`id`
		  LEFT JOIN order_barang f
		  ON b.`id_order`=f.`id_order`
		  LEFT JOIN order_jasa g
		  ON g.`id_order`=b.`id_order`
		  LEFT JOIN inventory_v2.`ms_header_barang` h
		  ON f.`id_barang`=h.`id_header`
		  LEFT JOIN ms_site i
		  ON a.`id_site`=i.`id`
		  LEFT JOIN ms_customers j
		  ON a.`id_cust`=j.`id`
		  LEFT JOIN ms_contact k
		  ON a.`id_contact`=k.`id`
		WHERE a.`status` = 1
		  AND b.`status` = 1
		  AND a.`merge` IS NULL
		  AND a.`id` = 17930
		GROUP BY b.`id` ORDER BY b.`jenis_transaksi`,c.`servid`
ERROR - 2019-10-17 06:46:22 --> 404 Page Not Found: Assets/js
ERROR - 2019-10-17 23:33:13 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2019-10-17 23:33:13 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
