<?php
	$prefix  = 'report_form';
	$default_value = array();
	$forms = $this->ui->forms('task', $default_value, $prefix);
	$forms_task_hidden = $this->ui->forms('task_hidden', $default_value, $prefix);
	$forms_report = $this->ui->forms('task_report', $default_value, $prefix);
	$fo_report = $this->ui->forms_by_section('task_report', 'fo', $default_value, $prefix);
	$wr_report = $this->ui->forms_by_section('task_report', 'wr', $default_value, $prefix);
	// pre($this->ui->forms_debug($fo_report));
	// pre($this->ui->forms_debug($wr_report));
	// pre($task_detail);
	// pre($report_detail);
	echo $forms_task_hidden['category'];
	echo $forms_task_hidden['location'];
	echo $forms_task_hidden['location_id'];
	echo $forms['id'];
?>

<div class="row">
	<div class="col-lg-6">
		<?php echo $forms_report['tanggal_installasi'] ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms_report['nama_vendor'] ?>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<?php echo $forms_report['support_provisioning'] ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms_report['koordinat_klien'] ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<?php echo $forms_report['router'] ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms_report['ip_public'] ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<?php echo $forms_report['ip_lan'] ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms_report['user_pppoe'] ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<?php echo $forms_report['password_pppoe'] ?>
	</div>
	<div class="col-lg-6">
		<?php //echo $forms_report['user_pppoe'] ?>
	</div>
</div>

<h3>Primary Link</h3>
<!-- primary link  -->
<div class="row">
	<div class="col-lg-6">
		<?php echo $forms_report['fo_odp']; ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms_report['fo_jenis_kabel']; ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<?php echo $forms_report['fo_jarak_kabel']; ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms_report['fo_ont_onu']; ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<?php echo $forms_report['fo_serial_number_ont_onu']; ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms_report['fo_mac_address_fo_ont_onu']; ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<?php echo $forms_report['fo_serial_number_ont_onu']; ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms_report['fo_mac_address_fo_ont_onu']; ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<?php echo $forms_report['fo_power_optic_odp']; ?>
	</div>
	<div class="col-lg-6">
		<?php echo $forms_report['fo_power_optic_roset']; ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<?php echo $forms_report['fo_ip_ptv_privat']; ?>
	</div>
	<div class="col-lg-6">
		<?php //echo $forms_report['fo_power_optic_roset']; ?>
	</div>
</div>
<!-- primary link  -->


<?php


	// wireless
	echo $forms_report['wireless_bts'];
	echo $forms_report['wireless_jarak'];
	echo $forms_report['wireless_signal_strenght'];
	echo $forms_report['wireless_kualitas_signal'];
	echo $forms_report['wireless_antena'];
	echo $forms_report['wireless_radio'];
	echo $forms_report['wireless_jenis_kabel'];
	echo $forms_report['wireless_jarak_kabel'];
	echo $forms_report['wireless_power_optik_odp'];
	echo $forms_report['wireless_power_optik_roset'];
	echo $forms_report['wireless_speed_test'];
	echo $forms_report['wireless_topologi'];
	echo $forms_report['wireless_odp'];
	echo $forms_report['wireless_modem_fo_adaptor'];
	echo $forms_report['wireless_router'];
	echo $forms_report['wireless_jalur_kabel'];
	echo $forms_report['wireless_test_link_wireless'];

	echo $forms['body'];
	echo $forms['attachment'];
	echo $forms_report['status_pekerjaan'];

	// echo $forms_report['user_pppoe'];
	// echo $forms_report['fo_tiang_9'];
?>

<input type="hidden" name="id_report" id="id_report" value="">

<script type="text/javascript">

	//+++++++++++++++++++ php json+++++++++++++++++++++++++++++
	var task_detail = <?php echo json_encode($task_detail); ?>;
	var report_detail = <?php echo json_encode($report_detail); ?>;
	//+++++++++++++++++++ php json+++++++++++++++++++++++++++++

	//load current attachment
	if (report_detail.id_report !== undefined){
		$('#attachment_div_report_form').load('<?php echo base_url(); ?>attachment/index/'+report_detail.id_report);
	}

	if (report_detail.body !== undefined){
		$('#body_fake_report_form').val(report_detail.body);
	}

	<?php
		$rfields = $this->db->field_data('task_report');
		foreach ($rfields as $field):
			if($field->name !='id' && $field->name !='task_id'):
	?>

	if( $('#<?php echo $field->name; ?>_<?php echo $prefix; ?>').length ){
		$('#<?php echo $field->name; ?>_<?php echo $prefix; ?>').val( (report_detail.<?php echo $field->name; ?> !== undefined) ? report_detail.<?php echo $field->name; ?> : ''  );
	}

	<?php
			endif;
		endforeach;
	?>

	$('#id_report_form').val(task_detail.id);
	$('#id_report').val(report_detail.id_report);
	$('#category_report_form').val(task_detail.category);
	$('#location_report_form').val(task_detail.location);
	$('#location_id_report_form').val(task_detail.location_id);


	// tinymce handle
	tinymce.remove();
	$(document).ajaxComplete(function(){
		tinymce.init({
			selector: '.wysiwyg',
			statusbar:  false,
			menubar:    false,
			rel_list:   [ { title: 'Lightbox', value: 'lightbox' } ],
			setup: function(editor) {
				editor.on('change', function(e) {
					var isi = this.getContent();
					$('.fake_tinymce').val(isi);
				});
			}
		});

		tinymce.get('body_report_form').setContent(report_detail.body);
	});

	//chosen status pekerjaan
	set_option('<?php echo base_url(); ?>select_option/request/my_task/status_pekerjaan', 'status_pekerjaan_report_form', 'selesai');


	//+++++++++++++++++++++++UPLOAD+++++++++++++++++++++++++++++++++++
	$(function () {
        'use strict';
        var url = '<?php echo base_url(); ?>uploader/request/task_teknis_report';

        $('#attachment_report_form').fileupload({
            url: url,
            dataType: 'json',
            start: function (e, data) {
                ispin('ibuttonuploader_insert');
            },
            done: function (e, data) {
				uspin('ibuttonuploader_insert');
				var i = 1;
				$.each(data.result.attachment, function (index, file) {
					i++;
					// console.log(file);
					// $('.patient_photo').val(file.name);
					$('#attachment_ul_report_form').append('<li id="attachment_li_'+i+'" class="alert alert-primary no-border mb-5">'+file.name+' <a onclick="remove_this_attachment('+i+');" href="#" class="pull-right"><i class="icon-trash position-left"></i>Remove<input type="hidden" name="attachment[]" value="'+file.name+'"></a></li>');
					// $('.photo_profile_patient').attr('src', '<?php echo base_url(); ?>patient_photo/medium/'+file.name);
				});
            }
        });
    });

	function remove_this_attachment(par)
	{
		$('#attachment_li_'+par).remove();
		console.log(par);
	}
	//+++++++++++++++++++++++UPLOAD+++++++++++++++++++++++++++++++++++

</script>
