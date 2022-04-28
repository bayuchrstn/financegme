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
