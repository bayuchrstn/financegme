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
    <th width="50">tanggal</th>
    <th width="50">kode</th>
    <th width="50">nomor</th>
    <th>nama akun</th>
    <th>keterangan</th>
    <th width="100">debet</th>
    <th width="100">kredit</th>
</tr>
</thead>
<tbody>
<?php
$total_debet = 0.00;
$total_kredit = 0.00;

$row = '';
$q = $this->finance_accounting_report_gl->saldo();
if($q->num_rows() > 0){
	foreach($q->result_array() as $r){
		$rowd = '';
		$debet = 0;
		$kredit = 0;
		$qd = $this->finance_accounting_report_gl->saldo_detail($r['no_trans']);
		if($qd->num_rows() > 0){
			foreach($qd->result_array() as $rd){
				$total_debet += $rd['debet'];
				$total_kredit += $rd['kredit'];
				$debet += $rd['debet'];
				$kredit += $rd['kredit'];
				$rowd .= '<tr>
					<td>&nbsp;</td>
					<td align="center">'.$r['jurnal_group'].'</td>
					<td align="center">'.$rd['id_biaya'].'</td>
					<td>'.$rd['nama_biaya'].'</td>
					<td>'.$rd['ket'].'</td>
					<td align="right">'.number_format($rd['debet'], 2).'</td>
					<td align="right">'.number_format($rd['kredit'], 2).'</td>
					</tr>';
			}
			$oob = ($debet == $kredit)?'':'(Out Of Balance Rp. '.number_format($debet - $kredit,2).')';
			$oobc = ($debet == $kredit)?'':'color:#F00;';
			$row .= '<tr style="font-weight:bold;'.$oobc.'">
				<td align="center">'.$r['tanggalnya'].'</td>
				<td colspan="6" style="font-weight:bold;">'.$r['deskripsi'].' <label style="font-style:italic; font-weight:normal; float:right;">'.$oob.'</label></td>
				</tr>';
			$row .= $rowd;
		}
	}
}
echo '<tr style="font-weight:bold;"><td colspan="5">Grand Total</td>
	<td align="right">'.number_format($total_debet, 2).'</td>
	<td align="right">'.number_format($total_kredit, 2).'</td>
	</tr>';
echo $row;
echo '<tr style="font-weight:bold;"><td colspan="5">Grand Total</td>
	<td align="right">'.number_format($total_debet, 2).'</td>
	<td align="right">'.number_format($total_kredit, 2).'</td>
	</tr>';
?>
</tbody>
</table>
</body>
</html>
