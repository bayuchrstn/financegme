<?php
	$current_item_out = array();
?>
<label for="" class="table-form-label">Daftar Barang Dipasang</label>
<table class="table table-bordered table-form">
	<thead>
		<tr class="bg-info">
			<th class="text-center">#</th>
			<th class="text-center">Brand / Category / Name</th>
			<th class="text-center">Nomor Barang / Mac address</th>
			<th class="text-center">Cancel</th>
		</tr>
	</thead>
	<?php
		if(!empty($current_item_out)):
	?>
	<tbody>
		<?php
			$urut = 1;
			$arr_jumlah = array();
			for($i=1; $i<=500; $i++):
				$arr_jumlah[$i] = $i;
			endfor;

			$master_status_kepemilikan = $this->master->arr('item_installed_owner_status');

			foreach($current_item_out as $row):
				// pre($row);
				$item_info = $this->bcn->item_info($row['item_id']);
				// pre($item_info);

				$jumlah = form_dropdown('current_qty', $arr_jumlah, $row['qty'], 'class="current_updater_btn" id="current_qty_'.$urut.'"');
				$status = form_dropdown('current_status', $master_status_kepemilikan, $row['owner_status'], 'class="current_updater_btn" id="current_status_'.$urut.'"');

		?>
		<tr id="<?php echo $urut ?>">
			<td><?php echo $item_info ?></td>
			<td><?php echo $jumlah; ?></td>
			<td><?php echo $status; ?></td>
			<td class="text-center">
				<a class="text-danger cart_remover_btn" href=""><i class="icon-trash"></i></a>
				<!-- Hidden Data -->
				<input type="hidden" name="current_id" id="current_id_<?php echo $urut; ?>" value="<?php echo $row['id']; ?>">
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
