<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-12-23 02:20:16 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-23 09:20:21 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_monthly' doesn't exist - Invalid query: SELECT SUM(a.debet) as saldo_debet, SUM(a.kredit) as saldo_kredit
FROM `gmd_inance_coa_general_ledger_monthly` `a`
WHERE `a`.`id_biaya` = '111200'
AND `a`.`bulan` >= '2000-01-01'
AND `a`.`bulan` < '2019-12-23'
AND `a`.`branch` = '8'
ERROR - 2019-12-23 09:22:03 --> Query error: Unknown column 'a.tanggal' in 'where clause' - Invalid query: SELECT SUM(a.debet) as saldo_debet, SUM(a.kredit) as saldo_kredit
FROM `gmd_finance_coa_general_ledger_monthly` `a`
WHERE `a`.`id_biaya` = '111200'
AND `a`.`tanggal` >= '2000-01-01'
AND `a`.`tanggal` < '2019-12-23'
AND `a`.`branch` = '8'
ERROR - 2019-12-23 09:22:07 --> Query error: Unknown column 'a.tanggal' in 'where clause' - Invalid query: SELECT SUM(a.debet) as saldo_debet, SUM(a.kredit) as saldo_kredit
FROM `gmd_finance_coa_general_ledger_monthly` `a`
WHERE `a`.`id_biaya` = '100000'
AND `a`.`tanggal` >= '2000-01-01'
AND `a`.`tanggal` < '2019-12-23'
AND `a`.`branch` = '8'
ERROR - 2019-12-23 09:22:09 --> Query error: Unknown column 'a.tanggal' in 'where clause' - Invalid query: SELECT SUM(a.debet) as saldo_debet, SUM(a.kredit) as saldo_kredit
FROM `gmd_finance_coa_general_ledger_monthly` `a`
WHERE `a`.`id_biaya` = '100000'
AND `a`.`tanggal` >= '2000-01-01'
AND `a`.`tanggal` < '2019-12-23'
AND `a`.`branch` = '8'
ERROR - 2019-12-23 02:22:45 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-23 09:35:24 --> Query error: Unknown column 'deskripsi' in 'field list' - Invalid query: SELECT 
		  SQL_CALC_FOUND_ROWS *, date_format(tanggal, '%d-%m-%Y') as tanggalnya 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '9'
			AND branch = '8'
			AND (
			  tanggal BETWEEN '2019-12-01' AND '2019-12-31'
			)
		) AS kasnya 
		ORDER BY tanggal ASC, saldo_m DESC, saldo_k ASC 
ERROR - 2019-12-23 02:35:38 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-23 09:35:42 --> Query error: Unknown column 'deskripsi' in 'field list' - Invalid query: SELECT 
		  SQL_CALC_FOUND_ROWS *, date_format(tanggal, '%d-%m-%Y') as tanggalnya 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = ''
			AND branch = '8'
			AND (
			  tanggal BETWEEN '2019-12-23' AND '2019-12-23'
			)
		) AS kasnya 
		ORDER BY tanggal ASC, saldo_m DESC, saldo_k ASC 
ERROR - 2019-12-23 09:43:57 --> Query error: Unknown column 'deskripsi' in 'field list' - Invalid query: SELECT 
		  SQL_CALC_FOUND_ROWS *, date_format(tanggal, '%d-%m-%Y') as tanggalnya 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '9'
			AND branch = '8'
			AND (
			  tanggal BETWEEN '2019-12-01' AND '2019-12-31'
			)
		) AS kasnya 
		ORDER BY tanggal ASC, saldo_m DESC, saldo_k ASC 
ERROR - 2019-12-23 09:44:01 --> Query error: Unknown column 'deskripsi' in 'field list' - Invalid query: SELECT 
		  SQL_CALC_FOUND_ROWS *, date_format(tanggal, '%d-%m-%Y') as tanggalnya 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '9'
			AND branch = '8'
			AND (
			  tanggal BETWEEN '2019-12-01' AND '2019-12-31'
			)
		) AS kasnya 
		ORDER BY tanggal ASC, saldo_m DESC, saldo_k ASC 
ERROR - 2019-12-23 02:44:03 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-23 02:44:06 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-23 09:44:06 --> Query error: Unknown column 'deskripsi' in 'field list' - Invalid query: SELECT 
		  SQL_CALC_FOUND_ROWS *, date_format(tanggal, '%d-%m-%Y') as tanggalnya 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '9'
			AND branch = '8'
			AND (
			  tanggal BETWEEN '2019-12-01' AND '2019-12-31'
			)
		) AS kasnya 
		ORDER BY tanggal ASC, saldo_m DESC, saldo_k ASC 
ERROR - 2019-12-23 02:44:57 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-23 09:44:57 --> Query error: Unknown column 'deskripsi' in 'field list' - Invalid query: SELECT 
		  SUM(saldo_m - saldo_k) AS saldo 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '9'
			AND tanggal < '2019-12-01'
			AND branch = '8'
			) AS kasnya 
		ORDER BY tanggal ASC 
ERROR - 2019-12-23 09:44:59 --> Query error: Unknown column 'deskripsi' in 'field list' - Invalid query: SELECT 
		  SUM(saldo_m - saldo_k) AS saldo 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '9'
			AND tanggal < '2019-12-01'
			AND branch = '8'
			) AS kasnya 
		ORDER BY tanggal ASC 
ERROR - 2019-12-23 02:45:02 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-23 02:45:03 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-23 09:45:03 --> Query error: Unknown column 'deskripsi' in 'field list' - Invalid query: SELECT 
		  SUM(saldo_m - saldo_k) AS saldo 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '9'
			AND tanggal < '2019-12-01'
			AND branch = '8'
			) AS kasnya 
		ORDER BY tanggal ASC 
