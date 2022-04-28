<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-02-17 01:16:42 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-17 01:16:42 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-17 08:17:32 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-17 08:17:32 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-17 08:23:11 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-17 08:23:11 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-17 08:47:17 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-17 08:47:17 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-17 08:47:26 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND id_perusahaan=50
	GROUP BY z.id_penerimaan,z.id_pembelian
	
	ORDER BY tangga' at line 38 - Invalid query: SELECT *,SUM(total-diskon+ongkir) AS total_harga FROM (SELECT h.`tanggal` AS tanggal,h.id_perusahaan,0 AS id_penerimaan, d.id_header AS id_pembelian, NULL AS nomor,h.`nomor` AS nomor_po,d.id_barang, b.nama_barang, 
		SUM(d.qty) AS jumlah, IFNULL(t.jumlah_terima,0) AS jumlah_terima, u.nama_ukuran AS satuan, d.keterangan,d.`harga`,(SUM(d.`qty`)-COALESCE(t.jumlah_terima,0))*d.`harga` AS total,COALESCE(h.diskon-t.diskon,0) AS diskon,COALESCE(h.ongkir-t.ongkir,0) AS ongkir,cc.nama AS supplier
		FROM inventory_v2.tr_d_pembelian d 
		JOIN inventory_v2.tr_h_pembelian h ON d.id_header=h.id_header
		JOIN inventory_v2.ms_header_barang b ON d.id_barang=b.id_header
		JOIN inventory_v2.ms_ukuran u ON d.id_ukuran=u.id_ukuran
		JOIN inventory_v2.ms_perusahaan cc ON h.id_perusahaan=cc.id_perusahaan
		LEFT JOIN (
			SELECT d.id_pembelian, d.id_barang, SUM(d.jumlah) AS jumlah_terima,satuan,jumlah_harga,h.diskon,h.ongkir
				FROM erp_financev2.gmd_finance_ap_invoice_detail d 
				JOIN erp_financev2.gmd_finance_ap_invoice h ON d.id_ap=h.id
				WHERE d.id_penerimaan IS NULL
				GROUP BY d.id_barang, d.id_pembelian
		) t ON d.id_header=t.id_pembelian AND d.id_barang=t.id_barang
		WHERE b.flag='J' AND d.`status`=1
		AND (d.qty - IFNULL(t.jumlah_terima,0)) > 0 AND h.id_perusahaan=50
		GROUP BY d.id_barang,d.id_header,h.`id_perusahaan`) z
		GROUP BY z.id_penerimaan,z.id_pembelian
	UNION ALL
	SELECT *,SUM(z.total-z.diskon+z.ongkir) AS total_harga FROM (
	SELECT * FROM (
		SELECT h.`tanggal` AS tanggal,hp.id_perusahaan, d.id_header AS id_penerimaan,hp.`id_header` AS id_pembelian, h.`nomor`,hp.`nomor` AS nomor_po,d.id_barang, b.nama_barang, SUM(d.qty) AS jumlah, IFNULL(t.jumlah_terima,0) AS jumlah_terima, 
			u.nama_ukuran AS satuan, d.keterangan,d.`harga`,(SUM(d.`qty`)-COALESCE(t.jumlah_terima,0))*d.`harga` AS total,COALESCE(hp.diskon-t.diskon,0) AS diskon,COALESCE(hp.ongkir-t.ongkir,0) AS ongkir,cc.nama AS supplier
			FROM inventory_v2.tr_d_penerimaan d 
			JOIN inventory_v2.tr_h_penerimaan h ON d.id_header=h.id_header
			JOIN inventory_v2.ms_header_barang b ON d.id_barang=b.id_header
			JOIN inventory_v2.ms_ukuran u ON d.id_ukuran=u.id_ukuran
			JOIN inventory_v2.tr_h_pembelian hp ON h.id_pembelian=hp.id_header
			JOIN inventory_v2.ms_perusahaan cc ON hp.id_perusahaan=cc.id_perusahaan
			LEFT JOIN (
				SELECT d.id_penerimaan, d.id_barang, SUM(d.jumlah) AS jumlah_terima,satuan,jumlah_harga,h.diskon,h.ongkir
					FROM erp_financev2.gmd_finance_ap_invoice_detail d 
					JOIN erp_financev2.gmd_finance_ap_invoice h ON d.id_ap=h.id
					GROUP BY d.id_barang, d.id_penerimaan
			) t ON d.id_header=t.id_penerimaan AND d.id_barang=t.id_barang
			GROUP BY d.id_barang,d.id_header,hp.`id_perusahaan`
	) terima_barang
	WHERE (jumlah - jumlah_terima) > 0 )  z AND id_perusahaan=50
	GROUP BY z.id_penerimaan,z.id_pembelian
	
	ORDER BY tanggal DESC
