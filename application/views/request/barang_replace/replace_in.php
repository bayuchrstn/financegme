<?php
	// pre($current_item_out);
	// pre($detail);
	$prefix = 'barang_masuk';
	$default_value = array();
	$forms_task_hidden = $this->ui->forms('task_hidden', $default_value, $prefix);
	$forms_barang_masuk = $this->ui->forms('task_approval_in', $default_value, $prefix);
?>
<table class="table table-bordered">
	<thead>
		<tr class="bg-info">
			<th width="5" class="text-center">#</th>
			<th class="text-center">Brand / Category / Name</th>
			<th class="text-center">No barang</th>
			<th class="text-center">Action</th>
		</tr>
	</thead>
	<?php
		if(!empty($current_item_in)):
	?>
	<tbody>
		<?php
			$urut = 1;
			$arr_jumlah = array();
			for($i=1; $i<=500; $i++):
				$arr_jumlah[$i] = $i;
			endfor;

			$master_status_kepemilikan = $this->master->arr('item_installed_owner_status');

			foreach($current_item_in as $row):
				// pre($row);

				$nomor_mac = $this->bcn->item_detail_info($row['item_detail_id'], 'nomor_mac');
				$item_id = $this->bcn->item_detail_info($row['item_detail_id'], 'item_id');
				$bcn = $this->bcn->item_info($item_id);

				// $item_info = $this->bcn->item_info($row['item_id']);

				if($row['status'] =='request_in' ):
					$action = '<a onclick="masukan_ini('.$row['id'].')" class="label label-warning" href="javascript:void(0)">Belum diterima</a>';
				else:
					$action = '<a onclick="masukan_ini('.$row['id'].')" class="label label-success" href="javascript:void(0)">Diterima</a>';
				endif;

				// $detail_barang_picker = '<a onclick="pilih_barang_keluar(\''.$urut.'\', \''.$row['id'].'\');" class="text-danger">'.$info_detail.'</a>';
		?>
		<tr id="<?php echo $urut ?>">
			<td><?php echo $urut; ?></td>
			<td><?php echo $bcn; ?></td>
			<td><?php echo $nomor_mac; ?></td>
			<td>
				<div class="text-center" id="picker_div_<?php echo $urut; ?>">
					<?php echo $action; ?>
				</div>
			</td>
		</tr>
		<?php
					$urut++;
				// endfor;
			endforeach;
		?>
	</tbody>
	<?php
		endif;
	?>
</table>
<br>


<script type="text/javascript">
alert('disini');
	
	// set_option('<?php echo base_url(); ?>select_option/request/barang_masuk/approval_status', 'status_barang_masuk', 'approved');
	// $('#id_barang_masuk').val('<?php echo $task_id; ?>');
	//
	function masukan_ini(x)
	{
		$('#modal_penerimaan_div').load('<?php echo base_url(); ?>ajax_request/penerimaan_barang_masuk/'+x);
		$('#modal_penerimaan_form').attr('action', '<?php echo base_url(); ?>ajax_request/penerimaan_barang_masuk/'+x);

		$('#modal_penerimaan').modal('show');
		return false;
	}
</script>
