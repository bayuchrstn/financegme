<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-02-18 08:25:37 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-18 08:25:37 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-18 08:44:46 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-18 08:44:46 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-18 08:45:03 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ELECT h.`tanggal` AS tanggal,h.id_perusahaan,0 AS id_penerimaan, d.id_header AS ' at line 1 - Invalid query: ELECT h.`tanggal` AS tanggal,h.id_perusahaan,0 AS id_penerimaan, d.id_header AS id_pembelian, NULL AS nomor,h.`nomor` AS nomor_po,d.id_barang, b.nama_barang, 
			SUM(d.qty) AS jumlah, IFNULL(t.jumlah_terima,0) AS jumlah_terima, u.nama_ukuran AS satuan, d.keterangan,d.`harga`,(SUM(d.`qty`)-COALESCE(t.jumlah_terima,0))*d.`harga` AS total,COALESCE(h.diskon-COALESCE(t.diskon,0),0) AS diskon,COALESCE(h.ongkir-COALESCE(t.ongkir,0),0) AS ongkir
			FROM inventory_v2.tr_d_pembelian d 
			JOIN inventory_v2.tr_h_pembelian h ON d.id_header=h.id_header
			JOIN inventory_v2.ms_header_barang b ON d.id_barang=b.id_header
			JOIN inventory_v2.ms_ukuran u ON d.id_ukuran=u.id_ukuran
			LEFT JOIN (
				SELECT d.id_pembelian, d.id_barang, SUM(d.jumlah) AS jumlah_terima,satuan,jumlah_harga,h.diskon,h.ongkir
					FROM erp_financev2.gmd_finance_ap_invoice_detail d 
					JOIN erp_financev2.gmd_finance_ap_invoice h ON d.id_ap=h.id
					WHERE d.id_penerimaan IS NULL
					GROUP BY d.id_barang, d.id_pembelian
			) t ON d.id_header=t.id_pembelian AND d.id_barang=t.id_barang
			WHERE b.flag='J' AND d.`status`=1 AND h.id_perusahaan = 50  AND d.id_header =3247
			AND (d.qty - IFNULL(t.jumlah_terima,0)) > 0
			GROUP BY d.id_barang,d.id_header,h.`id_perusahaan`
		UNION ALL
		SELECT * FROM (
			SELECT h.`tanggal` AS tanggal,hp.id_perusahaan, d.id_header AS id_penerimaan,hp.`id_header` AS id_pembelian, h.`nomor`,hp.`nomor` AS nomor_po,d.id_barang, b.nama_barang, SUM(d.qty) AS jumlah, IFNULL(t.jumlah_terima,0) AS jumlah_terima, 
				u.nama_ukuran AS satuan, d.keterangan,d.`harga`,(SUM(d.`qty`)-COALESCE(t.jumlah_terima,0))*d.`harga` AS total,COALESCE(hp.diskon-COALESCE(t.diskon,0),0) AS diskon,COALESCE(hp.ongkir-COALESCE(t.ongkir,0),0) AS ongkir
				FROM inventory_v2.tr_d_penerimaan d 
				JOIN inventory_v2.tr_h_penerimaan h ON d.id_header=h.id_header
				JOIN inventory_v2.ms_header_barang b ON d.id_barang=b.id_header
				JOIN inventory_v2.ms_ukuran u ON d.id_ukuran=u.id_ukuran
				JOIN inventory_v2.tr_h_pembelian hp ON h.id_pembelian=hp.id_header
				LEFT JOIN (
					SELECT d.id_penerimaan, d.id_barang, SUM(d.jumlah) AS jumlah_terima,satuan,jumlah_harga,h.diskon,h.ongkir
						FROM erp_financev2.gmd_finance_ap_invoice_detail d 
						JOIN erp_financev2.gmd_finance_ap_invoice h ON d.id_ap=h.id
						GROUP BY d.id_barang, d.id_penerimaan
				) t ON d.id_header=t.id_penerimaan AND d.id_barang=t.id_barang
				WHERE hp.id_perusahaan = 50  AND hp.id_header =3247
				GROUP BY d.id_barang,d.id_header,hp.`id_perusahaan`
		) terima_barang
		WHERE (jumlah - jumlah_terima) > 0
		
		ORDER BY tanggal DESC
