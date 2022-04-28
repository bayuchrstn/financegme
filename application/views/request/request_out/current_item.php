<?php
	// pre($current_item_out);
?>
<table class="table table-bordered">
	<thead>
		<tr class="bg-info">
			<th>#</th>
			<th>Nama Barang</th>
			<th>Nomor barang / Mac Address</th>
			<th>Hapus</th>
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

				if($row['item_detail_id'] !='' && $row['approved_by'] !='' ):
					$info_detail = $this->bcn->item_detail_info($row['item_detail_id'], 'nomor_mac');
				else:
					$info_detail = 'belum diapprove';
				endif;
				$status = form_dropdown('current_status', $master_status_kepemilikan, $row['owner_status'], 'class="current_updater_btn" id="current_status_'.$urut.'"');

		?>
		<tr id="<?php echo $urut ?>">
			<td><?php echo $urut; ?></td>
			<td><?php echo $item_info ?></td>
			<td><?php echo $info_detail; ?></td>
			<td class="text-center">
				<a onclick="item_out_editor('<?php echo $urut; ?>', '<?php echo $row['id']; ?>')" href="javascript:void(0)">Edit</a>
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
