<table>
	<tbody>
		<tr>
			<td width="150px" style="margin: 1px; vertical-align: top;">Nama Pelanggan</td>
			<td style="margin: 1px; vertical-align: top;">:</td>
			<td style="margin: 1px; vertical-align: top;"><?php echo $customer['customer_name']; ?></td>
		</tr>
		<tr>
			<td width="150px" style="margin: 1px; vertical-align: top;">CID</td>
			<td style="margin: 1px; vertical-align: top;">:</td>
			<td style="margin: 1px; vertical-align: top;"><?php echo $customer['customer_id']; ?></td>
		</tr>
		<tr>
			<td width="150px" style="margin: 1px; vertical-align: top;">Produk</td>
			<td style="margin: 1px; vertical-align: top;">:</td>
			<td style="margin: 1px; vertical-align: top;"><?php echo $customer['layanan'][0]['product_name'].' - '.$customer['layanan'][0]['value'].' '.$customer['layanan'][0]['satuan_bandwidth']; ?></td>
		</tr>
		<tr>
			<td width="150px" style="margin: 1px; vertical-align: top;">Lokasi</td>
			<td style="margin: 1px; vertical-align: top;">:</td>
			<td style="margin: 1px; vertical-align: top;"><?php echo $customer['customer_address']; ?></td>
		</tr>
		<tr>
			<td width="150px" style="margin: 1px; vertical-align: top;">PIC</td>
			<td style="margin: 1px; vertical-align: top;">:</td>
			<td style="margin: 1px; vertical-align: top;"><?php echo $customer['contact_person']; ?></td>
		</tr>
		<tr>
			<td width="150px" style="margin: 1px; vertical-align: top;">Email</td>
			<td style="margin: 1px; vertical-align: top;">:</td>
			<td style="margin: 1px; vertical-align: top;"><?php echo $customer['email']; ?></td>
		</tr>
		<tr>
			<td width="150px" style="margin: 1px; vertical-align: top;">Kategori</td>
			<td style="margin: 1px; vertical-align: top;">:</td>
			<td style="margin: 1px; vertical-align: top;"><?php echo $detail['category']; ?></td>
		</tr>
		<tr>
			<td width="150px" style="margin: 1px; vertical-align: top;">Respon Pelanggan</td>
			<td style="margin: 1px; vertical-align: top;">:</td>
			<td style="margin: 1px; vertical-align: top;"><?php echo $task_ext['respon']; ?></td>
		</tr>
		<tr>
			<td width="150px" style="margin: 1px; vertical-align: top;">Keterangan</td>
			<td style="margin: 1px; vertical-align: top;">:</td>
			<td style="margin: 1px; vertical-align: top;"><?php echo $task_ext['note']; ?></td>
		</tr>
		<tr>
			<td width="150px" style="margin: 1px; vertical-align: top;">Terakhir Dikunjungi</td>
			<td style="margin: 1px; vertical-align: top;">:</td>
			<td style="margin: 1px; vertical-align: top;"><?php echo $last_visit; ?></td>
		</tr>
		<tr>
			<td width="150px" style="margin: 1px; vertical-align: top;">Rate</td>
			<td style="margin: 1px; vertical-align: top;">:</td>
			<td style="margin: 1px; vertical-align: top;">
				<?php 
					//star
					$star = array();

					//no star
					$nostar_path = HOME_PATH.'assets/images/star.svg';
					for ($i = 0; $i < 5; $i++) {
						$star[$i] = '<img src="data:image/svg+xml;base64,'.base64_encode(file_get_contents($nostar_path)).'" alt="nostar" width="14px;">';
					}
					// star
					$star_path = HOME_PATH.'assets/images/star_full.svg';
					for ($i = 0; $i < intval($task_ext['scale']); $i++) {
						$star[$i] = '<img src="data:image/svg+xml;base64,'.base64_encode(file_get_contents($star_path)).'" alt="starfull" width="14px;">';
					}
					foreach ($star as $star_value) {
						// echo $star_value;	
					}
					echo $task_ext['scale'].'/5';
				?>
			</td>
		</tr>
	</tbody>
</table>
<p>dibuat oleh <?php echo $detail['author_name'].', tanggal '.date('d M Y H:i:s'); ?></p>