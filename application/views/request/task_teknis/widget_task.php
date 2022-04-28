<?php
// pre($task_lists);
?>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Judul</th>
			<th>Tgl Mulai</th>
			<th>Lokasi</th>
			<!-- <th width="150">pelaksana</th> -->
		</tr>
	</thead>
	<tbody>
	<?php if(!empty($task_lists)): ?>
		<?php
			foreach($task_lists as $row):
				//lokasi
				$lokasi = $this->location->show($row['location'], $row['location_id']);
				//pelaksana
				$pelaksana = $this->request->get_user_assigned($row['id']);
				$pelaksana = implode(", ", $pelaksana);
		?>
		<tr>
			<td><a onclick="task_show_this('<?php echo $row['id'] ?>');" href="javascript:void(0);"><?php echo clean_string($row['subject'], '60'); ?></a></td>
			<td><?php echo format_date($row['date_start']); ?></td>
			<td><?php echo $lokasi; ?></a></td>
			<!-- <td><?php echo $pelaksana; ?></td> -->
		</tr>
		<?php
			endforeach;
		?>

	<?php else: ?>
		<tr>
			<td colspan="5" class="text-center">Task Tidak Ada</td>
		</tr>
	<?php endif; ?>
</tbody>
</table>

<script type="text/javascript">
	function task_show_this(x)
	{
		console.log(x);
		$("#xshow_detail_pekerjaan_div").load("<?php echo base_url(); ?>pekerjaan_teknis/show/"+x+"/echo");
		$('#modal_tab_detail_pekerjaan').modal('show');
	}
</script>
