<!-- dashboard_mr_belum_dijadwalkan -->

<table class="table">
	<thead class="bg-slate-300">
		<tr>
			<th>Tanggal</th>
			<th>lokasi</th>
			<th>Judul</th>
		</tr>
	</thead>
	<tbody>
	<?php
		if(!empty($dashboard_mr_belum_dijadwalkan)):
	?>
		<?php
			foreach($dashboard_mr_belum_dijadwalkan as $row):
				// pre($row);
				//lokasi
				$lokasi = $this->location->show($row['location'], $row['location_id']);
		?>
		<tr>
			<td><?php echo $row['date_start']; ?></td>
			<td><?php echo $lokasi; ?></td>
			<td><a onclick="mp_show_this('<?php echo $row['id'] ?>');" href="javascript:void(0);"><?php echo $row['subject']; ?></a></td>

		</tr>
		<?php
			endforeach;
		else:
		?>
		<tr>
			<td colspan="3" class="text-center">Data tidak ada</td>
		</tr>
	<?php
		endif;
	?>
	</tbody>
</table>
