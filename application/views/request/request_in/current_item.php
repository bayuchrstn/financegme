<?php
	// pre($current_item_out);
?>
<label class="table-form-label">Daftar Barang dikembalikan</label>
<table class="table table-bordered">
	<thead>
		<tr class="bg-info">
			<th>Brand / Category / Name</th>
			<th>Nama Barang</th>
			<th>Kondisi</th>
			<th>Hapus</th>
		</tr>
	</thead>
	<?php
		if(!empty($current_item_out)):
	?>
	<tbody>
		<?php
			$urut = 1;
			// $arr_jumlah = array();
			// for($i=1; $i<=500; $i++):
			// 	$arr_jumlah[$i] = $i;
			// endfor;
			//
			// $master_status_kepemilikan = $this->master->arr('item_installed_owner_status');

			foreach($current_item_out as $row):
				// pre($row);
				$nomor_mac = $this->bcn->item_detail_info($row['item_detail_id'], 'nomor_mac');
				$item_id = $this->bcn->item_detail_info($row['item_detail_id'], 'item_id');
				$bcn = $this->bcn->item_info($item_id);

		?>
		<tr id="<?php echo $urut ?>">
			<td><?php echo $bcn; ?></td>
			<td><?php echo $nomor_mac; ?></td>
			<td><?php echo $row['codition']; ?></td>
			<td class="text-center">
				<a class="text-danger cart_remover_btn" href=""><i class="icon-trash"></i></a>
				<!-- Hidden Data -->
				<input type="hidden" name="current_id" id="current_id_<?php echo $urut; ?>" value="<?php //echo $row['id']; ?>">
				<!-- Hidden Data -->
			</td>
		</tr>
		<?php
				$urut++;
			endforeach;
		?>
	</tbody>
	<?php
		endif;
	?>
</table>
<br>