ERROR - 2020-02-18 02:07:25 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-18 02:07:25 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-18 02:07:25 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-18 02:07:25 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-18 02:07:25 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-18 11:00:19 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-18 11:00:19 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-18 11:11:39 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ELECT h.`tanggal` AS tanggal,h.id_perusahaan,0 AS id_penerimaan, d.id_header AS ' at line 1 - Invalid query: ELECT h.`tanggal` AS tanggal,h.id_perusahaan,0 AS id_penerimaan, d.id_header AS id_pembelian, NULL AS nomor,h.`nomor` AS nomor_po,d.id_barang, b.nama_barang, 
			SUM(d.qty) AS jumlah, IFNULL(t.jumlah_terima,0) AS jumlah_terima, u.nama_ukuran AS satuan, d.keterangan,d.`harga`,(SUM(d.`qty`)-COALESCE(t.jumlah_terima,0))*d.`harga` AS total,COALESCE(h.diskon-COALESCE(t.diskon,0),0) AS diskon,COALESCE(h.ongkir-COALESCE(t.ongkir,0),0) AS ongkir
			FROM inventory_v2.tr_d_pembelian d 
			JOIN inventory_v2.tr_h_pembelian h ON d.id_header=h.id_header
			JOIN inventory_v2.ms_header_barang b ON d.id_barang=b.id_header
			JOIN inventory_v2.ms_ukuran u ON d.id_ukuran=u.id_ukuran
			LEFT JOIN (
				SELECT d.id_pembelian, d.id_barang, SUM(d.jumlah) AS jumlah_terima,satuan,jumlah_harga,h.diskon,h.ongkir
					FROM erp_financev2.gmd_finance_ap_invoice_detail d 
					JOIN erp_financev2.gmd_finance_ap_invoice h ON d.id_ap=h.id
					WHERE d.id_penerimaan=0 AND d.status=1
					GROUP BY d.id_barang, d.id_pembelian
			) t ON d.id_header=t.id_pembelian AND d.id_barang=t.id_barang
			WHERE b.flag='J' AND d.`status`=1 AND h.id_perusahaan = 50  AND d.id_header =1195
			AND (d.qty - IFNULL(t.jumlah_terima,0)) > 0
			GROUP BY d.id_barang,d.id_header
		UNION ALL
		SELECT * FROM (
			SELECT h.`tanggal` AS tanggal,hp.id_perusahaan, d.id_header AS id_penerimaan,hp.`id_header` AS id_pembelian, h.`nomor`,hp.`nomor` AS nomor_po,d.id_barang, b.nama_barang, SUM(d.qty) AS jumlah, IFNULL(t.jumlah_terima,0) AS jumlah_terima, 
				u.nama_ukuran AS satuan, d.keterangan,d.`harga`,(SUM(d.`qty`)-COALESCE(t.jumlah_terima,0))*d.`harga` AS total,COALESCE(hp.diskon-COALESCE(t.diskon,0),0) AS diskon,COALESCE(hp.ongkir-COALESCE(t.ongkir,0),0) AS ongkir
				FROM inventory_v2.tr_d_penerimaan d 
				JOIN inventory_v2.tr_h_penerimaan h ON d.id_header=h.id_header
				JOIN inventory_v2.ms_header_barang b ON d.id_barang=b.id_header
				JOIN inventory_v2.ms_ukuran u ON d.id_ukuran=u.id_ukuran
				JOIN inventory_v2.tr_h_pembelian hp ON h.id_pembelian=hp.id_header
				LEFT JOIN (
					SELECT d.id_penerimaan, d.id_barang, SUM(d.jumlah) AS jumlah_terima,satuan,jumlah_harga,h.diskon,h.ongkir
						FROM erp_financev2.gmd_finance_ap_invoice_detail d 
						JOIN erp_financev2.gmd_finance_ap_invoice h ON d.id_ap=h.id
						WHERE d.status=1
						GROUP BY d.id_barang, d.id_penerimaan
				) t ON d.id_header=t.id_penerimaan AND d.id_barang=t.id_barang
				WHERE hp.id_perusahaan = 50  AND hp.id_header =1195
				GROUP BY d.id_barang,d.id_header
		) terima_barang
		WHERE (jumlah - jumlah_terima) > 0
		
		ORDER BY tanggal DESC
