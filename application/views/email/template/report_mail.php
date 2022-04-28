<?php 
$status_txt = str_replace('_', ' ', $status);
$status_txt = strtoupper($status_txt);

$detail_lokasi = $location;

if ($detail_lokasi=='nap' || $detail_lokasi=='gmedia' || $detail_lokasi=='noc_jogja' || $detail_lokasi=='noc_jakarta') {
	$location = $data_location['category_name'].' / '.$data_location['name'];
	$data_location = array();
} else {
	$data_location['customer_name'] = $detail_lokasi=='bts' ? $data_location['bts_name'] : $data_location['customer_name'];

	$location = $detail_lokasi=='bts' ? 'BTS' : ($data_location['status']=='pre_customer' ? 'PRE CUSTOMER' : 'CUSTOMER');
	$location .= ' / '.$data_location['customer_name'];
}

if (!empty($task_report)) {
	$link = $task_report[0]['owncloud']=='' ? '-' : '<a href="'.$task_report[0]['owncloud'].'">'.$task_report[0]['owncloud'].'</a>';
}

function mail_table_data($key='', $val='')
{
	$html = '<tr>';
	$html .= '<td width="100" valign="top" style="background-color: #dae3f1;">'.$key.'</td>';
	$html .= '<td valign="top">'.$val.'</td>';
	$html .= '</tr>';
	echo $html;
}

function table_data($array= array())
{
	if (!empty($array)) {
		foreach ($array as $key => $value) {
			mail_table_data($key, $value);
		}
	}
}
// echo '<pre>';
// print_r($data_location);
// echo '</pre>';
?>

<?php if ($task_category=='task_report') :?>
<!-- task report -->
<table>
	<tr>
		<td width="100" valign="top">Nama</td>
		<td width="8" valign="top">:</td>
		<td valign="top"><?php echo $author['name']; ?></td>
	</tr>
	<tr>
		<td width="100" valign="top">Pekerjaan</td>
		<td width="8" valign="top">:</td>
		<td valign="top"><?php echo $subject; ?></td>
	</tr>
	<tr>
		<td width="100" valign="top">Lokasi</td>
		<td width="8" valign="top">:</td>
		<td valign="top"><?php echo $location; ?></td>
	</tr>
	<tr>
		<td width="100" valign="top">Tanggal</td>
		<td width="8" valign="top">:</td>
		<td valign="top"><?php echo $date_created; ?></td>
	</tr>
	<tr>
		<td width="100" valign="top">Status</td>
		<td width="8" valign="top">:</td>
		<td valign="top"><?php echo $status_txt; ?></td>
	</tr>
</table>
<!-- body -->
<?php echo $body; ?>

<?php if (!empty($data_location)) : ?>
<!-- detail pelanggan -->
<table border="1" style="border-collapse: collapse;">
	<tr><th colspan="2" align="center" style="background-color: #ffc800;">Data Umum</th></tr>
	<?php 
		$PIC = array();

		if ($detail_lokasi=='bts') :

			$detail_pelanggan = array(
				'Nama'	=> $data_location['customer_name'],
				'Alamat'	=> $data_location['bts_address']
			);

		elseif ($detail_lokasi=='nap' || $detail_lokasi=='gmedia' || $detail_lokasi=='noc_jogja' || $detail_lokasi=='noc_jakarta') :

			$detail_pelanggan = array();

		else:

		if (count($data_location['data_contact']) > 0) {
			$a = 0;
			foreach ($data_location['data_contact'] as $row) {
				$key = $a>0 ? ('PIC '.($a+1)) : 'PIC';
				$PIC[$key] = '<b>'.$row['name'].'</b><br>Phone: '.$row['telephone_home'].' / '.$row['telephone_mobile'].' / '.$row['telephone_office'].'<br>Email: '.$row['email'];
				$a++;		
			}			
		} else {
			$PIC['PIC'] = '<b>'.$data_location['contact_person'].'</b><br>Phone: '.$data_location['telephone_home'].' / '.$data_location['telephone_work'].'<br>Email: '.$data_location['email'];
		}

		$detail_pelanggan = array(
			'Produk'	=> $data_location['data_product'][0]['name'].' - '.$data_location['data_product'][0]['value'].' '.$data_location['data_product'][0]['satuan_bandwidth'],
			'Nama Pelanggan'	=> $data_location['customer_name'],
			'Alamat'	=> $data_location['customer_address'],
			'Koordinat'	=> $data_location['koordinat']
		);
		foreach ($PIC as $key => $value) {
			$detail_pelanggan[$key] = $value;
		}

		endif;

		table_data($detail_pelanggan);
	?>
