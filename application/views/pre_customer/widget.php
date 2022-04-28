<table class="table">
	<thead class="bg-slate-300">
		<tr>
			<th>Nama</th>
			<th>jenis</th>
			<th>marketing</th>
		</tr>
	</thead>
	<tbody>
		<?php
			if(!empty($new_pre_customer)):
				foreach($new_pre_customer as $row):
		?>
		<tr>
			<td><a onclick="show_pre_customer('<?php echo $row['id'] ?>');" href="javascript:void(0);"><?php echo clean_string($row['customer_name']); ?></a></td>
			<td><?php echo $row['jenis_pelanggan']; ?></td>
			<td><?php echo clean_string($row['am']); ?></td>
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

<?php
	$options['component'] = 'component/modal/modal_default';
	$options['modal_id'] = 'modal_dashboard_detail_pre_customer';
	$options['modal_size'] = 'modal-lg';
	$options['modal_icon'] = 'icon-search4';
	$options['modal_title'] = 'Detail Pre Customer';
	$options['main_content'] = '<div id="modal_dashboard_detail_pre_customer_content_div"></div>';
	echo $this->ui->load_component($options);
?>

<script type="text/javascript">
	function show_pre_customer(x)
	{
		$('#modal_dashboard_detail_pre_customer_content_div').load('<?php echo base_url(); ?>customer/show/'+x+'/pre_customer/echo');
		$('#modal_dashboard_detail_pre_customer').modal('show');
		return false;
	}
</script>
