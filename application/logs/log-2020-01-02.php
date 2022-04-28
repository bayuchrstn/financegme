<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-01-02 10:56:47 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1053
ERROR - 2020-01-02 10:56:47 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1054
ERROR - 2020-01-02 10:56:47 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1055
ERROR - 2020-01-02 10:56:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1053
ERROR - 2020-01-02 10:56:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1054
ERROR - 2020-01-02 10:56:51 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1055
ERROR - 2020-01-02 10:57:04 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1053
ERROR - 2020-01-02 10:57:04 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1054
ERROR - 2020-01-02 10:57:04 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1055
ERROR - 2020-01-02 11:07:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1053
ERROR - 2020-01-02 11:07:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1054
ERROR - 2020-01-02 11:07:11 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1055
ERROR - 2020-01-02 11:07:13 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1053
ERROR - 2020-01-02 11:07:13 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1054
ERROR - 2020-01-02 11:07:13 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_approval.php 1055
ERROR - 2020-01-02 11:09:11 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 458
ERROR - 2020-01-02 11:09:27 --> Query error: Table 'erp_gmedia.rpost' doesn't exist - Invalid query: SELECT * FROM (SELECT * FROM
		(SELECT
		  d.`id_arpost_merge` AS id,
		  a.`nomor`,
		  a.`tanggal`,
		  DATE_FORMAT(a.`tanggal_invoice`, '%d-%m-%Y') AS tanggalnya,
		  a.`due_date`,
		  b.`nama`,
		  SUM(e.`bw`) AS bw,
		  SUM(e.`lain2`) + e.`materai` AS lain2,
		  SUM(e.`instalasi`) AS instalasi,
		  SUM(e.`ppn`) AS ppn,
		  SUM(e.`total`) + e.`materai` AS total,
		  e.`jml_bayar`,
		  IF(
			SUM(e.`ppn`) = 0,
			'TIDAK',
			IF(
			  SUM(e.`ppn`) > 0,
			  'STANDAR',
			  'SEDERHANA'
			)
		  ) AS jenis_ppn,
		  a.`date_printed`,
		  a.`date_email`,
		  a.`date_faktur`,
		  a.`lunas`,
		  a.`status_invoice`,
		  IF(
			a.`flag` = 1,
			'Langganan',
			IF(
			  a.`flag` = 2,
			  'Project',
			  'Langganan'
			)
		  ) AS flag,
		  e.`status_merge`
		FROM
		  arpost a
		  LEFT JOIN arpost_merge d
			ON a.`id` = d.`id_arpost_merge`
		  LEFT JOIN ms_site b
			ON a.`to_site` = b.`id`
		  LEFT JOIN
			(SELECT
			  z.`id`,
			  SUM(z.`bw`) AS bw,
			  CASE
				WHEN SUM(z.`materai`) >= 6000
				THEN 6000
				WHEN SUM(z.`materai`) < 6000
				THEN SUM(z.`materai`)
			  END AS materai,
			  SUM(z.`lain2`) AS lain2,
			  SUM(z.`ppn2`) AS ppn,
			  SUM(z.`instalasi`) AS instalasi,
			  SUM(z.`bw`) + SUM(z.`lain2`) + SUM(z.`ppn2`) + SUM(z.`instalasi`) AS total,
			  z.`jml_bayar`,
			  z.`date_printed`,
			  z.`date_email`,
			  z.`date_faktur`,
			  z.`merge` AS status_merge
			FROM
			  (SELECT
				a.*,
				CASE
				  WHEN c.`jenis_transaksi` = 'LG'
				  THEN c.`nominal`
				  ELSE 0
				END AS bw,
				CASE
				  WHEN c.`jenis_transaksi` = 'PN'
				  THEN c.`nominal`
				  ELSE 0
				END AS ppn2,
				CASE
				  WHEN c.`jenis_transaksi` = 'BI'
				  THEN c.`nominal`
				  ELSE 0
				END AS instalasi,
				CASE
				  WHEN c.`jenis_transaksi` = 'MT'
				  THEN c.`nominal`
				  ELSE 0
				END AS materai,
				CASE
				  WHEN c.`jenis_transaksi` = 'LG'
				  THEN 0
				  WHEN c.`jenis_transaksi` = 'PN'
				  THEN 0
				  WHEN c.`jenis_transaksi` = 'BI'
				  THEN 0
				  WHEN c.`jenis_transaksi` = 'MT'
				  THEN 0
				  ELSE c.`nominal`
				END AS lain2
			  FROM
				arpost a
				LEFT JOIN ms_site b
				  ON a.`id_site` = b.`id`
				LEFT JOIN transaksi c
				  ON a.`nomor` = c.`nomor`
				  AND a.`id_order` = c.`id_order`
			  WHERE a.`lunas` = 0
				AND a.`status` = 1
				AND c.`status` = 1
				AND a.`merge` = 1  AND a.`tanggal_invoice` BETWEEN '2020-01-01' AND '2020-01-31') z
			GROUP BY z.`id`) e
			ON d.`id_arpost` = e.`id`
		WHERE a.`lunas` = 0  AND a.`tanggal_invoice` BETWEEN '2020-01-01' AND '2020-01-31'
		  AND a.`id_order` IS NULL
		  AND a.`status` = 1
		  AND (a.`status_invoice` = 0 OR a.`status_invoice` = 1)
		GROUP BY d.`id_arpost_merge`) p  WHERE p.`nomor` LIKE '%/GMD-SLTG/%'
	  UNION ALL
	  SELECT * FROM
		(SELECT
		  x.`id`,
		  x.`nomor`,
		  x.`tanggal`,
		  DATE_FORMAT(x.`tanggal_invoice`, '%d-%m-%Y') AS tanggalnya,
		  x.`due_date`,
		  x.`nama`,
		  SUM(x.`bw`) AS bw,
		  CASE
			WHEN SUM(x.`materai`) >= 6000
			THEN SUM(x.`lain2`) + 6000
			WHEN SUM(x.`materai`) < 6000
			THEN SUM(x.`lain2`) + SUM(x.`materai`)
		  END AS lain2,
		  SUM(x.`instalasi`) AS instalasi,
		  SUM(x.`ppn2`) AS ppn,
		  SUM(x.`bw`) + SUM(x.`lain2`) + SUM(x.`ppn2`) + SUM(x.`instalasi`) + SUM(x.`materai`) AS total,
		  x.`jml_bayar`,
		  IF(
			SUM(x.`ppn2`) = 0,
			'TIDAK',
			IF(
			  SUM(x.`ppn2`) > 0,
			  'STANDAR',
			  'SEDERHANA'
			)
		  ) AS jenis_ppn,
		  x.`date_printed`,
		  x.`date_email`,
		  x.`date_faktur`,
		  x.`lunas`,
		  x.`status_invoice`,
		  IF(
			x.`flag` = 1,
			'Langganan',
			IF(
			  x.`flag` = 2,
			  'Project',
			  'Langganan'
			)
		  ) AS flag,
		  0 AS status_merge
		FROM
		  (SELECT
			a.*,
			CASE
			  WHEN b.`nama` IS NULL
			  THEN d.`nama`
			  ELSE b.`nama`
			END AS nama,
			CASE
			  WHEN c.`jenis_transaksi` = 'LG'
			  THEN c.`nominal`
			  ELSE 0
			END AS bw,
			CASE
			  WHEN c.`jenis_transaksi` = 'PN'
			  THEN c.`nominal`
			  ELSE 0
			END AS ppn2,
			CASE
			  WHEN c.`jenis_transaksi` = 'BI'
			  THEN c.`nominal`
			  ELSE 0
			END AS instalasi,
			CASE
			  WHEN c.`jenis_transaksi` = 'MT'
			  THEN c.`nominal`
			  ELSE 0
			END AS materai,
			CASE
			  WHEN c.`jenis_transaksi` = 'LG'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'PN'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'BI'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'MT'
			  THEN 0
			  ELSE c.`nominal`
			END AS lain2
		  FROM
			rpost a
			LEFT JOIN ms_site b
			  ON a.`id_site` = b.`id`
			LEFT JOIN transaksi c
			  ON a.`nomor` = c.`nomor`
			  AND a.`id_order` = c.`id_order`
			LEFT JOIN ms_customers d
			  ON a.`id_cust` = d.`id`
		  WHERE a.`lunas` = 0
			AND a.`status` = 1
			AND c.`status` = 1 AND a.`merge` IS NULL  AND a.`tanggal_invoice` BETWEEN '2020-01-01' AND '2020-01-31'
			AND (a.`status_invoice` = 0 OR a.`status_invoice`= 1)) X
		GROUP BY x.`id`) p  WHERE p.`nomor` LIKE '%/GMD-SLTG/%' ) z 
