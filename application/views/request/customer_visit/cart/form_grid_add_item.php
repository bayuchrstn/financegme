<?php
	$default_value = array();
	$default_value['qty'] = '1';
	$prefix = 'insert';
	$bcn_forms = $this->ui->forms('bcn', $default_value, $prefix);
	$pengadaan_forms = $this->ui->forms('task_boq', $default_value, $prefix);
?>

<div id="form_boq_msg_div"></div>

<?php
	echo $pengadaan_forms['item_selector'];
?>

<div id="barang_div">
	<?php echo $bcn_forms['item_brand']; ?>
	<?php echo $bcn_forms['item_category']; ?>
	<?php echo $bcn_forms['item_name']; ?>
</div>

<div id="custom_div" class="hidden">
	<?php echo $pengadaan_forms['item_id_custom']; ?>
</div>

<input type="hidden" name="prefix" id="prefix_fcart" value="">


<?php
	echo $pengadaan_forms['supplier'];
	echo $pengadaan_forms['qty'];
	echo $pengadaan_forms['price'];
?>

<script type="text/javascript">
// if( $('.numeric').length ) {
// 	$('.numeric').numeric();
// }
</script>