ERROR - 2020-02-18 04:42:01 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Cannot assign requested address /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2020-02-18 04:42:01 --> Unable to connect to the database
ERROR - 2020-02-18 04:42:09 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Cannot assign requested address /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2020-02-18 04:42:09 --> Unable to connect to the database
ERROR - 2020-02-18 04:42:15 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Cannot assign requested address /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2020-02-18 04:42:15 --> Unable to connect to the database
ERROR - 2020-02-18 04:42:21 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Cannot assign requested address /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2020-02-18 04:42:21 --> Unable to connect to the database
ERROR - 2020-02-18 04:42:26 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Cannot assign requested address /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2020-02-18 04:42:26 --> Unable to connect to the database
ERROR - 2020-02-18 04:42:31 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Cannot assign requested address /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2020-02-18 04:42:31 --> Unable to connect to the database
ERROR - 2020-02-18 11:45:20 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Cannot assign requested address /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2020-02-18 11:45:20 --> Unable to connect to the database
ERROR - 2020-02-18 04:46:18 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Cannot assign requested address /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2020-02-18 04:46:18 --> Unable to connect to the database
ERROR - 2020-02-18 14:05:03 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-18 14:05:03 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 339
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 369
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 370
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 372
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined variable: data /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 396
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 411
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 412
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 339
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 369
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli_result::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 370
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli_result::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli_result::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 372
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 396
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 411
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 412
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 339
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 369
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 370
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 372
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 396
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 411
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 412
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 339
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 369
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 370
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 372
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 396
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 411
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 412
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 339
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 369
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 370
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 372
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 396
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 411
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 412
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 339
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 369
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 370
ERROR - 2020-02-18 14:05:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 372
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 396
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 411
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 412
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 339
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 369
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 370
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 372
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 396
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 411
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 412
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 339
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 369
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 370
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 372
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 396
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 411
ERROR - 2020-02-18 14:05:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 412
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 339
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 369
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 370
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 372
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined variable: data /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 396
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 411
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 412
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 339
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 369
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli_result::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 370
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli_result::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli_result::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 372
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 396
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 411
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 412
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 339
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 369
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 370
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 372
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 396
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 411
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 412
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 339
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 369
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 370
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 372
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 396
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 411
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 412
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 339
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 369
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 370
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 372
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 396
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 411
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 412
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 339
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 369
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 370
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 372
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 396
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 411
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 412
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 339
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 369
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 370
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 372
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 396
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 411
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 412
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 339
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 369
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 370
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 372
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 396
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 410
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 411
ERROR - 2020-02-18 14:06:12 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 412
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined variable: data /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 384
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 415
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 416
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli_result::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli_result::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli_result::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 384
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 415
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 416
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 384
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 415
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 416
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 384
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 415
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 416
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 384
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 415
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 416
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 384
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 415
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 416
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 384
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 415
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 416
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 384
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 415
ERROR - 2020-02-18 14:07:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 416
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 344
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined variable: data /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 401
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 415
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 415
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 416
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 417
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 344
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli_result::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli_result::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli_result::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 401
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 415
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 415
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 416
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 417
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 344
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 401
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 415
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 415
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 416
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 417
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 344
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 401
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 415
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 415
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 416
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 417
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 344
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 401
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 415
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 415
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 416
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 417
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 344
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 401
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 415
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 415
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 416
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 417
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 344
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 401
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 415
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 415
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 416
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 417
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 344
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 401
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 415
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 415
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 416
ERROR - 2020-02-18 14:09:09 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 417
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 342
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined variable: data /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 384
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 399
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 412
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 342
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli_result::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli_result::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli_result::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 384
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 399
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 412
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 342
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 384
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 399
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 412
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 342
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 384
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 399
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 412
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 342
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 384
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 399
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 412
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 342
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 384
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 399
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 412
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 342
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 384
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 399
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 412
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 342
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 373
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 384
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 399
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 412
ERROR - 2020-02-18 14:13:02 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined variable: data /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli_result::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli_result::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli_result::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:13:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined variable: data /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli_result::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli_result::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli_result::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:14:29 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined variable: data /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli_result::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli_result::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli_result::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:15:54 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined variable: data /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli_result::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli_result::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli_result::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:18:27 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:18:35 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:18:35 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:18:35 --> Severity: Notice --> Undefined property: mysqli::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:18:35 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:35 --> Severity: Notice --> Undefined property: mysqli::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:35 --> Severity: Notice --> Undefined property: mysqli::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:18:35 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:35 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:35 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:18:35 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:18:35 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:35 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:35 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:35 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:35 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:35 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:35 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:35 --> Severity: Notice --> Undefined variable: data /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:35 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:18:35 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:18:35 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:18:35 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:18:35 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:18:35 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:18:35 --> Severity: Notice --> Undefined property: mysqli_result::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:18:35 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Undefined property: mysqli_result::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Undefined property: mysqli_result::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:18:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined variable: data /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli_result::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli_result::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli_result::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:19:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:19:45 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 357
ERROR - 2020-02-18 14:19:45 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 357
ERROR - 2020-02-18 14:19:45 --> Severity: Notice --> Undefined variable: data /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 357
ERROR - 2020-02-18 14:19:45 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 351
ERROR - 2020-02-18 14:19:45 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 351
ERROR - 2020-02-18 14:19:45 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND b.`id_pembelian`=) z
					GROUP BY z.`id_pembelian`,z.`id_penerimaan`' at line 7 - Invalid query: SELECT *,SUM(hitung) as total FROM (SELECT b.`id_pembelian`,b.`id_penerimaan`,1 AS hitung FROM erp_financev2.`gmd_finance_ap_invoice` a
					JOIN erp_financev2.`gmd_finance_ap_invoice_detail` b
					ON a.`id` = b.`id_ap`
					LEFT JOIN `inventory_v2`.`tr_h_pembelian` c
					ON c.`id_header`=b.`id_pembelian`
					LEFT JOIN  `inventory_v2`.`tr_h_penerimaan` d
					ON d.`id_header`=b.`id_penerimaan` WHERE b.`status`=1 AND a.`status`=1 AND a.`id`=14 AND b.`id_penerimaan`= AND b.`id_pembelian`=) z
					GROUP BY z.`id_pembelian`,z.`id_penerimaan`