ERROR - 2020-02-17 08:47:37 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND id_perusahaan=113
	GROUP BY z.id_penerimaan,z.id_pembelian
	
	ORDER BY tangg' at line 38 - Invalid query: SELECT *,SUM(total-diskon+ongkir) AS total_harga FROM (SELECT h.`tanggal` AS tanggal,h.id_perusahaan,0 AS id_penerimaan, d.id_header AS id_pembelian, NULL AS nomor,h.`nomor` AS nomor_po,d.id_barang, b.nama_barang, 
		SUM(d.qty) AS jumlah, IFNULL(t.jumlah_terima,0) AS jumlah_terima, u.nama_ukuran AS satuan, d.keterangan,d.`harga`,(SUM(d.`qty`)-COALESCE(t.jumlah_terima,0))*d.`harga` AS total,COALESCE(h.diskon-t.diskon,0) AS diskon,COALESCE(h.ongkir-t.ongkir,0) AS ongkir,cc.nama AS supplier
		FROM inventory_v2.tr_d_pembelian d 
		JOIN inventory_v2.tr_h_pembelian h ON d.id_header=h.id_header
		JOIN inventory_v2.ms_header_barang b ON d.id_barang=b.id_header
		JOIN inventory_v2.ms_ukuran u ON d.id_ukuran=u.id_ukuran
		JOIN inventory_v2.ms_perusahaan cc ON h.id_perusahaan=cc.id_perusahaan
		LEFT JOIN (
			SELECT d.id_pembelian, d.id_barang, SUM(d.jumlah) AS jumlah_terima,satuan,jumlah_harga,h.diskon,h.ongkir
				FROM erp_financev2.gmd_finance_ap_invoice_detail d 
				JOIN erp_financev2.gmd_finance_ap_invoice h ON d.id_ap=h.id
				WHERE d.id_penerimaan IS NULL
				GROUP BY d.id_barang, d.id_pembelian
		) t ON d.id_header=t.id_pembelian AND d.id_barang=t.id_barang
		WHERE b.flag='J' AND d.`status`=1
		AND (d.qty - IFNULL(t.jumlah_terima,0)) > 0 AND h.id_perusahaan=113
		GROUP BY d.id_barang,d.id_header,h.`id_perusahaan`) z
		GROUP BY z.id_penerimaan,z.id_pembelian
	UNION ALL
	SELECT *,SUM(z.total-z.diskon+z.ongkir) AS total_harga FROM (
	SELECT * FROM (
		SELECT h.`tanggal` AS tanggal,hp.id_perusahaan, d.id_header AS id_penerimaan,hp.`id_header` AS id_pembelian, h.`nomor`,hp.`nomor` AS nomor_po,d.id_barang, b.nama_barang, SUM(d.qty) AS jumlah, IFNULL(t.jumlah_terima,0) AS jumlah_terima, 
			u.nama_ukuran AS satuan, d.keterangan,d.`harga`,(SUM(d.`qty`)-COALESCE(t.jumlah_terima,0))*d.`harga` AS total,COALESCE(hp.diskon-t.diskon,0) AS diskon,COALESCE(hp.ongkir-t.ongkir,0) AS ongkir,cc.nama AS supplier
			FROM inventory_v2.tr_d_penerimaan d 
			JOIN inventory_v2.tr_h_penerimaan h ON d.id_header=h.id_header
			JOIN inventory_v2.ms_header_barang b ON d.id_barang=b.id_header
			JOIN inventory_v2.ms_ukuran u ON d.id_ukuran=u.id_ukuran
			JOIN inventory_v2.tr_h_pembelian hp ON h.id_pembelian=hp.id_header
			JOIN inventory_v2.ms_perusahaan cc ON hp.id_perusahaan=cc.id_perusahaan
			LEFT JOIN (
				SELECT d.id_penerimaan, d.id_barang, SUM(d.jumlah) AS jumlah_terima,satuan,jumlah_harga,h.diskon,h.ongkir
					FROM erp_financev2.gmd_finance_ap_invoice_detail d 
					JOIN erp_financev2.gmd_finance_ap_invoice h ON d.id_ap=h.id
					GROUP BY d.id_barang, d.id_penerimaan
			) t ON d.id_header=t.id_penerimaan AND d.id_barang=t.id_barang
			GROUP BY d.id_barang,d.id_header,hp.`id_perusahaan`
	) terima_barang
	WHERE (jumlah - jumlah_terima) > 0 )  z AND id_perusahaan=113
	GROUP BY z.id_penerimaan,z.id_pembelian
	
	ORDER BY tanggal DESC
