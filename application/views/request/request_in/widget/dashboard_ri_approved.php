<?php
	// pre($dashboard_ro_approved);
?>
<table class="table">
	<thead class="bg-slate-300">
		<tr>
			<th>Tanggal</th>
            <th>Dari</th>
			<th>lokasi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		if(!empty($dashboard_ri_approved)):
			foreach($dashboard_ri_approved as $row):
				$lokasi = $this->location->show($row['location'], $row['location_id']);
	?>
		<tr>
			<td><?php echo $row['date_start']; ?></td>
			<td><?php echo $row['author_name']; ?></td>
			<td><?php echo $lokasi; ?></td>
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