ERROR - 2020-01-02 11:09:28 --> Query error: Table 'erp_gmedia.rpost' doesn't exist - Invalid query: SELECT * FROM (SELECT * FROM
		(SELECT
		  d.`id_arpost_merge` AS id,
		  a.`nomor`,
		  a.`tanggal`,
		  DATE_FORMAT(a.`tanggal_invoice`, '%d-%m-%Y') AS tanggalnya,
		  a.`due_date`,
		  b.`nama`,
		  SUM(e.`bw`) AS bw,
		  SUM(e.`lain2`) + e.`materai` AS lain2,
		  SUM(e.`instalasi`) AS instalasi,
		  SUM(e.`ppn`) AS ppn,
		  SUM(e.`total`) + e.`materai` AS total,
		  e.`jml_bayar`,
		  IF(
			SUM(e.`ppn`) = 0,
			'TIDAK',
			IF(
			  SUM(e.`ppn`) > 0,
			  'STANDAR',
			  'SEDERHANA'
			)
		  ) AS jenis_ppn,
		  a.`date_printed`,
		  a.`date_email`,
		  a.`date_faktur`,
		  a.`lunas`,
		  a.`status_invoice`,
		  IF(
			a.`flag` = 1,
			'Langganan',
			IF(
			  a.`flag` = 2,
			  'Project',
			  'Langganan'
			)
		  ) AS flag,
		  e.`status_merge`
		FROM
		  arpost a
		  LEFT JOIN arpost_merge d
			ON a.`id` = d.`id_arpost_merge`
		  LEFT JOIN ms_site b
			ON a.`to_site` = b.`id`
		  LEFT JOIN
			(SELECT
			  z.`id`,
			  SUM(z.`bw`) AS bw,
			  CASE
				WHEN SUM(z.`materai`) >= 6000
				THEN 6000
				WHEN SUM(z.`materai`) < 6000
				THEN SUM(z.`materai`)
			  END AS materai,
			  SUM(z.`lain2`) AS lain2,
			  SUM(z.`ppn2`) AS ppn,
			  SUM(z.`instalasi`) AS instalasi,
			  SUM(z.`bw`) + SUM(z.`lain2`) + SUM(z.`ppn2`) + SUM(z.`instalasi`) AS total,
			  z.`jml_bayar`,
			  z.`date_printed`,
			  z.`date_email`,
			  z.`date_faktur`,
			  z.`merge` AS status_merge
			FROM
			  (SELECT
				a.*,
				CASE
				  WHEN c.`jenis_transaksi` = 'LG'
				  THEN c.`nominal`
				  ELSE 0
				END AS bw,
				CASE
				  WHEN c.`jenis_transaksi` = 'PN'
				  THEN c.`nominal`
				  ELSE 0
				END AS ppn2,
				CASE
				  WHEN c.`jenis_transaksi` = 'BI'
				  THEN c.`nominal`
				  ELSE 0
				END AS instalasi,
				CASE
				  WHEN c.`jenis_transaksi` = 'MT'
				  THEN c.`nominal`
				  ELSE 0
				END AS materai,
				CASE
				  WHEN c.`jenis_transaksi` = 'LG'
				  THEN 0
				  WHEN c.`jenis_transaksi` = 'PN'
				  THEN 0
				  WHEN c.`jenis_transaksi` = 'BI'
				  THEN 0
				  WHEN c.`jenis_transaksi` = 'MT'
				  THEN 0
				  ELSE c.`nominal`
				END AS lain2
			  FROM
				arpost a
				LEFT JOIN ms_site b
				  ON a.`id_site` = b.`id`
				LEFT JOIN transaksi c
				  ON a.`nomor` = c.`nomor`
				  AND a.`id_order` = c.`id_order`
			  WHERE a.`lunas` = 0
				AND a.`status` = 1
				AND c.`status` = 1
				AND a.`merge` = 1  AND a.`tanggal_invoice` BETWEEN '2020-02-01' AND '2020-02-29') z
			GROUP BY z.`id`) e
			ON d.`id_arpost` = e.`id`
		WHERE a.`lunas` = 0  AND a.`tanggal_invoice` BETWEEN '2020-02-01' AND '2020-02-29'
		  AND a.`id_order` IS NULL
		  AND a.`status` = 1
		  AND (a.`status_invoice` = 0 OR a.`status_invoice` = 1)
		GROUP BY d.`id_arpost_merge`) p 
	  UNION ALL
	  SELECT * FROM
		(SELECT
		  x.`id`,
		  x.`nomor`,
		  x.`tanggal`,
		  DATE_FORMAT(x.`tanggal_invoice`, '%d-%m-%Y') AS tanggalnya,
		  x.`due_date`,
		  x.`nama`,
		  SUM(x.`bw`) AS bw,
		  CASE
			WHEN SUM(x.`materai`) >= 6000
			THEN SUM(x.`lain2`) + 6000
			WHEN SUM(x.`materai`) < 6000
			THEN SUM(x.`lain2`) + SUM(x.`materai`)
		  END AS lain2,
		  SUM(x.`instalasi`) AS instalasi,
		  SUM(x.`ppn2`) AS ppn,
		  SUM(x.`bw`) + SUM(x.`lain2`) + SUM(x.`ppn2`) + SUM(x.`instalasi`) + SUM(x.`materai`) AS total,
		  x.`jml_bayar`,
		  IF(
			SUM(x.`ppn2`) = 0,
			'TIDAK',
			IF(
			  SUM(x.`ppn2`) > 0,
			  'STANDAR',
			  'SEDERHANA'
			)
		  ) AS jenis_ppn,
		  x.`date_printed`,
		  x.`date_email`,
		  x.`date_faktur`,
		  x.`lunas`,
		  x.`status_invoice`,
		  IF(
			x.`flag` = 1,
			'Langganan',
			IF(
			  x.`flag` = 2,
			  'Project',
			  'Langganan'
			)
		  ) AS flag,
		  0 AS status_merge
		FROM
		  (SELECT
			a.*,
			CASE
			  WHEN b.`nama` IS NULL
			  THEN d.`nama`
			  ELSE b.`nama`
			END AS nama,
			CASE
			  WHEN c.`jenis_transaksi` = 'LG'
			  THEN c.`nominal`
			  ELSE 0
			END AS bw,
			CASE
			  WHEN c.`jenis_transaksi` = 'PN'
			  THEN c.`nominal`
			  ELSE 0
			END AS ppn2,
			CASE
			  WHEN c.`jenis_transaksi` = 'BI'
			  THEN c.`nominal`
			  ELSE 0
			END AS instalasi,
			CASE
			  WHEN c.`jenis_transaksi` = 'MT'
			  THEN c.`nominal`
			  ELSE 0
			END AS materai,
			CASE
			  WHEN c.`jenis_transaksi` = 'LG'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'PN'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'BI'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'MT'
			  THEN 0
			  ELSE c.`nominal`
			END AS lain2
		  FROM
			rpost a
			LEFT JOIN ms_site b
			  ON a.`id_site` = b.`id`
			LEFT JOIN transaksi c
			  ON a.`nomor` = c.`nomor`
			  AND a.`id_order` = c.`id_order`
			LEFT JOIN ms_customers d
			  ON a.`id_cust` = d.`id`
		  WHERE a.`lunas` = 0
			AND a.`status` = 1
			AND c.`status` = 1 AND a.`merge` IS NULL  AND a.`tanggal_invoice` BETWEEN '2020-02-01' AND '2020-02-29'
			AND (a.`status_invoice` = 0 OR a.`status_invoice`= 1)) X
		GROUP BY x.`id`) p  ) z 
