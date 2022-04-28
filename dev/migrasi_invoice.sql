insert into gmd_invoice (
`date`, `number`, `id_customer`, `note`, `total`, `ppn`, `ppn_mode`, `invoice_month`, `invoice_year`, `info_date`, `info_due_date`, `info_periode`, `invoice_order`, `item`, `diskon`, `prorate`, `status`, `category`, `flag_edit`, `flag_approved`, `flag_print`, `flag_paid`, `flag_delete`, `re_print`, `flag_onetime`, `bank1`, `bank2`, `regional`, `area`)
select `date`, `number`, `id_customer`, `note`, `total`, `ppn`, `ppn_mode`, `invoice_month`, `invoice_year`, `info_date`, `info_due_date`, `info_periode`, `invoice_order`, `product_value`, `pengurangan`, `prorate`, `status`, CONCAT(''), `flag_edit`, `flag_approved`, `flag_print`, `flag_paid`, `flag_delete`, `re_print`, `flag_onetime`, `bank_first`, `bank_second`, CONCAT(''), CONCAT('')
from apps_lawas.inv_invoice;

-----------------------------------------------------------------------------------------------------------
v
v
v

drop table gmd_invoice;

create table gmd_invoice select * from apps_lawas.inv_invoice;

    ALTER TABLE `gmd_invoice`
ADD `regional` varchar(50) COLLATE 'latin1_swedish_ci' NULL,
ADD `area` varchar(50) COLLATE 'latin1_swedish_ci' NULL AFTER `regional`;


ALTER TABLE `gmd_invoice`
ADD `category` varchar(50) COLLATE 'latin1_swedish_ci' NULL AFTER `prorate`;

ALTER TABLE `gmd_invoice`
CHANGE `product_value` `items` text COLLATE 'latin1_swedish_ci' NULL AFTER `invoice_order`,
CHANGE `pengurangan` `diskon` text COLLATE 'latin1_swedish_ci' NULL AFTER `items`;

ALTER TABLE `gmd_invoice`
ADD `biggest` varchar(1) COLLATE 'latin1_swedish_ci' NULL;






update gmd_invoice set regional='01', area='jogja';

update gmd_invoice set category='ppn' where (ppn='1' and maxi='0');
update gmd_invoice set category='non_ppn' where (ppn='0' and maxi='0' and cabang='0' and custom='0');

update gmd_invoice set status='edit' where (flag_edit='0' and flag_approved='0' and flag_print='0' );
update gmd_invoice set status='ready' where (flag_edit='1' and flag_approved='0' and flag_print='0' );
update gmd_invoice set status='approved' where (flag_edit='1' and flag_approved='1' and flag_print='0' );
update gmd_invoice set status='printed' where (flag_edit='1' and flag_approved='1' and flag_print='1' );
