<?php
	// pre($person_id);
?>
<table class="table table-striped">
	<thead>
		<tr>
			<th class="text-center">#</th>
			<th class="text-center">Nama</th>
			<th class="text-center">Kota</th>
			<th class="text-center">Gelar</th>
			<th class="text-center">Mulai</th>
			<th class="text-center">Selesai</th>
			<th class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
			if(!empty($ext)):
				$urut =0;
				foreach($ext as $row):
					// pre($row);
					$urut++;
		?>
		<tr>
			<td><?php echo $urut; ?></td>
			<td><?php echo $row['nama']; ?></td>
			<td><?php echo $row['kota']; ?></td>
			<td><?php echo $row['gelar']; ?></td>
			<td><?php echo $row['mulai']; ?></td>
			<td><?php echo $row['selesai']; ?></td>
			<td class="text-center">
				<ul class="icons-list">
					<li><a onclick="update_ext('<?php echo $row['id']; ?>')" href="javascript:void(0);"><i class="icon-pencil7"></i></a></li>
					<li><a onclick="delete_ext('<?php echo $row['id']; ?>')" href="javascript:void(0);"><i class="icon-trash"></i></a></li>
				</ul>
			</td>
		</tr>
		<?php
				endforeach;
			else:
		?>
		<tr>
			<td colspan="7" class="text-center">Data Tidak Ada</td>
		</tr>
		<?php
			endif;
		?>

	</tbody>
</table>

<div class="row mt-20">
	<div class="col-lg-12 text-right">
		<a href="javascript:void(0);" onclick="input_ext('pendidikan', '<?php echo $person_id; ?>')" class="btn btn-success"><i class="icon-plus3 position-left"></i>Tambah Riwayat Pendidikan</a>
	</div>
</div>
