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

<style type="text/css">
td, th{padding:2px 5px;}
th{text-align:center;}
div{width:500px; clear:both;}
div label.kanan{float:right; width:150px; text-align:right;}
div label.kiri{float:left; width:auto; text-align:left;}
@media print {
	.btnBack{display:none;}
	thead {display: table-header-group;}
}
</style>
<body>
<?php
$tanggal_start_awal = $this->input->post('start_tahun_awal').'-'.$this->input->post('start_bulan_awal').'-01';
$tanggal_start_akhir = date("Y-m-t", strtotime($tanggal_start_awal));
$tanggal_finish_awal = $this->input->post('finish_tahun_awal').'-'.$this->input->post('finish_bulan_awal').'-01';
$tanggal_finish_akhir = date("Y-m-t", strtotime($tanggal_finish_awal));

$begin = new DateTime($tanggal_start_awal);
$end = new DateTime($tanggal_finish_akhir);
		
$date_interval = DateInterval::createFromDateString('1 month');
$date_period = new DatePeriod($begin, $date_interval, $end);
$n = 2;
foreach($date_period as $date_period_no => $date_period_dt){
	$n++;
}

?>
<table class="table datatable-ajax table-striped table-xxs text-size-small text-nowrap table-bordered">
<thead>
<tr class="text-uppercase text-center text-size-large">
    <th colspan="<?php echo $n; ?>">Rugi Laba (<?php echo $this->m_global->cek_name_regional($this->session->userdata('scope_area')); ?>)</th>
</tr>
<tr class="text-uppercase text-center text-size-large">
	<th>AKUN</th>
<?php
	foreach($date_period as $date_period_no => $date_period_dt){
		echo '<th>'.$date_period_dt->format('M Y').'</th>';
	}
?>
	<th>ENDING BALANCE</th>
</tr>
<tr><td style="padding:0; border:0;">
<table class="table datatable-ajax table-striped table-xxs text-size-small text-nowrap table-bordered">
<?php
	$this->db->from('finance_coa');
	$kelompok = array(1, 2, 3);
	$this->db->where_not_in('kelompok', $kelompok);
	$this->db->order_by('id');
	$q = $this->db->get();
	$data = $q->result_array();
	//$this->finance_accounting_report_rl_period->looping_child_label(1, $data, $tanggal_awal, $tanggal_akhir);
	$this->finance_accounting_report_rl_period->akun_label(1, $data);
?>

<tr class="text-black">
	<td>Nett Profit / Loss</td>
</tr>
</table>
</td>
<?php
/*
$begin_start = $this->input->post('start_tahun_awal').'-'.$this->input->post('start_bulan_awal').'-01';
$begin_finish = date("Y-m-t", strtotime($begin_start));

echo '<td style="padding:0; border:0;">
<table class="table datatable-ajax table-striped table-xxs text-size-small text-nowrap table-bordered">';
$this->finance_accounting_report_rl_period->looping_child_label(1, $data, $begin_start, $begin_finish);
echo '</table>
</td>';
*/
foreach($date_period as $date_period_no => $date_period_dt){
	echo '<td style="padding:0; border:0;">
<table class="table datatable-ajax table-striped table-xxs text-size-small text-nowrap table-bordered">';
	$this->finance_accounting_report_rl_period->looping_child_label_current(1, $data, $date_period_dt->format('Y-m-01'), $date_period_dt->format('Y-m-t'));
	$saldo_current = $this->finance_accounting_report_rl_period->akun_label_net(1, $data, $date_period_dt->format('Y-m-01'), $date_period_dt->format('Y-m-t'));
	$saldo_current = ($saldo_current < 0)?'<span class="text-danger-800">('.str_replace("-", "", number_format($saldo_current,2)).')</span>':number_format($saldo_current,2);
	echo '<tr class="text-black"><td class="text-right">'.$saldo_current.'</td>';
	echo '</table>
</td>';
}

$ending_start = $this->input->post('finish_tahun_awal').'-'.$this->input->post('finish_bulan_awal').'-01';
$ending_finish = date("Y-m-t", strtotime($ending_start));
$ending_awal_tahun = date("Y-01-01", strtotime($ending_start));

echo '<td style="padding:0; border:0;">
<table class="table datatable-ajax table-striped table-xxs text-size-small text-nowrap table-bordered">';
$this->finance_accounting_report_rl_period->looping_child_label(1, $data, $ending_start, $ending_finish);
$saldo_current = $this->finance_accounting_report_rl_period->akun_label_net(1, $data, $ending_awal_tahun, $ending_finish);
$saldo_current = ($saldo_current < 0)?'<span class="text-danger-800">('.str_replace("-", "", number_format($saldo_current,2)).')</span>':number_format($saldo_current,2);
echo '<tr class="text-black"><td class="text-right">'.$saldo_current.'</td>';
echo '</table>
</td>';

?>
</tr>
</tbody>
</table>
</body>
</html>