ERROR - 2020-02-17 08:47:38 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND id_perusahaan=50
	GROUP BY z.id_penerimaan,z.id_pembelian
	
	ORDER BY tangga' at line 38 - Invalid query: SELECT *,SUM(total-diskon+ongkir) AS total_harga FROM (SELECT h.`tanggal` AS tanggal,h.id_perusahaan,0 AS id_penerimaan, d.id_header AS id_pembelian, NULL AS nomor,h.`nomor` AS nomor_po,d.id_barang, b.nama_barang, 
		SUM(d.qty) AS jumlah, IFNULL(t.jumlah_terima,0) AS jumlah_terima, u.nama_ukuran AS satuan, d.keterangan,d.`harga`,(SUM(d.`qty`)-COALESCE(t.jumlah_terima,0))*d.`harga` AS total,COALESCE(h.diskon-t.diskon,0) AS diskon,COALESCE(h.ongkir-t.ongkir,0) AS ongkir,cc.nama AS supplier
		FROM inventory_v2.tr_d_pembelian d 
		JOIN inventory_v2.tr_h_pembelian h ON d.id_header=h.id_header
		JOIN inventory_v2.ms_header_barang b ON d.id_barang=b.id_header
		JOIN inventory_v2.ms_ukuran u ON d.id_ukuran=u.id_ukuran
		JOIN inventory_v2.ms_perusahaan cc ON h.id_perusahaan=cc.id_perusahaan
		LEFT JOIN (
			SELECT d.id_pembelian, d.id_barang, SUM(d.jumlah) AS jumlah_terima,satuan,jumlah_harga,h.diskon,h.ongkir
				FROM erp_financev2.gmd_finance_ap_invoice_detail d 
				JOIN erp_financev2.gmd_finance_ap_invoice h ON d.id_ap=h.id
				WHERE d.id_penerimaan IS NULL
				GROUP BY d.id_barang, d.id_pembelian
		) t ON d.id_header=t.id_pembelian AND d.id_barang=t.id_barang
		WHERE b.flag='J' AND d.`status`=1
		AND (d.qty - IFNULL(t.jumlah_terima,0)) > 0 AND h.id_perusahaan=50
		GROUP BY d.id_barang,d.id_header,h.`id_perusahaan`) z
		GROUP BY z.id_penerimaan,z.id_pembelian
	UNION ALL
	SELECT *,SUM(z.total-z.diskon+z.ongkir) AS total_harga FROM (
	SELECT * FROM (
		SELECT h.`tanggal` AS tanggal,hp.id_perusahaan, d.id_header AS id_penerimaan,hp.`id_header` AS id_pembelian, h.`nomor`,hp.`nomor` AS nomor_po,d.id_barang, b.nama_barang, SUM(d.qty) AS jumlah, IFNULL(t.jumlah_terima,0) AS jumlah_terima, 
			u.nama_ukuran AS satuan, d.keterangan,d.`harga`,(SUM(d.`qty`)-COALESCE(t.jumlah_terima,0))*d.`harga` AS total,COALESCE(hp.diskon-t.diskon,0) AS diskon,COALESCE(hp.ongkir-t.ongkir,0) AS ongkir,cc.nama AS supplier
			FROM inventory_v2.tr_d_penerimaan d 
			JOIN inventory_v2.tr_h_penerimaan h ON d.id_header=h.id_header
			JOIN inventory_v2.ms_header_barang b ON d.id_barang=b.id_header
			JOIN inventory_v2.ms_ukuran u ON d.id_ukuran=u.id_ukuran
			JOIN inventory_v2.tr_h_pembelian hp ON h.id_pembelian=hp.id_header
			JOIN inventory_v2.ms_perusahaan cc ON hp.id_perusahaan=cc.id_perusahaan
			LEFT JOIN (
				SELECT d.id_penerimaan, d.id_barang, SUM(d.jumlah) AS jumlah_terima,satuan,jumlah_harga,h.diskon,h.ongkir
					FROM erp_financev2.gmd_finance_ap_invoice_detail d 
					JOIN erp_financev2.gmd_finance_ap_invoice h ON d.id_ap=h.id
					GROUP BY d.id_barang, d.id_penerimaan
			) t ON d.id_header=t.id_penerimaan AND d.id_barang=t.id_barang
			GROUP BY d.id_barang,d.id_header,hp.`id_perusahaan`
	) terima_barang
	WHERE (jumlah - jumlah_terima) > 0 )  z AND id_perusahaan=50
	GROUP BY z.id_penerimaan,z.id_pembelian
	
	ORDER BY tanggal DESC
