<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-12-17 04:27:40 --> 404 Page Not Found: Select_data_income_expenses/2019
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-12-17 04:27:40 --> 404 Page Not Found: Select_data_monthly/2019
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-12-17 04:27:40 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-17 04:27:40 --> 404 Page Not Found: Select_data_cash_month/2019
ERROR - 2019-12-17 04:27:40 --> 404 Page Not Found: Select_data_income_expenses/2019
ERROR - 2019-12-17 12:00:36 --> Query error: SELECT command denied to user 'erp'@'103.255.240.2' for table 'hol' - Invalid query: SELECT *
FROM `hrd2`.`hol`
WHERE `hol_tgl` = '2020-01-01'
ERROR - 2019-12-17 12:00:49 --> Query error: SELECT command denied to user 'erp'@'103.255.240.2' for table 'hol' - Invalid query: SELECT *
FROM `hrd2`.`hol`
WHERE `hol_tgl` = '2020-01-01'
ERROR - 2019-12-17 06:20:59 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-17 06:20:59 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-17 06:20:59 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-17 06:20:59 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-17 06:20:59 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-17 06:20:59 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-17 13:21:02 --> Query error: Unknown column 'a.level' in 'field list' - Invalid query: SELECT SQL_CALC_FOUND_ROWS a.*, if(a.level = 0, concat(a.id, ' - ', a.nama), '') as header, if(a.level = 1, concat(a.id, ' - ', a.nama), '') as level1, if(a.level = 2, concat(a.id, ' - ', a.nama), '') as level2, if(a.level = 3, concat(a.id, ' - ', a.nama), '') as level3, coalesce(sum(b.saldo), 0.00) as saldo, coalesce(date_format(b.tanggal, '%d/%m/%y'), '') as tanggal
FROM `gmd_finance_coa` `a`
LEFT JOIN `gmd_finance_coa_saldo` `b` ON `a`.`id` = `b`.`id_biaya` AND `b`.`branch` = '8'
WHERE   (
`a`.`nama` LIKE '%%' ESCAPE '!'
AND  `a`.`id` LIKE '%%' ESCAPE '!'
 )
AND `a`.`parent` = '0'
GROUP BY `a`.`id`
ORDER BY `a`.`id` ASC, `header` ASC, `level1` ASC, `level2` ASC, `level3` ASC
ERROR - 2019-12-17 06:44:31 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-17 06:44:31 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-17 06:44:31 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-17 06:44:31 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-17 06:44:31 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-17 13:53:22 --> Query error: Unknown column 'b.id_card' in 'field list' - Invalid query: SELECT a.*, b.`id_coa`, b.`memo`, b.`nominal`,c.`nama` AS nama_divisi,
        d.`nama` AS kode_jurnal,e.`nama` AS nama_coa,b.`id_card`,f.`nama` AS nama_card
        FROM `gmd_finance_transaksi_kasir` a
        LEFT JOIN `gmd_finance_transaksi_kasir_detail` b 
        ON a.`id` = b.`id_kasir`
        LEFT JOIN `gmd_finance_master_divisi` c 
        ON a.`divisi`=c.`id` 
        LEFT JOIN `gmd_finance_master_kat_gl` d 
        ON a.`kode`=d.`id`
        LEFT JOIN `gmd_finance_coa` e
        ON b.`id_coa`=e.`id`
        LEFT JOIN `gmd_finance_coa_card_name` f
        ON b.`id_card`=f.`id` WHERE a.`status` = 1
        AND b.`status` = 1 AND a.`id` = '7'
ERROR - 2019-12-17 13:53:32 --> Query error: Unknown column 'b.id_card' in 'field list' - Invalid query: SELECT a.*, b.`id_coa`, b.`memo`, b.`nominal`,c.`nama` AS nama_divisi,
        d.`nama` AS kode_jurnal,e.`nama` AS nama_coa,b.`id_card`,f.`nama` AS nama_card
        FROM `gmd_finance_transaksi_kasir` a
        LEFT JOIN `gmd_finance_transaksi_kasir_detail` b 
        ON a.`id` = b.`id_kasir`
        LEFT JOIN `gmd_finance_master_divisi` c 
        ON a.`divisi`=c.`id` 
        LEFT JOIN `gmd_finance_master_kat_gl` d 
        ON a.`kode`=d.`id`
        LEFT JOIN `gmd_finance_coa` e
        ON b.`id_coa`=e.`id`
        LEFT JOIN `gmd_finance_coa_card_name` f
        ON b.`id_card`=f.`id` WHERE a.`status` = 1
        AND b.`status` = 1 AND a.`id` = ''
ERROR - 2019-12-17 07:13:17 --> 404 Page Not Found: Assets/js
