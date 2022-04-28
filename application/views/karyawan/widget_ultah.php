<table class="table">
	<thead class="bg-slate-300">
		<tr>
			<th>Nama</th>
			<th>Tanggal</th>
			<th>Ultah ke</th>
		</tr>
	</thead>
	<tbody>
	<?php
		if(!empty($ultah)):
	?>
		<?php
			foreach($ultah as $row):
		?>
		<tr>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['tanggal_ultah']; ?></td>
			<td><?php echo $row['ultah_ke']; ?></td>
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