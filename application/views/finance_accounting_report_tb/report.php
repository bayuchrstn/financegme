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
<?php
$tanggal_awal = $this->input->post('searchDateFirst');
$tanggal_akhir = $this->input->post('searchDateFinish');
$tanggal_awal_tahun =  date("Y-01-01", strtotime($tanggal_awal));
?>

<body>
<table class="table datatable-ajax table-striped table-xxs text-size-small text-nowrap table-bordered">
<thead>
<tr class="text-uppercase text-center text-size-large">
    <th colspan="7">TRIAL BALANCE (<?php echo $this->m_global->cek_name_regional($this->session->userdata('scope_area')); ?>)<br />
    <span style="font-weight:normal;">Periode : <?php echo tanggal_indo_ymd($this->input->post('searchDateFirst')).' s/d '.tanggal_indo_ymd($this->input->post('searchDateFinish')); ?></span></th>
</tr>
<tr class="text-uppercase text-center text-size-large">
    <th rowspan="2">AKUN</th>
    <th colspan="2">BEGINNING BALANCE</th>
    <th colspan="2">PERIOD BALANCE</th>
    <th colspan="2">ENDING BALANCE</th>
</tr>
<tr class="text-uppercase text-center text-size-large">
    <th>DEBET</th>
    <th>KREDIT</th>
    <th>DEBET</th>
    <th>KREDIT</th>
    <th>DEBET</th>
    <th>KREDIT</th>
</tr>
</thead>
<tbody>
<?php
	$this->db->from('finance_coa');
	$this->db->order_by('id');
	$q = $this->db->get();
	$data = $q->result_array();
	$this->finance_accounting_report_tb->looping_child_label(1, $data, $tanggal_awal, $tanggal_akhir);
?>
</tbody>
</table>
</body>
</html>
