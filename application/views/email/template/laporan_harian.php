<?php
	$lokasi = $location=='bts' ? $customer['bts_name'] : $customer['customer_name'];
?>

<h3>Laporan Harian</h3>
<table>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Tanggal</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo date('d M Y', strtotime($date_created) ); ?></td>
	</tr>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Nama</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo $author_name; ?></td>
	</tr>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Judul</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo $subject; ?></td>
	</tr>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Lokasi</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo strtoupper($location).' / '.$lokasi; ?></td>
	</tr>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Pelapor</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo $task_ext['pelapor']; ?></td>
	</tr>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Waktu</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo date('d M Y H:i:s', strtotime($date_start)).' s/d '.date('d M Y H:i:s', strtotime($date_due)); ?></td>
	</tr>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Jenis Laporan</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo $task_ext['jenis_laporan']; ?></td>
	</tr>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Laporan</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo $task_ext['laporan']; ?></td>
	</tr>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Analisa</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo $task_ext['analisa']; ?></td>
	</tr>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Tindakan</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo $task_ext['tindakan']; ?></td>
	</tr>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Keterangan</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo $body; ?></td>
	</tr>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Problem Solve</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo $task_ext['solve']=='Y' ? 'ya' : 'tidak'; ?></td>
	</tr>
</table>
