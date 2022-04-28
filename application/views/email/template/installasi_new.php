<?php 
	// print_r($this->all_session);
	$user = $this->db->where('id', !empty($this->all_session['id']) ? $this->all_session['id'] : $this->all_session['userid'] )->get('users')->row_array();
	// print_r($user); exit;
?>
<h3>Marketing Request</h3>
<table>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Nama Pre customer</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo $customer['customer_name']; ?></td>
	</tr>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Customer ID</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo $customer['customer_id']; ?></td>
	</tr>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Service ID</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo $customer['service_id']; ?></td>
	</tr>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Alamat</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo $customer['customer_address'].' '.$customer['koordinat']; ?></td>
	</tr>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Kontak Person</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo $customer['contact_person']; ?></td>
	</tr>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Telepon Person</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo $customer['telephone_home'].' / '.$customer['telephone_mobile'].' / '.$customer['telephone_work']; ?></td>
	</tr>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Tanggal Installasi</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo $date_start; ?></td>
	</tr>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Layanan</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo $customer['layanan'][0]['product_name'].' - '.$customer['layanan'][0]['value'].' '.$customer['layanan'][0]['satuan_bandwidth']; ?></td>
	</tr>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Kategori</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo ucwords(str_replace('_', ' ', $category)); ?></td>
	</tr>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Note</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo $body; ?></td>
	</tr>
	<tr>
		<td width="150px" style="margin: 1px; vertical-align: top;">Marketing</td>
		<td style="margin: 1px; vertical-align: top;">:</td>
		<td style="margin: 1px; vertical-align: top;"><?php echo $customer['am_name']; ?></td>
	</tr>
</table>
<p>dibuat oleh <?php echo $user['name'].', tanggal '.date('d M Y H:i:s'); ?></p>