ERROR - 2020-01-02 11:09:29 --> Query error: Table 'erp_gmedia.rpost' doesn't exist - Invalid query: SELECT * FROM (SELECT * FROM
		(SELECT
		  d.`id_arpost_merge` AS id,
		  a.`nomor`,
		  a.`tanggal`,
		  DATE_FORMAT(a.`tanggal_invoice`, '%d-%m-%Y') AS tanggalnya,
		  a.`due_date`,
		  b.`nama`,
		  SUM(e.`bw`) AS bw,
		  SUM(e.`lain2`) + e.`materai` AS lain2,
		  SUM(e.`instalasi`) AS instalasi,
		  SUM(e.`ppn`) AS ppn,
		  SUM(e.`total`) + e.`materai` AS total,
		  e.`jml_bayar`,
		  IF(
			SUM(e.`ppn`) = 0,
			'TIDAK',
			IF(
			  SUM(e.`ppn`) > 0,
			  'STANDAR',
			  'SEDERHANA'
			)
		  ) AS jenis_ppn,
		  a.`date_printed`,
		  a.`date_email`,
		  a.`date_faktur`,
		  a.`lunas`,
		  a.`status_invoice`,
		  IF(
			a.`flag` = 1,
			'Langganan',
			IF(
			  a.`flag` = 2,
			  'Project',
			  'Langganan'
			)
		  ) AS flag,
		  e.`status_merge`
		FROM
		  arpost a
		  LEFT JOIN arpost_merge d
			ON a.`id` = d.`id_arpost_merge`
		  LEFT JOIN ms_site b
			ON a.`to_site` = b.`id`
		  LEFT JOIN
			(SELECT
			  z.`id`,
			  SUM(z.`bw`) AS bw,
			  CASE
				WHEN SUM(z.`materai`) >= 6000
				THEN 6000
				WHEN SUM(z.`materai`) < 6000
				THEN SUM(z.`materai`)
			  END AS materai,
			  SUM(z.`lain2`) AS lain2,
			  SUM(z.`ppn2`) AS ppn,
			  SUM(z.`instalasi`) AS instalasi,
			  SUM(z.`bw`) + SUM(z.`lain2`) + SUM(z.`ppn2`) + SUM(z.`instalasi`) AS total,
			  z.`jml_bayar`,
			  z.`date_printed`,
			  z.`date_email`,
			  z.`date_faktur`,
			  z.`merge` AS status_merge
			FROM
			  (SELECT
				a.*,
				CASE
				  WHEN c.`jenis_transaksi` = 'LG'
				  THEN c.`nominal`
				  ELSE 0
				END AS bw,
				CASE
				  WHEN c.`jenis_transaksi` = 'PN'
				  THEN c.`nominal`
				  ELSE 0
				END AS ppn2,
				CASE
				  WHEN c.`jenis_transaksi` = 'BI'
				  THEN c.`nominal`
				  ELSE 0
				END AS instalasi,
				CASE
				  WHEN c.`jenis_transaksi` = 'MT'
				  THEN c.`nominal`
				  ELSE 0
				END AS materai,
				CASE
				  WHEN c.`jenis_transaksi` = 'LG'
				  THEN 0
				  WHEN c.`jenis_transaksi` = 'PN'
				  THEN 0
				  WHEN c.`jenis_transaksi` = 'BI'
				  THEN 0
				  WHEN c.`jenis_transaksi` = 'MT'
				  THEN 0
				  ELSE c.`nominal`
				END AS lain2
			  FROM
				arpost a
				LEFT JOIN ms_site b
				  ON a.`id_site` = b.`id`
				LEFT JOIN transaksi c
				  ON a.`nomor` = c.`nomor`
				  AND a.`id_order` = c.`id_order`
			  WHERE a.`lunas` = 0
				AND a.`status` = 1
				AND c.`status` = 1
				AND a.`merge` = 1  AND a.`tanggal_invoice` BETWEEN '2020-01-01' AND '2020-01-31') z
			GROUP BY z.`id`) e
			ON d.`id_arpost` = e.`id`
		WHERE a.`lunas` = 0  AND a.`tanggal_invoice` BETWEEN '2020-01-01' AND '2020-01-31'
		  AND a.`id_order` IS NULL
		  AND a.`status` = 1
		  AND (a.`status_invoice` = 0 OR a.`status_invoice` = 1)
		GROUP BY d.`id_arpost_merge`) p  WHERE p.`nomor` LIKE '%/GMD-SLTG/%'
	  UNION ALL
	  SELECT * FROM
		(SELECT
		  x.`id`,
		  x.`nomor`,
		  x.`tanggal`,
		  DATE_FORMAT(x.`tanggal_invoice`, '%d-%m-%Y') AS tanggalnya,
		  x.`due_date`,
		  x.`nama`,
		  SUM(x.`bw`) AS bw,
		  CASE
			WHEN SUM(x.`materai`) >= 6000
			THEN SUM(x.`lain2`) + 6000
			WHEN SUM(x.`materai`) < 6000
			THEN SUM(x.`lain2`) + SUM(x.`materai`)
		  END AS lain2,
		  SUM(x.`instalasi`) AS instalasi,
		  SUM(x.`ppn2`) AS ppn,
		  SUM(x.`bw`) + SUM(x.`lain2`) + SUM(x.`ppn2`) + SUM(x.`instalasi`) + SUM(x.`materai`) AS total,
		  x.`jml_bayar`,
		  IF(
			SUM(x.`ppn2`) = 0,
			'TIDAK',
			IF(
			  SUM(x.`ppn2`) > 0,
			  'STANDAR',
			  'SEDERHANA'
			)
		  ) AS jenis_ppn,
		  x.`date_printed`,
		  x.`date_email`,
		  x.`date_faktur`,
		  x.`lunas`,
		  x.`status_invoice`,
		  IF(
			x.`flag` = 1,
			'Langganan',
			IF(
			  x.`flag` = 2,
			  'Project',
			  'Langganan'
			)
		  ) AS flag,
		  0 AS status_merge
		FROM
		  (SELECT
			a.*,
			CASE
			  WHEN b.`nama` IS NULL
			  THEN d.`nama`
			  ELSE b.`nama`
			END AS nama,
			CASE
			  WHEN c.`jenis_transaksi` = 'LG'
			  THEN c.`nominal`
			  ELSE 0
			END AS bw,
			CASE
			  WHEN c.`jenis_transaksi` = 'PN'
			  THEN c.`nominal`
			  ELSE 0
			END AS ppn2,
			CASE
			  WHEN c.`jenis_transaksi` = 'BI'
			  THEN c.`nominal`
			  ELSE 0
			END AS instalasi,
			CASE
			  WHEN c.`jenis_transaksi` = 'MT'
			  THEN c.`nominal`
			  ELSE 0
			END AS materai,
			CASE
			  WHEN c.`jenis_transaksi` = 'LG'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'PN'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'BI'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'MT'
			  THEN 0
			  ELSE c.`nominal`
			END AS lain2
		  FROM
			rpost a
			LEFT JOIN ms_site b
			  ON a.`id_site` = b.`id`
			LEFT JOIN transaksi c
			  ON a.`nomor` = c.`nomor`
			  AND a.`id_order` = c.`id_order`
			LEFT JOIN ms_customers d
			  ON a.`id_cust` = d.`id`
		  WHERE a.`lunas` = 0
			AND a.`status` = 1
			AND c.`status` = 1 AND a.`merge` IS NULL  AND a.`tanggal_invoice` BETWEEN '2020-01-01' AND '2020-01-31'
			AND (a.`status_invoice` = 0 OR a.`status_invoice`= 1)) X
		GROUP BY x.`id`) p  WHERE p.`nomor` LIKE '%/GMD-SLTG/%' ) z  ORDER BY z.`nomor` ASC
