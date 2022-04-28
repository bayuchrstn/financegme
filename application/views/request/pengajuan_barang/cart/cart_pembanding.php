<?php
	$arr = array();
	if(!empty($carts)):
		foreach($carts as $cart):
			if($cart['options']['type']=='pembanding'):
				// pre($cart);
				$arr[] = $cart;
			endif;
		endforeach;
	endif;
	// pre($prefix);
?>
<?php if(!empty($arr)): ?>
<div class="table-form-label">
	Pembanding
</div>
<table class="table table-bordered">
	<thead>
		<tr class="bg-info">
			<th class="text-center">#</th>
			<th class="text-center">Nama</th>
			<th class="text-center">Supplier</th>
			<th class="text-center">qty</th>
			<th class="text-center">@satuan</th>
			<th class="text-center">Total</th>
			<th class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>

		<?php
			$urut = 1;
			foreach($arr as $row):
				// pre($row);
				$nama = $row['name'];
				$real_id = 	substr($nama, 0, -11);
				// pre($real_id);
				$supplier = $row['options']['supplier'];
				$supplier = $this->supplier->detail($supplier);


				if($row['options']['mode']=='custom'):
					$iname = $row['name'];
				else:
					$bcn = $this->bcn->item_info($real_id);
					$iname = $bcn;
				endif;
		?>
		<tr>
			<td class="text-center"><?php echo $urut; ?></td>
			<td><?php echo $iname; ?></td>
			<td><?php echo $supplier['supplier_name']; ?></td>
			<td class="text-center"><?php echo $row['qty']; ?></td>
			<td class="text-right"><?php echo currency($row['price']); ?></td>
			<td class="text-right"><?php echo currency($row['subtotal']); ?></td>
			<td class="text-center">
				<ul class="icons-list">
					<li><a href="javascript:void(0);" onclick="cart_update('<?php echo $row['rowid']; ?>', '<?php echo $prefix; ?>')"><i class="icon-pencil7 text-success"></i></a></li>
					<li><a href="javascript:void(0);" onclick="cart_delete('<?php echo $row['rowid']; ?>', '<?php echo $prefix; ?>')"><i class="icon-trash text-danger"></i></a></li>
				</ul>
			</td>
		</tr>
		<?php
				$urut++;
			endforeach;
		?>
	</tbody>
</table>
<?php endif; ?>
