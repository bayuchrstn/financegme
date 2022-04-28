<body style="font-family: sans-serif;">
<h3>Laporan Trial</h3>
<table>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Nama customer</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo $customer['data']['customer_name']; ?></td>
	</tr>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Alamat</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo $customer['data']['customer_address'].' '.$customer['data']['koordinat']; ?></td>
	</tr>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Kontak Person</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo $customer['data']['contact_person']; ?></td>
	</tr>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Telepon</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo $customer['data']['telephone_home'].' / '.$customer['data']['telephone_mobile'].' / '.$customer['data']['telephone_work']; ?></td>
	</tr>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Mulai Trial</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo $task_marketing_request['data']['date_request_start']; ?></td>
	</tr>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Selesai Trial</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo $task_marketing_request['data']['date_request_end']; ?></td>
	</tr>
</table>
<p><b>Checklist</b></p>
<table width="100%" style="border-collapse: collapse;">
	<?php foreach ($trial['data']['checklist'] as $row) : ?>
	<tr style="border-bottom: 1px solid #444;">
		<td width="15px" style="margin: 1px; vertical-align: top; border-bottom: 1px solid #333;"><?php echo $row['urut']; ?></td>
		<td style="margin: 1px; vertical-align: top; border-bottom: 1px solid #333;"><?php echo $row['pertanyaan']; ?></td>
		<td width="30px" style="margin: 1px; vertical-align: top; border-bottom: 1px solid #333;"><?php echo $row['jawaban']; ?></td>
		<td style="margin: 1px; vertical-align: top; border-bottom: 1px solid #333;"><?php echo $row['uraian']; ?></td>
	</tr>
	<?php endforeach; ?>
</table>
<p>
	<b>Keterangan</b><br>
	<?php echo $trial['data']['note']; ?>
</p>
<p>dibuat oleh <?php echo $trial['data']['report_name'].', tanggal '.date('d M Y H:i:s', strtotime($trial['data']['report_date'])); ?></p>
</body>