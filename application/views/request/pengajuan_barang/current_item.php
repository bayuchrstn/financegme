<?php
	// pre($current_item_out);
?>
<table class="table table-bordered">
	<thead>
		<tr class="bg-info">
			<th width="5" class="text-center">#</th>
			<th width="50%" class="text-center">Nama Barang</th>
			<th class="text-center">Nomor barang / Mac Address</th>
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

				if($row['item_detail_id'] !='' && $row['approved_by'] !='' ):
					$info_detail = $this->bcn->item_detail_info($row['item_detail_id'], 'nomor_mac');
				else:
					$info_detail = 'pilih barang';
				endif;

				$detail_barang_picker = '<a onclick="pilih_barang_keluar(\''.$urut.'\', \''.$row['id'].'\');" class="text-danger">'.$info_detail.'</a>';
		?>
		<tr id="<?php echo $urut ?>">
			<td><?php echo $urut; ?></td>
			<td><?php echo $item_info ?></td>
			<td>
				<div id="picker_div_<?php echo $urut; ?>">
					<?php echo $detail_barang_picker; ?>
				</div>
			</td>
		</tr>
		<?php
					$urut++;
				// endfor;
			endforeach;
		?>
	</tbody>
	<?php
		endif;
	?>
</table>
<br>

<script type="text/javascript">

</script>
