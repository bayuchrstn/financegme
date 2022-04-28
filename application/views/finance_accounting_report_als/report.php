<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title_page_table ?></title>
<link href="<?php echo base_url().'/assets/css/custom_page_report.css'; ?>" rel="stylesheet" type="text/css">
</head>

<body>
<table class="tabel_report" width="100%">
<thead>
<tr>
    <th width="50">tanggal</th>
    <th width="50">no voucher</th>
    <th width="50">jurnal</th>
    <th width="50">account number</th>
    <th>memo</th>
    <th width="100">debet</th>
    <th width="100">kredit</th>
    <th width="100">saldo</th>
</tr>
</thead>
<tbody>
<?php
		
$this->db->select("a.tukar",false);
$this->db->from('finance_coa a');
$this->db->where("a.id", $this->input->post('id_biaya'));
$q = $this->db->get();
if($q->num_rows() > 0){
	foreach($q->result_array() as $r){
		$tukar = $r['tukar'];
	}
}
		



$penambahan = 0.00;
$pengurangan = 0.00;
$saldo = $this->finance_accounting_report_als->saldo_awal($tukar);
echo '<tr style="font-weight:bold;"><td colspan="7">Saldo Awal</td>
	<td align="right">'.number_format($saldo, 2).'</td>
	</tr>';
$q = $this->finance_accounting_report_als->saldo();
if($q->num_rows() > 0){
	foreach($q->result_array() as $r){
		$penambahan += $r['penambahan'];
		$pengurangan += $r['pengurangan'];
		$saldo += $r['penambahan'] - $r['pengurangan'];
		echo '<tr>
			<td align="center">'.$r['tanggalnya'].'</td>
			<td align="right">'.$r['no_trans'].'</td>
			<td align="center">'.$r['jurnal_group'].'</td>
			<td align="center">'.$r['id_biaya'].'</td>
			<td>'.$r['ket'].'</td>
			<td align="right">'.number_format($r['penambahan'], 2).'</td>
			<td align="right">'.number_format($r['pengurangan'], 2).'</td>
			<td align="right">'.number_format($saldo, 2).'</td>
			</tr>';
	}
}
echo '<tr style="font-weight:bold;"><td colspan="5">Saldo Akhir</td>
	<td align="right">'.number_format($penambahan, 2).'</td>
	<td align="right">'.number_format($pengurangan, 2).'</td>
	<td align="right">'.number_format($saldo, 2).'</td>
	</tr>';
?>
</tbody>
</table>
</body>
</html>