ERROR - 2020-02-18 14:19:45 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /data/www/html/erpsmg/finance_gmedia/system/core/Exceptions.php:271) /data/www/html/erpsmg/finance_gmedia/system/core/Common.php 570
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined variable: data /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli_result::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli_result::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli_result::$satuan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli_result::$jumlah /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli_result::$harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli_result::$id_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli_result::$id_pembelian /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Undefined property: mysqli_result::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 343
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 374
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 376
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 377
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 378
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 379
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 380
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 381
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 382
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 385
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 400
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 413
ERROR - 2020-02-18 14:20:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 414
ERROR - 2020-02-18 14:21:17 --> Severity: Notice --> Undefined property: stdClass::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:21:17 --> Severity: Notice --> Undefined variable: data /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 383
ERROR - 2020-02-18 14:21:17 --> Severity: Notice --> Undefined property: stdClass::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:21:17 --> Severity: Notice --> Undefined property: stdClass::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:21:17 --> Severity: Notice --> Undefined property: stdClass::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:21:17 --> Severity: Notice --> Undefined property: stdClass::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:21:17 --> Severity: Notice --> Undefined property: stdClass::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:21:17 --> Severity: Notice --> Undefined property: stdClass::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:21:17 --> Severity: Notice --> Undefined property: stdClass::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:21:17 --> Severity: Notice --> Undefined property: stdClass::$nama_barang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 375
ERROR - 2020-02-18 14:26:37 --> Severity: Notice --> Undefined variable: data /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 389
ERROR - 2020-02-18 14:29:23 --> Severity: 4096 --> Object of class stdClass could not be converted to string /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:29:23 --> Severity: Notice --> Undefined variable:  /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:29:23 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 371
ERROR - 2020-02-18 14:30:49 --> Severity: 4096 --> Object of class stdClass could not be converted to string /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 372
ERROR - 2020-02-18 14:30:49 --> Severity: Notice --> Undefined variable:  /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 372
ERROR - 2020-02-18 14:30:49 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 372
ERROR - 2020-02-18 15:01:36 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-18 15:01:36 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-18 16:34:49 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'GROUP BY d.id_barang,d.id_header) z
		GROUP BY z.id_penerimaan,z.id_pembelian
	U' at line 17 - Invalid query: SELECT *,(SUM(total)-diskon+ongkir) AS total_harga FROM (SELECT h.`tanggal` AS tanggal,h.id_perusahaan,0 AS id_penerimaan, d.id_header AS id_pembelian, NULL AS nomor,h.`nomor` AS nomor_po,d.id_barang, b.nama_barang, 
		SUM(d.qty) AS jumlah, IFNULL(t.jumlah_terima,0) AS jumlah_terima, u.nama_ukuran AS satuan, d.keterangan,d.`harga`,(SUM(d.`qty`)-COALESCE(t.jumlah_terima,0))*d.`harga` AS total,COALESCE(h.diskon-COALESCE(t.diskon,0),0) AS diskon,COALESCE(h.ongkir-COALESCE(t.ongkir,0),0) AS ongkir,cc.nama AS supplier
		FROM inventory_v2.tr_d_pembelian d 
		JOIN inventory_v2.tr_h_pembelian h ON d.id_header=h.id_header
		JOIN inventory_v2.ms_header_barang b ON d.id_barang=b.id_header
		JOIN inventory_v2.ms_ukuran u ON d.id_ukuran=u.id_ukuran
		JOIN inventory_v2.ms_perusahaan cc ON h.id_perusahaan=cc.id_perusahaan
		LEFT JOIN (
			SELECT d.id_pembelian, d.id_barang, SUM(d.jumlah) AS jumlah_terima,satuan,jumlah_harga,h.diskon,h.ongkir,d.status
				FROM erp_financev2.gmd_finance_ap_invoice_detail d 
				JOIN erp_financev2.gmd_finance_ap_invoice h ON d.id_ap=h.id
				WHERE d.id_penerimaan=0 AND d.status=1
				GROUP BY d.id_barang, d.id_pembelian
		) t ON d.id_header=t.id_pembelian AND d.id_barang=t.id_barang
		WHERE b.flag='J' AND d.`status`=1
		AND (d.qty - IFNULL(t.jumlah_terima,0)) > 0 AND h.id_perusahaan=
		GROUP BY d.id_barang,d.id_header) z
		GROUP BY z.id_penerimaan,z.id_pembelian
	UNION ALL
	SELECT *,(SUM(z.total)-z.diskon+z.ongkir) AS total_harga FROM (
	SELECT * FROM (
		SELECT h.`tanggal` AS tanggal,hp.id_perusahaan, d.id_header AS id_penerimaan,hp.`id_header` AS id_pembelian, h.`nomor`,hp.`nomor` AS nomor_po,d.id_barang, b.nama_barang, SUM(d.qty) AS jumlah, IFNULL(t.jumlah_terima,0) AS jumlah_terima, 
			u.nama_ukuran AS satuan, d.keterangan,d.`harga`,(SUM(d.`qty`)-COALESCE(t.jumlah_terima,0))*d.`harga` AS total,COALESCE(hp.diskon-COALESCE(t.diskon,0),0) AS diskon,COALESCE(hp.ongkir-COALESCE(t.ongkir,0),0) AS ongkir,cc.nama AS supplier
			FROM inventory_v2.tr_d_penerimaan d 
			JOIN inventory_v2.tr_h_penerimaan h ON d.id_header=h.id_header
			JOIN inventory_v2.ms_header_barang b ON d.id_barang=b.id_header
			JOIN inventory_v2.ms_ukuran u ON d.id_ukuran=u.id_ukuran
			JOIN inventory_v2.tr_h_pembelian hp ON h.id_pembelian=hp.id_header
			JOIN inventory_v2.ms_perusahaan cc ON hp.id_perusahaan=cc.id_perusahaan
			LEFT JOIN (
				SELECT d.id_penerimaan, d.id_barang, SUM(d.jumlah) AS jumlah_terima,satuan,jumlah_harga,h.diskon,h.ongkir,d.status
					FROM erp_financev2.gmd_finance_ap_invoice_detail d 
					JOIN erp_financev2.gmd_finance_ap_invoice h ON d.id_ap=h.id
					WHERE d.status=1
					GROUP BY d.id_barang, d.id_penerimaan
			) t ON d.id_header=t.id_penerimaan AND d.id_barang=t.id_barang
			GROUP BY d.id_barang,d.id_header
	) terima_barang
	WHERE (jumlah - jumlah_terima) > 0 AND id_perusahaan= )  z 
	GROUP BY z.id_penerimaan,z.id_pembelian
	
	ORDER BY tanggal DESC
