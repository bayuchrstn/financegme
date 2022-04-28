<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-02-04 08:16:26 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-04 08:16:26 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-04 08:16:51 --> Severity: error --> Exception: Call to undefined method CI_DB_mysqli_driver::row() /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_transaksi_kas_kecil.php 404
ERROR - 2020-02-04 08:18:47 --> Severity: error --> Exception: Call to undefined method CI_DB_mysqli_driver::row() /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_transaksi_kas_kecil.php 404
ERROR - 2020-02-04 08:20:49 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-04 08:20:49 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-04 08:28:06 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-04 08:28:06 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-04 08:58:27 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-04 08:58:27 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-04 09:28:09 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-04 09:28:09 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-04 09:59:39 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-04 09:59:39 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-04 03:04:36 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-04 03:04:36 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-04 03:04:36 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-04 03:04:36 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-04 03:04:36 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-04 10:23:38 --> Severity: error --> Exception: syntax error, unexpected '=>' (T_DOUBLE_ARROW), expecting ')' /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 404
ERROR - 2020-02-04 10:23:40 --> Severity: error --> Exception: syntax error, unexpected '=>' (T_DOUBLE_ARROW), expecting ')' /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_billing.php 404
ERROR - 2020-02-04 10:24:09 --> Query error: Unknown column 'a.deskripsi' in 'order clause' - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.*,
		DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya,
		DATE_FORMAT(a.date_due, '%d-%m-%Y') AS date_duenya,
		IF(a.supplier = 0, 'LAIN2', b.nama) AS nama_sup
	  FROM
		erp_financev2.`gmd_finance_ap_invoice` a
		LEFT JOIN  inventory_v2.`ms_perusahaan` b
		  ON `a`.`supplier` = `b`.`id_perusahaan`
	  WHERE (
		`a`.`no_referensi` LIKE '%%' ESCAPE '!'
            OR `a`.`nomor` LIKE '%%' ESCAPE '!'
			OR `b`.`nama` LIKE '%%' ESCAPE '!'
		)
		AND (
			a.`insert_at` BETWEEN '2020-02-01'
            AND '2020-02-29'
		)
		AND `a`.`branch` = '8'
	  ORDER BY a.deskripsi asc  LIMIT 0,100
ERROR - 2020-02-04 10:24:20 --> Query error: Unknown column 'a.deskripsi' in 'order clause' - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.*,
		DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya,
		DATE_FORMAT(a.date_due, '%d-%m-%Y') AS date_duenya,
		IF(a.supplier = 0, 'LAIN2', b.nama) AS nama_sup
	  FROM
		erp_financev2.`gmd_finance_ap_invoice` a
		LEFT JOIN  inventory_v2.`ms_perusahaan` b
		  ON `a`.`supplier` = `b`.`id_perusahaan`
	  WHERE (
		`a`.`no_referensi` LIKE '%%' ESCAPE '!'
            OR `a`.`nomor` LIKE '%%' ESCAPE '!'
			OR `b`.`nama` LIKE '%%' ESCAPE '!'
		)
		AND (
			a.`insert_at` BETWEEN '2020-02-01'
            AND '2020-02-29'
		)
		AND `a`.`branch` = '8'
	  ORDER BY a.deskripsi desc  LIMIT 0,100
ERROR - 2020-02-04 10:25:07 --> Query error: SELECT command denied to user 'erp'@'103.255.240.2' for table 'billing' - Invalid query: SELECT
		*,f.`nama` AS `nama_kat_gl`,b.`id` AS no_arpost,e.`nama` AS nama_coa,a.`ppn` AS ppnnya,g.`id` AS card_id,g.`nama` AS card_nama
	  FROM
		rp_gmedia.`billing` a
		 JOIN erp_gmedia.`arpost` b
		  ON a.`id_arpost` = b.`id`
		 JOIN erp_financev2.`gmd_finance_coa_general_ledger` c
		  ON a.`id_gl`=c.`no_trans`
		   JOIN erp_financev2.`gmd_finance_coa_general_ledger_detail` d
		  ON a.`id_gl`=d.`no_trans`
		  JOIN erp_financev2.`gmd_finance_coa` e
	ON d.`id_biaya`=e.`id`
	JOIN erp_financev2.`gmd_finance_master_kat_gl` f
	ON c.`kat_gl`=f.`id`
	JOIN erp_financev2.`gmd_finance_coa_card_name` g
	ON d.`card_id`=g.`id` WHERE a.`id`=52 AND d.`kredit`<1 