ERROR - 2020-02-17 01:53:20 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-17 01:53:20 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-17 01:53:20 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-17 01:53:20 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-17 01:53:20 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-17 08:59:34 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND hp.id_perusahaan=113
	GROUP BY z.id_penerimaan,z.id_pembelian
	
	ORDER BY ta' at line 38 - Invalid query: SELECT *,SUM(total-diskon+ongkir) AS total_harga FROM (SELECT h.`tanggal` AS tanggal,h.id_perusahaan,0 AS id_penerimaan, d.id_header AS id_pembelian, NULL AS nomor,h.`nomor` AS nomor_po,d.id_barang, b.nama_barang, 
		SUM(d.qty) AS jumlah, IFNULL(t.jumlah_terima,0) AS jumlah_terima, u.nama_ukuran AS satuan, d.keterangan,d.`harga`,(SUM(d.`qty`)-COALESCE(t.jumlah_terima,0))*d.`harga` AS total,COALESCE(h.diskon-t.diskon,0) AS diskon,COALESCE(h.ongkir-t.ongkir,0) AS ongkir,cc.nama AS supplier
		FROM inventory_v2.tr_d_pembelian d 
		JOIN inventory_v2.tr_h_pembelian h ON d.id_header=h.id_header
		JOIN inventory_v2.ms_header_barang b ON d.id_barang=b.id_header
		JOIN inventory_v2.ms_ukuran u ON d.id_ukuran=u.id_ukuran
		JOIN inventory_v2.ms_perusahaan cc ON h.id_perusahaan=cc.id_perusahaan
		LEFT JOIN (
			SELECT d.id_pembelian, d.id_barang, SUM(d.jumlah) AS jumlah_terima,satuan,jumlah_harga,h.diskon,h.ongkir
				FROM erp_financev2.gmd_finance_ap_invoice_detail d 
				JOIN erp_financev2.gmd_finance_ap_invoice h ON d.id_ap=h.id
				WHERE d.id_penerimaan IS NULL
				GROUP BY d.id_barang, d.id_pembelian
		) t ON d.id_header=t.id_pembelian AND d.id_barang=t.id_barang
		WHERE b.flag='J' AND d.`status`=1
		AND (d.qty - IFNULL(t.jumlah_terima,0)) > 0 AND h.id_perusahaan=113
		GROUP BY d.id_barang,d.id_header,h.`id_perusahaan`) z
		GROUP BY z.id_penerimaan,z.id_pembelian
	UNION ALL
	SELECT *,SUM(z.total-z.diskon+z.ongkir) AS total_harga FROM (
	SELECT * FROM (
		SELECT h.`tanggal` AS tanggal,hp.id_perusahaan, d.id_header AS id_penerimaan,hp.`id_header` AS id_pembelian, h.`nomor`,hp.`nomor` AS nomor_po,d.id_barang, b.nama_barang, SUM(d.qty) AS jumlah, IFNULL(t.jumlah_terima,0) AS jumlah_terima, 
			u.nama_ukuran AS satuan, d.keterangan,d.`harga`,(SUM(d.`qty`)-COALESCE(t.jumlah_terima,0))*d.`harga` AS total,COALESCE(hp.diskon-t.diskon,0) AS diskon,COALESCE(hp.ongkir-t.ongkir,0) AS ongkir,cc.nama AS supplier
			FROM inventory_v2.tr_d_penerimaan d 
			JOIN inventory_v2.tr_h_penerimaan h ON d.id_header=h.id_header
			JOIN inventory_v2.ms_header_barang b ON d.id_barang=b.id_header
			JOIN inventory_v2.ms_ukuran u ON d.id_ukuran=u.id_ukuran
			JOIN inventory_v2.tr_h_pembelian hp ON h.id_pembelian=hp.id_header
			JOIN inventory_v2.ms_perusahaan cc ON hp.id_perusahaan=cc.id_perusahaan
			LEFT JOIN (
				SELECT d.id_penerimaan, d.id_barang, SUM(d.jumlah) AS jumlah_terima,satuan,jumlah_harga,h.diskon,h.ongkir
					FROM erp_financev2.gmd_finance_ap_invoice_detail d 
					JOIN erp_financev2.gmd_finance_ap_invoice h ON d.id_ap=h.id
					GROUP BY d.id_barang, d.id_penerimaan
			) t ON d.id_header=t.id_penerimaan AND d.id_barang=t.id_barang
			GROUP BY d.id_barang,d.id_header,hp.`id_perusahaan`
	) terima_barang
	WHERE (jumlah - jumlah_terima) > 0 )  z AND hp.id_perusahaan=113
	GROUP BY z.id_penerimaan,z.id_pembelian
	
	ORDER BY tanggal DESC
