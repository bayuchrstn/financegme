<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-04-07 08:53:39 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-07 08:53:39 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-07 08:53:40 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-30'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-04-30'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-04-30')
ERROR - 2020-04-07 09:18:14 --> Severity: error --> Exception: /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php exists, but doesn't declare class Model_finance_customer_data_aktif /data/www/html/erpsmg/finance_gmedia/system/core/Loader.php 336
ERROR - 2020-04-07 10:20:29 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-07 10:20:29 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-07 10:20:33 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-30'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-04-30'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-04-30')
ERROR - 2020-04-07 10:32:20 --> 404 Page Not Found: Finance_customer_data_aktif/view_data
ERROR - 2020-04-07 11:06:01 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-07 11:06:01 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-07 11:06:02 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-30'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-04-30'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-04-30')
ERROR - 2020-04-07 04:10:18 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-04-07 04:10:18 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-04-07 04:10:18 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-04-07 04:10:18 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-04-07 04:10:18 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-04-07 04:53:26 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 04:53:56 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 04:54:09 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 04:54:43 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 04:56:14 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-04-07 04:56:14 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-04-07 04:56:14 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-04-07 04:56:14 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-04-07 04:56:14 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-04-07 04:59:16 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 05:00:02 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 05:02:51 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 05:11:22 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 12:11:24 --> Severity: Notice --> Undefined variable: id /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 423
ERROR - 2020-04-07 12:11:24 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ORDER BY a.`tanggal` ASC' at line 1 - Invalid query: SELECT * FROM erp_gmedia.`arpost` a WHERE a.`status`!=9 AND a.`nomor` IS NOT NULL AND a.`id_order` =  ORDER BY a.`tanggal` ASC
ERROR - 2020-04-07 05:11:38 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 05:12:31 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 05:13:52 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 12:13:56 --> 404 Page Not Found: Finance_customer_data_aktif/print_selected
ERROR - 2020-04-07 12:14:00 --> 404 Page Not Found: Finance_customer_data_aktif/print_selected
ERROR - 2020-04-07 12:14:19 --> Severity: Notice --> Undefined variable: isi /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 205
ERROR - 2020-04-07 12:14:19 --> Severity: Warning --> Invalid argument supplied for foreach() /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 205
ERROR - 2020-04-07 12:14:19 --> Severity: Notice --> Undefined variable: nama_invoice /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 237
ERROR - 2020-04-07 12:14:19 --> Severity: Notice --> Undefined variable: alamat_cust /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 244
ERROR - 2020-04-07 12:14:19 --> Severity: Notice --> Undefined variable: attention /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 251
ERROR - 2020-04-07 12:14:19 --> Severity: Notice --> Undefined variable: no_telp /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 258
ERROR - 2020-04-07 12:14:19 --> Severity: Notice --> Undefined variable: no_invoice /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 269
ERROR - 2020-04-07 12:14:19 --> Severity: Notice --> Undefined variable: cust_id /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 276
ERROR - 2020-04-07 12:14:19 --> Severity: Notice --> Undefined variable: date_invoice /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 283
ERROR - 2020-04-07 12:14:19 --> Severity: Notice --> Undefined variable: date_due /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 290
ERROR - 2020-04-07 12:14:19 --> Severity: Notice --> Undefined variable: periode /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 297
ERROR - 2020-04-07 12:14:19 --> Severity: Notice --> Undefined variable: isi /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 328
ERROR - 2020-04-07 12:14:19 --> Severity: Warning --> Invalid argument supplied for foreach() /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 328
ERROR - 2020-04-07 12:14:19 --> Severity: Notice --> Undefined variable: nilai_voucher /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 459
ERROR - 2020-04-07 12:14:19 --> Severity: Notice --> Undefined variable: voucher /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 476
ERROR - 2020-04-07 12:14:19 --> Severity: Notice --> Undefined variable: voucher /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 495
ERROR - 2020-04-07 05:15:50 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 05:15:54 --> 404 Page Not Found: Print_selected/index
ERROR - 2020-04-07 05:16:51 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 12:16:55 --> Severity: Notice --> Undefined variable: isi /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 205
ERROR - 2020-04-07 12:16:55 --> Severity: Warning --> Invalid argument supplied for foreach() /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 205
ERROR - 2020-04-07 12:16:55 --> Severity: Notice --> Undefined variable: nama_invoice /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 237
ERROR - 2020-04-07 12:16:55 --> Severity: Notice --> Undefined variable: alamat_cust /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 244
ERROR - 2020-04-07 12:16:55 --> Severity: Notice --> Undefined variable: attention /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 251
ERROR - 2020-04-07 12:16:55 --> Severity: Notice --> Undefined variable: no_telp /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 258
ERROR - 2020-04-07 12:16:55 --> Severity: Notice --> Undefined variable: no_invoice /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 269
ERROR - 2020-04-07 12:16:55 --> Severity: Notice --> Undefined variable: cust_id /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 276
ERROR - 2020-04-07 12:16:55 --> Severity: Notice --> Undefined variable: date_invoice /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 283
ERROR - 2020-04-07 12:16:55 --> Severity: Notice --> Undefined variable: date_due /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 290
ERROR - 2020-04-07 12:16:55 --> Severity: Notice --> Undefined variable: periode /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 297
ERROR - 2020-04-07 12:16:55 --> Severity: Notice --> Undefined variable: isi /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 328
ERROR - 2020-04-07 12:16:55 --> Severity: Warning --> Invalid argument supplied for foreach() /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 328
ERROR - 2020-04-07 12:16:55 --> Severity: Notice --> Undefined variable: nilai_voucher /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 459
ERROR - 2020-04-07 12:16:55 --> Severity: Notice --> Undefined variable: voucher /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 476
ERROR - 2020-04-07 12:16:55 --> Severity: Notice --> Undefined variable: voucher /data/www/html/erpsmg/finance_gmedia/application/views/finance_invoice_customer/cetak_nonppn.php 495
ERROR - 2020-04-07 05:37:07 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 05:37:47 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 05:38:39 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 05:39:49 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 05:41:07 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 13:27:11 --> Severity: error --> Exception: syntax error, unexpected '}' /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 564
ERROR - 2020-04-07 13:27:12 --> Severity: error --> Exception: syntax error, unexpected '}' /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 564
ERROR - 2020-04-07 13:27:14 --> Severity: error --> Exception: syntax error, unexpected '}' /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 564
ERROR - 2020-04-07 13:28:26 --> Severity: 4096 --> Object of class CI_Input could not be converted to string /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 428
ERROR - 2020-04-07 13:28:26 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '>post('id')' at line 6 - Invalid query: SELECT *,b.`nama` AS nama_cust,c.`nama` AS nama_site,c.`phone` AS site_phone,
        c.`taxno` AS site_taxno,c.`alamat` AS site_alamat,c.`email` AS site_email FROM erp_gmedia.`order_header` a 
        LEFT JOIN erp_gmedia.`ms_customers` b ON a.`id_cust`=b.`id`
        LEFT JOIN erp_gmedia.`ms_site` c ON a.`id_site`=c.`id`
        LEFT JOIN erp_gmedia.`ms_region` d ON c.`id_region`=d.`id`
        WHERE a.`id`=->post('id')