ERROR - 2020-01-02 11:09:32 --> Query error: Table 'erp_gmedia.rpost' doesn't exist - Invalid query: SELECT * FROM (SELECT * FROM
		(SELECT
		  d.`id_arpost_merge` AS id,
		  a.`nomor`,
		  a.`tanggal`,
		  DATE_FORMAT(a.`tanggal_invoice`, '%d-%m-%Y') AS tanggalnya,
		  a.`due_date`,
		  b.`nama`,
		  SUM(e.`bw`) AS bw,
		  SUM(e.`lain2`) + e.`materai` AS lain2,
		  SUM(e.`instalasi`) AS instalasi,
		  SUM(e.`ppn`) AS ppn,
		  SUM(e.`total`) + e.`materai` AS total,
		  e.`jml_bayar`,
		  IF(
			SUM(e.`ppn`) = 0,
			'TIDAK',
			IF(
			  SUM(e.`ppn`) > 0,
			  'STANDAR',
			  'SEDERHANA'
			)
		  ) AS jenis_ppn,
		  a.`date_printed`,
		  a.`date_email`,
		  a.`date_faktur`,
		  a.`lunas`,
		  a.`status_invoice`,
		  IF(
			a.`flag` = 1,
			'Langganan',
			IF(
			  a.`flag` = 2,
			  'Project',
			  'Langganan'
			)
		  ) AS flag,
		  e.`status_merge`
		FROM
		  arpost a
		  LEFT JOIN arpost_merge d
			ON a.`id` = d.`id_arpost_merge`
		  LEFT JOIN ms_site b
			ON a.`to_site` = b.`id`
		  LEFT JOIN
			(SELECT
			  z.`id`,
			  SUM(z.`bw`) AS bw,
			  CASE
				WHEN SUM(z.`materai`) >= 6000
				THEN 6000
				WHEN SUM(z.`materai`) < 6000
				THEN SUM(z.`materai`)
			  END AS materai,
			  SUM(z.`lain2`) AS lain2,
			  SUM(z.`ppn2`) AS ppn,
			  SUM(z.`instalasi`) AS instalasi,
			  SUM(z.`bw`) + SUM(z.`lain2`) + SUM(z.`ppn2`) + SUM(z.`instalasi`) AS total,
			  z.`jml_bayar`,
			  z.`date_printed`,
			  z.`date_email`,
			  z.`date_faktur`,
			  z.`merge` AS status_merge
			FROM
			  (SELECT
				a.*,
				CASE
				  WHEN c.`jenis_transaksi` = 'LG'
				  THEN c.`nominal`
				  ELSE 0
				END AS bw,
				CASE
				  WHEN c.`jenis_transaksi` = 'PN'
				  THEN c.`nominal`
				  ELSE 0
				END AS ppn2,
				CASE
				  WHEN c.`jenis_transaksi` = 'BI'
				  THEN c.`nominal`
				  ELSE 0
				END AS instalasi,
				CASE
				  WHEN c.`jenis_transaksi` = 'MT'
				  THEN c.`nominal`
				  ELSE 0
				END AS materai,
				CASE
				  WHEN c.`jenis_transaksi` = 'LG'
				  THEN 0
				  WHEN c.`jenis_transaksi` = 'PN'
				  THEN 0
				  WHEN c.`jenis_transaksi` = 'BI'
				  THEN 0
				  WHEN c.`jenis_transaksi` = 'MT'
				  THEN 0
				  ELSE c.`nominal`
				END AS lain2
			  FROM
				arpost a
				LEFT JOIN ms_site b
				  ON a.`id_site` = b.`id`
				LEFT JOIN transaksi c
				  ON a.`nomor` = c.`nomor`
				  AND a.`id_order` = c.`id_order`
			  WHERE a.`lunas` = 0
				AND a.`status` = 1
				AND c.`status` = 1
				AND a.`merge` = 1  AND a.`tanggal_invoice` BETWEEN '2020-01-01' AND '2020-01-31') z
			GROUP BY z.`id`) e
			ON d.`id_arpost` = e.`id`
		WHERE a.`lunas` = 0  AND a.`tanggal_invoice` BETWEEN '2020-01-01' AND '2020-01-31'
		  AND a.`id_order` IS NULL
		  AND a.`status` = 1
		  AND (a.`status_invoice` = 0 OR a.`status_invoice` = 1)
		GROUP BY d.`id_arpost_merge`) p 
	  UNION ALL
	  SELECT * FROM
		(SELECT
		  x.`id`,
		  x.`nomor`,
		  x.`tanggal`,
		  DATE_FORMAT(x.`tanggal_invoice`, '%d-%m-%Y') AS tanggalnya,
		  x.`due_date`,
		  x.`nama`,
		  SUM(x.`bw`) AS bw,
		  CASE
			WHEN SUM(x.`materai`) >= 6000
			THEN SUM(x.`lain2`) + 6000
			WHEN SUM(x.`materai`) < 6000
			THEN SUM(x.`lain2`) + SUM(x.`materai`)
		  END AS lain2,
		  SUM(x.`instalasi`) AS instalasi,
		  SUM(x.`ppn2`) AS ppn,
		  SUM(x.`bw`) + SUM(x.`lain2`) + SUM(x.`ppn2`) + SUM(x.`instalasi`) + SUM(x.`materai`) AS total,
		  x.`jml_bayar`,
		  IF(
			SUM(x.`ppn2`) = 0,
			'TIDAK',
			IF(
			  SUM(x.`ppn2`) > 0,
			  'STANDAR',
			  'SEDERHANA'
			)
		  ) AS jenis_ppn,
		  x.`date_printed`,
		  x.`date_email`,
		  x.`date_faktur`,
		  x.`lunas`,
		  x.`status_invoice`,
		  IF(
			x.`flag` = 1,
			'Langganan',
			IF(
			  x.`flag` = 2,
			  'Project',
			  'Langganan'
			)
		  ) AS flag,
		  0 AS status_merge
		FROM
		  (SELECT
			a.*,
			CASE
			  WHEN b.`nama` IS NULL
			  THEN d.`nama`
			  ELSE b.`nama`
			END AS nama,
			CASE
			  WHEN c.`jenis_transaksi` = 'LG'
			  THEN c.`nominal`
			  ELSE 0
			END AS bw,
			CASE
			  WHEN c.`jenis_transaksi` = 'PN'
			  THEN c.`nominal`
			  ELSE 0
			END AS ppn2,
			CASE
			  WHEN c.`jenis_transaksi` = 'BI'
			  THEN c.`nominal`
			  ELSE 0
			END AS instalasi,
			CASE
			  WHEN c.`jenis_transaksi` = 'MT'
			  THEN c.`nominal`
			  ELSE 0
			END AS materai,
			CASE
			  WHEN c.`jenis_transaksi` = 'LG'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'PN'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'BI'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'MT'
			  THEN 0
			  ELSE c.`nominal`
			END AS lain2
		  FROM
			rpost a
			LEFT JOIN ms_site b
			  ON a.`id_site` = b.`id`
			LEFT JOIN transaksi c
			  ON a.`nomor` = c.`nomor`
			  AND a.`id_order` = c.`id_order`
			LEFT JOIN ms_customers d
			  ON a.`id_cust` = d.`id`
		  WHERE a.`lunas` = 0
			AND a.`status` = 1
			AND c.`status` = 1 AND a.`merge` IS NULL  AND a.`tanggal_invoice` BETWEEN '2020-01-01' AND '2020-01-31'
			AND (a.`status_invoice` = 0 OR a.`status_invoice`= 1)) X
		GROUP BY x.`id`) p  ) z 
