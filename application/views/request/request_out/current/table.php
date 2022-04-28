<?php
    // pre($data_in);
    // pre($data_out);
?>


<?php if(!empty($data_out)): ?>
<div class="table-form-label">
	Daftar Barang Keluar
</div>
<table class="table table-bordered">
	<thead class="bg-warning">
		<tr>
			<th width="8" class="text-center">#</th>
			<th class="text-center">Nama Barang</th>
			<th class="text-center">Status</th>
			<th class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
            $urut = 1;
			foreach($data_out as $row):
				// pre($row);
				$item_info = $this->bcn->item_info($row['item_id']);
				$status_kepemilikan = $row['owner_status'];
		?>
		<tr>
			<td><?php echo $urut; ?></td>
			<td><?php echo $item_info; ?></td>
			<td><?php echo $status_kepemilikan; ?></td>
			<td class="text-center">
				<ul class="icons-list">
					<li><a href="javascript:void(0);" onclick="current_update('out', '<?php echo $row['id']; ?>')"><i class="icon-pencil7 text-success"></i></a></li>
					<li><a href="javascript:void(0);" onclick="current_delete('out', '<?php echo $row['id']; ?>')"><i class="icon-trash text-danger"></i></a></li>
				</ul>
			</td>
		</tr>
		<?php
                $urut++;
			endforeach;
		?>
	</tbody>

</table>
<?php endif; ?>


<br>
