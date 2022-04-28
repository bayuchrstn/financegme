<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title_page_table ?></title>
<link href="<?php echo base_url().'/assets/css/custom_page_report.css'; ?>" rel="stylesheet" type="text/css">
<style type="text/css">
.tabel_report_invoice th, .tabel_report_invoice td{padding:7px 10px;}
.tabel_report td{white-space:normal;}
.page-break {
    page-break-after: always;
}
@media print {
	.btnBack{display:none;}
	.page-break {
		page-break-after: always;
	}
}
*{font-size:11px;}
body{margin:0; padding:0;}
<?php if($pdf == '1'){ ?>
@page { margin: 0px; margin-bottom:50px; margin-top:50px;}
.tabel_report{margin-left:20px; margin-right:40px;}
<?php } ?>
</style>
</head>

<body>
<?php if($pdf == '0'){ 
	$margintop = 170;
	$head_pdf = '';
?>
<button class="btnBack" style="position:absolute; top:5px; float:right; right:5px;" onClick="window.close(); window.opener.table.ajax.reload();">Kembali</button>
<?php }else{
	//$margintop = 250;
	//echo '<img src="./assets/images/a.jpg" style="position:fixed; top:0; left:0; z-index:-99999; margin:0; padding:0;" />';
	$margintop = 0;
	$head_pdf = '<div><img src="./assets/images/'.$head_bg.'.png" /></div>';
	$barcode = '<img width="100" src="./assets/images/'.$barcode.'.png" />';
}