ERROR - 2020-02-17 08:59:37 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND hp.id_perusahaan=50
	GROUP BY z.id_penerimaan,z.id_pembelian
	
	ORDER BY tan' at line 38 - Invalid query: SELECT *,SUM(total-diskon+ongkir) AS total_harga FROM (SELECT h.`tanggal` AS tanggal,h.id_perusahaan,0 AS id_penerimaan, d.id_header AS id_pembelian, NULL AS nomor,h.`nomor` AS nomor_po,d.id_barang, b.nama_barang, 
		SUM(d.qty) AS jumlah, IFNULL(t.jumlah_terima,0) AS jumlah_terima, u.nama_ukuran AS satuan, d.keterangan,d.`harga`,(SUM(d.`qty`)-COALESCE(t.jumlah_terima,0))*d.`harga` AS total,COALESCE(h.diskon-t.diskon,0) AS diskon,COALESCE(h.ongkir-t.ongkir,0) AS ongkir,cc.nama AS supplier
		FROM inventory_v2.tr_d_pembelian d 
		JOIN inventory_v2.tr_h_pembelian h ON d.id_header=h.id_header
		JOIN inventory_v2.ms_header_barang b ON d.id_barang=b.id_header
		JOIN inventory_v2.ms_ukuran u ON d.id_ukuran=u.id_ukuran
		JOIN inventory_v2.ms_perusahaan cc ON h.id_perusahaan=cc.id_perusahaan
		LEFT JOIN (
			SELECT d.id_pembelian, d.id_barang, SUM(d.jumlah) AS jumlah_terima,satuan,jumlah_harga,h.diskon,h.ongkir
				FROM erp_financev2.gmd_finance_ap_invoice_detail d 
				JOIN erp_financev2.gmd_finance_ap_invoice h ON d.id_ap=h.id
				WHERE d.id_penerimaan IS NULL
				GROUP BY d.id_barang, d.id_pembelian
		) t ON d.id_header=t.id_pembelian AND d.id_barang=t.id_barang
		WHERE b.flag='J' AND d.`status`=1
		AND (d.qty - IFNULL(t.jumlah_terima,0)) > 0 AND h.id_perusahaan=50
		GROUP BY d.id_barang,d.id_header,h.`id_perusahaan`) z
		GROUP BY z.id_penerimaan,z.id_pembelian
	UNION ALL
	SELECT *,SUM(z.total-z.diskon+z.ongkir) AS total_harga FROM (
	SELECT * FROM (
		SELECT h.`tanggal` AS tanggal,hp.id_perusahaan, d.id_header AS id_penerimaan,hp.`id_header` AS id_pembelian, h.`nomor`,hp.`nomor` AS nomor_po,d.id_barang, b.nama_barang, SUM(d.qty) AS jumlah, IFNULL(t.jumlah_terima,0) AS jumlah_terima, 
			u.nama_ukuran AS satuan, d.keterangan,d.`harga`,(SUM(d.`qty`)-COALESCE(t.jumlah_terima,0))*d.`harga` AS total,COALESCE(hp.diskon-t.diskon,0) AS diskon,COALESCE(hp.ongkir-t.ongkir,0) AS ongkir,cc.nama AS supplier
			FROM inventory_v2.tr_d_penerimaan d 
			JOIN inventory_v2.tr_h_penerimaan h ON d.id_header=h.id_header
			JOIN inventory_v2.ms_header_barang b ON d.id_barang=b.id_header
			JOIN inventory_v2.ms_ukuran u ON d.id_ukuran=u.id_ukuran
			JOIN inventory_v2.tr_h_pembelian hp ON h.id_pembelian=hp.id_header
			JOIN inventory_v2.ms_perusahaan cc ON hp.id_perusahaan=cc.id_perusahaan
			LEFT JOIN (
				SELECT d.id_penerimaan, d.id_barang, SUM(d.jumlah) AS jumlah_terima,satuan,jumlah_harga,h.diskon,h.ongkir
					FROM erp_financev2.gmd_finance_ap_invoice_detail d 
					JOIN erp_financev2.gmd_finance_ap_invoice h ON d.id_ap=h.id
					GROUP BY d.id_barang, d.id_penerimaan
			) t ON d.id_header=t.id_penerimaan AND d.id_barang=t.id_barang
			GROUP BY d.id_barang,d.id_header,hp.`id_perusahaan`
	) terima_barang
	WHERE (jumlah - jumlah_terima) > 0 )  z AND hp.id_perusahaan=50
	GROUP BY z.id_penerimaan,z.id_pembelian
	
	ORDER BY tanggal DESC
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 09:01:57 --> Severity: Notice --> Undefined variable: total_harga /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 477
ERROR - 2020-02-17 10:14:28 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-17 10:14:28 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-17 10:47:43 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-17 10:47:43 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-17 11:08:22 --> Severity: Notice --> Undefined property: stdClass::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 905
ERROR - 2020-02-17 11:08:22 --> Severity: Notice --> Undefined property: stdClass::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 905
ERROR - 2020-02-17 11:08:22 --> Severity: Notice --> Undefined property: stdClass::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 905
ERROR - 2020-02-17 11:08:22 --> Severity: Notice --> Undefined property: stdClass::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 905
ERROR - 2020-02-17 11:08:22 --> Severity: Notice --> Undefined property: stdClass::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 905
ERROR - 2020-02-17 11:08:22 --> Severity: Notice --> Undefined property: stdClass::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 905
ERROR - 2020-02-17 11:08:30 --> Severity: Notice --> Undefined property: stdClass::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 905
ERROR - 2020-02-17 11:08:30 --> Severity: Notice --> Undefined property: stdClass::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 905
ERROR - 2020-02-17 11:08:30 --> Severity: Notice --> Undefined property: stdClass::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 905
ERROR - 2020-02-17 11:08:30 --> Severity: Notice --> Undefined property: stdClass::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 905
ERROR - 2020-02-17 11:08:30 --> Severity: Notice --> Undefined property: stdClass::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 905
ERROR - 2020-02-17 11:08:30 --> Severity: Notice --> Undefined property: stdClass::$id_penerimaan /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 905
ERROR - 2020-02-17 11:14:39 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-17 11:14:39 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-17 11:26:15 --> Severity: Notice --> Undefined property: stdClass::$ukuran /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 752
ERROR - 2020-02-17 11:26:15 --> Severity: Notice --> Undefined property: stdClass::$ukuran /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 753
ERROR - 2020-02-17 11:26:15 --> Severity: Notice --> Undefined property: stdClass::$ukuran /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 752
ERROR - 2020-02-17 11:26:15 --> Severity: Notice --> Undefined property: stdClass::$ukuran /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 753
ERROR - 2020-02-17 11:26:15 --> Severity: Notice --> Undefined property: stdClass::$ukuran /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 752
ERROR - 2020-02-17 11:26:15 --> Severity: Notice --> Undefined property: stdClass::$ukuran /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 753
ERROR - 2020-02-17 11:26:15 --> Severity: Notice --> Undefined property: stdClass::$ukuran /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 752
ERROR - 2020-02-17 11:26:15 --> Severity: Notice --> Undefined property: stdClass::$ukuran /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 753
ERROR - 2020-02-17 11:32:52 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-17 11:32:52 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-17 04:46:19 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-17 04:46:19 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-17 04:46:19 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-17 04:46:19 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-17 04:46:19 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-17 14:08:49 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-17 14:08:49 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-17 07:12:09 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-17 07:12:09 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-17 07:12:09 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-17 07:12:10 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-17 07:12:10 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:12:26 --> Severity: Notice --> Undefined variable: id_kas /data/www/html/erpsmg/finance_gmedia/application/views/finance_coa_general_ledger/index.php 46
ERROR - 2020-02-17 14:13:18 --> Query error: Unknown column 'a.id_penerimaan' in 'field list' - Invalid query: SELECT
		a.id AS id,a.`nomor`,a.`tanggal`,a.`date_due`,a.`supplier`,d.`nama`,a.`no_referensi`,
		a.`potongan`,a.`materai`,a.`ppn`,a.`pph`,a.`jumlah`,a.`lain2`,a.`pajak`,
		a.`id_penerimaan`,a.`id_pembelian`,b.`id_barang`,c.`nama_barang`,b.`jumlah` AS jml_barang,b.`satuan`,b.`jumlah_harga`
	  FROM
		erp_financev2.`gmd_finance_ap_invoice` a
		INNER JOIN erp_financev2.`gmd_finance_ap_invoice_detail` b
		  ON a.`id` = b.`id_ap`
		INNER JOIN inventory_v2.`ms_header_barang` c ON c.`id_header`=b.`id_barang`
		INNER JOIN inventory_v2.`ms_perusahaan` d ON a.`supplier`=d.`id_perusahaan`
		WHERE a.`status`=1 AND a.`lunas` =0 AND a.`id` = 10
