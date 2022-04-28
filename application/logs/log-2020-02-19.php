<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-02-19 08:14:17 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-19 08:14:17 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-19 08:23:32 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-19 08:23:32 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-19 08:47:03 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-19 08:47:03 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-19 01:47:19 --> 404 Page Not Found: Assets/js
ERROR - 2020-02-19 01:47:19 --> 404 Page Not Found: Assets/js
ERROR - 2020-02-19 01:47:19 --> 404 Page Not Found: Assets/js
ERROR - 2020-02-19 01:47:19 --> 404 Page Not Found: Assets/js
ERROR - 2020-02-19 01:47:19 --> 404 Page Not Found: Assets/js
ERROR - 2020-02-19 01:47:19 --> 404 Page Not Found: Assets/js
ERROR - 2020-02-19 08:53:50 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-19 08:53:50 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-19 08:55:37 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ELECT h.`tanggal` AS tanggal,h.id_perusahaan,0 AS id_penerimaan, d.id_header AS ' at line 1 - Invalid query: ELECT h.`tanggal` AS tanggal,h.id_perusahaan,0 AS id_penerimaan, d.id_header AS id_pembelian, NULL AS nomor,h.`nomor` AS nomor_po,d.id_barang, b.nama_barang, 
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
			WHERE b.flag='J' AND d.`status`=1 AND h.id_perusahaan = 59  AND d.id_header =2076
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
				WHERE hp.id_perusahaan = 59  AND d.id_header =2076
				GROUP BY d.id_barang,d.id_header
		) terima_barang
		WHERE (jumlah - jumlah_terima) > 0
		
		ORDER BY tanggal DESC
ERROR - 2020-02-19 08:57:02 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ELECT h.`tanggal` AS tanggal,h.id_perusahaan,0 AS id_penerimaan, d.id_header AS ' at line 1 - Invalid query: ELECT h.`tanggal` AS tanggal,h.id_perusahaan,0 AS id_penerimaan, d.id_header AS id_pembelian, NULL AS nomor,h.`nomor` AS nomor_po,d.id_barang, b.nama_barang, 
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
			WHERE b.flag='J' AND d.`status`=1 AND h.id_perusahaan = 59  AND d.id_header =2076
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
				WHERE hp.id_perusahaan = 59  AND d.id_header =2076
				GROUP BY d.id_barang,d.id_header
		) terima_barang
		WHERE (jumlah - jumlah_terima) > 0
		
		ORDER BY tanggal DESC
ERROR - 2020-02-19 08:57:10 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ELECT h.`tanggal` AS tanggal,h.id_perusahaan,0 AS id_penerimaan, d.id_header AS ' at line 1 - Invalid query: ELECT h.`tanggal` AS tanggal,h.id_perusahaan,0 AS id_penerimaan, d.id_header AS id_pembelian, NULL AS nomor,h.`nomor` AS nomor_po,d.id_barang, b.nama_barang, 
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
			WHERE b.flag='J' AND d.`status`=1 AND h.id_perusahaan =   AND d.id_header =
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
				WHERE hp.id_perusahaan =   AND hp.id_header =
				GROUP BY d.id_barang,d.id_header
		) terima_barang
		WHERE (jumlah - jumlah_terima) > 0
		
		ORDER BY tanggal DESC
ERROR - 2020-02-19 09:46:05 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-19 09:46:05 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-19 03:03:21 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-19 03:03:21 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-19 03:03:21 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-19 03:03:21 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-19 03:03:21 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-19 03:10:08 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-19 03:10:08 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-19 03:10:08 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-19 03:10:08 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-19 03:10:08 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-19 04:19:09 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-19 04:19:09 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-19 04:19:09 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-19 04:19:09 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-19 04:19:09 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-19 04:22:54 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-19 04:22:54 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-19 04:22:54 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-19 04:22:54 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-19 04:22:54 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-19 04:49:05 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-19 04:49:05 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-19 04:49:05 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-19 04:49:05 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-19 04:49:05 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-19 13:22:29 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-19 13:22:29 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-19 13:58:16 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-19 13:58:16 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-19 14:55:48 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-19 14:55:48 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 15:07:00 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-19 08:14:54 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-19 08:14:54 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-19 08:14:54 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-19 08:14:54 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-19 08:14:54 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-19 16:13:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_transaksi_kas_kecil.php 409
ERROR - 2020-02-19 16:14:18 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_transaksi_kas_kecil.php 408
ERROR - 2020-02-19 16:14:49 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_transaksi_kas_kecil.php 409
ERROR - 2020-02-19 16:17:35 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_transaksi_kas_kecil.php 409
ERROR - 2020-02-19 16:17:42 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_transaksi_kas_kecil.php 407
ERROR - 2020-02-19 16:23:25 --> Query error: Unknown column 'b.jurnal_group' in 'where clause' - Invalid query: SELECT *
FROM `gmd_finance_coa_general_ledger` `a`
LEFT JOIN `gmd_finance_coa_general_ledger_detail` `b` ON `a`.`no_trans`=`b`.`no_trans`
WHERE `a`.`no_referensi` = 'BKK 0220-0015'
AND RIGHT(b.`jurnal_group`,4) = 'JKK'
ERROR - 2020-02-19 16:24:10 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_transaksi_kas_kecil.php 413
ERROR - 2020-02-19 09:39:35 --> 404 Page Not Found: Assets/js
ERROR - 2020-02-19 16:58:23 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-19 16:58:23 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
