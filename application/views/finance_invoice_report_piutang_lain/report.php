<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title_page_table ?></title>

<!-- Global stylesheets -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
<link href="<?php echo base_url() ?>assets/css/icomoon/styles.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url() ?>assets/css/core.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url() ?>assets/css/components.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url() ?>assets/css/colors.css" rel="stylesheet" type="text/css">
<!-- /global stylesheets -->

</head>

<body>
<table class="table datatable-ajax table-striped table-xxs text-size-small text-nowrap table-bordered">
<thead>
<tr class="text-uppercase text-center text-size-large">
	<th rowspan="2" width="10">no</th>
    <th rowspan="2" width="60">tanggal<br />invoice</th>
    <th rowspan="2">no<br />invoice</th>
    <th rowspan="2">service id</th>
    <th rowspan="2">customer id</th>
    <th rowspan="2">customer</th>
    <th colspan="3">PPH 22/23</th>
    <th colspan="4">Bupot PPN</th>
    <th rowspan="2" width="60">jatuh<br />tempo</th>
    <th colspan="4">overdue</th>
</tr>
<tr class="text-uppercase text-center text-size-large">
    <th>total</th>
    <th>bayar</th>
    <th>piutang</th>
    <th>total</th>
    <th>bayar</th>
    <th>piutang</th>
    <th>day</th>
    <th>0 - 30</th>
    <th>31 - 60</th>
    <th>61 - 90</th>
    <th>91 &raquo;</th>
</tr>
</thead>
<tbody>
<?php
$n= 0;

$gt_invoice = 0;
$gt_bayar = 0;
$gt_piutang = 0;
$gt_ppn_invoice = 0;
$gt_ppn_bayar = 0;
$gt_ppn_piutang = 0;
$gt_aging_1 = 0;
$gt_aging_2 = 0;
$gt_aging_3 = 0;
$gt_aging_4 = 0;

$row_gt = '';
$row_data = '';
$q = $this->finance_invoice_report_piutang_lain->get_data_table();
if($q->num_rows() > 0){
	foreach($q->result_array() as $r){
		$piutang = $r['piutang_pph2223'];
		$piutang_bupot_ppn = $r['piutang_bupot_ppn'];
		if($piutang != 0 || $piutang_bupot_ppn != 0){
			$n++;
			$aging_1 = 0;
			$aging_2 = 0;
			$aging_3 = 0;
			$aging_4 = 0;
			$badge = '<span class="badge badge-success" style="width:35px;">0</span>';
			if($r['aging'] >= 0 && $r['aging'] <= 30 ){
				$aging_1 = $piutang + $piutang_bupot_ppn;
				$badge = '<span class="badge badge-success" style="width:35px;">'.$r['aging'].'</span>';
			}elseif($r['aging'] >= 31 && $r['aging'] <= 60 ){
				$aging_2 = $piutang + $piutang_bupot_ppn;
				$badge = '<span class="badge bg-orange" style="width:35px;">'.$r['aging'].'</span>';
			}elseif($r['aging'] >= 61 && $r['aging'] <= 90 ){
				$aging_3 = $piutang + $piutang_bupot_ppn;
				$badge = '<span class="badge badge-danger" style="width:35px;">'.$r['aging'].'</span>';
			}elseif($r['aging'] >= 91){
				$aging_4 = $piutang + $piutang_bupot_ppn;
				$badge = '<span class="badge badge-danger" style="width:35px;">'.$r['aging'].'</span>';
			}
			$row_data .= '<tr>
			<td align="right">'.$n.'.</td>
			<td align="center">'.$r['date_invoicenya'].'</td>
			<td>'.$r['no_invoice'].'</td>
			<td>'.$r['service_id'].'</td>
			<td>'.$r['customer_id'].'</td>
			<td>'.$r['nama'].'</td>
			<td align="right">'.number_format($r['jumlah_pph2223'],0).'</td>
			<td align="right">'.number_format($r['bayar_pph2223'],0).'</td>
			<td align="right">'.number_format($piutang,0).'</td>
			<td align="right">'.number_format($r['jumlah_bupot_ppn'],0).'</td>
			<td align="right">'.number_format($r['bayar_bupot_ppn'],0).'</td>
			<td align="right">'.number_format($piutang_bupot_ppn,0).'</td>
			<td align="right">'.$badge.'</td>
			<td align="center">'.$r['date_duenya'].'</td>
			<td align="right">'.number_format($aging_1,0).'</td>
			<td align="right">'.number_format($aging_2,0).'</td>
			<td align="right">'.number_format($aging_3,0).'</td>
			<td align="right">'.number_format($aging_4,0).'</td>
			</tr>';
			
			$gt_invoice += $r['jumlah_pph2223'];
			$gt_bayar += $r['bayar_pph2223'];
			$gt_piutang += $piutang;
			$gt_ppn_invoice += $r['jumlah_bupot_ppn'];
			$gt_ppn_bayar += $r['bayar_bupot_ppn'];
			$gt_ppn_piutang += $piutang_bupot_ppn;
			$gt_aging_1 += $aging_1;
			$gt_aging_2 += $aging_2;
			$gt_aging_3 += $aging_3;
			$gt_aging_4 += $aging_4;
		}
	}
}
		$row_gt .= '<tr style="font-weight:bold;">
		<td align="right" colspan="6">GRAND TOTAL</td>
		<td align="right">'.number_format($gt_invoice,0).'</td>
		<td align="right">'.number_format($gt_bayar,0).'</td>
		<td align="right">'.number_format($gt_piutang,0).'</td>
		<td align="right">'.number_format($gt_ppn_invoice,0).'</td>
		<td align="right">'.number_format($gt_ppn_bayar,0).'</td>
		<td align="right">'.number_format($gt_ppn_piutang,0).'</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="right">'.number_format($gt_aging_1,0).'</td>
		<td align="right">'.number_format($gt_aging_2,0).'</td>
		<td align="right">'.number_format($gt_aging_3,0).'</td>
		<td align="right">'.number_format($gt_aging_4,0).'</td>
		</tr>';
		
echo $row_gt;
echo $row_data;
echo $row_gt;
?>
</tbody>
</table>
</body>
</html>
