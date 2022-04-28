INSERT INTO apps.gmd_customer_product(customer_id, product_id_new, product_value, currency, product_price, satuan_bandwidth) SELECT customer_id, product_id, product_value, currency, product_price, satuan_bandwidth FROM app_lawas.inv_customer_service

UPDATE gmd_customer_product set product_id = product_id_new

http://localhost/apps/genset/repair_product/20
http://localhost/apps/genset/repair_product/57
http://localhost/apps/genset/repair_product/63
http://localhost/apps/genset/repair_product/73
http://localhost/apps/genset/repair_product/81
http://localhost/apps/genset/repair_product/95
http://localhost/apps/genset/repair_product/96

http://localhost/apps/migrasi/repair_customer_product/20
http://localhost/apps/migrasi/repair_customer_product/57
http://localhost/apps/migrasi/repair_customer_product/63
http://localhost/apps/migrasi/repair_customer_product/73
http://localhost/apps/migrasi/repair_customer_product/81
http://localhost/apps/migrasi/repair_customer_product/95
http://localhost/apps/migrasi/repair_customer_product/96

select distinct(product_id) from gmd_customer_product


=======================================================================================================================================================
//dedi
insert into apps.gmd_product (code, name, category, note, price) select id, product_name, up, note, price from app_lawas.inv_product where up = '1'

//sme value
insert into apps.gmd_product (code, name, category, note, price) select id, product_name, up, note, price from app_lawas.inv_product where up = '57'

//GAME NET
insert into apps.gmd_product (code, name, category, note, price) select id, product_name, up, note, price from app_lawas.inv_product where up = '63'

//WARNET
insert into apps.gmd_product (code, name, category, note, price) select id, product_name, up, note, price from app_lawas.inv_product where up = '73'

//matrix
insert into apps.gmd_product (code, name, category, note, price) select id, product_name, up, note, price from app_lawas.inv_product where up = '81'

//gforce
insert into apps.gmd_product (code, name, category, note, price) select id, product_name, up, note, price from app_lawas.inv_product where up = '95'

//broadband
insert into apps.gmd_product (code, name, category, note, price) select id, product_name, up, note, price from app_lawas.inv_product where up = '96'

//dedicated maxi
insert into apps.gmd_product (code, name, category, note, price) select id, product_name, up, note, price from app_lawas.inv_product where up = '20'

//custom
insert into apps.gmd_product (code, name, category, note, price) select id, product_name, up, note, price from app_lawas.inv_product where up = '35'

//colocation
insert into apps.gmd_product (code, name, category, note, price) select id, product_name, up, note, price from app_lawas.inv_product where up = '4'

//lain lain
insert into apps.gmd_product (code, name, category, note, price) select id, product_name, up, note, price from app_lawas.inv_product where id in ('17', '8', '16', '20', '23', '22', '63', '9', '10', '81', '11', '57', '96', '95')
