<?php
	// pre($last_mp);
	// pre($modul);
?>
<table class="table">
	<thead class="bg-slate-300">
		<tr>
			<th>Tanggal</th>
			<th>Pre Customer</th>
			<th>Marketing</th>
			<th>Judul</th>
		</tr>
	</thead>
	<tbody>
	<?php
		if(!empty($last_mp)):
	?>
		<?php
			foreach($last_mp as $row):
				// pre($row);
				//lokasi
				$lokasi = $this->location->show($row['location'], $row['location_id']);
		?>
		<tr>
			<td><?php echo $row['date_start']; ?></td>
			<td><?php echo $lokasi; ?></td>
			<td><?php echo $row['author_name']; ?></td>
			<td><a onclick="mp_show_this('<?php echo $row['id'] ?>');" href="javascript:void(0);"><?php echo $row['mp_jenis_name']; ?></a></td>

		</tr>
		<?php
			endforeach;
		else:
		?>
		<tr>
			<td class="text-center" colspan="4">Data tidak ada</td>
		</tr>
	<?php
		endif;
	?>
	</tbody>
</table>

<?php
	$options['component'] = 'component/modal/modal_default';
	$options['modal_id'] = 'modal_detail_mp';
	$options['modal_size'] = 'modal-lg';
	$options['modal_icon'] = '';
	$options['modal_title'] = 'Detail Marketing Progress';
	$options['main_content'] = '<div id="show_detail_mp_div"></div>';
	echo $this->ui->load_component($options);
?>


<script type="text/javascript">
	function mp_show_this(x)
	{
		// alert('oji');
		$("#show_detail_mp_div").load("<?php echo base_url().$modul['url']; ?>/show/"+x+"/echo");
		$('#modal_detail_mp').modal('show');
	}
</script>