ERROR - 2019-12-23 02:45:23 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-23 09:45:23 --> Query error: Unknown column 'deskripsi' in 'field list' - Invalid query: SELECT 
		  SUM(saldo_m - saldo_k) AS saldo 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '9'
			AND tanggal < '2019-12-01'
			AND branch = '8'
			) AS kasnya 
		ORDER BY tanggal ASC 
ERROR - 2019-12-23 02:50:51 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-23 02:51:01 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-23 02:51:32 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-23 09:51:40 --> Query error: Table 'erp_financev2.gmd_inance_transaksi_kasir' doesn't exist - Invalid query: SELECT
		SQL_CALC_FOUND_ROWS *,
		DATE_FORMAT(kasnya.`tanggal`, '%d-%m-%Y') AS tanggalnya
	  FROM
	  (SELECT
    a.id AS idnya,
    a.tanggal,
    b.`memo` AS ket,
    IF(a.tipe = 1, b.nominal, 0.00) AS saldo_m,
    IF(a.tipe = 0, b.nominal, 0.00) AS saldo_k FROM
	gmd_inance_transaksi_kasir a
    JOIN gmd_finance_transaksi_kasir_detail b ON a.`id`=b.`id_kasir`
		  WHERE  a.status=1 AND b.status=1 AND a.branch = '9'
			AND (
			  tanggal BETWEEN '2019-12-01' AND '2019-12-31'
			)
		) AS kasnya 
		ORDER BY kasnya.tanggal ASC, kasnya.saldo_m DESC, kasnya.saldo_k ASC
ERROR - 2019-12-23 02:56:11 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-23 09:56:48 --> Query error: Table 'erp_financev2.gmd_inance_transaksi_kasir' doesn't exist - Invalid query: SELECT
		SUM(kasnya.saldo_m - kasnya.saldo_k) AS saldo
	  FROM
	  (SELECT
    a.id AS idnya,
    a.tanggal,
    b.memo AS ket,
    IF(a.tipe = 0, b.`nominal`, 0.00) AS saldo_m,
    IF(a.tipe = 1, b.`nominal`, 0.00) AS saldo_k
  FROM
    gmd_inance_transaksi_kasir a
    JOIN `gmd_finance_transaksi_kasir_detail` b ON a.`id`=b.`id_kasir`
		  WHERE  a.status=1 AND b.status=1
			AND a.tanggal < '2019-12-01'
			AND a.branch = '1'
			) AS kasnya 
		ORDER BY kasnya.tanggal ASC 
ERROR - 2019-12-23 02:56:51 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-23 02:56:55 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-23 09:56:55 --> Query error: Table 'erp_financev2.gmd_inance_transaksi_kasir' doesn't exist - Invalid query: SELECT
		SUM(kasnya.saldo_m - kasnya.saldo_k) AS saldo
	  FROM
	  (SELECT
    a.id AS idnya,
    a.tanggal,
    b.memo AS ket,
    IF(a.tipe = 0, b.`nominal`, 0.00) AS saldo_m,
    IF(a.tipe = 1, b.`nominal`, 0.00) AS saldo_k
  FROM
    gmd_inance_transaksi_kasir a
    JOIN `gmd_finance_transaksi_kasir_detail` b ON a.`id`=b.`id_kasir`
		  WHERE  a.status=1 AND b.status=1
			AND a.tanggal < '2019-12-01'
			AND a.branch = '1'
			) AS kasnya 
		ORDER BY kasnya.tanggal ASC 
ERROR - 2019-12-23 03:09:34 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-23 03:09:37 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-23 04:16:33 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-23 04:16:33 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-23 04:16:33 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-12-23 04:16:33 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-23 04:16:33 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-23 06:44:31 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-23 06:44:31 --> 404 Page Not Found: Select_data_monthly/2019
ERROR - 2019-12-23 06:44:31 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-23 06:44:31 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-23 06:44:31 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-23 14:47:20 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ELECT
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
            AND `a`.`nomor` LIKE '%%' ESCAPE '!'
          )
          AND `a`.`status` = '1'
          AND `b`.`status` = '1'
          AND (
            a.`tanggal` BETWEEN '2019-12-01'
            AND '2019-12-31'
          )
         LIMIT 0,100 ) z ORDER BY z.urutan ASC
ERROR - 2019-12-23 14:47:26 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ELECT
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
            AND `a`.`nomor` LIKE '%%' ESCAPE '!'
          )
          AND `a`.`status` = '1'
          AND `b`.`status` = '1'
          AND (
            a.`tanggal` BETWEEN '2019-12-01'
            AND '2019-12-31'
          )
         LIMIT 0,100 ) z ORDER BY z.urutan ASC
ERROR - 2019-12-23 08:31:49 --> 404 Page Not Found: Assets/invoice
ERROR - 2019-12-23 08:31:49 --> 404 Page Not Found: Assets/invoice
ERROR - 2019-12-23 09:23:52 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-23 09:23:53 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-23 16:24:23 --> Query error: Table 'erp_financev2.gmd_inance_coa_general_ledger_daily' doesn't exist - Invalid query: SELECT SUM(a.debet) as saldo_debet, SUM(a.kredit) as saldo_kredit
FROM `gmd_inance_coa_general_ledger_daily` `a`
WHERE `a`.`id_biaya` = '111200'
AND `a`.`tanggal` >= '2000-01-01'
AND `a`.`tanggal` < '2019-12-20'
AND `a`.`branch` = '8'