ERROR - 2020-02-04 10:36:20 --> Query error: Unknown column 'a.deskripsi' in 'order clause' - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.*,
		DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya,
		DATE_FORMAT(a.date_due, '%d-%m-%Y') AS date_duenya,
		IF(a.supplier = 0, 'LAIN2', b.nama) AS nama_sup
	  FROM
		erp_financev2.`gmd_finance_ap_invoice` a
		LEFT JOIN  inventory_v2.`ms_perusahaan` b
		  ON `a`.`supplier` = `b`.`id_perusahaan`
	  WHERE (
		`a`.`no_referensi` LIKE '%%' ESCAPE '!'
            OR `a`.`nomor` LIKE '%%' ESCAPE '!'
			OR `b`.`nama` LIKE '%%' ESCAPE '!'
		)
		AND (
			a.`insert_at` BETWEEN '2020-02-01'
            AND '2020-02-29'
		)
		AND `a`.`branch` = '8'
	  ORDER BY a.deskripsi asc  LIMIT 0,100
ERROR - 2020-02-04 10:36:45 --> Severity: Notice --> Undefined offset: 7 /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 15
ERROR - 2020-02-04 10:36:51 --> Query error: Unknown column 'a.deskripsi' in 'order clause' - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.*,
		DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya,
		DATE_FORMAT(a.date_due, '%d-%m-%Y') AS date_duenya,
		IF(a.supplier = 0, 'LAIN2', b.nama) AS nama_sup
	  FROM
		erp_financev2.`gmd_finance_ap_invoice` a
		LEFT JOIN  inventory_v2.`ms_perusahaan` b
		  ON `a`.`supplier` = `b`.`id_perusahaan`
	  WHERE (
		`a`.`no_referensi` LIKE '%%' ESCAPE '!'
            OR `a`.`nomor` LIKE '%%' ESCAPE '!'
			OR `b`.`nama` LIKE '%%' ESCAPE '!'
		)
		AND (
			a.`insert_at` BETWEEN '2020-02-01'
            AND '2020-02-29'
		)
		AND `a`.`branch` = '8'
	  ORDER BY a.deskripsi asc  LIMIT 0,100
ERROR - 2020-02-04 10:36:55 --> Severity: Notice --> Undefined offset: 7 /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_ap_invoice.php 15
ERROR - 2020-02-04 03:46:59 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-04 03:46:59 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-04 03:46:59 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-04 03:46:59 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-04 03:46:59 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-04 03:57:31 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-04 03:57:31 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-04 03:57:31 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-04 03:57:31 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-04 03:57:31 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-04 11:04:47 --> Query error: SELECT command denied to user 'erp'@'103.255.240.2' for table 'tr_d_penerimaan' - Invalid query: SELECT * FROM (SELECT
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
		  nventory_v2.`tr_d_penerimaan` d
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
			WHERE p.`id_perusahaan`=73) b
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
		WHERE p.`id_perusahaan`=73 AND NOT EXISTS (SELECT a.`id_header` FROM inventory_v2.`tr_h_penerimaan` a
        JOIN inventory_v2.`tr_d_penerimaan` c
        ON a.`id_header`=c.`id_header`
        JOIN inventory_v2.`ms_header_barang` b
          ON c.`id_barang` = b.`id_header`
      WHERE a.`id_pembelian` = d.`id_header`)) z
    LEFT JOIN inventory_v2.`ms_konversi` k
		  ON z.`id_barang` = k.`id_barang`
		  GROUP BY z.`id_pembelian`) X ORDER BY x.`tanggal` DESC