ERROR - 2020-04-07 06:28:30 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 13:28:35 --> Severity: 4096 --> Object of class CI_Input could not be converted to string /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 428
ERROR - 2020-04-07 13:28:35 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '>post('id')' at line 6 - Invalid query: SELECT *,b.`nama` AS nama_cust,c.`nama` AS nama_site,c.`phone` AS site_phone,
        c.`taxno` AS site_taxno,c.`alamat` AS site_alamat,c.`email` AS site_email FROM erp_gmedia.`order_header` a 
        LEFT JOIN erp_gmedia.`ms_customers` b ON a.`id_cust`=b.`id`
        LEFT JOIN erp_gmedia.`ms_site` c ON a.`id_site`=c.`id`
        LEFT JOIN erp_gmedia.`ms_region` d ON c.`id_region`=d.`id`
        WHERE a.`id`=->post('id')
ERROR - 2020-04-07 13:29:48 --> Severity: Notice --> Undefined variable: contact /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 544
ERROR - 2020-04-07 13:29:48 --> Severity: Warning --> Invalid argument supplied for foreach() /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 544
ERROR - 2020-04-07 13:29:48 --> Severity: Notice --> Undefined variable: table /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 687
ERROR - 2020-04-07 13:30:26 --> Severity: Notice --> Undefined variable: table /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 687
ERROR - 2020-04-07 06:31:10 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 06:32:01 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 06:32:36 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 06:32:40 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 06:33:30 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 06:33:43 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 06:34:20 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 06:34:51 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 06:37:30 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-04-07 06:37:30 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-04-07 06:37:30 --> 404 Page Not Found: Select_data_monthly/2020
ERROR - 2020-04-07 06:37:30 --> 404 Page Not Found: Select_data_cash_month/2020
ERROR - 2020-04-07 06:37:30 --> 404 Page Not Found: Select_data_income_expenses/2020
ERROR - 2020-04-07 13:43:34 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-07 13:43:34 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-07 13:43:36 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-30'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-04-30'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-04-30')
ERROR - 2020-04-07 13:56:12 --> Query error: Unknown column 'e.nama' in 'field list' - Invalid query: SELECT *,b.`nama` AS nama_cust,c.`nama` AS nama_site,c.`phone` AS site_phone,
        c.`taxno` AS site_taxno,c.`alamat` AS site_alamat,c.`email` AS site_email,e.`nama` AS nama_cp,e.`jabatan` AS jabatan_cp,
        e.`datebirth` AS tgl_cp,e.`phone` AS phone_cp,e.`email` AS email_cp,e.`flag` AS flag_cp FROM erp_gmedia.`order_header` a 
        LEFT JOIN erp_gmedia.`ms_customers` b ON a.`id_cust`=b.`id`
        LEFT JOIN erp_gmedia.`ms_site` c ON a.`id_site`=c.`id`
        LEFT JOIN erp_gmedia.`ms_region` d ON c.`id_region`=d.`id`
        WHERE a.`id`='1'