ERROR - 2020-02-18 22:03:07 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-18 22:03:07 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-18 23:34:14 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ELECT h.`tanggal` AS tanggal,h.id_perusahaan,0 AS id_penerimaan, d.id_header AS ' at line 1 - Invalid query: ELECT h.`tanggal` AS tanggal,h.id_perusahaan,0 AS id_penerimaan, d.id_header AS id_pembelian, NULL AS nomor,h.`nomor` AS nomor_po,d.id_barang, b.nama_barang, 
			SUM(d.qty) AS jumlah, IFNULL(t.jumlah_terima,0) AS jumlah_terima, u.nama_ukuran AS satuan, d.keterangan,d.`harga`,(SUM(d.`qty`)-COALESCE(t.jumlah_terima,0))*d.`harga` AS total,COALESCE(h.diskon-COALESCE(t.diskon,0),0) AS diskon,COALESCE(h.ongkir-COALESCE(t.ongkir,0),0) AS ongkir
			FROM inventory_v2.tr_d_pembelian d 
			JOIN inventory_v2.tr_h_pembelian h ON d.id_header=h.id_header
			JOIN inventory_v2.ms_header_barang b ON d.id_barang=b.id_header
			JOIN inventory_v2.ms_ukuran u ON d.id_ukuran=u.id_ukuran
			LEFT JOIN (
				SELECT d.id_pembelian, d.id_barang, SUM(d.jumlah) AS jumlah_terima,d.satuan,d.jumlah_harga,h.diskon,h.ongkir
					FROM erp_financev2.gmd_finance_ap_invoice_detail d 
					JOIN erp_financev2.gmd_finance_ap_invoice h ON d.id_ap=h.id
					WHERE d.id_penerimaan=0 AND d.status=1
					GROUP BY d.id_barang, d.id_pembelian
			) t ON d.id_header=t.id_pembelian AND d.id_barang=t.id_barang
			WHERE b.flag='J' AND d.`status`=1 AND h.id_perusahaan = 50  AND d.id_header =3248
			AND (d.qty - IFNULL(t.jumlah_terima,0)) > 0
			GROUP BY d.id_barang,d.id_header
		UNION ALL
		SELECT * FROM (
			SELECT h.`tanggal` AS tanggal,hp.id_perusahaan, d.id_header AS id_penerimaan,hp.`id_header` AS id_pembelian, h.`nomor`,hp.`nomor` AS nomor_po,d.id_barang, b.nama_barang, SUM(d.qty) AS jumlah, IFNULL(t.jumlah_terima,0) AS jumlah_terima, 
				u.nama_ukuran AS satuan, d.keterangan,d.`harga`,(SUM(d.`qty`)-COALESCE(t.jumlah_terima,0))*d.`harga` AS total,COALESCE(hp.diskon-COALESCE(t.diskon,0),0) AS diskon,COALESCE(hp.ongkir-COALESCE(t.ongkir,0),0) AS ongkir
				FROM inventory_v2.tr_d_penerimaan d 
				JOIN inventory_v2.tr_h_penerimaan h ON d.id_header=h.id_header
				JOIN inventory_v2.ms_header_barang b ON d.id_barang=b.id_header
				JOIN inventory_v2.ms_ukuran u ON d.id_ukuran=u.id_ukuran
				JOIN inventory_v2.tr_h_pembelian hp ON h.id_pembelian=hp.id_header
				LEFT JOIN (
					SELECT d.id_penerimaan, d.id_barang, SUM(d.jumlah) AS jumlah_terima,d.satuan,d.jumlah_harga,h.diskon,h.ongkir
						FROM erp_financev2.gmd_finance_ap_invoice_detail d 
						JOIN erp_financev2.gmd_finance_ap_invoice h ON d.id_ap=h.id
						WHERE d.status=1
						GROUP BY d.id_barang, d.id_penerimaan
				) t ON d.id_header=t.id_penerimaan AND d.id_barang=t.id_barang
				WHERE hp.id_perusahaan = 50  AND hp.id_header =3248
				GROUP BY d.id_barang,d.id_header
		) terima_barang
		WHERE (jumlah - jumlah_terima) > 0
		
		ORDER BY tanggal DESC