ERROR - 2020-01-02 11:09:42 --> Query error: Table 'erp_gmedia.rpost' doesn't exist - Invalid query: SELECT * FROM (SELECT * FROM
		(SELECT
		  d.`id_arpost_merge` AS id,
		  a.`nomor`,
		  a.`tanggal`,
		  DATE_FORMAT(a.`tanggal_invoice`, '%d-%m-%Y') AS tanggalnya,
		  a.`due_date`,
		  b.`nama`,
		  SUM(e.`bw`) AS bw,
		  SUM(e.`lain2`) + e.`materai` AS lain2,
		  SUM(e.`instalasi`) AS instalasi,
		  SUM(e.`ppn`) AS ppn,
		  SUM(e.`total`) + e.`materai` AS total,
		  e.`jml_bayar`,
		  IF(
			SUM(e.`ppn`) = 0,
			'TIDAK',
			IF(
			  SUM(e.`ppn`) > 0,
			  'STANDAR',
			  'SEDERHANA'
			)
		  ) AS jenis_ppn,
		  a.`date_printed`,
		  a.`date_email`,
		  a.`date_faktur`,
		  a.`lunas`,
		  a.`status_invoice`,
		  IF(
			a.`flag` = 1,
			'Langganan',
			IF(
			  a.`flag` = 2,
			  'Project',
			  'Langganan'
			)
		  ) AS flag,
		  e.`status_merge`
		FROM
		  arpost a
		  LEFT JOIN arpost_merge d
			ON a.`id` = d.`id_arpost_merge`
		  LEFT JOIN ms_site b
			ON a.`to_site` = b.`id`
		  LEFT JOIN
			(SELECT
			  z.`id`,
			  SUM(z.`bw`) AS bw,
			  CASE
				WHEN SUM(z.`materai`) >= 6000
				THEN 6000
				WHEN SUM(z.`materai`) < 6000
				THEN SUM(z.`materai`)
			  END AS materai,
			  SUM(z.`lain2`) AS lain2,
			  SUM(z.`ppn2`) AS ppn,
			  SUM(z.`instalasi`) AS instalasi,
			  SUM(z.`bw`) + SUM(z.`lain2`) + SUM(z.`ppn2`) + SUM(z.`instalasi`) AS total,
			  z.`jml_bayar`,
			  z.`date_printed`,
			  z.`date_email`,
			  z.`date_faktur`,
			  z.`merge` AS status_merge
			FROM
			  (SELECT
				a.*,
				CASE
				  WHEN c.`jenis_transaksi` = 'LG'
				  THEN c.`nominal`
				  ELSE 0
				END AS bw,
				CASE
				  WHEN c.`jenis_transaksi` = 'PN'
				  THEN c.`nominal`
				  ELSE 0
				END AS ppn2,
				CASE
				  WHEN c.`jenis_transaksi` = 'BI'
				  THEN c.`nominal`
				  ELSE 0
				END AS instalasi,
				CASE
				  WHEN c.`jenis_transaksi` = 'MT'
				  THEN c.`nominal`
				  ELSE 0
				END AS materai,
				CASE
				  WHEN c.`jenis_transaksi` = 'LG'
				  THEN 0
				  WHEN c.`jenis_transaksi` = 'PN'
				  THEN 0
				  WHEN c.`jenis_transaksi` = 'BI'
				  THEN 0
				  WHEN c.`jenis_transaksi` = 'MT'
				  THEN 0
				  ELSE c.`nominal`
				END AS lain2
			  FROM
				arpost a
				LEFT JOIN ms_site b
				  ON a.`id_site` = b.`id`
				LEFT JOIN transaksi c
				  ON a.`nomor` = c.`nomor`
				  AND a.`id_order` = c.`id_order`
			  WHERE a.`lunas` = 0
				AND a.`status` = 1
				AND c.`status` = 1
				AND a.`merge` = 1  AND a.`tanggal_invoice` BETWEEN '2019-01-01' AND '2019-01-31') z
			GROUP BY z.`id`) e
			ON d.`id_arpost` = e.`id`
		WHERE a.`lunas` = 0  AND a.`tanggal_invoice` BETWEEN '2019-01-01' AND '2019-01-31'
		  AND a.`id_order` IS NULL
		  AND a.`status` = 1
		  AND (a.`status_invoice` = 0 OR a.`status_invoice` = 1)
		GROUP BY d.`id_arpost_merge`) p 
	  UNION ALL
	  SELECT * FROM
		(SELECT
		  x.`id`,
		  x.`nomor`,
		  x.`tanggal`,
		  DATE_FORMAT(x.`tanggal_invoice`, '%d-%m-%Y') AS tanggalnya,
		  x.`due_date`,
		  x.`nama`,
		  SUM(x.`bw`) AS bw,
		  CASE
			WHEN SUM(x.`materai`) >= 6000
			THEN SUM(x.`lain2`) + 6000
			WHEN SUM(x.`materai`) < 6000
			THEN SUM(x.`lain2`) + SUM(x.`materai`)
		  END AS lain2,
		  SUM(x.`instalasi`) AS instalasi,
		  SUM(x.`ppn2`) AS ppn,
		  SUM(x.`bw`) + SUM(x.`lain2`) + SUM(x.`ppn2`) + SUM(x.`instalasi`) + SUM(x.`materai`) AS total,
		  x.`jml_bayar`,
		  IF(
			SUM(x.`ppn2`) = 0,
			'TIDAK',
			IF(
			  SUM(x.`ppn2`) > 0,
			  'STANDAR',
			  'SEDERHANA'
			)
		  ) AS jenis_ppn,
		  x.`date_printed`,
		  x.`date_email`,
		  x.`date_faktur`,
		  x.`lunas`,
		  x.`status_invoice`,
		  IF(
			x.`flag` = 1,
			'Langganan',
			IF(
			  x.`flag` = 2,
			  'Project',
			  'Langganan'
			)
		  ) AS flag,
		  0 AS status_merge
		FROM
		  (SELECT
			a.*,
			CASE
			  WHEN b.`nama` IS NULL
			  THEN d.`nama`
			  ELSE b.`nama`
			END AS nama,
			CASE
			  WHEN c.`jenis_transaksi` = 'LG'
			  THEN c.`nominal`
			  ELSE 0
			END AS bw,
			CASE
			  WHEN c.`jenis_transaksi` = 'PN'
			  THEN c.`nominal`
			  ELSE 0
			END AS ppn2,
			CASE
			  WHEN c.`jenis_transaksi` = 'BI'
			  THEN c.`nominal`
			  ELSE 0
			END AS instalasi,
			CASE
			  WHEN c.`jenis_transaksi` = 'MT'
			  THEN c.`nominal`
			  ELSE 0
			END AS materai,
			CASE
			  WHEN c.`jenis_transaksi` = 'LG'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'PN'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'BI'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'MT'
			  THEN 0
			  ELSE c.`nominal`
			END AS lain2
		  FROM
			rpost a
			LEFT JOIN ms_site b
			  ON a.`id_site` = b.`id`
			LEFT JOIN transaksi c
			  ON a.`nomor` = c.`nomor`
			  AND a.`id_order` = c.`id_order`
			LEFT JOIN ms_customers d
			  ON a.`id_cust` = d.`id`
		  WHERE a.`lunas` = 0
			AND a.`status` = 1
			AND c.`status` = 1 AND a.`merge` IS NULL  AND a.`tanggal_invoice` BETWEEN '2019-01-01' AND '2019-01-31'
			AND (a.`status_invoice` = 0 OR a.`status_invoice`= 1)) X
		GROUP BY x.`id`) p  ) z 
