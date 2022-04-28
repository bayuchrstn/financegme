<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title_page_table ?></title>
<link href="<?php echo base_url().'/assets/css/custom_page_report.css'; ?>" rel="stylesheet" type="text/css">
</head>

<body>
<table class="tabel_report" border="1" cellpadding="0" cellspacing="0" width="100%">
<thead>
<tr>
	<th rowspan="2" width="10">no</th>
    <th rowspan="2" width="60">tanggal<br />invoice</th>
    <th rowspan="2">no<br />invoice</th>
    <th rowspan="2">service id</th>
    <th rowspan="2">customer id</th>
    <th rowspan="2">customer</th>
    <th colspan="7">pendapatan</th>
    <th rowspan="2">PPN</th>
    <th rowspan="2">PPH 22/23</th>
    <th rowspan="2">MF</th>
    <th rowspan="2">TOTAL</th>
    <th colspan="7">PEMBAYARAN</th>
</tr>
<tr>
    <th>bandwidth</th>
    <th>colocation</th>
    <th>instalasi</th>
    <th>perangkat</th>
    <th>lain2</th>
    <th>potongan</th>
    <th>jumlah</th>
    <th>INVOICE</th>
    <th>BAYAR</th>
    <th>PIUTANG</th>
</tr>
</thead>
<tbody>
<?php
$n= 0;

$gt_bw = 0;
$gt_colo = 0;
$gt_instalasi = 0;
$gt_perangkat = 0;
$gt_lain2 = 0;
$gt_potongan = 0;
$gt_jumlah = 0;
$gt_ppn = 0;
$gt_pph2223 = 0;
$gt_mf = 0;
$gt_total = 0;
$gt_invoice = 0;
$gt_bayar = 0;
$gt_piutang = 0;

$row_gt = '';
$row_data = '';
$q = $this->finance_report_invoice_customer->get_data_table();
if($q->num_rows() > 0){
	foreach($q->result_array() as $r){
		$n++;
		$jumlah = $r['bw'] + $r['colo'] + $r['instalasi'] + $r['perangkat'] + $r['lain2']  - $r['potongan'];
		$total = $jumlah + $r['ppn'] - $r['ppn'] - $r['pph2223'] - $r['mf'];
		$row_data .= '<tr>
		<td align="right">'.$n.'.</td>
		<td align="center">'.$r['date_invoicenya'].'</td>
		<td>'.$r['no_invoice'].'</td>
		<td>'.$r['service_id'].'</td>
		<td>'.$r['customer_id'].'</td>
		<td>'.$r['nama'].'</td>
		<td align="right">'.number_format($r['bw'],0).'</td>
		<td align="right">'.number_format($r['colo'],0).'</td>
		<td align="right">'.number_format($r['instalasi'],0).'</td>
		<td align="right">'.number_format($r['perangkat'],0).'</td>
		<td align="right">'.number_format($r['lain2'],0).'</td>
		<td align="right">'.number_format($r['potongan'],0).'</td>
		<td align="right">'.number_format($jumlah,0).'</td>
		<td align="right">'.number_format($r['ppn'],0).'</td>
		<td align="right">'.number_format($r['pph2223'],0).'</td>
		<td align="right">'.number_format($r['mf'],0).'</td>
		<td align="right">'.number_format($total,0).'</td>
		<td align="right">'.number_format($r['jumlah'],0).'</td>
		<td align="right">'.number_format($r['bayar'],0).'</td>
		<td align="right">'.number_format($r['piutang'],0).'</td>
		</tr>';
		
		$gt_bw += $r['bw'];
		$gt_colo += $r['colo'];
		$gt_instalasi += $r['instalasi'];
		$gt_perangkat += $r['perangkat'];
		$gt_lain2 += $r['lain2'];
		$gt_potongan += $r['potongan'];
		$gt_jumlah += $jumlah;
		$gt_ppn += $r['ppn'];
		$gt_pph2223 += $r['pph2223'];
		$gt_mf += $r['mf'];
		$gt_total += $total;
		$gt_invoice += $r['jumlah'];
		$gt_bayar += $r['bayar'];
		$gt_piutang += $r['piutang'];
	}
}
		$row_gt .= '<tr style="font-weight:bold;">
		<td align="right" colspan="6">GRAND TOTAL</td>
		<td align="right">'.number_format($gt_bw,0).'</td>
		<td align="right">'.number_format($gt_colo,0).'</td>
		<td align="right">'.number_format($gt_instalasi,0).'</td>
		<td align="right">'.number_format($gt_perangkat,0).'</td>
		<td align="right">'.number_format($gt_lain2,0).'</td>
		<td align="right">'.number_format($gt_potongan,0).'</td>
		<td align="right">'.number_format($gt_jumlah,0).'</td>
		<td align="right">'.number_format($gt_ppn,0).'</td>
		<td align="right">'.number_format($gt_pph2223,0).'</td>
		<td align="right">'.number_format($gt_mf,0).'</td>
		<td align="right">'.number_format($gt_total,0).'</td>
		<td align="right">'.number_format($gt_invoice,0).'</td>
		<td align="right">'.number_format($gt_bayar,0).'</td>
		<td align="right">'.number_format($gt_piutang,0).'</td>
		</tr>';
		
echo $row_gt;
echo $row_data;
echo $row_gt;
?>
</tbody>
</table>
</body>
</html>