ERROR - 2020-02-18 23:38:48 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ELECT h.`tanggal` AS tanggal,h.id_perusahaan,0 AS id_penerimaan, d.id_header AS ' at line 1 - Invalid query: ELECT h.`tanggal` AS tanggal,h.id_perusahaan,0 AS id_penerimaan, d.id_header AS id_pembelian, NULL AS nomor,h.`nomor` AS nomor_po,d.id_barang, b.nama_barang, 
			SUM(d.qty) AS jumlah, IFNULL(t.jumlah_terima,0) AS jumlah_terima, u.nama_ukuran AS satuan, d.keterangan,d.`harga`,(SUM(d.`qty`)-COALESCE(t.jumlah_terima,0))*d.`harga` AS total,COALESCE(h.diskon-COALESCE(t.diskon,0),0) AS diskon,COALESCE(h.ongkir-COALESCE(t.ongkir,0),0) AS ongkir
			FROM inventory_v2.tr_d_pembelian d 
			JOIN inventory_v2.tr_h_pembelian h ON d.id_header=h.id_header
			JOIN inventory_v2.ms_header_barang b ON d.id_barang=b.id_header
			JOIN inventory_v2.ms_ukuran u ON d.id_ukuran=u.id_ukuran
			LEFT JOIN (
				SELECT d.id_pembelian, d.id_barang, SUM(d.jumlah) AS jumlah_terima,d.satuan,d.jumlah_harga,h.diskon,h.ongkir
					FROM erp_financev2.gmd_finance_ap_invoice_detail d 
					JOIN erp_financev2.gmd_finance_ap_invoice h ON d.id_ap=h.id
					WHERE d.id_penerimaan=0 AND d.status=1
					GROUP BY d.id_barang, d.id_pembelian
			) t ON d.id_header=t.id_pembelian AND d.id_barang=t.id_barang
			WHERE b.flag='J' AND d.`status`=1 AND h.id_perusahaan = 50  AND d.id_header =3248
			AND (d.qty - IFNULL(t.jumlah_terima,0)) > 0
			GROUP BY d.id_barang,d.id_header
		UNION ALL
		SELECT * FROM (
			SELECT h.`tanggal` AS tanggal,hp.id_perusahaan, d.id_header AS id_penerimaan,hp.`id_header` AS id_pembelian, h.`nomor`,hp.`nomor` AS nomor_po,d.id_barang, b.nama_barang, SUM(d.qty) AS jumlah, IFNULL(t.jumlah_terima,0) AS jumlah_terima, 
				u.nama_ukuran AS satuan, d.keterangan,d.`harga`,(SUM(d.`qty`)-COALESCE(t.jumlah_terima,0))*d.`harga` AS total,COALESCE(hp.diskon-COALESCE(t.diskon,0),0) AS diskon,COALESCE(hp.ongkir-COALESCE(t.ongkir,0),0) AS ongkir
				FROM inventory_v2.tr_d_penerimaan d 
				JOIN inventory_v2.tr_h_penerimaan h ON d.id_header=h.id_header
				JOIN inventory_v2.ms_header_barang b ON d.id_barang=b.id_header
				JOIN inventory_v2.ms_ukuran u ON d.id_ukuran=u.id_ukuran
				JOIN inventory_v2.tr_h_pembelian hp ON h.id_pembelian=hp.id_header
				LEFT JOIN (
					SELECT d.id_penerimaan, d.id_barang, SUM(d.jumlah) AS jumlah_terima,d.satuan,d.jumlah_harga,h.diskon,h.ongkir
						FROM erp_financev2.gmd_finance_ap_invoice_detail d 
						JOIN erp_financev2.gmd_finance_ap_invoice h ON d.id_ap=h.id
						WHERE d.status=1
						GROUP BY d.id_barang, d.id_penerimaan
				) t ON d.id_header=t.id_penerimaan AND d.id_barang=t.id_barang
				WHERE hp.id_perusahaan = 50  AND hp.id_header =3248
				GROUP BY d.id_barang,d.id_header
		) terima_barang
		WHERE (jumlah - jumlah_terima) > 0
		
		ORDER BY tanggal DESC
