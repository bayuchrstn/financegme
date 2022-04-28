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
$periode = '';
$searchTanggal = $this->input->post('searchTanggal');
if( $searchTanggal == '1'){
	$periode = tanggal_indo_ymd($this->input->post('searchDateFirst1')).' s/d '.tanggal_indo_ymd($this->input->post('searchDateFinish1'));
	$tanggal_awal = $this->input->post('searchDateFirst1');
	$tanggal_akhir = $this->input->post('searchDateFinish1');
	$tanggal_awal_tahun = date("Y-01-01", strtotime($this->input->post('searchDateFinish1')));
}elseif($searchTanggal == '3'){
	$periode = tanggal_indo_ymd($this->input->post('searchDateFinish'));
	$tanggal_awal = date("Y-m-01", strtotime($this->input->post('searchDateFinish')));
	$tanggal_akhir = $this->input->post('searchDateFinish');
	$tanggal_awal_tahun = date("Y-01-01", strtotime($this->input->post('searchDateFinish')));
}
?>
<body>
<table class="table datatable-ajax table-striped table-xxs text-size-small text-nowrap table-bordered">
<thead>
    <tr class="text-uppercase text-center text-size-large">
    	<th colspan="5">Account List Summary (<?php echo $this->m_global->cek_name_regional($this->session->userdata('scope_area')); ?>)<br />
        <span style="font-weight:normal;">Per : <?php echo $periode; ?></span></th>
    </tr>
    <tr class="text-uppercase text-center text-size-large">
    	<th width="1">account no.</th>
    	<th>account name</th>
    	<th width="1">balance</th>
    	<th width="1">dr/cr</th>
    	<th width="1">parent/detail</th>
    </tr>
</thead>
<tbody>
<?php

$page_uri = base_url().'finance_accounting_report_als/index/';
$searchform = $tanggal_awal.'/'.$tanggal_akhir;
		
$this->db->from('finance_coa');
//$this->db->where_not_in("kelompok", array(1,2,3));
$this->db->order_by('id');
$q = $this->db->get();
$data = $q->result_array();

$this->finance_accounting_report_ald->looping_child_label(1, $data, $searchTanggal, $tanggal_awal, $tanggal_akhir);
?>
</tbody>
</table>
</body>
</html>
