<table class="table table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Nama Dokumen</th>
			<th>File</th>
			<th>Action</th>
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
			<td><?php echo $row['dokumen_name']; ?></td>
			<td><?php echo $row['file_name']; ?></td>
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
		<a href="javascript:void(0);" onclick="input_ext('dokumen', '<?php echo $person_id; ?>')" class="btn btn-success"><i class="icon-plus3 position-left"></i>Tambah Dokumen</a>
	</div>
</div>