ERROR - 2020-04-07 14:29:22 --> Query error: Unknown column 'f.status=1' in 'where clause' - Invalid query: SELECT *,b.`nama` AS nama_cust,b.`datebirth` AS cust_datebirth,c.`nama` AS nama_site,c.`phone` AS site_phone,
        c.`taxno` AS site_taxno,c.`alamat` AS site_alamat,c.`email` AS site_email,e.`nama` AS nama_cp,e.`jabatan` AS jabatan_cp,
        e.`datebirth` AS tgl_cp,e.`phone` AS phone_cp,e.`email` AS email_cp,e.`flag` AS flag_cp,c.`wakil` AS site_wakil,
        c.`jobwakil` AS site_jobwakil,c.`emailwakil` AS site_emailwakil,c.`datebirth` AS site_datebirthwakil,c.`phonewakil` AS site_phonewakil,
        g.`label` AS ms_layanan_label,a.`tanggal` AS tgl_start_billing
        FROM erp_gmedia.`order_header` a 
        LEFT JOIN erp_gmedia.`ms_customers` b ON a.`id_cust`=b.`id`
        LEFT JOIN erp_gmedia.`ms_site` c ON a.`id_site`=c.`id`
        LEFT JOIN erp_gmedia.`ms_region` d ON c.`id_region`=d.`id`
        LEFT JOIN erp_gmedia.`ms_contact` e ON e.`id_cust`=a.`id_cust` AND e.`id_site`=a.`id_site`
        LEFT JOIN erp_gmedia.`order_service` f ON a.`id`=f.`id_order`
        LEFT JOIN erp_gmedia.`ms_layanan` g ON f.`id_serv`=g.`id`
        WHERE a.`id`='1' AND f.`status=1`
ERROR - 2020-04-07 07:34:56 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 14:37:45 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-07 14:37:45 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-07 14:37:47 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-30'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-04-30'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-04-30')
ERROR - 2020-04-07 07:44:30 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 07:45:34 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 07:47:10 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 07:48:02 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 07:48:50 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 14:52:37 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-07 14:52:37 --> Severity: Notice --> Undefined index: level /data/www/html/erpsmg/finance_gmedia/application/helpers/gitcms_helper.php 679
ERROR - 2020-04-07 14:52:40 --> Query error: Unknown column 'id_invoice' in 'where clause' - Invalid query: SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '2020-04-30'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '8'
			AND a.tanggal <= '2020-04-30'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '2020-04-30')