$q = $this->finance_invoice_customer->select_data();
if($q->num_rows() > 0){
	foreach($q->result_array() as $r){
		if($this->uri->segment(4) == '1'){
			$this->finance_invoice_customer->invoice_sudah_approve($r['id']);
		}
		$service_1 = $r['bw'] + $r['colo'] + $r['instalasi'] + $r['perangkat'] + $r['lain2'];
		$ppn_name = 'NAME';
		if($r['ppnnya'] == '1'){
			$ppn_name = 'TO';
		}
		
		$no = 0;
		$jml = 0;
		$ppn = $r['ppn'];
		$jml_det = $r['jml_det'];
		$jml_det_1 = floor($r['jml_det'] / 13);
		$jml_det_2 = ($r['jml_det'] % 13 > 5)?1:0;
		$jml_det_row = ($r['jml_det'] % 13 > 0)? $jml_det_1 + 1:$jml_det_1;
		$jml_det_ttl = $jml_det_1 + $jml_det_2 + 1;
		for($ii = 0; $ii < $jml_det_ttl; $ii++){
		echo $head_pdf;
		//echo $ii.'-';
		//echo $jml_det_ttl;
		if($ii == 0){
?>

<table class="tabel_report" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:<?php echo $margintop; ?>px;">
<thead>
<tr>
    <td align="left" valign="top" style="border:0; padding:0; vertical-align:top;" width="50%">
        <table class="tabel_report" border="0" cellpadding="0" cellspacing="0" width="80%">
            <tr>
                <td align="left" valign="top" style="border:0; padding-bottom:0; padding-top:0;" width="60"><?php echo $ppn_name; ?></td>
                <td align="left" valign="top" style="border:0; padding-bottom:0; padding-top:0;" width="1">:</td>
                <td align="left" valign="top" style="border:0; padding-bottom:0; padding-top:0; text-transform:capitalize;"><?php echo $r['nama']; ?></td>
            </tr>
            <tr>
                <td align="left" valign="top" style="border:0; padding-bottom:0; padding-top:0;">ADDRESS</td>
                <td align="left" valign="top" style="border:0; padding-bottom:0; padding-top:0;">:</td>
                <td align="left" valign="top" style="border:0; padding-bottom:0; padding-top:0; text-transform:capitalize;"><?php echo $r['alamat']; ?></td>
            </tr>
            <?php
            if(($r['ppnnya'] != '1' || ($this->finance_invoice_customer->cek_id_regional($this->session->userdata('scope_area')) == '11' || $this->finance_invoice_customer->cek_id_regional($this->session->userdata('scope_area')) == '13' || $this->finance_invoice_customer->cek_id_regional($this->session->userdata('scope_area')) == '14' || $this->finance_invoice_customer->cek_id_regional($this->session->userdata('scope_area')) == '15')) && $r['cp'] != ''){
            ?>
            <tr>
                <td align="left" valign="top" style="border:0; padding-bottom:0; padding-top:0;">ATTENTION</td>
                <td align="left" valign="top" style="border:0; padding-bottom:0; padding-top:0;">:</td>
                <td align="left" valign="top" style="border:0; padding-bottom:0; padding-top:0; text-transform:capitalize;"><?php echo $r['cp']; ?></td>
            </tr>
            <?php
            }
            ?>
            <?php
            if(($r['ppnnya'] != '1'  || ($this->finance_invoice_customer->cek_id_regional($this->session->userdata('scope_area')) == '11' || $this->finance_invoice_customer->cek_id_regional($this->session->userdata('scope_area')) == '13' || $this->finance_invoice_customer->cek_id_regional($this->session->userdata('scope_area')) == '14' || $this->finance_invoice_customer->cek_id_regional($this->session->userdata('scope_area')) == '15')) && $r['telp'] != ''){
            ?>
            <tr>
                <td align="left" valign="top" style="border:0; padding-bottom:0; padding-top:0;">PHONE</td>
                <td align="left" valign="top" style="border:0; padding-bottom:0; padding-top:0;">:</td>
                <td align="left" valign="top" style="border:0; padding-bottom:0; padding-top:0;"><?php echo $r['telp']; ?></td>
            </tr>
            <?php
            }
            ?>
    	</table>
    </td>
    <td align="right" valign="top" style="border:0; padding:0; text-align:right" width="50%">
        <table class="tabel_report" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td align="left" valign="top" style="border:0; padding-bottom:0; padding-top:0;" width="70">NO INVOICE</td>
                <td align="left" valign="top" style="border:0; padding-bottom:0; padding-top:0;" width="1">:</td>
                <td align="left" valign="top" style="border:0; padding-bottom:0; padding-top:0;"><?php echo $r['no_invoice']; ?></td>
            </tr>
            <tr>
                <td align="left" valign="top" style="border:0; padding-bottom:0; padding-top:0;">CUST. ID</td>
                <td align="left" valign="top" style="border:0; padding-bottom:0; padding-top:0;">:</td>
                <td align="left" valign="top" style="border:0; padding-bottom:0; padding-top:0;"><?php echo $r['customer_id']; ?></td>
            </tr>
            <tr>
                <td align="left" valign="top" style="border:0; padding-bottom:0; padding-top:0;">INV. DATE</td>
                <td align="left" valign="top" style="border:0; padding-bottom:0; padding-top:0;">:</td>
                <td align="left" valign="top" style="border:0; padding-bottom:0; padding-top:0;"><?php echo $r['date_invoicenya']; ?></td>
            </tr>
            <tr>
                <td align="left" valign="top" style="border:0; padding-bottom:0; padding-top:0;">DUE DATE</td>
                <td align="left" valign="top" style="border:0; padding-bottom:0; padding-top:0;">:</td>
                <td align="left" valign="top" style="border:0; padding-bottom:0; padding-top:0;"><?php echo $r['date_duenya']; ?></td>
            </tr>
            <tr>
                <td align="left" valign="top" style="border:0; padding-bottom:0; padding-top:0;">PERIODE</td>
                <td align="left" valign="top" style="border:0; padding-bottom:0; padding-top:0;">:</td>
                <td align="left" valign="top" style="border:0; padding-bottom:0; padding-top:0; text-transform:capitalize;"><?php echo $r['periode_invoice']; ?></td>
            </tr>
    	</table>
    </td>
</tr>
</thead>
<tbody>
</tbody>
</table>
<?php }else{
?>
<table class="tabel_report" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:<?php echo $margintop; ?>px;">
<thead>
<tr>
    <td align="left" valign="top" style="border:0; padding:0; vertical-align:top;" >&nbsp;

    </td>
</tr>
</thead>
</table><?php	
}
if((($jml_det_row - 1) >= $ii && $jml_det_ttl != 1) || $jml_det_ttl == 1){
?>
<table class="tabel_report tabel_report_invoice" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:50px;">
<thead>
<tr bgcolor="#FF9900">
    <th valign="top" style="border:1px solid #ccc;" width="30">No</th>
    <th valign="top" style="border:1px solid #ccc;">Description</th>
    <th valign="top" style="border:1px solid #ccc;">Note</th>
    <th valign="top" style="border:1px solid #ccc;" width="100">Price</th>
</tr>
</thead>
<tbody>
<?php
}
if($service_1 > 0 && $ii == 0){
	$no++;
	$bg = ($no % 2 == 0)?'style="background:#eee;"':'';
	$cek_total = $service_1 - $r['potongan'] + $r['ppn'];
	if($r['jenis_ppn'] == '1'){
		if($cek_total == $r['jumlah']){
			$service_1 += $ppn;
			$ppn = 0;
		}else{
			$service_1 += $r['ppn_head'];
			$ppn -= $r['ppn_head'];
		}
	}
?>
<tr <?php echo $bg; ?>>
    <td valign="middle" style="vertical-align:middle; border:1px solid #ccc;" align="right"><?php echo $no; ?>.</td>
    <td valign="middle" style="vertical-align:middle; border:1px solid #ccc;"><?php echo $r['product_desc']; ?></td>
    <td valign="middle" style="vertical-align:middle; border:1px solid #ccc;"><?php echo $r['product_note']; ?></td>
    <td valign="middle" style="vertical-align:middle; border:1px solid #ccc;" align="right">Rp. <?php echo number_format($service_1,0); ?></td>
</tr>
<?php
	$jml += $service_1;
	/*
}else{
	if($r['jenis_ppn'] == '1'){
		$ppn = $ppn_show;
	}else{
		$ppn = $r['ppn'];
	}
	*/
}

//$ppn_show = $r['ppn'];
$det_limit = ($ii == 0)?12:13;
$det_offset = ($service_1 > 0)?$no - 1:$no;
$this->db->select("*, floor((bw + colo + instalasi + perangkat + lain2) * 0.1) as ppn_det",false);
$this->db->where('no_invoice', $r['id']);
$this->db->from('finance_invoice_customer_add');
$this->db->order_by('id', 'asc');
$this->db->limit($det_limit, $det_offset);
$qd = $this->db->get();
if($qd->num_rows() > 0){
	foreach($qd->result_array() as $kd => $rd){
		$no++;
		if($r['jenis_ppn'] == '1'){
			if(($kd + 1) != $qd->num_rows()){
				$ppn_det = $rd['ppn_det'];
				$ppn -= $ppn_det;
			}else{
				$ppn_det = $ppn;
				$ppn = 0;
			}
		}else{
			$ppn_det = 0;
		}
		$service_d = $rd['bw'] + $rd['colo'] + $rd['instalasi'] + $rd['perangkat'] + $rd['lain2'] + $ppn_det;
		$bg = ($no % 2 == 0)?'style="background:#eee;"':'';
		echo '<tr '.$bg.'>
			<td valign="middle" style="vertical-align:middle; border:1px solid #ccc;" align="right">'.$no.'.</td>
			<td valign="middle" style="vertical-align:middle; border:1px solid #ccc;">'.$rd['description'].'</td>
			<td valign="middle" style="vertical-align:middle; border:1px solid #ccc;">'.$rd['note'].'</td>
			<td valign="middle" style="vertical-align:middle; border:1px solid #ccc;" align="right">Rp. '.number_format($service_d,0).'</td>
		</tr>';
		$jml += $service_d;
	}
}
$qd->free_result();



$j = $no + 1;
for($i = $j; $i <= 2; $i++){
	$no++;
	$bg = ($no % 2 == 0)?'style="background:#eee;"':'';
	echo '<tr '.$bg.'>
		<td valign="top" style="border:1px solid #ccc;" align="right">&nbsp;</td>
		<td valign="top" style="border:1px solid #ccc;">&nbsp;</td>
		<td valign="top" style="border:1px solid #ccc;">&nbsp;</td>
		<td valign="top" style="border:1px solid #ccc;" align="right">&nbsp;</td>
	</tr>';
}

if((($jml_det_row - 1) == $ii && $jml_det_ttl != 1) || $jml_det_ttl == 1){
//$jml -= $r['potongan'];
$total = $jml + $ppn - $r['potongan'];
if($total != $jml){
?>
<tr style="font-weight:bold;">
    <td valign="top" align="right" style="border:0; padding:3px 5px;" colspan="2">&nbsp;</td>
    <td valign="top" align="right" style="border:0; padding:3px 5px;">Amount</td>
    <td valign="top" align="right" style="border:0; padding:3px 5px; border-left:1px solid #ccc; border-right:1px solid #ccc;">Rp. <?php echo number_format($jml,0); ?></td>
</tr>
<?php
}
if($r['potongan'] > 0){
?>
<tr style="font-weight:bold;">
    <td valign="top" align="right" style="border:0; padding:3px 5px;" colspan="2">&nbsp;</td>
    <td valign="top" align="right" style="border:0; padding:3px 5px;"><?php echo $r['jenis_potongan']; ?></td>
    <td valign="top" align="right" style="border:0; padding:3px 5px; border-left:1px solid #ccc; border-right:1px solid #ccc;">Rp. <?php echo number_format($r['potongan'],0); ?></td>
</tr>
<?php
}
if($ppn > 0){
?>
<tr style="font-weight:bold;">
    <td valign="top" align="right" style="border:0; padding:3px 5px;" colspan="2">&nbsp;</td>
    <td valign="top" align="right" style="border:0; padding:3px 5px;">PPN 10%</td>
    <td valign="top" align="right" style="border:0; padding:3px 5px; border-left:1px solid #ccc; border-right:1px solid #ccc;">Rp. <?php echo number_format($ppn,0); ?></td>
</tr>
<?php
}
?>
<tr style="font-weight:bold;">
    <td valign="top" align="right" style="border:0; padding:3px 5px;" colspan="2">&nbsp;</td>
    <td valign="top" align="right" style="border:0; padding:3px 5px;">Total Amount</td>
    <td valign="top" align="right" style="border:0; padding:3px 5px; border-left:1px solid #ccc; border-right:1px solid #ccc; border-bottom:1px solid #ccc;">Rp. <?php echo number_format($total,0); ?></td>
</tr>
<tr style="font-weight:bold;">
    <td valign="top" align="right" style="border:0; padding:3px 5px;" colspan="4">
    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;" width="100%">
    <tr><td width="1" style="white-space:nowrap; border:0; padding:0; padding-top:50px; padding-bottom:20px;" valign="top">Terbilang / In words :</td>
    <td style="border:0; text-transform:capitalize; font-style:italic; font-weight:normal; padding:0; padding-left:10px; padding-top:50px; padding-bottom:20px;"><?php echo kata_terbilang($total); ?> rupiah</td></tr></table>
    </td>
</tr>
<?php } ?>
</tbody>
</table>
<?php /*
<div class="page-break"></div>
<table class="tabel_report tabel_report_invoice" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:100px;">
<tr style="font-weight:bold;">
    <td valign="top" align="right" style="border:0; padding:3px 5px;" colspan="4">
    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;" width="100%">
    <tr><td width="1" style="white-space:nowrap; border:0; padding:0; padding-top:50px; padding-bottom:20px;" valign="top">Terbilang / In words :</td>
    <td style="border:0; text-transform:capitalize; font-style:italic; font-weight:normal; padding:0; padding-left:10px; padding-top:50px; padding-bottom:20px;"><?php echo kata_terbilang($total); ?> rupiah</td></tr></table>
    </td>
</tr>
*/ 
if(($ii + 1) == $jml_det_ttl){
?>
<table class="tabel_report tabel_report_invoice" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:0px;">
<tbody>
<tr style="font-weight:bold;">
    <td valign="top" style="border:0; border-top:2px dashed #FF6600; padding:3px 5px;" colspan="4">Payment can be transfered to :</td>
</tr>
<tr>
    <td valign="top" style="border:0; border-bottom:2px dashed #FF6600; padding:3px 5px;" colspan="4">
    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;" width="100%">
<?php
	
	$payment_to = explode(',', $r['payment_to']);
	$this->db->from('bank');
	$this->db->where_in('id',$payment_to);
	$qb = $this->db->get();
	if($qb->num_rows() > 0){
		echo '<tr>';
		foreach($qb->result_array() as $kb => $rb){
			echo '<td width="50%" style="padding:0; padding-bottom:10px; border:0;">'.$rb['name'].'<br>Account Name : '.$rb['account_name'].'<br>Account No : '.$rb['account_number'].'</td>';
			if(($kb+1) % 2 == 0){echo '</tr><tr>';}
		}
		echo '</tr>';
	}
?>  
    </table>
    </td>
</tr>
<?php
if($r['barcode'] == '1'){
?>
<tr style="">
    <td valign="top" align="left" style="border:0; padding:3px 5px; height:100px; vertical-align:top; font-weight:bold; padding-top:20px;" height="100">Note :</td>
    <td valign="top" align="left" style="border:0; padding:3px 5px; vertical-align:top; padding-top:20px;" colspan="2">
	Please send your confirmation transfer payment to :<br />
    Phone : <?php echo $phone_cust; ?> or email : <?php echo $email_cust; ?><br />
    Tagihan ini berlaku sebagai tanda terima yang sah setelah pembayaran diterima<br />
    This invoice can be treated as official receipt upon acceptance of payment
</td>
    <td valign="top" align="right" style="border:0; padding:3px 5px; padding-top:20px;"><?php echo $barcode; ?></td>
</tr>
<?php
}else{
?>
<tr style="">
    <td valign="top" align="left" style="border:0; padding:3px 5px; height:100px; vertical-align:top; font-weight:bold; padding-top:20px;" height="100">Note :</td>
    <td valign="top" align="left" style="border:0; padding:3px 5px; vertical-align:top; padding-top:20px;" colspan="2">
	Please send your confirmation transfer payment to :<br />
    Phone : <?php echo $phone_cust; ?> or email : <?php echo $email_cust; ?><br />
    Tagihan ini berlaku sebagai tanda terima yang sah setelah pembayaran diterima<br />
    This invoice can be treated as official receipt upon acceptance of payment
    </td>
    <td valign="top" align="right" style="border:0; padding:3px 5px;">&nbsp;</td>
</tr>
<tr style="font-weight:bold;">
    <td valign="top" style="border:0; padding:3px 5px;" colspan="4">
    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;" width="100%">
    <tr>
        <td width="50%" style="padding:0; padding-bottom:10px; border:0;" align="center">Prepared by<br /><br /><br /><br /><br /><br /><br /><?php echo $by_create; ?></td>
        <td width="50%" style="padding:0; padding-bottom:10px; border:0;" align="center">Approved by<br /><br /><br /><br /><br /><br /><br /><?php echo $by_approve; ?></td>
    </tr>
    </table>
    </td>
</tr>
<tr style="font-weight:bold;">
    <td align="left" style="border:0; padding:3px 5px;" colspan="4">
	<?php
    if($r['ppn_tax'] == '1' && $pdf == '1'){
		//echo '<img src="./assets/images/bg-msd-bali-addres.png" />';
	}else{
		//echo '&nbsp;';
	}
    ?>
    </td>
</tr>
<?php
}
?>
</tbody>
</table>
<?php
}else{
	echo '</tbody>
</table>';	
}
			if(($ii + 1) != $jml_det_ttl){
				echo '<div class="page-break"></div><br style="clear:both;">';	
			}
		}
	}
}
?>
</body>
</html>