ERROR - 2020-01-02 11:09:42 --> Query error: Table 'erp_gmedia.rpost' doesn't exist - Invalid query: SELECT * FROM (SELECT * FROM
		(SELECT
		  d.`id_arpost_merge` AS id,
		  a.`nomor`,
		  a.`tanggal`,
		  DATE_FORMAT(a.`tanggal_invoice`, '%d-%m-%Y') AS tanggalnya,
		  a.`due_date`,
		  b.`nama`,
		  SUM(e.`bw`) AS bw,
		  SUM(e.`lain2`) + e.`materai` AS lain2,
		  SUM(e.`instalasi`) AS instalasi,
		  SUM(e.`ppn`) AS ppn,
		  SUM(e.`total`) + e.`materai` AS total,
		  e.`jml_bayar`,
		  IF(
			SUM(e.`ppn`) = 0,
			'TIDAK',
			IF(
			  SUM(e.`ppn`) > 0,
			  'STANDAR',
			  'SEDERHANA'
			)
		  ) AS jenis_ppn,
		  a.`date_printed`,
		  a.`date_email`,
		  a.`date_faktur`,
		  a.`lunas`,
		  a.`status_invoice`,
		  IF(
			a.`flag` = 1,
			'Langganan',
			IF(
			  a.`flag` = 2,
			  'Project',
			  'Langganan'
			)
		  ) AS flag,
		  e.`status_merge`
		FROM
		  arpost a
		  LEFT JOIN arpost_merge d
			ON a.`id` = d.`id_arpost_merge`
		  LEFT JOIN ms_site b
			ON a.`to_site` = b.`id`
		  LEFT JOIN
			(SELECT
			  z.`id`,
			  SUM(z.`bw`) AS bw,
			  CASE
				WHEN SUM(z.`materai`) >= 6000
				THEN 6000
				WHEN SUM(z.`materai`) < 6000
				THEN SUM(z.`materai`)
			  END AS materai,
			  SUM(z.`lain2`) AS lain2,
			  SUM(z.`ppn2`) AS ppn,
			  SUM(z.`instalasi`) AS instalasi,
			  SUM(z.`bw`) + SUM(z.`lain2`) + SUM(z.`ppn2`) + SUM(z.`instalasi`) AS total,
			  z.`jml_bayar`,
			  z.`date_printed`,
			  z.`date_email`,
			  z.`date_faktur`,
			  z.`merge` AS status_merge
			FROM
			  (SELECT
				a.*,
				CASE
				  WHEN c.`jenis_transaksi` = 'LG'
				  THEN c.`nominal`
				  ELSE 0
				END AS bw,
				CASE
				  WHEN c.`jenis_transaksi` = 'PN'
				  THEN c.`nominal`
				  ELSE 0
				END AS ppn2,
				CASE
				  WHEN c.`jenis_transaksi` = 'BI'
				  THEN c.`nominal`
				  ELSE 0
				END AS instalasi,
				CASE
				  WHEN c.`jenis_transaksi` = 'MT'
				  THEN c.`nominal`
				  ELSE 0
				END AS materai,
				CASE
				  WHEN c.`jenis_transaksi` = 'LG'
				  THEN 0
				  WHEN c.`jenis_transaksi` = 'PN'
				  THEN 0
				  WHEN c.`jenis_transaksi` = 'BI'
				  THEN 0
				  WHEN c.`jenis_transaksi` = 'MT'
				  THEN 0
				  ELSE c.`nominal`
				END AS lain2
			  FROM
				arpost a
				LEFT JOIN ms_site b
				  ON a.`id_site` = b.`id`
				LEFT JOIN transaksi c
				  ON a.`nomor` = c.`nomor`
				  AND a.`id_order` = c.`id_order`
			  WHERE a.`lunas` = 0
				AND a.`status` = 1
				AND c.`status` = 1
				AND a.`merge` = 1  AND a.`tanggal_invoice` BETWEEN '2019-01-01' AND '2019-01-31') z
			GROUP BY z.`id`) e
			ON d.`id_arpost` = e.`id`
		WHERE a.`lunas` = 0  AND a.`tanggal_invoice` BETWEEN '2019-01-01' AND '2019-01-31'
		  AND a.`id_order` IS NULL
		  AND a.`status` = 1
		  AND (a.`status_invoice` = 0 OR a.`status_invoice` = 1)
		GROUP BY d.`id_arpost_merge`) p 
	  UNION ALL
	  SELECT * FROM
		(SELECT
		  x.`id`,
		  x.`nomor`,
		  x.`tanggal`,
		  DATE_FORMAT(x.`tanggal_invoice`, '%d-%m-%Y') AS tanggalnya,
		  x.`due_date`,
		  x.`nama`,
		  SUM(x.`bw`) AS bw,
		  CASE
			WHEN SUM(x.`materai`) >= 6000
			THEN SUM(x.`lain2`) + 6000
			WHEN SUM(x.`materai`) < 6000
			THEN SUM(x.`lain2`) + SUM(x.`materai`)
		  END AS lain2,
		  SUM(x.`instalasi`) AS instalasi,
		  SUM(x.`ppn2`) AS ppn,
		  SUM(x.`bw`) + SUM(x.`lain2`) + SUM(x.`ppn2`) + SUM(x.`instalasi`) + SUM(x.`materai`) AS total,
		  x.`jml_bayar`,
		  IF(
			SUM(x.`ppn2`) = 0,
			'TIDAK',
			IF(
			  SUM(x.`ppn2`) > 0,
			  'STANDAR',
			  'SEDERHANA'
			)
		  ) AS jenis_ppn,
		  x.`date_printed`,
		  x.`date_email`,
		  x.`date_faktur`,
		  x.`lunas`,
		  x.`status_invoice`,
		  IF(
			x.`flag` = 1,
			'Langganan',
			IF(
			  x.`flag` = 2,
			  'Project',
			  'Langganan'
			)
		  ) AS flag,
		  0 AS status_merge
		FROM
		  (SELECT
			a.*,
			CASE
			  WHEN b.`nama` IS NULL
			  THEN d.`nama`
			  ELSE b.`nama`
			END AS nama,
			CASE
			  WHEN c.`jenis_transaksi` = 'LG'
			  THEN c.`nominal`
			  ELSE 0
			END AS bw,
			CASE
			  WHEN c.`jenis_transaksi` = 'PN'
			  THEN c.`nominal`
			  ELSE 0
			END AS ppn2,
			CASE
			  WHEN c.`jenis_transaksi` = 'BI'
			  THEN c.`nominal`
			  ELSE 0
			END AS instalasi,
			CASE
			  WHEN c.`jenis_transaksi` = 'MT'
			  THEN c.`nominal`
			  ELSE 0
			END AS materai,
			CASE
			  WHEN c.`jenis_transaksi` = 'LG'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'PN'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'BI'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'MT'
			  THEN 0
			  ELSE c.`nominal`
			END AS lain2
		  FROM
			rpost a
			LEFT JOIN ms_site b
			  ON a.`id_site` = b.`id`
			LEFT JOIN transaksi c
			  ON a.`nomor` = c.`nomor`
			  AND a.`id_order` = c.`id_order`
			LEFT JOIN ms_customers d
			  ON a.`id_cust` = d.`id`
		  WHERE a.`lunas` = 0
			AND a.`status` = 1
			AND c.`status` = 1 AND a.`merge` IS NULL  AND a.`tanggal_invoice` BETWEEN '2019-01-01' AND '2019-01-31'
			AND (a.`status_invoice` = 0 OR a.`status_invoice`= 1)) X
		GROUP BY x.`id`) p  ) z 
ERROR - 2020-01-02 11:14:33 --> Severity: Notice --> Undefined property: stdClass::$wakil /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_invoice_customer.php 458
ERROR - 2020-01-02 07:58:14 --> 404 Page Not Found: Assets/js