ERROR - 2020-04-07 07:54:09 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 15:09:24 --> Severity: Notice --> Undefined property: stdClass::$ /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 611
ERROR - 2020-04-07 15:09:38 --> Severity: Notice --> Undefined property: stdClass::$ /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 611
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 441
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 443
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 445
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 460
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 464
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 468
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 480
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 484
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 488
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 492
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 498
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 502
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 508
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 512
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 518
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 522
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 528
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 532
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 538
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 541
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 544
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 547
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 550
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 581
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 587
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 589
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 591
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 594
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 596
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 598
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 600
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 602
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 604
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 607
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 609
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 612
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 614
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 623
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 627
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 631
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 637
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 641
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 645
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 649
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 655
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 659
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 663
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 690
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 789
ERROR - 2020-04-07 15:21:59 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 793
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 441
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 443
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 445
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 460
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 464
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 468
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 480
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 484
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 488
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 492
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 498
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 502
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 508
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 512
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 518
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 522
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 528
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 532
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 538
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 541
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 544
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 547
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 550
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 581
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 587
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 589
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 591
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 594
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 596
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 598
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 600
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 602
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 604
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 607
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 609
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 612
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 614
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 623
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 627
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 631
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 637
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 641
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 645
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 649
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 655
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 659
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 663
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 690
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 789
ERROR - 2020-04-07 15:23:07 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 793
ERROR - 2020-04-07 08:23:12 --> 404 Page Not Found: Assets/js
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 441
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 443
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 445
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 460
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 464
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 468
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 480
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 484
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 488
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 492
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 498
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 502
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 508
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 512
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 518
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 522
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 528
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 532
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 538
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 541
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 544
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 547
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 550
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 581
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 587
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 589
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 591
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 594
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 596
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 598
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 600
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 602
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 604
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 607
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 609
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 612
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 614
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 623
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 627
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 631
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 637
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 641
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 645
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 649
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 655
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 659
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 663
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 690
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 789
ERROR - 2020-04-07 15:23:31 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 793
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 441
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 443
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 445
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 460
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 464
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 468
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 480
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 484
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 488
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 492
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 498
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 502
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 508
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 512
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 518
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 522
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 528
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 532
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 538
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 541
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 544
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 547
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 550
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 581
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 587
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 589
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 591
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 594
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 596
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 598
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 600
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 602
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 604
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 607
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 609
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 612
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 614
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 623
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 627
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 631
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 637
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 641
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 645
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 649
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 655
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 659
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 663
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 690
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 789
ERROR - 2020-04-07 15:23:57 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 793
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 462
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 466
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 470
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 482
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 486
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 490
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 494
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 500
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 504
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 510
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 514
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 520
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 524
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 530
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 534
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 540
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 543
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 546
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 549
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 552
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 583
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 589
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 591
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 593
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 596
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 598
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 600
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 602
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 604
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 606
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 609
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 611
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 614
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 616
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 625
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 629
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 633
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 639
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 643
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 647
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 651
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 657
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 661
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 665
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 692
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 791
ERROR - 2020-04-07 15:24:20 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 795
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 462
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 466
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 470
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 482
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 486
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 490
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 494
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 500
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 504
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 510
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 514
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 520
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 524
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 530
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 534
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 540
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 543
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 546
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 549
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 552
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 635
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 639
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 643
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 649
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 653
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 657
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 661
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 667
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 671
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 675
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 702
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 801
ERROR - 2020-04-07 15:25:16 --> Severity: Notice --> Trying to get property of non-object /data/www/html/erpsmg/finance_gmedia/application/models/Model_finance_customer_data_aktif.php 805
ERROR - 2020-04-07 15:42:15 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Cannot assign requested address /data/www/html/erpsmg/finance_gmedia/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2020-04-07 15:42:15 --> Unable to connect to the database
