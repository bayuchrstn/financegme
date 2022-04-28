<?php
	$prefix  = 'report_form';
	$default_value = array();
	$forms = $this->ui->forms('task', $default_value, $prefix);
	$forms_task_hidden = $this->ui->forms('task_hidden', $default_value, $prefix);
	$forms_report = $this->ui->forms('task_report', $default_value, $prefix);
	$pre_survey_report = $this->ui->forms_by_section('task_report', 'pre_survey', $default_value, $prefix);
    // pre($this->ui->forms_debug($pre_survey_report));

    // echo $pre_survey_report['status_coverage'];
    // echo $pre_survey_report['koordinat'];

?>

<div class="row">
	<div class="col-lg-6">
		<?php echo $pre_survey_report['status_coverage'];  ?>
	</div>
	<div class="col-lg-6">
		<?php echo $pre_survey_report['koordinat'];  ?>
	</div>
</div>

<div class="panel-group form-accordion" id="accordion">
	<div class="panel panel-info">
    	<div class="panel-heading">
			<span>
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Fiber Optic</a>
			</span>
      	</div>
      	<div id="collapse1" class="panel-collapse collapse p-10">
			<?php
				echo $pre_survey_report['jarak_opd_pelanggan'];
			?>
      	</div>
    </div>

	<div class="panel panel-info">
    	<div class="panel-heading">
			<span>
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Wireless</a>
			</span>
    	</div>
    	<div id="collapse2" class="panel-collapse collapse p-10">
			<?php
				echo $pre_survey_report['jenis_tower'];
				echo $pre_survey_report['tinggi_tower'];
			?>
    	</div>
  	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<?php echo $pre_survey_report['estimasi_waktu_pengerjaan'];  ?>
	</div>
	<div class="col-lg-6">
		<?php echo $pre_survey_report['estimasi_biaya'];  ?>
	</div>
</div>

<?php
    echo $pre_survey_report['nama_vendor'];
    echo $pre_survey_report['note'];
?>

<script type="text/javascript">
	var pre_survey_data = <?php echo json_encode($pre_survey_data); ?>;
	// console.log(pre_survey_data);
	$('#status_coverage_<?php echo $prefix; ?>').val(pre_survey_data.status_coverage);
	$('#koordinat_<?php echo $prefix; ?>').val(pre_survey_data.koordinat);
	$('#jarak_opd_pelanggan_<?php echo $prefix; ?>').val(pre_survey_data.jarak_opd_pelanggan);
	$('#jenis_tower_<?php echo $prefix; ?>').val(pre_survey_data.jenis_tower);
	$('#tinggi_tower_<?php echo $prefix; ?>').val(pre_survey_data.tinggi_tower);
	$('#estimasi_waktu_pengerjaan_<?php echo $prefix; ?>').val(pre_survey_data.estimasi_waktu_pengerjaan);
	$('#estimasi_biaya_<?php echo $prefix; ?>').val((pre_survey_data.estimasi_biaya));
	$('#nama_vendor_<?php echo $prefix; ?>').val(pre_survey_data.nama_vendor);
	$('#note_<?php echo $prefix; ?>').val(pre_survey_data.note);

	$('#estimasi_biaya_report_form').focusout(function() {
		var val = toCurrency(this.value);
		$(this).val(val);
	});

	$('#estimasi_biaya_report_form').focus(function() {
		var val = toNumberOnly(this.value);
		$(this).val(val);
	});

	function toNumberOnly(str) { // remove all character other than number
		return str.toString().replace(/[^0-9]+/g, '');
	}

	function toCurrency(str) { // change to currency format
		return 'Rp'+Number(toNumberOnly(str)).toLocaleString('id-ID');
	}

	// Todo:
	// - convert to Number before POST
</script>
