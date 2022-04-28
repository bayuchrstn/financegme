<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-01-30 00:35:03 --> Severity: error --> Exception: syntax error, unexpected '"' /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_dismantle.php 24
ERROR - 2020-01-30 00:35:04 --> Severity: error --> Exception: syntax error, unexpected '"' /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_dismantle.php 24
ERROR - 2020-01-30 00:36:25 --> Severity: error --> Exception: syntax error, unexpected ''.$this->input->post('' (T_CONSTANT_ENCAPSED_STRING) /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_dismantle.php 24
ERROR - 2020-01-30 00:36:26 --> Severity: error --> Exception: syntax error, unexpected ''.$this->input->post('' (T_CONSTANT_ENCAPSED_STRING) /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_dismantle.php 24
ERROR - 2020-01-30 00:36:26 --> Severity: error --> Exception: syntax error, unexpected ''.$this->input->post('' (T_CONSTANT_ENCAPSED_STRING) /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_dismantle.php 24
ERROR - 2020-01-30 00:37:10 --> Severity: error --> Exception: syntax error, unexpected '$_POST' (T_VARIABLE) /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_dismantle.php 29
ERROR - 2020-01-30 00:37:11 --> Severity: error --> Exception: syntax error, unexpected '$_POST' (T_VARIABLE) /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_dismantle.php 29
ERROR - 2020-01-30 00:37:12 --> Severity: error --> Exception: syntax error, unexpected '$_POST' (T_VARIABLE) /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_dismantle.php 29
ERROR - 2020-01-30 00:37:26 --> Severity: error --> Exception: syntax error, unexpected '<' /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_dismantle.php 72
ERROR - 2020-01-30 00:37:44 --> Query error: Unknown column 'a.nomor' in 'order clause' - Invalid query: SELECT SQL_CALC_FOUND_ROWS 
        b.`id`,  
          d.`idcust`,
          d.`nama` as nama_cust,
          a.`sementara`,
          a.`reason`,
          a.`tanggal`,
          a.`timestamp`,
          c.`nama` as nama_site
        FROM
          erp_gmedia.`dismantle` a
          JOIN erp_gmedia.`order_header` b
            ON a.`id_order` = b.`id`
          JOIN erp_gmedia.`ms_site` c
            ON b.`id_site` = c.`id`
          JOIN erp_gmedia.`ms_customers` d
            ON c.`id_cust` = d.`id`
        WHERE a.`status` = 2 AND
        (
            `c`.`nama` LIKE '%%' ESCAPE '!'
            OR `d`.`idcust` LIKE '%%' ESCAPE '!'
            OR `d`.`nama` LIKE '%%' ESCAPE '!'
            OR `a`.`reason` LIKE '%%' ESCAPE '!'
          )  AND (a.`tanggal` BETWEEN '2020-01-01' AND '2020-01-31') GROUP BY a.`id`  ORDER BY a.nomor asc  LIMIT 0,100
ERROR - 2020-01-30 00:37:54 --> Query error: Unknown column 'a.nomor' in 'order clause' - Invalid query: SELECT SQL_CALC_FOUND_ROWS 
        b.`id`,  
          d.`idcust`,
          d.`nama` as nama_cust,
          a.`sementara`,
          a.`reason`,
          a.`tanggal`,
          a.`timestamp`,
          c.`nama` as nama_site
        FROM
          erp_gmedia.`dismantle` a
          JOIN erp_gmedia.`order_header` b
            ON a.`id_order` = b.`id`
          JOIN erp_gmedia.`ms_site` c
            ON b.`id_site` = c.`id`
          JOIN erp_gmedia.`ms_customers` d
            ON c.`id_cust` = d.`id`
        WHERE a.`status` = 2 AND
        (
            `c`.`nama` LIKE '%%' ESCAPE '!'
            OR `d`.`idcust` LIKE '%%' ESCAPE '!'
            OR `d`.`nama` LIKE '%%' ESCAPE '!'
            OR `a`.`reason` LIKE '%%' ESCAPE '!'
          )  AND (a.`tanggal` BETWEEN '2020-01-01' AND '2020-01-31') GROUP BY a.`id`  ORDER BY a.nomor asc  LIMIT 0,100
ERROR - 2020-01-30 07:11:06 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-30 07:11:06 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-30 08:25:02 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-30 08:25:02 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-30 08:27:45 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-30 08:27:45 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-30 01:31:38 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-30 01:31:38 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-30 01:31:38 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-01-30 01:31:38 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-30 01:31:38 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-30 08:32:39 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
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
ERROR - 2020-01-30 08:32:39 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
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
ERROR - 2020-01-30 08:32:42 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
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
ERROR - 2020-01-30 01:33:25 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-30 01:33:25 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-30 01:33:25 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-01-30 01:33:25 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-30 01:33:25 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-30 08:40:34 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2020-01-30 08:53:28 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2020-01-30 09:19:13 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-30 09:19:13 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-30 09:21:09 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2020-01-30 09:39:03 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
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
ERROR - 2020-01-30 09:39:07 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
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
ERROR - 2020-01-30 09:39:58 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
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
ERROR - 2020-01-30 09:40:02 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
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
ERROR - 2020-01-30 09:40:09 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
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
ERROR - 2020-01-30 09:50:32 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1062
ERROR - 2020-01-30 09:50:32 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1063
ERROR - 2020-01-30 09:50:32 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1064
ERROR - 2020-01-30 09:50:35 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1062
ERROR - 2020-01-30 09:50:35 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1063
ERROR - 2020-01-30 09:50:35 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1064
ERROR - 2020-01-30 09:50:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1062
ERROR - 2020-01-30 09:50:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1063
ERROR - 2020-01-30 09:50:36 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1064
ERROR - 2020-01-30 09:50:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1062
ERROR - 2020-01-30 09:50:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1063
ERROR - 2020-01-30 09:50:38 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1064
ERROR - 2020-01-30 09:50:41 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1062
ERROR - 2020-01-30 09:50:41 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1063
ERROR - 2020-01-30 09:50:41 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1064
ERROR - 2020-01-30 09:59:07 --> Query error: Unknown column 'z.urutan' in 'order clause' - Invalid query: SELECT SQL_CALC_FOUND_ROWS 
        b.`id`,  
          d.`idcust`,
          d.`nama` as nama_cust,
          a.`sementara`,
          a.`reason`,
          a.`tanggal`,
          a.`timestamp`,
          c.`nama` as nama_site
        FROM
          erp_gmedia.`dismantle` a
          JOIN erp_gmedia.`order_header` b
            ON a.`id_order` = b.`id`
          JOIN erp_gmedia.`ms_site` c
            ON b.`id_site` = c.`id`
          JOIN erp_gmedia.`ms_customers` d
            ON c.`id_cust` = d.`id`
        WHERE a.`status` = 2 AND
        (
            `c`.`nama` LIKE '%ask%' ESCAPE '!'
            OR `d`.`idcust` LIKE '%ask%' ESCAPE '!'
            OR `d`.`nama` LIKE '%ask%' ESCAPE '!'
            OR `a`.`reason` LIKE '%ask%' ESCAPE '!'
          )  AND (a.`tanggal` BETWEEN '2020-01-01' AND '2020-01-31') GROUP BY a.`id`  ORDER BY z.urutan ASC  LIMIT 0,100
ERROR - 2020-01-30 09:59:10 --> Query error: Unknown column 'z.urutan' in 'order clause' - Invalid query: SELECT SQL_CALC_FOUND_ROWS 
        b.`id`,  
          d.`idcust`,
          d.`nama` as nama_cust,
          a.`sementara`,
          a.`reason`,
          a.`tanggal`,
          a.`timestamp`,
          c.`nama` as nama_site
        FROM
          erp_gmedia.`dismantle` a
          JOIN erp_gmedia.`order_header` b
            ON a.`id_order` = b.`id`
          JOIN erp_gmedia.`ms_site` c
            ON b.`id_site` = c.`id`
          JOIN erp_gmedia.`ms_customers` d
            ON c.`id_cust` = d.`id`
        WHERE a.`status` = 2 AND
        (
            `c`.`nama` LIKE '%ask%' ESCAPE '!'
            OR `d`.`idcust` LIKE '%ask%' ESCAPE '!'
            OR `d`.`nama` LIKE '%ask%' ESCAPE '!'
            OR `a`.`reason` LIKE '%ask%' ESCAPE '!'
          )  AND (a.`tanggal` BETWEEN '2020-01-01' AND '2020-01-31') GROUP BY a.`id`  ORDER BY z.urutan ASC  LIMIT 0,100
ERROR - 2020-01-30 11:23:41 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
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
ERROR - 2020-01-30 11:54:22 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-30 11:54:22 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-30 14:07:39 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
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
ERROR - 2020-01-30 14:08:05 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
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
ERROR - 2020-01-30 14:10:00 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
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
ERROR - 2020-01-30 07:13:16 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-30 07:13:16 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-30 07:13:16 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-01-30 07:13:16 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-01-30 07:13:16 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-01-30 14:13:23 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
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
ERROR - 2020-01-30 14:13:35 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
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
ERROR - 2020-01-30 14:14:46 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
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
ERROR - 2020-01-30 14:15:29 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') b
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
ERROR - 2020-01-30 17:12:28 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-30 17:12:28 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-30 19:17:54 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-30 19:17:54 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-30 21:32:44 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-30 21:32:44 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-30 14:32:59 --> 404 Page Not Found: Assets/invoice
ERROR - 2020-01-30 14:33:00 --> 404 Page Not Found: Assets/invoice
ERROR - 2020-01-30 15:15:56 --> 404 Page Not Found: Assets/invoice
ERROR - 2020-01-30 22:15:56 --> Query error: Unknown column 'f.id_arpost' in 'on clause' - Invalid query: SELECT `d`.`nama` AS `site`, `b`.`id_cust`, `b`.`cashback`, `e`.`id` AS `id_trx`, `a`.*, CASE WHEN e.status=1 THEN 'Belum' WHEN e.status=2 THEN 'Lunas' END AS status_bayar, `e`.`tanggal` AS `tanggal`
FROM `cashback_usage` `a`
INNER JOIN `cashback` `b` ON `a`.`id_cashback`=`b`.`id`
INNER JOIN `order_header` `c` ON `c`.`id`=`a`.`id_order`
INNER JOIN `ms_site` `d` ON `d`.`id`=`c`.`id_site`
INNER JOIN `cashback_transaksi` `e` ON `e`.`id_cashback_usage`=`a`.`id`
INNER JOIN `erp_finance`.`gmd_finance_invoice_customer_detail` `f` ON `f`.`id_arpost`=`e`.`id_arpost`
INNER JOIN `erp_finance`.`gmd_finance_invoice_customer` `g` ON `f`.`no_invoice`=`g`.`id`
WHERE   (
`d`.`nama` LIKE '%%' ESCAPE '!'
AND  `a`.`pic` LIKE '%%' ESCAPE '!'
 )
AND `a`.`status` != "9" AND `b`.`status` = "2" AND `g`.`lunas` = "1"
AND `e`.`status` = '1'
AND (e.tanggal between '2020-01-01' and '2020-01-31')
ORDER BY `d`.`nama` ASC
 LIMIT 100
ERROR - 2020-01-30 22:16:03 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-01-30 22:16:03 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