ERROR - 2020-02-17 07:24:07 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-17 07:24:07 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-17 07:24:07 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-17 07:24:07 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-17 07:24:07 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-17 15:29:29 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-17 15:29:29 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-17 08:43:50 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-17 08:43:50 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-17 08:43:50 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-17 08:43:50 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-17 08:43:50 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-17 16:33:52 --> Severity: Notice --> Undefined offset: 8 /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 159
ERROR - 2020-02-17 16:54:52 --> Query error: Unknown column 'a.id_penerimaan' in 'field list' - Invalid query: SELECT
		a.id AS id,a.`nomor`,a.`tanggal`,a.`date_due`,a.`supplier`,d.`nama`,a.`no_referensi`,
		a.`potongan`,a.`materai`,a.`ppn`,a.`pph`,a.`jumlah`,a.`lain2`,a.`pajak`,
		a.`id_penerimaan`,a.`id_pembelian`,b.`id_barang`,c.`nama_barang`,b.`jumlah` AS jml_barang,b.`satuan`,b.`jumlah_harga`
	  FROM
		erp_financev2.`gmd_finance_ap_invoice` a
		INNER JOIN erp_financev2.`gmd_finance_ap_invoice_detail` b
		  ON a.`id` = b.`id_ap`
		INNER JOIN inventory_v2.`ms_header_barang` c ON c.`id_header`=b.`id_barang`
		INNER JOIN inventory_v2.`ms_perusahaan` d ON a.`supplier`=d.`id_perusahaan`
		WHERE a.`status`=1 AND a.`lunas` =0 AND a.`id` = 14
ERROR - 2020-02-17 23:52:33 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-17 23:52:33 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-17 23:57:55 --> Severity: error --> Exception: syntax error, unexpected 'echo' (T_ECHO), expecting ';' /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 299
