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
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/blockui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.pwstrength.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/autoNumeric.min.js"></script>
<!-- <script type="text/javascript" src="<?php echo base_url() ?>assets/js/navbar.js"></script> -->
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/switch.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/pushjs/push.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/pushjs/serviceWorker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/func.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/pace.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/masonry.pkgd.min.js"></script>


<script type="text/javascript" src="<?php echo base_url() ?>assets/js/datatables/extensions/jszip/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/datatables/extensions/pdfmake/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/datatables/extensions/pdfmake/vfs_fonts.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/datatables/extensions/buttons.min.js"></script>
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
<table id="datatable-button-html5-basic" class="table datatable-ajax table-striped table-xxs text-size-small text-nowrap table-bordered">
<thead>
<tr class="text-uppercase text-center text-size-large">
    	<th colspan="2">NERACA (<?php echo $this->m_global->cek_name_regional($this->session->userdata('scope_area')); ?>) <a class="dt-button buttons-excel buttons-html5 btn btn-default" tabindex="0" aria-controls="datamain_datatable"><span><i class="icon-file-spreadsheet position-left"></i> Excel</span></a><br />
        <span style="font-weight:normal;">Periode : <?php echo bulan_indo($this->input->post('bulan_awal')).' '.$this->input->post('tahun_awal'); ?></span></th>
    </tr>
</thead>
<tbody>
<tr>
	<td valign="top" style="padding:0; border:0;">
<?php
$tanggal_awal = $this->input->post('tahun_awal').'-'.$this->input->post('bulan_awal').'-01';
$tanggal_akhir = date("Y-m-t", strtotime($tanggal_awal));
$tanggal_awal_tahun = $this->input->post('tahun_awal').'-01-01';

$page_uri = base_url().'finance_accounting_report_als/index/';
$searchform = $tanggal_awal.'/'.$tanggal_akhir;
		
$this->db->from('finance_coa');
$this->db->where("kelompok", '1');
$this->db->order_by('id');
$q = $this->db->get();
$data = $q->result_array();

echo '<table class="table datatable-ajax table-striped table-xxs text-size-small text-nowrap table-bordered">';
$this->finance_accounting_report_neraca->looping_child_label(1, $data, $tanggal_awal, $tanggal_akhir);
echo '</table>';

$aktiva = $this->finance_accounting_report_neraca->akun_label(1, $data, $tanggal_awal, $tanggal_akhir);

?>
	</td>
    <td valign="top" style="padding:0; border:0; vertical-align:top;">
<?php
$hutang = 0.00;
$modal = 0.00;
$this->db->from('finance_coa');
$this->db->where_in("kelompok", array(2,3));
$this->db->order_by('id');
$q = $this->db->get();
$data = $q->result_array();

echo '<table class="table datatable-ajax table-striped table-xxs text-size-small text-nowrap table-bordered">';
$this->finance_accounting_report_neraca->looping_child_label(1, $data, $tanggal_awal, $tanggal_akhir);
echo '</table>';

$pasiva = $this->finance_accounting_report_neraca->akun_label(1, $data, $tanggal_awal, $tanggal_akhir);

?>
    </td>
</tr>
<tr class="text-black">
	<td>Total Activa<span style="float:right;">Rp <?php echo number_format($aktiva,2)?></span></td>
	<td>Total Pasiva<span style="float:right;">Rp <?php echo number_format($pasiva,2)?></span></td>
</tr>
</tbody>
</table>
</body>
</html>
