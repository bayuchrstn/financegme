<?php
	// pre($dashboard_ro_request);
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
		if(!empty($dashboard_ri_request)):
			foreach($dashboard_ri_request as $row):
				$lokasi = $this->location->show($row['location'], $row['location_id']);
	?>
		<tr>
			<td><?php echo $row['date_start']; ?></td>
			<td><?php echo $row['author_name']; ?></td>
			<td><?php echo $lokasi; ?></td>
		</tr>

	<?php
			endforeach;
		endif;
	?>
	</tbody>
</table>
