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
<table class="table datatable-ajax table-striped table-xxs text-size-small text-nowrap table-bordered">
<thead>
    <tr class="text-uppercase text-center text-size-large">
    	<th colspan="3">LABA RUGI (<?php echo $this->m_global->cek_name_regional($this->session->userdata('scope_area')); ?>)<br />
        <span style="font-weight:normal;">Periode : <?php echo bulan_indo($this->input->post('bulan_awal')).' '.$this->input->post('tahun_awal'); ?></span></th>
    </tr>
    <tr class="text-uppercase text-center text-size-large">
    	<th>account</th>
    	<th>current</th>
    	<th>cummulatif</th>
    </tr>
</thead>
<tbody>
<?php
$tanggal_awal = $this->input->post('tahun_awal').'-'.$this->input->post('bulan_awal').'-01';
$tanggal_akhir = date("Y-m-t", strtotime($tanggal_awal));
$tanggal_awal_tahun = $this->input->post('tahun_awal').'-01-01';

$page_uri = base_url().'finance_accounting_report_als/index/';
$searchform = $tanggal_awal.'/'.$tanggal_akhir;
		
$this->db->from('finance_coa');
$this->db->where_not_in("kelompok", array(1,2,3));
$this->db->order_by('id');
$q = $this->db->get();
$data = $q->result_array();

$this->finance_accounting_report_rl->looping_child_label(1, $data, $tanggal_awal, $tanggal_akhir);

$saldo_current = $this->finance_accounting_report_rl->akun_label(1, $data, $tanggal_awal, $tanggal_akhir);
$saldo_current = ($saldo_current < 0)?'<span class="text-danger-800">('.str_replace("-", "", number_format($saldo_current,2)).')</span>':number_format($saldo_current,2);
$saldo_cummulatif = $this->finance_accounting_report_rl->akun_label(1, $data, $tanggal_awal_tahun, $tanggal_akhir);
$saldo_cummulatif = ($saldo_cummulatif < 0)?'<span class="text-danger-800">('.str_replace("-", "", number_format($saldo_cummulatif,2)).')</span>':number_format($saldo_cummulatif,2);
?>
<tr class="text-black">
	<td>Nett Profit / Loss</td>
	<td class="text-right"><?php echo $saldo_current ?></td>
	<td class="text-right"><?php echo $saldo_cummulatif ?></td>
</tr>
</tbody>
</table>
</body>
</html>