ERROR - 2020-02-04 11:23:55 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 484
ERROR - 2020-02-04 04:28:36 --> 404 Page Not Found: Assets/invoice
ERROR - 2020-02-04 11:28:36 --> Query error: Unknown column 'f.id_arpost' in 'on clause' - Invalid query: SELECT `d`.`nama` AS `site`, `b`.`id_cust`, `b`.`cashback`, `e`.`id` AS `id_trx`, `a`.*, CASE WHEN e.status=1 THEN 'Belum' WHEN e.status=2 THEN 'Lunas' END AS status_bayar, `e`.`tanggal` AS `tanggal`
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
AND (e.tanggal between '2020-02-01' and '2020-02-29')
ORDER BY `d`.`nama` ASC
 LIMIT 100
ERROR - 2020-02-04 04:28:42 --> 404 Page Not Found: Assets/invoice
ERROR - 2020-02-04 11:28:42 --> Query error: Unknown column 'f.id_arpost' in 'on clause' - Invalid query: SELECT `d`.`nama` AS `site`, `b`.`id_cust`, `b`.`cashback`, `e`.`id` AS `id_trx`, `a`.*, CASE WHEN e.status=1 THEN 'Belum' WHEN e.status=2 THEN 'Lunas' END AS status_bayar, `e`.`tanggal` AS `tanggal`
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
AND (e.tanggal between '2020-02-01' and '2020-02-29')
ORDER BY `d`.`nama` ASC
 LIMIT 100
ERROR - 2020-02-04 13:31:38 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-04 13:31:38 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-04 14:05:22 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-04 14:05:22 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-04 14:22:30 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-04 14:22:30 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-04 07:58:58 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-04 07:58:58 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-04 07:58:58 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-02-04 07:58:58 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-02-04 07:58:58 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-02-04 15:30:46 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ELECT
        SQL_CALC_FOUND_ROWS *
      FROM
        (SELECT
          a.`' at line 1 - Invalid query: ELECT
        SQL_CALC_FOUND_ROWS *
      FROM
        (SELECT
          a.`id`,
          a.`nomor`,
          RIGHT(a.`nomor`, 10) AS urutan,
          a.`kode`,
          b.`memo` AS deskripsi,
          DATE_FORMAT(a.`tanggal`, '%d-%m-%Y') AS tanggalnya,
          c.`nama` AS nama_divisi,
          COALESCE(b.`nominal`, 0) AS nominal,
          COALESCE(a.`jumlah`, 0) AS total,
          d.`nama` AS nama_kode,
          CASE
            WHEN a.`branch` = 1
            THEN 'Semarang'
            WHEN a.`branch` = 2
            THEN 'Salatiga'
          END AS cabang
        FROM
          `gmd_finance_transaksi_kasir` `a`
          LEFT JOIN `gmd_finance_transaksi_kasir_detail` `b`
            ON `a`.`id` = `b`.`id_kasir`
          LEFT JOIN `gmd_finance_master_divisi` `c`
            ON `a`.`divisi` = `c`.`id`
          LEFT JOIN `gmd_finance_master_kat_gl` `d`
            ON `a`.`kode` = `d`.`id`
        WHERE (
            `b`.`memo` LIKE '%%' ESCAPE '!'
            OR `a`.`nomor` LIKE '%%' ESCAPE '!'
          )
          AND `a`.`status` = '1'
          AND `b`.`status` = '1'
          AND (
            a.`tanggal` BETWEEN '2020-02-01'
            AND '2020-02-29'
          )
        ) z ORDER BY z.urutan ASC  LIMIT 0,100
ERROR - 2020-02-04 23:52:49 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-02-04 23:52:49 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
