<?php
// pre($modul);
// pre($detail);
// pre($task_ext);

$this->load->model('Model_bcn', 'bcn');

$options = array();
$options['component'] = 'component/table/table_data_info';
$options['label_width'] = '150';
$options['sparator_width'] = '10';
$options['data_row'] = array();

$options['data_row']['Dari'] = $detail['author_name'];
$options['data_row']['Tanggal '] = format_date($detail['date_created']);
$options['data_row']['Lokasi'] = $detail['location_name'];
$options['data_row']['Keterangan'] = $detail['body'];


echo $this->ui->load_component($options);


?>


<table class="table">
	<thead class="bg-slate">
		<tr>
			<th>Brand / Category / Name</th>
			<th>Status</th>
			<th>Item Barang</th>
		</tr>
	</thead>
	<tbody>
		<?php
			if(!empty($detail['daftar_barang_keluar'])):
				foreach($detail['daftar_barang_keluar'] as $row):
					// pre($row);
					$bcn = $this->bcn->item_info($row['item_id']);
					$status = ($row['item_detail_id'] !='') ? 'Approved' : 'Request';

					if($row['item_detail_id'] !=''):
						$item_approved = $this->bcn->item_detail_info($row['item_detail_id'], 'nomor_mac');
					else:
						$item_approved = '';
					endif;
		?>
		<tr>
			<td><?php echo $bcn; ?></td>
			<td><?php echo $status; ?></td>
			<td><?php echo $item_approved; ?></td>
		</tr>
		<?php
				endforeach;
			endif;
		?>
	</tbody>
</table>
