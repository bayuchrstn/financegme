<?php
	// pre($items);
?>

<?php if(!empty($items)): ?>
<div class="table-form-label">
	Daftar Item
</div>
<table class="table table-bordered table-form">
	<thead class="bg-success">
		<tr>
			<th class="text-center">#</th>
			<th class="text-center">Nama</th>
			<!-- <th class="text-center">Supplier</th> -->
			<th class="text-center">qty</th>
			<!-- <th class="text-center">@satuan</th> -->
			<!-- <th class="text-center">Total</th> -->
		</tr>
	</thead>
	<tbody>

		<?php
			$urut = 1;
			foreach($items as $row):
				// pre($row);
				$item_id = $row['item_id'];
				$supplier = $row['supplier'];
				$supplier = $this->supplier->detail($supplier);


				if($row['mode']=='custom'):
					$iname = $row['item_id'];
				else:
					$bcn = $this->bcn->item_info($item_id);
					$iname = $bcn;
				endif;

				$int_qty = (int) $row['qty'];
				$int_price = (int) $row['price'];
				$subtotal = $int_qty * $int_price;
		?>
		<tr>
			<td class="text-center"><?php echo $urut; ?></td>
			<td><?php echo $iname; ?></td>
			<!-- <td><?php echo $supplier['supplier_name']; ?></td> -->
			<td class="text-center"><?php echo $row['qty']; ?></td>
			<!-- <td class="text-right"><?php echo currency($row['price']); ?></td> -->
			<!-- <td class="text-right"><?php echo currency($subtotal); ?></td> -->
		</tr>
		<?php
				$urut++;
			endforeach;
		?>
	</tbody>
</table>

<!-- <a class="btn btn-default" href="#">Status Approval</a> -->
<!-- <a class="btn btn-default" href="#">kirim Email</a> -->
<?php endif; ?>