</table><br>
<!-- end of detail pelanggan -->
<?php endif; ?>

<?php if (!empty($task_report_presurvey)) : ?>
<!-- pre survey -->
<table border="1" style="border-collapse: collapse;">
	<?php
		table_data(array(
			'Status Cover'	=> strtoupper($task_report_presurvey[0]['status_coverage']),
			'Koordinat'	=> $task_report_presurvey[0]['koordinat'],
			'Jarak ODP'	=> $task_report_presurvey[0]['jarak_opd_pelanggan'],
			'Jenis Tower'	=> $task_report_presurvey[0]['jenis_tower'],
			'Tinggi Tower'	=> $task_report_presurvey[0]['tinggi_tower'],
			'Estimasi Waktu'	=> $task_report_presurvey[0]['estimasi_waktu_pengerjaan'],
			'Estimasi Biaya'	=> $task_report_presurvey[0]['estimasi_biaya'],
			'Vendor'	=> $task_report_presurvey[0]['nama_vendor'],
			'Catatan'	=> $task_report_presurvey[0]['note']
		));
	?>

<?php endif; ?>

<?php if (!empty($task_report_survey_link)) : ?>
	<table border="1" style="border-collapse: collapse;">
	<?php 
	$i=0;
	foreach ($task_report_survey_link as $survey) : 
	?>
		<?php if ($survey['jenis']=='fo') : ?>
		<!-- fiber -->
		<tr><th colspan="2" align="center" style="background-color: #ffc800;"><?php echo $survey['ps']; ?></th></tr>

		<?php 
			table_data( array(
				'Distribusi'	=> $survey['fo_distribusi'],
				'Jarak ODP'	=> $survey['fo_jarak_odp_server'],
				'Tiang 7M'	=> $survey['fo_tiang_7'],
				'Tiang 9M'	=> $survey['fo_tiang_9'],
				'Kabel'	=> $survey['fo_jenis_kabel'],
				'Status Kabel'	=> $survey['fo_status_kabel'],
				'Start Point'	=> $survey['fo_start_point'],
				'End Point'	=> $survey['fo_end_point'],
				'Aksesoris'	=> $survey['fo_accessories'],
				'Catatan'	=> $survey['fo_accessories']
			) );
		?>

		<?php elseif ($survey['jenis']=='wr') : ?>
		<!-- wireless -->
		<tr><th colspan="2" align="center" style="background-color: #ffc800;"><?php echo $survey['ps']; ?></th></tr>

		<?php 
			table_data( array(
				'BTS'	=> $survey['wireless_bts'],
				'Jarak BTS'	=> $survey['wireless_bts_jarak'],
				'BTS Alternatif'	=> $survey['wireless_bts_alternative'],
				'Jarak BTS Alternatif'	=> $survey['wireless_bts_jarak_alternative'],
				'Jenis Tower'	=> $survey['wireless_jenis_tower'],
				'Tinggi Tower'	=> $survey['wireless_tinggi_tower'],
				'Kabel'	=> $survey['wireless_kabel'],
				'Access Point'	=> $survey['wireless_access_point'],
				'Kebutuhan Tangga'	=> $survey['wireless_tangga'],
				'Catatan'	=> $survey['note']
			) );
		?>

		<?php else: ?>
		<!-- tidak ada -->

		<?php endif; ?>
	<?php
	$i++; 
	endforeach; 
	?>
	</table>
<?php endif; ?>

