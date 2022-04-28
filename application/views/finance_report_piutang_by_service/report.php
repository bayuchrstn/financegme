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
    <th rowspan="2">service id</th>
    <th rowspan="2">customer id</th>
    <th rowspan="2">customer</th>
    <th colspan="3">invoice</th>
</tr>
<tr>
    <th>total</th>
    <th>bayar</th>
    <th>piutang</th>
</tr>
</thead>
<tbody>
<?php
$n= 0;

$gt_invoice = 0;
$gt_bayar = 0;
$gt_piutang = 0;
$gt_aging_1 = 0;
$gt_aging_2 = 0;
$gt_aging_3 = 0;
$gt_aging_4 = 0;

$row_gt = '';
$row_data = '';
$q = $this->finance_report_piutang_by_service->get_data_table();
if($q->num_rows() > 0){
	foreach($q->result_array() as $r){
		$n++;
		$aging_1 = 0;
		$aging_2 = 0;
		$aging_3 = 0;
		$aging_4 = 0;
		$row_data .= '<tr>
		<td align="right">'.$n.'.</td>
		<td>'.$r['service_id'].'</td>
		<td>'.$r['customer_id'].'</td>
		<td>'.$r['nama'].'</td>
		<td align="right">'.number_format($r['jumlah'],0).'</td>
		<td align="right">'.number_format($r['bayar'],0).'</td>
		<td align="right">'.number_format($r['piutang'],0).'</td>
		</tr>';
		
		$gt_invoice += $r['jumlah'];
		$gt_bayar += $r['bayar'];
		$gt_piutang += $r['piutang'];
	}
}
		$row_gt .= '<tr style="font-weight:bold;">
		<td align="right" colspan="4">GRAND TOTAL</td>
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
