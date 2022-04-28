<?php
	// pre($cart_div);
?>
<table class="table border-top table-striped">
	<thead>
		<tr>
			<th>Nama Barang</th>
			<th>Jumlah</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<?php if(!empty($cart)): ?>
	<tbody>
		<?php
			$urut = '1';

			$arr_jumlah = array();
			for($i=1; $i<=500; $i++):
				$arr_jumlah[$i] = $i;
			endfor;

			$master_status_kepemilikan = $this->master->arr('item_installed_owner_status');

			foreach($cart as $row):
				// pre($row);
				// pre($row['options']['item_installed_owner_status']);
				// pre($row['qty']);
				// pre($urut);

				$item_info = $this->bcn->item_info($row['id']);
				// pre($item_info);

				$jumlah = form_dropdown('cart_qty', $arr_jumlah, $row['qty'], 'onchange="cart_update(\''.$urut.'\', \''.$random.'\', \''.$cart_div.'\')" class="cart_updater_btn" id="'.$random.'_cart_qty_'.$urut.'"');
				$status = form_dropdown('cart_status', $master_status_kepemilikan, $row['options']['item_installed_owner_status'], 'class="cart_updater_btn" id="'.$random.'_cart_status_'.$urut.'"');
		?>
		<tr id="<?php echo $urut ?>">
			<td><?php echo $item_info; ?></td>
			<td width="80"><?php echo $jumlah; ?></td>
			<td width="90"><?php echo $status; ?></td>
			<td width="30" class="text-center">
				<a class="text-danger cart_remover_btn" href="<?php echo base_url(); ?>cart/delete/<?php echo $row['rowid']; ?>"><i class="icon-trash"></i></a>
				<!-- Hidden Data -->
				<input type="hidden" name="cart_id" id="<?php echo $random; ?>_cart_id_<?php echo $urut; ?>" value="<?php echo $row['rowid']; ?>">
				<input type="hidden" name="cart_name" id="<?php echo $random; ?>_cart_name_<?php echo $urut; ?>" value="<?php echo $row['name']; ?>">
				<input type="hidden" name="cart_price" id="<?php echo $random; ?>_cart_price_<?php echo $urut; ?>" value="<?php echo $row['price']; ?>">
				<!-- Hidden Data -->
			</td>
		</tr>
		<?php
				$urut++;
			endforeach;
		?>
	</tbody>
<?php else: ?>
<tbody>
	<tr>
		<td colspan="4" class="text-center">Data Kosong</td>
	</tr>
</tbody>
<?php endif; ?>
</table>
