<?php
	// pre($layanan);
	$jumlah_layanan = count($layanan);
	// pre($jumlah_layanan);
?>

<?php if($jumlah_layanan=='1'): ?>
<?php echo $layanan[0]['product_name'].' '.$layanan[0]['value'].' '.$layanan[0]['satuan_bandwidth']; ?>
<?php endif; ?>
