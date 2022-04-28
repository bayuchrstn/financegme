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

<?php if(!empty($data_in)): ?>
<br>
<div class="table-form-label">
	Daftar Barang Kembali
</div>
<table class="table table-bordered">
	<thead>
		<tr class="bg-warning">
			<th class="text-center">Nama Barang</th>
			<th class="text-center">Nomor barang</th>
			<th class="text-center">Kondisi</th>
			<th class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($data_in as $row):
				// pre($row);

				$nomor_mac = $this->bcn->item_detail_info($row['item_detail_id'], 'nomor_mac');
				$item_id = $this->bcn->item_detail_info($row['item_detail_id'], 'item_id');
				$bcn = $this->bcn->item_info($item_id);

				$kondisi = $this->master->master_name_by_code('kondisi_barang_kembali', $row['codition']);
		?>
		<tr>
			<td><?php echo $bcn; ?></td>
			<td><?php echo $nomor_mac; ?></td>
			<td><?php echo $kondisi; ?></td>
			<td class="text-center">
				<ul class="icons-list">
					<li><a href="javascript:void(0);" onclick="current_update('in', '<?php echo $row['id']; ?>')"><i class="icon-pencil7 text-success"></i></a></li>
					<li><a href="javascript:void(0);" onclick="current_delete('in', '<?php echo $row['id']; ?>')"><i class="icon-trash text-danger"></i></a></li>
				</ul>
			</td>
		</tr>
		<?php
			endforeach;
		?>
	</tbody>
</table>
<?php endif; ?>
<br>