<?php if (!empty($task_report_install_link)) : ?>
	<table border="1" style="border-collapse: collapse;">
	<?php 
	$i=0;
	foreach ($task_report_install_link as $install) : 
	?>

		<?php if ($install['jenis']=='fo') : ?>
		<!-- fiber -->
		<tr><th colspan="2" align="center" style="background-color: #ffc800;"><?php echo $install['ps']; ?></th></tr>
		<?php 
			table_data( array(
				'Jenis'	=> 'Fiber Optik',
				'ODP'	=> $install['fo_odp'],
				'Jenis Kabel' => $install['fo_jenis_kabel'],
				'Jarak Kabel'	=> $install['fo_jarak_kabel'],
				'Type ONT/ONU'	=> $install['fo_ont_onu'],
				'Serial Number ONT/ONU'	=> $install['fo_serial_number_ont_onu'],
				'Mac Address ONT/ONU'	=> $install['fo_mac_address_fo_ont_onu'],
				'Power Optic ODP'	=> $install['fo_power_optic_odp'],
				'Power Optic Roset'	=> $install['fo_power_optic_roset'],
				'IP PTP Privat'	=> $install['fo_ip_ptv_privat'],
			) ); 
		?>

		<?php elseif ($install['jenis']=='wr') : ?>
		<!-- wireless -->
		<tr><th colspan="2" align="center" style="background-color: #ffc800;"><?php echo $install['ps']; ?></th></tr>

		<?php 
			table_data( array(
				'Jenis'	=> 'Wireless',
				'BTS'	=> $install['wireless_bts'],
				'Jarak BTS'	=> $install['wireless_jarak'],
				'Antena'	=> $install['wireless_antena'],
				'Radio'	=> $install['wireless_radio'],
				'Sinyal Strength'	=> $install['wireless_signal_strenght'],
				'Kualitas Sinyal'	=> $install['wireless_kualitas_signal'],
				'Kabel'	=> $install['wireless_jenis_kabel'],
				'Jarak Kabel' => $install['wireless_jarak_kabel']
			) );
		?>
		<?php else: ?>
		<!-- tidak ada -->

		<?php endif; ?>
	<?php
	$i++; 
	endforeach; 
	?>
	</table>
<?php endif; ?>

<?php if (!empty($list_barang_out)) : ?>
<h4>Barang dipasang</h4>
	<ol>
	<?php foreach ($list_barang_out as $value) : ?>
		<li>
			<?php 
			$mac_address = $value['mac_address'] ? $value['mac_address'].'/' : '';
			echo $value['brand_name'].'/'.$value['category_name'].'/'.$value['item_name'].'/'. $mac_address .$value['nomor_barang']; 
			?>
				
		</li>
	<?php endforeach; ?>
	</ol>
<?php endif; ?>

<?php if (!empty($list_barang_in)) : ?>
<h4>Barang kembali</h4>
	<ol>
	<?php foreach ($list_barang_in as $value) : ?>
		<li>
			<?php 
			$mac_address = $value['mac_address'] ? $value['mac_address'].'/' : '';
			echo $value['brand_name'].'/'.$value['category_name'].'/'.$value['item_name'].'/'. $mac_address .$value['nomor_barang']; 
			?>
				
		</li>
	<?php endforeach; ?>
	</ol>
<?php endif; ?>

<?php if (!empty($task_boq)) : ?>
<h4>Daftar Barang BOQ</h4>
	<table>
		<thead>
			<tr>
				<th align="left">Barang</th>
				<th align="left">Jumlah</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($task_boq as $value) : ?>
		<tr>
			<?php 
			echo '<td>';
			if ($value['mode']=='barang') :
				echo $value['brand_name'].' / '.$value['category_name'].' / '.$value['item_name']; 
			elseif ($value['mode']=='custom') :
				echo $value['item_name_custom'];
			else:
			endif;
			echo '</td>';
			echo '<td align="right">'.$value['qty'].'</td>';
			?>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>

<?php if (!empty($task_report)) : ?>
<!-- owncloud -->
<br>Link : <?php echo $link; ?>
<?php endif; ?>

<!-- end task report -->
<?php else: ?>
<!-- marketing request -->

<!-- end marketing request -->
<?php endif; ?>