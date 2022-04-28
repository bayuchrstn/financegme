<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-01-27 08:19:11 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-27 08:19:11 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-27 01:24:20 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-27 01:24:20 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-27 01:24:20 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-01-27 01:24:20 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-27 01:24:20 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-27 08:27:01 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-27 08:27:01 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-27 01:28:39 --> 404 Page Not Found: Assets/js
ERROR - 2020-01-27 08:35:09 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-27 08:35:09 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-27 02:02:09 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-27 02:02:09 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-27 02:02:09 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-01-27 02:02:09 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-27 02:02:09 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-27 02:33:55 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-27 02:33:55 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-27 02:33:55 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-01-27 02:33:55 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-27 02:33:55 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-27 09:37:12 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2020-01-27 09:53:14 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-27 09:53:14 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-27 03:03:02 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-27 03:03:02 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-27 03:03:02 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-01-27 03:03:02 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-27 03:03:02 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-27 10:09:48 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 484
ERROR - 2020-01-27 04:22:45 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-27 04:22:45 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-27 04:22:45 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-01-27 04:22:45 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-27 04:22:45 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-27 04:31:14 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-27 04:31:14 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-27 04:31:14 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-01-27 04:31:14 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-27 04:31:14 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-27 13:25:37 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:25:37 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:25:42 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:25:42 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:25:47 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:25:47 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:27:51 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:27:51 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:29:25 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:29:53 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:29:53 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:36:23 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:36:23 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:45:39 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:45:39 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:46:42 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:46:43 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 06:50:06 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-27 06:50:06 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-27 06:50:06 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-01-27 06:50:06 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-27 06:50:06 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-27 13:50:29 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:50:29 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:50:36 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:50:36 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:52:36 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:52:36 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:54:09 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:54:09 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:54:36 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:54:36 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:56:37 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:56:37 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:58:10 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:58:10 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:59:12 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 13:59:12 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 14:00:07 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 14:00:07 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 14:02:48 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 14:02:48 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 14:03:59 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 14:03:59 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 14:05:01 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 14:05:01 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 14:05:28 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 14:05:28 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 14:07:49 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 14:07:49 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 14:07:55 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 14:08:40 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 14:08:41 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_baran' at line 83 - Invalid query: SELECT * FROM (SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,SUM(
			IF(
			  z.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / z.`qty_konversi`))
			)
		  ) AS jumlah,
		  z.`ukuran`,
		  z.`harga`,
		  z.`diskon`,
		  z.`ongkir`,
		SUM(
			  IF(
				z.`qty_konversi` IS NULL,
				z.`qty`,
				ROUND((z.`qty` / z.`qty_konversi`))
		)* z.`harga`) AS total,
		  z.`keterangan`
	  FROM
		(SELECT
		  d.`id_header`,
		  h.`nomor`,
		  h.`tanggal`,
		  h.`id_pembelian`,
		  b.`id_perusahaan`,
		  b.`supplier`,
		  b.`nomor_po`,
		  b.`tgl_pembelian`,
		  d.`id_barang`,
		  br.`nama_barang`,
		  k.`qty_konversi`,
		  d.`qty`,
		  (SELECT
			nama_ukuran
		  FROM
		  inventory_v2.`ms_ukuran` p
		  WHERE p.`id_ukuran` = d.`id_ukuran`) ukuran,
		  b.`harga`,
		  b.`diskon`,
		  b.`ongkir`,
		  b.`keterangan`
		FROM
		  inventory_v2.`tr_d_penerimaan` d
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		  JOIN inventory_v2.`tr_h_penerimaan` h
			ON d.`id_header` = h.`id_header`
		  LEFT JOIN inventory_v2.`ms_konversi` k
			ON d.`id_barang` = k.`id_barang`
		  JOIN
			(SELECT
			  d.`id_header` AS id_pembelian,
			  h.`id_perusahaan`,
			  p.`nama` AS supplier,
			  h.`nomor` AS nomor_po,
			  h.`tanggal` AS tgl_pembelian,
			  d.`id_barang`,
			  d.`harga`,
			  h.`diskon`,
			  h.`ongkir`,
			  d.`total`,
			  IF(
				h.`keterangan` IS NOT NULL,
				h.`keterangan`,
				''
			  ) AS keterangan
			FROM
			  inventory_v2.`tr_d_pembelian` d
			  JOIN inventory_v2.`tr_h_pembelian` h
				ON d.`id_header` = h.`id_header`
			  JOIN inventory_v2.`ms_perusahaan` p
				ON h.`id_perusahaan` = p.`id_perusahaan`
			WHERE p.`id_perusahaan`=) b
			ON h.`id_pembelian` = b.`id_pembelian`
			AND d.`id_barang` = b.`id_barang`
		WHERE br.`flag`='B') z
	  GROUP BY id_header
	  UNION ALL 
	  SELECT
		z.`id_header`,
		z.`nomor`,
		z.`tanggal`,
		z.`id_pembelian`,
		z.`id_perusahaan`,
		z.`supplier`,
		z.`nomor_po`,
		z.`tgl_pembelian`,
		z.`id_barang`,
		z.`nama_barang`,
		SUM(
		  IF(
			k.`qty_konversi` IS NULL,
			z.`qty`,
			ROUND((z.`qty` / k.`qty_konversi`))
		  )
		) AS jumlah,
		(SELECT
		  nama_ukuran
		FROM
		inventory_v2.`ms_ukuran` p
		WHERE p.`id_ukuran` = z.`id_ukuran`) ukuran,
		z.`harga`,
		z.`diskon`,
		z.`ongkir`,
		SUM(
			IF(
			  k.`qty_konversi` IS NULL,
			  z.`qty`,
			  ROUND((z.`qty` / k.`qty_konversi`))
		) * z.`harga`)AS total,
		z.`keterangan`
	  FROM
		(SELECT
		  NULL AS id_header,
		  NULL AS nomor,
		  h.`tanggal` AS tanggal,
		  d.`id_header` AS id_pembelian,
		  h.`id_perusahaan`,
		  p.`nama` AS supplier,
		  h.`nomor` AS nomor_po,
		  h.`tanggal` AS tgl_pembelian,
		  d.`id_barang`,
		  br.`nama_barang`,
		  d.`harga`,
		  h.`diskon`,
		  h.`ongkir`,
		  d.`id_ukuran`,
		  d.`qty`,
		  d.`total`,
		  IF(
			h.`keterangan` IS NOT NULL,
			h.`keterangan`,
			''
		  ) AS keterangan
		FROM
		  inventory_v2.`tr_d_pembelian` d
		  JOIN inventory_v2.`tr_h_pembelian` h
			ON d.`id_header` = h.`id_header`
		  JOIN inventory_v2.`ms_perusahaan` p
			ON h.`id_perusahaan` = p.`id_perusahaan`
		  JOIN inventory_v2.`ms_header_barang` br
			ON d.`id_barang` = br.`id_header`
		WHERE p.`id_perusahaan`= AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-01-27 14:24:09 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-27 14:24:09 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-27 14:24:27 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-27 14:24:27 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-27 07:24:49 --> 404 Page Not Found: Assets/js
ERROR - 2020-01-27 14:25:13 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-27 14:25:13 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-27 14:47:08 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-27 14:47:08 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-27 14:47:23 --> Severity: Notice --> Undefined variable: piutang /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 902
ERROR - 2020-01-27 15:25:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:46 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:46 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:46 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:46 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:46 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:46 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:46 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:46 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:46 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:46 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:46 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:46 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:46 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:46 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:46 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:46 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:46 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:46 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:47 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:47 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:47 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:47 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:47 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:47 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:47 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:47 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:47 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:47 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:47 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:47 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:47 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:47 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:47 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:47 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:47 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:47 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:48 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:49 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:49 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:49 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:49 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:49 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:49 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:49 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:49 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:49 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:49 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:49 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:49 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:49 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:49 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:49 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:50 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:50 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:50 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:50 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:50 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:50 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:50 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:50 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:50 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:50 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:50 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:50 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:50 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:50 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:50 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:50 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:50 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:50 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:50 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:50 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:50 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:52 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:52 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:52 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:52 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:52 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:52 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:52 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:52 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:52 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:55 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:25:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:25:57 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /data/www/html/erpsmg/finance_gmedia/system/core/Exceptions.php:271) /data/www/html/erpsmg/finance_gmedia/system/helpers/url_helper.php 564
ERROR - 2020-01-27 08:26:01 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-27 08:26:01 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-01-27 08:26:01 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-27 08:26:01 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-27 08:26:01 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-27 15:27:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:32 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:32 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:32 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:32 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:32 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:32 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:32 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:32 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:32 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:32 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:32 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:32 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:32 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:32 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:32 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:32 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:32 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:32 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:33 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:33 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:33 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:33 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:33 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:33 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:34 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:34 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:34 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:34 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:34 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:34 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:34 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:34 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:34 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:34 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:34 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:34 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:34 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:34 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:34 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:37 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:37 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:37 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:37 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:37 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:37 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:37 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:37 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:37 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:39 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1760
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1761
ERROR - 2020-01-27 15:27:40 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/controllers/Finance_invoice_customer.php 1777
ERROR - 2020-01-27 15:27:40 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /data/www/html/erpsmg/finance_gmedia/system/core/Exceptions.php:271) /data/www/html/erpsmg/finance_gmedia/system/helpers/url_helper.php 564
ERROR - 2020-01-27 08:27:41 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-27 08:27:41 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-27 08:27:41 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-01-27 08:27:41 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-27 08:27:41 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-27 15:33:40 --> Query error: Data too long for column 'jml_piutang' at row 1 - Invalid query: UPDATE `arpost` SET `jml_piutang` = 17391999.82
WHERE `id` = '22548'
ERROR - 2020-01-27 15:33:45 --> Query error: Data too long for column 'jml_piutang' at row 1 - Invalid query: UPDATE `arpost` SET `jml_piutang` = 17391999.82
WHERE `id` = '22549'
ERROR - 2020-01-27 08:34:17 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-27 08:34:17 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-27 08:34:17 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-01-27 08:34:17 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-27 08:34:17 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-27 15:34:37 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1062
ERROR - 2020-01-27 15:34:37 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1063
ERROR - 2020-01-27 15:34:37 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1064
ERROR - 2020-01-27 15:34:44 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1062
ERROR - 2020-01-27 15:34:44 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1063
ERROR - 2020-01-27 15:34:44 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1064
ERROR - 2020-01-27 15:34:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1062
ERROR - 2020-01-27 15:34:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1063
ERROR - 2020-01-27 15:34:45 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1064
ERROR - 2020-01-27 15:34:46 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1062
ERROR - 2020-01-27 15:34:46 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1063
ERROR - 2020-01-27 15:34:46 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1064
ERROR - 2020-01-27 15:34:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1062
ERROR - 2020-01-27 15:34:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1063
ERROR - 2020-01-27 15:34:56 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1064
ERROR - 2020-01-27 16:15:59 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-27 16:15:59 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-27 16:23:27 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 484
ERROR - 2020-01-27 16:37:39 --> Severity: Notice --> A non well formed numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 564
ERROR - 2020-01-27 16:37:39 --> Severity: Notice --> A non well formed numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 582
ERROR - 2020-01-27 16:37:43 --> Severity: Notice --> A non well formed numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 564
ERROR - 2020-01-27 16:37:43 --> Severity: Notice --> A non well formed numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 582
ERROR - 2020-01-27 16:38:01 --> Severity: Notice --> A non well formed numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 564
ERROR - 2020-01-27 16:38:01 --> Severity: Notice --> A non well formed numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 582
ERROR - 2020-01-27 16:38:16 --> Severity: Notice --> A non well formed numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 564
ERROR - 2020-01-27 16:38:16 --> Severity: Notice --> A non well formed numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 582
ERROR - 2020-01-27 16:41:17 --> Severity: Notice --> A non well formed numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 564
ERROR - 2020-01-27 16:41:17 --> Severity: Notice --> A non well formed numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 582
ERROR - 2020-01-27 16:42:54 --> Severity: Notice --> A non well formed numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 564
ERROR - 2020-01-27 16:42:54 --> Severity: Notice --> A non well formed numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 582
ERROR - 2020-01-27 16:49:47 --> Severity: Notice --> A non well formed numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 564
ERROR - 2020-01-27 16:49:47 --> Severity: Notice --> A non well formed numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 582
ERROR - 2020-01-27 16:57:06 --> Severity: Notice --> A non well formed numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 564
ERROR - 2020-01-27 16:57:06 --> Severity: Notice --> A non well formed numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 582
ERROR - 2020-01-27 16:57:10 --> Severity: Notice --> A non well formed numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 564
ERROR - 2020-01-27 16:57:10 --> Severity: Notice --> A non well formed numeric value encountered /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 582
