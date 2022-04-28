<?php
	$cart = $this->cart->contents();
?>

<?php if(!empty($cart)): ?>
<div class="table-form-label">
	Daftar barang Kembali
</div>
<table class="table table-bordered table-form">
	<thead>
		<tr>
			<td width="8">No</td>
			<td>Brand / Category / Nama</td>
			<td>Nomor barang</td>
			<td>Mac Address</td>
			<td width="90">Kondisi</td>
			<td width="90" class="text-center">Action</td>
		</tr>
	</thead>

	<tbody>
		<?php
			$urut = '1';
			foreach($cart as $row):
				// pre($row);
		?>
		<tr id="<?php echo $urut ?>">
			<td class="text-center"><?php echo $urut; ?></td>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['options']['nomor_barang']; ?></td>
			<td><?php echo $row['options']['mac_address']; ?></td>
			<td>
				<?php
					$arr = array(
							'baik'	=> 'Baik',
							'rusak'	=> 'Rusak'
						);
					echo form_dropdown('cart_kondisi', $arr, $row['options']['kondisi'], 'id="cart_kondisi_'.$urut.'" class="cart_updater_btn"');
				?>
			</td>
			<td class="text-center">
				<a class="text-danger cart_remover_btn" href="<?php echo base_url(); ?>cart/delete/<?php echo $row['rowid']; ?>"><i class="icon-trash"></i></a>
				<!-- Hidden Data -->
				<input type="hidden" name="cart_id" id="cart_id_<?php echo $urut; ?>" value="<?php echo $row['rowid']; ?>">
				<input type="hidden" name="cart_name" id="cart_name_<?php echo $urut; ?>" value="<?php echo $row['name']; ?>">
				<input type="hidden" name="cart_nomor_barang" id="cart_nomor_barang_<?php echo $urut; ?>" value="<?php echo $row['options']['nomor_barang']; ?>">
				<input type="hidden" name="cart_mac_address" id="cart_mac_address_<?php echo $urut; ?>" value="<?php echo $row['options']['mac_address']; ?>">
				<input type="hidden" name="cart_transaction_id" id="cart_transaction_id_<?php echo $urut; ?>" value="<?php echo $row['options']['transaction_id']; ?>">
				<!-- Hidden Data -->
			</td>
		</tr>
		<?php
				$urut++;
			endforeach;
		?>
	</tbody>
</table>
<?php endif; ?>
