truncate gmd_customer;
truncate gmd_customer_group;
truncate gmd_customer_product;


INSERT INTO apps.gmd_customer_product(customer_id, product_id_new, product_value, currency, product_price, satuan_bandwidth) SELECT customer_id, product_id, product_value, currency, product_price, satuan_bandwidth FROM app_lawas.inv_customer_service

UPDATE gmd_customer_product set product_id = product_id_new

ALTER TABLE `gmd_customer`
ADD `isp_lama` varchar(500) COLLATE 'latin1_swedish_ci' NULL,
ADD `bw_isp_lama` varchar(500) COLLATE 'latin1_swedish_ci' NULL AFTER `isp_lama`,
ADD `harga_isp_lama` int(11) NULL AFTER `bw_isp_lama`,
ADD `jumlah_pengguna` varchar(500) COLLATE 'latin1_swedish_ci' NULL AFTER `harga_isp_lama`,
ADD `sumber` varchar(500) COLLATE 'latin1_swedish_ci' NULL AFTER `jumlah_pengguna`;
