<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-01-08 10:29:48 --> Query error: Table 'erp_financev2.md_finance_transaksi_kasir' doesn't exist - Invalid query: SELECT
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
          `md_finance_transaksi_kasir` `a`
          LEFT JOIN `gmd_finance_transaksi_kasir_detail` `b`
            ON `a`.`id` = `b`.`id_kasir`
          LEFT JOIN `gmd_finance_master_divisi` `c`
            ON `a`.`divisi` = `c`.`id`
          LEFT JOIN `gmd_finance_master_kat_gl` `d`
            ON `a`.`kode` = `d`.`id`
        WHERE (
            `b`.`memo` LIKE '%go%' ESCAPE '!'
            AND `a`.`nomor` LIKE '%go%' ESCAPE '!'
          )
          AND `a`.`status` = '1'
          AND `b`.`status` = '1'
          AND (
            a.`tanggal` BETWEEN '2019-12-01'
            AND '2020-01-31'
          )
        ) z ORDER BY z.urutan ASC  LIMIT 0,100
