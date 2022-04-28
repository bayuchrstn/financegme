<?php
	$prefix  = 'report_form';
	$default_value = array();
	$forms = $this->ui->forms('task', $default_value, $prefix);
	$forms_task_hidden = $this->ui->forms('task_hidden', $default_value, $prefix);
	$forms_report = $this->ui->forms('task_report', $default_value, $prefix);
	// pre($this->ui->forms_debug($forms_report));
	// pre($task_detail);
	// pre($report_detail);
	echo $forms_task_hidden['category'];
	echo $forms_task_hidden['location'];
	echo $forms_task_hidden['location_id'];
	echo $forms['id'];
?>


<?php
	// echo $forms['subject'];
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
