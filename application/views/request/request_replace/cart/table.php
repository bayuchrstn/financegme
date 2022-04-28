<?php
	$arr_out = array();
	$arr_in = array();
	$carts = $this->cart->contents();
	if(!empty($carts)):
		foreach($carts as $cart):
			if($cart['options']['type']=='in'):
				$arr_in[] = $cart;
			else:
				$arr_out[] = $cart;
			endif;
		endforeach;
	endif;
?>

<?php if(!empty($arr_out)): ?>
<div class="table-form-label">
	Daftar Barang Keluar
</div>
<table class="table table-bordered">
	<thead class="bg-info">
		<tr>
			<th class="text-center">Nama Barang</th>
			<th class="text-center">Jumlah</th>
			<th class="text-center">Status</th>
			<th class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($arr_out as $row):
				// pre($row);
				$item_info = $this->bcn->item_info($row['id']);
				$status_kepemilikan = $row['options']['status_kepemilikan'];
		?>
		<tr>
			<td><?php echo $item_info; ?></td>
			<td><?php echo paranoid($row['qty']); ?></td>
			<td><?php echo $status_kepemilikan; ?></td>
			<td class="text-center">
				<ul class="icons-list">
					<li><a href="javascript:void(0);" onclick="cart_update_out('<?php echo $row['rowid']; ?>', '<?php echo $prefix; ?>')"><i class="icon-pencil7 text-success"></i></a></li>
					<li><a href="javascript:void(0);" onclick="cart_delete('<?php echo $row['rowid']; ?>', '<?php echo $prefix; ?>')"><i class="icon-trash text-danger"></i></a></li>
				</ul>
			</td>
		</tr>
		<?php
			endforeach;
		?>
	</tbody>

</table>
<?php endif; ?>

<?php if(!empty($arr_in)): ?>
<br>
<div class="table-form-label">
	Daftar Barang masuk
</div>
<table class="table table-bordered">
	<thead>
		<tr class="bg-info">
			<th class="text-center">Nama Barang</th>
			<th class="text-center">Nomor barang</th>
			<th class="text-center">Kondisi</th>
			<th class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($arr_in as $row):
				// pre($row);

				$nomor_mac = $this->bcn->item_detail_info($row['id'], 'nomor_mac');
				$item_id = $this->bcn->item_detail_info($row['id'], 'item_id');
				$bcn = $this->bcn->item_info($item_id);

				$kondisi = $this->master->master_name_by_code('kondisi_barang_kembali', $row['options']['condition']);
		?>
		<tr>
			<td><?php echo $bcn; ?></td>
			<td><?php echo $nomor_mac; ?></td>
			<td><?php echo $kondisi; ?></td>
			<td class="text-center">
				<ul class="icons-list">
					<li><a href="javascript:void(0);" onclick="cart_update_in('<?php echo $row['rowid']; ?>', '<?php echo $prefix; ?>')"><i class="icon-pencil7 text-success"></i></a></li>
					<li><a href="javascript:void(0);" onclick="cart_delete('<?php echo $row['rowid']; ?>', '<?php echo $prefix; ?>')"><i class="icon-trash text-danger"></i></a></li>
				</ul>
			</td>
		</tr>
		<?php
			endforeach;
		?>
	</tbody>
</table>
<?php endif; ?>
